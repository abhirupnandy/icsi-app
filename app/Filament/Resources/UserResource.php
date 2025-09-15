<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;

class UserResource extends Resource
{
	protected static ?string $model = User::class;
	protected static ?string $navigationIcon = 'heroicon-o-users';

	public static function form(Form $form): Form
	{
		return $form->schema([
			// Personal Information Section
			Section::make('Personal Information')
			       ->aside()
			       ->description('Personal Information of User')
			       ->schema([

				       TextInput::make('name')
				                ->label('Name')
				                ->helperText('Name of the invited user')
				                ->placeholder('Enter name of user')
				                ->required(),
				       TextInput::make('email')
				                ->label('Email')
				                ->email()
				                ->placeholder('Enter email of user')
				                ->helperText('An invitation email will be sent to this address')
				                ->required(),
				       PhoneInput::make('phone')
				                 ->label('Phone')
				                 ->defaultCountry('IN')
				                 ->initialCountry('IN')
				                 ->displayNumberFormat(PhoneInputNumberType::NATIONAL)
				                 ->placeholder('Enter phone of user'),
				       FileUpload::make('avatar')
				                 ->label('Profile Picture')
				                 ->avatar()
				                 ->imageEditor()
				                 ->circleCropper()
				                 ->directory('avatars')
				                 ->helperText('Upload your profile picture.'),
			       ]),

			// Account Status Section
			Section::make('Account Status')
			       ->aside()
			       ->description('Account Status of User')
			       ->schema([
				       TextInput::make('trans_ID')
				                ->label('Transaction ID')
				                ->placeholder('Enter transaction ID'),
				       TextInput::make('trans_amount')->numeric()
				                ->label('Transaction Amount')
				                ->placeholder('Enter transaction amount'),
				       DatePicker::make('trans_date')
				                 ->native(false)
				                 ->closeOnDateSelection()
				                 ->label('Transaction Date')
				                 ->format('F j, Y')
				                 ->placeholder('Enter transaction date'),
				       Toggle::make('payment_verified')
				             ->label('Payment Verified')
				             ->default(false)
				             ->helperText('Toggle to verify payment status')
				             ->afterStateUpdated(function ($state, $set, $get, $record) {
					             if (!$record || !$record->exists) {
						             return; // Don't execute on new users
					             }
					             $record->sendPaymentVerificationEmail(
						             $state,
						             $get('trans_ID') ?? $record->trans_ID,
						             $get('trans_amount') ?? $record->trans_amount,
						             $get('trans_date') ?? $record->trans_date
					             );
				             }),
			       ]),

			// Membership Details Section
			Section::make('Membership Details')
			       ->aside()
			       ->description('Membership Information of User')
			       ->schema([
				       DatePicker::make('membership_start_date')
				                 ->label('Membership Start Date')
				                 ->native(false)
				                 ->closeOnDateSelection()
				                 ->required()
					       ->live(onBlur: true)
				                 ->format('F j, Y')
				                 ->placeholder('Enter membership start date')
					       ->afterStateUpdated(function ($state, $set, $get) {
						       if (!$state || !$get('membership_type')) {
							       return;
						       }
						       $startDate = Carbon::parse($get('membership_start_date'));
						       $membershipType = $get('membership_type');

						       $endDate = match ($membershipType) {
							       'annual' => $startDate->addYear(),
							       'institutional' => $startDate->addYears(5),
							       'lifetime' => $startDate->addYears(99),
							       default => null,
						       };

						       if ($endDate) {
							       $set('membership_end_date', $endDate->format('F j, Y'));
						       }
					       }),
				       Select::make('membership_type')
				             ->label('Membership Type')
				             ->live(onBlur: true)
				             ->options([
					             'none' => 'None',
					             'lifetime' => 'Lifetime',
					             'annual' => 'Annual',
					             'institutional' => 'Institutional',
				             ])
				             ->default('none') // "None" is pre-selected
					       ->required()->notIn(['none'])
					       // submission if "None" is selected
				             ->placeholder('Select membership type')
				             ->helperText('Select a valid membership type (cannot be "None")')
                               ->afterStateUpdated(function ($state, $set, $get) {
                                   if (!$state || !$get('membership_start_date')) {
                                       return;
                                   }

                                   $startDate = Carbon::parse($get('membership_start_date'));
                                   $membershipType = $state; // because here $state is the membership type

                                   $endDate = match ($membershipType) {
                                       'annual' => $startDate->copy()->addYear(),
                                       'institutional' => $startDate->copy()->addYears(5),
                                       'lifetime' => $startDate->copy()->addYears(99),
                                       default => null,
                                   };

                                   if ($endDate) {
                                       $set('membership_end_date', $endDate->format('F j, Y'));
                                   }
                               }),



				       TextInput::make('membership_end_date')
				                ->label('Membership End Date')
				                ->placeholder('Auto-calculated based on membership type')
				                ->formatStateUsing(fn($state) => $state ? Carbon::parse($state)
				                                                                ->format('F j, Y') : null)
				                ->helperText('This field is auto-generated based on membership type and start date'),

			       ]),

			Section::make('Role Information')
			       ->aside()
			       ->description('Role Information of User')
			       ->schema([
				       Select::make('role')
				             ->label('Role')
				             ->options([
					             'admin' => 'Admin',
					             'board' => 'Board',
					             'member' => 'Member',
				             ])
					       ->required()
					       ->live(),

				       Select::make('board_member_role')
				             ->label('Board Member Role')
				             ->searchable()
				             ->options(function () {
					             return [
						             'president' => 'Current President ('.(User::where('board_member_role',
								             'president')->value('name') ?? 'None').')',
						             'vice_president' => 'Current Vice President',
						             'general_secretary' => 'Current General Secretary ('.(User::where('board_member_role',
								             'general_secretary')->value('name') ?? 'None').')',
						             'joint_secretary' => 'Current Joint Secretary',
						             'treasurer' => 'Current Treasurer',
						             'executive_committee' => 'Executive Committee Member',
						             'former_president' => 'Former President',
						             'former_general_secretary' => 'Former General Secretary',
						             'former_vice_president' => 'Former Vice President',
                                     'other' => 'Other',
					             ];
				             })
				             ->hidden(fn($get) => $get('role') !== 'board')
				             ->placeholder('Select Board Member Role')
				             ->rules([
					             function ($get, $set) {
						             return function ($attribute, $value, $fail) {
							             if (in_array($value, ['president', 'general_secretary'])) {
								             // Find and remove the existing user holding the role
								             $existingUser = User::where('board_member_role',
									             $value)->first();

								             if ($existingUser) {
									             $existingUser->update(['board_member_role' => null]); // Remove their role
								             }
							             }
						             };
					             },
				             ]),
			       ])
			       ->columns(2),
		]);

	}

	public static function table(Table $table) : Table
	{
		return $table
			->columns([
				TextColumn::make('id')->sortable(),
				TextColumn::make('name')->searchable()->sortable(),
				ImageColumn::make('avatar')
				           ->label('Profile Picture')
				           ->circular()
				           ->visible(function (User $user) {

					           //							   return if ($user->avatar ! == fake.png) {
					           return $user->avatar !== 'avatars/fake.png';

				           })
				           ->size(50),
				IconColumn::make('payment_verified')
				          ->boolean()
				          ->trueIcon('heroicon-o-check-badge')
				          ->falseIcon('heroicon-o-x-mark')
				          ->sortable(),
				TextColumn::make('role')->sortable(),
			])
			->defaultSort('id', 'desc')
			->filters([
				SelectFilter::make('payment_verified')
				            ->label('Payment Status')
				            ->options([
					            '1' => 'Paid',
					            '0' => 'Not Paid',
				            ]),

				SelectFilter::make('role')
				            ->label('Role')
				            ->options([
					            'admin' => 'Admin',
					            'board' => 'Board',
					            'member' => 'Member',
				            ]),
			])
			->actions([
				Tables\Actions\EditAction::make(),
				//				if user->role == 'admin, show delete action
				Tables\Actions\DeleteAction::make()
				                           ->visible(fn($record) => $record->role !== 'admin')
				                           ->action(function (User $record) {
					                           $record->delete();
					                           Notification::make()
					                                       ->title('User deleted successfully')
					                                       ->success()
					                                       ->send();
				                           }),
				//				View
				Tables\Actions\ViewAction::make(),
			])
			->bulkActions([
				Tables\Actions\BulkActionGroup::make([
					Tables\Actions\DeleteBulkAction::make(),
				]),
			]);
	}

	public static function getRelations() : array
	{
		return [];
	}

	public static function getPages() : array
	{
		return [
			'index' => Pages\ListUsers::route('/'),
			'create' => Pages\CreateUser::route('/create'),
			'edit' => Pages\EditUser::route('/{record}/edit'),
		];
	}
}

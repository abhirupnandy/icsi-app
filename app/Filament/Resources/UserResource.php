<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
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
			       ]),
			
			// Account Status Section
			Section::make('Account Status')
			       ->aside()
			       ->description('Account Status of User')
			       ->schema([
				       TextInput::make('trans_ID')
				                ->label('Transaction ID')
				                ->placeholder('Enter transaction ID'),
				       TextInput::make('trans_amount')
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
				                 ->format('F j, Y')
				                 ->placeholder('Enter membership start date')
				                 ->afterStateUpdated(function ($state, $set, $get) {
					                 if (!$get('membership_start_date')) {
						                 return;
					                 }
					                 
					                 $startDate = Carbon::parse($get('membership_start_date'));
					                 
					                 if ($state === 'annual') {
						                 $set('membership_end_date',
							                 $startDate->copy()->addYear()->format('F j, Y'));
					                 } elseif ($state === 'institutional') {
						                 $set('membership_end_date',
							                 $startDate->copy()->addYears(5)->format('F j, Y'));
					                 } elseif ($state === 'lifetime') {
						                 $set('membership_end_date',
							                 $startDate->copy()->addYears(20)->format('F j, Y'));
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
				             ->rule('not_in:none') // Prevents submission if "None" is selected
				             ->placeholder('Select membership type')
				             ->helperText('Select a valid membership type (cannot be "None")')
				             ->afterStateUpdated(function ($state, $set, $get) {
					             if (!$get('membership_start_date')) {
						             return;
					             }
					             
					             $startDate = Carbon::parse($get('membership_start_date'));
					             
					             if ($state === 'annual') {
						             $set('membership_end_date',
							             $startDate->copy()->addYear()->format('F j, Y'));
					             } elseif ($state === 'institutional') {
						             $set('membership_end_date',
							             $startDate->copy()->addYears(5)->format('F j, Y'));
					             } elseif ($state === 'lifetime') {
						             $set('membership_end_date',
							             $startDate->copy()->addYears(20)->format('F j, Y'));
					             }
				             }),
				       
				       
				       TextInput::make('membership_end_date')
				                ->label('Membership End Date')
				                ->placeholder('Auto-calculated based on membership type')
				                ->formatStateUsing(fn($state) => $state ? Carbon::parse($state)
				                                                                ->format('F j, Y') : null)
				                ->helperText('This field is auto-generated based on membership type and start date'),
			       
			       ]),
			
			// Role Information Section
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
				             ->required(),
			       ]),
		]);
	}
	
	public static function table(Table $table) : Table
	{
		return $table
			->columns([
				TextColumn::make('id')->sortable(),
				TextColumn::make('name')->searchable()->sortable(),
				TextColumn::make('email'),
				IconColumn::make('payment_verified')
				          ->boolean()
				          ->trueIcon('heroicon-o-check-badge')
				          ->falseIcon('heroicon-o-x-mark')
				          ->sortable(),
				TextColumn::make('role')->sortable(),
			])
			->defaultSort('name')
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

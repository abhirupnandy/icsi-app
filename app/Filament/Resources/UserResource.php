<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Mail\PaymentVerifiedMail;
use App\Models\User;
use App\Notifications\PaymentVerified;
use Filament\Forms;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
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
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-s-users';
	
	public static function form(Form $form): Form
	{
		return $form
			->schema([
				Section::make('Personal Information')
				       ->aside()
					   ->description('Personal Information of User')
				       ->schema([
					       TextInput::make('name')
					                ->label('Name')
					                ->placeholder('Enter name of user')
					                ->required(),
					       TextInput::make('email')
					                ->label('Email')
					                ->email()
					                ->placeholder('Enter email of user')
					                ->required(),
					       PhoneInput::make('phone')
					                 ->label('Phone')
					                 ->defaultCountry('IN')
					                 ->initialCountry('IN')
					                 ->displayNumberFormat(PhoneInputNumberType::NATIONAL)
					                 ->placeholder('Enter phone of user')
					                 ->required(),
				       ]),
				Section::make('Account Status')
				       ->aside()
				       ->description('Account Status of User')
				       ->schema([
					       TextInput::make('trans_ID')
					                ->label('Transaction ID')
					                ->placeholder('Enter transaction ID')
					                ->required(),
					       TextInput::make('trans_amount')
					                ->label('Transaction Amount')
					                ->placeholder('Enter transaction amount')
					                ->required(),
					       Toggle::make('payment_verified')
					             ->label('Payment Verified')
					             ->default(false)
						       ->afterStateUpdated(function ($state, $set, $get, $record) {
							       // Get updated values from the form inputs
							       $trans_ID = $get('trans_ID') ?? $record->trans_ID;
							       $trans_amount = $get('trans_amount') ?? $record->trans_amount;
							       
							       // Call the email function with correct transaction details
							       self::sendPaymentVerificationEmail($record, $state, $trans_ID,
								       $trans_amount);
						       })
					             ->required(),
				       
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
					             ->required(),
				       ]),
			]);
	}

    public static function table(Table $table): Table
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
            ->filters([
	            //
            ])
	        ->defaultSort('name')
	        
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
		
    }
	
	/**
	 * Sends an email when the payment status is updated.
	 */
	protected static function sendPaymentVerificationEmail($user, $status, $trans_ID, $trans_amount)
	{
		if ($status) {
			// Convert trans_amount to float to prevent errors
			$trans_amount = is_numeric($trans_amount) ? (float) $trans_amount : 0.00;
			
			// Update user details
			$user->update([
				'payment_verified' => true,
				'trans_ID' => $trans_ID,
				'trans_amount' => $trans_amount,
			]);
			
			$user->refresh(); // Ensure latest values are used
			
			// Send payment verification email
			try {
				$user->notify(new PaymentVerified($user, $trans_ID, $trans_amount));
				\Log::info('Payment verification email sent to '.$user->email);
			} catch (\Exception $e) {
				\Log::error('Email sending failed: '.$e->getMessage());
			}
			
			// Send admin notification
			Notification::make()
			            ->title('✅ Payment Verified')
			            ->success()
				->body("Payment has been successfully verified.<br>User: <strong>{$user->name}</strong> <br>Email: <strong>{$user->email}</strong><br>Transaction ID: <strong>{$user->trans_ID}</strong><br>Amount: <strong>₹".number_format($user->trans_amount,
						2).'</strong>')
			            ->send();
		} else {
			// If payment verification is revoked
			$user->update([
				'payment_verified' => false,
				'trans_ID' => null,
				'trans_amount' => null,
			]);
			
			$user->refresh(); // Get latest data
			
			Notification::make()
			            ->title('❌ Payment Revoked')
			            ->danger()
				->body("Payment verification has been revoked.<br>User: <strong>{$user->name}</strong> <br>Email: <strong>{$user->email}</strong>")
			            ->send();
		}
	}
	
}

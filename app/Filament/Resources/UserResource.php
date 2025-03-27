<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Mail\PaymentVerifiedMail;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
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
					       Toggle::make('payment_verified')
					             ->label('Payment Verified')
					             ->default(false)
					             ->afterStateUpdated(fn ($state, $set, $get, $record) => self::sendPaymentVerificationEmail($record, $state))
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
            ])
            ->filters([
                
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
	protected static function sendPaymentVerificationEmail($user, $status)
	{
		if ($status) {
			// Send payment verification email
			try {
				\Mail::to($user->email)->send(new \App\Mail\PaymentVerifiedMail($user));
				\Log::info('Payment verification email sent to ' . $user->email);
			} catch (\Exception $e) {
				\Log::error('Email sending failed: ' . $e->getMessage());
			}
			
			// Send admin notification
			Notification::make()
			            ->title('✅ Payment Verified')
			            ->success()
			            ->body("Payment has been successfully verified.<br>User: <strong>{$user->name}</strong> <br>Email:<strong> {$user->email}</strong>")
			            ->send();
		} else {
			// Send notification if payment is revoked
			Notification::make()
			            ->title('❌ Payment Revoked')
			            ->danger()
			            ->body("Payment verification has been revoked.<br>User: <strong>{$user->name}</strong> <br>Email:<strong> {$user->email}</strong>")
			            ->send();
		}
	}
	
	
	
	
	
	
}

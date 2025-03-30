<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use App\Notifications\NewAccount;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CreateUser extends CreateRecord
{
	protected static string $resource = UserResource::class;
	
	protected string $password;
	
	protected function mutateFormDataBeforeCreate(array $data) : array
	{
		$this->password = Str::password(12); // Generate a default password
		$data['password'] = bcrypt($this->password);
		$data['force_renew_password'] = true; // Force password reset on next login
		
		return $data;
	}
	
	protected function handleRecordCreation(array $data) : Model
	{
		/** @var User $user */
		$user = parent::handleRecordCreation($data); // Create the user
		
		// Notify user with account details
		$user->notify(new NewAccount($this->password));
		
		// If payment is verified at creation, send payment verification email
		if (!empty($data['payment_verified']) && $data['payment_verified'] === true) {
			$user->sendPaymentVerificationEmail(
				true,
				$data['trans_ID'] ?? null,
				$data['trans_amount'] ?? null,
				$data['trans_date'] ?? null
			);
		}
		
		return $user;
	}
}

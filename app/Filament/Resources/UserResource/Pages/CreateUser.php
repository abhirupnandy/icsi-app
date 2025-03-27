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
		$this->password = Str::password(12); // generate a default password with length of 12 caracters
		$data['password'] = bcrypt($this->password);
		$data['force_renew_password'] = true; // to force user to renew password on next login
		
		return $data;
	}
	
	protected function handleRecordCreation(array $data) : Model
	{
		/** @var User $user */
		$user = parent::handleRecordCreation($data); // handle the creation of the new user
		
		$user->notify(new NewAccount($this->password)); // notify the new user with account details
		
		return $user;
	}
}

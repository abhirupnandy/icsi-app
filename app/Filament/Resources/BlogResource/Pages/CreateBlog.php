<?php

namespace App\Filament\Resources\BlogResource\Pages;

use App\Filament\Resources\BlogResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateBlog extends CreateRecord
{
	protected static string $resource = BlogResource::class;
	
	protected function mutateFormDataBeforeCreate(array $data) : array
	{
		$data['user_id'] = Auth::id(); // Set user ID to the authenticated user
		return $data;
	}
}

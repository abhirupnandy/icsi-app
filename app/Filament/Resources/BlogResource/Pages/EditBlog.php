<?php

namespace App\Filament\Resources\BlogResource\Pages;

use App\Filament\Resources\BlogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditBlog extends EditRecord
{
	protected static string $resource = BlogResource::class;
	
	protected function getHeaderActions() : array
	{
		return [
			Actions\DeleteAction::make(),
		];
	}
	
	protected function mutateFormDataBeforeSave(array $data) : array
	{
		$record = $this->getRecord();
		$data['user_id'] = $record->user_id; // Preserve original author ID
		return $data;
	}
}

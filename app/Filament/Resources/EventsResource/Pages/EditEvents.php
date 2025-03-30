<?php

namespace App\Filament\Resources\EventsResource\Pages;

use App\Filament\Resources\EventsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEvents extends EditRecord
{
	protected static string $resource = EventsResource::class;
	
	protected function mutateFormDataBeforeSave(array $data) : array
	{
		// Prevent slug from changing unless the user manually modifies it
		if (!isset($data['slug']) || empty($data['slug'])) {
			$data['slug'] = $this->record->slug;
		}
		
		return $data;
	}
	
	protected function getHeaderActions() : array
	{
		return [
			Actions\DeleteAction::make(),
		];
	}
}

<?php

namespace App\Filament\Resources\EventsResource\Pages;

use App\Filament\Resources\EventsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateEvents extends CreateRecord
{
	protected static string $resource = EventsResource::class;
	
	protected function mutateFormDataBeforeCreate(array $data) : array
	{
		// Generate slug if the user has not provided one
		if (!isset($data['slug']) || empty($data['slug'])) {
			$data['slug'] = Str::slug(implode(' ',
				array_slice(explode(' ', $data['title']), 0, 5)));
		}
		
		return $data;
	}
}

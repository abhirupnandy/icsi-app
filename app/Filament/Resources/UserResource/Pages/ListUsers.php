<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Filament\Widgets\BoardRolesWidget;
use App\Filament\Widgets\UserStats;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
	
	protected function getHeaderWidgets() : array
	{
		return [
			UserStats::class,
			BoardRolesWidget::class,
		];
	}
	
	protected function getFooterWidgets() : array
	{
		return [
		
		];
	}
}

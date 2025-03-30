<?php

namespace App\Filament\Resources\BlogResource\Pages;

use App\Filament\Resources\BlogResource;
use App\Filament\Widgets\StatsOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ListBlogs extends ListRecords
{
	protected static string $resource = BlogResource::class;
	
	protected function getHeaderActions() : array
	{
		return [
			Actions\CreateAction::make(),
		];
	}
	
	protected function getHeaderWidgets() : array
	{
		return [
			StatsOverview::class,
		];
	}
}

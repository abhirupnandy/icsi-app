<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EventStats extends BaseWidget
{
	protected static ?string $pollingInterval = '10s';
	
	protected function getStats() : array
	{
		return [
			// Upcoming and Past Events
			Stat::make('Upcoming Events',
				\App\Models\Events::where('event_date', '>=', now())->count())
			    ->label('Upcoming Events')
			    ->value(\App\Models\Events::where('event_date', '>=', now())->count())
			    ->description('Total number of upcoming events')
			    ->icon('heroicon-o-calendar')
			    ->color('success')
			    ->url(\App\Filament\Resources\EventsResource::getUrl('index',
				    ['tableFilters' => ['event_date' => ['value' => '>=']]])),
			
			Stat::make('Past Events', \App\Models\Events::where('event_date', '<', now())->count())
			    ->label('Past Events')
			    ->value(\App\Models\Events::where('event_date', '<', now())->count())
			    ->description('Total number of past events')
			    ->icon('heroicon-o-calendar')
			    ->color('danger')
			    ->url(\App\Filament\Resources\EventsResource::getUrl('index',
				    ['tableFilters' => ['event_date' => ['value' => '<']]])),
		
		];
	}
}

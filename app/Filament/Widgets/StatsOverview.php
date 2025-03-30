<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\BlogResource;
use App\Models\Blog;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
	
	protected static ?string $pollingInterval = '10s';
	
	protected function getStats() : array
	{
		return [
			Stat::make('Total Blogs', Blog::count())
			    ->label('Total Blogs')
			    ->value(Blog::count()) // Replace with dynamic value
			    ->description('Total number of blogs.')
			    ->icon('heroicon-o-document-text'),
			
			Stat::make('Published Blogs', Blog::where('published', true)->count())
			    ->label('Published Blogs')
			    ->value(Blog::where('published', true)->count()) // Replace with dynamic value
			    ->description('Total number of blogs published')
			    ->icon('heroicon-o-check-circle')
			    ->color('success')
			    ->url(BlogResource::getUrl('index',
				    ['tableFilters' => ['published' => ['value' => '1']]])),
		
		];
	}
}

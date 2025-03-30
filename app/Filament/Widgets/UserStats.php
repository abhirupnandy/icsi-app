<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class UserStats extends BaseWidget
{
	protected static ?string $pollingInterval = '10s';
	
	protected function getStats() : array
	{
		$stats = [
			Stat::make('Board Member Count', User::where('role', 'board')->count())
			    ->label('Board Member Count')
			    ->value(User::where('role', 'board')->count())
			    ->description('Total number of board members')
			    ->icon('heroicon-o-user-group')
			    ->color('primary')
			    ->url(UserResource::getUrl('index',
				    ['tableFilters' => ['role' => ['value' => 'board']]])),
			
			Stat::make('Member Count',
				User::where('role', 'member')->where('payment_verified', true)->count())
			    ->label('Member Count')
			    ->value(User::where('role', 'member')->where('payment_verified', true)->count())
			    ->description('Total number of verified members')
			    ->icon('heroicon-o-users')
			    ->color('success')
			    ->url(UserResource::getUrl('index',
				    ['tableFilters' => ['role' => ['value' => 'member']]])),
		];
		
		if (Auth::user()?->role === 'admin' || Auth::user()?->role === 'board') {
			$stats[] = Stat::make('Non-Paid Users', User::where('payment_verified', false)->count())
			               ->label('Non-Paid Users')
			               ->value(User::where('payment_verified', false)->count())
			               ->description('Total number of non-paid users')
			               ->icon('heroicon-o-exclamation-circle')
			               ->color('danger')
			               ->url(UserResource::getUrl('index',
				               ['tableFilters' => ['payment_verified' => ['value' => '0']]]));
		}
		
		return $stats;
	}
}
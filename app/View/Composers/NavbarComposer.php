<?php

namespace App\View\Composers;

use Filament\Facades\Filament;
use Illuminate\View\View;

// Correct import

class NavbarComposer
{
	public function compose(View $view) // Type hint should be Illuminate\View\View
	{
		$navItems = [
			[
				'title' => 'Home',
				'route' => 'home',
				'active' => request()->routeIs('home'),
			],
			[
				'title' => 'About',
				'route' => 'about',
				'active' => request()->routeIs('about'),
			],
			[
				'title' => 'Contact',
				'route' => 'contact',
				'active' => request()->routeIs('contact'),
			],
		];
		
		$userDropdownItems = Filament::auth()->check() ? [
			[
				'title' => 'Dashboard',
				'route' => 'filament.admin.pages.dashboard',
			],
			[
				'title' => 'Your Profile',
				'route' => 'filament.admin.profile',
			],
			[
				'title' => 'Sign out',
				'route' => 'filament.admin.logout',
			],
		] : [];
		
		$view->with([
			'navItems' => $navItems,
			'userDropdownItems' => $userDropdownItems,
			'user' => Filament::auth()->user(),
		]);
	}
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Filament\Facades\Filament;

class NavbarController extends Controller
{
	public function index()
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
			[
				'title' => 'Blog',
				'route' => 'blog.index',
				'active' => request()->routeIs('blog.*'),
			],
			[
				'title' => 'Events',
				'route' => 'events.index',
				'active' => request()->routeIs('events.*'),
			],
			[
				'title' => 'Membership',
				'route' => 'membership',
				'active' => request()->routeIs('membership'),
			],
			[
				'title' => 'Research',
				'route' => 'research',
				'active' => request()->routeIs('research'),
			],
			[
				'title' => 'Login',
				'route' => 'filament.admin.auth.login',
				'active' => request()->routeIs('filament.*'),
			],
		];
		
		return view('components.layouts.navbar', [
			'navItems' => $navItems,
			'user' => Filament::auth()->user(),
		]);
	}
}
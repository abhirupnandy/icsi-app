<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Category;
use App\Policies\BlogPolicy;
use App\Policies\CategoryPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The policy mappings for the application.
	 *
	 * @var array<class-string, class-string>
	 */
	protected $policies = [
		Blog::class => BlogPolicy::class,
		Category::class => CategoryPolicy::class,
	];
	
	/**
	 * Register any authentication / authorization services.
	 */
	public function boot() : void
	{
		$this->registerPolicies();
	}
}
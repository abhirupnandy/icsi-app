<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Category;
use App\Observers\BlogObserver;
use App\Policies\BlogPolicy;
use App\Policies\CategoryPolicy;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	
	
	/**
     * Register any application services.
     */
    public function register(): void
    {
        //
	    // register AuthServiceProvider
	    $this->app->register(AuthServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
	    //
	    Blog::observe(BlogObserver::class);
    }
}

<?php

namespace App\Providers;

use App\Http\Controllers\NavbarController;
use App\Models\Blog;
use App\Models\Category;
use App\Observers\BlogObserver;
use App\Policies\BlogPolicy;
use App\Policies\CategoryPolicy;
use App\View\Composers\NavbarComposer;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\View;
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
	    //	    Blog::observe(BlogObserver::class);
	    
	    // Register the NavbarComposer for the navbar view
	    View::composer('components.layouts.app', function ($view) {
		    $navbarController = new NavbarController();
		    $navbarData = $navbarController->index()->getData();
		    $view->with($navbarData);
	    });
    }
}

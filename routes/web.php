<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResearchController;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;


RateLimiter::for('contact-form', function (Request $request) {
	return Limit::perMinute(5); // Allow 5 submissions per minute
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact',
	[ContactController::class, 'submitForm'])->middleware('throttle:contact-form')
     ->name('contact.submit');


Route::get('/membership', function () {
	return view('membership');
})->name('membership');

Route::get('/research', [ResearchController::class, 'index'])->name('research');

// Blog routes
Route::get('/blogs', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Event routes
Route::get('/events', [EventsController::class, 'index'])->name('events.index');
Route::get('/events/{slug}', [EventsController::class, 'show'])->name('events.show');

// Authentication redirect
Route::get('/login', function () {
	return redirect()->route('filament.admin.auth.login');
})->name('login');
<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Events;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
	/**
	 * Show the homepage with recent events and latest blogs.
	 */
	public function index()
	{
		// Fetch the latest 3 events (upcoming or past) sorted by event date
		$recentEvents = Events::select('id', 'title', 'description', 'slug', 'event_date',
			'thumbnail', 'location')
		                      ->orderBy('event_date', 'desc')
		                      ->take(3)
		                      ->get();
		
		// Fetch the latest 3 published blogs
		$blogs = Blog::published()
		             ->select('id', 'title', 'slug', 'published_at', 'thumbnail')
		             ->orderBy('published_at', 'desc')
		             ->take(3)
		             ->get();
		
		// SEO Meta Data
		$metaTitle = 'Welcome to '.config('app.name').' - Latest Events & Blogs';
		$metaDescription = 'Stay updated with our latest events, insightful blog posts, and community updates.';
		$metaKeywords = 'Events, Blogs, News, '.config('app.name');
		
		return view('home',
			compact('recentEvents', 'blogs', 'metaTitle', 'metaDescription', 'metaKeywords'));
	}
}

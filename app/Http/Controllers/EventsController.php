<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventsController extends Controller
{
	/**
	 * Display a listing of the events.
	 */
	public function index()
	{
		$today = Carbon::today();
		
		// Fetch upcoming events with pagination
		$upcomingEvents = Events::select('id', 'title', 'description', 'slug', 'event_date',
			'thumbnail', 'location')
		                        ->where('event_date', '>=', $today)
		                        ->orderBy('event_date', 'asc')
		                        ->paginate(6);
		
		// Fetch past events with pagination
		$pastEvents = Events::select('id', 'title', 'description', 'slug', 'event_date',
			'thumbnail', 'location')
		                    ->where('event_date', '<', $today)
		                    ->orderBy('event_date', 'desc')
		                    ->paginate(6);
		
		// SEO Meta Data
		$metaTitle = 'Upcoming & Past Events - '.config('app.name');
		$metaDescription = 'Stay updated with our latest and past events. Explore upcoming conferences, workshops, and meetups.';
		$metaKeywords = 'Events, Conferences, Workshops, Meetups, '.config('app.name');
		
		return view('events.index',
			compact('upcomingEvents', 'pastEvents', 'metaTitle', 'metaDescription',
				'metaKeywords'));
	}
	
	/**
	 * Display a single event.
	 */
	public function show($slug)
	{
		// Find event by slug (SEO-friendly)
		$event = Events::where('slug', $slug)->firstOrFail();
		
		// Fetch related events (excluding the current event)
		$relatedEvents = Events::where('id', '!=', $event->id)
		                       ->where('event_date', '>=', Carbon::today())
		                       ->orderBy('event_date', 'asc')
		                       ->limit(3)
		                       ->get();
		
		// SEO Meta Data
		$metaTitle = $event->title.' - '.config('app.name');
		$metaDescription = substr(strip_tags($event->description), 0, 150);
		$metaKeywords = 'Event, '.$event->title.', '.config('app.name');
		
		return view('events.show',
			compact('event', 'relatedEvents', 'metaTitle', 'metaDescription', 'metaKeywords'));
	}
}

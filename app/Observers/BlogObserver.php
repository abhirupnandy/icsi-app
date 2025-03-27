<?php

namespace App\Observers;

use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogObserver
{
	/**
	 * Handle the Blog "creating" event.
	 */
	public function creating(Blog $blog) : void
	{
		if (Auth::check()) {
			$blog->user_id = Auth::id();
		}
	}
	
	/**
	 * Handle the Blog "updating" event.
	 */
	public function updating(Blog $blog) : void
	{
		// Delete old image files if they’ve changed
		if ($blog->isDirty('thumbnail') && $blog->getOriginal('thumbnail')) {
			Storage::disk('public')->delete($blog->getOriginal('thumbnail'));
		}
		if ($blog->isDirty('og_image') && $blog->getOriginal('og_image')) {
			Storage::disk('public')->delete($blog->getOriginal('og_image'));
		}
		
		// Admin and board can override user_id, others cannot
		if (Auth::check() && !in_array(Auth::user()->role, ['admin', 'board'])) {
			$blog->user_id = $blog->getOriginal('user_id');
		}
	}
	
	/**
	 * Handle the Blog "created" event.
	 */
	public function created(Blog $blog) : void
	{
		//
	}
	
	/**
	 * Handle the Blog "updated" event.
	 */
	public function updated(Blog $blog) : void
	{
		//
	}
	
	/**
	 * Handle the Blog "deleted" event.
	 */
	public function deleted(Blog $blog) : void
	{
		if ($blog->thumbnail) {
			Storage::disk('public')->delete($blog->thumbnail);
		}
		if ($blog->og_image) {
			Storage::disk('public')->delete($blog->og_image);
		}
	}
	
	/**
	 * Handle the Blog "restored" event.
	 */
	public function restored(Blog $blog) : void
	{
		//
	}
	
	/**
	 * Handle the Blog "forceDeleted" event.
	 */
	public function forceDeleted(Blog $blog) : void
	{
		//
	}
}
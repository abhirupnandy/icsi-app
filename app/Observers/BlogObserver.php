<?php

namespace App\Observers;

use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogObserver
{
	public function creating(Blog $blog) : void
	{
		if (Auth::check()) {
			$blog->user_id = Auth::id(); // Sets to current user's ID
		}
	}
	
	public function updating(Blog $blog) : void
	{
		if ($blog->isDirty('thumbnail') && $blog->getOriginal('thumbnail')) {
			Storage::disk('public')->delete($blog->getOriginal('thumbnail'));
		}
		if ($blog->isDirty('og_image') && $blog->getOriginal('og_image')) {
			Storage::disk('public')->delete($blog->getOriginal('og_image'));
		}
		
		if (Auth::check() && !in_array(Auth::user()->role, ['admin', 'board'])) {
			$blog->user_id = $blog->getOriginal('user_id'); // Prevents change for member
		}
	}
	
	public function deleted(Blog $blog) : void
	{
		if ($blog->thumbnail) {
			Storage::disk('public')->delete($blog->thumbnail);
		}
		if ($blog->og_image) {
			Storage::disk('public')->delete($blog->og_image);
		}
	}
}
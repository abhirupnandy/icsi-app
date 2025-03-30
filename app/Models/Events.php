<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

// At top of Events.php
use Illuminate\Support\Str;

class Events extends Model
{
	use HasFactory;
	
	protected $fillable = [
		'title',
		'description',
		'content',
		'event_date',
		'location',
		'slug',
		'thumbnail',
	];
	
	/**
	 * Automatically generate a slug on create, but allow manual override.
	 */
	protected static function boot()
	{
		parent::boot();
		
		static::creating(function ($event) {
			if (empty($event->slug)) {
				$event->slug = static::generateUniqueSlug($event->title);
			}
		});
		
		static::updating(function ($event) {
			// Do not change slug if it was manually set before
			if ($event->isDirty('title') && !$event->isDirty('slug')) {
				$event->slug = static::generateUniqueSlug($event->title);
			}
		});
	}
	
	/**
	 * Generate a unique slug based on title.
	 */
	public static function generateUniqueSlug($title)
	{
		$slug = Str::slug(implode('-', array_slice(explode(' ', $title), 0, 5)));
		
		// Check for uniqueness
		$count = static::where('slug', 'LIKE', $slug.'%')->count();
		return $count > 0 ? "{$slug}-{$count}" : $slug;
	}
	
	// Accessor for thumbnail URL
	// In Events.php model
	public function getThumbnailUrlAttribute()
	{
		return $this->thumbnail ? Storage::url($this->thumbnail) : null;
	}
}

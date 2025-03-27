<?php

namespace App\Models;

use Database\Factories\BlogFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
	/** @use HasFactory<BlogFactory> */
	use HasFactory;
	
	protected $fillable = [
		'thumbnail', 'title', 'slug', 'content', 'category_id', 'user_id', 'tags', 'published',
		'published_at',
		'seo_title', 'meta_description', 'focus_keyword', 'seo_slug', 'og_title', 'og_description',
		'thumbnail_alt',
	];
	
	//	casts array for tags json
	protected $casts = [
		'tags' => 'array',
	];
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	public function category()
	{
		return $this->belongsTo(Category::class);
	}
	
	// Accessor for thumbnail URL
	public function getThumbnailUrlAttribute()
	{
		return $this->thumbnail ? Storage::url($this->thumbnail) : null;
	}
	
	// Accessor for OG image URL
	public function getOgImageUrlAttribute()
	{
		return $this->og_image ? Storage::url($this->og_image) : null;
	}
}

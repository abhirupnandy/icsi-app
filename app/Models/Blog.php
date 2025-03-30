<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
	use HasFactory;
	
	protected $fillable = [
		'thumbnail', 'title', 'slug', 'content', 'category_id', 'user_id', 'tags', 'published',
		'published_at', 'seo_title', 'meta_description', 'focus_keyword', 'seo_slug',
		'og_title', 'og_description', 'thumbnail_alt',
	];
	
	protected $casts = [
		'tags' => 'array',
	];
	
	// Define relationship with User model
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	// Define relationship with Category model
	public function category()
	{
		return $this->belongsTo(Category::class);
	}
	
	// Query scope to fetch only published blogs
	public function scopePublished($query)
	{
		return $query->where('published', true);
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

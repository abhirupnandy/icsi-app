<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
	/**
	 * Display a listing of published blogs with pagination.
	 */
	public function index()
	{
		$blogs = Blog::where('published', true)
		             ->with(['category:id,name', 'user:id,name'])
		             ->latest('published_at')
		             ->paginate(9); // Adjust as needed
		
		return view('blogs.index', compact('blogs'));
	}
	
	/**
	 * Display a single blog post along with related blogs.
	 */
	public function show($slug)
	{
		$blog = Blog::where('slug', $slug)
		            ->where('published', true)
		            ->with(['category:id,name', 'user:id,name'])
		            ->firstOrFail();
		
		// Fetch related blogs (excluding the current blog)
		$relatedBlogs = Blog::where('category_id', $blog->category_id)
		                    ->where('id', '!=', $blog->id)
		                    ->where('published', true)
		                    ->latest('published_at')
		                    ->take(3)
		                    ->get();
		
		return view('blogs.show', compact('blog', 'relatedBlogs'));
	}
}

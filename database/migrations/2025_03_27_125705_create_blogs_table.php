<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up() : void
	{
		Schema::create('blogs', function (Blueprint $table) {
			$table->id(); // Primary key, not nullable
			$table->string('thumbnail')->nullable(); // Optional thumbnail
			$table->string('title'); // Required title
			$table->string('slug')->unique(); // Required unique slug
			$table->text('content'); // Required content
			$table->foreignId('category_id')
			      ->constrained('categories') // Explicitly specify table name
			      ->cascadeOnDelete(); // Delete blog if category is deleted
			$table->foreignId('user_id')
			      ->nullable() // Optional author
			      ->constrained('users') // References users table
			      ->nullOnDelete(); // Set to NULL if user is deleted
			$table->json('tags')->nullable(); // Optional tags
			$table->boolean('published')->default(false); // Required status with default
			$table->dateTime('published_at')->nullable(); // Optional publication date
			
			// SEO Fields
			$table->string('seo_title', 70)->nullable(); // Optional SEO title
			$table->string('meta_description', 160)->nullable(); // Optional meta description
			$table->string('focus_keyword')->nullable(); // Optional focus keyword
			$table->string('seo_slug')->nullable()->unique(); // Optional unique SEO slug
			$table->string('og_title')->nullable(); // Optional Open Graph title
			$table->string('og_description')->nullable(); // Optional Open Graph description
			$table->string('thumbnail_alt')->nullable(); // Optional alt text
			
			$table->softDeletes(); // deleted_at, not nullable
			$table->timestamps(); // created_at and updated_at, not nullable
		});
	}
	
	/**
	 * Reverse the migrations.
	 */
	public function down() : void
	{
		// Drop foreign key constraints first to avoid dependency issues
		Schema::table('blogs', function (Blueprint $table) {
			$table->dropForeign(['category_id']);
			$table->dropForeign(['user_id']);
		});
		
		// Then drop the table
		Schema::dropIfExists('blogs');
	}
};
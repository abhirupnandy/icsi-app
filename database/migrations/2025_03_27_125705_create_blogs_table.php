<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
	public function up() : void
	{
		Schema::create('blogs', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->string('slug')->unique();
			$table->unsignedBigInteger('category_id');
			$table->unsignedBigInteger('user_id'); // Must be integer
			$table->text('content');
			$table->string('thumbnail')->nullable();
			$table->string('thumbnail_alt')->nullable();
			$table->string('seo_title')->nullable();
			$table->string('meta_description')->nullable();
			$table->string('focus_keyword')->nullable();
			$table->string('seo_slug')->nullable();
			$table->string('og_title')->nullable();
			$table->string('og_description')->nullable();
			$table->string('og_image')->nullable();
			$table->json('tags')->nullable();
			$table->boolean('published')->default(false);
			$table->timestamp('published_at')->nullable();
			$table->timestamps();
			
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}
	
	public function down() : void
	{
		Schema::dropIfExists('blogs');
	}
}
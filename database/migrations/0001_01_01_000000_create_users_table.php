<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
	    Schema::create('users', function (Blueprint $table) {
		    $table->id();
		    $table->string('name');
		    $table->string('email')->unique();
		    $table->timestamp('email_verified_at')->nullable();
		    $table->string('password');
		    $table->string('phone')->nullable()->default(null);
		    $table->boolean('payment_verified')->default(false);
		    
		    // Role-related fields
		    $table->enum('role', ['admin', 'board', 'member'])->default('member');
		    $table->enum('board_member_role', [
			    'president',
			    'vice_president',
			    'general_secretary',
			    'joint_secretary',
			    'treasurer',
			    'executive_committee',
			    'former_president',
			    'former_general_secretary',
			    'former_vice_president',
		    ])->nullable()->default(null);
		    
		    // Additional user details
		    $table->text('bio')->nullable()->default(null);
		    $table->string('orcid_id')->nullable()->default(null)->unique();
		    $table->string('scholar_url')->nullable()->default(null)->unique();
		    $table->string('website_url')->nullable()->default(null);
		    
		    // Transaction details
		    $table->string('trans_ID')->nullable()->default(null);
		    $table->string('trans_amount')->nullable()->default(null);
		    $table->string('trans_date')->nullable()->default(null);
		    
		    // Membership details
		    $table->enum('membership_type',
			    ['lifetime', 'annual', 'institutional'])->nullable()->default(null);
		    $table->string('membership_start_date')->nullable()->default(null);
		    $table->string('membership_end_date')->nullable()->default(null);
		    
		    // Profile details
		    $table->string('avatar')->nullable();
		    
		    $table->rememberToken();
		    $table->timestamps();
	    });
	    
	    
	    Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};

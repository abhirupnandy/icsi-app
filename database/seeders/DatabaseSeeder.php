<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
		User::factory(10)->create();

        User::factory()->create([
            'name' => 'Abhirup ADMIN',
            'email' => 'abhirupnandy.rocks@gmail.com',
	        'password' => bcrypt('password'),
	        'phone' => '1234567890',
	        'payment_verified' => true,
	        'role' => 'admin',
        
        ]);
		
		User::factory()->create([
			'name' => 'Abhirup BOARD',
			'email' => 'test.board@example.com',
			'password' => bcrypt('password'),
			'phone' => '1234567890',
			'payment_verified' => true,
			'role' => 'board',
		
		]);
		
		User::factory()->create([
			'name' => 'Abhirup MEMBER',
			'email' => 'test.member@example.com',
			'password' => bcrypt('password'),
			'phone' => '1234567890',
			'payment_verified' => true,
			'role' => 'member',
		
		]);
    }
}

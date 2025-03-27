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
	        'trans_ID' => '123456',
	        'trans_amount' => 1000,
        ]);
    }
}

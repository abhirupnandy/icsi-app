<?php

namespace Database\Seeders;

use App\Models\Research;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run() : void
	{
		$faker = Faker::create();

		// Generate additional random users (non-board)
		User::factory(10)->create();

		// Create exactly one President and one General Secretary
		$requiredBoardRoles = [
			'president',
			'general_secretary',
		];

		foreach ($requiredBoardRoles as $role) {
			User::factory()->create([
				'name' => $faker->name(),
				'email' => strtolower($role).'@example.com',
				'role' => 'board',
				'board_member_role' => $role,
			]);
		}

		// Define other board roles that should have at least one member
		$otherBoardRoles = [
			'vice_president',
			'joint_secretary',
			'treasurer',
			'executive_committee',
			'former_president',
			'former_general_secretary',
			'former_vice_president',
		];

		// Ensure at least one of each board role with fake names
		foreach ($otherBoardRoles as $role) {
			User::factory()->create([
				'name' => $faker->name(),
				'email' => strtolower($role).'@example.com',
				'role' => 'board',
				'board_member_role' => $role,
			]);
		}

		// Create admin and a general member
		$predefinedUsers = [
			[
				'name' => 'Abhirup ADMIN',
				'email' => 'test.admin@example.com',
				'role' => 'admin',
                'password' => bcrypt('password'), // Set a known password for admin
			],
			[
				'name' => 'Abhirup MEMBER',
				'email' => 'test.member@example.com',
				'role' => 'member',
                'password' => bcrypt('password'), // Set a known password for member
			],
            [
                'name' => 'Abhirup Nandy',
                'email' => 'abhirupnandy.online@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('password'), // Set a known password for admin
            ]
		];

		foreach ($predefinedUsers as $userData) {
			$startDate = Carbon::now();
			$endDate = $startDate->copy()->addYears(99); // Lifetime membership

			User::factory()->create(array_merge($userData, [
				'phone' => '1234567890',
				'payment_verified' => true,
				'trans_ID' => strtoupper(Str::random(8)),
				'trans_amount' => 1000,
				'membership_type' => 'lifetime',
				'membership_start_date' => $startDate->format('F d, Y'),
				'membership_end_date' => $endDate->format('F d, Y'),
			]));
		}

		// Seed Research Data
		$projects = [
			[
				'title' => 'Growth of Scientific Periodicals in India (1948-2000)',
				'description' => 'The project was awarded to the Society by the **Indian National Science Academy**, for the period of **2014-2017**. Dr. B K Sen was the principal investigator in this project.',
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'title' => 'Growth of Scientific Societies in India: 1784-1947',
				'description' => 'The project was awarded to the Society by the **Indian National Science Academy**, for the period of **2009-2013**. Dr. B K Sen was the principal investigator in this project.',
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'title' => 'Indian Library and Information Science Abstracts (ILSA) 2006-2010',
				'description' => 'Indian Library and Information Science Abstracts 2006-2010, covering **Indian Library and Information Science Periodicals**, Monographs; Proceedings of Conferences, Seminars, Workshops, etc. published during this period. This volume will be published by **Indian Association of Special Libraries and Information Centres (IASLIC), Kolkata, India**. The work is now published by IASLIC. **Vol. 40-44, 2006-2010, ISSN: 0019-5790**.',
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'title' => 'Max Mueller Bhavan Project - Analyses of Libraries and Sources of Information in India',
				'description' => 'The project was awarded to the Society on **4th October 2002**. In fact, there were **three projects** related to **India, Delhi, and Calcutta**. The Project was completed with **record speed in just five months**.',
				'created_at' => now(),
				'updated_at' => now(),
			],
		];

		// Insert research projects with timestamps
		Research::insert($projects);
	}
}

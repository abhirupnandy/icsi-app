<?php

namespace Database\Seeders;

use App\Models\Research;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run() : void
	{
		// Generate 10 random users
		User::factory(10)->create();
		
		// Predefined users with fixed roles
		$users = [
			[
				'name' => 'Abhirup ADMIN',
				'email' => 'test.admin@example.com',
				'role' => 'admin',
			],
			[
				'name' => 'Abhirup BOARD MEMBER',
				'email' => 'test.board@example.com',
				'role' => 'board',
			],
			[
				'name' => 'Abhirup MEMBER',
				'email' => 'test.member@example.com',
				'role' => 'member',
			],
		];
		
		foreach ($users as $userData) {
			$startDate = Carbon::now();
			$endDate = $startDate->addYears(99); // Lifetime membership
			
			User::factory()->create(array_merge($userData, [
				'password' => bcrypt('password'),
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
			],
			[
				'title' => 'Growth of Scientific Societies in India: 1784-1947',
				'description' => 'The project was awarded to the Society by the **Indian National Science Academy**, for the period of **2009-2013**. Dr. B K Sen was the principal investigator in this project.',
			],
			[
				'title' => 'Indian Library and Information Science Abstracts (ILSA) 2006-2010',
				'description' => 'Indian Library and Information Science Abstracts 2006-2010, covering **Indian Library and Information Science Periodicals**, Monographs; Proceedings of Conferences, Seminars, Workshops, etc. published during this period. This volume will be published by **Indian Association of Special Libraries and Information Centres (IASLIC), Kolkata, India**. The work is now published by IASLIC. **Vol. 40-44, 2006-2010, ISSN: 0019-5790**.',
			],
			[
				'title' => 'Indian Library and Information Science Abstracts (ILSA) 2000-2005',
				'description' => 'Indian Library and Information Science Abstracts 2000-2005, published by **IASLIC**. This volume covers **Indian Library and Information Science Periodicals**; Monographs; Proceedings of Conferences, Seminars, Workshops, etc. published during this period.',
			],
			[
				'title' => 'Indian Library and Information Science Abstracts (ILSA) 1992–1999',
				'description' => 'Indian Library and Information Science Abstracts 1992-1999, published by **IASLIC**. This volume was released in **October 2003**. In all **3215 entries** were included. It covers **Indian Library and Information Science Periodicals**; Monographs; Proceedings of Conferences, Seminars, Workshops, etc. published during this period.',
			],
			[
				'title' => 'Max Mueller Bhavan Project - Analyses of Libraries and Sources of Information in India',
				'description' => 'The project was awarded to the Society on **4th October 2002**. In fact, there were **three projects** related to **India, Delhi, and Calcutta**. The Project was completed with **record speed in just five months**.',
			],
			[
				'title' => 'Annotated Bibliography of Rare Books at the Central Secretariat Library',
				'description' => 'The project was awarded to the Society on **22 January 2003** and was completed in **about three months’ time**. Society annotated **more than 1500 books**.',
			],
			[
				'title' => 'National Forests Commission Report, 2006',
				'description' => 'The Project was awarded to the Society in **January 2006** for the **technical editing and technical writing** of the **Commission Report and its recommendations** (conducted by **ICFRE, Dehra Dun, India**). The Project was completed with **record speed in just two months**.',
			],
		];
		
		// Insert research projects
		Research::insert($projects);
	}
}

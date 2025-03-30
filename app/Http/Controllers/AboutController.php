<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AboutController extends Controller
{
	public function index()
	{
		// Current Leadership (Since January 2025) from the document
		$currentLeadership = [
			(object) [
				'name' => 'Dr. Sujit Bhattacharya', 'role' => 'President',
				'image_url' => 'https://ui-avatars.com/api/?name=Sujit+Bhattacharya&size=150',
			],
			(object) [
				'name' => 'Prof. Vivek Kumar Singh', 'role' => 'Vice President',
				'image_url' => 'https://ui-avatars.com/api/?name=Vivek+Kumar+Singh&size=150',
			],
			(object) [
				'name' => 'Dr. Nabi Hasan', 'role' => 'General Secretary',
				'image_url' => 'https://ui-avatars.com/api/?name=Nabi+Hasan&size=150',
			],
			(object) [
				'name' => 'Dr. Mohit Garg', 'role' => 'Joint Secretary',
				'image_url' => 'https://ui-avatars.com/api/?name=Mohit+Garg&size=150',
			],
			(object) [
				'name' => 'Dr. Anurag Kanaujia', 'role' => 'Joint Secretary',
				'image_url' => 'https://ui-avatars.com/api/?name=Anurag+Kanaujia&size=150',
			],
			(object) [
				'name' => 'Dr. Anup Kumar Das', 'role' => 'Treasurer',
				'image_url' => 'https://ui-avatars.com/api/?name=Anup+Kumar+Das&size=150',
			],
		];
		
		// Executive Committee Members from the document
		$ecMembers = [
			(object) [
				'name' => 'Dr. Prashasti Singh', 'role' => 'E.C. Member',
				'image_url' => 'https://ui-avatars.com/api/?name=Prashasti+Singh&size=150',
			],
			(object) [
				'name' => 'Dr. G. Mahesh', 'role' => 'E.C. Member',
				'image_url' => 'https://ui-avatars.com/api/?name=G+Mahesh&size=150',
			],
			(object) [
				'name' => 'Dr. Usha Mujoo Munshi', 'role' => 'E.C. Member',
				'image_url' => 'https://ui-avatars.com/api/?name=Usha+Mujoo+Munshi&size=150',
			],
			(object) [
				'name' => 'Dr. Bidyarthi Dutta', 'role' => 'E.C. Member',
				'image_url' => 'https://ui-avatars.com/api/?name=Bidyarthi+Dutta&size=150',
			],
		];
		
		// Former Presidents and Secretaries (Till January 2025) from the document
		$pastMembers = [
			(object) [
				'name' => 'Professor B. Guha', 'role' => 'Former President',
				'image_url' => 'https://ui-avatars.com/api/?name=B+Guha&size=150',
			],
			(object) [
				'name' => 'Dr. Usha Mujoo Munshi', 'role' => 'Former President',
				'image_url' => 'https://ui-avatars.com/api/?name=Usha+Mujoo+Munshi&size=150',
			],
			(object) [
				'name' => 'Professor B.K. Sen',
				'role' => 'Former General Secretary & Vice President',
				'image_url' => 'https://ui-avatars.com/api/?name=BK+Sen&size=150',
			],
			(object) [
				'name' => 'Dr. G. Mahesh', 'role' => 'Former General Secretary',
				'image_url' => 'https://ui-avatars.com/api/?name=G+Mahesh&size=150',
			],
			(object) [
				'name' => 'Subhash Biswas', 'role' => 'Former Vice President',
				'image_url' => 'https://ui-avatars.com/api/?name=Subhash+Biswas&size=150',
			],
		];
		
		// Pass data to the about view
		return view('about', compact('currentLeadership', 'ecMembers', 'pastMembers'));
	}
}
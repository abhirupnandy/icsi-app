<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AboutController extends Controller
{
	public function index()
	{
		// Define board roles in order
		$leadershipOrder = [
			'president', 'vice_president', 'general_secretary', 'joint_secretary', 'treasurer',
		];
		$pastRolesOrder = ['former_president', 'former_general_secretary', 'former_vice_president'];
		
		// Fetch current leadership and sort based on predefined order
		$currentLeadership = User::where('role', 'board')
		                         ->whereIn('board_member_role', $leadershipOrder)
		                         ->get(['name', 'board_member_role as role', 'avatar'])
		                         ->sortBy(fn($member) => array_search($member->role,
			                         $leadershipOrder));
		
		// Fetch executive committee members
		$ecMembers = User::where('role', 'board')
		                 ->where('board_member_role', 'executive_committee')
		                 ->get(['name', 'board_member_role as role', 'avatar']);
		
		// Fetch former presidents and secretaries and sort accordingly
		$pastMembers = User::where('role', 'board')
		                   ->whereIn('board_member_role', $pastRolesOrder)
		                   ->get(['name', 'board_member_role as role', 'avatar'])
		                   ->sortBy(fn($member) => array_search($member->role, $pastRolesOrder));
		
		// Process avatars
		foreach ([$currentLeadership, $ecMembers, $pastMembers] as $group) {
			foreach ($group as $member) {
				if (str_starts_with($member->avatar, 'avatars/fake')) {
					$member->avatar = 'https://robohash.org/'.urlencode($member->name).'?set=set2&size=150x150';
				} else {
					$member->avatar = asset('storage/'.$member->avatar);
				}
			}
		}
		
		// Pass data to the about view
		return view('about', compact('currentLeadership', 'ecMembers', 'pastMembers'));
	}
}

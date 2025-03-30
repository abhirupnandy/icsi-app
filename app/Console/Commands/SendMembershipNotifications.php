<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\MembershipExpiredNotification;
use App\Notifications\MembershipExpiryReminder;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendMembershipNotifications extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'membership:send-notifications';
	
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Send notifications for upcoming and expired memberships';
	
	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		$today = Carbon::today();
		
		// Fetch all users
		$users = User::all();
		
		// Expired users (membership_end_date is before today)
		$usersExpired = $users->filter(function ($user) use ($today) {
			return Carbon::parse($user->membership_end_date)->lessThan($today);
		});
		
		// Users whose membership expires today
		$usersExpiringToday = $users->filter(function ($user) use ($today) {
			return Carbon::parse($user->membership_end_date)->equalTo($today);
		});
		
		// Users whose membership expires in 7 days
		$usersExpiringSoon = $users->filter(function ($user) use ($today) {
			return Carbon::parse($user->membership_end_date)->equalTo($today->copy()->addDays(7));
		});
		
		// Send notifications IMMEDIATELY (without queue)
		foreach ($usersExpired as $user) {
			$user->notifyNow(new MembershipExpiredNotification($user, $user->membership_end_date));
		}
		
		foreach ($usersExpiringToday as $user) {
			$user->notifyNow(new MembershipExpiredNotification($user, $user->membership_end_date));
		}
		
		foreach ($usersExpiringSoon as $user) {
			$user->notifyNow(new MembershipExpiryReminder($user, $user->membership_end_date));
		}
		
		$this->info('Membership notifications sent successfully without using queues.');
	}
}

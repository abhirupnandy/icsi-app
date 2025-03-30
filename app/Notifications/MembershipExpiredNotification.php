<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\HtmlString;

class MembershipExpiredNotification extends Notification
{
	use Queueable;
	
	protected object $user;
	public string $user_name;
	protected Carbon $expiry_date;
	
	/**
	 * Create a new notification instance.
	 */
	public function __construct($user, $expiry_date, protected ?Model $tenant = null)
	{
		$this->user = $user;
		$this->user_name = $user->name;
		$this->expiry_date = Carbon::parse($expiry_date);
	}
	
	/**
	 * Get the notification's delivery channels.
	 */
	public function via(object $notifiable) : array
	{
		return ['mail'];
	}
	
	/**
	 * Get the mail representation of the notification.
	 */
	public function toMail(object $notifiable) : MailMessage
	{
		$appUrl = config('app.url'); // Get the base app URL
		$renewalUrl = rtrim($appUrl, '/').'/membership'; // Ensure proper formatting
		
		// Format expiry date as DD-MMMM-YYYY (e.g., 25-March-2025)
		$formattedExpiryDate = $this->expiry_date->format('d-F-Y');
		
		return (new MailMessage)
			->greeting("Dear $this->user_name,")
			->subject('⚠️ Your Membership Has Expired')
			->tag('membership_expired')
			->metadata('category', 'membership')
			->metadata('user_id', $this->user->id)
			->line('We regret to inform you that your membership with our society has **expired today**. We truly value your participation and would love to have you back. ❤️')
			->line(new HtmlString('<strong>📅 Expiry Date:</strong> '.$formattedExpiryDate))
			->line('Don’t miss out on future opportunities! Renew your membership today and continue to be part of our vibrant community.')
			->action('🔄 Renew Membership', $renewalUrl)
			->line('If you have any questions or need assistance, feel free to reach out to us.')
			->line('We hope to see you back soon! 🚀');
	}
	
	/**
	 * Get the array representation of the notification.
	 */
	public function toArray(object $notifiable) : array
	{
		return [
			'user_id' => $this->user->id,
			'expiry_date' => $this->expiry_date->timestamp,
			'timestamp' => now(),
		];
	}
}

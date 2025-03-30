<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\HtmlString;

class MembershipExpiryReminder extends Notification
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
		$appName = config('app.name');
		
		// Ensure correct URL for members section, separate from admin panel
		$appUrl = config('app.url'); // Get the base app URL
		$renewalUrl = rtrim($appUrl, '/').'/membership'; // Ensure proper formatting
		
		// Format expiry date as DD-MMMM-YYYY (e.g., 25-March-2025)
		$formattedExpiryDate = $this->expiry_date->format('d-F-Y');
		
		return (new MailMessage)
			->greeting("Dear $this->user_name,")
			->subject('⏳ Reminder: Your Membership Expires Soon')
			->tag('membership_expiry_reminder')
			->metadata('category', 'membership')
			->metadata('user_id', $this->user->id)
			->line('Your membership with our society is set to expire in **7 days**. We appreciate your contribution and would love to continue this journey with you. 💙')
			->line(new HtmlString('<strong>📅 Expiry Date:</strong> '.$formattedExpiryDate))
			->line('Renew now to continue accessing exclusive events, research collaborations, and networking opportunities.')
			->action('🔄 Renew Membership', $renewalUrl)
			->line('If you have any questions, feel free to contact our support team.')
			->line('We look forward to having you with us for another exciting year! 🚀');
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

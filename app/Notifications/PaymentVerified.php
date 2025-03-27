<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Number;

class PaymentVerified extends Notification
{
	use Queueable;
	
	protected object $user;
	public string $user_name;
	protected string $transID;
	protected string $trans_amount;
	protected Carbon $trans_date;
	
	/**
	 * Create a new notification instance.
	 */
	public function __construct(
		$user,
		$transID,
		$trans_amount,
		$trans_date,
		protected ?Model $tenant = null
	) {
		$this->user = $user;
		$this->user_name = $user->name;
		$this->transID = $transID;
		$this->trans_amount = Number::currency((float) $trans_amount, 'INR');
		
		// Convert and store as timestamp
		$this->trans_date = Carbon::parse($trans_date);
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
		
		// Format date as DD-MMMM-YYYY (e.g., 25-March-2025)
		$formattedDate = $this->trans_date->format('d-F-Y');
		
		return (new MailMessage)
			->greeting("Dear $this->user_name,")
			->subject("Verified – Welcome to $appName!")
			->tag('payment_verified') // Add a mail tag
			->metadata('category', 'payment') // Add metadata for providers like Mailgun
			->metadata('user_id', $this->user->id) // Track user ID
			
			->line('We are pleased to inform you that your payment towards the **Lifetime Membership** of our society has been successfully verified. 🎉')
			->line('Your commitment to our mission means a lot, and we look forward to your active participation in our community.')
			->line(new HtmlString('<strong>📌 Transaction ID:</strong> '.$this->transID))
			->line(new HtmlString('<strong>💰 Amount Paid:</strong> '.$this->trans_amount))
			->line(new HtmlString('<strong>📅 Transaction Date:</strong> '.$formattedDate))
			->line('Thank you for your support! Your membership grants you access to exclusive events, research collaborations, and networking opportunities.')
			->line('We invite you to explore our platform and make the most of your membership benefits.')
			->action('🌐 Access Your Account', filament()->getUrl($this->tenant))
			->line('If you have any questions, feel free to reach out to our support team.')
			->line('Welcome aboard! 🚀');
		
		
	}
	
	/**
	 * Get the array representation of the notification.
	 */
	public function toArray(object $notifiable) : array
	{
		return [
			'user_id' => $this->user->id,
			'transID' => $this->transID,
			'amount' => $this->trans_amount,
			'trans_date' => $this->trans_date->timestamp, // Store as timestamp in DB
			'timestamp' => now(),
		];
	}
}

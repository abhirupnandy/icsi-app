<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class PaymentVerified extends Notification
{
	use Queueable;
	
	protected $user;
	
	/**
	 * Create a new notification instance.
	 */
	public function __construct(
		$user,
		protected ?Model $tenant = null
	) // Accepts $user as a parameter
	{
		//
		$this->user = $user;
	}
	
	/**
	 * Get the notification's delivery channels.
	 *
	 * @return array<int, string>
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
		
		return (new MailMessage)
			->subject("Your payment has been verified on $appName")
			->line('Your payment has been verified successfully.')
			->line('Thank you for your payment.')
			->action('Go to app', filament()->getUrl($this->tenant));
	}
	
	/**
	 * Get the array representation of the notification.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(object $notifiable) : array
	{
		return [
			//
		];
	}
}

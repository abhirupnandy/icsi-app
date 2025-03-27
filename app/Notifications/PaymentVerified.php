<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Number;

class PaymentVerified extends Notification
{
	use Queueable;
	
	protected string $user;
	public string $user_name;
	protected string $transID;
	protected string $trans_amount;
	
	/**
	 * Create a new notification instance.
	 */
	public function __construct(
		$user,
		$transID,
		$trans_amount,
		protected ?Model $tenant = null
	) {
		$this->user = $user;
		$this->user_name = $user->name;
		$this->transID = $transID;
		$this->trans_amount = Number::currency((float) $trans_amount, 'INR');
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
		$date = now()->format('Y-m-d H:i:s');
		
		return (new MailMessage)
			->greeting("Hello, $this->user_name")
			->subject("Your payment has been verified on $appName")
			->line('Your payment has been verified successfully on '.$date.'.') // Use $date
			->line(new HtmlString('<strong>Transaction ID:</strong> '.$this->transID)) // Use $this->transID
			->line(new HtmlString('<strong>Amount:</strong> '.$this->trans_amount))
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

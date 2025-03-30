<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Message;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
	use Queueable, SerializesModels;
	
	public $contactData;
	
	public function __construct(array $formData)
	{
		$this->contactData = [
			'firstName' => $formData['first-name'] ?? '',
			'lastName' => $formData['last-name'] ?? '',
			'email' => $formData['email'] ?? '',
			'phoneNumber' => $formData['phone-number'] ?? 'Not provided',
			'message' => $formData['message'] ?? '',
		];
	}
	
	public function build()
	{
		return $this->view('emails.contact-form')
		            ->with('contactData', $this->contactData)
		            ->subject('Contact Us Form - '.$this->contactData['firstName'].' '.$this->contactData['lastName']);
	}
}
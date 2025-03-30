<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class ContactController extends Controller
{
	
	public function index()
	{
		return view('contact');
	}
	
	
	/**
	 * Handle the contact form submission.
	 *
	 * @param  Request  $request
	 *
	 * @return RedirectResponse
	 */
	public function submitForm(Request $request)
	{
		// Validate the form inputs including CAPTCHA
		$validator = Validator::make($request->all(), [
			'first-name' => 'required|string|max:100',
			'last-name' => 'required|string|max:100',
			'email' => 'required|email|max:255',
			'phone-number' => 'nullable|string|max:20',
			'message' => 'required|string|max:1000',
			'captcha' => 'required|integer', // CAPTCHA validation
		]);
		
		// Check if validation fails
		if ($validator->fails()) {
			return redirect()->back()
			                 ->withErrors($validator)
			                 ->withInput()
			                 ->with('error', 'Validation failed. Please check your inputs.');
		}
		
		// Validate CAPTCHA
		if ($request->input('captcha') != session('captcha_answer')) {
			return redirect()->back()
			                 ->withInput()
			                 ->with('error',
				                 'Incorrect answer to the math challenge. Please try again.');
		}
		
		// Get the contact email from config, with a fallback
		//		$contactEmail = config('services.contact.email', 'admin@icsi.net.in');
		$contactEmail = $request->input('email');
		
		try {
			// Send email
			Mail::to($contactEmail)->send(new ContactFormMail($request->all()));
			
			Mail::to('president@icsi.net.in')->send(new ContactFormMail($request->all()));
			
			// Log the successful submission
			Log::info('Contact form submitted', [
				'email' => $request->input('email'),
				'name' => $request->input('first-name').' '.$request->input('last-name'),
				'sent_to' => $contactEmail,
			]);
			
			return redirect()->back()->with('success', 'Your message has been sent successfully!');
			
		} catch (\Exception $e) {
			// Log any email sending errors
			Log::error('Contact form submission failed', [
				'error' => $e->getMessage(),
				'trace' => $e->getTraceAsString(),
				'email' => $request->input('email'),
				'contact_email' => $contactEmail,
			]);
			
			return redirect()->back()->with('error',
				'An error occurred while sending your message: '.$e->getMessage());
		}
	}
	
}

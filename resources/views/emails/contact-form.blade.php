<!DOCTYPE html>
<html>
<head>
	<title>New Contact Form Submission</title>
	<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            background: #fff;
            padding: 20px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007bff;
            text-align: center;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
	</style>
</head>
<body>
<div class="container">
	<h2>New Contact Form Submission</h2>
	<p><strong>Name:</strong> {{ $contactData['firstName'] }} {{ $contactData['lastName'] }}</p>
	<p><strong>Email:</strong> {{ $contactData['email'] }}</p>
	<p><strong>Phone:</strong> {{ $contactData['phoneNumber'] }}</p>
	<hr>
	<h3>Message:</h3>
	<p>{{ $contactData['message'] }}</p>
	<div class="footer">
		&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
	</div>
	<div class="footer">
		A copy of this message has been sent to - {{ $contactData['email'] }}<br>
	</div>
</div>
</body>
</html>
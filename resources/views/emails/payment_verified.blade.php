<!DOCTYPE html>
<html>
<head>
	<title>Payment Verified</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 8px 8px 0 0;
            font-size: 22px;
            font-weight: bold;
        }
        .footer{
			margin-top: 20px;
			font-size: 14px;
			color: #666;
		}}
        .logo {
            margin-top: 15px;
        }
        .logo img {
            max-width: 150px;
            height: auto;
        }
        .content {
            padding: 20px;
            font-size: 16px;
            color: #333;
            text-align: left;
        }
        /* ✅ Fully Responsive Button */
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            text-align: center;
            transition: 0.3s;
        }
        .button:hover {
            background-color: #45a049;
        }

        /* ✅ Tablet Styles (max-width: 768px) */
        @media screen and (max-width: 768px) {
            .container {
                max-width: 90%;
                padding: 15px;
            }
            .header {
                font-size: 20px;
                padding: 12px;
            }
            .logo img {
                max-width: 120px;
            }
            .content {
                font-size: 15px;
                padding: 15px;
            }
            .button {
                font-size: 15px;
                padding: 12px;
                width: 80%; /* ✅ Fixed: Better fit for tablets */
                display: block;
                margin: 15px auto; /* ✅ Centered */
            }
        }

        /* ✅ Mobile Styles (max-width: 480px) */
        @media screen and (max-width: 480px) {
            .container {
                width: 100%;
                padding: 10px;
                border-radius: 0;
            }
            .header {
                font-size: 18px;
                padding: 10px;
            }
            .logo img {
                max-width: 100px;
            }
            .content {
                font-size: 14px;
                padding: 12px;
            }
            .button {
                font-size: 14px;
                padding: 12px;
                width: 90%; /* ✅ Make button wider */
                display: block;
                text-align: center;
                margin: 20px auto; /* ✅ Center the button */
            }
        }
	</style>
</head>
<body>
<div class="container">
	<!-- ✅ Responsive Logo -->
	<div class="logo">
		<x-app-logo />
	</div>
	
	<div class="header">
		Payment Verified Successfully 🎉
	</div>
	<div class="content">
		<p>Dear <strong>{{ $user->name }}</strong>,</p>
		<p>We are pleased to inform you that your payment has been successfully verified.</p>
		<p>Your membership is now active, and you can enjoy all the benefits.</p>
		
		<!-- ✅ Fully Responsive Button -->
		<a href="{{ url('/admin') }}" class="button">Go to Dashboard</a>
	</div>
	<div class="footer">
		<p>Thank you for being a part of our community!</p>
		<p>&copy; {{ date('Y') }} Information and Communication Society of India (ICSI)</p>
	</div>
</div>
</body>
</html>

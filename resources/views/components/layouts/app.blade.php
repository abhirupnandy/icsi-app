<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ $title ?? 'ICSI' }}</title>
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

{{-- Navbar --}}
@include('components.layouts.navbar')

{{-- Main Content --}}
<main class="container mx-auto mt-4 p-4">
	{{ $slot }}
</main>

{{-- Footer --}}
@include('components.layouts.footer')

</body>
</html>

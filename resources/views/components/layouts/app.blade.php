<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ $title ?? config('app.name') }}</title>
	
	{{-- SEO Meta Tags --}}
	<meta
		name="description"
		content="{{ Str::limit($meta_description ?? 'Welcome to ' . config('app.name') . '. Explore our latest updates and insights.', 160) }}"
	>
	<meta name="author" content="{{ config('app.name') }}">
	<link rel="canonical" href="{{ request()->url() }}">
	<link rel="sitemap" type="application/xml" href="{{ url('sitemap.xml') }}">
	
	{{-- Open Graph --}}
	<meta property="og:title" content="{{ $title ?? config('app.name') }}">
	<meta property="og:description" content="{{ $meta_description ?? 'Explore our latest insights and updates.' }}">
	<meta property="og:url" content="{{ request()->url() }}">
	<meta property="og:type" content="website">
	<meta property="og:image" content="{{ $og_image ?? asset('images/default-og.jpg') }}">
	
	{{-- Twitter Cards --}}
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="{{ $title ?? config('app.name') }}">
	<meta
		name="twitter:description"
		content="{{ $meta_description ?? 'Stay updated with our latest news and articles.' }}"
	>
	<meta name="twitter:image" content="{{ $twitter_image ?? asset('images/default-twitter.jpg') }}">
	
	{{-- Favicon & Apple Touch Icon --}}
	<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
	<link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
	
	{{-- Performance --}}
	<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
	<link rel="preload" href="{{ asset('css/app.css') }}" as="style">
	<link rel="preload" href="{{ asset('js/app.js') }}" as="script">
	
	{{-- Tailwind & AlpineJS --}}
	<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4" defer></script>
	<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
	
	{{-- Styles & Scripts --}}
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<script src="{{ asset('js/app.js') }}" defer></script>
	
	{{-- Additional Head Content --}}
	@stack('head')
	
	{{-- Structured Data --}}
	@yield('structured-data')
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

@include('components.layouts.navbar')

<main class="container mx-auto pt-20 p-4 flex-grow">
	{{ $slot }}
</main>

@include('components.layouts.footer')

</body>
</html>

<x-layouts.app>
	<x-slot:title>Home - Information and Communication Society of India</x-slot:title>
	
	@push('meta')
		<meta
			name="description"
			content="{{ Str::limit('Stay updated with ICSI\'s latest events, insightful research, and knowledge dissemination in information science and technology.', 160) }}"
		>
		<meta name="keywords" content="Scientometrics, Bibliometrics, Research, Information Science, ICSI">
		<meta property="og:title" content="Information and Communication Society of India">
		<meta
			property="og:description"
			content="{{ Str::limit('ICSI fosters collaboration and innovation in the fields of information science, bibliometrics, and technology studies.', 160) }}"
		>
		<meta property="og:image" content="{{ asset('asset/mainLogo.png') }}">
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:title" content="Information and Communication Society of India">
		<meta
			name="twitter:description"
			content="{{ Str::limit('Stay updated with ICSI\'s latest events and research.', 160) }}"
		>
		<meta name="twitter:image" content="{{ asset('asset/mainLogo.png') }}">
	@endpush
	
	@push('head')
		<link rel="preload" href="https://placehold.co/1200x500/FFB6C1/000000" as="image">
	@endpush
	
	<div class="relative isolate overflow-hidden bg-white">
		<!-- Grid Pattern Background -->
		<svg
			class="absolute inset-0 -z-10 size-full stroke-gray-200 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]"
			aria-hidden="true"
		>
			<defs>
				<pattern id="grid-pattern" width="200" height="200" x="50%" y="-1" patternUnits="userSpaceOnUse">
					<path d="M.5 200V.5H200" fill="none"/>
				</pattern>
			</defs>
			<rect width="100%" height="100%" stroke-width="0" fill="url(#grid-pattern)"/>
		</svg>
		
		<!-- Hero Section -->
		<div class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">
			<div class="relative w-full max-w-full mx-auto">
				<!-- Carousel wrapper -->
				<div
					class="overflow-hidden relative rounded-lg lg:h-[600px]" role="region"
					aria-label="Featured Content Carousel"
				>
					<div class="flex transition-transform duration-500 ease-in-out transform opacity-80" id="carousel">
						@php
							$carouselImages = [
								'https://placehold.co/1200x800/orange/yellow',
								'https://placehold.co/1200x800/red/green',
								'https://placehold.co/1200x800/blue/purple',
							];
						@endphp
						
						@foreach ($carouselImages as $index => $image)
							<div class="min-w-full relative h-[400px] sm:h-[500px] lg:h-[600px]">
								<img
									src="{{ $image }}"
									srcset="{{ $image }}?w=600 600w, {{ $image }}?w=1200 1200w"
									sizes="(max-width: 600px) 600px, 1200px"
									alt="Slide {{ $index + 1 }}"
									class="w-full h-full object-cover" loading="lazy"
								>
								<div class="absolute inset-0 bg-gray-200 opacity-50"></div>
							</div>
						@endforeach
					</div>
				</div>
				
				<!-- Floating overlay with text -->
				<div
					class="bg-white bg-opacity-90 p-6 rounded-md text-gray-900 shadow-lg flex flex-col mt-6
                    lg:absolute lg:left-10 lg:top-1/2 lg:-translate-y-1/2 lg:max-w-lg lg:mt-0"
				>
					<x-app-logo/>
					<h1 class="mt-4 text-3xl sm:text-5xl font-semibold">Advancing Research in Scientometrics and
					                                                    Informetrics</h1>
					<p class="mt-4 text-base sm:text-lg">ICSI fosters collaboration and innovation in the fields of
					                                     information science, bibliometrics, and technology studies.
					                                     Join us in shaping the future of research.</p>
					<div class="mt-6 flex items-center gap-x-4">
						<a
							href="{{ route('membership') }}"
							class="rounded-md bg-accent px-4 py-2 text-sm font-semibold text-white hover:bg-blue-500"
							aria-label="Become a Member of ICSI"
						>Become a Member</a>
						<a
							href="{{ route('research') }}" class="text-sm font-semibold text-gray-900"
							aria-label="Explore ICSI Research"
						>Explore Research →</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Structured Data for Homepage -->
	@section('structured-data')
		<script type="application/ld+json">
			{
				"@context": "https://schema.org",
				"@type": "WebPage",
				"name": "Home - Information and Communication Society of India",
				"description": "Stay updated with ICSI's latest events, insightful research, and knowledge dissemination in information science and technology.",
				"url": "{{ request()->url() }}",
			"publisher": {
				"@type": "Organization",
				"name": "Information and Communication Society of India",
				"logo": {
					"@type": "ImageObject",
					"url": "{{ asset('asset/mainLogo.png') }}"
				}
			}
		}
		</script>
	@endsection
	
	<!-- Recent Events Section -->
	<section class="bg-gray-50 py-16">
		<div class="max-w-7xl mx-auto px-6 lg:px-8">
			<h2 class="text-3xl font-semibold text-gray-900 text-center uppercase tracking-wider">Recent Events</h2>
			@if($recentEvents->isEmpty())
				<p class="text-center text-gray-600 mt-6">No events to show.</p>
			@else
				<div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
					@foreach($recentEvents as $event)
						@php $isPastEvent = \Carbon\Carbon::parse($event['event_date'])->isPast(); @endphp
						<div
							class="bg-white p-6 rounded-xl shadow-sm flex flex-col h-auto border border-gray-100 relative"
						>
							<span
								class="absolute top-3 left-3 px-3 py-1 text-xs font-semibold uppercase rounded-full {{ $isPastEvent ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}"
							>
								{{ $isPastEvent ? 'Past Event' : 'Upcoming' }}
							</span>
							<h3 class="text-lg font-semibold text-gray-900 mt-6">{{ $event['title'] }}</h3>
							<p class="mt-2 text-gray-600 text-sm">{{ Str::limit($event['description'], 120) }}</p>
							<div class="mt-auto flex justify-between items-center text-sm text-gray-500">
								<a
									href="{{ route('events.show', $event['slug']) }}" class="text-blue-600 font-medium"
									aria-label="Read more about {{ $event['title'] }}"
								>Read More →</a>
								<span>{{ \Carbon\Carbon::parse($event['event_date'])->format('jS F, Y') }}</span>
							</div>
						</div>
					@endforeach
				</div>
				<!-- Event Structured Data -->
				<script type="application/ld+json">
					[
					@foreach($recentEvents as $event)
					{
						"@context": "https://schema.org",
						"@type": "Event",
						"name": "{{ $event['title'] }}",
						"description": "{{ $event['description'] }}",
						"startDate": "{{ \Carbon\Carbon::parse($event['event_date'])->toIso8601String() }}",
						"eventStatus": "{{ $isPastEvent ? 'EventEnded' : 'EventScheduled' }}",
						"eventAttendanceMode": "https://schema.org/OnlineEventAttendanceMode",
						"location": {
							"@type": "VirtualLocation",
							"url": "{{ route('events.show', $event['slug']) }}"
						},
						"organizer": {
							"@type": "Organization",
							"name": "Information and Communication Society of India",
							"url": "{{ url('/') }}"
						}
					}{{ !$loop->last ? ',' : '' }}
					@endforeach
					]
				</script>
			@endif
		</div>
	</section>
	
	<!-- Blog Section -->
	<section class="bg-white py-16">
		<div class="max-w-7xl mx-auto px-6 lg:px-8">
			<h2 class="text-3xl font-semibold text-gray-900 text-center">Latest Blog Articles</h2>
			@if($blogs->isEmpty())
				<p class="text-center text-gray-600 mt-6">No blogs to show.</p>
			@else
				<div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
					@foreach($blogs as $blog)
						<div class="block rounded-lg shadow-md overflow-hidden">
							<div class="relative h-60 w-full">
								<img
									src="{{ $blog->thumbnail_url }}"
									alt="{{ $blog->title }} Thumbnail"
									class="w-full h-full object-cover"
									loading="lazy"
								>
							</div>
							<div class="p-6 bg-white">
								<h3 class="text-xl font-semibold text-gray-900">{{ $blog->title }}</h3>
								<p class="text-sm text-gray-500 mt-1">{{ \Carbon\Carbon::parse($blog->published_at)->diffForHumans() }}</p>
							</div>
						</div>
					@endforeach
				</div>
				<!-- Blog Structured Data -->
				<script type="application/ld+json">
					[
					@foreach($blogs as $blog)
					{
						"@context": "https://schema.org",
						"@type": "BlogPosting",
						"headline": "{{ $blog->title }}",
						"image": "{{ $blog->thumbnail_url }}",
						"datePublished": "{{ \Carbon\Carbon::parse($blog->published_at)->toIso8601String() }}",
						"author": {
							"@type": "Organization",
							"name": "Information and Communication Society of India"
						},
						"publisher": {
							"@type": "Organization",
							"name": "Information and Communication Society of India",
							"logo": {
								"@type": "ImageObject",
								"url": "{{ asset('asset/mainLogo.png') }}"
							}
						}
					}{{ !$loop->last ? ',' : '' }}
					@endforeach
					]
				</script>
			@endif
		</div>
	</section>
	
	<script>
        window.onload = function () {
            let currentIndex = 0;
            const carousel = document.getElementById("carousel");
            const totalSlides = carousel.children.length;

            console.log("Carousel element:", carousel); // Debugging: Check if carousel element is found
            console.log("Total slides:", totalSlides); // Debugging: Check total number of slides

            function scrollCarousel(direction) {
                currentIndex = (currentIndex + direction) % totalSlides;
                if (currentIndex < 0) currentIndex = totalSlides - 1;
                carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
                console.log("Current index:", currentIndex); // Debugging: Check current index
            }

            setInterval(() => {
                scrollCarousel(1);
            }, 5000);
        };
	</script>


</x-layouts.app>
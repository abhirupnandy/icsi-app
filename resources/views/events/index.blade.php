<x-layouts.app>
	<x-slot name="title">Upcoming & Past Events - {{ config('app.name') }}</x-slot>
	<x-slot name="meta_description">Discover upcoming and past events at {{ config('app.name') }}. Stay updated on
	                                conferences, webinars, and networking opportunities.
	</x-slot>
	<x-slot name="meta_keywords">Events, Conferences, Webinars, Networking, {{ config('app.name') }}</x-slot>
	
	@section('structured-data')
		<script type="application/ld+json">
			{
				"@context": "https://schema.org",
				"@type": "Event",
				"name": "Upcoming & Past Events - {{ config('app.name') }}",
				"description": "Stay informed about upcoming and past events hosted by {{ config('app.name') }}.",
				"startDate": "{{ $upcomingEvents->first()->event_date ?? now() }}",
				"eventAttendanceMode": "https://schema.org/OnlineEventAttendanceMode",
				"eventStatus": "https://schema.org/EventScheduled",
				"location": {
					"@type": "Place",
					"name": "{{ config('app.name') }}",
					"address": "{{ config('app.url') }}"
				},
				"organizer": {
					"@type": "Organization",
					"name": "{{ config('app.name') }}",
					"url": "{{ config('app.url') }}"
				}
			}
		</script>
	@endsection
	
	<div class="bg-white py-24 sm:py-32">
		<div class="mx-auto max-w-7xl px-6 lg:px-8">
			
			{{-- Breadcrumb Navigation --}}
			@include('components.breadcrumb', [
				'breadcrumbs' => [['label' => 'Events', 'url' => route('events.index')]]
			])
			
			<!-- Upcoming Events Section -->
			<section>
				<div class="mx-auto max-w-2xl lg:mx-0">
					<h1 class="text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">Upcoming Events</h1>
					<p class="mt-2 text-lg text-gray-600">Join our upcoming events and stay connected.</p>
				</div>
				
				<div class="mx-auto mt-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
					@forelse ($upcomingEvents as $event)
						<a
							href="{{ route('events.show', $event->slug) }}"
							class="border border-gray-200 rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-300 flex flex-col h-full"
						>
							
							<!-- Event Thumbnail -->
							@if ($event->thumbnail)
								<img
									src="{{ asset('storage/'.$event->thumbnail) }}"
									alt="{{ $event->title }}"
									class="w-full h-48 object-cover rounded-md lazyload"
								>
							@endif
							
							<!-- Event Date -->
							<div class="text-sm text-gray-500 mt-3">
								📅 {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }} |
								📍 {{ $event->location }}
							</div>
							
							<!-- Event Title -->
							<h2 class="mt-2 text-2xl font-semibold text-gray-900 flex-grow">
								{{ $event->title }}
							</h2>
							
							<!-- Event Description -->
							<p class="mt-3 text-gray-600 line-clamp-3">
								{{ Str::limit(strip_tags($event->description), 120) }}
							</p>
						</a>
					@empty
						<p class="text-lg text-gray-600">No upcoming events at the moment.</p>
					@endforelse
				</div>
			</section>
			
			<!-- Past Events Section -->
			<section class="mt-16">
				<div class="mx-auto max-w-2xl lg:mx-0">
					<h2 class="text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">Past Events</h2>
					<p class="mt-2 text-lg text-gray-600">Take a look at our previous events and their impact.</p>
				</div>
				
				<div class="mx-auto mt-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
					@forelse ($pastEvents as $event)
						<a
							href="{{ route('events.show', $event->slug) }}"
							class="border border-gray-200 rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-300 bg-gray-50 flex flex-col h-full"
						>
							
							<!-- Event Thumbnail -->
							@if ($event->thumbnail)
								<img
									src="{{ asset('storage/'.$event->thumbnail) }}"
									alt="{{ $event->title }}"
									class="w-full h-48 object-cover rounded-md lazyload"
								>
							@endif
							
							<!-- Event Date -->
							<div class="text-sm text-gray-500 mt-3">
								📅 {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }} |
								📍 {{ $event->location }}
							</div>
							
							<!-- Event Title -->
							<h2 class="mt-2 text-2xl font-semibold text-gray-900 flex-grow">
								{{ $event->title }}
							</h2>
							
							<!-- Event Description -->
							<p class="mt-3 text-gray-600 line-clamp-3">
								{{ Str::limit(strip_tags($event->description), 120) }}
							</p>
						</a>
					@empty
						<p class="text-lg text-gray-600">No past events available.</p>
					@endforelse
				</div>
			</section>
		
		</div>
	</div>
</x-layouts.app>

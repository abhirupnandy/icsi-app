<x-layouts.app
	:title="$event->seo_title ?? $event->title . ' - ' . config('app.name')"
	:meta_description="$event->meta_description ?? Str::limit(strip_tags($event->content), 150)"
	:meta_keywords="$event->focus_keyword ?? 'Events, Conferences, Webinars, Seminars, ' . config('app.name')"
>
	@section('structured-data')
		<script type="application/ld+json">
			{
				"@context": "https://schema.org",
				"@type": "Event",
				"name": "{{ $event->title }}",
                "description": "{{ $event->meta_description ?? Str::limit(strip_tags($event->content), 150) }}",
                "image": "{{ $event->thumbnail_url }}",
                "startDate": "{{ $event->event_date }}",
                "location": {
                    "@type": "Place",
                    "name": "{{ $event->location }}"
                },
                "organizer": {
                    "@type": "Organization",
                    "name": "{{ config('app.name') }}",
                    "logo": {
                        "@type": "ImageObject",
                        "url": "{{ asset('images/logo.png') }}"
                    }
                }
            }
		</script>
	@endsection
	
	<div class="max-w-5xl mx-auto px-6 lg:px-8 py-16">
		
		{{-- Breadcrumb Navigation --}}
		@php
			$breadcrumbs = [
				['label' => 'Events', 'url' => route('events.index')],
				['label' => $event->title] // Current page
			];
		@endphp
		@include('components.breadcrumb', compact('breadcrumbs'))
		
		{{-- Event Title & Meta Information --}}
		<h1 class="text-4xl font-semibold text-gray-900">{{ $event->title }}</h1>
		<p class="mt-4 text-gray-500">
			<strong>Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }} <br>
			<strong>Location:</strong> {{ $event->location }}
		</p>
		
		{{-- Featured Image --}}
		<img
			src="{{ $event->thumbnail_url }}" alt="{{ $event->title }}" class="mt-6 w-full h-96 object-cover rounded-md"
		>
		
		{{-- Event Content --}}
		<div class="mt-8 text-lg text-gray-700 leading-relaxed">
			{!! Str::markdown($event->content) !!}
		</div>
		
		{{-- Related Events --}}
		@if($relatedEvents->isNotEmpty())
			<div class="mt-16">
				<h2 class="text-2xl font-semibold text-gray-900">Related Events</h2>
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
					@foreach($relatedEvents as $related)
						<a
							href="{{ route('events.show', $related->slug) }}"
							class="block bg-white shadow-lg rounded-lg overflow-hidden transition-transform hover:scale-105"
						>
							<img
								src="{{ $related->thumbnail_url }}" alt="{{ $related->title }}"
								class="w-full h-48 object-cover"
							>
							<div class="p-4">
								<h3 class="text-lg font-semibold text-gray-900">{{ $related->title }}</h3>
								<p class="text-sm text-gray-600 mt-2">{{ Str::limit($related->meta_description, 80) }}</p>
							</div>
						</a>
					@endforeach
				</div>
			</div>
		@endif
	</div>
</x-layouts.app>

<x-layouts.app
	:title="$blog->seo_title ?? $blog->title . ' - ' . config('app.name')"
	:meta_description="$blog->meta_description ?? Str::limit(strip_tags($blog->content), 150)"
	:meta_keywords="$blog->focus_keyword ?? 'Blogs, Articles, News, Research, ' . config('app.name')"
>
	@section('structured-data')
		<script type="application/ld+json">
			{
				"@context": "https://schema.org",
				"@type": "BlogPosting",
				"headline": "{{ $blog->title }}",
                "description": "{{ $blog->meta_description ?? Str::limit(strip_tags($blog->content), 150) }}",
                "image": "{{ $blog->thumbnail_url }}",
                "author": {
                    "@type": "Person",
                    "name": "{{ $blog->user->name }}"
                },
                "publisher": {
                    "@type": "Organization",
                    "name": "{{ config('app.name') }}",
                    "logo": {
                        "@type": "ImageObject",
                        "url": "{{ asset('images/logo.png') }}"
                    }
                },
                "datePublished": "{{ $blog->published_at }}",
                "dateModified": "{{ $blog->updated_at }}"
            }
		</script>
	@endsection
	
	<div class="max-w-5xl mx-auto px-6 lg:px-8 py-16">
		
		@php
			$breadcrumbs = [
				['label' => 'Blogs', 'url' => route('blog.index')],
				['label' => $blog->title] // No URL since it's the current page
			];
		@endphp
		
		@include('components.breadcrumb', compact('breadcrumbs'))
		
		{{-- Blog Title & Meta Information --}}
		<h1 class="text-4xl font-semibold text-gray-900">{{ $blog->title }}</h1>
		<p class="mt-4 text-gray-500">
			Published on {{ \Carbon\Carbon::parse($blog->published_at)->format('M d, Y') }}
			by <span class="font-semibold text-gray-800">{{ $blog->user->name }}</span>
		</p>
		
		{{-- Featured Image --}}
		<img
			src="{{ $blog->thumbnail_url }}" alt="{{ $blog->thumbnail_alt }}"
			class="mt-6 w-full h-96 object-cover rounded-md"
		>
		
		{{-- Blog Content --}}
		<div class="mt-8 text-lg text-gray-700 leading-relaxed">
			{!! Str::markdown($blog->content) !!}
		</div>
		
		{{-- Blog Tags --}}
		@if($blog->tags)
			<div class="mt-8 flex flex-wrap gap-2">
				@foreach(explode(',', $blog->tags) as $tag)
					<span class="bg-gray-200 text-gray-800 px-3 py-1 rounded-full text-sm">#{{ trim($tag) }}</span>
				@endforeach
			</div>
		@endif
		
		{{-- Related Blogs (Based on Category) --}}
		@if($relatedBlogs->isNotEmpty())
			<div class="mt-16">
				<h2 class="text-2xl font-semibold text-gray-900">Related Blogs</h2>
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
					@foreach($relatedBlogs as $related)
						<a
							href="{{ route('blog.show', $related->slug) }}"
							class="block bg-white shadow-lg rounded-lg overflow-hidden transition-transform hover:scale-105"
						>
							<img
								src="{{ $related->thumbnail_url }}" alt="{{ $related->thumbnail_alt }}"
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

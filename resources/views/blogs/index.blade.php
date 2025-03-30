<x-layouts.app>
	<x-slot:title>{{ __('Blogs') }} - {{ config('app.name') }}</x-slot:title>
	
	{{-- SEO Meta Tags --}}
	@section('meta')
		<meta
			name="description"
			content="Stay updated with the latest blogs from {{ config('app.name') }}. Explore insights, research, and industry updates."
		>
		<meta name="keywords" content="Blogs, Articles, Research, News, {{ config('app.name') }}">
		<meta name="author" content="{{ config('app.name') }}">
		<link rel="canonical" href="{{ request()->url() }}">
		<meta property="og:title" content="Blogs - {{ config('app.name') }}">
		<meta property="og:description" content="Explore our latest insights and updates.">
		<meta property="og:url" content="{{ request()->url() }}">
		<meta property="og:type" content="website">
		<meta property="og:image" content="{{ asset('images/blog-cover.jpg') }}">
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:title" content="Blogs - {{ config('app.name') }}">
		<meta name="twitter:description" content="Stay updated with the latest blogs and articles.">
	@endsection
	
	<div class="bg-white py-24 sm:py-32">
		<div class="mx-auto max-w-7xl px-6 lg:px-8">
			<div class="mx-auto max-w-2xl text-center">
				<h1 class="text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">Latest Blog Posts</h1>
				<p class="mt-2 text-lg text-gray-600">Stay informed with our latest insights and updates.</p>
			</div>
			
			<div class="mx-auto mt-16 grid max-w-6xl grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-center">
				@forelse($blogs as $blog)
					<a
						href="{{ route('blog.show', $blog->slug) }}"
						class="block shadow-lg border border-gray-200 rounded-2xl p-6 bg-white transition-transform duration-300 hover:scale-105"
					>
						<article class="flex flex-col justify-between">
							<div class="relative w-full">
								<img
									src="{{ $blog->thumbnail_url }}" alt="{{ $blog->thumbnail_alt }}"
									class="aspect-video w-full rounded-xl bg-gray-100 object-cover lazyload"
								>
								<div class="absolute inset-0 rounded-xl ring-1 ring-gray-900/10 ring-inset"></div>
							</div>
							<div class="max-w-xl">
								<div class="mt-6 flex items-center gap-x-4 text-xs">
									<time datetime="{{ $blog->published_at }}" class="text-gray-500">
										{{ \Carbon\Carbon::parse($blog->published_at)->format('M d, Y') }}
									</time>
									<span
										class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600"
									>
                                        {{ $blog->category->name ?? 'Uncategorized' }}
                                    </span>
								</div>
								<h2 class="mt-3 text-lg font-semibold text-gray-900">
									{{ $blog->title }}
								</h2>
								<p class="mt-4 line-clamp-3 text-sm text-gray-600">{{ Str::limit($blog->meta_description, 100) }}</p>
								<p class="relative mt-6 text-sm font-semibold text-gray-900">
									By {{ $blog->user->name }}
								</p>
							</div>
						</article>
					</a>
				@empty
					<div class="col-span-full text-center">
						<p class="text-lg text-gray-600">No blogs available at the moment. Check back later!</p>
					</div>
				@endforelse
			</div>
		</div>
	</div>
	
	{{-- JSON-LD Structured Data for SEO --}}
	@section('structured-data')
		<script type="application/ld+json">
			{
				"@context": "https://schema.org",
				"@type": "Blog",
				"name": "Blogs - {{ config('app.name') }}",
                "url": "{{ request()->url() }}",
                "description": "Stay updated with the latest blogs from {{ config('app.name') }}. Explore insights, research, and industry updates.",
                "publisher": {
                    "@type": "Organization",
                    "name": "{{ config('app.name') }}",
                    "url": "{{ url('/') }}",
                    "logo": {
                        "@type": "ImageObject",
                        "url": "{{ asset('images/logo.png') }}"
                    }
                },
                "blogPost": [
			@foreach($blogs as $blog)
			{
				"@type": "BlogPosting",
				"headline": "{{ $blog->title }}",
                            "url": "{{ route('blog.show', $blog->slug) }}",
                            "datePublished": "{{ $blog->published_at }}",
                            "dateModified": "{{ $blog->updated_at }}",
                            "author": {
                                "@type": "Person",
                                "name": "{{ $blog->user->name }}"
                            },
                            "publisher": {
                                "@type": "Organization",
                                "name": "{{ config('app.name') }}"
                            },
                            "image": {
                                "@type": "ImageObject",
                                "url": "{{ $blog->thumbnail_url }}",
                                "height": 630,
                                "width": 1200
                            },
                            "description": "{{ Str::limit($blog->meta_description, 150) }}"
                        }@if(!$loop->last)
			,
				@endif
			@endforeach
			]
		}
		</script>
	@endsection
</x-layouts.app>

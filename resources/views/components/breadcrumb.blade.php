@props(['breadcrumbs'])

@if(!empty($breadcrumbs))
	<nav class="flex" aria-label="Breadcrumb">
		<ol role="list" class="flex items-center space-x-4">
			{{-- Home --}}
			<li>
				<div>
					<a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-500">
						<svg class="size-5 shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							<path
								fill-rule="evenodd"
								d="M9.293 2.293a1 1 0 0 1 1.414 0l7 7A1 1 0 0 1 17 11h-1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6H3a1 1 0 0 1-.707-1.707l7-7Z"
								clip-rule="evenodd"
							/>
						</svg>
						<span class="sr-only">Home</span>
					</a>
				</div>
			</li>
			
			{{-- Dynamic Breadcrumbs --}}
			@foreach ($breadcrumbs as $index => $breadcrumb)
				<li>
					<div class="flex items-center">
						<svg
							class="size-5 shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
							aria-hidden="true"
						>
							<path
								fill-rule="evenodd"
								d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
								clip-rule="evenodd"
							/>
						</svg>
						
						@if(isset($breadcrumb['url']))
							<a
								href="{{ $breadcrumb['url'] }}"
								class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
							>
								{{ $breadcrumb['label'] }}
							</a>
						@else
							<span class="ml-4 text-sm font-medium text-gray-700" aria-current="page">
              {{ $breadcrumb['label'] }}
            </span>
						@endif
					</div>
				</li>
			@endforeach
		</ol>
	</nav>
@endif

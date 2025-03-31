<x-layouts.app>
	<x-slot:title>About Us - {{ config('app.name') }}</x-slot:title>
	
	@push('meta')
		<meta
			name="description"
			content="{{ Str::limit('Learn about the Information and Communication Society of India (ICSI), a New Delhi-based professional society advancing information science and communication.', 160) }}"
		>
		<meta
			name="keywords"
			content="ICSI, Information Science, Communication, New Delhi, Professional Society, Lyon Declaration"
		>
		<meta property="og:title" content="About Us - Information and Communication Society of India">
		<meta
			property="og:description"
			content="{{ Str::limit('ICSI is dedicated to fostering collaboration among information professionals and advancing knowledge dissemination.', 160) }}"
		>
		<meta property="og:image" content="{{ asset('asset/mainLogo.png') }}">
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:title" content="About Us - Information and Communication Society of India">
		<meta
			name="twitter:description"
			content="{{ Str::limit('Discover ICSI’s mission, objectives, and leadership team.', 160) }}"
		>
		<meta name="twitter:image" content="{{ asset('asset/mainLogo.png') }}">
	@endpush
	
	@push('head')
		<link
			rel="preload"
			href="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?ixlib=rb-4.0.3&auto=format&fit=crop&w=2832&q=80"
			as="image"
		>
	@endpush
	
	<div class="bg-white">
		<main class="isolate">
			<!-- Hero section -->
			<div class="relative isolate -z-10">
				<svg
					class="absolute inset-x-0 top-0 -z-10 h-[64rem] w-full stroke-gray-200 [mask-image:radial-gradient(32rem_32rem_at_center,white,transparent)]"
					aria-hidden="true"
				>
					<defs>
						<pattern
							id="1f932ae7-37de-4c0a-a8b0-a6e3b4d44b84" width="200" height="200" x="50%" y="-1"
							patternUnits="userSpaceOnUse"
						>
							<path d="M.5 200V.5H200" fill="none"/>
						</pattern>
					</defs>
					<svg x="50%" y="-1" class="overflow-visible fill-gray-50">
						<path
							d="M-200 0h201v201h-201Z M600 0h201v201h-201Z M-400 600h201v201h-201Z M200 800h201v201h-201Z"
							stroke-width="0"
						/>
					</svg>
					<rect
						width="100%" height="100%" stroke-width="0" fill="url(#1f932ae7-37de-4c0a-a8b0-a6e3b4d44b84)"
					/>
				</svg>
				<div
					class="absolute top-0 right-0 left-1/2 -z-10 -ml-24 transform-gpu overflow-hidden blur-3xl lg:ml-24 xl:ml-48"
					aria-hidden="true"
				>
					<div
						class="aspect-801/1036 w-[50.0625rem] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30"
						style="clip-path: polygon(63.1% 29.5%, 100% 17.1%, 76.6% 3%, 48.4% 0%, 44.6% 4.7%, 54.5% 25.3%, 59.8% 49%, 55.2% 57.8%, 44.4% 57.2%, 27.8% 47.9%, 35.1% 81.5%, 0% 97.7%, 39.2% 100%, 35.2% 81.4%, 97.2% 52.8%, 63.1% 29.5%)"
					></div>
				</div>
				<div class="overflow-hidden">
					<div class="mx-auto max-w-7xl px-6 pt-36 pb-32 sm:pt-60 lg:px-8 lg:pt-32">
						<div class="mx-auto max-w-2xl gap-x-14 lg:mx-0 lg:flex lg:max-w-none lg:items-center">
							<div class="relative w-full lg:max-w-xl lg:shrink-0 xl:max-w-2xl">
								<h1 class="text-5xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-7xl">
									Information and Communication Society of India (ICSI)</h1>
								<p class="mt-8 text-lg font-medium text-pretty text-gray-500 sm:max-w-md sm:text-xl/8 lg:max-w-none">
									ICSI is a New Delhi-based professional society dedicated to fostering collaboration
									among information and communication professionals, science communicators, and social
									media managers. As a signatory of the Lyon Declaration, we advance knowledge
									dissemination and excellence.</p>
							</div>
							<div
								class="mt-14 flex justify-end gap-8 sm:-mt-44 sm:justify-start sm:pl-20 lg:mt-0 lg:pl-0"
							>
								<div
									class="ml-auto w-44 flex-none space-y-8 pt-32 sm:ml-0 sm:pt-80 lg:order-last lg:pt-36 xl:order-none xl:pt-80"
								>
									<div class="relative">
										<img
											src="https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&auto=format&fit=crop&h=528&q=80"
											alt="ICSI Event"
											class="aspect-2/3 w-full rounded-xl bg-gray-900/5 object-cover shadow-lg"
											loading="lazy"
										>
										<div
											class="pointer-events-none absolute inset-0 rounded-xl ring-1 ring-gray-900/10 ring-inset"
										></div>
									</div>
								</div>
								<div class="mr-auto w-44 flex-none space-y-8 sm:mr-0 sm:pt-52 lg:pt-36">
									<div class="relative">
										<img
											src="https://images.unsplash.com/photo-1485217988980-11786ced9454?ixlib=rb-4.0.3&auto=format&fit=crop&h=528&q=80"
											alt="Research Project"
											class="aspect-2/3 w-full rounded-xl bg-gray-900/5 object-cover shadow-lg"
											loading="lazy"
										>
										<div
											class="pointer-events-none absolute inset-0 rounded-xl ring-1 ring-gray-900/10 ring-inset"
										></div>
									</div>
									<div class="relative">
										<img
											src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?ixlib=rb-4.0.3&auto=format&fit=crop&crop=focalpoint&fp-x=.4&w=396&h=528&q=80"
											alt="Library Resources"
											class="aspect-2/3 w-full rounded-xl bg-gray-900/5 object-cover shadow-lg"
											loading="lazy"
										>
										<div
											class="pointer-events-none absolute inset-0 rounded-xl ring-1 ring-gray-900/10 ring-inset"
										></div>
									</div>
								</div>
								<div class="w-44 flex-none space-y-8 pt-32 sm:pt-0">
									<div class="relative">
										<img
											src="https://images.unsplash.com/photo-1670272504528-790c24957dda?ixlib=rb-4.0.3&auto=format&fit=crop&crop=left&w=400&h=528&q=80"
											alt="Seminar"
											class="aspect-2/3 w-full rounded-xl bg-gray-900/5 object-cover shadow-lg"
											loading="lazy"
										>
										<div
											class="pointer-events-none absolute inset-0 rounded-xl ring-1 ring-gray-900/10 ring-inset"
										></div>
									</div>
									<div class="relative">
										<img
											src="https://images.unsplash.com/photo-1670272505284-8faba1c31f7d?ixlib=rb-4.0.3&auto=format&fit=crop&h=528&q=80"
											alt="Team Collaboration"
											class="aspect-2/3 w-full rounded-xl bg-gray-900/5 object-cover shadow-lg"
											loading="lazy"
										>
										<div
											class="pointer-events-none absolute inset-0 rounded-xl ring-1 ring-gray-900/10 ring-inset"
										></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Structured Data for Organization -->
			@section('structured-data')
				<script type="application/ld+json">
					{
						"@context": "https://schema.org",
						"@type": "Organization",
						"name": "Information and Communication Society of India",
						"alternateName": "ICSI",
						"url": "{{ url('/') }}",
					"logo": "{{ asset('asset/mainLogo.png') }}",
					"description": "ICSI is a New Delhi-based professional society dedicated to advancing information and communication through collaboration, research, and knowledge dissemination.",
					"address": {
						"@type": "PostalAddress",
						"addressLocality": "New Delhi",
						"addressCountry": "IN"
					},
					"sameAs": [
						"https://example.com/twitter", // Replace with actual social links
						"https://example.com/linkedin"
					]
				}
				</script>
			@endsection
			
			<!-- Content section -->
			<div class="mx-auto -mt-12 max-w-7xl px-6 sm:mt-0 lg:px-8 xl:-mt-8">
				<div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-none">
					<h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">Our
					                                                                                        Mission</h2>
					<div class="mt-6 flex flex-col gap-x-8 gap-y-20 lg:flex-row">
						<div class="lg:w-full lg:max-w-2xl lg:flex-auto">
							<p class="text-xl/8 text-gray-600">
								ICSI is committed to advancing information and communication through clear goals and
								impactful initiatives.
							</p>
							<h3 class="mt-10 text-2xl font-semibold tracking-tight text-gray-900">Aims and
							                                                                      Objectives</h3>
							<p class="mt-4 text-base/7 text-gray-700">
								We focus on collecting and sharing knowledge, undertaking projects, providing technical
								support for publications, training professionals, fostering global collaboration,
								publishing materials, and promoting advanced technologies in information settings.
							</p>
						</div>
						<div class="lg:flex lg:flex-auto lg:justify-center">
							<dl class="w-64 space-y-8 xl:w-80">
								<div class="flex flex-col-reverse gap-y-4">
									<dt class="text-base/7 text-gray-600">Society Registration</dt>
									<dd class="text-3xl sm:text-4xl font-semibold tracking-tight text-gray-900 break-words sm:break-normal">
										S-38170/2000
									</dd>
								</div>
								<div class="flex flex-col-reverse gap-y-4">
									<dt class="text-base/7 text-gray-600">NGO Darpan Unique ID</dt>
									<dd class="text-3xl sm:text-4xl font-semibold tracking-tight text-gray-900 break-words sm:break-normal">
										DL/2019/0232107
									</dd>
								</div>
								<div class="flex flex-col-reverse gap-y-4">
									<dt class="text-base/7 text-gray-600">Projects Completed</dt>
									<dd class="text-3xl sm:text-4xl font-semibold tracking-tight text-gray-900">8+</dd>
								</div>
							</dl>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Image section -->
			<div class="mt-32 sm:mt-40 xl:mx-auto xl:max-w-7xl xl:px-8">
				<img
					src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?ixlib=rb-4.0.3&auto=format&fit=crop&w=2832&q=80"
					alt="ICSI Community Event"
					class="aspect-5/2 w-full object-cover xl:rounded-3xl"
					loading="lazy"
				>
			</div>
			
			<!-- Values section -->
			<div class="mx-auto mt-32 max-w-7xl px-6 sm:mt-40 lg:px-8">
				<div class="mx-auto max-w-2xl lg:mx-0">
					<h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">Our
					                                                                                        Objectives</h2>
					<p class="mt-6 text-lg/8 text-gray-600">ICSI drives progress in information and communication
					                                        through research, collaboration, and innovation.</p>
				</div>
				<dl class="mx-auto mt-16 flex flex-wrap justify-center gap-x-8 gap-y-16 text-base/7 max-w-2xl lg:mx-0 lg:max-w-none">
					<div class="w-full sm:w-1/2 lg:w-1/3 flex-shrink-0 max-w-xs">
						<dt class="font-semibold text-gray-900">Knowledge Dissemination</dt>
						<dd class="mt-1 text-gray-600">Collect and share knowledge on information and communication.
						</dd>
					</div>
					<div class="w-full sm:w-1/2 lg:w-1/3 flex-shrink-0 max-w-xs">
						<dt class="font-semibold text-gray-900">Research and Projects</dt>
						<dd class="mt-1 text-gray-600">Initiate projects, studies, and data analysis for ourselves and
						                               partners.
						</dd>
					</div>
					<div class="w-full sm:w-1/2 lg:w-1/3 flex-shrink-0 max-w-xs">
						<dt class="font-semibold text-gray-900">Technical Support</dt>
						<dd class="mt-1 text-gray-600">Support publication of print and electronic materials.</dd>
					</div>
					<div class="w-full sm:w-1/2 lg:w-1/3 flex-shrink-0 max-w-xs">
						<dt class="font-semibold text-gray-900">Training and Education</dt>
						<dd class="mt-1 text-gray-600">Train professionals in information and communication fields.</dd>
					</div>
					<div class="w-full sm:w-1/2 lg:w-1/3 flex-shrink-0 max-w-xs">
						<dt class="font-semibold text-gray-900">Global Collaboration</dt>
						<dd class="mt-1 text-gray-600">Connect with national and international organizations.</dd>
					</div>
					<div class="w-full sm:w-1/2 lg:w-1/3 flex-shrink-0 max-w-xs">
						<dt class="font-semibold text-gray-900">Publishing Materials</dt>
						<dd class="mt-1 text-gray-600">Produce and distribute relevant publications.</dd>
					</div>
					<div class="w-full sm:w-1/2 lg:w-1/3 flex-shrink-0 max-w-xs">
						<dt class="font-semibold text-gray-900">Technology Promotion</dt>
						<dd class="mt-1 text-gray-600">Advance automation and Internet use in information settings.</dd>
					</div>
					<div class="w-full sm:w-1/2 lg:w-1/3 flex-shrink-0 max-w-xs">
						<dt class="font-semibold text-gray-900">Programmatic Engagement</dt>
						<dd class="mt-1 text-gray-600">Engage in programs supporting our mission.</dd>
					</div>
				</dl>
			</div>
			
			<!-- Team section -->
			<section class="bg-white py-12">
				<div class="container mx-auto px-4">
					<h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Meet Our Team</h2>
					
					<!-- Current Leadership -->
					<div class="mb-16">
						<h3 class="text-2xl font-semibold text-gray-700 text-center mb-8">Current Leadership</h3>
						
						<!-- President -->
						@foreach($currentLeadership->where('role', 'president') as $leader)
							<div class="text-center mb-8">
								<img
									src="{{ $leader->avatar }}" alt="{{ $leader->name }}"
									class="w-24 h-24 mx-auto rounded-full shadow-md object-cover"
								>
								<h4 class="mt-4 text-lg font-semibold text-gray-900">{{ $leader->name }}</h4>
								<p class="text-sm text-gray-600 uppercase">{{ str_replace('_', ' ', $leader->role) }}</p>
							</div>
						@endforeach
						
						<!-- Vice Presidents in one row -->
						@if($currentLeadership->where('role', 'vice_president')->count() > 0)
							<div class="flex flex-wrap justify-center gap-x-8 gap-y-10 mb-8">
								@foreach($currentLeadership->where('role', 'vice_president') as $leader)
									<div class="text-center w-40">
										<img
											src="{{ $leader->avatar }}" alt="{{ $leader->name }}"
											class="w-24 h-24 mx-auto rounded-full shadow-md object-cover"
										>
										<h4 class="mt-4 text-lg font-semibold text-gray-900">{{ $leader->name }}</h4>
										<p class="text-sm text-gray-600 uppercase">{{ str_replace('_', ' ', $leader->role) }}</p>
									</div>
								@endforeach
							</div>
						@endif
						
						<!-- Other Leadership Roles (General Secretary, Joint Secretary, Treasurer) -->
						<div class="flex flex-wrap justify-center gap-x-8 gap-y-10">
							@foreach($currentLeadership->whereNotIn('role', ['president', 'vice_president']) as $leader)
								<div class="text-center w-40">
									<img
										src="{{ $leader->avatar }}" alt="{{ $leader->name }}"
										class="w-24 h-24 mx-auto rounded-full shadow-md object-cover"
									>
									<h4 class="mt-4 text-lg font-semibold text-gray-900">{{ $leader->name }}</h4>
									<p class="text-sm text-gray-600 uppercase">{{ str_replace('_', ' ', $leader->role) }}</p>
								</div>
							@endforeach
						</div>
					</div>
					
					<!-- Executive Committee Members -->
					<div class="mb-16">
						<h3 class="text-2xl font-semibold text-gray-700 text-center mb-8">Executive Committee
						                                                                  Members</h3>
						<div class="flex flex-wrap justify-center gap-x-8 gap-y-10">
							@foreach($ecMembers as $member)
								<div class="text-center w-40">
									<img
										src="{{ $member->avatar }}" alt="{{ $member->name }}"
										class="w-24 h-24 mx-auto rounded-full shadow-md object-cover"
									>
									<h4 class="mt-4 text-lg font-semibold text-gray-900">{{ $member->name }}</h4>
									<p class="text-sm text-gray-600 uppercase">{{ str_replace('_', ' ', $member->role) }}</p>
								</div>
							@endforeach
						</div>
					</div>
					
					<!-- Former Presidents and Secretaries -->
					<div class="mb-16">
						<h3 class="text-2xl font-semibold text-gray-700 text-center mb-8">Former Presidents and
						                                                                  Secretaries</h3>
						<div class="flex flex-wrap justify-center gap-x-8 gap-y-10">
							@foreach($pastMembers as $former)
								<div class="text-center w-40">
									<img
										src="{{ $former->avatar }}" alt="{{ $former->name }}"
										class="w-24 h-24 mx-auto rounded-full shadow-md object-cover"
									>
									<h4 class="mt-4 text-lg font-semibold text-gray-900">{{ $former->name }}</h4>
									<p class="text-sm text-gray-600 uppercase">{{ str_replace('_', ' ', $former->role) }}</p>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</section>
		
		</main>
	</div>
	<!-- Team Structured Data -->
	<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@type": "Organization",
			"name": "Information and Communication Society of India",
			"member": [
		@foreach($currentLeadership as $member)
		{
			"@type": "Person",
			"name": "{{ $member->name }}",
				"jobTitle": "{{ $member->role }}",
				"image": "{{ $member->avatar }}"
			}{{ !$loop->last ? ',' : '' }}
		@endforeach
		@if(!empty($currentLeadership) && !empty($ecMembers))
		,
		@endif
		@foreach($ecMembers as $member)
		{
			"@type": "Person",
			"name": "{{ $member->name }}",
				"jobTitle": "{{ $member->role }}",
				"image": "{{ $member->avatar }}"
			}{{ !$loop->last ? ',' : '' }}
		@endforeach
		]
	}
	</script>
</x-layouts.app>
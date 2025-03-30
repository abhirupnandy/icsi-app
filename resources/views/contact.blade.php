<x-layouts.app>
	<x-slot:title>Contact - ICSI</x-slot:title>
	
	<div class="relative isolate bg-white">
		<div class="mx-auto grid max-w-7xl grid-cols-1 lg:grid-cols-2">
			<div class="relative px-6 pt-24 pb-20 sm:pt-32 lg:static lg:px-8 lg:py-48">
				<div class="mx-auto max-w-xl lg:mx-0 lg:max-w-lg">
					<div
						class="absolute inset-y-0 left-0 -z-10 w-full overflow-hidden bg-gray-100 ring-1 ring-gray-900/10 lg:w-1/2"
					>
						<svg
							class="absolute inset-0 size-full stroke-gray-200 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]"
							aria-hidden="true"
						>
							<defs>
								<pattern
									id="83fd4e5a-9d52-42fc-97b6-718e5d7ee527" width="200" height="200" x="100%" y="-1"
									patternUnits="userSpaceOnUse"
								>
									<path d="M130 200V.5M.5 .5H200" fill="none"/>
								</pattern>
							</defs>
							<rect width="100%" height="100%" stroke-width="0" fill="white"/>
							<svg x="100%" y="-1" class="overflow-visible fill-gray-50">
								<path d="M-470.5 0h201v201h-201Z" stroke-width="0"/>
							</svg>
							<rect
								width="100%" height="100%" stroke-width="0"
								fill="url(#83fd4e5a-9d52-42fc-97b6-718e5d7ee527)"
							/>
						</svg>
					</div>
					<h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">Get in
					                                                                                        touch</h2>
					<p class="mt-6 text-lg/8 text-gray-600">
						<strong class="font-bold">{{ config('app.name') }}</strong> is a registered professional society
						                                                            based in New Delhi, India.
						                                                            We aim to foster research,
						                                                            collaboration, and innovation in
						                                                            information and communication.
						                                                            Feel free to reach out to us for
						                                                            membership, research collaboration,
						                                                            or any inquiries.
					</p>
					<dl class="mt-10 space-y-4 text-base/7 text-accent opacity-80">
						<!-- Organization Name -->
						<div>
							<dd class="text-lg font-bold text-accent">{{ config('app.name') }}</dd>
							<div class="flex gap-x-4 mt-2">
								<dt class="flex-none">
									<svg
										xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
										stroke-width="1.5" stroke="currentColor" class="size-6"
									>
										<path
											stroke-linecap="round" stroke-linejoin="round"
											d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"
										/>
									</svg>
								</dt>
								<dd>
									80, Shivalik Apartments, Alaknanda, <br>
									New Delhi – 110019, India
								</dd>
							</div>
						</div>
						
						<!-- Contact Details -->
						<div class="space-y-2">
							<div class="flex items-center gap-x-4">
								<!-- Phone -->
								<dt class="flex-none">
									<svg
										xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
										stroke-width="1.5" stroke="currentColor" class="size-6"
									>
										<path
											stroke-linecap="round" stroke-linejoin="round"
											d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"
										/>
									</svg>
								</dt>
								<dd class="font-semibold">
									<p class="hover:text-gray-900">+91-9999020157</p>
								</dd>
							</div>
							
							<div class="flex items-center gap-x-4">
								<!-- Email -->
								<dt class="flex-none">
									<svg
										xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
										stroke-width="1.5" stroke="currentColor" class="size-6"
									>
										<path
											stroke-linecap="round" stroke-linejoin="round"
											d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"
										/>
									</svg>
								</dt>
								<dd class="font-semibold">
									<p class="hover:text-gray-900">icsi.president@gmail.com</p>
								</dd>
							</div>
							
							<div class="flex items-center gap-x-4">
								<!-- Twitter/X -->
								<dt class="flex-none">
									<svg
										xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
										class="size-6"
									>
										<path
											d="M7.55 22c8.88 0 13.75-7.36 13.75-13.75 0-.21 0-.42-.01-.63A9.85 9.85 0 0 0 24 4.59a9.61 9.61 0 0 1-2.75.76 4.79 4.79 0 0 0 2.11-2.63 9.58 9.58 0 0 1-3.04 1.16 4.78 4.78 0 0 0-8.15 4.36 13.57 13.57 0 0 1-9.85-5 4.78 4.78 0 0 0 1.48 6.38A4.74 4.74 0 0 1 1 8.88v.06a4.78 4.78 0 0 0 3.83 4.68 4.78 4.78 0 0 1-2.16.08 4.79 4.79 0 0 0 4.46 3.32 9.63 9.63 0 0 1-5.96 2.06A9.81 9.81 0 0 1 0 19.55 13.57 13.57 0 0 0 7.55 22Z"
										/>
									</svg>
								</dt>
								<dd class="font-semibold">
									<p class="hover:text-gray-900">@IndiaICSI</p>
								</dd>
							</div>
							
							
							<div class="flex items-center gap-x-4">
								<!-- Website -->
								<dt class="flex-none">
									<svg
										xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
										stroke-width="1.5" stroke="currentColor" class="size-6"
									>
										<path
											stroke-linecap="round" stroke-linejoin="round"
											d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418"
										/>
									</svg>
								</dt>
								<dd class="font-semibold">
									<p class="hover:text-gray-900">http://icsi-in.blogspot.com</p>
								</dd>
							</div>
						</div>
					</dl>
					
					
					{{-- Map Embed --}}
					<dl class="mt-8">
						<div class="overflow-hidden max-w-full w-[500px] h-[500px] rounded-lg shadow-md">
							<div class="h-full w-full">
								<iframe
									class="w-full h-full border-0 rounded-lg"
									frameborder="0"
									src="https://www.google.com/maps/embed/v1/place?q=Shivalik+Apartments,+Shaheed+Suryasen+Marg,+Greater+Kailash+II,+Alaknanda,+New+Delhi,+Delhi+110019,+India&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"
									allowfullscreen
								>
								</iframe>
							</div>
						</div>
					
					</dl>
				
				</div>
			</div>
			@php
				$num1 = rand(1, 10);
				$num2 = rand(1, 10);
				session(['captcha_answer' => $num1 + $num2]);
			@endphp
			
			@if(session('success'))
				<script>
                    alert("✅ Success: {{ session('success') }}");
				</script>
			@endif
			
			@if(session('error'))
				<script>
                    alert("❌ Error: {{ session('error') }}");
				</script>
			@endif
			
			<form
				action="{{ route('contact.submit') }}" method="POST" class="px-6 pt-20 pb-24 sm:pb-32 lg:px-8 lg:py-48"
			>
				@csrf
				<div class="mx-auto max-w-xl lg:mr-0 lg:max-w-lg">
					<div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
						<div>
							<label for="first-name" class="block text-sm/6 font-semibold text-gray-900">First
							                                                                            name</label>
							<div class="mt-2.5">
								<input
									type="text" name="first-name" id="first-name" autocomplete="given-name" required
									class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline-1
                        -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2
                        focus:-outline-offset-2 focus:outline-indigo-600"
								>
							</div>
						</div>
						<div>
							<label for="last-name" class="block text-sm/6 font-semibold text-gray-900">Last name</label>
							<div class="mt-2.5">
								<input
									type="text" name="last-name" id="last-name" autocomplete="family-name" required
									class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline-1
                        -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2
                        focus:-outline-offset-2 focus:outline-indigo-600"
								>
							</div>
						</div>
						<div class="sm:col-span-2">
							<label for="email" class="block text-sm/6 font-semibold text-gray-900">Email</label>
							<div class="mt-2.5">
								<input
									type="email" name="email" id="email" autocomplete="email" required
									class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline-1
                        -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2
                        focus:-outline-offset-2 focus:outline-indigo-600"
								>
							</div>
						</div>
						<div class="sm:col-span-2">
							<label for="phone-number" class="block text-sm/6 font-semibold text-gray-900">Phone
							                                                                              number</label>
							<div class="mt-2.5">
								<input
									type="tel" name="phone-number" id="phone-number" autocomplete="tel"
									class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline-1
                        -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2
                        focus:-outline-offset-2 focus:outline-indigo-600"
								>
							</div>
						</div>
						<div class="sm:col-span-2">
							<label for="message" class="block text-sm/6 font-semibold text-gray-900">Message</label>
							<div class="mt-2.5">
                    <textarea
	                    name="message" id="message" rows="4" required
	                    class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline-1
                        -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2
                        focus:-outline-offset-2 focus:outline-indigo-600"
                    ></textarea>
							</div>
						</div>
						
						<!-- CAPTCHA -->
						<div class="sm:col-span-2 flex flex-wrap items-center gap-3">
							<label for="captcha" class="text-sm font-semibold text-gray-900">
								Solve this: {{ $num1 }} + {{ $num2 }} =
							</label>
							<input
								type="number" name="captcha" id="captcha" required
								class="flex-1 min-w-24 rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline-1
                  outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600"
							>
						</div>
					
					</div>
					<div class="mt-8 flex justify-end">
						<button
							type="submit"
							class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-xs
                hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
						>
							Send message
						</button>
					</div>
				</div>
			</form>
		
		</div>
	</div>
</x-layouts.app>

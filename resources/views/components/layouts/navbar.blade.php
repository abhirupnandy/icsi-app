<style>
    /* Smooth transition for dropdown */
    #mobile-menu {
        transition: all 1s ease-in-out;
        opacity: 0;
        transform: translateY(-10px);
        display: none;
    }

    #mobile-menu.active {
        opacity: 1;
        transform: translateY(0);
        display: block;
    }
</style>

<nav id="navbar" class="bg-white shadow-sm fixed top-0 left-0 w-full z-50 transition-all duration-300">
	<div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
		<div class="flex h-16 justify-between">
			<div class="flex px-2 lg:px-0">
				<div class="flex shrink-0 items-center">
					<a href="{{ route('home') }}" class="flex items-center">
						<img class="h-28 w-auto" src="{{ asset('asset/mainLogo.png') }}" alt="{{ config('app.name') }}">
					</a>
				</div>
				<div class="hidden lg:ml-6 lg:flex lg:space-x-8">
					@foreach($navItems as $item)
						@if(in_array($item['route'], ['filament.admin.auth.login', 'filament.admin.pages.dashboard']))
							@continue
						@endif
						<a
							href="{{ route($item['route']) }}" class="inline-flex items-center border-b-2
                            {{ $item['active'] ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}
                            px-1 pt-1 text-sm font-medium"
						>
							{{ $item['title'] }}
						</a>
					@endforeach
				</div>
			</div>
			
			{{-- Authentication Links --}}
			<div class="hidden lg:flex ml-auto items-center">
				@auth
					<a
						href="{{ route('filament.admin.pages.dashboard') }}"
						class="px-4 py-2 text-gray-600 hover:text-indigo-600 text-sm rounded-lg hover:border-2 "
					>Dashboard</a>
				@else
					<a
						href="{{ route('filament.admin.auth.login') }}"
						class="px-4 py-2 text-gray-600 hover:text-indigo-600 text-sm rounded-lg hover:border-2"
					>Login</a>
				@endauth
			</div>
			
			{{-- Mobile Menu Button --}}
			<div class="flex items-center lg:hidden">
				<button
					type="button" id="mobile-menu-button"
					class="p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
				>
					<svg
						id="menu-icon" class="block w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
						stroke="currentColor"
					>
						<path
							stroke-linecap="round" stroke-linejoin="round"
							d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
						/>
					</svg>
					<svg
						id="close-icon" class="hidden w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
						stroke="currentColor"
					>
						<path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
					</svg>
				</button>
			</div>
		</div>
	</div>
	
	{{-- Mobile Navigation --}}
	<div id="mobile-menu" class="lg:hidden bg-white shadow-md border-t border-gray-200">
		<div class="space-y-1 py-2">
			@foreach($navItems as $item)
				@if(!in_array($item['route'], ['filament.admin.auth.login', 'filament.admin.pages.dashboard']))
					<a
						href="{{ route($item['route']) }}" class="block border-l-4
                        {{ $item['active'] ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}
                        py-2 pr-4 pl-3 text-base font-medium"
					>
						{{ $item['title'] }}
					</a>
				@endif
			@endforeach
		</div>
		
		{{-- Mobile Authentication Links --}}
		<div class="border-t border-gray-200 py-3">
			@auth
				<a
					href="{{ route('filament.admin.pages.dashboard') }}"
					class="block px-4 py-2 text-gray-600 hover:text-indigo-600 text-sm rounded-lg hover:border-2"
				>Dashboard</a>
			@else
				<a
					href="{{ route('filament.admin.auth.login') }}"
					class="block px-4 py-2 text-gray-600 hover:text-indigo-600 text-sm rounded-lg hover:border-2"
				>Login</a>
			@endauth
		</div>
	</div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Mobile Menu Toggle
        const menuButton = document.getElementById("mobile-menu-button");
        const mobileMenu = document.getElementById("mobile-menu");
        const menuIcon = document.getElementById("menu-icon");
        const closeIcon = document.getElementById("close-icon");

        if (menuButton && mobileMenu && menuIcon && closeIcon) {
            menuButton.addEventListener("click", function () {
                const isActive = mobileMenu.classList.contains("active");
                mobileMenu.classList.toggle("active", !isActive);
                menuIcon.classList.toggle("hidden", !isActive);
                closeIcon.classList.toggle("hidden", isActive);
            });

            // Close menu when clicking outside
            document.addEventListener("click", function (event) {
                if (!menuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                    mobileMenu.classList.remove("active");
                    menuIcon.classList.remove("hidden");
                    closeIcon.classList.add("hidden");
                }
            });
        }

        // Sticky Navbar Effect
        const navbar = document.getElementById("navbar");

        if (navbar) {
            window.addEventListener("scroll", function () {
                if (window.scrollY > 50) {
                    navbar.classList.add("bg-gray-500", "shadow-lg", "p-1", "opacity-85");
                } else {
                    navbar.classList.remove("bg-gray-500", "shadow-lg", "p-1", "opacity-85");
                }
            });
        }
    });
</script>

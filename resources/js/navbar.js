document.addEventListener('DOMContentLoaded', function () {
    // Mobile Menu
    const menuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');

    if (menuButton && mobileMenu) {
        menuButton.addEventListener('click', function () {
            mobileMenu.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });
    }

    // User Dropdown
    const userButton = document.getElementById('user-menu-button');
    const userDropdown = document.getElementById('user-dropdown');

    if (userButton && userDropdown) {
        userButton.addEventListener('click', function (event) {
            event.stopPropagation();
            userDropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', function (event) {
            if (!userButton.contains(event.target) && !userDropdown.contains(event.target)) {
                userDropdown.classList.add('hidden');
            }
        });
    }

    // Sticky Navbar
    const navbar = document.getElementById('navbar');

    if (navbar) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 50) {
                navbar.classList.add('bg-gray-500', 'shadow-lg', 'rounded-md', 'p-1', 'opacity-[85%]',);
            } else {
                navbar.classList.remove('bg-gray-500', 'shadow-lg', 'rounded-md', 'p-1', 'opacity-[85%]',);
            }
        });
    }
});

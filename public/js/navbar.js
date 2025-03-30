document.addEventListener("DOMContentLoaded", function () {
    // Mobile Menu Toggle
    const menuButton = document.getElementById("mobile-menu-button");
    const mobileMenu = document.getElementById("mobile-menu");
    const menuIcon = document.getElementById("menu-icon");
    const closeIcon = document.getElementById("close-icon");

    if (menuButton && mobileMenu && menuIcon && closeIcon) {
        menuButton.addEventListener("click", function () {
            const isHidden = mobileMenu.classList.contains("hidden");
            mobileMenu.classList.toggle("hidden", !isHidden);
            mobileMenu.classList.toggle("block", isHidden);
            menuIcon.classList.toggle("hidden", !isHidden);
            closeIcon.classList.toggle("hidden", isHidden);
        });

        // Close menu when clicking outside
        document.addEventListener("click", function (event) {
            if (!menuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                mobileMenu.classList.add("hidden");
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

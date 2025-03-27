document.addEventListener("DOMContentLoaded", () => {
    const mobileMenuButton = document.querySelector("button[aria-controls='mobile-menu']");
    const mobileMenu = document.getElementById("mobile-menu");
    const userMenuButton = document.getElementById("user-menu-button");
    const userMenu = document.querySelector("#user-menu-button + div");

    // Mobile Menu Toggle
    mobileMenuButton.addEventListener("click", () => {
        const isExpanded = mobileMenuButton.getAttribute("aria-expanded") === "true";
        mobileMenuButton.setAttribute("aria-expanded", !isExpanded);
        mobileMenu.classList.toggle("hidden");
    });

    // User Dropdown Toggle
    userMenuButton.addEventListener("click", () => {
        userMenu.classList.toggle("hidden");
    });

    // Click outside to close dropdowns
    document.addEventListener("click", (event) => {
        if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
            userMenu.classList.add("hidden");
        }
        if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
            mobileMenu.classList.add("hidden");
        }
    });
});

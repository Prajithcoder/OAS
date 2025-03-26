document.addEventListener("DOMContentLoaded", function () {
    console.log("Script Loaded Successfully!");

    // Example: Show an alert when clicking the logout button
    const logoutButton = document.getElementById("logout-btn");
    if (logoutButton) {
        logoutButton.addEventListener("click", function () {
            if (!confirm("Are you sure you want to log out?")) {
                event.preventDefault();
            }
        });
    }

    // Example: Toggle mobile menu
    const menuButton = document.getElementById("menu-btn");
    const menu = document.getElementById("mobile-menu");

    if (menuButton && menu) {
        menuButton.addEventListener("click", function () {
            menu.classList.toggle("hidden");
        });
    }
});

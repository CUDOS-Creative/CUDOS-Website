// Get the toggle button, menu, and body elements
const toggle = document.querySelector(".js-nav-toggle");
const menu = document.querySelector(".menu");
const body = document.body;

// Event listener for the toggle button
const toggleMenu = () => {
  const isActive = toggle.classList.toggle("is-active");
  // menu.setAttribute("aria-hidden", !isActive);
  // menu.classList.toggle("is-open", isActive);
  // body.classList.toggle("nav-menu-open", isActive);
};

// Event listener for the toggle button
toggle.addEventListener("click", toggleMenu);

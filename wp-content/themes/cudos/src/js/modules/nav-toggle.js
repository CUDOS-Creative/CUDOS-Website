import { disableBodyScroll, enableBodyScroll } from "body-scroll-lock";

// Get the toggle button, menu, and body elements
const toggle = document.querySelector(".js-nav-toggle");
const menu = document.querySelector(".nav-main");
const root = document.getElementsByTagName("html")[0];
const body = document.body;
const mainMenu = document.querySelector(".nav-main .menu");

const documentWidth = document.documentElement.clientWidth;
const windowWidth = window.innerWidth;
const scrollBarWidth = windowWidth - documentWidth;

// Event listener for the toggle button
const toggleMenu = () => {
  const isActive = toggle.classList.toggle("is-active");
  // Detect scrollbar width
  if (isActive) {
    body.style.paddingRight = scrollBarWidth + "px";
    disableBodyScroll(mainMenu);
    mainMenu.style.removeProperty("padding-left");
  } else {
    body.style.removeProperty("padding-right");
    mainMenu.style.paddingLeft = scrollBarWidth + "px";
    enableBodyScroll(mainMenu);
  }

  menu.setAttribute("aria-hidden", !isActive);
  menu.classList.toggle("is-open", isActive);
  root.classList.toggle("nav-menu-open", isActive);
};

// Event listener for the toggle button
toggle.addEventListener("click", toggleMenu);

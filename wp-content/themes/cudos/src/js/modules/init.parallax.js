import SimpleParallax from "simple-parallax-js/vanilla";

var images = document.querySelectorAll(".parallax__image");
new SimpleParallax(images, {
  customWrapper: ".parallax",
});

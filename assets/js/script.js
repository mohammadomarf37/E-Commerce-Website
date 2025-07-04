//  Loader
window.addEventListener("load", function () {
  const preloader = document.getElementById("preloader");

  // Fade out loader after page fully loaded
  preloader.classList.add("fade-out");

  // Completely hide it after transition
  setTimeout(() => {
    preloader.style.display = "none";
  }, 500);
});

const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const el = entry.target;
        el.classList.remove("hidden");
        el.classList.add("visible", "animate__animated");
        observer.unobserve(el);
      }
    });
  }, {
    threshold: 0.2
  });

  document.querySelectorAll(".animate-on-scroll").forEach(el => {
    observer.observe(el);
  });

//   window.addEventListener("load", function () {
//     const preloader = document.getElementById("preloader");

//     preloader.classList.add("fade-out");
//     setTimeout(() => {
//       preloader.style.display = "none";

//       // Re-trigger all Animate.css animations
//       document.querySelectorAll('.animate__animated').forEach(el => {
//         el.classList.remove('animate__animated');
//         void el.offsetWidth; // reflow trigger
//         el.classList.add('animate__animated');
//       });

//     }, 500); // same as preloader fade time
//   });

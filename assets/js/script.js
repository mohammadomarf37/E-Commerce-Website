// Optional: Prevent scroll while loader is visible
document.body.style.overflow = "hidden";

window.addEventListener("load", function () {
  const loader = document.getElementById("page-loader");
  loader.classList.add("fade-out");

  // Remove loader and allow scroll
  setTimeout(() => {
    loader.style.display = "none";
    document.body.style.overflow = "auto";
  }, 500);
});

// Animate On Scroll
const observer = new IntersectionObserver(
  (entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const el = entry.target;
        el.classList.remove("hidden");
        el.classList.add("visible", "animate__animated");
        observer.unobserve(el);
      }
    });
  },
  {
    threshold: 0.2,
  }
);

document.querySelectorAll(".animate-on-scroll").forEach((el) => {
  observer.observe(el);
});

// Search Bar
const searchInput = document.getElementById("search-input");
const suggestionBox = document.getElementById("suggestions");

// Live search
searchInput.addEventListener("keyup", function () {
  let query = this.value;

  if (query.length > 1) {
    fetch("search_suggest.php?q=" + query)
      .then((res) => res.json())
      .then((data) => {
        suggestionBox.innerHTML = "";
        data.forEach((item) => {
          let div = document.createElement("div");
          div.textContent = item.name;
          div.onclick = () =>
            (window.location.href = "product.php?id=" + item.id);
          suggestionBox.appendChild(div);
        });
        suggestionBox.style.display = "block";
      });
  } else {
    suggestionBox.style.display = "none";
  }
});

// Click outside to hide
document.addEventListener("click", function (e) {
  if (!searchInput.contains(e.target) && !suggestionBox.contains(e.target)) {
    suggestionBox.style.display = "none";
  }
});


// Search Bar Background Blur
const searchinput = document.getElementById('search-input');

searchInput.addEventListener('focus', () => {
  document.body.classList.add('search-active');
});

searchInput.addEventListener('blur', () => {
  setTimeout(() => {
    document.body.classList.remove('search-active');
  }, 200); // Delay so click on suggestion doesn't get blocked
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

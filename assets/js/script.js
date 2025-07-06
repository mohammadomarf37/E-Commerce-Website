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









const track = document.querySelector('.carousel-track');
const slides = document.querySelectorAll('.carousel-slide');
const dots = document.querySelectorAll('.dot');
let currentIndex = 0;

function updateCarousel() {
  track.style.transform = `translateX(-${currentIndex * 100}%)`;
  dots.forEach(dot => dot.classList.remove('active'));
  dots[currentIndex].classList.add('active');
}

dots.forEach((dot, index) => {
  dot.addEventListener('click', () => {
    currentIndex = index;
    updateCarousel();
  });
});

// Auto slide every 5 seconds
setInterval(() => {
  currentIndex = (currentIndex + 1) % slides.length;
  updateCarousel();
}, 4000);



  // const observe = new IntersectionObserver((entries, observer) => {
  //   entries.forEach(entry => {
  //     if (entry.isIntersecting) {
  //       const el = entry.target;
  //       const animationClass = el.dataset.animate;
  //       el.classList.add(animationClass);
  //       el.classList.remove('scroll-animate');
  //       observe.unobserve(el); // Animate only once
  //     }
  //   });
  // }, {
  //   threshold: 0.1
  // });

  // // Observe all .scroll-animate elements
  // document.querySelectorAll('.scroll-animate').forEach(el => {
  //   observe.observe(el);
  // });




  // const observer = new IntersectionObserver((entries) => {
  //   entries.forEach(entry => {
  //     if (entry.isIntersecting) {
  //       const el = entry.target;

  //       // Check if not already animated
  //       if (!el.classList.contains('visible')) {
  //         el.classList.add('visible');

  //         // Add animate__animated if not already present
  //         if (!el.classList.contains('animate__animated')) {
  //           el.classList.add('animate__animated');
  //         }

  //         // Remove hidden so it becomes visible
  //         el.classList.remove('hidden');

  //         // Animate once only
  //         observer.unobserve(el);
  //       }
  //     }
  //   });
  // });

  // // Observe all elements with .animate-on-scroll
  // document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));


//  const toggleBtn = document.getElementById("toggleFilters");
//   const filterSidebar = document.getElementById("filterSidebar");

//   toggleBtn.addEventListener("click", () => {
//     filterSidebar.classList.toggle("mobile-active");
//   });

  //  const toggleBtn = document.getElementById("toggleFilters");
  // const filterSidebar = document.getElementById("filterSidebar");

  // toggleBtn.addEventListener("click", () => {
  //   filterSidebar.classList.toggle("mobile-active");
  //   toggleBtn.textContent = filterSidebar.classList.contains("mobile-active") ? "Hide Filters" : "Show Filters";
  // });
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

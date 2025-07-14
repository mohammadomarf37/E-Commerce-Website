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
const searchinput = document.getElementById("search-input");

searchInput.addEventListener("focus", () => {
  document.body.classList.add("search-active");
});

searchInput.addEventListener("blur", () => {
  setTimeout(() => {
    document.body.classList.remove("search-active");
  }, 200); // Delay so click on suggestion doesn't get blocked
});


// Hero Section Carousel

const track = document.getElementById('carouselTrack');
let isDragging = false;
let startX, scrollLeft;

track.addEventListener('mousedown', (e) => {
  isDragging = true;
  track.classList.add('dragging');
  startX = e.pageX - track.offsetLeft;
  scrollLeft = track.scrollLeft;
});

track.addEventListener('mouseleave', () => {
  isDragging = false;
  track.classList.remove('dragging');
});

track.addEventListener('mouseup', () => {
  isDragging = false;
  track.classList.remove('dragging');
});

track.addEventListener('mousemove', (e) => {
  if (!isDragging) return;
  e.preventDefault();
  const x = e.pageX - track.offsetLeft;
  const walk = (x - startX) * 2; // Speed
  track.scrollLeft = scrollLeft - walk;
});

// Touch Support
track.addEventListener('touchstart', (e) => {
  isDragging = true;
  startX = e.touches[0].pageX - track.offsetLeft;
  scrollLeft = track.scrollLeft;
});

track.addEventListener('touchend', () => {
  isDragging = false;
});

track.addEventListener('touchmove', (e) => {
  if (!isDragging) return;
  const x = e.touches[0].pageX - track.offsetLeft;
  const walk = (x - startX) * 2;
  track.scrollLeft = scrollLeft - walk;
});

// Auto Slide
let autoIndex = 0;
setInterval(() => {
  const slides = document.querySelectorAll('.carousel-slide');
  autoIndex = (autoIndex + 1) % slides.length;
  track.scrollTo({
    left: autoIndex * track.clientWidth,
    behavior: 'smooth'
  });
}, 3000); // 4 seconds interval




// Buy Now Modal
const modal = document.getElementById("buyNowModal");
const btn = document.getElementById("buyNowBtn");
const closeBtn = document.querySelector(".close");

btn.onclick = () => (modal.style.display = "block");
closeBtn.onclick = () => (modal.style.display = "none");

document.getElementById("buyNowForm").onsubmit = function (e) {
  e.preventDefault();

  const formData = new FormData(this);

  fetch("buy_now.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.text())
    .then((data) => {
      alert(data);
      modal.style.display = "none";
      document.getElementById("loadingMsg").style.display = "none";
    })
    .catch((err) => console.log(err));
};

document.getElementById("buyNowForm").addEventListener("submit", function () {
  document.getElementById("loadingMsg").style.display = "block";
});

// Checkout Modal
//     document.addEventListener('DOMContentLoaded', () => {
//     const modal = document.getElementById('checkoutModal');
//     const btn = document.getElementById('checkoutBtn');
//     const close = modal.querySelector('.close');

//     if (btn && modal && close) {
//         btn.onclick = () => {
//             modal.style.display = 'flex';
//         };
//         close.onclick = () => {
//             modal.style.display = 'none';
//         };
//         window.onclick = e => {
//             if (e.target === modal) modal.style.display = 'none';
//         };
//     } else {
//         console.warn("Checkout modal or button not found in DOM.");
//     }
// });


// address validation
// document.getElementById("buyNowForm").addEventListener("submit", function (e) {
//     const address = document.querySelector('textarea[name="address"]').value.trim();

//     if (address === "") {
//         e.preventDefault();
//         alert("❌ Please enter a valid address.");
//         document.querySelector('textarea[name="address"]').style.border = "2px solid red";
//     } else {
//         document.querySelector('textarea[name="address"]').style.border = "";
//     }

// });


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

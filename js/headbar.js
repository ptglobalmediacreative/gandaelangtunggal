window.addEventListener("scroll", function () {
  const header = document.querySelector(".header");
  header.classList.toggle("scrolled", window.scrollY > 50);
});

// Scroll Headbar
let lastScroll = 0;
const header = document.querySelector(".header");

window.addEventListener("scroll", () => {
  const currentScroll = window.pageYOffset;

  if (currentScroll > 80) {
    header.classList.add("scrolled");
  } else {
    header.classList.remove("scrolled");
  }

  if (currentScroll > lastScroll && currentScroll > 150) {
    header.classList.add("hide");
  }

  if (currentScroll < lastScroll) {
    header.classList.remove("hide");
  }

  lastScroll = currentScroll;
});

// Kenapa Memilih Kami
/* ================= WHY US PARALLAX ================= */

const whySection = document.querySelector(".why-us");
const whyBg = document.querySelector(".why-bg");

window.addEventListener("scroll", () => {
  const rect = whySection.getBoundingClientRect();
  const windowHeight = window.innerHeight;

  if (rect.top < windowHeight && rect.bottom > 0) {
    const progress = 1 - rect.top / (windowHeight + rect.height);

    const scale = 1.05 + progress * 0.08;

    whyBg.style.transform = `scale(${scale})`;
  }
});

// Aftersales
/* ================= SERVICE SUPPORT ANIMATION ================= */

const serviceItems = document.querySelectorAll(".fade-up");

const observer = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("show");
      }
    });
  },
  {
    threshold: 0.2,
  },
);

serviceItems.forEach((item) => {
  observer.observe(item);
});

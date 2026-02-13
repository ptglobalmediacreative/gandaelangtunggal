/* ================= GLOBAL ELEMENT ================= */

const header = document.querySelector(".header");
const hamburger = document.getElementById("hamburger");
const navbar = document.getElementById("navbar");

/* ================= HEADER SCROLL SYSTEM ================= */

let lastScroll = 0;

window.addEventListener("scroll", () => {
  const currentScroll = window.pageYOffset;

  /* Add scrolled */
  if (currentScroll > 80) {
    header.classList.add("scrolled");
  } else {
    header.classList.remove("scrolled");
  }

  /* Hide when scroll down */
  if (currentScroll > lastScroll && currentScroll > 150) {
    header.classList.add("hide");
  }

  /* Show when scroll up */
  if (currentScroll < lastScroll) {
    header.classList.remove("hide");
  }

  lastScroll = currentScroll;
});

/* ================= WHY US PARALLAX ================= */

const whySection = document.querySelector(".why-us");
const whyBg = document.querySelector(".why-bg");

if (whySection && whyBg) {
  window.addEventListener("scroll", () => {
    const rect = whySection.getBoundingClientRect();
    const windowHeight = window.innerHeight;

    if (rect.top < windowHeight && rect.bottom > 0) {
      const progress = 1 - rect.top / (windowHeight + rect.height);
      const scale = 1.05 + progress * 0.08;

      whyBg.style.transform = `scale(${scale})`;
    }
  });
}

/* ================= SERVICE SUPPORT ANIMATION ================= */

const serviceItems = document.querySelectorAll(".fade-up");

const serviceObserver = new IntersectionObserver(
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
  serviceObserver.observe(item);
});

/* ================= BLOG HOME ANIMATION ================= */

const blogItems = document.querySelectorAll(".fade-blog");

const blogObserver = new IntersectionObserver(
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

blogItems.forEach((item) => {
  blogObserver.observe(item);
});

document.addEventListener("DOMContentLoaded", () => {
  const header = document.querySelector(".header");
  const hamburger = document.getElementById("hamburger");
  const navbar = document.getElementById("navbar");

  /* ================= HAMBURGER MENU ================= */

  if (hamburger && navbar) {
    hamburger.addEventListener("click", () => {
      hamburger.classList.toggle("active");
      navbar.classList.toggle("active");
      header.classList.toggle("menu-open");

      document.body.classList.toggle("no-scroll");
    });

    /* Close when click menu */
    document.querySelectorAll(".navbar a").forEach((link) => {
      link.addEventListener("click", () => {
        hamburger.classList.remove("active");
        navbar.classList.remove("active");
        header.classList.remove("menu-open");
        document.body.classList.remove("no-scroll");
      });
    });

    /* Close when click outside */
    document.addEventListener("click", (e) => {
      if (
        navbar.classList.contains("active") &&
        !navbar.contains(e.target) &&
        !hamburger.contains(e.target)
      ) {
        hamburger.classList.remove("active");
        navbar.classList.remove("active");
        header.classList.remove("menu-open");
        document.body.classList.remove("no-scroll");
      }
    });
  } else {
    console.error("Hamburger / Navbar not found!");
  }
});

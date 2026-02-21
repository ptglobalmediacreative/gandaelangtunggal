document.addEventListener("DOMContentLoaded", () => {
  /* ================= ELEMENT ================= */

  const header = document.querySelector(".header");
  const hamburger = document.getElementById("hamburger");
  const navbar = document.getElementById("navbar");

  let lastScroll = 0;

  /* ================= HEADER SCROLL ================= */

  window.addEventListener("scroll", () => {
    const currentScroll = window.pageYOffset;

    // Background on scroll
    if (currentScroll > 80) {
      header.classList.add("scrolled");
    } else {
      header.classList.remove("scrolled");
    }
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

  /* ================= SERVICE ANIMATION ================= */

  const serviceItems = document.querySelectorAll(".fade-up");

  if (serviceItems.length) {
    const serviceObserver = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("show");
          }
        });
      },
      { threshold: 0.2 },
    );

    serviceItems.forEach((item) => {
      serviceObserver.observe(item);
    });
  }

  /* ================= BLOG ANIMATION ================= */

  const blogItems = document.querySelectorAll(".fade-blog");

  if (blogItems.length) {
    const blogObserver = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("show");
          }
        });
      },
      { threshold: 0.2 },
    );

    blogItems.forEach((item) => {
      blogObserver.observe(item);
    });
  }

  /* ================= HAMBURGER MENU ================= */

  if (!hamburger || !navbar || !header) {
    console.error("Header / Hamburger / Navbar not found!");
    return;
  }

  // Toggle menu
  hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active");
    navbar.classList.toggle("active");
    header.classList.toggle("menu-open");
    document.body.classList.toggle("no-scroll");
  });

  // Close when click link
  document.querySelectorAll(".navbar a").forEach((link) => {
    link.addEventListener("click", () => {
      closeMenu();
    });
  });

  // Close when click outside
  document.addEventListener("click", (e) => {
    if (
      navbar.classList.contains("active") &&
      !navbar.contains(e.target) &&
      !hamburger.contains(e.target)
    ) {
      closeMenu();
    }
  });

  function closeMenu() {
    hamburger.classList.remove("active");
    navbar.classList.remove("active");
    header.classList.remove("menu-open");
    document.body.classList.remove("no-scroll");
  }
});

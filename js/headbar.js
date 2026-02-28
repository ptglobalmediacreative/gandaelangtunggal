document.addEventListener("DOMContentLoaded", () => {
  /* ================= ELEMENT ================= */

  const header = document.querySelector(".header");
  const hamburger = document.getElementById("hamburger");
  const navbar = document.getElementById("navbar");
  const heroVideo = document.querySelector(".hero-video");

  let lastScroll = 0;

  /* ================= HEADER SCROLL ================= */

  if (header) {
    window.addEventListener("scroll", () => {
      const currentScroll = window.pageYOffset;

      if (currentScroll > 80) {
        header.classList.add("scrolled");
      } else {
        header.classList.remove("scrolled");
      }

      lastScroll = currentScroll;
    });
  }

  /* ================= HERO VIDEO AUTO PLAY (MOBILE SAFE) ================= */

  if (heroVideo) {
    function forcePlayVideo() {
      const playPromise = heroVideo.play();

      if (playPromise !== undefined) {
        playPromise.catch(() => {
          setTimeout(forcePlayVideo, 500);
        });
      }
    }

    forcePlayVideo();

    heroVideo.addEventListener("pause", forcePlayVideo);

    heroVideo.addEventListener("ended", () => {
      heroVideo.currentTime = 0;
      forcePlayVideo();
    });

    document.addEventListener("visibilitychange", () => {
      if (!document.hidden) {
        forcePlayVideo();
      }
    });
  }

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

  /* ================= INTERSECTION ANIMATION ================= */

  function createObserver(selector) {
    const items = document.querySelectorAll(selector);

    if (!items.length) return;

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("show");
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.2 },
    );

    items.forEach((item) => observer.observe(item));
  }

  createObserver(".fade-up");
  createObserver(".fade-blog");

  /* ================= HAMBURGER MENU ================= */

  if (!hamburger || !navbar || !header) return;

  function openMenu() {
    hamburger.classList.add("active");
    navbar.classList.add("active");
    header.classList.add("menu-open");
    document.body.classList.add("menu-open"); // LOCK SCROLL
  }

  function closeMenu() {
    hamburger.classList.remove("active");
    navbar.classList.remove("active");
    header.classList.remove("menu-open");
    document.body.classList.remove("menu-open");
  }

  function toggleMenu() {
    if (navbar.classList.contains("active")) {
      closeMenu();
    } else {
      openMenu();
    }
  }

  /* Toggle click */
  hamburger.addEventListener("click", (e) => {
    e.stopPropagation();
    toggleMenu();
  });

  /* Close when click link */
  document.querySelectorAll(".navbar a").forEach((link) => {
    link.addEventListener("click", () => {
      closeMenu();
    });
  });

  /* Close when click outside */
  document.addEventListener("click", (e) => {
    if (
      navbar.classList.contains("active") &&
      !navbar.contains(e.target) &&
      !hamburger.contains(e.target)
    ) {
      closeMenu();
    }
  });

  /* Close on resize to desktop */
  window.addEventListener("resize", () => {
    if (window.innerWidth > 900) {
      closeMenu();
    }
  });
});

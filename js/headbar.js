document.addEventListener("DOMContentLoaded", () => {
  /* ================= ELEMENT ================= */
  const header = document.querySelector(".header");
  const hamburger = document.getElementById("hamburger");
  const navbar = document.getElementById("navbar");
  const heroVideo = document.querySelector(".hero-video");

  /* ================= HERO VIDEO AUTO PLAY (MOBILE SAFE) ================= */
  if (heroVideo) {
    function forcePlayVideo() {
      const playPromise = heroVideo.play();
      if (playPromise !== undefined) {
        playPromise.catch(() => setTimeout(forcePlayVideo, 500));
      }
    }
    forcePlayVideo();

    heroVideo.addEventListener("pause", forcePlayVideo);
    heroVideo.addEventListener("ended", () => {
      heroVideo.currentTime = 0;
      forcePlayVideo();
    });

    document.addEventListener("visibilitychange", () => {
      if (!document.hidden) forcePlayVideo();
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

  /* ================= SCROLL REVEAL ANIMATION ================= */
  function createObserver(selector, stagger = false) {
    const items = document.querySelectorAll(selector);
    if (!items.length) return;

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            if (stagger) {
              const siblings = entry.target.parentElement.children;
              Array.from(siblings).forEach((el, index) => {
                setTimeout(() => el.classList.add("show", "active"), index * 150);
              });
            } else {
              entry.target.classList.add("show", "active");
            }
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.2 }
    );

    items.forEach((item) => observer.observe(item));
  }

  createObserver(".fade-up");
  createObserver(".fade-blog");
  createObserver(".reveal");
  createObserver(".reveal-left");
  createObserver(".reveal-right");
  createObserver(".reveal-scale");
  createObserver(".why-card", true);
  createObserver(".service-card", true);
  createObserver(".blog-post", true);

  /* ================= HAMBURGER MENU ================= */
  if (!hamburger || !navbar) return;

  function openMenu() {
    hamburger.classList.add("active");
    navbar.classList.add("active");
    document.body.classList.add("menu-open");
  }

  function closeMenu() {
    hamburger.classList.remove("active");
    navbar.classList.remove("active");
    document.body.classList.remove("menu-open");
  }

  function toggleMenu() {
    navbar.classList.contains("active") ? closeMenu() : openMenu();
  }

  hamburger.addEventListener("click", (e) => {
    e.stopPropagation();
    toggleMenu();
  });

  // Close menu on link click
  document.querySelectorAll(".navbar a").forEach((link) => {
    link.addEventListener("click", closeMenu);
  });

  // Close menu when clicking outside
  document.addEventListener("click", (e) => {
    if (
      navbar.classList.contains("active") &&
      !navbar.contains(e.target) &&
      !hamburger.contains(e.target)
    ) {
      closeMenu();
    }
  });

  // Close menu on resize (desktop)
  window.addEventListener("resize", () => {
    if (window.innerWidth > 900) closeMenu();
  });

  /* ================= STICKY HEADER (OPTIONAL) ================= */
  window.addEventListener("scroll", () => {
    if (window.scrollY > 20) {
      header.classList.add("scrolled");
    } else {
      header.classList.remove("scrolled");
    }
  });
});
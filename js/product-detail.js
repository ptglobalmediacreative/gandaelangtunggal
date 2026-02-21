document.addEventListener("DOMContentLoaded", () => {
  /* ==================================================
     GALLERY SLIDER
  ================================================== */

  const track = document.querySelector(".pd-track");
  const slides = document.querySelectorAll(".pd-slide");

  const prev = document.querySelector(".pd-btn.prev");
  const next = document.querySelector(".pd-btn.next");

  let index = 0;

  function moveSlide() {
    if (!track) return;
    track.style.transform = `translateX(-${index * 100}%)`;
  }

  if (next && prev && slides.length) {
    next.addEventListener("click", () => {
      index++;
      if (index >= slides.length) index = 0;
      moveSlide();
    });

    prev.addEventListener("click", () => {
      index--;
      if (index < 0) index = slides.length - 1;
      moveSlide();
    });
  }

  /* ==================================================
     MENU ACTIVE + STICKY SHADOW
  ================================================== */

  const links = document.querySelectorAll(".pd-menu-nav a");
  const sections = document.querySelectorAll(".pd-section");
  const pdMenu = document.querySelector(".pd-menu");

  function handleScrollMenu() {
    let current = "";

    sections.forEach((section) => {
      if (window.scrollY >= section.offsetTop - 180) {
        current = section.getAttribute("id");
      }
    });

    /* Active menu */
    links.forEach((link) => {
      link.classList.remove("active");

      if (link.getAttribute("href") === `#${current}`) {
        link.classList.add("active");
      }
    });

    /* Sticky shadow */
    if (pdMenu) {
      if (window.scrollY > 400) {
        pdMenu.classList.add("stuck");
      } else {
        pdMenu.classList.remove("stuck");
      }
    }
  }

  window.addEventListener("scroll", handleScrollMenu);

  /* ==================================================
     SCROLL REVEAL ANIMATION
  ================================================== */

  const revealItems = document.querySelectorAll(
    ".pd-section, .pd-feature-row, .pd-spec-box, .pd-slide, .pd-card",
  );

  if (revealItems.length) {
    const revealObserver = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("show");
            revealObserver.unobserve(entry.target); // Stop observe after show
          }
        });
      },
      {
        threshold: 0.15,
        rootMargin: "0px 0px -50px 0px",
      },
    );

    revealItems.forEach((item) => {
      revealObserver.observe(item);
    });
  }
});

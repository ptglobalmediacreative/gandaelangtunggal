document.addEventListener("DOMContentLoaded", () => {
  /* =====================================
     GALLERY SLIDER (AUTO + BUTTON)
  ===================================== */

  const track = document.querySelector(".pd-track");
  const slides = document.querySelectorAll(".pd-slide");

  const prev = document.querySelector(".pd-btn.prev");
  const next = document.querySelector(".pd-btn.next");

  let galleryIndex = 0;
  let galleryTimer;

  function moveGallery() {
    if (!track) return;
    track.style.transform = `translateX(-${galleryIndex * 100}%)`;
  }

  function nextGallery() {
    galleryIndex++;
    if (galleryIndex >= slides.length) galleryIndex = 0;
    moveGallery();
  }

  function prevGallery() {
    galleryIndex--;
    if (galleryIndex < 0) galleryIndex = slides.length - 1;
    moveGallery();
  }

  function startGalleryAuto() {
    galleryTimer = setInterval(nextGallery, 4000);
  }

  function stopGalleryAuto() {
    clearInterval(galleryTimer);
  }

  if (track && slides.length > 1) {
    startGalleryAuto();

    if (next && prev) {
      next.addEventListener("click", () => {
        stopGalleryAuto();
        nextGallery();
        startGalleryAuto();
      });

      prev.addEventListener("click", () => {
        stopGalleryAuto();
        prevGallery();
        startGalleryAuto();
      });
    }
  }

  /* =====================================
     RECOMMENDED AUTO SLIDER (CENTER)
  ===================================== */

  const recWrapper = document.querySelector(".pd-rec");
  const recCards = document.querySelectorAll(".pd-card");

  let recIndex = 0;
  let recTimer;

  function scrollToCard(index) {
    if (!recWrapper || !recCards[index]) return;

    const card = recCards[index];

    const wrapperWidth = recWrapper.offsetWidth;
    const cardWidth = card.offsetWidth;

    const scrollPos = card.offsetLeft - wrapperWidth / 2 + cardWidth / 2;

    recWrapper.scrollTo({
      left: scrollPos,
      behavior: "smooth",
    });
  }

  function nextRec() {
    recIndex++;
    if (recIndex >= recCards.length) recIndex = 0;
    scrollToCard(recIndex);
  }

  function startRecAuto() {
    recTimer = setInterval(nextRec, 4500);
  }

  function stopRecAuto() {
    clearInterval(recTimer);
  }

  if (recWrapper && recCards.length > 1) {
    startRecAuto();

    // Stop when user swipe
    recWrapper.addEventListener("touchstart", stopRecAuto);
    recWrapper.addEventListener("mousedown", stopRecAuto);

    // Resume after scroll
    recWrapper.addEventListener("scroll", () => {
      clearTimeout(recWrapper._scrollTimer);

      recWrapper._scrollTimer = setTimeout(() => {
        startRecAuto();
      }, 2000);
    });
  }

  /* =====================================
     MENU ACTIVE + STICKY SHADOW
  ===================================== */

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

    // Active link
    links.forEach((link) => {
      link.classList.remove("active");

      if (link.getAttribute("href") === `#${current}`) {
        link.classList.add("active");
      }
    });

    // Sticky shadow
    if (pdMenu) {
      if (window.scrollY > 400) {
        pdMenu.classList.add("stuck");
      } else {
        pdMenu.classList.remove("stuck");
      }
    }
  }

  window.addEventListener("scroll", handleScrollMenu);

  /* =====================================
     SCROLL REVEAL ANIMATION
  ===================================== */

  const revealItems = document.querySelectorAll(
    ".pd-section, .pd-feature-row, .pd-spec-box, .pd-slide, .pd-card",
  );

  if (revealItems.length) {
    const revealObserver = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("show");
            revealObserver.unobserve(entry.target);
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

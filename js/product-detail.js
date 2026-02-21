document.addEventListener("DOMContentLoaded", () => {
  /* GALLERY */

  const track = document.querySelector(".pd-track");
  const slides = document.querySelectorAll(".pd-slide");

  const prev = document.querySelector(".pd-btn.prev");
  const next = document.querySelector(".pd-btn.next");

  let i = 0;

  function move() {
    track.style.transform = `translateX(-${i * 100}%)`;
  }

  if (next) {
    next.onclick = () => {
      i++;
      if (i >= slides.length) i = 0;
      move();
    };

    prev.onclick = () => {
      i--;
      if (i < 0) i = slides.length - 1;
      move();
    };
  }

  /* MENU ACTIVE */

  const links = document.querySelectorAll(".pd-menu-nav a");
  const sections = document.querySelectorAll(".pd-section");

  window.addEventListener("scroll", () => {
    let cur = "";

    sections.forEach((s) => {
      if (pageYOffset >= s.offsetTop - 150) {
        cur = s.id;
      }
    });

    // Sticky product menu effect

    const pdMenu = document.querySelector(".pd-menu");

    if (pdMenu) {
      window.addEventListener("scroll", () => {
        if (window.scrollY > 400) {
          pdMenu.classList.add("stuck");
        } else {
          pdMenu.classList.remove("stuck");
        }
      });
    }

    links.forEach((a) => {
      a.classList.remove("active");

      if (a.getAttribute("href") === "#" + cur) {
        a.classList.add("active");
      }
    });
  });
});

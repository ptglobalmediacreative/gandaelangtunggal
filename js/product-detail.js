document.addEventListener("DOMContentLoaded", function () {
  /* ================= GALLERY SLIDER ================= */

  const track = document.querySelector(".pd-gallery-track");
  const items = document.querySelectorAll(".pd-gal-item");
  const prev = document.querySelector(".pd-gal-btn.prev");
  const next = document.querySelector(".pd-gal-btn.next");

  if (track && items.length > 0) {
    let index = 0;

    function update() {
      track.style.transform = `translateX(-${index * 100}%)`;
    }

    next.addEventListener("click", () => {
      index++;
      if (index >= items.length) index = 0;
      update();
    });

    prev.addEventListener("click", () => {
      index--;
      if (index < 0) index = items.length - 1;
      update();
    });
  }

  /* ================= ACTIVE MENU ================= */

  const links = document.querySelectorAll(".pd-menu a");
  const sections = document.querySelectorAll(".pd-section");

  window.addEventListener("scroll", () => {
    let current = "";

    sections.forEach((section) => {
      const top = section.offsetTop - 150;

      if (pageYOffset >= top) {
        current = section.getAttribute("id");
      }
    });

    links.forEach((a) => {
      a.classList.remove("active");

      if (a.getAttribute("href") === "#" + current) {
        a.classList.add("active");
      }
    });
  });
});

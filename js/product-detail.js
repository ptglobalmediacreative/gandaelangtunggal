document.addEventListener("DOMContentLoaded", () => {
  /* SLIDER */

  const track = document.querySelector(".pd-track");
  const slides = document.querySelectorAll(".pd-slide");
  const prev = document.querySelector(".pd-btn.prev");
  const next = document.querySelector(".pd-btn.next");

  let index = 0;

  function update() {
    track.style.transform = `translateX(-${index * 100}%)`;
  }

  if (next) {
    next.onclick = () => {
      index = (index + 1) % slides.length;
      update();
    };

    prev.onclick = () => {
      index = (index - 1 + slides.length) % slides.length;
      update();
    };
  }

  /* ACTIVE MENU */

  const links = document.querySelectorAll(".pd-menu a");
  const sections = document.querySelectorAll(".pd-section");

  window.addEventListener("scroll", () => {
    let current = "";

    sections.forEach((sec) => {
      if (pageYOffset >= sec.offsetTop - 150) {
        current = sec.id;
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

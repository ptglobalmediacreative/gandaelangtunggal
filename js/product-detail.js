document.addEventListener("DOMContentLoaded", function () {
  const track = document.querySelector(".pd-gallery-track");
  const items = document.querySelectorAll(".pd-gal-item");
  const prev = document.querySelector(".pd-gal-btn.prev");
  const next = document.querySelector(".pd-gal-btn.next");

  if (!track || items.length === 0) return;

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
});

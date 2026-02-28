/* ================= PREMIUM DETAIL ARTICLE JS ================= */

document.addEventListener("DOMContentLoaded", function () {
  /* ================= REVEAL ON SCROLL ================= */

  const revealElements = document.querySelectorAll(
    ".artikel-main, .artikel-sidebar, .related-card",
  );

  const revealObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("show");
        }
      });
    },
    {
      threshold: 0.15,
    },
  );

  revealElements.forEach((el) => {
    el.classList.add("reveal");
    revealObserver.observe(el);
  });

  /* ================= READING PROGRESS BAR ================= */

  const progressBar = document.createElement("div");
  progressBar.classList.add("reading-progress");
  document.body.appendChild(progressBar);

  window.addEventListener("scroll", function () {
    const scrollTop = window.scrollY;
    const docHeight =
      document.documentElement.scrollHeight -
      document.documentElement.clientHeight;

    const scrollPercent = (scrollTop / docHeight) * 100;

    progressBar.style.width = scrollPercent + "%";
  });
});

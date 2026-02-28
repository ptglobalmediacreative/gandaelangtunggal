// Simple fade-in animation
document.addEventListener("DOMContentLoaded", function () {
  const elements = document.querySelectorAll(".artikel-main, .artikel-sidebar");

  elements.forEach((el) => {
    el.style.opacity = 0;
    el.style.transform = "translateY(30px)";
    el.style.transition = "all 0.6s ease";

    setTimeout(() => {
      el.style.opacity = 1;
      el.style.transform = "translateY(0)";
    }, 200);
  });
});

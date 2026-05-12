/**
 * Main JavaScript - PT Ganda Elang Tangguh
 * Untuk semua halaman produk
 */

document.addEventListener("DOMContentLoaded", function () {

  // ================= FAQ ACCORDION =================
  const faqItems = document.querySelectorAll(".faq-item");

  if (faqItems.length > 0) {
    faqItems.forEach((item) => {
      const question = item.querySelector(".faq-question");

      if (question) {
        question.addEventListener("click", () => {
          // Close all other faq items
          faqItems.forEach((otherItem) => {
            if (otherItem !== item && otherItem.classList.contains("active")) {
              otherItem.classList.remove("active");
            }
          });

          // Toggle current item
          item.classList.toggle("active");
        });
      }
    });
  }

  // ================= SMOOTH SCROLL =================
  const smoothScrollLinks = document.querySelectorAll('a[href^="#"]');

  smoothScrollLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      const targetId = this.getAttribute("href");

      if (targetId !== "#" && targetId !== "#!") {
        const targetElement = document.querySelector(targetId);

        if (targetElement) {
          e.preventDefault();
          targetElement.scrollIntoView({
            behavior: "smooth",
            block: "start",
          });
        }
      }
    });
  });

  // ================= LAZY LOADING IMAGES =================
  if ("IntersectionObserver" in window) {
    const lazyImages = document.querySelectorAll('img[loading="lazy"]');

    const imageObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const img = entry.target;
          img.src = img.src;
          observer.unobserve(img);
        }
      });
    });

    lazyImages.forEach((img) => {
      imageObserver.observe(img);
    });
  }
});

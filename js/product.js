/**
 * Main JavaScript - PT Ganda Elang Tangguh
 * Untuk semua halaman produk
 */

document.addEventListener("DOMContentLoaded", function () {
  console.log("✅ JavaScript loaded successfully!");

  // ================= FAQ ACCORDION =================
  const faqItems = document.querySelectorAll(".faq-item");
  console.log("📌 Found FAQ items:", faqItems.length);

  if (faqItems.length > 0) {
    faqItems.forEach((item, index) => {
      const question = item.querySelector(".faq-question");
      const answer = item.querySelector(".faq-answer");

      console.log(`📌 FAQ #${index + 1}:`, {
        hasQuestion: !!question,
        hasAnswer: !!answer,
        questionText: question
          ? question.textContent.trim().substring(0, 30) + "..."
          : "N/A",
      });

      if (question) {
        // Hapus event listener lama (untuk mencegah duplikasi)
        question.removeEventListener("click", handleFaqClick);
        // Tambahkan event listener baru
        question.addEventListener("click", handleFaqClick);

        // Simpan reference ke item untuk digunakan di handler
        question._faqItem = item;
      } else {
        console.warn(`⚠️ FAQ #${index + 1} tidak memiliki .faq-question!`);
      }
    });
  } else {
    console.warn("⚠️ Tidak ada elemen .faq-item ditemukan di halaman!");
  }

  // ================= FAQ CLICK HANDLER =================
  function handleFaqClick(e) {
    const question = e.currentTarget;
    const item = question._faqItem || question.closest(".faq-item");

    if (!item) {
      console.warn("⚠️ Tidak dapat menemukan .faq-item parent!");
      return;
    }

    console.log(
      "🔄 FAQ clicked:",
      item.querySelector(".faq-question h3")?.textContent || "Unknown",
    );

    // Cek apakah item sudah aktif
    const isActive = item.classList.contains("active");
    console.log("📊 Current state:", isActive ? "ACTIVE" : "INACTIVE");

    // Toggle class 'active'
    item.classList.toggle("active");

    // Log state setelah toggle
    console.log(
      "📊 New state:",
      item.classList.contains("active") ? "ACTIVE ✅" : "INACTIVE ❌",
    );

    // Optional: Tutup FAQ lain (accordion mode)
    // Hanya jika kita ingin mode accordion (satu buka)
    if (item.classList.contains("active")) {
      const allItems = document.querySelectorAll(".faq-item");
      allItems.forEach((otherItem) => {
        if (otherItem !== item && otherItem.classList.contains("active")) {
          otherItem.classList.remove("active");
          console.log("📌 Closed other FAQ");
        }
      });
    }
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
          console.log("📌 Scrolled to:", targetId);
        }
      }
    });
  });

  // ================= LAZY LOADING IMAGES =================
  if ("IntersectionObserver" in window) {
    const lazyImages = document.querySelectorAll('img[loading="lazy"]');
    console.log("📌 Found lazy images:", lazyImages.length);

    const imageObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const img = entry.target;
          if (img.getAttribute("data-src")) {
            img.src = img.getAttribute("data-src");
            console.log("📌 Lazy loaded image:", img.alt || "Unknown");
          }
          observer.unobserve(img);
        }
      });
    });

    lazyImages.forEach((img) => {
      imageObserver.observe(img);
    });
  } else {
    console.warn(
      "⚠️ IntersectionObserver tidak didukung, fallback ke loading biasa",
    );
    // Fallback untuk browser lama
    document.querySelectorAll('img[loading="lazy"]').forEach((img) => {
      if (img.getAttribute("data-src")) {
        img.src = img.getAttribute("data-src");
      }
    });
  }

  console.log("✅ All JavaScript initialized successfully!");
});

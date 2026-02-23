<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>PT Ganda Elang Tangguh - About Us</title>

  <!-- Main CSS -->
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/contact/hero.css">
  <link rel="stylesheet" href="/css/contact/contact.css">
  <link rel="stylesheet" href="/css/footer.css">

  <!-- Favicon -->
  <link rel="icon" type="image/webp" href="/images/favicon.webp">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
  >
</head>

<body>

<!-- ================= HEADER ================= -->
<header class="header">
  <div class="container">

    <!-- Logo -->
    <div class="logo">
      <img src="/images/logo.webp" alt="PT Ganda Elang Tangguh Logo">
    </div>

    <!-- Navigation -->
    <nav class="navbar" id="navbar">
      <a href="/index.php">Beranda</a>
      <a href="/about.php">Tentang Kami</a>
      <a href="/produk.php">Produk</a>
      <a href="/aftersales.php" class="active">Layanan Purna Jual</a>
      <a href="/kontak.php">Hubungi Kami</a>
      <a href="/blog.php">Blog & Artikel</a>
    </nav>

    <!-- Hamburger -->
    <div class="hamburger" id="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </div>

  </div>
</header>


<!-- ================= HERO ================= -->
<section
  class="hero hero-image"
  style="background: url('/images/about.png') center / cover no-repeat;"
>

  <!-- Overlay -->
  <div class="hero-overlay"></div>

  <!-- Content -->
  <div class="hero-content">

    <!-- Breadcrumb -->
    <div class="hero-breadcrumb">
      <a href="/index.php">Home</a>
      <span>></span>
      <span class="current">Aftersales</span>
    </div>

    <h1>Aftersales</h1>

  </div>

</section>

<!-- ================= PREMIUM CONTACT ================= -->
<section class="contact-premium">

  <div class="contact-bg"></div>

  <div class="container">

    <div class="contact-wrap">

      <!-- FORM -->
      <div class="contact-card">

        <h2>Hubungi Tim Kami</h2>
        <p>Konsultasikan kebutuhan layanan unit Anda bersama tim profesional kami.</p>

        <form>

          <div class="input-group">
            <input type="text" required>
            <label>Your Name</label>
          </div>

          <div class="input-group">
            <input type="tel" required>
            <label>Number Phone</label>
          </div>

          <div class="input-group">
            <input type="email" required>
            <label>Email</label>
          </div>

          <div class="input-group">
            <textarea required></textarea>
            <label>Messages</label>
          </div>

          <button type="submit">Send Message</button>

        </form>

      </div>


      <!-- MAP -->
      <div class="contact-map-premium">

        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.0683472713463!2d106.77268407316569!3d-6.121503360022286!2m3!1f0!2f0!3f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f7005d2d391b%3A0xdf080d223c96ca6f!2sPT.%20Ganda%20Elang%20Tangguh!5e0!3m2!1sid!2sid"
          loading="lazy">
        </iframe>

      </div>

    </div>

  </div>

</section>

<!-- ================= FOOTER ================= -->
<?php include $_SERVER['DOCUMENT_ROOT'] . "/footer.php"; ?>


<!-- ================= SCRIPT ================= -->
<script src="/js/main.js"></script>

</body>
</html>

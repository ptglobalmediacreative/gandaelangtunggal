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
      <a href="/aftersales.php">Layanan Purna Jual</a>
      <a href="/contact.php" class="active">Hubungi Kami</a>
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
      <span class="current">Contact Us</span>
    </div>

    <h1>Contact Us</h1>

  </div>

</section>

<!-- ================= SIMPLE CONTACT ================= -->
<section class="contact-simple">

  <div class="contact-container">

    <div class="contact-title">
      <h2>Contact Our Professional Team</h2>
      <p>
        Konsultasikan kebutuhan layanan dan dukungan unit Anda
        bersama tim PT Ganda Elang Tangguh.
      </p>
    </div>

    <div class="contact-card">

      <!-- LEFT FORM -->
      <div class="contact-form-simple">

        <div class="form-group">
          <label>Full Name</label>
          <input type="text" placeholder="Enter your full name">
        </div>

        <div class="form-group">
          <label>Phone Number</label>
          <input type="text" placeholder="Enter your phone number">
        </div>

        <div class="form-group">
          <label>Email Address</label>
          <input type="email" placeholder="Enter your email address">
        </div>

        <div class="form-group">
          <label>Your Message</label>
          <textarea placeholder="Write your message here..."></textarea>
        </div>

        <button class="btn-contact">Send Message</button>

      </div>

      <!-- RIGHT MAP -->
      <div class="contact-map-simple">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.0683472713463!2d106.77268407316569!3d-6.121503360022286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f7005d2d391b%3A0xdf080d223c96ca6f!2sPT.%20Ganda%20Elang%20Tangguh!5e0!3m2!1sid!2sid"
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

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>PT Ganda Elang Tangguh - About Us</title>

  <!-- Main CSS -->
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/aftersales/hero.css">
  <link rel="stylesheet" href="/css/aftersales/aftersales.css">
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
      <a href="/about.php" class="active">Tentang Kami</a>
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

<!-- ================= AFTERSALES SECTION ================= -->
<section class="aftersales">
  <div class="container">

    <div class="aftersales-wrapper">

      <!-- LEFT CONTENT -->
      <div class="aftersales-info">

        <span>Layanan Purna Jual</span>

        <h2>
          Solusi Aftersales Terpercaya
          untuk Kinerja Unit Anda
        </h2>

        <p>
          PT Ganda Elang Tangguh menghadirkan layanan purna jual
          profesional untuk menjaga performa alat berat Anda
          tetap optimal, aman, dan berkelanjutan.
        </p>

        <ul>
          <li><i class="fa-solid fa-check"></i> Teknisi Bersertifikat</li>
          <li><i class="fa-solid fa-check"></i> Dukungan 24 Jam</li>
          <li><i class="fa-solid fa-check"></i> Sparepart Original</li>
          <li><i class="fa-solid fa-check"></i> Respon Cepat</li>
        </ul>

        <a href="/kontak.php" class="btn-main">
          Konsultasi Sekarang
        </a>

      </div>


      <!-- RIGHT CARDS -->
      <div class="aftersales-services">

        <div class="service-card">
          <i class="fa-solid fa-screwdriver-wrench"></i>
          <h3>Servis Berkala</h3>
          <p>Perawatan rutin untuk menjaga performa mesin tetap maksimal.</p>
        </div>

        <div class="service-card">
          <i class="fa-solid fa-truck-fast"></i>
          <h3>On-Site Support</h3>
          <p>Dukungan teknisi langsung di lokasi proyek Anda.</p>
        </div>

        <div class="service-card">
          <i class="fa-solid fa-gears"></i>
          <h3>Suku Cadang</h3>
          <p>Penyediaan sparepart original dan bergaransi.</p>
        </div>

        <div class="service-card">
          <i class="fa-solid fa-headset"></i>
          <h3>Helpdesk Teknis</h3>
          <p>Layanan konsultasi untuk troubleshooting unit Anda.</p>
        </div>

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

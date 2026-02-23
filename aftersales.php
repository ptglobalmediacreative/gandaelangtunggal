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
      <a href="/layanan.php">Layanan Purna Jual</a>
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

    <div class="aftersales-header">
      <span class="subtitle">Layanan Purna Jual</span>
      <h2>Dukungan Profesional untuk Performa Maksimal</h2>
      <p>
        PT Ganda Elang Tangguh berkomitmen memberikan layanan purna jual terbaik 
        untuk memastikan setiap unit alat berat Anda bekerja optimal, efisien, 
        dan memiliki umur operasional yang panjang.
      </p>
    </div>

    <div class="aftersales-grid">

      <!-- Item 1 -->
      <div class="aftersales-card">
        <div class="icon">
          <i class="fa-solid fa-screwdriver-wrench"></i>
        </div>
        <h3>Perawatan & Servis Berkala</h3>
        <p>
          Layanan maintenance rutin yang dilakukan oleh teknisi berpengalaman 
          untuk menjaga performa dan mencegah kerusakan yang tidak terduga.
        </p>
      </div>

      <!-- Item 2 -->
      <div class="aftersales-card">
        <div class="icon">
          <i class="fa-solid fa-truck-fast"></i>
        </div>
        <h3>Respons Cepat di Lapangan</h3>
        <p>
          Tim teknis kami siap memberikan dukungan langsung di lokasi proyek 
          Anda dengan penanganan cepat dan solusi yang tepat.
        </p>
      </div>

      <!-- Item 3 -->
      <div class="aftersales-card">
        <div class="icon">
          <i class="fa-solid fa-gears"></i>
        </div>
        <h3>Suku Cadang Original</h3>
        <p>
          Ketersediaan spare part asli dan berkualitas untuk memastikan 
          ketahanan unit serta menjaga standar performa pabrikan.
        </p>
      </div>

      <!-- Item 4 -->
      <div class="aftersales-card">
        <div class="icon">
          <i class="fa-solid fa-headset"></i>
        </div>
        <h3>Konsultasi Teknis</h3>
        <p>
          Dukungan teknis profesional untuk membantu Anda dalam 
          pengoperasian, troubleshooting, dan optimalisasi unit.
        </p>
      </div>

    </div>

    <!-- CTA -->
    <div class="aftersales-cta">
      <h3>Butuh Dukungan Teknis?</h3>
      <p>Tim kami siap membantu kebutuhan layanan unit Anda.</p>
      <a href="/kontak.php" class="btn-aftersales">Hubungi Kami</a>
    </div>

  </div>
</section>



<!-- ================= FOOTER ================= -->
<?php include $_SERVER['DOCUMENT_ROOT'] . "/footer.php"; ?>


<!-- ================= SCRIPT ================= -->
<script src="/js/main.js"></script>

</body>
</html>

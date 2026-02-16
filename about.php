<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>PT Ganda Elang Tangguh - About Us</title>

  <!-- Main CSS -->
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/about/hero.css">
  <link rel="stylesheet" href="/css/about/about.css">
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
<section class="hero hero-image">

  <!-- Overlay -->
  <div class="hero-overlay"></div>

  <!-- Content -->
  <div class="hero-content">

    <!-- Breadcrumb -->
    <div class="hero-breadcrumb">
      Home <span>></span> About Us
    </div>

    <h1>ABOUT US</h1>

  </div>

</section>


<!-- ================= ABOUT SUMMARY ================= -->
<section class="about-summary">

  <div class="about-container">

    <h2 class="about-title">
      Sekilas Tentang PT Ganda Elang Tangguh
    </h2>

    <p class="about-text">
      PT Ganda Elang Tangguh merupakan dealer alat berat yang terpercaya
      dan berpengalaman dalam menyediakan solusi lengkap untuk kebutuhan
      industri. Dengan komitmen tinggi terhadap kualitas dan kepuasan
      pelanggan, kami terus membangun reputasi sebagai mitra bisnis yang
      andal di Indonesia.
    </p>

    <p class="about-text">
      Kami menyediakan berbagai produk alat berat berkualitas tinggi
      dari produsen terkemuka, seperti excavator, bulldozer, wheel loader,
      motor grader, serta berbagai unit pendukung lainnya.
    </p>

    <p class="about-text">
      Didukung oleh tim profesional dan teknisi berpengalaman,
      kami juga menyediakan layanan purna jual, suku cadang asli,
      serta perawatan berkala untuk memastikan operasional pelanggan
      tetap optimal dan produktif.
    </p>

    <a href="/about-detail.php" class="about-link">
      → Selengkapnya Tentang Kami
    </a>

  </div>

</section>


<!-- ================= FOOTER ================= -->
<?php include $_SERVER['DOCUMENT_ROOT'] . "/footer.php"; ?>


<!-- ================= SCRIPT ================= -->
<script src="/js/main.js"></script>

</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>PT Ganda Elang Tangguh - Product</title>

  <!-- Main CSS -->
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/product/hero.css">
  <link rel="stylesheet" href="/css/product/product.css">
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

  <div class="hero-breadcrumb">
    <a href="/index.php">Home</a>
    <span>></span>
    <span class="current">Product</span>
  </div>

    <h1>Product</h1>

  </div>

</section>

<!-- ================= PRODUCT CATEGORY ================= -->
<section class="product-category">

  <div class="category-container">

    <h2 class="category-title">Kategori Produk</h2>
    <p class="category-subtitle">
      Berbagai jenis alat berat untuk mendukung kebutuhan proyek Anda
    </p>

    <div class="category-grid">

      <!-- Item -->
      <div class="category-card">
        <img src="/images/products/wheel-loader.jpg" alt="Wheel Loader">
        <h4>Wheel Loader</h4>
      </div>

      <div class="category-card">
        <img src="/images/products/excavator.jpg" alt="Excavator">
        <h4>Excavator</h4>
      </div>

      <div class="category-card">
        <img src="/images/products/bulldozer.jpg" alt="Bulldozer">
        <h4>Bulldozer</h4>
      </div>

      <div class="category-card">
        <img src="/images/products/motor-grader.jpg" alt="Motor Grader">
        <h4>Motor Grader</h4>
      </div>

      <div class="category-card">
        <img src="/images/products/mining-truck.jpg" alt="Mining Truck">
        <h4>Mining Truck</h4>
      </div>

      <div class="category-card">
        <img src="/images/products/roller.jpg" alt="Roller">
        <h4>Roller</h4>
      </div>

      <div class="category-card">
        <img src="/images/products/paver.jpg" alt="Paver">
        <h4>Paver</h4>
      </div>

      <div class="category-card">
        <img src="/images/products/cold-planer.jpg" alt="Cold Planer">
        <h4>Cold Planer</h4>
      </div>

      <div class="category-card">
        <img src="/images/products/skid-steer.jpg" alt="Skid Steer Loader">
        <h4>Skid Steer</h4>
      </div>

      <div class="category-card">
        <img src="/images/products/backhoe.jpg" alt="Backhoe Loader">
        <h4>Backhoe Loader</h4>
      </div>

      <div class="category-card">
        <img src="/images/products/forklift.png" alt="Forklift">
        <h4>Forklift</h4>
      </div>

      <div class="category-card">
        <img src="/images/products/aerial.png" alt="Aerial Work Platform">
        <h4>Aerial Platform</h4>
      </div>

      <div class="category-card">
        <img src="/images/products/crane.jpg" alt="Crane">
        <h4>Crane</h4>
      </div>

      <div class="category-card">
        <img src="/images/products/tractor.png" alt="Tractor">
        <h4>Tractor</h4>
      </div>

      <div class="category-card">
        <img src="/images/products/harvester.png" alt="Harvester">
        <h4>Harvester</h4>
      </div>

      <div class="category-card">
        <img src="/images/products/compressor.png" alt="Air Compressor">
        <h4>Air Compressor</h4>
      </div>

      <div class="category-card">
        <img src="/images/products/foundation.jpg" alt="Foundation Equipment">
        <h4>Foundation</h4>
      </div>

      <div class="category-card">
        <img src="/images/products/warehouse.png" alt="Warehouse Truck">
        <h4>Warehouse Truck</h4>
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
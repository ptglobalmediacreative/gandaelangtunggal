<?php
// ================= DATABASE =================
require_once __DIR__ . '/admin/config.php';

// ================= GET PRODUCT + SPEC =================
$stmt = $pdo->prepare("
    SELECT 
        p.id,
        p.nama_produk,
        p.slug,
        p.gambar,

        -- Ambil spesifikasi tertentu
        MAX(CASE WHEN ps.label = 'Operating Weight' THEN ps.nilai END) AS operating_weight,
        MAX(CASE WHEN ps.label = 'Rated power' THEN ps.nilai END) AS rated_power,
        MAX(CASE WHEN ps.label = 'Bucket Capacity' THEN ps.nilai END) AS bucket_capacity

    FROM produk p

    LEFT JOIN produk_spesifikasi ps 
        ON p.id = ps.produk_id

    WHERE p.status = 'aktif'

    GROUP BY p.id

    ORDER BY p.id DESC
");

$stmt->execute();
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>PT Ganda Elang Tangguh - Produk</title>

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

    <div class="logo">
      <img src="/images/logo.webp" alt="PT Ganda Elang Tangguh Logo">
    </div>

    <nav class="navbar" id="navbar">
      <a href="/index.php">Beranda</a>
      <a href="/about.php">Tentang Kami</a>
      <a href="/produk.php" class="active">Produk</a>
      <a href="/layanan.php">Layanan Purna Jual</a>
      <a href="/kontak.php">Hubungi Kami</a>
      <a href="/blog.php">Blog & Artikel</a>
    </nav>

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
  style="background: url('/images/wheelloader.jpg') center / cover no-repeat;"
>

  <div class="hero-overlay"></div>

  <div class="hero-content">

    <div class="hero-breadcrumb">
      <a href="/index.php">Home</a>
      <span>></span>
      <a href="/produk.php">Produk</a>
      <span>></span>
      <span class="current">Wheel Loaders</span>
    </div>

    <h1>Power That Moves Productivity</h1>

    <p class="hero-subtext">
      High-performance wheel loaders designed for efficient material handling,
      superior durability, and maximum productivity across various applications.
    </p>

  </div>

</section>


<!-- ================= PRODUCT LIST ================= -->
<section class="product-list">

  <div class="product-container">

    <h2 class="product-title">Daftar Produk</h2>

    <div class="product-grid">

      <?php if (!empty($products)) : ?>
        <?php foreach ($products as $row) : ?>

          <div class="product-card">

            <a 
              href="/produk-detail.php?slug=<?= htmlspecialchars($row['slug']); ?>" 
              class="product-link"
            >

              <!-- IMAGE -->
              <div class="product-image">
                <img 
                  src="/images/uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" 
                  alt="<?= htmlspecialchars($row['nama_produk']); ?>"
                >
              </div>

              <!-- INFO -->
              <div class="product-info">

                <h3><?= htmlspecialchars($row['nama_produk']); ?></h3>

                <ul class="product-spec">

                  <?php if (!empty($row['operating_weight'])) : ?>
                    <li>
                      <span>Operating Weight</span>
                      <strong><?= htmlspecialchars($row['operating_weight']); ?></strong>
                    </li>
                  <?php endif; ?>

                  <?php if (!empty($row['rated_power'])) : ?>
                    <li>
                      <span>Rated Power</span>
                      <strong><?= htmlspecialchars($row['rated_power']); ?></strong>
                    </li>
                  <?php endif; ?>

                  <?php if (!empty($row['bucket_capacity'])) : ?>
                    <li>
                      <span>Bucket Capacity</span>
                      <strong><?= htmlspecialchars($row['bucket_capacity']); ?></strong>
                    </li>
                  <?php endif; ?>

                </ul>

              </div>

            </a>

          </div>

        <?php endforeach; ?>

      <?php else : ?>

        <p class="no-product">Belum ada produk tersedia.</p>

      <?php endif; ?>

    </div>

  </div>

</section>


<!-- ================= FOOTER ================= -->
<?php include $_SERVER['DOCUMENT_ROOT'] . "/footer.php"; ?>


<!-- ================= SCRIPT ================= -->
<script src="/js/main.js"></script>

</body>
</html>

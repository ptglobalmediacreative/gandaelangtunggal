<?php
// ================= DATABASE =================
require_once __DIR__ . '/admin/config.php';

// ================= GET PRODUCT + OPERATING WEIGHT =================
$stmt = $pdo->prepare("
    SELECT 
        p.id,
        p.nama_produk,
        p.slug,
        p.gambar,

        MAX(CASE WHEN ps.label = 'Operating Weight' THEN ps.nilai END) AS operating_weight

    FROM produk p

    LEFT JOIN produk_spesifikasi ps 
        ON p.id = ps.produk_id

    WHERE p.status = 'aktif'
    AND p.category_id = 16

    GROUP BY 
        p.id,
        p.nama_produk,
        p.slug,
        p.gambar

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

<title>Air Compressor Industrial | PT Ganda Elang Tangguh</title>

<!-- SEO -->
<meta name="description" content="Temukan berbagai air compressor industrial berkualitas di PT Ganda Elang Tangguh. Solusi udara bertekanan yang andal untuk kebutuhan proyek konstruksi, industri, dan operasional lapangan.">

<meta name="keywords" content="air compressor industri, kompresor udara industri, air compressor proyek, kompresor udara portable, alat industri indonesia">

<meta name="author" content="PT Ganda Elang Tangguh">
<meta name="robots" content="index, follow, max-image-preview:large">

<link rel="canonical" href="https://gandaelang.co.id/aircompressor.php">

<!-- Open Graph -->
<meta property="og:title" content="Air Compressor Industrial | PT Ganda Elang Tangguh">
<meta property="og:description" content="Solusi air compressor berkualitas untuk kebutuhan industri dan proyek konstruksi.">
<meta property="og:image" content="https://gandaelang.co.id/images/aircompressor.png">
<meta property="og:url" content="https://gandaelang.co.id/aircompressor.php">
<meta property="og:type" content="website">
<meta property="og:site_name" content="PT Ganda Elang Tangguh">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Air Compressor Industrial">
<meta name="twitter:description" content="Air compressor berkualitas tinggi untuk kebutuhan industri dan proyek konstruksi.">
<meta name="twitter:image" content="https://gandaelang.co.id/images/aircompressor.png">

<!-- Favicon -->
<link rel="icon" type="image/webp" href="/images/favicon.webp">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- CSS -->
<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/css/product/hero.css">
<link rel="stylesheet" href="/css/product/product.css">
<link rel="stylesheet" href="/css/footer.css">

<!-- Breadcrumb Schema -->
<script type="application/ld+json">
{
 "@context": "https://schema.org",
 "@type": "BreadcrumbList",
 "itemListElement": [
  {
   "@type": "ListItem",
   "position": 1,
   "name": "Beranda",
   "item": "https://gandaelang.co.id/"
  },
  {
   "@type": "ListItem",
   "position": 2,
   "name": "Produk",
   "item": "https://gandaelang.co.id/produk.php"
  },
  {
   "@type": "ListItem",
   "position": 3,
   "name": "Air Compressor",
   "item": "https://gandaelang.co.id/aircompressor.php"
  }
 ]
}
</script>

<!-- Collection Page Schema -->
<script type="application/ld+json">
{
 "@context": "https://schema.org",
 "@type": "CollectionPage",
 "name": "Air Compressor Industrial",
 "url": "https://gandaelang.co.id/aircompressor.php",
 "description": "Daftar produk air compressor yang tersedia di PT Ganda Elang Tangguh untuk kebutuhan industri dan proyek.",
 "publisher": {
   "@type": "Organization",
   "name": "PT Ganda Elang Tangguh",
   "logo": {
     "@type": "ImageObject",
     "url": "https://gandaelang.co.id/images/logo.webp"
   }
 }
}
</script>

</head>

<body>

<!-- ================= HEADER ================= -->
<header class="header">
  <div class="container">

    <div class="logo">
        <a href="/index.php">
            <img src="/images/logo.webp" alt="PT Ganda Elang Tangguh Logo">
        </a>
    </div>

    <nav class="navbar" id="navbar">
      <a href="/index.php">Beranda</a>
      <a href="/about.php">Tentang Kami</a>
      <a href="/produk.php" class="active">Produk</a>
      <a href="/aftersales.php">Layanan Purna Jual</a>
      <a href="/contact.php">Hubungi Kami</a>
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
  style="background: url('/images/aircompressor.png') center / cover no-repeat;"
>
  <div class="hero-overlay"></div>

  <div class="hero-content">

    <div class="hero-breadcrumb">
      <a href="/index.php">Home</a>
      <span>></span>
      <a href="/product.php">Product</a>
      <span>></span>
      <span class="current">Air Compressor</span>
    </div>

    <h1>Powering Performance</h1>

    <p class="hero-subtext">
      Reliable compressed air solutions for industrial and on-site operations.
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

            <!-- LINK -->
            <a href="/detailprodukaircompressor.webp?slug=<?= htmlspecialchars($row['slug']); ?>" 
               class="product-link">

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

                <!-- SPEC -->
                <?php if (!empty($row['operating_weight'])) : ?>
                  <ul class="product-spec">
                    <li>
                      <span>Operating Weight</span>
                      <span><?= htmlspecialchars($row['operating_weight']); ?></span>
                    </li>
                  </ul>
                <?php endif; ?>

                <!-- BUTTON -->
                <div class="product-btn">
                Detail Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                </div>


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

</body>
</html>

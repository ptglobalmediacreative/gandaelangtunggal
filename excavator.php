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
    AND p.category_id = 2

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

<?php
$currentUrl = "https://gandaelang.co.id/excavator.php";
?>

<title>Excavator LiuGong Indonesia | PT Ganda Elang Tangguh</title>

<meta name="description" content="Daftar excavator LiuGong di Indonesia. Tersedia berbagai model excavator untuk konstruksi, pertambangan, dan proyek infrastruktur dengan performa tinggi.">

<meta name="keywords" content="excavator liugong, excavator indonesia, alat berat excavator, dealer liugong indonesia, excavator construction equipment">

<meta name="robots" content="index, follow, max-image-preview:large">

<meta name="author" content="PT Ganda Elang Tangguh">

<link rel="canonical" href="<?= $currentUrl ?>">

<!-- Open Graph -->
<meta property="og:title" content="Excavator LiuGong Indonesia | PT Ganda Elang Tangguh">
<meta property="og:description" content="Lihat berbagai model excavator LiuGong untuk konstruksi, pertambangan, dan proyek infrastruktur di Indonesia.">
<meta property="og:image" content="https://gandaelang.co.id/images/excavator.jpg">
<meta property="og:url" content="<?= $currentUrl ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="PT Ganda Elang Tangguh">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Excavator LiuGong Indonesia">
<meta name="twitter:description" content="Daftar excavator LiuGong untuk konstruksi dan pertambangan di Indonesia.">
<meta name="twitter:image" content="https://gandaelang.co.id/images/excavator.jpg">

<!-- Schema Category Page -->
<script type="application/ld+json">
{
 "@context": "https://schema.org",
 "@type": "CollectionPage",
 "name": "Excavator LiuGong Indonesia",
 "description": "Daftar excavator LiuGong untuk konstruksi, pertambangan, dan proyek infrastruktur.",
 "url": "https://gandaelang.co.id/excavator.php",
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

<!-- CSS -->
<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/css/product/hero.css">
<link rel="stylesheet" href="/css/product/product.css">
<link rel="stylesheet" href="/css/footer.css">

<link rel="icon" type="image/webp" href="/images/favicon.webp">

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
  style="background: url('/images/excavator.jpg') center / cover no-repeat;"
>
  <div class="hero-overlay"></div>

  <div class="hero-content">

    <div class="hero-breadcrumb">
      <a href="/index.php">Home</a>
      <span>></span>
      <a href="/product.php">Product</a>
      <span>></span>
      <span class="current">Excavator</span>
    </div>

    <h1>Built to Dig Deeper</h1>

    <p class="hero-subtext">
      Powerful and versatile excavators engineered for heavy-duty digging, lifting, and earthmoving applications in diverse terrains.
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
            <a href="/detailprodukexcavator.php?slug=<?= htmlspecialchars($row['slug']); ?>" 
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

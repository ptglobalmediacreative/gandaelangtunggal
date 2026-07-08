<?php
require_once __DIR__ . '/admin/config.php';

/* ================= VALIDASI SLUG ================= */
if (!isset($_GET['slug'])) {
    header("Location: /produk.php");
    exit;
}

$slug = $_GET['slug'];

/* ================= PRODUCT (KHUSUS CATEGORY 13 = CRANE) ================= */
$stmt = $pdo->prepare("
    SELECT p.*, c.name AS kategori
    FROM produk p
    LEFT JOIN categories c ON p.category_id = c.id
    WHERE p.slug = ?
      AND p.category_id = 13
      AND p.status = 'aktif'
    LIMIT 1
");
$stmt->execute([$slug]);
$product = $stmt->fetch();

if (!$product) {
    header("Location: /produk.php");
    exit;
}

/* ================= HERO (DARI CRANE) ================= */
$q = $pdo->prepare("
    SELECT image
    FROM produk_gallery
    WHERE produk_id = ?
    ORDER BY sort_order ASC
    LIMIT 1
");
$q->execute([$product['id']]);
$hero = $q->fetch();

$heroImage = $hero
    ? "/images/uploads/produk/" . $hero['image']
    : "/images/hero.jpg";

/* ================= FEATURES ================= */
$q = $pdo->prepare("
    SELECT *
    FROM produk_features
    WHERE produk_id = ?
    ORDER BY sort_order
");
$q->execute([$product['id']]);
$features = $q->fetchAll();

/* ================= SPECIFICATIONS ================= */
$q = $pdo->prepare("
    SELECT *
    FROM produk_spesifikasi
    WHERE produk_id = ?
    ORDER BY grup, sort_order
");
$q->execute([$product['id']]);
$specs = $q->fetchAll();

$group = [];
foreach ($specs as $s) {
    $group[$s['grup']][] = $s;
}

/* ================= GALLERY ================= */
$q = $pdo->prepare("
    SELECT *
    FROM produk_gallery
    WHERE produk_id = ?
    ORDER BY sort_order
");
$q->execute([$product['id']]);
$gallery = $q->fetchAll();

/* ================= RECOMMENDED (SESAMA CRANE) ================= */
$q = $pdo->prepare("
    SELECT *
    FROM produk
    WHERE status = 'aktif'
      AND category_id = 13
      AND id != ?
    ORDER BY RAND()
    LIMIT 4
");
$q->execute([$product['id']]);
$rec = $q->fetchAll();

/* ================= VARIABEL SEO ================= */
$currentUrl = "https://gandaelang.co.id/detailprodukcrane.php?slug=" . urlencode($product['slug']);
$productImage = "https://gandaelang.co.id/images/uploads/produk/" . htmlspecialchars($product['gambar']);
$productName = htmlspecialchars($product['nama_produk']);
$productDesc = "Crane LiuGong " . $productName . " dari PT Ganda Elang Tangguh, dealer resmi LiuGong di Indonesia. Spesifikasi lengkap, fitur unggulan, dan harga crane LiuGong untuk pekerjaan lifting, konstruksi, dan proyek industri berat.";
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">

<!-- SEO Meta -->
<title><?= $productName ?> | Crane LiuGong | Dealer Resmi LiuGong Indonesia</title>

<meta name="description" content="<?= htmlspecialchars($productDesc) ?>">

<meta name="keywords" content="<?= $productName ?>, crane liugong, alat berat crane, crane konstruksi, crane liugong indonesia, dealer resmi liugong indonesia, dealer liugong jakarta, pt ganda elang tangguh, alat berat liugong, mobile crane">

<meta name="author" content="PT Ganda Elang Tangguh">
<meta name="robots" content="index, follow, max-image-preview:large">
<meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
<meta http-equiv="content-language" content="id-ID">

<link rel="canonical" href="<?= $currentUrl ?>">

<!-- Open Graph -->
<meta property="og:title" content="<?= $productName ?> | Crane LiuGong | Dealer Resmi LiuGong Indonesia">
<meta property="og:description" content="<?= htmlspecialchars($productDesc) ?>">
<meta property="og:image" content="<?= $productImage ?>">
<meta property="og:url" content="<?= $currentUrl ?>">
<meta property="og:type" content="product">
<meta property="og:site_name" content="PT Ganda Elang Tangguh - Dealer Resmi LiuGong">
<meta property="og:locale" content="id_ID">
<meta property="product:brand" content="LiuGong">
<meta property="product:availability" content="in stock">
<meta property="product:condition" content="new">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= $productName ?> | Crane LiuGong | Dealer Resmi LiuGong Indonesia">
<meta name="twitter:description" content="<?= htmlspecialchars($productDesc) ?>">
<meta name="twitter:image" content="<?= $productImage ?>">

<!-- Organization Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "@id": "https://gandaelang.co.id/#organization",
  "name": "PT Ganda Elang Tangguh",
  "alternateName": [
    "Dealer Resmi LiuGong Indonesia",
    "Dealer LiuGong Jakarta"
  ],
  "url": "https://gandaelang.co.id",
  "logo": "https://gandaelang.co.id/images/logo.webp",
  "image": "https://gandaelang.co.id/images/logo.webp",
  "description": "PT Ganda Elang Tangguh adalah dealer resmi LiuGong di Indonesia. Menyediakan alat berat LiuGong berkualitas, sparepart asli, dan layanan purna jual profesional."
}
</script>

<!-- Breadcrumb Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "@id": "<?= $currentUrl ?>/#breadcrumb",
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
      "name": "Produk Alat Berat LiuGong",
      "item": "https://gandaelang.co.id/produk.php"
    },
    {
      "@type": "ListItem",
      "position": 3,
      "name": "Crane LiuGong",
      "item": "https://gandaelang.co.id/crane.php"
    },
    {
      "@type": "ListItem",
      "position": 4,
      "name": "<?= $productName ?>",
      "item": "<?= $currentUrl ?>"
    }
  ]
}
</script>

<!-- Product Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Product",
  "@id": "<?= $currentUrl ?>/#product",
  "name": "<?= $productName ?> - Crane LiuGong",
  "image": "<?= $productImage ?>",
  "description": "<?= htmlspecialchars($productDesc) ?>",
  "category": "Crane",
  "brand": {
    "@type": "Brand",
    "name": "LiuGong"
  },
  "manufacturer": {
    "@type": "Organization",
    "name": "LiuGong Machinery"
  },
  "offers": {
    "@type": "Offer",
    "url": "<?= $currentUrl ?>",
    "priceCurrency": "IDR",
    "availability": "https://schema.org/InStock",
    "itemCondition": "https://schema.org/NewCondition",
    "seller": {
      "@type": "Organization",
      "@id": "https://gandaelang.co.id/#organization",
      "name": "PT Ganda Elang Tangguh"
    },
    "areaServed": {
      "@type": "Country",
      "name": "Indonesia"
    }
  },
  "url": "<?= $currentUrl ?>"
}
</script>

<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/css/product/detail-product.css">
<link rel="stylesheet" href="/css/product/hero.css">
<link rel="stylesheet" href="/css/footer.css">

<link rel="icon" type="image/webp" href="/images/favicon.webp">

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<div class="pd-page">

<!-- ================= HEADER ================= -->
<header class="header">
  <div class="container">
    <div class="logo">
        <a href="/index.php">
            <img src="/images/logo.webp" alt="PT Ganda Elang Tangguh - Dealer Resmi LiuGong Indonesia">
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
<section class="hero hero-image" style="background: url('<?= $heroImage ?>') center / cover no-repeat;">
  <div class="hero-overlay"></div>
  <div class="hero-content">

    <!-- Breadcrumb -->
    <div class="hero-breadcrumb">
      <a href="/index.php">Beranda</a>
      <span>›</span>
      <a href="/produk.php">Produk</a>
      <span>›</span>
      <a href="/crane.php">Crane</a>
      <span>›</span>
      <span class="current"><?= $productName ?></span>
    </div>

    <!-- Title -->
    <h1><?= $productName ?> - Crane LiuGong</h1>

  </div>
</section>

<!-- MENU -->
<nav class="pd-menu">
  <div class="pd-menu-inner">
    <div class="pd-menu-product">
      <img src="/images/uploads/produk/<?= htmlspecialchars($product['gambar']); ?>" alt="<?= $productName ?> - Crane LiuGong">
      <span><?= $productName ?></span>
    </div>
    <div class="pd-menu-nav">
      <?php if (!empty($features)): ?>
      <a href="#pd-features">Fitur</a>
      <?php endif; ?>
      <?php if (!empty($group)): ?>
      <a href="#pd-specifications">Spesifikasi</a>
      <?php endif; ?>
      <?php if (!empty($gallery)): ?>
      <a href="#pd-gallery">Galeri</a>
      <?php endif; ?>
      <?php if (!empty($rec)): ?>
      <a href="#pd-recommended">Rekomendasi</a>
      <?php endif; ?>
    </div>
  </div>
</nav>

<!-- FEATURES -->
<?php if (!empty($features)): ?>
<section id="pd-features" class="pd-section">
  <h2>Fitur Unggulan <?= $productName ?></h2>
  <div class="pd-feature-grid">
    <?php foreach($features as $i=>$f): ?>
    <div class="pd-feature-row <?=($i%2?'rev':'')?>">
      <div class="pd-feature-img">
        <img src="/images/uploads/produk/<?=$f['image']?>" alt="Fitur <?= htmlspecialchars($f['title']) ?> - <?= $productName ?>">
      </div>
      <div class="pd-feature-text">
        <h3><?= htmlspecialchars($f['title']) ?></h3>
        <p><?= nl2br(htmlspecialchars($f['description'])) ?></p>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>

<!-- SPEC -->
<?php if (!empty($group)): ?>
<section id="pd-specifications" class="pd-section pd-gray">
  <h2>Spesifikasi Lengkap <?= $productName ?></h2>
  <?php foreach($group as $g=>$rows): ?>
  <div class="pd-spec-box">
    <h3><?= htmlspecialchars($g) ?></h3>
    <table>
      <?php foreach($rows as $r): ?>
      <tr>
        <td><?= htmlspecialchars($r['label']) ?></td>
        <td><?= htmlspecialchars($r['nilai']) ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
  <?php endforeach; ?>
</section>
<?php endif; ?>

<!-- GALLERY -->
<?php if (!empty($gallery)): ?>
<section id="pd-gallery" class="pd-section">
  <h2>Galeri <?= $productName ?></h2>
  <div class="pd-gallery">
    <div class="pd-window">
      <div class="pd-track">
        <?php foreach($gallery as $g): ?>
        <div class="pd-slide">
          <img src="/images/uploads/produk/<?=$g['image']?>" alt="Galeri <?= $productName ?> - Crane LiuGong">
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- RECOMMENDED -->
<?php if (!empty($rec)): ?>
<section id="pd-recommended" class="pd-section pd-gray">
  <h2>Crane LiuGong Lainnya</h2>
  <div class="pd-rec">
    <?php foreach($rec as $r): ?>
    <a href="/detailprodukcrane.php?slug=<?= urlencode($r['slug']) ?>" class="pd-card">
      <img src="/images/uploads/produk/<?= htmlspecialchars($r['gambar']) ?>" alt="<?= htmlspecialchars($r['nama_produk']) ?> - Crane LiuGong">
      <h4><?= htmlspecialchars($r['nama_produk']) ?></h4>
    </a>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>

<?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>

</div>

</body>
</html>
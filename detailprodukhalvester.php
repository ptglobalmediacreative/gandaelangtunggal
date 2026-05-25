<?php
require_once __DIR__ . '/admin/config.php';

/* ================= VALIDASI SLUG ================= */

if (!isset($_GET['slug'])) {
    header("Location: /produk.php");
    exit;
}

$slug = $_GET['slug'];


/* ================= PRODUCT (KHUSUS CATEGORY 3 = halvester) ================= */

$stmt = $pdo->prepare("
    SELECT p.*, c.name AS kategori
    FROM produk p
    LEFT JOIN categories c ON p.category_id = c.id
    WHERE p.slug = ?
      AND p.category_id = 15
      AND p.status = 'aktif'
    LIMIT 1
");

$stmt->execute([$slug]);
$product = $stmt->fetch();

if (!$product) {
    header("Location: /produk.php");
    exit;
}


/* ================= HERO (DARI halvester) ================= */

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


/* ================= RECOMMENDED (SESAMA halvester) ================= */

$q = $pdo->prepare("
    SELECT *
    FROM produk
    WHERE status = 'aktif'
      AND category_id = 15
      AND id != ?
    ORDER BY RAND()
    LIMIT 4
");

$q->execute([$product['id']]);
$rec = $q->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">

<?php
$currentUrl = "https://gandaelang.co.id/detailprodukhalvester.php?slug=" . urlencode($product['slug']);
$productImage = "https://gandaelang.co.id/images/uploads/produk/" . htmlspecialchars($product['gambar']);
$productName = htmlspecialchars($product['nama_produk']);
?>

<title><?= $productName ?> | Sugarcane Harvester LiuGong | PT Ganda Elang Tangguh</title>

<meta name="description" content="Spesifikasi lengkap <?= $productName ?> sugarcane harvester LiuGong untuk pekerjaan panen tebu dan operasional industri perkebunan di Indonesia.">

<meta name="keywords" content="<?= $productName ?>, sugarcane harvester liugong, mesin panen tebu, alat berat perkebunan tebu, dealer liugong indonesia">

<meta name="robots" content="index, follow, max-image-preview:large">

<meta name="author" content="PT Ganda Elang Tangguh">

<link rel="canonical" href="<?= $currentUrl ?>">

<!-- Open Graph (Preview WhatsApp / Facebook) -->
<meta property="og:title" content="<?= $productName ?> | Sugarcane Harvester LiuGong">
<meta property="og:description" content="Sugarcane harvester LiuGong berkinerja tinggi untuk operasional panen tebu dan industri perkebunan.">
<meta property="og:image" content="<?= $productImage ?>">
<meta property="og:url" content="<?= $currentUrl ?>">
<meta property="og:type" content="product">
<meta property="og:site_name" content="PT Ganda Elang Tangguh">

<!-- Twitter Preview -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= $productName ?>">
<meta name="twitter:description" content="Sugarcane harvester LiuGong berkinerja tinggi untuk operasional panen tebu modern.">
<meta name="twitter:image" content="<?= $productImage ?>">

<!-- Product Schema -->
<script type="application/ld+json">
{
 "@context": "https://schema.org",
 "@type": "Product",
 "name": "<?= $productName ?>",
 "image": "<?= $productImage ?>",
 "description": "Sugarcane harvester LiuGong berkinerja tinggi untuk pekerjaan panen tebu dan operasional perkebunan.",
 "brand": {
   "@type": "Brand",
   "name": "LiuGong"
 },
 "manufacturer": {
   "@type": "Organization",
   "name": "PT Ganda Elang Tangguh"
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

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<div class="pd-page">

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
  style="background: url('<?= $heroImage ?>') center / cover no-repeat;"
>

  <div class="hero-overlay"></div>

  <div class="hero-content">

    <!-- Breadcrumb -->
    <div class="hero-breadcrumb">
      <a href="/index.php">Home</a>
      <span>></span>

      <a href="/produk.php">Product</a>
      <span>></span>

      <a href="/halvester.php">Sugarcane Halvester</a>
      <span>></span>

      <span class="current">
        <?= htmlspecialchars($product['nama_produk']); ?>
      </span>
    </div>

    <!-- Title -->
    <h1><?= htmlspecialchars($product['nama_produk']); ?></h1>

  </div>

</section>


<!-- MENU -->
<nav class="pd-menu">

<div class="pd-menu-inner">

<div class="pd-menu-product">

<img 
    src="/images/uploads/produk/<?= htmlspecialchars($product['gambar']); ?>" 
    alt="<?= htmlspecialchars($product['nama_produk']); ?>"
>

<span><?= htmlspecialchars($product['nama_produk']); ?></span>

</div>

<div class="pd-menu-nav">

<?php if (!empty($features)): ?>
<a href="#pd-features">Features</a>
<?php endif; ?>

<?php if (!empty($group)): ?>
<a href="#pd-specifications">Specifications</a>
<?php endif; ?>

<?php if (!empty($gallery)): ?>
<a href="#pd-gallery">Gallery</a>
<?php endif; ?>

<?php if (!empty($rec)): ?>
<a href="#pd-recommended">Recommended Equipment</a>
<?php endif; ?>

</div>

</div>

</nav>


<!-- FEATURES -->
<?php if (!empty($features)): ?>
<section id="pd-features" class="pd-section">

<h2>FEATURES</h2>

<div class="pd-feature-grid">

<?php foreach($features as $i=>$f): ?>

<div class="pd-feature-row <?=($i%2?'rev':'')?>">

<div class="pd-feature-img">
<img src="/images/uploads/produk/<?=$f['image']?>">
</div>

<div class="pd-feature-text">
<h3><?=$f['title']?></h3>
<p><?=$f['description']?></p>
</div>

</div>

<?php endforeach; ?>

</div>

</section>
<?php endif; ?>


<!-- SPEC -->
<?php if (!empty($group)): ?>
<section id="pd-specifications" class="pd-section pd-gray">

<h2>SPECIFICATIONS</h2>

<?php foreach($group as $g=>$rows): ?>

<div class="pd-spec-box">

<h3><?=$g?></h3>

<table>

<?php foreach($rows as $r): ?>
<tr>
<td><?=$r['label']?></td>
<td><?=$r['nilai']?></td>
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

<h2>GALLERY</h2>

<div class="pd-gallery">

<div class="pd-window">

<div class="pd-track">

<?php foreach($gallery as $g): ?>

<div class="pd-slide">
<img src="/images/uploads/produk/<?=$g['image']?>">
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

<h2>RECOMMENDED EQUIPMENT</h2>

<div class="pd-rec">

<?php foreach($rec as $r): ?>

<a href="/detailprodukexcavator.php?slug=<?=$r['slug']?>" class="pd-card">

<img src="/images/uploads/produk/<?=$r['gambar']?>">

<h4><?=$r['nama_produk']?></h4>

</a>

<?php endforeach; ?>

</div>

</section>
<?php endif; ?>


<?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>

</div>

</body>
</html>
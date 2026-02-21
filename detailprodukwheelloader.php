<?php
require_once __DIR__ . '/admin/config.php';

if (!isset($_GET['slug'])) {
    header("Location: /produk.php");
    exit;
}

$slug = $_GET['slug'];

/* ================= PRODUCT ================= */
$stmt = $pdo->prepare("
    SELECT p.*, c.name AS kategori_nama
    FROM produk p
    LEFT JOIN categories c ON p.category_id = c.id
    WHERE p.slug = ?
    LIMIT 1
");
$stmt->execute([$slug]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header("Location: /produk.php");
    exit;
}

/* ================= HERO ================= */
$stmtHero = $pdo->prepare("
    SELECT image FROM produk_gallery
    WHERE produk_id = ?
    ORDER BY sort_order ASC
    LIMIT 1
");
$stmtHero->execute([$product['id']]);
$hero = $stmtHero->fetch(PDO::FETCH_ASSOC);

$heroImage = $hero
    ? "/images/uploads/produk/" . $hero['image']
    : "/images/hero.jpg";

/* ================= FEATURES ================= */
$stmtFeature = $pdo->prepare("
    SELECT * FROM produk_features
    WHERE produk_id = ?
    ORDER BY sort_order ASC
");
$stmtFeature->execute([$product['id']]);
$features = $stmtFeature->fetchAll(PDO::FETCH_ASSOC);

/* ================= SPEC ================= */
$stmtSpec = $pdo->prepare("
    SELECT * FROM produk_spesifikasi
    WHERE produk_id = ?
    ORDER BY grup, sort_order ASC
");
$stmtSpec->execute([$product['id']]);
$specs = $stmtSpec->fetchAll(PDO::FETCH_ASSOC);

$groupedSpecs = [];
foreach ($specs as $s) {
    $groupedSpecs[$s['grup']][] = $s;
}

/* ================= GALLERY ================= */
$stmtGallery = $pdo->prepare("
    SELECT * FROM produk_gallery
    WHERE produk_id = ?
    ORDER BY sort_order ASC
");
$stmtGallery->execute([$product['id']]);
$galleries = $stmtGallery->fetchAll(PDO::FETCH_ASSOC);

/* ================= RECOMMENDED ================= */
$stmtRec = $pdo->prepare("
    SELECT * FROM produk
    WHERE status='aktif'
    AND id != ?
    LIMIT 4
");
$stmtRec->execute([$product['id']]);
$recommended = $stmtRec->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= htmlspecialchars($product['nama_produk']); ?></title>

<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/css/product/detail-product.css">
<link rel="stylesheet" href="/css/footer.css">

<link rel="icon" href="/images/favicon.webp">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<script src="/js/product-detail.js" defer></script>
</head>

<body>

<div class="pd-page">

<!-- HEADER -->
<?php include $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>


<!-- HERO -->
<section class="pd-hero" style="background:url('<?= $heroImage ?>') center/cover no-repeat">

<div class="pd-hero-overlay"></div>

<div class="pd-hero-content">

<h1><?= htmlspecialchars($product['nama_produk']); ?></h1>

<p>
<a href="/">Home</a> /
<a href="/produk.php">Produk</a> /
<?= htmlspecialchars($product['nama_produk']); ?>
</p>

</div>

</section>


<!-- MENU -->
<nav class="pd-menu">

<div class="pd-menu-inner">

<a href="#pd-features">Features</a>
<a href="#pd-specifications">Specifications</a>
<a href="#pd-gallery">Gallery</a>
<a href="#pd-recommended">Recommended Equipment</a>

</div>

</nav>


<!-- FEATURES -->
<section id="pd-features" class="pd-section">

<h2>FEATURES</h2>

<?php if($features): ?>

<div class="pd-feature-box">

<div class="pd-feature-img">
<img src="/images/uploads/produk/<?= htmlspecialchars($features[0]['image']); ?>">
</div>

<div class="pd-feature-text">

<ul>
<?php foreach($features as $f): ?>
<li>
<strong><?= htmlspecialchars($f['title']); ?></strong>
<?= htmlspecialchars($f['description']); ?>
</li>
<?php endforeach; ?>
</ul>

</div>

</div>

<?php endif; ?>

</section>


<!-- SPEC -->
<section id="pd-specifications" class="pd-section pd-gray">

<h2>SPECIFICATIONS</h2>

<?php foreach($groupedSpecs as $group => $items): ?>

<div class="pd-spec-block">

<h3><?= htmlspecialchars($group); ?></h3>

<table>

<?php foreach($items as $row): ?>
<tr>
<td><?= htmlspecialchars($row['label']); ?></td>
<td><?= htmlspecialchars($row['nilai']); ?></td>
</tr>
<?php endforeach; ?>

</table>

</div>

<?php endforeach; ?>

</section>


<!-- GALLERY -->
<section id="pd-gallery" class="pd-section">

<h2>GALLERY</h2>

<div class="pd-slider">

<button class="pd-btn prev">&#10094;</button>

<div class="pd-track">

<?php foreach($galleries as $g): ?>
<div class="pd-slide">
<img src="/images/uploads/produk/<?= htmlspecialchars($g['image']); ?>">
</div>
<?php endforeach; ?>

</div>

<button class="pd-btn next">&#10095;</button>

</div>

</section>


<!-- RECOMMENDED -->
<section id="pd-recommended" class="pd-section pd-gray">

<h2>RECOMMENDED EQUIPMENT</h2>

<div class="pd-recommend">

<?php foreach($recommended as $r): ?>

<a href="/detailprodukwheelloader.php?slug=<?= $r['slug']; ?>" class="pd-card">

<img src="/images/uploads/produk/<?= htmlspecialchars($r['gambar']); ?>">

<h4><?= htmlspecialchars($r['nama_produk']); ?></h4>

</a>

<?php endforeach; ?>

</div>

</section>


<!-- FOOTER -->
<?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>

</div>

</body>
</html>
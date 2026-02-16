<?php
require_once __DIR__ . '/admin/config.php';

/* ================= GET SLUG ================= */
$slug = $_GET['slug'] ?? '';

if (!$slug) {
    header("Location: /produk.php");
    exit;
}

/* ================= GET PRODUCT ================= */
$stmt = $pdo->prepare("
    SELECT * FROM produk
    WHERE slug = ?
    AND status = 'aktif'
    LIMIT 1
");
$stmt->execute([$slug]);
$product = $stmt->fetch();

if (!$product) {
    header("Location: /produk.php");
    exit;
}

/* ================= GET FEATURES ================= */
$stmt = $pdo->prepare("
    SELECT * FROM produk_features
    WHERE produk_id = ?
    ORDER BY sort_order ASC
");
$stmt->execute([$product['id']]);
$features = $stmt->fetchAll();

/* ================= GET SPECIFICATIONS ================= */
$stmt = $pdo->prepare("
    SELECT * FROM produk_spesifikasi
    WHERE produk_id = ?
    ORDER BY grup ASC, sort_order ASC
");
$stmt->execute([$product['id']]);
$specs = $stmt->fetchAll();

/* ================= GROUP SPECS ================= */
$groupedSpecs = [];

foreach ($specs as $s) {
    $groupedSpecs[$s['grup']][] = $s;
}

/* ================= GET GALLERY ================= */
$stmt = $pdo->prepare("
    SELECT * FROM produk_gallery
    WHERE produk_id = ?
    ORDER BY sort_order ASC
");
$stmt->execute([$product['id']]);
$gallery = $stmt->fetchAll();

/* ================= GET RECOMMENDED ================= */
$stmt = $pdo->prepare("
    SELECT * FROM produk
    WHERE status = 'aktif'
    AND id != ?
    ORDER BY RAND()
    LIMIT 4
");
$stmt->execute([$product['id']]);
$recommended = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= htmlspecialchars($product['nama_produk']); ?> - PT Ganda Elang Tangguh</title>

<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/css/product/hero.css">
<link rel="stylesheet" href="/css/product/detailproduk.css">
<link rel="stylesheet" href="/css/footer.css">

<link rel="icon" href="/images/favicon.webp">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>

<!-- ================= HEADER ================= -->
<?php include $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>


<!-- ================= HERO ================= -->
<section class="detail-hero"
style="background:url('/images/uploads/produk/<?= $product['gambar']; ?>') center/cover no-repeat;">

<div class="hero-overlay"></div>

<div class="hero-content">

<h1><?= htmlspecialchars($product['nama_produk']); ?></h1>

<div class="hero-menu">
<a href="#features">Features</a>
<a href="#specs">Specifications</a>
<a href="#gallery">Gallery</a>
<a href="#recommended">Recommended</a>
</div>

</div>

</section>


<!-- ================= FEATURES ================= -->
<section id="features" class="detail-section">

<h2>Features</h2>

<div class="feature-grid">

<?php foreach ($features as $f): ?>

<div class="feature-card">

<img src="/images/uploads/produk/<?= $f['image']; ?>">

<h4><?= htmlspecialchars($f['title']); ?></h4>

<p><?= htmlspecialchars($f['description']); ?></p>

</div>

<?php endforeach; ?>

</div>

</section>


<!-- ================= SPECIFICATIONS ================= -->
<section id="specs" class="detail-section gray">

<h2>Specifications</h2>

<div class="spec-wrapper">

<?php foreach ($groupedSpecs as $group => $items): ?>

<div class="spec-group">

<h3><?= htmlspecialchars($group); ?></h3>

<table>

<?php foreach ($items as $i): ?>

<tr>
<td><?= htmlspecialchars($i['label']); ?></td>
<td><?= htmlspecialchars($i['nilai']); ?></td>
</tr>

<?php endforeach; ?>

</table>

</div>

<?php endforeach; ?>

</div>

</section>


<!-- ================= GALLERY ================= -->
<section id="gallery" class="detail-section">

<h2>Gallery</h2>

<div class="gallery-slider">

<?php foreach ($gallery as $g): ?>

<img src="/images/uploads/produk/<?= $g['image']; ?>">

<?php endforeach; ?>

</div>

</section>


<!-- ================= RECOMMENDED ================= -->
<section id="recommended" class="detail-section gray">

<h2>Recommended Equipment</h2>

<div class="recommend-grid">

<?php foreach ($recommended as $r): ?>

<a href="/detailproductwheelloader.php?slug=<?= $r['slug']; ?>" 
class="recommend-card">

<img src="/images/uploads/produk/<?= $r['gambar']; ?>">

<h4><?= htmlspecialchars($r['nama_produk']); ?></h4>

</a>

<?php endforeach; ?>

</div>

</section>


<!-- ================= FOOTER ================= -->
<?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>

<script>
/* Smooth Scroll */
document.querySelectorAll('.hero-menu a').forEach(link => {
  link.addEventListener('click', e => {
    e.preventDefault();
    document.querySelector(link.getAttribute('href'))
    .scrollIntoView({ behavior:'smooth' });
  });
});
</script>

</body>
</html>

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

/* ================= HERO IMAGE ================= */
$stmtHero = $pdo->prepare("
    SELECT image FROM produk_gallery
    WHERE produk_id = ?
    ORDER BY sort_order ASC
    LIMIT 1
");
$stmtHero->execute([$product['id']]);
$hero = $stmtHero->fetch(PDO::FETCH_ASSOC);

$heroImage = $hero
    ? "/images/uploads/produk/".$hero['image']
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
<link rel="stylesheet" href="/css/product/hero.css">
<link rel="stylesheet" href="/css/product/detail-product.css">
<link rel="stylesheet" href="/css/footer.css">

<link rel="icon" href="/images/favicon.webp">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>

<!-- HERO -->
<section class="hero hero-image"
style="background:url('<?= $heroImage ?>') center/cover no-repeat;">
<div class="hero-overlay"></div>
<div class="hero-content">
<div class="hero-breadcrumb">
<a href="/index.php">Home</a> >
<a href="/produk.php">Product</a> >
<span><?= htmlspecialchars($product['kategori_nama']); ?></span> >
<span class="current"><?= htmlspecialchars($product['nama_produk']); ?></span>
</div>
<h1><?= htmlspecialchars($product['nama_produk']); ?></h1>
</div>
</section>


<!-- MENU -->
<section class="detail-menu">
<div class="detail-menu-container">
<a href="#features">Features</a>
<a href="#specifications">Specifications</a>
<a href="#gallery">Gallery</a>
<a href="#recommended">Recommended</a>
</div>
</section>


<!-- FEATURES -->
<section id="features" class="detail-section">
<h2>FEATURES</h2>

<?php if($features): ?>
<div class="feature-main">

    <div class="feature-image">
        <img src="/images/uploads/produk/<?= htmlspecialchars($features[0]['image']); ?>">
    </div>

    <div class="feature-list">
        <ul>
        <?php foreach($features as $f): ?>
            <li>
                <strong><?= htmlspecialchars($f['title']); ?></strong><br>
                <?= htmlspecialchars($f['description']); ?>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>

</div>
<?php else: ?>
<p class="empty">Belum ada fitur.</p>
<?php endif; ?>
</section>


<!-- SPEC -->
<section id="specifications" class="detail-section gray">
<h2>SPECIFICATIONS</h2>

<?php foreach($groupedSpecs as $group => $items): ?>
<div class="spec-group">
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
<section id="gallery" class="detail-section">
<h2>GALLERY</h2>
<div class="gallery-wrapper">
<?php foreach($galleries as $g): ?>
<img src="/images/uploads/produk/<?= htmlspecialchars($g['image']); ?>">
<?php endforeach; ?>
</div>
</section>


<!-- RECOMMENDED -->
<section id="recommended" class="detail-section gray">
<h2>RECOMMENDED EQUIPMENT</h2>
<div class="recommend-grid">
<?php foreach($recommended as $r): ?>
<a href="/detailprodukwheelloader.php?slug=<?= $r['slug']; ?>">
<img src="/images/uploads/produk/<?= $r['gambar']; ?>">
<h4><?= htmlspecialchars($r['nama_produk']); ?></h4>
</a>
<?php endforeach; ?>
</div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>

</body>
</html>

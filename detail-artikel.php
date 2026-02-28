<?php
require_once __DIR__ . "/admin/config.php";

$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

if ($slug === '') {
    header("Location: /blog.php");
    exit;
}

$stmt = $pdo->prepare("
    SELECT id, judul, slug, deskripsi, gambar, created_at
    FROM artikel
    WHERE slug = ?
    LIMIT 1
");
$stmt->execute([$slug]);
$artikel = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$artikel) {
    header("Location: /blog.php");
    exit;
}

$recentStmt = $pdo->prepare("
    SELECT judul, slug, gambar
    FROM artikel
    WHERE slug != ?
    ORDER BY created_at DESC
    LIMIT 4
");
$recentStmt->execute([$slug]);
$recentPosts = $recentStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= htmlspecialchars($artikel['judul']) ?> - PT Ganda Elang Tangguh</title>

<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/css/blog/detail-navbar.css">
<link rel="stylesheet" href="/css/blog/detail-artikel.css">
<link rel="stylesheet" href="/css/footer.css">

<link rel="icon" href="/images/favicon.webp">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body class="navbar-sticky">

<header class="header">
<div class="container">

<div class="logo">
<img src="/images/logo.webp" alt="PT Ganda Elang Tangguh">
</div>

<nav class="navbar">
<a href="/index.php">Beranda</a>
<a href="/about.php">Tentang Kami</a>
<a href="/produk.php">Produk</a>
<a href="/aftersales.php">Layanan Purna Jual</a>
<a href="/contact.php">Hubungi Kami</a>
<a href="/blog.php" class="active">Blog & Artikel</a>
</nav>

</div>
</header>

<!-- HERO PREMIUM -->
<section class="artikel-hero"
style="background-image:url('/images/uploads/artikel/<?= htmlspecialchars($artikel['gambar']) ?>')">
<div class="hero-overlay"></div>

<div class="hero-content">
<h1><?= htmlspecialchars($artikel['judul']) ?></h1>

<div class="hero-meta">
<i class="fa fa-calendar"></i>
<?= date('d F Y', strtotime($artikel['created_at'])) ?>
</div>
</div>
</section>

<!-- CONTENT -->
<section class="artikel-premium">
<div class="artikel-container">

<div class="artikel-layout">

<article class="artikel-main">

<div class="artikel-content">
<?= nl2br($artikel['deskripsi']) ?>
</div>

<div class="artikel-share">
<h4>Bagikan Artikel:</h4>
<a href="#" class="share-btn fb"><i class="fab fa-facebook-f"></i></a>
<a href="#" class="share-btn tw"><i class="fab fa-twitter"></i></a>
<a href="#" class="share-btn wa"><i class="fab fa-whatsapp"></i></a>
</div>

</article>

<aside class="artikel-sidebar">

<h3>Artikel Terbaru</h3>

<?php foreach ($recentPosts as $recent): ?>
<div class="sidebar-card">

<a href="/artikel/<?= htmlspecialchars($recent['slug']) ?>">
<img src="/images/uploads/artikel/<?= htmlspecialchars($recent['gambar']) ?>">
</a>

<a href="/artikel/<?= htmlspecialchars($recent['slug']) ?>" class="sidebar-title">
<?= htmlspecialchars($recent['judul']) ?>
</a>

</div>
<?php endforeach; ?>

</aside>

</div>
</div>
</section>

<?php
$relatedStmt = $pdo->prepare("
SELECT judul, slug, gambar, deskripsi
FROM artikel
WHERE slug != ?
ORDER BY created_at DESC
LIMIT 3
");
$relatedStmt->execute([$slug]);
$relatedPosts = $relatedStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if (!empty($relatedPosts)): ?>
<section class="related-premium">
<div class="related-container">

<h2>Artikel Lainnya</h2>

<div class="related-grid">
<?php foreach ($relatedPosts as $rel): ?>
<div class="related-card">

<a href="/artikel/<?= htmlspecialchars($rel['slug']) ?>" class="related-image">
<img src="/images/uploads/artikel/<?= htmlspecialchars($rel['gambar']) ?>">
<div class="overlay-gradient"></div>
</a>

<div class="related-content">
<h3><?= htmlspecialchars($rel['judul']) ?></h3>
<p><?= mb_strimwidth(strip_tags($rel['deskripsi']), 0, 110, '...') ?></p>
</div>

</div>
<?php endforeach; ?>
</div>

</div>
</section>
<?php endif; ?>

<?php include "footer.php"; ?>

<script src="/js/detail-artikel.js"></script>

</body>
</html>
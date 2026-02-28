<?php
require_once __DIR__ . "/admin/config.php";

if (!isset($_GET['slug']) || empty($_GET['slug'])) {
    header("Location: /blog.php");
    exit;
}

$slug = $_GET['slug'];

/* ================= AMBIL ARTIKEL ================= */
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

/* ================= SIDEBAR ================= */
$recentStmt = $pdo->prepare("
    SELECT judul, slug, gambar
    FROM artikel
    WHERE slug != ?
    ORDER BY created_at DESC
    LIMIT 5
");
$recentStmt->execute([$slug]);
$recentPosts = $recentStmt->fetchAll(PDO::FETCH_ASSOC);

/* ================= RELATED (3 TERBARU SELAIN INI) ================= */
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

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= htmlspecialchars($artikel['judul']) ?> - PT Ganda Elang Tangguh</title>

<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/css/blog/artikel.css">
<link rel="stylesheet" href="/css/footer.css">
<link rel="icon" type="image/webp" href="/images/favicon.webp">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

<?php include "header.php"; ?>

<section class="detail-artikel">
<div class="container">

<div class="artikel-wrapper">

<!-- ================= MAIN ================= -->
<article class="artikel-main">

<h1><?= htmlspecialchars($artikel['judul']) ?></h1>

<div class="blog-date">
<i class="fa fa-calendar"></i>
<?= date('d F Y', strtotime($artikel['created_at'])) ?>
</div>

<?php if (!empty($artikel['gambar'])): ?>
<img
src="/images/uploads/artikel/<?= htmlspecialchars($artikel['gambar']) ?>"
alt="<?= htmlspecialchars($artikel['judul']) ?>"
class="featured-image"
>
<?php endif; ?>

<div class="isi-artikel">
<?= nl2br(htmlspecialchars($artikel['deskripsi'])) ?>
</div>

<a href="/blog.php" class="btn-kembali">
← Kembali ke Blog
</a>

</article>

<!-- ================= SIDEBAR ================= -->
<aside class="artikel-sidebar">

<div class="sidebar-section">
<h3>Artikel Terbaru</h3>

<?php foreach ($recentPosts as $recent): ?>
<div class="recent-post-item">

<?php if (!empty($recent['gambar'])): ?>
<a href="/artikel/<?= htmlspecialchars($recent['slug']) ?>">
<img
src="/images/uploads/artikel/<?= htmlspecialchars($recent['gambar']) ?>"
alt="<?= htmlspecialchars($recent['judul']) ?>"
>
</a>
<?php endif; ?>

<a href="/artikel/<?= htmlspecialchars($recent['slug']) ?>" class="recent-title">
<?= htmlspecialchars($recent['judul']) ?>
</a>

</div>
<?php endforeach; ?>

</div>

</aside>

</div>

<!-- ================= RELATED ================= -->
<?php if (!empty($relatedPosts)): ?>
<section class="related-posts">
<h2>Artikel Lainnya</h2>

<div class="related-list">

<?php foreach ($relatedPosts as $rel): ?>
<article class="related-item">
<a href="/artikel/<?= htmlspecialchars($rel['slug']) ?>">

<?php if (!empty($rel['gambar'])): ?>
<img
src="/images/uploads/artikel/<?= htmlspecialchars($rel['gambar']) ?>"
alt="<?= htmlspecialchars($rel['judul']) ?>"
>
<?php endif; ?>

<h3><?= htmlspecialchars($rel['judul']) ?></h3>
<p><?= mb_substr(strip_tags($rel['deskripsi']), 0, 80) ?>...</p>

</a>
</article>
<?php endforeach; ?>

</div>
</section>
<?php endif; ?>

</div>
</section>

<?php include "footer.php"; ?>

</body>
</html>
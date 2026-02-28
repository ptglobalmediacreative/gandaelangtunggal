<?php
require_once __DIR__ . "/admin/config.php";

/* ================= PAGINATION ================= */
$limit = 6;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

/* ================= TOTAL DATA ================= */
$totalStmt = $pdo->query("SELECT COUNT(*) FROM artikel");
$totalRows = $totalStmt->fetchColumn();
$totalPages = ceil($totalRows / $limit);

/* ================= AMBIL DATA ================= */
$stmt = $pdo->prepare("
    SELECT id, judul, slug, deskripsi, gambar, created_at
    FROM artikel
    ORDER BY created_at DESC
    LIMIT :limit OFFSET :offset
");

$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$artikel = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Blog & Artikel - PT Ganda Elang Tangguh</title>

<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/css/blog/hero.css">
<link rel="stylesheet" href="/css/blog/artikel.css">
<link rel="stylesheet" href="/css/footer.css">

<link rel="icon" type="image/webp" href="/images/favicon.webp">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

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
      <a href="/produk.php">Produk</a>
      <a href="/aftersales.php">Layanan Purna Jual</a>
      <a href="/contact.php">Hubungi Kami</a>
      <a href="/blog.php" class="active">Blog & Artikel</a>
    </nav>

    <div class="hamburger" id="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </div>

  </div>
</header>

<!-- HERO -->
<section class="hero hero-image"
style="background: url('/images/hero.jpg') center / cover no-repeat;">
<div class="hero-overlay"></div>
<div class="hero-content">

<div class="hero-breadcrumb">
<a href="/index.php">Home</a>
<span>></span>
<span class="current">Blog</span>
</div>

<h1>Blog & Artikel</h1>

</div>
</section>

<!-- BLOG SECTION -->
<section class="content-section" id="artikel">
<div class="container">

<div class="blog-grid">

<?php if (!empty($artikel)): ?>
<?php foreach ($artikel as $row): ?>

<div class="blog-post">

<?php if (!empty($row['gambar'])): ?>
<img src="/images/uploads/artikel/<?= htmlspecialchars($row['gambar']) ?>"
     alt="<?= htmlspecialchars($row['judul']) ?>"
     loading="lazy">
<?php endif; ?>

<div class="blog-content">

<span class="blog-date">
<i class="fa fa-calendar"></i>
<?= date('d M Y', strtotime($row['created_at'])) ?>
</span>

<h2>
<a href="/artikel/<?= htmlspecialchars($row['slug']) ?>">
<?= htmlspecialchars($row['judul']) ?>
</a>
</h2>

<p>
<?= mb_substr(strip_tags($row['deskripsi']), 0, 120) ?>...
</p>

<a href="/artikel/<?= htmlspecialchars($row['slug']) ?>" class="read-more">
Baca Selengkapnya
</a>

</div>

</div>

<?php endforeach; ?>
<?php else: ?>
<p>Tidak ada artikel yang ditemukan.</p>
<?php endif; ?>

</div>

<!-- PAGINATION -->
<?php if ($totalPages > 1): ?>
<div class="pagination">
<?php for ($i = 1; $i <= $totalPages; $i++): ?>
<a class="<?= ($i === $page) ? 'active' : '' ?>"
   href="?page=<?= $i ?>">
<?= $i ?>
</a>
<?php endfor; ?>
</div>
<?php endif; ?>

</div>
</section>

<!-- FOOTER -->
<?php include $_SERVER['DOCUMENT_ROOT'] . "/footer.php"; ?>

<script src="/js/main.js"></script>

</body>
</html>
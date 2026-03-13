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

<title>Blog Alat Berat & Industri | PT Ganda Elang Tangguh</title>

<!-- SEO -->
<meta name="description" content="Blog PT Ganda Elang Tangguh berisi artikel seputar alat berat, industri konstruksi, teknologi alat berat, serta tips penggunaan dan perawatan alat berat untuk berbagai proyek.">

<meta name="keywords" content="blog alat berat, artikel alat berat, industri konstruksi, tips alat berat, teknologi alat berat, PT Ganda Elang Tangguh">

<meta name="author" content="PT Ganda Elang Tangguh">
<meta name="robots" content="index, follow, max-image-preview:large">

<link rel="canonical" href="https://gandaelang.co.id/blog.php">

<!-- Open Graph -->
<meta property="og:title" content="Blog Alat Berat & Industri | PT Ganda Elang Tangguh">
<meta property="og:description" content="Temukan berbagai artikel tentang alat berat, industri konstruksi, dan teknologi terbaru di blog PT Ganda Elang Tangguh.">
<meta property="og:image" content="https://gandaelang.co.id/images/heroblog.jpg">
<meta property="og:url" content="https://gandaelang.co.id/blog.php">
<meta property="og:type" content="website">
<meta property="og:site_name" content="PT Ganda Elang Tangguh">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Blog Alat Berat & Industri">
<meta name="twitter:description" content="Artikel seputar alat berat dan industri konstruksi dari PT Ganda Elang Tangguh.">
<meta name="twitter:image" content="https://gandaelang.co.id/images/heroblog.jpg">

<!-- Favicon -->
<link rel="icon" type="image/webp" href="/images/favicon.webp">

<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/css/blog/hero.css">
<link rel="stylesheet" href="/css/blog/artikel.css">
<link rel="stylesheet" href="/css/footer.css">

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
   "name": "Blog",
   "item": "https://gandaelang.co.id/blog.php"
  }
 ]
}
</script>

<!-- Blog Collection Schema -->
<script type="application/ld+json">
{
 "@context": "https://schema.org",
 "@type": "Blog",
 "name": "Blog PT Ganda Elang Tangguh",
 "url": "https://gandaelang.co.id/blog.php",
 "description": "Blog yang membahas alat berat, industri konstruksi, serta teknologi terbaru di dunia alat berat.",
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
style="background: url('/images/heroblog.jpg') center / cover no-repeat;">
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

</body>
</html>
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

<!-- SEO Meta -->
<title>Blog & Artikel Seputar Alat Berat China | Dealer Resmi LiuGong Indonesia | PT Ganda Elang Tangguh</title>

<meta name="description" content="Blog PT Ganda Elang Tangguh, dealer resmi LiuGong di Indonesia. Artikel seputar alat berat LiuGong, industri konstruksi, pertambangan, tips perawatan, dan teknologi alat berat terbaru.">

<meta name="keywords" content="blog alat berat liugong, artikel alat berat, dealer resmi liugong indonesia, dealer liugong jakarta, pt ganda elang tangguh, alat berat liugong, tips alat berat, industri konstruksi, teknologi alat berat">

<meta name="author" content="PT Ganda Elang Tangguh">
<meta name="robots" content="index, follow, max-image-preview:large">
<meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
<meta http-equiv="content-language" content="id-ID">

<link rel="canonical" href="https://gandaelang.co.id/blog">

<!-- Open Graph -->
<meta property="og:title" content="Blog Alat Berat LiuGong & Industri | Dealer Resmi LiuGong Indonesia | PT Ganda Elang Tangguh">
<meta property="og:description" content="Blog PT Ganda Elang Tangguh, dealer resmi LiuGong di Indonesia. Temukan artikel seputar alat berat LiuGong, konstruksi, pertambangan, dan tips perawatan.">
<meta property="og:image" content="https://gandaelang.co.id/images/heroblog.jpg">
<meta property="og:url" content="https://gandaelang.co.id/blog">
<meta property="og:type" content="website">
<meta property="og:site_name" content="PT Ganda Elang Tangguh - Dealer Resmi LiuGong">
<meta property="og:locale" content="id_ID">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Blog Alat Berat LiuGong & Industri | Dealer Resmi LiuGong Indonesia">
<meta name="twitter:description" content="Blog PT Ganda Elang Tangguh, dealer resmi LiuGong di Indonesia. Artikel alat berat LiuGong, konstruksi, dan tips perawatan.">
<meta name="twitter:image" content="https://gandaelang.co.id/images/heroblog.jpg">

<!-- Favicon -->
<link rel="icon" type="image/webp" href="/images/favicon.webp">

<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/css/blog/hero.css">
<link rel="stylesheet" href="/css/blog/artikel.css">
<link rel="stylesheet" href="/css/footer.css">

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
  "@id": "https://gandaelang.co.id/blog/#breadcrumb",
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
      "name": "Blog & Artikel Alat Berat LiuGong",
      "item": "https://gandaelang.co.id/blog"
    }
  ]
}
</script>

<!-- Blog Collection Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Blog",
  "@id": "https://gandaelang.co.id/blog/#blog",
  "name": "Blog Alat Berat LiuGong - PT Ganda Elang Tangguh",
  "url": "https://gandaelang.co.id/blog",
  "description": "Blog PT Ganda Elang Tangguh, dealer resmi LiuGong di Indonesia, membahas alat berat LiuGong, industri konstruksi, pertambangan, tips perawatan, dan teknologi terbaru.",
  "publisher": {
    "@type": "Organization",
    "@id": "https://gandaelang.co.id/#organization",
    "name": "PT Ganda Elang Tangguh",
    "logo": {
      "@type": "ImageObject",
      "url": "https://gandaelang.co.id/images/logo.webp"
    }
  },
  "about": "Alat Berat LiuGong, Konstruksi, Pertambangan, Infrastruktur",
  "inLanguage": "id-ID"
}
</script>

</head>

<body>

<!-- ================= HEADER ================= -->
<header class="header">
  <div class="container">
    <div class="logo">
        <a href="/">
            <img src="/images/logo.webp" alt="PT Ganda Elang Tangguh - Dealer Resmi LiuGong Indonesia">
        </a>
    </div>
    <nav class="navbar" id="navbar">
      <a href="/">Beranda</a>
      <a href="/about">Tentang Kami</a>
      <a href="/produk">Produk</a>
      <a href="/aftersales">Layanan Purna Jual</a>
      <a href="/contact">Hubungi Kami</a>
      <a href="/blog" class="active">Blog & Artikel</a>
    </nav>
    <div class="hamburger" id="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
</header>

<!-- HERO -->
<section class="hero hero-image" style="background: url('/images/heroblog.jpg') center / cover no-repeat;">
  <div class="hero-overlay"></div>
  <div class="hero-content">

    <!-- Breadcrumb -->
    <div class="hero-breadcrumb">
      <a href="/">Beranda</a>
      <span>›</span>
      <span class="current">Blog</span>
    </div>

    <!-- Title -->
    <h1>Blog & Artikel Seputar Alat Berat</h1>

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
            <a href="/artikel/<?= htmlspecialchars($row['slug']) ?>">
              <img src="/images/uploads/artikel/<?= htmlspecialchars($row['gambar']) ?>"
                   alt="<?= htmlspecialchars($row['judul']) ?> - Blog Alat Berat LiuGong"
                   loading="lazy">
            </a>
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
        <p style="text-align:center; grid-column: 1/-1;">Belum ada artikel tersedia.</p>
      <?php endif; ?>

    </div>

    <!-- PAGINATION -->
    <?php if ($totalPages > 1): ?>
    <div class="pagination">
      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a class="<?= ($i === $page) ? 'active' : '' ?>"
           href="?page=<?= $i ?>"
           aria-label="Halaman <?= $i ?>">
          <?= $i ?>
        </a>
      <?php endfor; ?>
    </div>
    <?php endif; ?>

  </div>
</section>

<!-- FOOTER -->
<?php include "whatsapp.php"; ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/footer.php"; ?>

</body>
</html>
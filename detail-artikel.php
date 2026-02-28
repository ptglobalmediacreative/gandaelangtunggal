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

/* ================= RELATED ================= */
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

<header class="header">
    <div class="container">

        <div class="logo">
            <img src="/images/logo.webp" alt="PT Ganda Elang Tangguh Logo">
        </div>

        <nav class="navbar" id="navbar">

            <a href="/index.php">Beranda</a>
            <a href="/about.php">Tentang Kami</a>
            <a href="/produk.php">Produk</a>
            <a href="/aftersales.php">Layanan Purna Jual</a>
            <a href="/contact.php">Hubungi Kami</a>
            <a href="/blog.php" class="active">Blog & Artikel</a>

        </nav>

        <!-- Hamburger -->
        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>

    </div>
</header>

    <!-- Konten Artikel -->
    <section class="detail-artikel">
      <div class="container">
        <div class="artikel-wrapper" style="display: flex; flex-wrap: wrap; gap: 30px;">
          <div class="artikel-main" style="flex: 1 1 65%;">
            <?php if ($artikel): ?>
              <h1><?= htmlspecialchars($artikel['judul']) ?></h1>
              <p style="color: #888; font-size: 14px; margin-bottom: 15px;">
                Diposting pada <?= date('d M Y', strtotime($artikel['tanggal'] ?? 'now')) ?>
              </p>
              <img
                src="<?= htmlspecialchars($artikel['gambar']) ?>"
                alt="<?= htmlspecialchars($artikel['judul']) ?>"
                class="featured-image"
                style="width: 100%; height: auto; margin-bottom: 20px;"
              />
              <div class="isi-artikel"><?= nl2br($artikel['isi']) ?></div>
              <a href="artikel.php" class="btn-kembali" style="display:inline-block; margin-top:20px;">Kembali ke Daftar Artikel</a>
            <?php else: ?>
              <p>Artikel tidak ditemukan.</p>
            <?php endif; ?>
          </div>

        <!-- Sidebar -->
        <aside class="artikel-sidebar" style="flex: 1 1 30%;">
          <div class="sidebar-section">
            <h2>Recent Posts</h2>
            <div class="recent-posts-list">
              <?php
              foreach (array_slice($data, 0, 5) as $recent) {
                if ($recent['slug'] != $slug) {
        
                  // URL SEO artikel
                  $url = '/artikel/' . htmlspecialchars($recent['slug']);
        
                  echo '<div class="recent-post-item" style="display: flex; align-items: center; gap: 12px; margin-bottom: 15px;">';
        
                  // Image link
                  echo '<a href="' . $url . '" style="flex-shrink: 0;">';
                  echo '<img src="' . htmlspecialchars($recent['gambar']) . '" 
                            alt="' . htmlspecialchars($recent['judul']) . '" 
                            style="width: 80px; height: 60px; object-fit: cover; border-radius: 6px;">';
                  echo '</a>';
        
                  // Title link
                  echo '<div style="flex: 1;">';
                  echo '<a href="' . $url . '" 
                            style="font-weight: 600; text-decoration: none; color: #333; line-height: 1.3; display: block;">'
                            . htmlspecialchars($recent['judul']) . 
                       '</a>';
                  echo '</div>';
        
                  echo '</div>';
                }
              }
              ?>
            </div>
          </div>
        <div class="sidebar-section">
          <h2>Kategori</h2>
          <ul style="list-style: none; padding-left: 0;">
            <?php
            $kategori = array_unique(array_column($data, 'kategori'));
        
            foreach ($kategori as $kat) {
              if (!empty($kat)) {
        
                // URL kategori ke halaman artikel + filter kategori
                $kat_url = 'https://gandaelang.co.id/artikel?search=&kategori=' . urlencode($kat);
        
                echo '<li style="margin-bottom: 8px;">';
                echo '<a href="' . $kat_url . '" 
                          style="text-decoration: none; color: #333; font-weight: 500;">
                          • ' . htmlspecialchars($kat) . '
                      </a>';
                echo '</li>';
              }
            }
            ?>
          </ul>
        </div>
        </aside>
        </div>

        <!-- Related Posts -->
        <?php if ($artikel): ?>
          <div class="related-posts" style="margin-top: 60px;">
            <h2 style="margin-bottom: 25px; font-size: 26px; font-weight: 700;">Related Posts</h2>
            <div
              class="related-list"
              style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px;"
            >
              <?php
              $related_count = 0;
              foreach ($data as $rel) {
                if (
                  $rel['slug'] != $slug &&
                  isset($rel['kategori'], $artikel['kategori']) &&
                  $rel['kategori'] === $artikel['kategori']
                ) {
                  echo '<div class="related-item" style="background: #fff; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">';
                  echo '<a href="/artikel/' . urlencode($rel['slug']) . '" style="text-decoration: none; color: #333;">';
                  echo '<img src="' . htmlspecialchars($rel['gambar']) . '" alt="' . htmlspecialchars($rel['judul']) . '" style="width: 100%; height: 160px; object-fit: cover;">';
                  echo '<div style="padding: 15px;">';
                  echo '<h3 style="font-size: 16px; font-weight: 600; margin: 0 0 10px 0;">' . htmlspecialchars($rel['judul']) . '</h3>';
                  echo '<p style="font-size: 14px; color: #666;">' . substr(strip_tags($rel['isi']), 0, 100) . '...</p>';
                  echo '</div></a></div>';
                  $related_count++;
                  if ($related_count >= 3) break;
                }
              }
              if ($related_count === 0) {
                echo "<p>Tidak ada artikel terkait.</p>";
              }
              ?>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </section>

<?php include "footer.php"; ?>

</body>
</html>
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

/* ================= CURRENT URL FOR SHARE ================= */
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$currentUrl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$encodedUrl = urlencode($currentUrl);
$encodedTitle = urlencode($artikel['judul']);

/* ================= HANDLE COMMENT ================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kirim_komentar'])) {

    $nama  = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $pesan = trim($_POST['pesan']);

    if ($nama && $email && $pesan) {

        $insert = $pdo->prepare("
            INSERT INTO komentar (artikel_id, nama, email, pesan)
            VALUES (?, ?, ?, ?)
        ");

        $insert->execute([
            $artikel['id'],
            $nama,
            $email,
            $pesan
        ]);

        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    }
}

/* ================= GET COMMENTS ================= */
$commentStmt = $pdo->prepare("
    SELECT * FROM komentar
    WHERE artikel_id = ?
    ORDER BY created_at DESC
");
$commentStmt->execute([$artikel['id']]);
$comments = $commentStmt->fetchAll(PDO::FETCH_ASSOC);

/* ================= RECENT ================= */
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

<!-- Hamburger -->
<div class="hamburger" id="hamburger">
    <span></span>
    <span></span>
    <span></span>
</div>
</div>
</header>

<!-- ================= ARTICLE ================= -->
<section class="artikel-wrapper-section">
<div class="artikel-container">
<div class="artikel-layout">

<article class="artikel-main">

<h1><?= htmlspecialchars($artikel['judul']) ?></h1>

<div class="artikel-meta">
<i class="fa fa-calendar"></i>
<?= date('d F Y', strtotime($artikel['created_at'])) ?>
</div>

<?php if (!empty($artikel['gambar'])): ?>
<img
src="/images/uploads/artikel/<?= htmlspecialchars($artikel['gambar']) ?>"
alt="<?= htmlspecialchars($artikel['judul']) ?>"
class="artikel-featured-image">
<?php endif; ?>

<div class="artikel-content">
<?= nl2br(htmlspecialchars($artikel['deskripsi'])) ?>
</div>

<!-- PREMIUM SHARE SYSTEM -->
<div class="artikel-share">
<span>Bagikan:</span>

<a onclick="sharePopup('https://www.facebook.com/sharer/sharer.php?u=<?= $encodedUrl ?>')" class="share-btn fb">
<i class="fab fa-facebook-f"></i>
</a>

<a onclick="sharePopup('https://twitter.com/intent/tweet?text=<?= $encodedTitle ?>&url=<?= $encodedUrl ?>')" class="share-btn tw">
<i class="fab fa-twitter"></i>
</a>

<a href="https://api.whatsapp.com/send?text=<?= $encodedTitle ?>%20<?= $encodedUrl ?>" target="_blank" class="share-btn wa">
<i class="fab fa-whatsapp"></i>
</a>

<a onclick="copyLink()" class="share-btn copy">
<i class="fa fa-link"></i>
</a>

<a onclick="nativeShare()" class="share-btn native">
<i class="fa fa-share-alt"></i>
</a>

</div>

</article>

<!-- SIDEBAR -->
<aside class="artikel-sidebar">
<h3>Artikel Terbaru</h3>
<?php foreach ($recentPosts as $recent): ?>
<div class="sidebar-item">
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

<!-- ================= COMMENT ================= -->
<section class="comment-section">
<div class="comment-container">

<h2>Diskusi Artikel</h2>

<form method="POST" class="comment-form">

<div class="form-row">
<input type="text" name="nama" placeholder="Nama Anda" required>
<input type="email" name="email" placeholder="Email Anda" required>
</div>

<textarea name="pesan" rows="5" placeholder="Tulis komentar Anda..." required></textarea>

<button type="submit" name="kirim_komentar">
Kirim Komentar
</button>

</form>

<?php if (!empty($comments)): ?>
<div class="comment-list">
<h3><?= count($comments) ?> Komentar</h3>

<?php foreach ($comments as $comment): ?>
<div class="comment-item">
<div class="comment-header">
<strong><?= htmlspecialchars($comment['nama']) ?></strong>
<span><?= date('d M Y', strtotime($comment['created_at'])) ?></span>
</div>
<p><?= nl2br(htmlspecialchars($comment['pesan'])) ?></p>
</div>
<?php endforeach; ?>

</div>
<?php endif; ?>

</div>
</section>

<?php include "footer.php"; ?>

<script>
function sharePopup(url) {
    window.open(url, 'shareWindow',
        'height=500,width=600,left=300,top=200,resizable=yes');
}

function copyLink() {
    navigator.clipboard.writeText("<?= $currentUrl ?>");
    alert("Link berhasil disalin!");
}

function nativeShare() {
    if (navigator.share) {
        navigator.share({
            title: "<?= htmlspecialchars($artikel['judul']) ?>",
            url: "<?= $currentUrl ?>"
        });
    } else {
        alert("Browser tidak mendukung fitur share ini.");
    }
}
</script>

</body>
</html>
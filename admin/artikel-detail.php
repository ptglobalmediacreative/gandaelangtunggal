<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . "/config.php";
require_once "auth.php";

/* ================= LOGIN ================= */
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

/* ================= VALIDASI SLUG ================= */
if (!isset($_GET['slug']) || empty($_GET['slug'])) {
    header("Location: artikel.php");
    exit;
}

$slug = $_GET['slug'];

/* ================= LOAD DATA ================= */
$stmt = $pdo->prepare("SELECT * FROM artikel WHERE slug=? LIMIT 1");
$stmt->execute([$slug]);
$artikel = $stmt->fetch();

if (!$artikel) {
    header("Location: artikel.php");
    exit;
}

$upload_path = "../images/uploads/artikel/";
?>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<div class="main-content">

<div class="topbar">
    <h2>Detail Artikel</h2>
    <a href="artikel.php" class="btn btn-secondary">Kembali</a>
</div>

<div class="detail-wrapper">
<div class="detail-card">

    <h1 class="detail-title">
        <?= htmlspecialchars($artikel['judul']); ?>
    </h1>

    <span class="detail-slug">
        <?= htmlspecialchars($artikel['slug']); ?>
    </span>

    <div class="detail-meta">
        <i class="fa fa-calendar"></i>
        Dibuat: <?= date("d M Y H:i", strtotime($artikel['created_at'])); ?>
        <br>
        <i class="fa fa-clock"></i>
        Update: <?= date("d M Y H:i", strtotime($artikel['updated_at'])); ?>
    </div>

    <?php if (!empty($artikel['gambar'])): ?>
        <img src="<?= $upload_path . htmlspecialchars($artikel['gambar']); ?>"
             class="detail-image">
    <?php endif; ?>

    <div class="detail-content">
        <?= nl2br(htmlspecialchars($artikel['deskripsi'])); ?>
    </div>

    <div class="detail-actions">

        <a href="artikel-edit.php?id=<?= $artikel['id']; ?>" class="btn btn-warning">
            ✎ Edit Artikel
        </a>

        <a href="artikel-hapus.php?id=<?= $artikel['id']; ?>"
           class="btn btn-danger"
           onclick="return confirm('Yakin ingin menghapus artikel ini?');">
            🗑 Hapus
        </a>

        <a href="artikel.php" class="btn btn-secondary">
            Kembali
        </a>

    </div>

</div>
</div>

</div>

</body>
</html>
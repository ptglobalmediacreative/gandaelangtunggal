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

<style>
/* ================= DETAIL ARTIKEL ================= */

.detail-wrapper {
    max-width: 900px;
    margin: 30px auto;
}

.detail-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 40px;
    box-shadow: 0 8px 28px rgba(15, 23, 42, 0.06);
}

.detail-title {
    font-size: 30px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 10px;
}

.detail-slug {
    display: inline-block;
    background: #f1f5f9;
    color: #334155;
    font-size: 13px;
    padding: 5px 12px;
    border-radius: 8px;
    margin-bottom: 15px;
}

.detail-meta {
    font-size: 14px;
    color: #64748b;
    margin-bottom: 25px;
    line-height: 1.7;
}

.detail-image {
    width: 100%;
    max-width: 500px;
    border-radius: 14px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    margin-bottom: 30px;
}

.detail-content {
    font-size: 15px;
    line-height: 1.9;
    color: #334155;
    background: #f8fafc;
    padding: 25px;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
}

.detail-actions {
    margin-top: 35px;
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.btn {
    padding: 10px 18px;
    border-radius: 8px;
    font-size: 14px;
    text-decoration: none;
    transition: 0.3s ease;
    display: inline-block;
}

.btn-warning {
    background: #f59e0b;
    color: #fff;
}

.btn-warning:hover {
    background: #d97706;
}

.btn-danger {
    background: #ef4444;
    color: #fff;
}

.btn-danger:hover {
    background: #dc2626;
}

.btn-secondary {
    background: #e2e8f0;
    color: #0f172a;
}

.btn-secondary:hover {
    background: #cbd5e1;
}

@media (max-width: 768px) {
    .detail-card {
        padding: 25px;
    }

    .detail-title {
        font-size: 22px;
    }

    .detail-image {
        max-width: 100%;
    }
}
</style>

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
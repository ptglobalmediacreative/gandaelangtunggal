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


/* ================= ID ================= */

if (!isset($_GET['id'])) {
    header("Location: artikel.php");
    exit;
}

$id = (int) $_GET['id'];


/* ================= CONFIG ================= */

$upload_path = "../images/uploads/artikel/";


/* ================= LOAD DATA ================= */

$q = $pdo->prepare("SELECT * FROM artikel WHERE id=?");
$q->execute([$id]);
$artikel = $q->fetch();

if(!$artikel){
    header("Location: artikel.php");
    exit;
}

?>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>


<div class="main-content">

<!-- TOPBAR -->
<div class="topbar">
    <h2>Detail Artikel</h2>

    <a href="artikel.php" class="btn-secondary">
        Kembali
    </a>
</div>


<!-- CARD -->
<div class="card product-detail-card">


<!-- JUDUL -->
<h2 style="margin-bottom:10px; color:#0f172a;">
    <?= htmlspecialchars($artikel['judul']); ?>
</h2>


<!-- TANGGAL -->
<p style="color:#64748b; font-size:14px; margin-bottom:25px;">
    <i class="fa fa-calendar"></i>
    <?= date("d M Y H:i", strtotime($artikel['created_at'])); ?>
</p>


<!-- GAMBAR -->
<?php if($artikel['gambar']): ?>

    <img src="<?= $upload_path.$artikel['gambar']; ?>"
         class="product-thumbnail"
         style="max-width:400px; margin-bottom:25px;">

<?php endif; ?>


<!-- DESKRIPSI -->
<div style="
    font-size:15px;
    line-height:1.7;
    color:#334155;
    margin-bottom:30px;
">

    <?= nl2br(htmlspecialchars($artikel['deskripsi'])); ?>

</div>



<!-- ACTION -->
<div class="product-detail-action">

    <a href="artikel-edit.php?id=<?= $id; ?>" class="btn-warning">
        ✎ Edit Artikel
    </a>

    <a href="artikel.php" class="btn-secondary">
        Kembali
    </a>

</div>


</div>
</div>


</body>
</html>

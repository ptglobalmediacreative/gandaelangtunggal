<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . "/config.php";

/* ================= LOGIN ================= */

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

/* ================= ID ================= */

if (!isset($_GET['id'])) {
    header("Location: produk.php");
    exit;
}

$id = (int)$_GET['id'];


/* ================= CONFIG ================= */

$upload_url = "../images/uploads/produk/";


/* ================= LOAD DATA ================= */

/* Produk + Kategori */
$stmt = $pdo->prepare("
    SELECT p.*, c.name AS category_name
    FROM produk p
    LEFT JOIN categories c ON p.category_id = c.id
    WHERE p.id=?
");
$stmt->execute([$id]);
$produk = $stmt->fetch();

if(!$produk){
    header("Location: produk.php");
    exit;
}


/* Gallery */
$gq = $pdo->prepare("
    SELECT * FROM produk_gallery
    WHERE produk_id=?
    ORDER BY sort_order
");
$gq->execute([$id]);
$gallery = $gq->fetchAll();


/* Features */
$fq = $pdo->prepare("
    SELECT * FROM produk_features
    WHERE produk_id=?
    ORDER BY sort_order
");
$fq->execute([$id]);
$features = $fq->fetchAll();


/* Spesifikasi */
$sq = $pdo->prepare("
    SELECT * FROM produk_spesifikasi
    WHERE produk_id=?
    ORDER BY grup, sort_order
");
$sq->execute([$id]);
$specs = $sq->fetchAll();


/* Group Spec */
$groups = [];

foreach($specs as $s){
    $groups[$s['grup']][] = $s;
}
?>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>


<div class="main-content">

<!-- TOPBAR -->
<div class="topbar">

    <h2>Detail Produk</h2>

    <a href="produk.php" class="btn-secondary">
        Kembali
    </a>

</div>


<!-- CARD -->
<div class="card product-detail-card">



<!-- ================= INFO ================= -->

<h3>Informasi Produk</h3>

<table class="product-info-table">

<tr>
    <td>Nama Produk</td>
    <td><?= htmlspecialchars($produk['nama_produk']); ?></td>
</tr>

<tr>
    <td>Kategori</td>
    <td><?= htmlspecialchars($produk['category_name'] ?? '-'); ?></td>
</tr>

</table>



<!-- ================= THUMBNAIL ================= -->

<h3>Thumbnail</h3>

<?php if($produk['gambar']): ?>

<img src="<?= $upload_url.$produk['gambar']; ?>"
     class="product-thumbnail">

<?php else: ?>

<p>- Tidak ada thumbnail -</p>

<?php endif; ?>



<!-- ================= GALLERY ================= -->

<h3>Gallery</h3>

<?php if($gallery): ?>

<div class="product-gallery">

<?php foreach($gallery as $g): ?>

<img src="<?= $upload_url.$g['image']; ?>">

<?php endforeach; ?>

</div>

<?php else: ?>

<p>- Tidak ada gallery -</p>

<?php endif; ?>



<!-- ================= FEATURES ================= -->

<h3>Features</h3>

<?php if($features): ?>

<?php foreach($features as $f): ?>

<div class="feature-item">

    <?php if($f['image']): ?>

    <img src="<?= $upload_url.$f['image']; ?>">

    <?php endif; ?>


    <div>

        <b><?= htmlspecialchars($f['title']); ?></b>

        <p>
            <?= nl2br(htmlspecialchars($f['description'])); ?>
        </p>

    </div>

</div>

<?php endforeach; ?>

<?php else: ?>

<p>- Tidak ada feature -</p>

<?php endif; ?>




<!-- ================= SPEC ================= -->

<h3>Specifications</h3>

<?php if($groups): ?>

<?php foreach($groups as $g=>$rows): ?>

<h4 class="spec-group-title">
    <?= htmlspecialchars($g); ?>
</h4>

<table class="spec-table">

<?php foreach($rows as $r): ?>

<tr>
    <td><?= htmlspecialchars($r['label']); ?></td>
    <td><?= htmlspecialchars($r['nilai']); ?></td>
</tr>

<?php endforeach; ?>

</table>

<?php endforeach; ?>

<?php else: ?>

<p>- Tidak ada spesifikasi -</p>

<?php endif; ?>




<!-- ================= ACTION ================= -->

<div class="product-detail-action">

<a href="produk-edit.php?id=<?= $id; ?>" class="btn-warning">
    ✎ Edit Produk
</a>

<a href="produk.php" class="btn-secondary">
    Kembali
</a>

</div>



</div>
</div>


</body>
</html>

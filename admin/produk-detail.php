<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . "config.php";

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

$upload_path = "../images/uploads/produk/";


/* ================= LOAD DATA ================= */

/* Produk */
$p = $pdo->prepare("
    SELECT p.*, c.name AS category_name
    FROM produk p
    LEFT JOIN categories c ON p.category_id = c.id
    WHERE p.id=?
");
$p->execute([$id]);
$produk = $p->fetch();

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


/* Spec */
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

<div class="topbar">
    <h2>Detail Produk</h2>

    <a href="produk.php" class="btn-secondary">
        ← Kembali
    </a>
</div>


<div class="card">


<!-- ================= BASIC ================= -->

<h3>Informasi Produk</h3>

<table class="data-table" style="margin-bottom:30px;">

<tr>
    <td width="180"><b>Nama Produk</b></td>
    <td><?= htmlspecialchars($produk['nama_produk']); ?></td>
</tr>

<tr>
    <td><b>Kategori</b></td>
    <td><?= $produk['category_name'] ?? '-'; ?></td>
</tr>

<tr>
    <td><b>Slug</b></td>
    <td><?= $produk['slug']; ?></td>
</tr>

</table>



<!-- ================= THUMBNAIL ================= -->

<h3>Thumbnail</h3>

<?php if($produk['gambar']): ?>

<img src="<?= $upload_path.$produk['gambar']; ?>"
     width="250"
     style="border-radius:12px;margin-bottom:25px;">

<?php else: ?>

<p>- Tidak ada thumbnail -</p>

<?php endif; ?>



<!-- ================= GALLERY ================= -->

<h3>Gallery</h3>

<?php if($gallery): ?>

<div style="display:flex;gap:15px;flex-wrap:wrap;margin-bottom:30px;">

<?php foreach($gallery as $g): ?>

<img src="<?= $upload_path.$g['image']; ?>"
     width="120"
     height="120"
     style="object-fit:cover;border-radius:10px;">

<?php endforeach; ?>

</div>

<?php else: ?>

<p>- Tidak ada gallery -</p>

<?php endif; ?>



<!-- ================= FEATURES ================= -->

<h3>Features</h3>

<?php if($features): ?>

<?php foreach($features as $f): ?>

<div class="feature-row" style="margin-bottom:15px;">

    <?php if($f['image']): ?>

    <img src="<?= $upload_path.$f['image']; ?>"
         width="90"
         style="border-radius:8px;">

    <?php endif; ?>

    <div>

        <b><?= htmlspecialchars($f['title']); ?></b>

        <p style="margin-top:5px;color:#475569;">
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

<h4 style="margin-top:20px;color:#2563eb;">
    <?= htmlspecialchars($g); ?>
</h4>

<table class="data-table" style="margin-bottom:25px;">

<?php foreach($rows as $r): ?>

<tr>
    <td width="250"><?= htmlspecialchars($r['label']); ?></td>
    <td><?= htmlspecialchars($r['nilai']); ?></td>
</tr>

<?php endforeach; ?>

</table>

<?php endforeach; ?>

<?php else: ?>

<p>- Tidak ada spesifikasi -</p>

<?php endif; ?>



<!-- ================= ACTION ================= -->

<div style="margin-top:40px;">

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

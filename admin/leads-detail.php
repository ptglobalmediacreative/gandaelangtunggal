<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require_once "auth.php";
require_once "config.php";

/* CEK AKSES */
if(!cekAkses('leads')){
    die("Akses ditolak!");
}

/* CEK ID */
if(!isset($_GET['id'])){
    header("Location: leads.php");
    exit;
}

$id = (int)$_GET['id'];


/* AMBIL DATA */
$stmt = $pdo->prepare("
    SELECT *
    FROM leads
    WHERE id = ?
");
$stmt->execute([$id]);

$leads = $stmt->fetch();


if(!$leads){
    header("Location: leads.php");
    exit;
}


$upload_path = "/uploads/data-customer/";

?>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>


<div class="main-content">

<!-- TOPBAR -->
<div class="topbar">

    <h2>Detail Leads</h2>

    <div class="topbar-right">

        <span class="admin-name">
            <i class="fa-solid fa-user"></i>
            <?= $_SESSION['admin_nama']; ?>
        </span>

        <a href="logout.php" class="logout-btn">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </a>

    </div>

</div>


<!-- CONTENT -->
<div class="card product-detail-card">


<!-- INFO -->
<h3>Informasi Perusahaan</h3>

<table class="product-info-table">

<tr>
    <td>Nama Perusahaan</td>
    <td><?= htmlspecialchars($leads['nama_perusahaan']); ?></td>
</tr>

<tr>
    <td>Nama PIC</td>
    <td><?= htmlspecialchars($leads['nama_pic']); ?></td>
</tr>

<tr>
    <td>No PIC</td>
    <td><?= htmlspecialchars($leads['no_pic']); ?></td>
</tr>

<tr>
    <td>Email PIC</td>
    <td><?= $leads['email_pic'] ?: '-'; ?></td>
</tr>

<tr>
    <td>Sales</td>
    <td><?= htmlspecialchars($leads['sales']); ?></td>
</tr>

<tr>
    <td>Tanggal Masuk</td>
    <td><?= date('d M Y H:i', strtotime($leads['created_at'])); ?></td>
</tr>

</table>



<!-- NPWP -->
<h3>Dokumen NPWP</h3>

<?php if($leads['npwp_image']): ?>

<img src="<?= $upload_path.$leads['npwp_image']; ?>"
     class="product-thumbnail"
     alt="NPWP">

<?php else: ?>

<p>- Tidak ada dokumen NPWP -</p>

<?php endif; ?>



<!-- ACTION -->
<div class="product-detail-action">

<a href="leads-edit.php?id=<?= $id; ?>"
   class="btn-warning">
✎ Edit
</a>

<a href="leads-hapus.php?id=<?= $id; ?>"
   class="btn-danger"
   onclick="return confirm('Yakin ingin menghapus leads ini?')">
🗑 Hapus
</a>

<a href="leads.php"
   class="btn-secondary">
← Kembali
</a>

</div>


</div>

</div>


</body>
</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "auth.php";
require_once "config.php";

/* CEK AKSES */
if(!cekAkses('delivery')){
    die("Akses ditolak!");
}

/* CEK ID */
if(!isset($_GET['id'])){
    header("Location: delivery.php");
    exit;
}

$id = intval($_GET['id']);

/* AMBIL DATA */
$stmt = $pdo->prepare("
    SELECT *
    FROM delivery_orders
    WHERE id = ?
");
$stmt->execute([$id]);

$data = $stmt->fetch();

if(!$data){
    die("Data tidak ditemukan!");
}

/* FOLDER FILE */
$upload_dir = "uploads/data-customer/";
?>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>


<div class="main-content">

<!-- TOPBAR -->
<div class="topbar">

    <h2>Detail Delivery Order</h2>

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
<div class="card" style="max-width:900px;margin:auto;">


<h3>Informasi Customer</h3>

<table class="product-info-table">

<tr>
<td>Nama PT</td>
<td><?= htmlspecialchars($data['nama_pt']); ?></td>
</tr>

<tr>
<td>Nama PIC</td>
<td><?= htmlspecialchars($data['nama_pic']); ?></td>
</tr>

<tr>
<td>No PIC</td>
<td><?= htmlspecialchars($data['no_pic']); ?></td>
</tr>

<tr>
<td>Email PIC</td>
<td><?= htmlspecialchars($data['email_pic']); ?></td>
</tr>

</table>


<h3>Informasi Unit</h3>

<table class="product-info-table">

<tr>
<td>Tipe Unit</td>
<td><?= htmlspecialchars($data['tipe_unit']); ?></td>
</tr>

<tr>
<td>Nomor Rangka</td>
<td><?= htmlspecialchars($data['nomor_rangka']); ?></td>
</tr>

<tr>
<td>Nomor Mesin</td>
<td><?= htmlspecialchars($data['nomor_mesin']); ?></td>
</tr>

</table>


<h3>Pengiriman & Transaksi</h3>

<table class="product-info-table">

<tr>
<td>Alamat Pengiriman</td>
<td><?= nl2br(htmlspecialchars($data['alamat_pengiriman'])); ?></td>
</tr>

<tr>
<td>Harga Deal</td>
<td>Rp <?= number_format($data['harga_deal'],0,',','.'); ?></td>
</tr>

<tr>
<td>Pembayaran</td>
<td><?= htmlspecialchars($data['pembayaran']); ?></td>
</tr>

<tr>
<td>Tanggal Kirim</td>
<td><?= date('d M Y', strtotime($data['tanggal_kirim'])); ?></td>
</tr>

</table>


<?php if(!empty($data['keterangan'])): ?>
<h3>Keterangan</h3>

<div style="
    background:#f8fafc;
    padding:15px;
    border-radius:12px;
    border:1px solid #e2e8f0;
    margin-bottom:25px;
">
<?= nl2br(htmlspecialchars($data['keterangan'])); ?>
</div>
<?php endif; ?>


<h3>Dokumen PT</h3>

<?php if(!empty($data['dokumen_pt'])): ?>

<?php
$files = explode(',', $data['dokumen_pt']);
?>

<div style="display:flex;flex-wrap:wrap;gap:12px;margin-bottom:25px;">

<?php foreach($files as $file): ?>

<?php if(file_exists($upload_dir.$file)): ?>

<a href="<?= $upload_dir.$file; ?>"
   target="_blank"
   class="btn-secondary"
   style="padding:8px 14px;font-size:13px;">

<i class="fa fa-file"></i>
<?= htmlspecialchars($file); ?>

</a>

<?php endif; ?>

<?php endforeach; ?>

</div>

<?php else: ?>

<p style="color:#64748b;font-style:italic;">
Belum ada dokumen.
</p>

<?php endif; ?>


<!-- BUTTON -->
<div class="product-detail-action">

<a href="delivery.php" class="btn-secondary">
<i class="fa fa-arrow-left"></i> Kembali
</a>

</div>


</div>

</div>

</body>
</html>

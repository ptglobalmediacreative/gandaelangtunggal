<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "auth.php";
require_once "config.php";

/* CEK AKSES */
if(!cekAkses('delivery')){
    die("Akses ditolak!");
}

/* AMBIL DATA DELIVERY */
$stmt = $pdo->query("
    SELECT
        id,
        nama_pt,
        tipe_unit,
        alamat_pengiriman,
        tanggal_kirim
    FROM delivery_orders
    ORDER BY tanggal_kirim DESC
");

$delivery = $stmt->fetchAll();
?>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>


<div class="main-content">

<!-- TOPBAR -->
<div class="topbar">

    <h2>Delivery Order</h2>

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
<div class="card">


<!-- HEADER -->
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">

    <h3>Daftar Delivery Order</h3>

    <a href="delivery-tambah.php" class="btn-primary">
        Tambah Delivery Order
    </a>

</div>


<!-- TABLE -->
<div class="table-wrapper">

<table class="data-table">

<thead>
<tr>
    <th width="60">No</th>
    <th>Nama PT</th>
    <th>Type Unit</th>
    <th>Alamat Kirim</th>
    <th width="150">Tanggal Kirim</th>
    <th width="120">Aksi</th>
</tr>
</thead>


<tbody>

<?php if($delivery): ?>

<?php $no=1; foreach($delivery as $d): ?>

<tr>

<td><?= $no++; ?></td>

<td><?= htmlspecialchars($d['nama_pt']); ?></td>

<td><?= htmlspecialchars($d['tipe_unit']); ?></td>

<td><?= htmlspecialchars($d['alamat_pengiriman']); ?></td>

<td>
<?= date('d M Y', strtotime($d['tanggal_kirim'])); ?>
</td>

<td>

<div class="action-group">

<!-- DETAIL -->
<a href="delivery-detail.php?id=<?= $d['id']; ?>"
class="btn-sm btn-info"
title="Detail">
<i class="fa fa-eye"></i>
</a>

</div>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>
<td colspan="6" class="table-empty">
Belum ada data delivery order
</td>
</tr>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

</div>


</body>
</html>

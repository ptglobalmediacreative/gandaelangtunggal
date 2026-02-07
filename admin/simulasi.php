<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

date_default_timezone_set('Asia/Jakarta');

session_start();
require_once __DIR__ . "/config.php";

/* CEK LOGIN */
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

/* AMBIL DATA SIMULASI */
$stmt = $pdo->query("
    SELECT *
    FROM simulasi
    ORDER BY created_at DESC
");

$simulasi = $stmt->fetchAll();
?>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>


<div class="main-content">

<!-- TOPBAR -->
<div class="topbar">

    <h2>Manajemen Simulasi Kredit</h2>

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

    <h3>Daftar Simulasi Kredit</h3>

</div>



<!-- TABLE -->
<div class="table-wrapper">

<table class="data-table">

<thead>
<tr>
    <th width="50">No</th>
    <th>Nama</th>
    <th>Telepon</th>
    <th>Tipe Unit</th>
    <th>Tenor</th>
    <th>Budget TDP</th>
    <th>Pesan</th>
    <th width="160">Tanggal</th>
    <th width="120">Aksi</th>
</tr>
</thead>


<tbody>

<?php if($simulasi): ?>

<?php $no=1; foreach($simulasi as $s): ?>

<tr>

<td><?= $no++; ?></td>

<td><?= htmlspecialchars($s['nama']); ?></td>

<td><?= htmlspecialchars($s['telepon']); ?></td>

<td><?= htmlspecialchars($s['tipe_unit']); ?></td>

<td><?= $s['tenor']; ?> Bulan</td>

<td>
Rp <?= number_format($s['budget_tdp'],0,',','.'); ?>
</td>

<td class="article-desc">
<?= htmlspecialchars($s['pesan']); ?>
</td>

<td>
<?= date('d M Y H:i', strtotime($s['created_at'])); ?>
</td>

<td>

<div class="action-group">

<!-- DETAIL -->
<a href="simulasi-detail.php?id=<?= $s['id']; ?>"
class="btn-sm btn-info"
title="Detail">
<i class="fa fa-eye"></i>
</a>

<!-- DELETE -->
<a href="simulasi-hapus.php?id=<?= $s['id']; ?>"
class="btn-sm btn-danger"
title="Hapus"
onclick="return confirmDelete('<?= htmlspecialchars($s['nama']); ?>')">
<i class="fa fa-trash"></i>
</a>

</div>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>
<td colspan="9" class="table-empty">
Belum ada data simulasi kredit
</td>
</tr>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

</div>



<script>
function confirmDelete(nama){

    return confirm(
        "Yakin ingin menghapus data simulasi ini?\n\n" +
        "Nama: " + nama
    );

}
</script>


</body>
</html>

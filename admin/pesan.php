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

/* AMBIL DATA PESAN */
$stmt = $pdo->query("
    SELECT *
    FROM pesan
    ORDER BY created_at DESC
");

$pesan = $stmt->fetchAll();
?>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<div class="main-content">

<!-- TOPBAR -->
<div class="topbar">

    <h2>Manajemen Pesan</h2>

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

    <h3>Daftar Pesan Customer</h3>

</div>


<!-- TABLE -->
<div class="table-wrapper">

<table class="data-table">

<thead>
<tr>
    <th width="50">No</th>
    <th>Nama Customer</th>
    <th>No Telepon</th>
    <th>Email</th>
    <th>Pesan</th>
    <th width="160">Tanggal</th>
    <th width="120">Aksi</th>
</tr>
</thead>


<tbody>

<?php if($pesan): ?>

<?php $no=1; foreach($pesan as $p): ?>

<tr>

<td><?= $no++; ?></td>

<td><?= htmlspecialchars($p['nama']); ?></td>

<td><?= htmlspecialchars($p['telepon']); ?></td>

<td><?= htmlspecialchars($p['email']); ?></td>

<td style="max-width:300px;">
    <?= nl2br(htmlspecialchars(substr($p['pesan'],0,150))); ?>...
</td>

<td>
<?= date('d M Y H:i', strtotime($p['created_at'])); ?>
</td>

<td>

<div class="action-group">

<!-- DETAIL -->
<a href="pesan-detail.php?id=<?= $p['id']; ?>"
class="btn-sm btn-info"
title="Detail">
<i class="fa fa-eye"></i>
</a>

<!-- DELETE -->
<a href="pesan-hapus.php?id=<?= $p['id']; ?>"
class="btn-sm btn-danger"
title="Hapus"
onclick="return confirmDelete('<?= htmlspecialchars($p['nama']); ?>')">
<i class="fa fa-trash"></i>
</a>

</div>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>
<td colspan="7" class="table-empty">
Belum ada pesan masuk
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
        "Yakin ingin menghapus pesan ini?\n\n" +
        "Dari: " + nama
    );

}
</script>


</body>
</html>

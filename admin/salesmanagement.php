<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require_once "auth.php";
require_once "config.php";

/* CEK AKSES */
if(!cekAkses('sales')){
    die("Akses ditolak!");
}

/* AMBIL DATA SALES */
$stmt = $pdo->query("
    SELECT id, nama, no_hp
    FROM sales
    ORDER BY id DESC
");

$sales = $stmt->fetchAll();
?>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>


<div class="main-content">

<!-- TOPBAR -->
<div class="topbar">

    <h2>Manajemen Sales</h2>

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

    <h3>Daftar Sales</h3>

    <a href="sales-tambah.php" class="btn-primary">
        Tambah Sales
    </a>

</div>


<!-- TABLE -->
<div class="table-wrapper">

<table class="data-table">

<thead>
<tr>
    <th width="60">No</th>
    <th>Nama</th>
    <th>No HP</th>
    <th width="180">Aksi</th>
</tr>
</thead>


<tbody>

<?php if($sales): ?>

<?php $no=1; foreach($sales as $s): ?>

<tr>

<td><?= $no++; ?></td>

<td><?= htmlspecialchars($s['nama']); ?></td>

<td><?= htmlspecialchars($s['no_hp']); ?></td>

<td>

<div class="action-group">

<!-- DETAIL -->
<a href="sales-detail.php?id=<?= $s['id']; ?>"
class="btn-sm btn-info"
title="Detail">
<i class="fa fa-eye"></i>
</a>

<!-- EDIT -->
<a href="sales-edit.php?id=<?= $s['id']; ?>"
class="btn-sm btn-warning"
title="Edit">
<i class="fa fa-edit"></i>
</a>

<!-- DELETE -->
<a href="sales-hapus.php?id=<?= $s['id']; ?>"
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
<td colspan="4" class="table-empty">
Belum ada data sales
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
        "Yakin ingin menghapus sales ini?\n\n" +
        "Nama: " + nama
    );

}
</script>


</body>
</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "auth.php";
require_once "config.php";

/* CEK AKSES */
if(!cekAkses('user')){
    die("Akses ditolak!");
}

/* AMBIL DATA ADMIN */
$stmt = $pdo->query("
    SELECT 
        id,
        nama,
        keterangan,
        no_hp,
        email,
        created_at
    FROM admin
    ORDER BY id DESC
");

$admin = $stmt->fetchAll();
?>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>


<div class="main-content">

<!-- TOPBAR -->
<div class="topbar">

    <h2>Manajemen User Admin</h2>

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

    <h3>Daftar Admin</h3>

    <a href="admin-tambah.php" class="btn-primary">
        Tambah Admin
    </a>

</div>


<!-- TABLE -->
<div class="table-wrapper">

<table class="data-table">

<thead>
<tr>
    <th width="50">No</th>
    <th>Nama</th>
    <th>Keterangan</th>
    <th>No HP</th>
    <th>Email</th>
    <th width="150">Aksi</th>
</tr>
</thead>


<tbody>

<?php if($admin): ?>

<?php $no=1; foreach($admin as $a): ?>

<tr>

<td><?= $no++; ?></td>

<td><?= htmlspecialchars($a['nama']); ?></td>

<td>
    <?= $a['keterangan'] ? htmlspecialchars($a['keterangan']) : '-' ?>
</td>

<td><?= htmlspecialchars($a['no_hp']); ?></td>

<td><?= htmlspecialchars($a['email']); ?></td>

<td>

<div class="action-group">

<!-- EDIT -->
<a href="admin-edit.php?id=<?= $a['id']; ?>"
class="btn-sm btn-warning"
title="Edit">
<i class="fa fa-edit"></i>
</a>

<!-- DELETE -->
<?php if($a['id'] != $_SESSION['admin_id']): ?>
<a href="admin-hapus.php?id=<?= $a['id']; ?>"
class="btn-sm btn-danger"
title="Hapus"
onclick="return confirmDelete('<?= htmlspecialchars($a['nama']); ?>')">
<i class="fa fa-trash"></i>
</a>
<?php endif; ?>

</div>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>
<td colspan="6" class="table-empty">
Belum ada admin
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
        "Yakin ingin menghapus admin ini?\n\n" +
        "Nama: " + nama
    );

}
</script>


</body>
</html>

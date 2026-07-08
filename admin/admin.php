<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "auth.php";
require_once "config.php";

/* CEK AKSES */
if(!cekAkses('user')){
    die("Akses ditolak!");
}

/* TAMPILKAN PESAN STATUS */
$status_message = '';
if(isset($_GET['status'])){
    if($_GET['status'] == 'add'){
        $status_message = '<div class="alert-success">Admin berhasil ditambahkan!</div>';
    } elseif($_GET['status'] == 'edit'){
        $status_message = '<div class="alert-success">Admin berhasil diupdate!</div>';
    } elseif($_GET['status'] == 'delete'){
        $status_message = '<div class="alert-success">Admin berhasil dihapus!</div>';
    } elseif($_GET['status'] == 'error'){
        $status_message = '<div class="alert-error">' . htmlspecialchars($_GET['message']) . '</div>';
    }
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
            <?= htmlspecialchars($_SESSION['admin_nama']); ?>
        </span>

        <a href="logout.php" class="logout-btn">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </a>

    </div>

</div>


<!-- CONTENT -->
<div class="card">

<!-- PESAN STATUS -->
<?= $status_message ?>

<!-- HEADER -->
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;flex-wrap:wrap;gap:10px;">

    <h3>Daftar Admin</h3>

    <a href="admin-tambah.php" class="btn-primary">
        <i class="fa-solid fa-plus"></i> Tambah Admin
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

<?php
$isDeveloper = (strtolower($a['keterangan']) == 'developer');
$isSelf      = ($a['id'] == $_SESSION['admin_id']);
?>

<!-- EDIT - Bisa edit developer hanya jika dia sendiri -->
<?php if(!$isDeveloper || $isSelf): ?>
<a href="admin-edit.php?id=<?= $a['id']; ?>"
   class="btn-sm btn-warning"
   title="Edit">
    <i class="fa fa-edit"></i>
</a>
<?php endif; ?>

<!-- DELETE - Tidak bisa hapus developer dan diri sendiri -->
<?php if(!$isDeveloper && !$isSelf): ?>
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
<td colspan="6" style="text-align:center;padding:40px 0;color:#999;">
    <i class="fa-solid fa-user-slash" style="font-size:24px;display:block;margin-bottom:10px;"></i>
    Belum ada admin
</td>
</tr>

<?php endif; ?>

</tbody>

</table>

</div>

<!-- INFO JUMLAH DATA -->
<div style="margin-top:15px;color:#888;font-size:13px;">
    Total: <?= count($admin) ?> admin
</div>

</div>

</div>


<script>
function confirmDelete(nama){
    return confirm(
        "Yakin ingin menghapus admin ini?\n\n" +
        "Nama: " + nama + "\n\n" +
        "Data yang dihapus tidak dapat dikembalikan!"
    );
}
</script>


</body>
</html>
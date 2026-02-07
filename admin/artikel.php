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

/* AMBIL DATA ARTIKEL */
$stmt = $pdo->query("
    SELECT *
    FROM artikel
    ORDER BY created_at DESC
");

$artikel = $stmt->fetchAll();
?>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<div class="main-content">

<!-- TOPBAR -->
<div class="topbar">

    <h2>Manajemen Artikel</h2>

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

    <h3>Daftar Artikel</h3>

    <a href="artikel-tambah.php" class="btn-primary">
        <i class="fa fa-plus"></i> Tambah Artikel
    </a>

</div>


<!-- TABLE -->
<div class="table-wrapper">

<table class="data-table">

<thead>
<tr>
    <th width="50">No</th>
    <th width="90">Gambar</th>
    <th>Judul</th>
    <th>Deskripsi</th>
    <th width="160">Tanggal</th>
    <th width="160">Aksi</th>
</tr>
</thead>


<tbody>

<?php if($artikel): ?>

<?php $no=1; foreach($artikel as $a): ?>

<tr>

<td><?= $no++; ?></td>


<td>
<?php if($a['gambar']): ?>
<img src="../images/uploads/artikel/<?= $a['gambar']; ?>">
<?php else: ?>
-
<?php endif; ?>
</td>


<td>
<?= htmlspecialchars($a['judul']); ?>
</td>


<td>
<?= substr(strip_tags($a['deskripsi']),0,100); ?>...
</td>


<td>
<?= date('d M Y H:i', strtotime($a['created_at'])); ?>
</td>


<td>

<div class="action-group">

<!-- DETAIL -->
<a href="artikel-detail.php?id=<?= $a['id']; ?>"
class="btn-sm btn-info"
title="Detail">
<i class="fa fa-eye"></i>
</a>

<!-- EDIT -->
<a href="artikel-edit.php?id=<?= $a['id']; ?>"
class="btn-sm btn-warning"
title="Edit">
<i class="fa fa-edit"></i>
</a>

<!-- DELETE -->
<a href="artikel-hapus.php?id=<?= $a['id']; ?>"
class="btn-sm btn-danger"
title="Hapus"
onclick="return confirmDelete('<?= htmlspecialchars($a['judul']); ?>')">
<i class="fa fa-trash"></i>
</a>

</div>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>
<td colspan="6" class="table-empty">
Belum ada artikel
</td>
</tr>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

</div>


<script>
function confirmDelete(judul){

    return confirm(
        "Yakin ingin menghapus artikel ini?\n\n" +
        "Judul: " + judul
    );

}
</script>


</body>
</html>

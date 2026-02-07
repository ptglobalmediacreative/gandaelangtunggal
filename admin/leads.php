<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "auth.php";
require_once "config.php";

/* CEK AKSES */
if (!cekAkses('leads')) {
    die("Akses ditolak!");
}

/* AMBIL DATA LEADS */
$stmt = $pdo->query("
    SELECT *
    FROM leads
    ORDER BY created_at DESC
");

$leads = $stmt->fetchAll();
?>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>


<div class="main-content">

<!-- TOPBAR -->
<div class="topbar">

    <h2>Manajemen Leads Customer</h2>

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

    <h3>Daftar Leads</h3>

</div>


<!-- TABLE -->
<div class="table-wrapper">

<table class="data-table">

<thead>
<tr>
    <th width="50">No</th>
    <th>Nama Perusahaan</th>
    <th>Nama PIC</th>
    <th>No PIC</th>
    <th>Email PIC</th>
    <th>NPWP</th>
    <th>Sales</th>
    <th width="120">Aksi</th>
</tr>
</thead>


<tbody>

<?php if($leads): ?>

<?php $no=1; foreach($leads as $l): ?>

<tr>

<td><?= $no++; ?></td>

<td><?= htmlspecialchars($l['nama_perusahaan']); ?></td>

<td><?= htmlspecialchars($l['nama_pic']); ?></td>

<td><?= htmlspecialchars($l['no_pic']); ?></td>

<td><?= htmlspecialchars($l['email_pic']); ?></td>


<!-- NPWP IMAGE -->
<td>

<?php if(!empty($l['npwp_image'])): ?>

<img src="../images/uploads/npwp/<?= $l['npwp_image']; ?>"
     style="width:60px;height:60px;object-fit:cover;border-radius:8px;cursor:pointer;"
     onclick="previewImage(this.src)">

<?php else: ?>
-
<?php endif; ?>

</td>


<td><?= htmlspecialchars($l['sales']); ?></td>


<td>

<div class="action-group">

<!-- DETAIL -->
<a href="leads-detail.php?id=<?= $l['id']; ?>"
class="btn-sm btn-info"
title="Detail">
<i class="fa fa-eye"></i>
</a>

<!-- DELETE -->
<a href="leads-hapus.php?id=<?= $l['id']; ?>"
class="btn-sm btn-danger"
title="Hapus"
onclick="return confirmDelete('<?= htmlspecialchars($l['nama_perusahaan']); ?>')">
<i class="fa fa-trash"></i>
</a>

</div>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>
<td colspan="8" class="table-empty">
Belum ada data leads
</td>
</tr>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

</div>


<!-- MODAL PREVIEW IMAGE -->
<div id="imgModal" style="
display:none;
position:fixed;
top:0;
left:0;
right:0;
bottom:0;
background:rgba(0,0,0,0.8);
z-index:9999;
justify-content:center;
align-items:center;
">

<img id="modalImg" style="
max-width:90%;
max-height:90%;
border-radius:12px;
box-shadow:0 0 30px rgba(255,255,255,0.2);
">

</div>


<script>

/* CONFIRM DELETE */
function confirmDelete(nama){

    return confirm(
        "Yakin ingin menghapus data leads ini?\n\n" +
        "Perusahaan: " + nama
    );
}


/* PREVIEW IMAGE */
function previewImage(src){

    document.getElementById("modalImg").src = src;
    document.getElementById("imgModal").style.display = "flex";
}


/* CLOSE MODAL */
document.getElementById("imgModal").addEventListener("click", function(){

    this.style.display = "none";

});

</script>


</body>
</html>

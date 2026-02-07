<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require_once "auth.php";
require_once "config.php";

/* CEK AKSES */
if(!cekAkses('sales')){
    die("Akses ditolak!");
}

/* CEK ID */
if(!isset($_GET['id'])){
    header("Location: salesmanagement.php");
    exit;
}

$id = (int)$_GET['id'];

/* AMBIL DATA */
$stmt = $pdo->prepare("SELECT * FROM sales_management WHERE id=?");
$stmt->execute([$id]);

$sales = $stmt->fetch();

if(!$sales){
    header("Location: salesmanagement.php");
    exit;
}

$upload = "/uploads/data-sales/";
?>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<div class="main-content">

<div class="topbar">
    <h2>Detail Sales</h2>
</div>

<div class="card">

<h3>Informasi Sales</h3>

<table class="data-table">

<tr>
<td width="200"><b>Nama</b></td>
<td><?= htmlspecialchars($sales['nama']); ?></td>
</tr>

<tr>
<td><b>No HP</b></td>
<td><?= htmlspecialchars($sales['no_hp']); ?></td>
</tr>

<tr>
<td><b>Email</b></td>
<td><?= htmlspecialchars($sales['email']); ?></td>
</tr>

<tr>
<td><b>Tanggal Lahir</b></td>
<td><?= $sales['tgl_lahir']; ?></td>
</tr>

<tr>
<td><b>Jenis Kelamin</b></td>
<td><?= $sales['jenis_kelamin']; ?></td>
</tr>

</table>


<h3 style="margin-top:30px;">Dokumen</h3>

<div style="display:flex;gap:20px;flex-wrap:wrap;">

<?php
$docs = [
    'KTP'=>'ktp',
    'NPWP'=>'npwp',
    'SIM'=>'sim',
    'Foto'=>'foto'
];

foreach($docs as $label=>$field):
if($sales[$field]):
?>

<div style="text-align:center;">
<b><?= $label ?></b><br>

<img src="<?= $upload.$sales[$field] ?>"
width="150"
style="border-radius:10px;margin-top:6px;">

</div>

<?php endif; endforeach; ?>

</div>


<div class="sales-detail-action">

<a href="sales-edit.php?id=<?= $sales['id']; ?>"
class="btn-primary">
<i class="fa fa-edit"></i> Edit Data
</a>

<a href="salesmanagement.php"
class="btn-secondary">
<i class="fa fa-arrow-left"></i> Kembali
</a>

</div>


</div>
</div>

</body>
</html>

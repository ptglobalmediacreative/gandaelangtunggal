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

/* CEK ID */
if (!isset($_GET['id'])) {
    header("Location: simulasi.php");
    exit;
}

$id = (int)$_GET['id'];


/* AMBIL DATA SIMULASI */
$stmt = $pdo->prepare("
    SELECT *
    FROM simulasi
    WHERE id=?
");

$stmt->execute([$id]);
$data = $stmt->fetch();


if(!$data){
    header("Location: simulasi.php");
    exit;
}
?>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>


<div class="main-content">

<!-- TOPBAR -->
<div class="topbar">

    <h2>Detail Simulasi Kredit</h2>

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
<div class="card product-detail-card">


<h3>Data Customer</h3>

<table class="product-info-table">

<tr>
    <td>Nama</td>
    <td><?= htmlspecialchars($data['nama']); ?></td>
</tr>

<tr>
    <td>Telepon</td>
    <td><?= htmlspecialchars($data['telepon']); ?></td>
</tr>

<tr>
    <td>Tipe Unit</td>
    <td><?= htmlspecialchars($data['tipe_unit']); ?></td>
</tr>

<tr>
    <td>Tenor</td>
    <td><?= htmlspecialchars($data['tenor']); ?> Bulan</td>
</tr>

<tr>
    <td>Budget DP</td>
    <td>Rp <?= number_format($data['budget_dp'],0,',','.'); ?></td>
</tr>

<tr>
    <td>Tanggal</td>
    <td><?= date('d M Y H:i', strtotime($data['created_at'])); ?></td>
</tr>

</table>



<h3>Pesan Tambahan</h3>

<div style="
    background:#f8fafc;
    border:1px solid #e2e8f0;
    padding:20px;
    border-radius:12px;
    line-height:1.6;
">

<?= nl2br(htmlspecialchars($data['pesan'])); ?>

</div>



<!-- ACTION -->
<div class="product-detail-action">

<a href="simulasi.php" class="btn-secondary">
Kembali
</a>

<a href="simulasi-hapus.php?id=<?= $id; ?>"
class="btn-danger"
onclick="return confirm('Yakin ingin menghapus data simulasi ini?')">
Hapus
</a>

</div>


</div>

</div>

</body>
</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

date_default_timezone_set('Asia/Jakarta');

session_start();
require_once __DIR__ . "/config.php";
require_once "auth.php";

/* CEK LOGIN */
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

/* CEK ID */
if (!isset($_GET['id'])) {
    header("Location: pesan.php");
    exit;
}

$id = (int)$_GET['id'];


/* AMBIL DATA PESAN */
$stmt = $pdo->prepare("
    SELECT *
    FROM pesan
    WHERE id=?
");

$stmt->execute([$id]);
$pesan = $stmt->fetch();


if(!$pesan){
    header("Location: pesan.php");
    exit;
}
?>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>


<div class="main-content">

<!-- TOPBAR -->
<div class="topbar">

    <h2>Detail Pesan</h2>

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


<h3>Informasi Customer</h3>

<table class="product-info-table">

<tr>
    <td>Nama</td>
    <td><?= htmlspecialchars($pesan['nama']); ?></td>
</tr>

<tr>
    <td>Telepon</td>
    <td><?= htmlspecialchars($pesan['telepon']); ?></td>
</tr>

<tr>
    <td>Email</td>
    <td><?= htmlspecialchars($pesan['email']); ?></td>
</tr>

<tr>
    <td>Tanggal</td>
    <td>
        <?= date('d M Y H:i', strtotime($pesan['created_at'])); ?>
    </td>
</tr>

</table>



<h3>Isi Pesan</h3>

<div style="
    background:#f8fafc;
    border:1px solid #e2e8f0;
    padding:20px;
    border-radius:12px;
    line-height:1.6;
">

<?= nl2br(htmlspecialchars($pesan['pesan'])); ?>

</div>



<!-- ACTION -->
<div class="product-detail-action">

<a href="pesan.php" class="btn-secondary">
Kembali
</a>

<a href="pesan-hapus.php?id=<?= $id; ?>"
class="btn-danger"
onclick="return confirm('Yakin ingin menghapus pesan ini?')">
Hapus
</a>

</div>


</div>

</div>

</body>
</html>

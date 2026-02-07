<?php
session_start();
include "config.php"; // sesuaikan path

// Cek login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

// Ambil data produk + kategori
$stmt = $pdo->prepare("
    SELECT p.*, c.name AS category_name
    FROM produk p
    LEFT JOIN categories c ON p.category_id = c.id
    ORDER BY p.id DESC
");
$stmt->execute();

$produk = $stmt->fetchAll();
?>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<div class="main-content">

<!-- Topbar -->
<div class="topbar">
    <h2>Manajemen Produk</h2>

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

<!-- Content -->
<div class="card">

    <!-- Header -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h3>Daftar Produk</h3>

        <a href="produk_tambah.php" class="btn-primary">
            <i class="fa fa-plus"></i> Tambah Produk
        </a>
    </div>

    <!-- Table -->
    <div style="overflow-x:auto;">
    <table class="data-table">

        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Varian</th>
                <th>Status</th>
                <th width="160">Aksi</th>
            </tr>
        </thead>

        <tbody>

        <?php if(count($produk) > 0): ?>

            <?php $no=1; foreach($produk as $p): ?>

            <tr>
                <td><?= $no++; ?></td>

                <td>
                    <?php if($p['gambar']): ?>
                        <img src="../upload/produk/<?= $p['gambar']; ?>"
                             width="60" height="60"
                             style="object-fit:cover;border-radius:6px;">
                    <?php else: ?>
                        <span>-</span>
                    <?php endif; ?>
                </td>

                <td><?= htmlspecialchars($p['nama_produk']); ?></td>

                <td><?= $p['category_name'] ?? '-'; ?></td>

                <td><?= $p['varian'] ?: '-'; ?></td>

                <td>
                    <?php if($p['status']=='aktif'): ?>
                        <span class="badge badge-success">Aktif</span>
                    <?php else: ?>
                        <span class="badge badge-danger">Nonaktif</span>
                    <?php endif; ?>
                </td>

                <td>

                    <a href="produk_edit.php?id=<?= $p['id']; ?>"
                       class="btn-sm btn-warning">
                        <i class="fa fa-edit"></i>
                    </a>

                    <a href="produk_hapus.php?id=<?= $p['id']; ?>"
                       class="btn-sm btn-danger"
                       onclick="return confirm('Hapus produk ini?')">
                        <i class="fa fa-trash"></i>
                    </a>

                </td>
            </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>
                <td colspan="7" align="center">Belum ada produk</td>
            </tr>

        <?php endif; ?>

        </tbody>

    </table>
    </div>

</div>

</div>

</body>
</html>

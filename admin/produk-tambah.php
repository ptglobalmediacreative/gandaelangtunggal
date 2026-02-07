<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . "/config.php";

// Cek login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

// Ambil kategori
$cat = $pdo->query("SELECT * FROM categories ORDER BY name ASC")->fetchAll();

// Function buat slug
function buat_slug($text){

    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    $text = trim($text, '-');

    return $text;
}

// Simpan data
if(isset($_POST['simpan'])){

    $nama     = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $deskripsi= $_POST['deskripsi'];

    $slug = buat_slug($nama);

    /* Upload Gambar */
    $gambar = null;

    if(!empty($_FILES['gambar']['name'])){

        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $namaBaru = time().rand(100,999).".".$ext;

        $upload = "../upload/produk/".$namaBaru;

        if(move_uploaded_file($_FILES['gambar']['tmp_name'], $upload)){
            $gambar = $namaBaru;
        }
    }

    // Simpan DB
    $stmt = $pdo->prepare("
        INSERT INTO produk
        (category_id, nama_produk, slug, deskripsi, gambar)
        VALUES (?,?,?,?,?)
    ");

    $stmt->execute([
        $kategori,
        $nama,
        $slug,
        $deskripsi,
        $gambar
    ]);

    header("Location: produk.php?status=sukses");
    exit;
}
?>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<div class="main-content">

<!-- Topbar -->
<div class="topbar">
    <h2>Tambah Produk</h2>
</div>

<!-- Form -->
<div class="card">

<form method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" name="nama" required>
    </div>

    <div class="form-group">
        <label>Kategori</label>

        <select name="kategori" required>
            <option value="">-- Pilih Kategori --</option>

            <?php foreach($cat as $c): ?>

            <option value="<?= $c['id']; ?>">
                <?= $c['name']; ?>
            </option>

            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="4"></textarea>
    </div>

    <div class="form-group">
        <label>Gambar Produk</label>
        <input type="file" name="gambar" accept="image/*">
    </div>

    <div style="margin-top:20px;">

        <button type="submit" name="simpan" class="btn-primary">
            <i class="fa fa-save"></i> Simpan
        </button>

        <a href="produk.php" class="btn-secondary">
            Kembali
        </a>

    </div>

</form>

</div>

</div>

</body>
</html>

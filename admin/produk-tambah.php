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
    return trim($text, '-');
}

// SIMPAN DATA
if(isset($_POST['simpan'])){

    $nama     = $_POST['nama'];
    $kategori = $_POST['kategori'];

    $slug = buat_slug($nama);

    /* Upload Thumbnail */
    $gambar_produk = null;

    if(!empty($_FILES['gambar_produk']['name'])){

        $ext = pathinfo($_FILES['gambar_produk']['name'], PATHINFO_EXTENSION);
        $new = time().rand(100,999).".".$ext;

        if(move_uploaded_file($_FILES['gambar_produk']['tmp_name'], "../upload/produk/".$new)){
            $gambar_produk = $new;
        }
    }

    // SIMPAN PRODUK
    $stmt = $pdo->prepare("
        INSERT INTO produk
        (category_id, nama_produk, slug, gambar)
        VALUES (?,?,?,?)
    ");

    $stmt->execute([
        $kategori,
        $nama,
        $slug,
        $gambar_produk
    ]);

    $produk_id = $pdo->lastInsertId();

    // SIMPAN FEATURES
    if(!empty($_POST['feature_title'])){

        foreach($_POST['feature_title'] as $i => $title){

            if(empty($title)) continue;

            $desc = $_POST['feature_desc'][$i];

            $img = null;

            if(!empty($_FILES['feature_image']['name'][$i])){

                $ext = pathinfo($_FILES['feature_image']['name'][$i], PATHINFO_EXTENSION);
                $new = time().$i.rand(10,99).".".$ext;

                move_uploaded_file(
                    $_FILES['feature_image']['tmp_name'][$i],
                    "../upload/features/".$new
                );

                $img = $new;
            }

            $save = $pdo->prepare("
                INSERT INTO produk_features
                (produk_id, grup, title, description, image, sort_order)
                VALUES (?,?,?,?,?,?)
            ");

            $save->execute([
                $produk_id,
                'FEATURE',
                $title,
                $desc,
                $img,
                $i
            ]);
        }
    }

    header("Location: produk.php?status=sukses");
    exit;
}
?>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<div class="main-content">

<div class="topbar">
    <h2>Tambah Produk</h2>
</div>

<div class="card">

<form method="POST" enctype="multipart/form-data">

    <!-- NAMA -->
    <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" name="nama" required>
    </div>

    <!-- KATEGORI -->
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

    <!-- THUMBNAIL -->
    <div class="form-group">
        <label>Gambar Utama</label>
        <input type="file" name="gambar_produk" accept="image/*">
    </div>


    <!-- FEATURES -->
    <h3 style="margin:25px 0 10px;">Features</h3>

    <div id="feature-wrapper">

        <div class="feature-row">

            <input type="text" name="feature_title[]" placeholder="Judul Feature" required>

            <textarea name="feature_desc[]" placeholder="Deskripsi Feature"></textarea>

            <input type="file" name="feature_image[]" accept="image/*">

            <button type="button" class="btn-remove" onclick="removeFeature(this)">✕</button>

        </div>

    </div>

    <button type="button" onclick="addFeature()" class="btn-add">
        + Tambah Feature
    </button>


    <!-- BUTTON -->
    <div style="margin-top:25px;">

        <button type="submit" name="simpan" class="btn-primary">
            Simpan
        </button>

        <a href="produk.php" class="btn-secondary">
            Kembali
        </a>

    </div>

</form>

</div>

</div>


<!-- SCRIPT -->
<script>

function addFeature(){

    let div = document.createElement("div");
    div.classList.add("feature-row");

    div.innerHTML = `
        <input type="text" name="feature_title[]" placeholder="Judul Feature" required>

        <textarea name="feature_desc[]" placeholder="Deskripsi Feature"></textarea>

        <input type="file" name="feature_image[]" accept="image/*">

        <button type="button" class="btn-remove" onclick="removeFeature(this)">✕</button>
    `;

    document.getElementById("feature-wrapper").appendChild(div);
}

function removeFeature(btn){

    btn.parentElement.remove();
}

</script>

</body>
</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

date_default_timezone_set('Asia/Jakarta');

session_start();
require_once __DIR__ . "/config.php";

/* ================= LOGIN ================= */

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

/* ================= ID ================= */

if (!isset($_GET['id'])) {
    header("Location: artikel.php");
    exit;
}

$id = (int) $_GET['id'];


/* ================= CONFIG ================= */

$upload_path = "../images/uploads/artikel/";

if (!is_dir($upload_path)) {
    mkdir($upload_path, 0777, true);
}

$allowed_ext = ['jpg','jpeg','png','webp'];


/* ================= FUNCTION ================= */

/* Resize < 100KB */
function compressImage($source, $dest, $quality = 75){

    $info = getimagesize($source);

    if($info['mime'] == 'image/jpeg'){
        $image = imagecreatefromjpeg($source);
        imagejpeg($image, $dest, $quality);
    }
    elseif($info['mime'] == 'image/png'){
        $image = imagecreatefrompng($source);
        imagepng($image, $dest, 8);
    }
    elseif($info['mime'] == 'image/webp'){
        $image = imagecreatefromwebp($source);
        imagewebp($image, $dest, $quality);
    }

    return $dest;
}


/* Upload + Resize */
function uploadImage($tmp, $name, $path){

    global $allowed_ext;

    if(empty($tmp)) return null;

    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    if(!in_array($ext, $allowed_ext)){
        return null;
    }

    $new = time().rand(100,999).".".$ext;
    $dest = $path.$new;

    compressImage($tmp, $dest, 70);

    return $new;
}



/* ================= LOAD DATA ================= */

$q = $pdo->prepare("SELECT * FROM artikel WHERE id=?");
$q->execute([$id]);
$artikel = $q->fetch();

if(!$artikel){
    header("Location: artikel.php");
    exit;
}



/* ================= UPDATE ================= */

if(isset($_POST['update'])){

    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    $old_img = $artikel['gambar'];
    $gambar = $old_img;


    /* Upload baru */
    if(!empty($_FILES['gambar']['name'])){

        $new = uploadImage(
            $_FILES['gambar']['tmp_name'],
            $_FILES['gambar']['name'],
            $upload_path
        );

        if($new){

            // Hapus gambar lama
            if($old_img && file_exists($upload_path.$old_img)){
                unlink($upload_path.$old_img);
            }

            $gambar = $new;
        }
    }


    /* Update DB */
    $stmt = $pdo->prepare("
        UPDATE artikel SET
        judul=?,
        deskripsi=?,
        gambar=?
        WHERE id=?
    ");

    $stmt->execute([
        $judul,
        $deskripsi,
        $gambar,
        $id
    ]);


    header("Location: artikel.php?status=updated");
    exit;
}

?>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>


<div class="main-content">

<!-- TOPBAR -->
<div class="topbar">
    <h2>Edit Artikel</h2>

    <a href="artikel.php" class="btn-secondary">
        Kembali
    </a>
</div>


<div class="card">

<form method="POST" enctype="multipart/form-data">


<!-- JUDUL -->

<div class="form-group">
    <label>Judul Artikel</label>

    <input type="text"
           name="judul"
           value="<?= htmlspecialchars($artikel['judul']); ?>"
           required>
</div>


<!-- DESKRIPSI -->

<div class="form-group">
    <label>Deskripsi</label>

    <textarea name="deskripsi"
              required><?= htmlspecialchars($artikel['deskripsi']); ?></textarea>
</div>


<!-- GAMBAR -->

<div class="form-group">
    <label>Gambar Artikel</label><br>

    <?php if($artikel['gambar']): ?>

        <img src="<?= $upload_path.$artikel['gambar']; ?>"
             class="preview-image"
             style="margin-bottom:12px;"><br>

    <?php endif; ?>

    <input type="file"
           name="gambar"
           accept=".jpg,.jpeg,.png,.webp">

    <small style="color:#64748b;">
        Kosongkan jika tidak ingin mengganti gambar
    </small>
</div>



<!-- ACTION -->

<div style="margin-top:30px; display:flex; gap:12px;">

    <button type="submit" name="update" class="btn-primary">
        Update Artikel
    </button>

    <a href="artikel.php" class="btn-secondary">
        Batal
    </a>

</div>


</form>

</div>
</div>

</body>
</html>

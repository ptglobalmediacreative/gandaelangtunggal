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

/* ================= CONFIG ================= */

$upload_path = "../images/uploads/artikel/";
$allowed_ext = ['jpg','jpeg','png','webp'];

if(!is_dir($upload_path)){
    mkdir($upload_path, 0777, true);
}


/* ================= IMAGE RESIZE + COMPRESS ================= */

function resizeCompressImage($tmp, $name, $path){

    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    // Load image
    if($ext == 'jpg' || $ext == 'jpeg'){
        $src = imagecreatefromjpeg($tmp);
    }elseif($ext == 'png'){
        $src = imagecreatefrompng($tmp);
    }elseif($ext == 'webp'){
        $src = imagecreatefromwebp($tmp);
    }else{
        return null;
    }

    if(!$src) return null;

    // Original size
    $w = imagesx($src);
    $h = imagesy($src);

    // Max width
    $max = 1200;

    if($w > $max){
        $nw = $max;
        $nh = ($h / $w) * $nw;
    }else{
        $nw = $w;
        $nh = $h;
    }

    // Create new image
    $new = imagecreatetruecolor($nw, $nh);

    // For PNG transparent
    if($ext == 'png'){
        imagealphablending($new,false);
        imagesavealpha($new,true);
    }

    imagecopyresampled($new, $src, 0,0,0,0, $nw,$nh, $w,$h);

    // File name
    $file = time().rand(100,999).".jpg";
    $target = $path.$file;

    // Compress (loop until <100KB)
    $quality = 85;

    do{
        imagejpeg($new, $target, $quality);
        $size = filesize($target);
        $quality -= 5;
    }while($size > 100000 && $quality > 30);

    imagedestroy($src);
    imagedestroy($new);

    return $file;
}



/* ================= SAVE ================= */

if(isset($_POST['simpan'])){

    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    $gambar = null;


    /* UPLOAD IMAGE */

    if(!empty($_FILES['gambar']['name'])){

        $gambar = resizeCompressImage(
            $_FILES['gambar']['tmp_name'],
            $_FILES['gambar']['name'],
            $upload_path
        );
    }


    /* INSERT */

    $stmt = $pdo->prepare("
        INSERT INTO artikel
        (judul, deskripsi, gambar, created_at)
        VALUES (?,?,?,NOW())
    ");

    $stmt->execute([
        $judul,
        $deskripsi,
        $gambar
    ]);


    header("Location: artikel.php?status=sukses");
    exit;
}

?>


<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>


<div class="main-content">


<div class="topbar">
    <h2>Tambah Artikel</h2>
</div>


<div class="card">


<form method="POST" enctype="multipart/form-data">


<!-- JUDUL -->

<div class="form-group">
    <label>Judul Artikel</label>
    <input type="text" name="judul" required>
</div>


<!-- DESKRIPSI -->

<div class="form-group">
    <label>Deskripsi</label>
    <textarea name="deskripsi" required></textarea>
</div>


<!-- GAMBAR -->

<div class="form-group">
    <label>Gambar</label>
    <input type="file"
           name="gambar"
           accept=".jpg,.jpeg,.png,.webp"
           required>
    <small style="color:#64748b">
        Otomatis dikompres & resize &lt; 100KB
    </small>
</div>


<!-- ACTION -->

<div style="margin-top:30px">

<button type="submit" name="simpan" class="btn-primary">
    Simpan
</button>

<a href="artikel.php" class="btn-secondary">
    Kembali
</a>

</div>


</form>


</div>
</div>


</body>
</html>

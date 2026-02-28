<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

date_default_timezone_set('Asia/Jakarta');

session_start();
require_once __DIR__ . "/config.php";
require_once "auth.php";

/* ================= LOGIN ================= */
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

/* ================= CONFIG ================= */
$upload_path = "../images/uploads/artikel/";
$allowed_ext = ['jpg','jpeg','png','webp'];

if (!is_dir($upload_path)) {
    mkdir($upload_path, 0777, true);
}

/* ================= SLUG GENERATOR ================= */
function generateSlug($text) {
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', $text);
    $text = trim($text, '-');
    return $text;
}

/* ================= CEK SLUG DUPLIKAT ================= */
function makeUniqueSlug($pdo, $slug) {
    $original = $slug;
    $i = 1;

    while (true) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM artikel WHERE slug=?");
        $stmt->execute([$slug]);
        if ($stmt->fetchColumn() == 0) {
            return $slug;
        }
        $slug = $original . '-' . $i;
        $i++;
    }
}

/* ================= IMAGE RESIZE + COMPRESS ================= */
function resizeCompressImage($tmp, $name, $path) {

    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    if (!in_array($ext, ['jpg','jpeg','png','webp'])) {
        return null;
    }

    if ($ext == 'jpg' || $ext == 'jpeg') {
        $src = imagecreatefromjpeg($tmp);
    } elseif ($ext == 'png') {
        $src = imagecreatefrompng($tmp);
    } elseif ($ext == 'webp') {
        $src = imagecreatefromwebp($tmp);
    } else {
        return null;
    }

    if (!$src) return null;

    $w = imagesx($src);
    $h = imagesy($src);

    $max = 1200;

    if ($w > $max) {
        $nw = $max;
        $nh = ($h / $w) * $nw;
    } else {
        $nw = $w;
        $nh = $h;
    }

    $new = imagecreatetruecolor($nw, $nh);

    if ($ext == 'png') {
        imagealphablending($new, false);
        imagesavealpha($new, true);
    }

    imagecopyresampled($new, $src, 0,0,0,0, $nw,$nh, $w,$h);

    $file = time() . rand(100,999) . ".jpg";
    $target = $path . $file;

    $quality = 85;

    do {
        imagejpeg($new, $target, $quality);
        $size = filesize($target);
        $quality -= 5;
    } while ($size > 100000 && $quality > 30);

    imagedestroy($src);
    imagedestroy($new);

    return $file;
}

/* ================= SAVE ================= */
if (isset($_POST['simpan'])) {

    $judul = trim($_POST['judul']);
    $deskripsi = trim($_POST['deskripsi']);

    if (empty($judul) || empty($deskripsi)) {
        die("Judul dan Deskripsi wajib diisi.");
    }

    /* Generate Slug */
    $slug = generateSlug($judul);
    $slug = makeUniqueSlug($pdo, $slug);

    $gambar = null;

    /* Upload Image */
    if (!empty($_FILES['gambar']['name'])) {

        $ext = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed_ext)) {
            die("Format gambar tidak diizinkan.");
        }

        $gambar = resizeCompressImage(
            $_FILES['gambar']['tmp_name'],
            $_FILES['gambar']['name'],
            $upload_path
        );
    }

    /* Insert Database */
    $stmt = $pdo->prepare("
        INSERT INTO artikel
        (judul, slug, deskripsi, gambar, created_at, updated_at)
        VALUES (?, ?, ?, ?, NOW(), NOW())
    ");

    $stmt->execute([
        $judul,
        $slug,
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

<div class="form-group">
    <label>Judul Artikel</label>
    <input type="text" name="judul" required>
</div>

<div class="form-group">
    <label>Deskripsi</label>
    <textarea name="deskripsi" required></textarea>
</div>

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
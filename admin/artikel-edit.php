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

/* ================= VALIDASI ID ================= */
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: artikel.php");
    exit;
}

$id = (int) $_GET['id'];

/* ================= CONFIG ================= */
$upload_path = realpath(__DIR__ . "/../images/uploads/artikel/") . DIRECTORY_SEPARATOR;

if (!$upload_path) {
    mkdir(__DIR__ . "/../images/uploads/artikel/", 0777, true);
    $upload_path = realpath(__DIR__ . "/../images/uploads/artikel/") . DIRECTORY_SEPARATOR;
}

$allowed_ext = ['jpg','jpeg','png','webp'];

/* ================= SLUG GENERATOR ================= */
function generateSlug($text) {
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', $text);
    $text = trim($text, '-');
    return $text;
}

function makeUniqueSlug($pdo, $slug, $id) {
    $original = $slug;
    $i = 1;

    while (true) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM artikel WHERE slug=? AND id!=?");
        $stmt->execute([$slug, $id]);

        if ($stmt->fetchColumn() == 0) {
            return $slug;
        }

        $slug = $original . '-' . $i;
        $i++;
    }
}

/* ================= UPLOAD IMAGE ================= */
function uploadImage($tmp, $name, $path, $allowed_ext) {

    if (empty($tmp)) return null;

    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed_ext)) {
        return null;
    }

    $newName = time() . rand(100,999) . ".jpg";
    $dest = $path . $newName;

    $info = getimagesize($tmp);
    if (!$info) return null;

    if ($info['mime'] == 'image/jpeg') {
        $image = imagecreatefromjpeg($tmp);
    } elseif ($info['mime'] == 'image/png') {
        $image = imagecreatefrompng($tmp);
    } elseif ($info['mime'] == 'image/webp') {
        $image = imagecreatefromwebp($tmp);
    } else {
        return null;
    }

    imagejpeg($image, $dest, 80);
    imagedestroy($image);

    return $newName;
}

/* ================= LOAD DATA ================= */
$stmt = $pdo->prepare("SELECT * FROM artikel WHERE id=? LIMIT 1");
$stmt->execute([$id]);
$artikel = $stmt->fetch();

if (!$artikel) {
    header("Location: artikel.php");
    exit;
}

/* ================= UPDATE ================= */
if (isset($_POST['update'])) {

    $judul = trim($_POST['judul']);
    $deskripsi = trim($_POST['deskripsi']);

    if (empty($judul) || empty($deskripsi)) {
        die("Judul dan Deskripsi wajib diisi.");
    }

    /* Generate slug baru */
    $slug = generateSlug($judul);
    $slug = makeUniqueSlug($pdo, $slug, $id);

    $old_img = $artikel['gambar'];
    $gambar = $old_img;

    /* Upload gambar baru */
    if (!empty($_FILES['gambar']['name'])) {

        $newImage = uploadImage(
            $_FILES['gambar']['tmp_name'],
            $_FILES['gambar']['name'],
            $upload_path,
            $allowed_ext
        );

        if ($newImage) {

            // hapus gambar lama
            if (!empty($old_img)) {
                $safeOld = basename($old_img);
                $oldPath = $upload_path . $safeOld;
                if (file_exists($oldPath) && is_file($oldPath)) {
                    unlink($oldPath);
                }
            }

            $gambar = $newImage;
        }
    }

    /* Update Database */
    $update = $pdo->prepare("
        UPDATE artikel SET
        judul=?,
        slug=?,
        deskripsi=?,
        gambar=?,
        updated_at=NOW()
        WHERE id=?
    ");

    $update->execute([
        $judul,
        $slug,
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

<div class="topbar">
    <h2>Edit Artikel</h2>
    <a href="artikel.php" class="btn-secondary">Kembali</a>
</div>

<div class="card">

<form method="POST" enctype="multipart/form-data">

<div class="form-group">
    <label>Judul Artikel</label>
    <input type="text"
           name="judul"
           value="<?= htmlspecialchars($artikel['judul']); ?>"
           required>
</div>

<div class="form-group">
    <label>Deskripsi</label>
    <textarea name="deskripsi"
              required><?= htmlspecialchars($artikel['deskripsi']); ?></textarea>
</div>

<div class="form-group">
    <label>Gambar Artikel</label><br>

    <?php if (!empty($artikel['gambar'])): ?>
        <img src="../images/uploads/artikel/<?= htmlspecialchars($artikel['gambar']); ?>"
             style="max-width:200px; margin-bottom:12px;"><br>
    <?php endif; ?>

    <input type="file"
           name="gambar"
           accept=".jpg,.jpeg,.png,.webp">

    <small style="color:#64748b;">
        Kosongkan jika tidak ingin mengganti gambar
    </small>
</div>

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
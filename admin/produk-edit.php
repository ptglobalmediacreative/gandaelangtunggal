<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . "/config.php";

/* ================= LOGIN ================= */

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

/* ================= ID ================= */

if (!isset($_GET['id'])) {
    header("Location: produk.php");
    exit;
}

$id = (int) $_GET['id'];


/* ================= CONFIG ================= */

$upload_path = "../images/uploads/produk/";
$allowed_ext = ['jpg','jpeg','png','webp'];

if(!is_dir($upload_path)){
    mkdir($upload_path,0777,true);
}


/* ================= FUNCTION ================= */

function buat_slug($text){
    return trim(
        preg_replace('/[^a-z0-9]+/','-', strtolower($text)),
        '-'
    );
}


/* Upload tanpa duplikat */
function uploadUniqueImage($tmp, $name, $path, $allowed){

    if(empty($tmp)) return null;

    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    if(!in_array($ext, $allowed)) return null;

    $hash = md5_file($tmp);

    foreach(glob($path."*") as $file){

        if(is_file($file) && md5_file($file) === $hash){
            return basename($file);
        }
    }

    $new = time().rand(100,999).".".$ext;

    move_uploaded_file($tmp, $path.$new);

    return $new;
}


/* Auto delete file jika tidak dipakai */
function deleteImageIfUnused($pdo,$file,$path){

    if(empty($file)) return;

    $q1 = $pdo->prepare("SELECT COUNT(*) FROM produk WHERE gambar=?");
    $q1->execute([$file]);

    $q2 = $pdo->prepare("SELECT COUNT(*) FROM produk_features WHERE image=?");
    $q2->execute([$file]);

    $q3 = $pdo->prepare("SELECT COUNT(*) FROM produk_gallery WHERE image=?");
    $q3->execute([$file]);

    if(
        $q1->fetchColumn()==0 &&
        $q2->fetchColumn()==0 &&
        $q3->fetchColumn()==0
    ){
        $f = $path.$file;

        if(file_exists($f)){
            unlink($f);
        }
    }
}


/* ================= LOAD DATA ================= */

/* Produk */
$p = $pdo->prepare("SELECT * FROM produk WHERE id=?");
$p->execute([$id]);
$produk = $p->fetch();

if(!$produk){
    header("Location: produk.php");
    exit;
}

/* Kategori */
$cat = $pdo->query("SELECT * FROM categories ORDER BY name ASC")->fetchAll();

/* Features */
$fq = $pdo->prepare("SELECT * FROM produk_features WHERE produk_id=? ORDER BY sort_order");
$fq->execute([$id]);
$features = $fq->fetchAll();

/* Spec */
$sq = $pdo->prepare("SELECT * FROM produk_spesifikasi WHERE produk_id=? ORDER BY grup,sort_order");
$sq->execute([$id]);
$specs = $sq->fetchAll();

$grouped = [];
foreach($specs as $s){
    $grouped[$s['grup']][] = $s;
}

/* Gallery */
$gq = $pdo->prepare("SELECT * FROM produk_gallery WHERE produk_id=? ORDER BY sort_order");
$gq->execute([$id]);
$gallery = $gq->fetchAll();



/* ================= UPDATE ================= */

if(isset($_POST['update'])){

    $nama     = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $slug     = buat_slug($nama);


    /* ===== THUMBNAIL ===== */

    $old_thumb = $produk['gambar'];
    $gambar = $old_thumb;

    if(!empty($_FILES['gambar_produk']['name'])){

        $new = uploadUniqueImage(
            $_FILES['gambar_produk']['tmp_name'],
            $_FILES['gambar_produk']['name'],
            $upload_path,
            $allowed_ext
        );

        if($new){

            $gambar = $new;

            deleteImageIfUnused($pdo,$old_thumb,$upload_path);
        }
    }


    /* ===== UPDATE PRODUK ===== */

    $pdo->prepare("
        UPDATE produk SET
        category_id=?,
        nama_produk=?,
        slug=?,
        gambar=?
        WHERE id=?
    ")->execute([
        $kategori,
        $nama,
        $slug,
        $gambar,
        $id
    ]);



    /* ===== AMBIL GAMBAR LAMA ===== */

    $oldFeatures = $pdo->prepare("SELECT image FROM produk_features WHERE produk_id=?");
    $oldFeatures->execute([$id]);
    $oldF = $oldFeatures->fetchAll(PDO::FETCH_COLUMN);

    $oldGallery = $pdo->prepare("SELECT image FROM produk_gallery WHERE produk_id=?");
    $oldGallery->execute([$id]);
    $oldG = $oldGallery->fetchAll(PDO::FETCH_COLUMN);



    /* ===== RESET ===== */

    $pdo->prepare("DELETE FROM produk_features WHERE produk_id=?")->execute([$id]);
    $pdo->prepare("DELETE FROM produk_spesifikasi WHERE produk_id=?")->execute([$id]);
    $pdo->prepare("DELETE FROM produk_gallery WHERE produk_id=?")->execute([$id]);



    /* ===== FEATURES ===== */

    if(!empty($_POST['feature_title'])){

        foreach($_POST['feature_title'] as $i=>$t){

            if(empty($t)) continue;

            $desc = $_POST['feature_desc'][$i];
            $img  = null;

            if(!empty($_FILES['feature_image']['name'][$i])){

                $img = uploadUniqueImage(
                    $_FILES['feature_image']['tmp_name'][$i],
                    $_FILES['feature_image']['name'][$i],
                    $upload_path,
                    $allowed_ext
                );
            }

            $pdo->prepare("
                INSERT INTO produk_features
                (produk_id,grup,title,description,image,sort_order)
                VALUES (?,?,?,?,?,?)
            ")->execute([
                $id,'FEATURE',$t,$desc,$img,$i
            ]);
        }
    }



    /* ===== SPEC ===== */

    if(!empty($_POST['spec_group'])){

        foreach($_POST['spec_group'] as $g=>$grup){

            if(empty($grup)) continue;

            foreach($_POST['spec_label'][$g] as $i=>$l){

                if(empty($l)) continue;

                $v = $_POST['spec_value'][$g][$i];

                $pdo->prepare("
                    INSERT INTO produk_spesifikasi
                    (produk_id,grup,label,nilai,sort_order)
                    VALUES (?,?,?,?,?)
                ")->execute([
                    $id,$grup,$l,$v,$i
                ]);
            }
        }
    }



    /* ===== GALLERY ===== */

    if(!empty($_FILES['gallery']['name'][0])){

        foreach($_FILES['gallery']['name'] as $i=>$n){

            if(empty($n)) continue;

            $new = uploadUniqueImage(
                $_FILES['gallery']['tmp_name'][$i],
                $n,
                $upload_path,
                $allowed_ext
            );

            if($new){

                $pdo->prepare("
                    INSERT INTO produk_gallery
                    (produk_id,image,sort_order)
                    VALUES (?,?,?)
                ")->execute([
                    $id,$new,$i
                ]);
            }
        }
    }



    /* ===== HAPUS FILE LAMA ===== */

    foreach($oldF as $f){
        deleteImageIfUnused($pdo,$f,$upload_path);
    }

    foreach($oldG as $g){
        deleteImageIfUnused($pdo,$g,$upload_path);
    }



    header("Location: produk.php?status=updated");
    exit;
}
?>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<div class="main-content">

<div class="topbar">
<h2>Edit Produk</h2>
</div>

<div class="card">

<form method="POST" enctype="multipart/form-data">

<div class="form-group">
<label>Nama Produk</label>
<input type="text" name="nama"
value="<?= htmlspecialchars($produk['nama_produk']); ?>" required>
</div>


<div class="form-group">
<label>Kategori</label>

<select name="kategori">

<?php foreach($cat as $c): ?>

<option value="<?= $c['id']; ?>"
<?= $produk['category_id']==$c['id']?'selected':'' ?>>
<?= $c['name']; ?>
</option>

<?php endforeach; ?>

</select>
</div>


<div class="form-group">
<label>Thumbnail</label><br>

<?php if($produk['gambar']): ?>
<img src="<?= $upload_path.$produk['gambar']; ?>" width="100"><br><br>
<?php endif; ?>

<input type="file" name="gambar_produk" accept=".jpg,.jpeg,.png,.webp">
</div>


<h3>Gallery</h3>

<div class="form-group">

<?php if($gallery): ?>

<div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:10px;">

<?php foreach($gallery as $g): ?>

<img src="<?= $upload_path.$g['image']; ?>" width="70">

<?php endforeach; ?>

</div>

<?php endif; ?>

<input type="file" name="gallery[]" multiple accept=".jpg,.jpeg,.png,.webp">
</div>


<div style="margin-top:30px;">

<button type="submit" name="update" class="btn-primary">
Update
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

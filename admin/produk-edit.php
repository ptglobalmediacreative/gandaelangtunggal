<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__."/config.php";

/* CEK LOGIN */
if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}

/* CEK ID */
if(!isset($_GET['id'])){
    header("Location: produk.php");
    exit;
}

$id = (int)$_GET['id'];


/* FOLDER UPLOAD */
$upload_path = "../images/uploads/produk/";

if(!is_dir($upload_path)){
    mkdir($upload_path,0777,true);
}

/* FORMAT */
$allowed_ext = ['jpg','jpeg','png','webp'];


/* ================= AMBIL DATA ================= */

/* Produk */
$stmt = $pdo->prepare("SELECT * FROM produk WHERE id=?");
$stmt->execute([$id]);
$produk = $stmt->fetch();

if(!$produk){
    header("Location: produk.php");
    exit;
}

/* Kategori */
$cat = $pdo->query("SELECT * FROM categories ORDER BY name ASC")->fetchAll();

/* Features */
$features = $pdo->prepare("
    SELECT * FROM produk_features 
    WHERE produk_id=? 
    ORDER BY sort_order
");
$features->execute([$id]);
$features = $features->fetchAll();

/* Spec */
$spec = $pdo->prepare("
    SELECT * FROM produk_spesifikasi
    WHERE produk_id=?
    ORDER BY grup, sort_order
");
$spec->execute([$id]);
$spec = $spec->fetchAll();

/* Group Spec */
$spec_group = [];

foreach($spec as $s){
    $spec_group[$s['grup']][] = $s;
}

/* Gallery */
$gallery = $pdo->prepare("
    SELECT * FROM produk_gallery
    WHERE produk_id=?
    ORDER BY sort_order
");
$gallery->execute([$id]);
$gallery = $gallery->fetchAll();



/* ================= UPDATE ================= */

if(isset($_POST['update'])){

    $nama     = $_POST['nama'];
    $kategori = $_POST['kategori'];


    /* ========== THUMBNAIL ========== */

    $gambar = $produk['gambar'];

    if(!empty($_FILES['gambar_produk']['name'])){

        $ext = strtolower(pathinfo($_FILES['gambar_produk']['name'],PATHINFO_EXTENSION));

        if(in_array($ext,$allowed_ext)){

            if($gambar && file_exists($upload_path.$gambar)){
                unlink($upload_path.$gambar);
            }

            $new = time().rand(100,999).".".$ext;

            move_uploaded_file(
                $_FILES['gambar_produk']['tmp_name'],
                $upload_path.$new
            );

            $gambar = $new;
        }
    }


    /* UPDATE PRODUK */

    $pdo->prepare("
        UPDATE produk SET
        category_id=?,
        nama_produk=?,
        gambar=?
        WHERE id=?
    ")->execute([
        $kategori,
        $nama,
        $gambar,
        $id
    ]);


    /* ========== HAPUS DATA LAMA ========== */

    $pdo->prepare("DELETE FROM produk_features WHERE produk_id=?")->execute([$id]);
    $pdo->prepare("DELETE FROM produk_spesifikasi WHERE produk_id=?")->execute([$id]);


    /* ========== FEATURES ========== */

    if(!empty($_POST['feature_title'])){

        foreach($_POST['feature_title'] as $i=>$title){

            if(empty($title)) continue;

            $desc = $_POST['feature_desc'][$i];
            $img  = null;

            if(!empty($_FILES['feature_image']['name'][$i])){

                $ext = strtolower(pathinfo($_FILES['feature_image']['name'][$i],PATHINFO_EXTENSION));

                if(in_array($ext,$allowed_ext)){

                    $new = time().$i.rand(10,99).".".$ext;

                    move_uploaded_file(
                        $_FILES['feature_image']['tmp_name'][$i],
                        $upload_path.$new
                    );

                    $img = $new;
                }
            }

            $pdo->prepare("
                INSERT INTO produk_features
                (produk_id,grup,title,description,image,sort_order)
                VALUES (?,?,?,?,?,?)
            ")->execute([
                $id,'FEATURE',$title,$desc,$img,$i
            ]);
        }
    }


    /* ========== SPEC ========== */

    if(!empty($_POST['spec_group'])){

        foreach($_POST['spec_group'] as $g=>$group){

            if(empty($group)) continue;

            if(empty($_POST['spec_label'][$g])) continue;

            foreach($_POST['spec_label'][$g] as $i=>$label){

                if(empty($label)) continue;

                $value = $_POST['spec_value'][$g][$i];

                $pdo->prepare("
                    INSERT INTO produk_spesifikasi
                    (produk_id,grup,label,nilai,sort_order)
                    VALUES (?,?,?,?,?)
                ")->execute([
                    $id,$group,$label,$value,$i
                ]);
            }
        }
    }


    /* ========== GALLERY ========== */

    if(!empty($_FILES['gallery']['name'][0])){

        foreach($_FILES['gallery']['name'] as $i=>$name){

            if(empty($name)) continue;

            $ext = strtolower(pathinfo($name,PATHINFO_EXTENSION));

            if(!in_array($ext,$allowed_ext)) continue;

            $new = time().$i.rand(100,999).".".$ext;

            move_uploaded_file(
                $_FILES['gallery']['tmp_name'][$i],
                $upload_path.$new
            );

            $pdo->prepare("
                INSERT INTO produk_gallery
                (produk_id,image,sort_order)
                VALUES (?,?,?)
            ")->execute([
                $id,$new,$i
            ]);
        }
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


<!-- BASIC -->

<div class="form-group">
<label>Nama Produk</label>
<input type="text" name="nama" value="<?= $produk['nama_produk']; ?>" required>
</div>


<div class="form-group">
<label>Kategori</label>

<select name="kategori" required>

<?php foreach($cat as $c): ?>

<option value="<?= $c['id']; ?>"
<?= $produk['category_id']==$c['id']?'selected':'' ?>>

<?= $c['name']; ?>

</option>

<?php endforeach; ?>

</select>
</div>


<div class="form-group">
<label>Gambar Utama</label>

<?php if($produk['gambar']): ?>
<img src="../images/uploads/produk/<?= $produk['gambar']; ?>"
width="120" style="margin-bottom:10px;">
<?php endif; ?>

<input type="file" name="gambar_produk">
</div>



<!-- GALLERY -->

<h3>Gallery</h3>

<div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:15px;">

<?php foreach($gallery as $g): ?>

<img src="../images/uploads/produk/<?= $g['image']; ?>"
width="100" style="border-radius:8px;">

<?php endforeach; ?>

</div>


<input type="file" name="gallery[]" multiple>



<!-- ACTION -->

<div style="margin-top:25px;">

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

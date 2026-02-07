<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . "/config.php";

/* CEK LOGIN */
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

/* FORMAT GAMBAR BOLEH */
$allowed_ext = ['jpg','jpeg','png','webp'];


/* ================= AMBIL ID ================= */

if(!isset($_GET['id'])){
    header("Location: produk.php");
    exit;
}

$id = intval($_GET['id']);


/* ================= AMBIL PRODUK ================= */

$stmt = $pdo->prepare("SELECT * FROM produk WHERE id=?");
$stmt->execute([$id]);
$produk = $stmt->fetch();

if(!$produk){
    header("Location: produk.php");
    exit;
}


/* ================= KATEGORI ================= */

$cat = $pdo->query("SELECT * FROM categories ORDER BY name ASC")->fetchAll();


/* ================= FEATURES ================= */

$features = $pdo->prepare("
    SELECT * FROM produk_features
    WHERE produk_id=?
    ORDER BY sort_order ASC
");
$features->execute([$id]);
$features = $features->fetchAll();


/* ================= SPEC ================= */

$spec = $pdo->prepare("
    SELECT * FROM produk_spesifikasi
    WHERE produk_id=?
    ORDER BY grup, sort_order ASC
");
$spec->execute([$id]);
$spec = $spec->fetchAll();


/* GROUPING SPEC */
$spec_data = [];

foreach($spec as $s){
    $spec_data[$s['grup']][] = $s;
}



/* ================= UPDATE ================= */

if(isset($_POST['simpan'])){

    $nama     = $_POST['nama'];
    $kategori = $_POST['kategori'];


    /* ================= THUMBNAIL ================= */

    $gambar = $produk['gambar'];

    if(!empty($_FILES['gambar_produk']['name'])){

        $ext = strtolower(pathinfo($_FILES['gambar_produk']['name'], PATHINFO_EXTENSION));

        if(in_array($ext, $allowed_ext)){

            $new = time().rand(100,999).".".$ext;

            move_uploaded_file(
                $_FILES['gambar_produk']['tmp_name'],
                "../upload/produk/".$new
            );

            // hapus lama
            if($gambar && file_exists("../upload/produk/".$gambar)){
                unlink("../upload/produk/".$gambar);
            }

            $gambar = $new;
        }
    }


    /* ================= UPDATE PRODUK ================= */

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



    /* ================= RESET FEATURES ================= */

    $pdo->prepare("DELETE FROM produk_features WHERE produk_id=?")
        ->execute([$id]);



    if(!empty($_POST['feature_title'])){

        foreach($_POST['feature_title'] as $i => $title){

            if(empty($title)) continue;

            $desc = $_POST['feature_desc'][$i];

            $img = null;

            if(!empty($_FILES['feature_image']['name'][$i])){

                $ext = strtolower(pathinfo($_FILES['feature_image']['name'][$i], PATHINFO_EXTENSION));

                if(in_array($ext, $allowed_ext)){

                    $new = time().$i.rand(10,99).".".$ext;

                    move_uploaded_file(
                        $_FILES['feature_image']['tmp_name'][$i],
                        "../upload/features/".$new
                    );

                    $img = $new;
                }
            }

            $pdo->prepare("
                INSERT INTO produk_features
                (produk_id, grup, title, description, image, sort_order)
                VALUES (?,?,?,?,?,?)
            ")->execute([
                $id,
                'FEATURE',
                $title,
                $desc,
                $img,
                $i
            ]);
        }
    }



    /* ================= RESET SPEC ================= */

    $pdo->prepare("DELETE FROM produk_spesifikasi WHERE produk_id=?")
        ->execute([$id]);


    if(!empty($_POST['spec_group'])){

        foreach($_POST['spec_group'] as $g => $group){

            if(empty($group)) continue;

            if(empty($_POST['spec_label'][$g])) continue;

            foreach($_POST['spec_label'][$g] as $i => $label){

                if(empty($label)) continue;

                $value = $_POST['spec_value'][$g][$i];

                $pdo->prepare("
                    INSERT INTO produk_spesifikasi
                    (produk_id, grup, label, nilai, sort_order)
                    VALUES (?,?,?,?,?)
                ")->execute([
                    $id,
                    $group,
                    $label,
                    $value,
                    $i
                ]);
            }
        }
    }


    header("Location: produk.php?status=update");
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
<?= $produk['category_id']==$c['id']?'selected':''; ?>>

<?= $c['name']; ?>

</option>

<?php endforeach; ?>

</select>
</div>


<div class="form-group">
<label>Gambar Utama</label>

<input type="file"
       name="gambar_produk"
       accept=".jpg,.jpeg,.png,.webp,image/*">

<?php if($produk['gambar']): ?>
<br><br>
<img src="../upload/produk/<?= $produk['gambar']; ?>"
     width="150">
<?php endif; ?>
</div>



<!-- FEATURES -->

<h3>Features</h3>

<div id="feature-wrapper">


<?php foreach($features as $f): ?>

<div class="feature-row">

<input type="text"
       name="feature_title[]"
       value="<?= $f['title']; ?>">

<textarea name="feature_desc[]"><?= $f['description']; ?></textarea>

<input type="file"
       name="feature_image[]"
       accept=".jpg,.jpeg,.png,.webp,image/*">

<button type="button"
        onclick="removeFeature(this)"
        class="btn-remove">✕</button>

</div>

<?php endforeach; ?>


</div>


<button type="button" onclick="addFeature()" class="btn-add">
+ Tambah Feature
</button>



<!-- SPEC -->

<h3>Specifications</h3>

<div id="spec-wrapper">

<?php $i=0; foreach($spec_data as $group=>$items): ?>

<div class="spec-group">

<div class="spec-header">

<input type="text"
       name="spec_group[]"
       value="<?= $group; ?>"
       class="spec-title">

<button type="button"
        onclick="removeSpecGroup(this)"
        class="btn-remove">✕</button>

</div>


<div class="spec-items">


<?php foreach($items as $s): ?>

<div class="spec-row">

<input type="text"
       name="spec_label[<?= $i; ?>][]"
       value="<?= $s['label']; ?>">

<input type="text"
       name="spec_value[<?= $i; ?>][]"
       value="<?= $s['nilai']; ?>">

<button type="button"
        onclick="removeSpec(this)"
        class="btn-remove">✕</button>

</div>

<?php endforeach; ?>

</div>


<button type="button"
        onclick="addSpecRow(this,<?= $i; ?>)"
        class="btn-add-small">
+ Parameter
</button>

</div>

<?php $i++; endforeach; ?>


</div>


<button type="button" onclick="addSpecGroup()" class="btn-add">
+ Tambah Group
</button>



<!-- ACTION -->

<div style="margin-top:30px;">

<button type="submit" name="simpan" class="btn-primary">
Update
</button>

<a href="produk.php" class="btn-secondary">
Kembali
</a>

</div>


</form>

</div>

</div>



<script>

let specIndex = <?= $i ?? 1 ?>;


/* FEATURE */

function addFeature(){

let div = document.createElement("div");
div.className="feature-row";

div.innerHTML=`
<input type="text" name="feature_title[]">

<textarea name="feature_desc[]"></textarea>

<input type="file" name="feature_image[]" accept=".jpg,.jpeg,.png,.webp,image/*">

<button type="button" onclick="removeFeature(this)" class="btn-remove">✕</button>
`;

document.getElementById("feature-wrapper").appendChild(div);
}

function removeFeature(btn){
btn.parentElement.remove();
}


/* SPEC */

function addSpecGroup(){

let div=document.createElement("div");
div.className="spec-group";

div.innerHTML=`
<div class="spec-header">

<input type="text" name="spec_group[]" class="spec-title">

<button type="button" onclick="removeSpecGroup(this)" class="btn-remove">✕</button>

</div>

<div class="spec-items">

<div class="spec-row">

<input type="text" name="spec_label[${specIndex}][]">

<input type="text" name="spec_value[${specIndex}][]">

<button type="button" onclick="removeSpec(this)" class="btn-remove">✕</button>

</div>

</div>

<button type="button" onclick="addSpecRow(this,${specIndex})" class="btn-add-small">
+ Parameter
</button>
`;

document.getElementById("spec-wrapper").appendChild(div);

specIndex++;
}


function addSpecRow(btn,index){

let row=document.createElement("div");
row.className="spec-row";

row.innerHTML=`
<input type="text" name="spec_label[${index}][]">

<input type="text" name="spec_value[${index}][]">

<button type="button" onclick="removeSpec(this)" class="btn-remove">✕</button>
`;

btn.previousElementSibling.appendChild(row);
}


function removeSpec(btn){
btn.parentElement.remove();
}


function removeSpecGroup(btn){

if(!confirm("Hapus group ini?")) return;

btn.closest(".spec-group").remove();
}

</script>


</body>
</html>

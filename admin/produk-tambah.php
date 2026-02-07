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

/* AMBIL KATEGORI */
$cat = $pdo->query("SELECT * FROM categories ORDER BY name ASC")->fetchAll();

/* SLUG */
function buat_slug($text){
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

/* FORMAT GAMBAR */
$allowed_ext = ['jpg','jpeg','png','webp'];

/* FOLDER UPLOAD */
$upload_path = "../images/uploads/produk/";

if(!is_dir($upload_path)){
    mkdir($upload_path, 0777, true);
}


/* ================= UPLOAD TANPA DUPLIKAT ================= */

function uploadUniqueImage($tmp, $name, $path, $allowed){

    if(empty($tmp) || empty($name)) return null;

    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    if(!in_array($ext, $allowed)){
        return null;
    }

    // Hash file
    $hash = md5_file($tmp);

    // Cek file existing
    foreach(glob($path."*") as $file){

        if(is_file($file) && md5_file($file) === $hash){
            return basename($file);
        }
    }

    // Upload baru
    $new = time().rand(100,999).".".$ext;

    move_uploaded_file($tmp, $path.$new);

    return $new;
}



/* ================= SIMPAN ================= */

if(isset($_POST['simpan'])){

    $nama     = $_POST['nama'];
    $kategori = $_POST['kategori'];

    $slug = buat_slug($nama);



    /* ================= THUMBNAIL ================= */

    $gambar_produk = null;

    if(!empty($_FILES['gambar_produk']['name'])){

        $gambar_produk = uploadUniqueImage(
            $_FILES['gambar_produk']['tmp_name'],
            $_FILES['gambar_produk']['name'],
            $upload_path,
            $allowed_ext
        );
    }



    /* ================= SIMPAN PRODUK ================= */

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



    /* ================= FEATURES ================= */

    if(!empty($_POST['feature_title'])){

        foreach($_POST['feature_title'] as $i => $title){

            if(empty($title)) continue;

            $desc = $_POST['feature_desc'][$i];

            $img = null;

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
                (produk_id, grup, title, description, image, sort_order)
                VALUES (?,?,?,?,?,?)
            ")->execute([
                $produk_id,
                'FEATURE',
                $title,
                $desc,
                $img,
                $i
            ]);
        }
    }



    /* ================= SPEC ================= */

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
                    $produk_id,
                    $group,
                    $label,
                    $value,
                    $i
                ]);
            }
        }
    }



    /* ================= GALLERY ================= */

    if(!empty($_FILES['gallery']['name'][0])){

        foreach($_FILES['gallery']['name'] as $i => $name){

            if(empty($name)) continue;

            $new = uploadUniqueImage(
                $_FILES['gallery']['tmp_name'][$i],
                $name,
                $upload_path,
                $allowed_ext
            );

            if($new){

                $pdo->prepare("
                    INSERT INTO produk_gallery
                    (produk_id, image, sort_order)
                    VALUES (?,?,?)
                ")->execute([
                    $produk_id,
                    $new,
                    $i
                ]);
            }
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


<!-- BASIC -->

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
    <label>Gambar Utama</label>

    <input type="file"
           name="gambar_produk"
           accept=".jpg,.jpeg,.png,.webp">
</div>



<!-- GALLERY -->

<h3 style="margin-top:25px;">Gallery</h3>

<div class="form-group">

    <input type="file"
           name="gallery[]"
           multiple
           accept=".jpg,.jpeg,.png,.webp">

</div>



<!-- FEATURES -->

<h3 style="margin-top:25px;">Features</h3>

<div id="feature-wrapper">


<div class="feature-row">

    <input type="text" name="feature_title[]" placeholder="Judul Feature">

    <textarea name="feature_desc[]" placeholder="Deskripsi Feature"></textarea>

    <input type="file"
           name="feature_image[]"
           accept=".jpg,.jpeg,.png,.webp">

    <button type="button" onclick="removeFeature(this)" class="btn-remove">✕</button>

</div>


</div>


<button type="button" onclick="addFeature()" class="btn-add">
+ Tambah Feature
</button>



<!-- SPEC -->

<h3 style="margin-top:30px;">Specifications</h3>


<div id="spec-wrapper">


<div class="spec-group">

<div class="spec-header">

<input type="text"
       name="spec_group[]"
       placeholder="Nama Group"
       class="spec-title">

<button type="button"
        onclick="removeSpecGroup(this)"
        class="btn-remove">✕</button>

</div>


<div class="spec-items">

<div class="spec-row">

<input type="text" name="spec_label[0][]" placeholder="Parameter">

<input type="text" name="spec_value[0][]" placeholder="Value">

<button type="button" onclick="removeSpec(this)" class="btn-remove">✕</button>

</div>

</div>


<button type="button" onclick="addSpecRow(this,0)" class="btn-add-small">
+ Parameter
</button>

</div>

</div>


<button type="button" onclick="addSpecGroup()" class="btn-add">
+ Tambah Group
</button>



<!-- ACTION -->

<div style="margin-top:30px;">

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

let specIndex = 1;


/* FEATURE */

function addFeature(){

    let div = document.createElement("div");
    div.className = "feature-row";

    div.innerHTML = `
        <input type="text" name="feature_title[]" placeholder="Judul Feature">

        <textarea name="feature_desc[]" placeholder="Deskripsi Feature"></textarea>

        <input type="file" name="feature_image[]" accept=".jpg,.jpeg,.png,.webp">

        <button type="button" onclick="removeFeature(this)" class="btn-remove">✕</button>
    `;

    document.getElementById("feature-wrapper").appendChild(div);
}

function removeFeature(btn){
    btn.parentElement.remove();
}



/* SPEC */

function addSpecGroup(){

    let div = document.createElement("div");
    div.className = "spec-group";

    div.innerHTML = `
        <div class="spec-header">

            <input type="text" name="spec_group[]" placeholder="Nama Group" class="spec-title">

            <button type="button" onclick="removeSpecGroup(this)" class="btn-remove">✕</button>

        </div>

        <div class="spec-items">

            <div class="spec-row">

                <input type="text" name="spec_label[${specIndex}][]" placeholder="Parameter">

                <input type="text" name="spec_value[${specIndex}][]" placeholder="Value">

                <button type="button" onclick="removeSpec(this)" class="btn-remove">✕</button>

            </div>

        </div>

        <button type="button" onclick="addSpecRow(this, ${specIndex})" class="btn-add-small">
        + Parameter
        </button>
    `;

    document.getElementById("spec-wrapper").appendChild(div);

    specIndex++;
}


function addSpecRow(btn, index){

    let row = document.createElement("div");
    row.className = "spec-row";

    row.innerHTML = `
        <input type="text" name="spec_label[${index}][]" placeholder="Parameter">

        <input type="text" name="spec_value[${index}][]" placeholder="Value">

        <button type="button" onclick="removeSpec(this)" class="btn-remove">✕</button>
    `;

    btn.previousElementSibling.appendChild(row);
}


function removeSpec(btn){
    btn.parentElement.remove();
}


function removeSpecGroup(btn){

    if(!confirm("Hapus group ini beserta semua parameternya?")) return;

    btn.closest(".spec-group").remove();
}

</script>


</body>
</html>

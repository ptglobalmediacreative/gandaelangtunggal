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

// Slug
function buat_slug($text){
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}


// ================= SIMPAN =================
if(isset($_POST['simpan'])){

    $nama     = $_POST['nama'];
    $kategori = $_POST['kategori'];

    $slug = buat_slug($nama);


    /* Upload Thumbnail */
    $gambar_produk = null;

    if(!empty($_FILES['gambar_produk']['name'])){

        $ext = pathinfo($_FILES['gambar_produk']['name'], PATHINFO_EXTENSION);
        $new = time().rand(100,999).".".$ext;

        move_uploaded_file(
            $_FILES['gambar_produk']['tmp_name'],
            "../upload/produk/".$new
        );

        $gambar_produk = $new;
    }


    // ================= SIMPAN PRODUK =================
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



    // ================= SIMPAN FEATURES =================
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



    // ================= SIMPAN SPECIFICATION =================
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

<!-- ================= BASIC ================= -->

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
    <input type="file" name="gambar_produk">
</div>


<!-- ================= FEATURES ================= -->

<h3 style="margin-top:25px;">Features</h3>

<div id="feature-wrapper">

<div class="feature-row">

    <input type="text" name="feature_title[]" placeholder="Judul Feature">

    <textarea name="feature_desc[]" placeholder="Deskripsi Feature"></textarea>

    <input type="file" name="feature_image[]">

    <button type="button" onclick="removeFeature(this)" class="btn-remove">✕</button>

</div>

</div>

<button type="button" onclick="addFeature()" class="btn-add">
+ Tambah Feature
</button>


<!-- ================= SPECIFICATION ================= -->

<h3 style="margin-top:30px;">Specifications</h3>

<div id="spec-wrapper">

<!-- DEFAULT GROUP -->
<div class="spec-group">

<div class="spec-header">

<input type="text" name="spec_group[]" 
       placeholder="Nama Group (Engine, Dimension, dll)" 
       class="spec-title">

<button type="button"
        onclick="removeSpecGroup(this)"
        class="btn-remove-group">✕</button>

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



<!-- ================= BUTTON ================= -->

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


<!-- ================= SCRIPT ================= -->

<script>

let specIndex = 1;


// ================= FEATURE =================
function addFeature(){

    let div = document.createElement("div");
    div.className = "feature-row";

    div.innerHTML = `
        <input type="text" name="feature_title[]" placeholder="Judul Feature">

        <textarea name="feature_desc[]" placeholder="Deskripsi Feature"></textarea>

        <input type="file" name="feature_image[]">

        <button type="button" onclick="removeFeature(this)" class="btn-remove">✕</button>
    `;

    document.getElementById("feature-wrapper").appendChild(div);
}

function removeFeature(btn){
    btn.parentElement.remove();
}



// ================= SPEC =================
function addSpecGroup(){

    let div = document.createElement("div");
    div.className = "spec-group";

    div.innerHTML = `
        <div class="spec-header">

            <input type="text" name="spec_group[]" 
                   placeholder="Nama Group" 
                   class="spec-title">

            <button type="button"
                    onclick="removeSpecGroup(this)"
                    class="btn-remove-group">✕</button>

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

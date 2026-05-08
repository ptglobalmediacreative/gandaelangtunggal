<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once __DIR__ . "/config.php";
require_once "auth.php";

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

$id = (int)$_GET['id'];

/* ================= CONFIG ================= */

$upload_path = "../images/uploads/produk/";
$allowed_ext = ['jpg', 'jpeg', 'png', 'webp'];

if (!is_dir($upload_path)) {
    mkdir($upload_path, 0777, true);
}

/* ================= FUNCTIONS ================= */

function buat_slug($text)
{
    return trim(
        preg_replace('/[^a-z0-9]+/', '-', strtolower($text)),
        '-'
    );
}

/* Upload tanpa duplikat */
function uploadUniqueImage($tmp, $name, $path, $allowed)
{
    if (empty($tmp)) return null;

    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        return null;
    }

    $hash = md5_file($tmp);

    foreach (glob($path . "*") as $f) {

        if (is_file($f) && md5_file($f) === $hash) {
            return basename($f);
        }
    }

    $new = time() . rand(100, 999) . "." . $ext;

    move_uploaded_file($tmp, $path . $new);

    return $new;
}

/* Hapus file kalau tidak dipakai */
function deleteIfUnused($pdo, $file, $path)
{
    if (!$file) return;

    $q1 = $pdo->prepare("SELECT COUNT(*) FROM produk WHERE gambar=?");
    $q2 = $pdo->prepare("SELECT COUNT(*) FROM produk_features WHERE image=?");
    $q3 = $pdo->prepare("SELECT COUNT(*) FROM produk_gallery WHERE image=?");

    $q1->execute([$file]);
    $q2->execute([$file]);
    $q3->execute([$file]);

    if (
        $q1->fetchColumn() == 0 &&
        $q2->fetchColumn() == 0 &&
        $q3->fetchColumn() == 0
    ) {

        $f = $path . $file;

        if (file_exists($f)) {
            unlink($f);
        }
    }
}

/* ================= LOAD DATA ================= */

/* Produk */
$p = $pdo->prepare("SELECT * FROM produk WHERE id=?");
$p->execute([$id]);
$produk = $p->fetch();

if (!$produk) {
    header("Location: produk.php");
    exit;
}

/* Kategori */
$cat = $pdo->query("SELECT * FROM categories ORDER BY name")
    ->fetchAll();

/* Features */
$fq = $pdo->prepare("
    SELECT * FROM produk_features
    WHERE produk_id=?
    ORDER BY sort_order
");

$fq->execute([$id]);
$features = $fq->fetchAll();

/* Spec */
$sq = $pdo->prepare("
    SELECT * FROM produk_spesifikasi
    WHERE produk_id=?
    ORDER BY grup, sort_order
");

$sq->execute([$id]);
$specs = $sq->fetchAll();

$groups = [];

foreach ($specs as $s) {
    $groups[$s['grup']][] = $s;
}

/* Gallery */
$gq = $pdo->prepare("
    SELECT * FROM produk_gallery
    WHERE produk_id=?
    ORDER BY sort_order
");

$gq->execute([$id]);
$gallery = $gq->fetchAll();

/* ================= UPDATE ================= */

if (isset($_POST['update'])) {

    $nama = trim($_POST['nama']);
    $kategori = (int)$_POST['kategori'];
    $slug = buat_slug($nama);

    /* Thumbnail lama */
    $old_thumb = $produk['gambar'];

    /* ================= THUMBNAIL ================= */

    $gambar = $old_thumb;

    if (!empty($_FILES['gambar_produk']['name'])) {

        $new = uploadUniqueImage(
            $_FILES['gambar_produk']['tmp_name'],
            $_FILES['gambar_produk']['name'],
            $upload_path,
            $allowed_ext
        );

        if ($new) {
            $gambar = $new;
        }
    }

    /* ================= UPDATE PRODUK ================= */

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

    /* ================= FEATURES ================= */

    $oldFeatureImages = $pdo->query("
        SELECT image
        FROM produk_features
        WHERE produk_id=$id
    ")->fetchAll(PDO::FETCH_COLUMN);

    /* hapus data lama */
    $pdo->prepare("
        DELETE FROM produk_features
        WHERE produk_id=?
    ")->execute([$id]);

    if (!empty($_POST['feature_title'])) {

        foreach ($_POST['feature_title'] as $i => $t) {

            if (!$t) continue;

            $desc = $_POST['feature_desc'][$i] ?? '';

            $oldImg = $_POST['old_feature_image'][$i] ?? null;

            $img = $oldImg;

            /* upload gambar baru */
            if (!empty($_FILES['feature_image']['name'][$i])) {

                $new = uploadUniqueImage(
                    $_FILES['feature_image']['tmp_name'][$i],
                    $_FILES['feature_image']['name'][$i],
                    $upload_path,
                    $allowed_ext
                );

                if ($new) {
                    $img = $new;
                }
            }

            $pdo->prepare("
                INSERT INTO produk_features
                (
                    produk_id,
                    grup,
                    title,
                    description,
                    image,
                    sort_order
                )
                VALUES (?,?,?,?,?,?)
            ")->execute([
                $id,
                'FEATURE',
                $t,
                $desc,
                $img,
                $i
            ]);
        }
    }

    /* ================= SPECIFICATIONS ================= */

    $pdo->prepare("
        DELETE FROM produk_spesifikasi
        WHERE produk_id=?
    ")->execute([$id]);

    if (!empty($_POST['spec_group'])) {

        foreach ($_POST['spec_group'] as $g => $gr) {

            if (!$gr) continue;

            if (!isset($_POST['spec_label'][$g])) continue;

            foreach ($_POST['spec_label'][$g] as $i => $l) {

                if (!$l) continue;

                $v = $_POST['spec_value'][$g][$i] ?? '';

                $pdo->prepare("
                    INSERT INTO produk_spesifikasi
                    (
                        produk_id,
                        grup,
                        label,
                        nilai,
                        sort_order
                    )
                    VALUES (?,?,?,?,?)
                ")->execute([
                    $id,
                    $gr,
                    $l,
                    $v,
                    $i
                ]);
            }
        }
    }

    /* ================= GALLERY ================= */

    /* gallery lama tetap */
    if (!empty($_FILES['gallery']['name'][0])) {

        $lastOrder = $pdo->query("
            SELECT COALESCE(MAX(sort_order),0)
            FROM produk_gallery
            WHERE produk_id=$id
        ")->fetchColumn();

        foreach ($_FILES['gallery']['name'] as $i => $n) {

            if (!$n) continue;

            $new = uploadUniqueImage(
                $_FILES['gallery']['tmp_name'][$i],
                $n,
                $upload_path,
                $allowed_ext
            );

            if ($new) {

                $pdo->prepare("
                    INSERT INTO produk_gallery
                    (
                        produk_id,
                        image,
                        sort_order
                    )
                    VALUES (?,?,?)
                ")->execute([
                    $id,
                    $new,
                    $lastOrder + $i + 1
                ]);
            }
        }
    }

    /* ================= CLEAN FILE ================= */

    if ($old_thumb != $gambar) {
        deleteIfUnused($pdo, $old_thumb, $upload_path);
    }

    foreach ($oldFeatureImages as $f) {
        deleteIfUnused($pdo, $f, $upload_path);
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

                <input
                    type="text"
                    name="nama"
                    value="<?= htmlspecialchars($produk['nama_produk']); ?>"
                    required>
            </div>

            <div class="form-group">

                <label>Kategori</label>

                <select name="kategori">

                    <?php foreach ($cat as $c): ?>

                        <option
                            value="<?= $c['id']; ?>"
                            <?= $produk['category_id'] == $c['id'] ? 'selected' : ''; ?>>

                            <?= $c['name']; ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <!-- THUMBNAIL -->

            <div class="form-group">

                <label>Thumbnail</label><br>

                <?php if ($produk['gambar']): ?>

                    <img
                        src="<?= $upload_path . $produk['gambar']; ?>"
                        width="120"
                        style="margin-bottom:10px;">

                    <br>

                <?php endif; ?>

                <input
                    type="file"
                    name="gambar_produk"
                    accept=".jpg,.jpeg,.png,.webp">

            </div>

            <!-- GALLERY -->

            <h3>Gallery</h3>

            <div class="form-group">

                <?php if ($gallery): ?>

                    <div style="
                        display:flex;
                        gap:10px;
                        flex-wrap:wrap;
                        margin-bottom:10px;
                    ">

                        <?php foreach ($gallery as $g): ?>

                            <img
                                src="<?= $upload_path . $g['image']; ?>"
                                width="80">

                        <?php endforeach; ?>

                    </div>

                <?php endif; ?>

                <input
                    type="file"
                    name="gallery[]"
                    multiple
                    accept=".jpg,.jpeg,.png,.webp">

            </div>

            <!-- FEATURES -->

            <h3>Features</h3>

            <div id="feature-wrapper">

                <?php foreach ($features as $f): ?>

                    <div class="feature-row">

                        <input
                            type="text"
                            name="feature_title[]"
                            value="<?= htmlspecialchars($f['title']); ?>"
                            placeholder="Title">

                        <textarea
                            name="feature_desc[]"
                            placeholder="Description"><?= htmlspecialchars($f['description']); ?></textarea>

                        <?php if ($f['image']): ?>

                            <img
                                src="<?= $upload_path . $f['image']; ?>"
                                width="80"
                                style="margin-bottom:10px;">

                        <?php endif; ?>

                        <input
                            type="hidden"
                            name="old_feature_image[]"
                            value="<?= $f['image']; ?>">

                        <input
                            type="file"
                            name="feature_image[]"
                            accept=".jpg,.jpeg,.png,.webp">

                        <button
                            type="button"
                            onclick="removeFeature(this)"
                            class="btn-remove">

                            ✕

                        </button>

                    </div>

                <?php endforeach; ?>

            </div>

            <button
                type="button"
                onclick="addFeature()"
                class="btn-add">

                + Tambah Feature

            </button>

            <!-- SPEC -->

            <h3>Specifications</h3>

            <div id="spec-wrapper">

                <?php $gi = 0; ?>

                <?php foreach ($groups as $g => $rows): ?>

                    <div class="spec-group">

                        <div class="spec-header">

                            <input
                                type="text"
                                name="spec_group[]"
                                value="<?= htmlspecialchars($g); ?>"
                                class="spec-title">

                            <button
                                type="button"
                                onclick="removeSpecGroup(this)"
                                class="btn-remove">

                                ✕

                            </button>

                        </div>

                        <div class="spec-items">

                            <?php foreach ($rows as $r): ?>

                                <div class="spec-row">

                                    <input
                                        type="text"
                                        name="spec_label[<?= $gi; ?>][]"
                                        value="<?= htmlspecialchars($r['label']); ?>">

                                    <input
                                        type="text"
                                        name="spec_value[<?= $gi; ?>][]"
                                        value="<?= htmlspecialchars($r['nilai']); ?>">

                                    <button
                                        type="button"
                                        onclick="removeSpec(this)"
                                        class="btn-remove">

                                        ✕

                                    </button>

                                </div>

                            <?php endforeach; ?>

                        </div>

                        <button
                            type="button"
                            onclick="addSpecRow(this,<?= $gi; ?>)"
                            class="btn-add-small">

                            + Parameter

                        </button>

                    </div>

                    <?php $gi++; ?>

                <?php endforeach; ?>

            </div>

            <button
                type="button"
                onclick="addSpecGroup()"
                class="btn-add">

                + Tambah Group

            </button>

            <!-- ACTION -->

            <div style="margin-top:30px;">

                <button
                    type="submit"
                    name="update"
                    class="btn-primary">

                    Update

                </button>

                <a
                    href="produk.php"
                    class="btn-secondary">

                    Kembali

                </a>

            </div>

        </form>

    </div>

</div>

<script>

let specIndex = <?= $gi ?? 0 ?>;

/* ================= FEATURE ================= */

function addFeature(){

    let div = document.createElement("div");

    div.className = "feature-row";

    div.innerHTML = `
        <input type="text" name="feature_title[]" placeholder="Title">

        <textarea
            name="feature_desc[]"
            placeholder="Description"></textarea>

        <input
            type="hidden"
            name="old_feature_image[]"
            value="">

        <input
            type="file"
            name="feature_image[]"
            accept=".jpg,.jpeg,.png,.webp">

        <button
            type="button"
            onclick="removeFeature(this)"
            class="btn-remove">
            ✕
        </button>
    `;

    document
        .getElementById("feature-wrapper")
        .appendChild(div);
}

function removeFeature(btn){
    btn.parentElement.remove();
}

/* ================= SPEC ================= */

function addSpecGroup(){

    let div = document.createElement("div");

    div.className = "spec-group";

    div.innerHTML = `
        <div class="spec-header">

            <input
                type="text"
                name="spec_group[]"
                class="spec-title">

            <button
                type="button"
                onclick="removeSpecGroup(this)"
                class="btn-remove">
                ✕
            </button>

        </div>

        <div class="spec-items">

            <div class="spec-row">

                <input
                    type="text"
                    name="spec_label[${specIndex}][]">

                <input
                    type="text"
                    name="spec_value[${specIndex}][]">

                <button
                    type="button"
                    onclick="removeSpec(this)"
                    class="btn-remove">
                    ✕
                </button>

            </div>

        </div>

        <button
            type="button"
            onclick="addSpecRow(this, ${specIndex})"
            class="btn-add-small">

            + Parameter

        </button>
    `;

    document
        .getElementById("spec-wrapper")
        .appendChild(div);

    specIndex++;
}

function addSpecRow(btn, index){

    let row = document.createElement("div");

    row.className = "spec-row";

    row.innerHTML = `
        <input
            type="text"
            name="spec_label[${index}][]">

        <input
            type="text"
            name="spec_value[${index}][]">

        <button
            type="button"
            onclick="removeSpec(this)"
            class="btn-remove">
            ✕
        </button>
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
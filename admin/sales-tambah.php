<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require_once "auth.php";
require_once "config.php";

/* CEK AKSES */
if(!cekAkses('sales')){
    die("Akses ditolak!");
}

$error = "";

/* FOLDER UPLOAD */
$upload_path = "../images/uploads/data-sales/";

if(!is_dir($upload_path)){
    mkdir($upload_path,0777,true);
}


/* ================= FUNCTION UPLOAD ================= */

function uploadFile($file,$path){

    if(empty($file['name'])) return null;

    $ext = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
    $allow = ['jpg','jpeg','png','webp','pdf'];

    if(!in_array($ext,$allow)) return null;

    $new = time().rand(100,999).".".$ext;

    move_uploaded_file($file['tmp_name'],$path.$new);

    return $new;
}


/* ================= SIMPAN ================= */

if(isset($_POST['simpan'])){

    $nama      = trim($_POST['nama']);
    $no_hp     = trim($_POST['no_hp']);
    $email     = trim($_POST['email']);
    $tgl_lahir = $_POST['tgl_lahir'];
    $jk        = $_POST['jk'];

    if(!$nama || !$no_hp){

        $error = "Nama dan No HP wajib diisi!";

    }else{

        /* Upload File */

        $ktp   = uploadFile($_FILES['ktp'],$upload_path);
        $npwp  = uploadFile($_FILES['npwp'],$upload_path);
        $sim   = uploadFile($_FILES['sim'],$upload_path);
        $foto  = uploadFile($_FILES['foto'],$upload_path);

        /* Simpan DB */

        $stmt = $pdo->prepare("
            INSERT INTO sales_management
            (
                nama,
                no_hp,
                email,
                tgl_lahir,
                jenis_kelamin,
                ktp,
                npwp,
                sim,
                foto,
                created_at
            )
            VALUES
            (?,?,?,?,?,?,?,?,?,NOW())
        ");

        $stmt->execute([
            $nama,
            $no_hp,
            $email,
            $tgl_lahir,
            $jk,
            $ktp,
            $npwp,
            $sim,
            $foto
        ]);

        header("Location: salesmanagement.php?status=add");
        exit;

    }

}
?>

<?php include "header.php"; ?>
<link rel="stylesheet" href="css/admin-user.css">
<?php include "sidebar.php"; ?>


<div class="main-content">

<!-- TOPBAR -->
<div class="topbar">

    <h2>Tambah Sales</h2>

    <div class="topbar-right">

        <span class="admin-name">
            <i class="fa-solid fa-user"></i>
            <?= $_SESSION['admin_nama']; ?>
        </span>

        <a href="logout.php" class="logout-btn">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </a>

    </div>

</div>


<!-- CONTENT -->
<div class="card admin-form">


<?php if($error): ?>
<div class="alert-error"><?= $error ?></div>
<?php endif; ?>


<form method="POST" enctype="multipart/form-data">


<!-- NAMA -->
<div class="form-group">
<label>Nama Lengkap</label>
<input type="text" name="nama" required>
</div>


<!-- HP -->
<div class="form-group">
<label>No Handphone</label>
<input type="text" name="no_hp" required>
</div>


<!-- EMAIL -->
<div class="form-group">
<label>Email</label>
<input type="email" name="email">
</div>


<!-- TGL LAHIR -->
<div class="form-group">
<label>Tanggal Lahir</label>
<input type="date" name="tgl_lahir">
</div>


<!-- JK -->
<div class="form-group">
<label>Jenis Kelamin</label>

<select name="jk">
    <option value="">-- Pilih --</option>
    <option value="Laki-laki">Laki-laki</option>
    <option value="Perempuan">Perempuan</option>
</select>

</div>


<!-- KTP -->
<div class="form-group">
<label>Upload KTP</label>
<input type="file" name="ktp" accept=".jpg,.jpeg,.png,.webp,.pdf">
</div>


<!-- NPWP -->
<div class="form-group">
<label>Upload NPWP</label>
<input type="file" name="npwp" accept=".jpg,.jpeg,.png,.webp,.pdf">
</div>


<!-- SIM -->
<div class="form-group">
<label>Upload SIM</label>
<input type="file" name="sim" accept=".jpg,.jpeg,.png,.webp,.pdf">
</div>


<!-- FOTO -->
<div class="form-group">
<label>Foto Diri</label>
<input type="file" name="foto" accept=".jpg,.jpeg,.png,.webp">
</div>


<!-- BUTTON -->
<div style="margin-top:30px;display:flex;gap:12px;">

<button type="submit" name="simpan" class="btn-submit">
Simpan Data
</button>

<a href="salesmanagement.php" class="btn-secondary">
Kembali
</a>

</div>


</form>

</div>

</div>

</body>
</html>

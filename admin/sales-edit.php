<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require_once "auth.php";
require_once "config.php";

/* CEK AKSES */
if(!cekAkses('sales')){
    die("Akses ditolak!");
}

/* CEK ID */
if(!isset($_GET['id'])){
    header("Location: sales.php");
    exit;
}

$id = (int) $_GET['id'];

/* AMBIL DATA */
$stmt = $pdo->prepare("SELECT * FROM sales_management WHERE id=?");
$stmt->execute([$id]);
$sales = $stmt->fetch();

if(!$sales){
    die("Data sales tidak ditemukan!");
}


/* ================= FOLDER UPLOAD ================= */

$upload_dir = "/uploads/data-sales/";

if(!is_dir($upload_dir)){
    mkdir($upload_dir,0777,true);
}


/* ================= UPLOAD FUNCTION ================= */

function uploadFile($field,$old,$dir){

    if(!empty($_FILES[$field]['name'])){

        $ext  = pathinfo($_FILES[$field]['name'],PATHINFO_EXTENSION);
        $name = time().'_'.rand(1000,9999).'.'.$ext;

        move_uploaded_file($_FILES[$field]['tmp_name'],$dir.$name);

        // hapus file lama
        if($old && file_exists($dir.$old)){
            unlink($dir.$old);
        }

        return $name;
    }

    return $old;
}


/* ================= SIMPAN ================= */

$error = "";

if(isset($_POST['simpan'])){

    $nama   = trim($_POST['nama']);
    $no_hp  = trim($_POST['no_hp']);
    $email  = trim($_POST['email']);
    $tgl    = $_POST['tgl_lahir'];
    $jk     = $_POST['jk'];

    if(!$nama || !$no_hp){
        $error = "Nama dan No HP wajib diisi!";
    }else{

        /* UPLOAD FILE */
        $ktp   = uploadFile('ktp',$sales['ktp'],$upload_dir);
        $npwp  = uploadFile('npwp',$sales['npwp'],$upload_dir);
        $sim   = uploadFile('sim',$sales['sim'],$upload_dir);
        $foto  = uploadFile('foto',$sales['foto'],$upload_dir);

        /* UPDATE */
        $stmt = $pdo->prepare("
            UPDATE sales SET
                nama=?,
                no_hp=?,
                email=?,
                tgl_lahir=?,
                jk=?,
                ktp=?,
                npwp=?,
                sim=?,
                foto=?
            WHERE id=?
        ");

        $stmt->execute([
            $nama,
            $no_hp,
            $email,
            $tgl,
            $jk,
            $ktp,
            $npwp,
            $sim,
            $foto,
            $id
        ]);

        header("Location: sales-detail.php?id=".$id."&status=update");
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

<h2>Edit Data Sales</h2>

<div class="topbar-right">

<span class="admin-name">
<i class="fa-solid fa-user"></i>
<?= $_SESSION['admin_nama']; ?>
</span>

<a href="logout.php" class="logout-btn">
<i class="fa-solid fa-right-from-bracket"></i> Logout
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
<label>Nama</label>
<input type="text" name="nama"
value="<?= htmlspecialchars($sales['nama']); ?>" required>
</div>


<!-- HP -->
<div class="form-group">
<label>No HP</label>
<input type="text" name="no_hp"
value="<?= htmlspecialchars($sales['no_hp']); ?>" required>
</div>


<!-- EMAIL -->
<div class="form-group">
<label>Email</label>
<input type="email" name="email"
value="<?= htmlspecialchars($sales['email']); ?>">
</div>


<!-- TGL -->
<div class="form-group">
<label>Tanggal Lahir</label>
<input type="date" name="tgl_lahir"
value="<?= $sales['tgl_lahir']; ?>">
</div>


<!-- JK -->
<div class="form-group">
<label>Jenis Kelamin</label>
<select name="jk">

<option value="">-- Pilih --</option>

<option value="L"
<?= $sales['jk']=='L'?'selected':'' ?>>
Laki-laki
</option>

<option value="P"
<?= $sales['jk']=='P'?'selected':'' ?>>
Perempuan
</option>

</select>
</div>


<!-- FILE -->

<div class="form-group">
<label>KTP</label>
<input type="file" name="ktp">
</div>

<div class="form-group">
<label>NPWP</label>
<input type="file" name="npwp">
</div>

<div class="form-group">
<label>SIM</label>
<input type="file" name="sim">
</div>

<div class="form-group">
<label>Foto Diri</label>
<input type="file" name="foto">
</div>


<!-- BUTTON -->
<div style="margin-top:30px;display:flex;gap:12px;">

<button type="submit" name="simpan" class="btn-submit">
Update Data
</button>

<a href="salesmanagement.php?id=<?= $id ?>"
class="btn-secondary">
Batal
</a>

</div>


</form>

</div>

</div>

</body>
</html>

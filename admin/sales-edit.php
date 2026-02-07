<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require_once "auth.php";
require_once "config.php";

/* CEK AKSES */
if(!cekAkses('sales')){
    die("Akses ditolak!");
}

if(!isset($_GET['id'])){
    header("Location: salesmanagement.php");
    exit;
}

$id = (int)$_GET['id'];

$upload = "../images/uploads/sales/";
$allow = ['jpg','jpeg','png','webp'];

if(!is_dir($upload)){
    mkdir($upload,0777,true);
}

/* AMBIL DATA */
$stmt = $pdo->prepare("SELECT * FROM sales_management WHERE id=?");
$stmt->execute([$id]);

$sales = $stmt->fetch();

if(!$sales){
    header("Location: salesmanagement.php");
    exit;
}


/* UPLOAD */
function uploadFile($file,$old,$path,$allow){

    if(empty($file['name'])) return $old;

    $ext = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));

    if(!in_array($ext,$allow)) return $old;

    if($old && file_exists($path.$old)){
        unlink($path.$old);
    }

    $new = time().rand(100,999).".".$ext;

    move_uploaded_file($file['tmp_name'],$path.$new);

    return $new;
}


/* SIMPAN */
if(isset($_POST['simpan'])){

    $nama = $_POST['nama'];
    $hp   = $_POST['no_hp'];
    $email= $_POST['email'];
    $tgl  = $_POST['tgl_lahir'];
    $jk   = $_POST['jk'];

    $ktp  = uploadFile($_FILES['ktp'],$sales['ktp'],$upload,$allow);
    $npwp = uploadFile($_FILES['npwp'],$sales['npwp'],$upload,$allow);
    $sim  = uploadFile($_FILES['sim'],$sales['sim'],$upload,$allow);
    $foto = uploadFile($_FILES['foto'],$sales['foto'],$upload,$allow);

    $stmt = $pdo->prepare("
        UPDATE sales_management SET
        nama=?, no_hp=?, email=?, tgl_lahir=?, jk=?,
        ktp=?, npwp=?, sim=?, foto=?
        WHERE id=?
    ");

    $stmt->execute([
        $nama,$hp,$email,$tgl,$jk,
        $ktp,$npwp,$sim,$foto,
        $id
    ]);

    header("Location: sales-detail.php?id=".$id);
    exit;
}

?>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<div class="main-content">

<div class="topbar">
<h2>Edit Sales</h2>
</div>

<div class="card">

<form method="POST" enctype="multipart/form-data">

<div class="form-group">
<label>Nama</label>
<input type="text" name="nama" value="<?= $sales['nama'] ?>" required>
</div>

<div class="form-group">
<label>No HP</label>
<input type="text" name="no_hp" value="<?= $sales['no_hp'] ?>" required>
</div>

<div class="form-group">
<label>Email</label>
<input type="email" name="email" value="<?= $sales['email'] ?>">
</div>

<div class="form-group">
<label>Tanggal Lahir</label>
<input type="date" name="tgl_lahir" value="<?= $sales['tgl_lahir'] ?>">
</div>

<div class="form-group">
<label>Jenis Kelamin</label>
<select name="jk">
<option value="L" <?= $sales['jk']=='L'?'selected':'' ?>>Laki-laki</option>
<option value="P" <?= $sales['jk']=='P'?'selected':'' ?>>Perempuan</option>
</select>
</div>


<h3>Dokumen</h3>

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
<label>Foto</label>
<input type="file" name="foto">
</div>


<div style="margin-top:25px;display:flex;gap:10px;">

<button type="submit" name="simpan" class="btn-primary">
Simpan
</button>

<a href="salesmanagement.php" class="btn-secondary">
Batal
</a>

</div>

</form>

</div>
</div>

</body>
</html>

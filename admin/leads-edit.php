<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require_once "auth.php";
require_once "config.php";

/* CEK AKSES */
if(!cekAkses('leads')){
    die("Akses ditolak!");
}

/* CEK ID */
if(!isset($_GET['id'])){
    header("Location: leads.php");
    exit;
}

$id = (int)$_GET['id'];


/* AMBIL DATA */
$stmt = $pdo->prepare("SELECT * FROM leads WHERE id=?");
$stmt->execute([$id]);

$leads = $stmt->fetch();

if(!$leads){
    header("Location: leads.php");
    exit;
}


$upload_path = "../images/uploads/leads/";

if(!is_dir($upload_path)){
    mkdir($upload_path,0777,true);
}

$error = "";


/* ================= UPDATE ================= */

if(isset($_POST['simpan'])){

    $nama_perusahaan = trim($_POST['nama_perusahaan']);
    $nama_pic        = trim($_POST['nama_pic']);
    $no_pic          = trim($_POST['no_pic']);
    $email_pic       = trim($_POST['email_pic']);
    $sales           = trim($_POST['sales']);

    $npwp_lama = $_POST['npwp_lama'];

    if(!$nama_perusahaan || !$nama_pic || !$no_pic){

        $error = "Field wajib belum diisi!";

    }else{

        /* UPLOAD NPWP BARU */
        $npwp_baru = $npwp_lama;

        if(!empty($_FILES['npwp_image']['name'])){

            $ext = strtolower(pathinfo($_FILES['npwp_image']['name'],PATHINFO_EXTENSION));
            $allow = ['jpg','jpeg','png','webp'];

            if(in_array($ext,$allow)){

                $new = time().rand(100,999).".".$ext;

                move_uploaded_file(
                    $_FILES['npwp_image']['tmp_name'],
                    $upload_path.$new
                );

                // Hapus lama
                if($npwp_lama && file_exists($upload_path.$npwp_lama)){
                    unlink($upload_path.$npwp_lama);
                }

                $npwp_baru = $new;
            }
        }


        /* UPDATE DB */
        $stmt = $pdo->prepare("
            UPDATE leads SET
            nama_perusahaan=?,
            nama_pic=?,
            no_pic=?,
            email_pic=?,
            sales=?,
            npwp_image=?
            WHERE id=?
        ");

        $stmt->execute([
            $nama_perusahaan,
            $nama_pic,
            $no_pic,
            $email_pic,
            $sales,
            $npwp_baru,
            $id
        ]);


        header("Location: leads-detail.php?id=".$id);
        exit;

    }

}
?>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>


<div class="main-content">

<div class="topbar">

<h2>Edit Leads</h2>

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


<div class="card admin-form">


<?php if($error): ?>
<div class="alert-error"><?= $error ?></div>
<?php endif; ?>


<form method="POST" enctype="multipart/form-data">


<input type="hidden" name="npwp_lama" value="<?= $leads['npwp_image']; ?>">


<div class="form-group">
<label>Nama Perusahaan</label>
<input type="text" name="nama_perusahaan"
value="<?= $leads['nama_perusahaan']; ?>" required>
</div>


<div class="form-group">
<label>Nama PIC</label>
<input type="text" name="nama_pic"
value="<?= $leads['nama_pic']; ?>" required>
</div>


<div class="form-group">
<label>No PIC</label>
<input type="text" name="no_pic"
value="<?= $leads['no_pic']; ?>" required>
</div>


<div class="form-group">
<label>Email PIC</label>
<input type="email" name="email_pic"
value="<?= $leads['email_pic']; ?>">
</div>


<div class="form-group">
<label>Sales</label>
<input type="text" name="sales"
value="<?= $leads['sales']; ?>">
</div>


<div class="form-group">
<label>NPWP (Upload Baru)</label>

<input type="file" name="npwp_image"
accept=".jpg,.jpeg,.png,.webp">

<?php if($leads['npwp_image']): ?>
<br><br>
<img src="<?= $upload_path.$leads['npwp_image']; ?>"
width="150">
<?php endif; ?>
</div>



<div style="margin-top:25px;display:flex;gap:12px;">

<button type="submit" name="simpan" class="btn-primary">
Update
</button>

<a href="leads-detail.php?id=<?= $id ?>"
class="btn-secondary">
Batal
</a>

</div>


</form>

</div>

</div>

</body>
</html>

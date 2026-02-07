<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require_once "auth.php";
require_once "config.php";

/* CEK AKSES */
if(!cekAkses('leads')){
    die("Akses ditolak!");
}

$error = "";

/* FOLDER UPLOAD NPWP */
$upload_path = "../images/uploads/data-customer/";

if(!is_dir($upload_path)){
    mkdir($upload_path,0777,true);
}


/* AMBIL DATA SALES */
$sales_stmt = $pdo->query("
    SELECT id, nama
    FROM sales_management
    ORDER BY nama ASC
");

$sales_list = $sales_stmt->fetchAll();


/* SIMPAN DATA */
if(isset($_POST['simpan'])){

    $nama_perusahaan = trim($_POST['nama_perusahaan']);
    $nama_pic        = trim($_POST['nama_pic']);
    $no_pic          = trim($_POST['no_pic']);
    $email_pic       = trim($_POST['email_pic']);
    $sales           = trim($_POST['sales']);

    /* UPLOAD NPWP */
    $npwp_image = null;

    if(!empty($_FILES['npwp_image']['name'])){

        $ext = strtolower(pathinfo($_FILES['npwp_image']['name'],PATHINFO_EXTENSION));

        $allowed = ['jpg','jpeg','png','webp'];

        if(in_array($ext,$allowed)){

            $npwp_image = time().rand(100,999).".".$ext;

            move_uploaded_file(
                $_FILES['npwp_image']['tmp_name'],
                $upload_path.$npwp_image
            );
        }
    }


    /* VALIDASI */
    if(!$nama_perusahaan || !$nama_pic || !$no_pic){

        $error = "Nama Perusahaan, Nama PIC, dan No PIC wajib diisi!";

    }else{

        $stmt = $pdo->prepare("
            INSERT INTO leads
            (
                nama_perusahaan,
                nama_pic,
                no_pic,
                email_pic,
                npwp_image,
                sales,
                created_at
            )
            VALUES
            (?,?,?,?,?,?,NOW())
        ");

        $stmt->execute([
            $nama_perusahaan,
            $nama_pic,
            $no_pic,
            $email_pic,
            $npwp_image,
            $sales
        ]);

        header("Location: leads.php?status=add");
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

    <h2>Tambah Leads</h2>

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


<!-- PERUSAHAAN -->
<div class="form-group">
<label>Nama Perusahaan</label>
<input type="text" name="nama_perusahaan" required>
</div>


<!-- PIC -->
<div class="form-group">
<label>Nama PIC</label>
<input type="text" name="nama_pic" required>
</div>


<div class="form-group">
<label>No PIC</label>
<input type="text" name="no_pic" required>
</div>


<div class="form-group">
<label>Email PIC</label>
<input type="email" name="email_pic">
</div>


<!-- SALES -->
<div class="form-group">
<label>Sales</label>

<select name="sales" required>

<option value="">-- Pilih Sales --</option>

<?php foreach($sales_list as $s): ?>

<option value="<?= htmlspecialchars($s['nama']); ?>">
<?= htmlspecialchars($s['nama']); ?>
</option>

<?php endforeach; ?>

</select>

</div>


<!-- NPWP -->
<div class="form-group">
<label>Upload NPWP</label>

<input type="file"
       name="npwp_image"
       accept=".jpg,.jpeg,.png,.webp">

</div>


<!-- BUTTON -->
<div style="margin-top:30px;display:flex;gap:12px;">

<button type="submit" name="simpan" class="btn-submit">
Simpan Leads
</button>

<a href="leads.php" class="btn-secondary">
Kembali
</a>

</div>


</form>

</div>

</div>

</body>
</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "auth.php";
require_once "config.php";

/* CEK AKSES */
if(!cekAkses('delivery')){
    die("Akses ditolak!");
}

/* FOLDER UPLOAD */
$upload_path = __DIR__ . "/uploads/data-customer/";

if(!is_dir($upload_path)){
    mkdir($upload_path, 0777, true);
}

$error = "";
$success = "";


/* ================= SIMPAN ================= */

if(isset($_POST['simpan'])){

    $nama_pt    = trim($_POST['nama_pt']);
    $nama_pic   = trim($_POST['nama_pic']);
    $no_pic     = trim($_POST['no_pic']);
    $email_pic  = trim($_POST['email_pic']);
    $tipe_unit  = trim($_POST['tipe_unit']);
    $no_rangka  = trim($_POST['no_rangka']);
    $no_mesin   = trim($_POST['no_mesin']);
    $alamat     = trim($_POST['alamat']);
    $harga      = trim($_POST['harga']);
    $pembayaran = trim($_POST['pembayaran']);
    $tgl_kirim  = $_POST['tanggal_kirim'];


    /* VALIDASI */
    if(
        !$nama_pt || !$nama_pic || !$no_pic ||
        !$tipe_unit || !$alamat || !$tgl_kirim
    ){
        $error = "Field wajib belum lengkap!";
    }else{


        /* ================= UPLOAD DOKUMEN ================= */

        $dokumen = null;

        if(!empty($_FILES['dokumen_pt']['name'])){

            $allowed = ['jpg','jpeg','png','pdf'];

            $ext = strtolower(pathinfo(
                $_FILES['dokumen_pt']['name'],
                PATHINFO_EXTENSION
            ));

            if(!in_array($ext,$allowed)){

                $error = "Format dokumen harus JPG / PNG / PDF";

            }else{

                $new_name = "DOC_".time()."_".rand(100,999).".".$ext;

                move_uploaded_file(
                    $_FILES['dokumen_pt']['tmp_name'],
                    $upload_path.$new_name
                );

                $dokumen = $new_name;
            }
        }


        /* ================= SIMPAN DB ================= */

        if(!$error){

            $stmt = $pdo->prepare("
                INSERT INTO delivery_orders
                (
                    nama_pt,
                    nama_pic,
                    no_pic,
                    email_pic,
                    tipe_unit,
                    nomor_rangka,
                    nomor_mesin,
                    alamat_pengiriman,
                    harga_deal,
                    pembayaran,
                    tanggal_kirim,
                    dokumen_pt,
                    created_at
                )
                VALUES
                (?,?,?,?,?,?,?,?,?,?,?,?,NOW())
            ");

            $stmt->execute([
                $nama_pt,
                $nama_pic,
                $no_pic,
                $email_pic,
                $tipe_unit,
                $no_rangka,
                $no_mesin,
                $alamat,
                $harga,
                $pembayaran,
                $tgl_kirim,
                $dokumen
            ]);

            header("Location: delivery.php?status=add");
            exit;
        }

    }

}
?>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>


<div class="main-content">

<!-- TOPBAR -->
<div class="topbar">

    <h2>Tambah Delivery Order</h2>

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


<div class="card" style="max-width:900px;margin:auto;">


<?php if($error): ?>
<div class="alert-error"><?= $error ?></div>
<?php endif; ?>


<form method="POST" enctype="multipart/form-data">


<!-- NAMA PT -->
<div class="form-group">
<label>Nama PT</label>
<input type="text" name="nama_pt" required>
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


<!-- UNIT -->
<div class="form-group">
<label>Type Unit</label>
<input type="text" name="tipe_unit" required>
</div>


<div class="form-group">
<label>Nomor Rangka</label>
<input type="text" name="no_rangka">
</div>


<div class="form-group">
<label>Nomor Mesin</label>
<input type="text" name="no_mesin">
</div>


<!-- ALAMAT -->
<div class="form-group">
<label>Alamat Pengiriman</label>
<textarea name="alamat" required></textarea>
</div>


<!-- TRANSAKSI -->
<div class="form-group">
<label>Harga Deal</label>
<input type="text" name="harga" placeholder="Contoh: 350000000">
</div>


<div class="form-group">
<label>Pembayaran</label>

<select name="pembayaran">

<option value="">-- Pilih --</option>
<option value="Cash">Cash</option>
<option value="Kredit">Kredit</option>
<option value="Transfer">Transfer</option>

</select>
</div>


<div class="form-group">
<label>Tanggal Kirim</label>
<input type="date" name="tanggal_kirim" required>
</div>


<!-- DOKUMEN -->
<div class="form-group">
<label>Dokumen PT (JPG / PNG / PDF)</label>
<input type="file" name="dokumen_pt" accept=".jpg,.jpeg,.png,.pdf">
</div>


<!-- BUTTON -->
<div style="margin-top:30px;display:flex;gap:12px;">

<button type="submit" name="simpan" class="btn-primary">
Simpan Delivery
</button>

<a href="delivery.php" class="btn-secondary">
Kembali
</a>

</div>


</form>

</div>

</div>

</body>
</html>

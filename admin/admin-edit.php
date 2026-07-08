<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require_once "auth.php";
require_once "config.php";

/* CEK AKSES */
if(!cekAkses('user')){
  die("Akses ditolak!");
}

/* AMBIL ID */
if(!isset($_GET['id'])){
  header("Location: admin.php");
  exit;
}

$id = (int)$_GET['id'];


/* AMBIL DATA ADMIN */
$stmt = $pdo->prepare("SELECT * FROM admin WHERE id=?");
$stmt->execute([$id]);

$admin = $stmt->fetch();

if(!$admin){
  die("Data admin tidak ditemukan!");
}


/* CEK DEVELOPER (TIDAK BOLEH DIEDIT OLEH ORANG LAIN) */
if(
  strtolower($admin['keterangan']) == 'developer' &&
  $admin['id'] != $_SESSION['admin_id']
){
  die("Akun Developer tidak bisa diedit!");
}


$error = "";


/* ================= SIMPAN UPDATE ================= */

if(isset($_POST['update'])){

  $nama       = trim($_POST['nama']);
  $no_hp      = trim($_POST['no_hp']);
  $email      = trim($_POST['email']);
  $password   = $_POST['password'];
  $keterangan = trim($_POST['keterangan']);

  /* AKSES */
  $akses_dashboard = isset($_POST['akses_dashboard']) ? 1 : 0;
  $akses_produk    = isset($_POST['akses_produk']) ? 1 : 0;
  $akses_artikel   = isset($_POST['akses_artikel']) ? 1 : 0;
  $akses_pesan     = isset($_POST['akses_pesan']) ? 1 : 0;
  $akses_simulasi  = isset($_POST['akses_simulasi']) ? 1 : 0;
  $akses_user      = isset($_POST['akses_user']) ? 1 : 0;

  if(!$nama || !$no_hp){

    $error = "Nama dan No HP wajib diisi!";

  }else{

    /* ================= UPDATE TANPA PASSWORD ================= */

    if(empty($password)){

      $stmt = $pdo->prepare("
        UPDATE admin SET
          nama = ?,
          no_hp = ?,
          email = ?,
          keterangan = ?,
          akses_dashboard = ?,
          akses_produk = ?,
          akses_artikel = ?,
          akses_pesan = ?,
          akses_simulasi = ?,
          akses_user = ?
        WHERE id = ?
      ");

      $stmt->execute([
        $nama,
        $no_hp,
        $email,
        $keterangan,
        $akses_dashboard,
        $akses_produk,
        $akses_artikel,
        $akses_pesan,
        $akses_simulasi,
        $akses_user,
        $id
      ]);


    /* ================= UPDATE + PASSWORD ================= */

    }else{

      if(strlen($password) < 6){
        $error = "Password minimal 6 karakter!";
      }else{

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("
          UPDATE admin SET
            nama = ?,
            no_hp = ?,
            email = ?,
            password = ?,
            keterangan = ?,
            akses_dashboard = ?,
            akses_produk = ?,
            akses_artikel = ?,
            akses_pesan = ?,
            akses_simulasi = ?,
            akses_user = ?
          WHERE id = ?
        ");

        $stmt->execute([
          $nama,
          $no_hp,
          $email,
          $hash,
          $keterangan,
          $akses_dashboard,
          $akses_produk,
          $akses_artikel,
          $akses_pesan,
          $akses_simulasi,
          $akses_user,
          $id
        ]);

      }
    }


    if(!$error){
      header("Location: admin.php?status=edit");
      exit;
    }

  }

}

?>


<?php include "header.php"; ?>
<link rel="stylesheet" href="css/admin-user.css">
<?php include "sidebar.php"; ?>


<div class="main-content">

<!-- TOPBAR -->
<div class="topbar">

  <h2>Edit User Admin</h2>

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


<form method="POST">


<!-- NAMA -->
<div class="form-group">
<label>Nama Admin</label>
<input type="text" name="nama"
value="<?= htmlspecialchars($admin['nama']); ?>" required>
</div>


<!-- HP -->
<div class="form-group">
<label>No HP</label>
<input type="text" name="no_hp"
value="<?= htmlspecialchars($admin['no_hp']); ?>" required>
</div>


<!-- EMAIL -->
<div class="form-group">
<label>Email</label>
<input type="email" name="email"
value="<?= htmlspecialchars($admin['email']); ?>">
</div>


<!-- PASSWORD -->
<div class="form-group">
<label>Password (Kosongkan jika tidak diganti)</label>
<input type="password" name="password">
</div>


<!-- KETERANGAN -->
<div class="form-group">
<label>Keterangan</label>
<input type="text" name="keterangan"
value="<?= htmlspecialchars($admin['keterangan']); ?>">
</div>


<!-- AKSES -->
<div class="form-group">

<label>Hak Akses</label>

<div class="akses-box">

<label><input type="checkbox" name="akses_dashboard"
<?= $admin['akses_dashboard']?'checked':'' ?>> Dashboard</label>

<label><input type="checkbox" name="akses_produk"
<?= $admin['akses_produk']?'checked':'' ?>> Produk</label>

<label><input type="checkbox" name="akses_artikel"
<?= $admin['akses_artikel']?'checked':'' ?>> Artikel</label>

<label><input type="checkbox" name="akses_pesan"
<?= $admin['akses_pesan']?'checked':'' ?>> Pesan</label>

<label><input type="checkbox" name="akses_simulasi"
<?= $admin['akses_simulasi']?'checked':'' ?>> Simulasi Kredit</label>

<label><input type="checkbox" name="akses_user"
<?= $admin['akses_user']?'checked':'' ?>> User Admin</label>

</div>

</div>


<!-- BUTTON -->
<div style="margin-top:30px;display:flex;gap:12px;">

<button type="submit" name="update" class="btn-submit">
Update Admin
</button>

<a href="admin.php" class="btn-secondary">
Kembali
</a>

</div>


</form>

</div>

</div>

</body>
</html>
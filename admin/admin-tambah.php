<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require_once "auth.php";
require_once "config.php";

/* CEK AKSES */
if(!cekAkses('user')){
  die("Akses ditolak!");
}

$error = "";

/* DAFTAR MENU */
$menuList = [
  "dashboard" => "Dashboard",
  "produk"    => "Produk",
  "artikel"   => "Artikel",
  "pesan"     => "Pesan",
  "simulasi"  => "Simulasi",
  "user"      => "User Admin",
  "leads"     => "Leads",
  "sales"     => "Sales Activity",
  "stock"     => "Stock",
  "delivery"  => "Delivery"
];


/* SIMPAN DATA */
if(isset($_POST['simpan'])){

  $nama       = trim($_POST['nama']);
  $no_hp      = trim($_POST['no_hp']);
  $email      = trim($_POST['email']);
  $password   = $_POST['password'];
  $keterangan = trim($_POST['keterangan']);

  $akses = $_POST['akses'] ?? [];

  if(!$nama || !$no_hp || !$password){

    $error = "Nama, No HP, dan Password wajib diisi!";

  }else{

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $akses_json = json_encode($akses);

    $stmt = $pdo->prepare("
      INSERT INTO admin
      (nama,no_hp,email,password,keterangan,akses,created_at)
      VALUES (?,?,?,?,?,?,NOW())
    ");

    $stmt->execute([
      $nama,
      $no_hp,
      $email,
      $hash,
      $keterangan,
      $akses_json
    ]);

    header("Location: admin.php?status=add");
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

  <h2>Tambah User Admin</h2>

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
<div class="alert-error">
  <?= $error; ?>
</div>
<?php endif; ?>


<form method="POST">


<!-- NAMA -->
<div class="form-group">
<label>Nama Admin</label>
<input type="text" name="nama" required>
</div>


<!-- HP -->
<div class="form-group">
<label>No HP</label>
<input type="text" name="no_hp" required>
</div>


<!-- EMAIL -->
<div class="form-group">
<label>Email</label>
<input type="email" name="email">
</div>


<!-- PASSWORD -->
<div class="form-group">
<label>Password</label>
<input type="password" name="password" required>
</div>


<!-- KETERANGAN -->
<div class="form-group">
<label>Keterangan</label>
<input type="text" name="keterangan" placeholder="Contoh: Marketing / CS / Developer">
</div>


<!-- AKSES -->
<div class="form-group">

<label>Hak Akses Menu</label>

<div class="akses-box">

<?php foreach($menuList as $key=>$val): ?>

<label>
<input type="checkbox" name="akses[]" value="<?= $key ?>">
<?= $val ?>
</label>

<?php endforeach; ?>

</div>

</div>


<!-- BUTTON -->
<div style="margin-top:30px;display:flex;gap:12px;">

<button type="submit" name="simpan" class="btn-submit">
Simpan Admin
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

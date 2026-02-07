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


/* SIMPAN */
if(isset($_POST['simpan'])){

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
  $akses_leads     = isset($_POST['akses_leads']) ? 1 : 0;
  $akses_sales     = isset($_POST['akses_sales']) ? 1 : 0;
  $akses_stock     = isset($_POST['akses_stock']) ? 1 : 0;
  $akses_delivery  = isset($_POST['akses_delivery']) ? 1 : 0;


  if(!$nama || !$no_hp || !$password){

    $error = "Nama, No HP, dan Password wajib diisi!";

  }else{

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("
      INSERT INTO admin
      (
        nama,no_hp,email,password,keterangan,
        akses_dashboard,akses_produk,akses_artikel,
        akses_pesan,akses_simulasi,akses_user,
        akses_leads,akses_sales,akses_stock,akses_delivery,
        created_at
      )
      VALUES
      (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())
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
      $akses_leads,
      $akses_sales,
      $akses_stock,
      $akses_delivery
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


<div class="card admin-form">


<?php if($error): ?>
<div class="alert-error"><?= $error ?></div>
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

<label>Hak Akses</label>

<div class="akses-box">

<label><input type="checkbox" name="akses_dashboard"> Dashboard</label>
<label><input type="checkbox" name="akses_produk"> Produk</label>
<label><input type="checkbox" name="akses_artikel"> Artikel</label>
<label><input type="checkbox" name="akses_pesan"> Pesan</label>
<label><input type="checkbox" name="akses_simulasi"> Simulasi</label>
<label><input type="checkbox" name="akses_user"> User Admin</label>
<label><input type="checkbox" name="akses_leads"> Leads</label>
<label><input type="checkbox" name="akses_sales"> Sales</label>
<label><input type="checkbox" name="akses_stock"> Stock</label>
<label><input type="checkbox" name="akses_delivery"> Delivery</label>

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

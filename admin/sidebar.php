<?php
$current = basename($_SERVER['PHP_SELF']);

/* Helper cek akses */
function akses($key){
    return isset($_SESSION['akses'][$key]) && $_SESSION['akses'][$key] == 1;
}
?>

<div class="sidebar">

<!-- LOGO -->
<div class="sidebar-brand">
    <img src="../images/logo.webp" alt="Logo">
    <span>Admin Panel</span>
</div>

<ul class="sidebar-menu">

<!-- ================= DASHBOARD ================= -->
<?php if(akses('dashboard')): ?>
<li>
  <a href="dashboard.php"
     class="<?= $current=='dashboard.php'?'active':'' ?>">
    <i class="fa-solid fa-house icon"></i>
    <span>Dashboard</span>
  </a>
</li>
<?php endif; ?>


<!-- ================= PRODUK ================= -->
<?php
$produk_pages = [
  'produk.php','produk-tambah.php','produk-edit.php',
  'produk-detail.php','produk-hapus.php'
];
?>

<?php if(akses('produk')): ?>
<li>
  <a href="produk.php"
     class="<?= in_array($current,$produk_pages)?'active':'' ?>">
    <i class="fa-solid fa-truck-moving icon"></i>
    <span>Produk</span>
  </a>
</li>
<?php endif; ?>


<!-- ================= ARTIKEL ================= -->
<?php
$artikel_pages = [
  'artikel.php','artikel-tambah.php','artikel-edit.php',
  'artikel-detail.php','artikel-hapus.php'
];
?>

<?php if(akses('artikel')): ?>
<li>
  <a href="artikel.php"
     class="<?= in_array($current,$artikel_pages)?'active':'' ?>">
    <i class="fa-solid fa-newspaper icon"></i>
    <span>Artikel</span>
  </a>
</li>
<?php endif; ?>


<!-- ================= PESAN ================= -->
<?php
$pesan_pages = ['pesan.php','pesan-detail.php','pesan-hapus.php'];
?>

<?php if(akses('pesan')): ?>
<li>
  <a href="pesan.php"
     class="<?= in_array($current,$pesan_pages)?'active':'' ?>">
    <i class="fa-solid fa-comments icon"></i>
    <span>Pesan</span>
  </a>
</li>
<?php endif; ?>


<!-- ================= SIMULASI ================= -->
<?php
$simulasi_pages = ['simulasi.php','simulasi-detail.php','simulasi-hapus.php'];
?>

<?php if(akses('simulasi')): ?>
<li>
  <a href="simulasi.php"
     class="<?= in_array($current,$simulasi_pages)?'active':'' ?>">
    <i class="fa-solid fa-calculator icon"></i>
    <span>Simulasi Kredit</span>
  </a>
</li>
<?php endif; ?>


<!-- ================= USER ADMIN ================= -->
<?php
$admin_pages = [
  'admin.php','admin-tambah.php','admin-edit.php',
  'admin-hapus.php'
];
?>

<?php if(akses('user')): ?>
<li>
  <a href="admin.php"
     class="<?= in_array($current,$admin_pages)?'active':'' ?>">
    <i class="fa-solid fa-users-gear icon"></i>
    <span>User Admin</span>
  </a>
</li>
<?php endif; ?>


<!-- ================= LEADS ================= -->
<?php if(akses('leads')): ?>
<li>
  <a href="leads.php"
     class="<?= $current=='leads.php'?'active':'' ?>">
    <i class="fa-solid fa-user-plus icon"></i>
    <span>Leads Customer</span>
  </a>
</li>
<?php endif; ?>


<!-- ================= SALES ================= -->
<?php if(akses('sales')): ?>
<li>
  <a href="sales_activity.php"
     class="<?= $current=='sales_activity.php'?'active':'' ?>">
    <i class="fa-solid fa-chart-line icon"></i>
    <span>Sales Activity</span>
  </a>
</li>
<?php endif; ?>


<!-- ================= STOCK ================= -->
<?php if(akses('stock')): ?>
<li>
  <a href="stock.php"
     class="<?= $current=='stock.php'?'active':'' ?>">
    <i class="fa-solid fa-warehouse icon"></i>
    <span>Stock Unit</span>
  </a>
</li>
<?php endif; ?>


<!-- ================= DELIVERY ================= -->
<?php if(akses('delivery')): ?>
<li>
  <a href="delivery.php"
     class="<?= $current=='delivery.php'?'active':'' ?>">
    <i class="fa-solid fa-truck-ramp-box icon"></i>
    <span>Delivery Order</span>
  </a>
</li>
<?php endif; ?>


</ul>

</div>

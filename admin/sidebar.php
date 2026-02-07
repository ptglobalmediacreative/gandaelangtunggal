<?php
$current = basename($_SERVER['PHP_SELF']);

/* DATA AKSES DARI SESSION */
$akses = [
  'dashboard' => $_SESSION['akses_dashboard'] ?? 0,
  'produk'    => $_SESSION['akses_produk'] ?? 0,
  'artikel'   => $_SESSION['akses_artikel'] ?? 0,
  'pesan'     => $_SESSION['akses_pesan'] ?? 0,
  'simulasi'  => $_SESSION['akses_simulasi'] ?? 0,
  'user'      => $_SESSION['akses_user'] ?? 0,
  'leads'     => $_SESSION['akses_leads'] ?? 0,
  'sales'     => $_SESSION['akses_sales'] ?? 0,
  'stock'     => $_SESSION['akses_stock'] ?? 0,
  'delivery'  => $_SESSION['akses_delivery'] ?? 0,
];

/* GROUP PAGE */
$produk_pages = ['produk.php','produk-tambah.php','produk-edit.php','produk-detail.php','produk-hapus.php'];
$artikel_pages = ['artikel.php','artikel-tambah.php','artikel-edit.php','artikel-detail.php','artikel-hapus.php'];
$pesan_pages = ['pesan.php','pesan-detail.php','pesan-hapus.php'];
$simulasi_pages = ['simulasi.php','simulasi-detail.php','simulasi-hapus.php'];
?>

<div class="sidebar">

<!-- BRAND -->
<div class="sidebar-brand">
  <img src="../images/logo.webp" alt="Logo">
  <span>Admin Panel</span>
</div>

<ul class="sidebar-menu">

<!-- DASHBOARD -->
<?php if($akses['dashboard']): ?>
<li>
  <a href="dashboard.php"
     class="<?= $current=='dashboard.php'?'active':'' ?>">

    <i class="fa-solid fa-house icon"></i>
    <span>Dashboard</span>

  </a>
</li>
<?php endif; ?>


<!-- PRODUK -->
<?php if($akses['produk']): ?>
<li>
  <a href="produk.php"
     class="<?= in_array($current,$produk_pages)?'active':'' ?>">

    <i class="fa-solid fa-truck-moving icon"></i>
    <span>Produk</span>

  </a>
</li>
<?php endif; ?>


<!-- ARTIKEL -->
<?php if($akses['artikel']): ?>
<li>
  <a href="artikel.php"
     class="<?= in_array($current,$artikel_pages)?'active':'' ?>">

    <i class="fa-solid fa-newspaper icon"></i>
    <span>Artikel</span>

  </a>
</li>
<?php endif; ?>


<!-- PESAN -->
<?php if($akses['pesan']): ?>
<li>
  <a href="pesan.php"
     class="<?= in_array($current,$pesan_pages)?'active':'' ?>">

    <i class="fa-solid fa-comments icon"></i>
    <span>Pesan</span>

  </a>
</li>
<?php endif; ?>


<!-- SIMULASI -->
<?php if($akses['simulasi']): ?>
<li>
  <a href="simulasi.php"
     class="<?= in_array($current,$simulasi_pages)?'active':'' ?>">

    <i class="fa-solid fa-calculator icon"></i>
    <span>Simulasi Kredit</span>

  </a>
</li>
<?php endif; ?>


<!-- USER ADMIN -->
<?php if($akses['user']): ?>
<li>
  <a href="admin.php"
     class="<?= $current=='admin.php'?'active':'' ?>">

    <i class="fa-solid fa-users-gear icon"></i>
    <span>User Admin</span>

  </a>
</li>
<?php endif; ?>


<!-- LEADS -->
<?php if($akses['leads']): ?>
<li>
  <a href="leads.php"
     class="<?= $current=='leads.php'?'active':'' ?>">

    <i class="fa-solid fa-user-plus icon"></i>
    <span>Leads Customer</span>

  </a>
</li>
<?php endif; ?>


<!-- SALES -->
<?php if($akses['sales']): ?>
<li>
  <a href="sales_activity.php"
     class="<?= $current=='sales_activity.php'?'active':'' ?>">

    <i class="fa-solid fa-chart-line icon"></i>
    <span>Sales Activity</span>

  </a>
</li>
<?php endif; ?>


<!-- STOCK -->
<?php if($akses['stock']): ?>
<li>
  <a href="stock.php"
     class="<?= $current=='stock.php'?'active':'' ?>">

    <i class="fa-solid fa-warehouse icon"></i>
    <span>Stock Unit</span>

  </a>
</li>
<?php endif; ?>


<!-- DELIVERY -->
<?php if($akses['delivery']): ?>
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

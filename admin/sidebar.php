<?php
$current = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar">

  <!-- Logo & Brand -->
  <div class="sidebar-brand">
    <img src="../images/logo.webp" alt="Logo Ganda Elang Tangguh">
    <span>Admin Panel</span>
  </div>

  <!-- Menu -->
  <ul class="sidebar-menu">

    <!-- Dashboard -->
    <li>
      <a href="dashboard.php" class="<?= $current=='dashboard.php'?'active':'' ?>">
        <i class="fa-solid fa-house icon"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <!-- Produk -->
    <?php
    $produk_pages = [
      'produk.php',
      'produk-tambah.php',
      'produk-edit.php',
      'produk-detail.php',
      'produk-hapus.php'
    ];
    ?>

    <li>
      <a href="produk.php"
        class="<?= in_array($current, $produk_pages) ? 'active' : '' ?>">

        <i class="fa-solid fa-truck-moving icon"></i>
        <span>Produk</span>

      </a>
    </li>


    <!-- Artikel -->
    <?php
    $artikel_pages = [
      'artikel.php',
      'artikel-tambah.php',
      'artikel-edit.php',
      'artikel-detail.php',
      'artikel-hapus.php'
    ];
    ?>

    <li>
      <a href="artikel.php"
        class="<?= in_array($current, $artikel_pages) ? 'active' : '' ?>">

        <i class="fa-solid fa-newspaper icon"></i>
        <span>Artikel</span>

      </a>
    </li>

    <!-- Pesan -->
    <?php
    $pesan_pages = [
      'pesan.php',
      'pesan-detail.php',
      'pesan-hapus.php'
    ];
    ?>

    <li>
      <a href="pesan.php"
        class="<?= in_array($current, $pesan_pages) ? 'active' : '' ?>">

        <i class="fa-solid fa-comments icon"></i>
        <span>Pesan</span>

      </a>
    </li>

    <!-- Simulasi -->
    <?php
    $simulasi_pages = [
      'simulasi.php',
      'simulasi-detail.php',
      'simulasi-hapus.php'
    ];
    ?>

    <li>
      <a href="simulasi.php"
        class="<?= in_array($current, $simulasi_pages) ? 'active' : '' ?>">

        <i class="fa-solid fa-calculator icon"></i>
        <span>Simulasi Kredit</span>

      </a>
    </li>

    <!-- User Admin -->
    <li>
      <a href="user_admin.php" class="<?= $current=='user_admin.php'?'active':'' ?>">
        <i class="fa-solid fa-users-gear icon"></i>
        <span>User Admin</span>
      </a>
    </li>

    <!-- Leads -->
    <li>
      <a href="leads.php" class="<?= $current=='leads.php'?'active':'' ?>">
        <i class="fa-solid fa-user-plus icon"></i>
        <span>Leads Customer</span>
      </a>
    </li>

    <!-- Sales Activity -->
    <li>
      <a href="sales_activity.php" class="<?= $current=='sales_activity.php'?'active':'' ?>">
        <i class="fa-solid fa-chart-line icon"></i>
        <span>Sales Activity</span>
      </a>
    </li>

    <!-- Stock -->
    <li>
      <a href="stock.php" class="<?= $current=='stock.php'?'active':'' ?>">
        <i class="fa-solid fa-warehouse icon"></i>
        <span>Stock Unit</span>
      </a>
    </li>

    <!-- Delivery -->
    <li>
      <a href="delivery.php" class="<?= $current=='delivery.php'?'active':'' ?>">
        <i class="fa-solid fa-truck-ramp-box icon"></i>
        <span>Delivery Order</span>
      </a>
    </li>

  </ul>

</div>

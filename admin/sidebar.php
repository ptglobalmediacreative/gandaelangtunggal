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

    <li>
      <a href="dashboard.php" class="<?= $current=='dashboard.php'?'active':'' ?>">
        <span class="icon">🏠</span>
        <span>Dashboard</span>
      </a>
    </li>

    <li>
      <a href="produk.php" class="<?= $current=='produk.php'?'active':'' ?>">
        <span class="icon">📦</span>
        <span>Produk</span>
      </a>
    </li>

    <li>
      <a href="artikel.php" class="<?= $current=='artikel.php'?'active':'' ?>">
        <span class="icon">📝</span>
        <span>Artikel</span>
      </a>
    </li>

    <li>
      <a href="pesan.php" class="<?= $current=='pesan.php'?'active':'' ?>">
        <span class="icon">💬</span>
        <span>Pesan</span>
      </a>
    </li>

    <li>
      <a href="simulasi.php" class="<?= $current=='simulasi.php'?'active':'' ?>">
        <span class="icon">💰</span>
        <span>Simulasi Kredit</span>
      </a>
    </li>

  </ul>

</div>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<div class="main-content">

  <!-- Topbar -->
  <div class="topbar">
    <h2>Dashboard</h2>

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

  <!-- Hero -->
  <div class="dashboard-hero">
    <div class="hero-text">
      <h3>Dealer Management System</h3>
      <p>
        Sistem terpadu untuk mengelola penjualan,
        stok, pembiayaan, dan komunikasi customer
        PT Ganda Elang Tangguh.
      </p>
    </div>

    <div class="hero-icon">
      <i class="fa-solid fa-tractor"></i>
    </div>
  </div>

  <!-- Stats -->
  <div class="dashboard-stats">

    <div class="stat-box">
      <i class="fa-solid fa-box stat-icon"></i>
      <div>
        <span>Total Produk</span>
        <h4>128</h4>
      </div>
    </div>

    <div class="stat-box">
      <i class="fa-solid fa-warehouse stat-icon"></i>
      <div>
        <span>Stok Gudang</span>
        <h4>86</h4>
      </div>
    </div>

    <div class="stat-box">
      <i class="fa-solid fa-comments stat-icon"></i>
      <div>
        <span>Pesan Masuk</span>
        <h4>24</h4>
      </div>
    </div>

    <div class="stat-box">
      <i class="fa-solid fa-calculator stat-icon"></i>
      <div>
        <span>Simulasi Kredit</span>
        <h4>52</h4>
      </div>
    </div>

  </div>

<!-- Control Panel -->
<div class="dashboard-grid">

  <!-- Performance -->
  <div class="card dashboard-panel">

    <h3>Ringkasan Penjualan</h3>

    <div class="panel-row">
      <span>Unit Terjual Bulan Ini</span>
      <strong>14 Unit</strong>
    </div>

    <div class="panel-row">
      <span>Total Revenue</span>
      <strong>Rp 4.2 M</strong>
    </div>

    <div class="panel-row">
      <span>Deal Kredit Aktif</span>
      <strong>9 Kontrak</strong>
    </div>

    <div class="panel-row">
      <span>Prospek Baru</span>
      <strong>21 Lead</strong>
    </div>

  </div>

  <!-- Inventory -->
  <div class="card dashboard-panel">

    <h3>Status Unit & Stok</h3>

    <div class="panel-row">
      <span>Ready Stock</span>
      <strong>48 Unit</strong>
    </div>

    <div class="panel-row">
      <span>Indent / PO</span>
      <strong>22 Unit</strong>
    </div>

    <div class="panel-row">
      <span>Dalam Pengiriman</span>
      <strong>16 Unit</strong>
    </div>

    <div class="panel-row">
      <span>Maintenance</span>
      <strong>6 Unit</strong>
    </div>

  </div>

</div>

</div>
</body>
</html>

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
        stok, pembiayaan, dan komunikasi pelanggan
        dealer alat berat LiuGong.
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

  <!-- Content Grid -->
  <div class="dashboard-grid">

    <!-- Company -->
    <div class="card company-card">
      <h3>Profil Perusahaan</h3>

      <p>
        Dealer resmi alat berat LiuGong yang
        menyediakan unit baru, sparepart,
        pembiayaan, dan layanan purna jual.
      </p>

      <ul>
        <li><i class="fa-solid fa-check"></i> Distributor Resmi</li>
        <li><i class="fa-solid fa-check"></i> Unit Baru & Bekas</li>
        <li><i class="fa-solid fa-check"></i> Sparepart Original</li>
        <li><i class="fa-solid fa-check"></i> Service Center</li>
      </ul>
    </div>

    <!-- Activity -->
    <div class="card activity-card">
      <h3>Aktivitas Terbaru</h3>

      <div class="activity-item">
        <i class="fa-solid fa-box"></i>
        Produk baru ditambahkan
      </div>

      <div class="activity-item">
        <i class="fa-solid fa-comments"></i>
        Pesan baru dari pelanggan
      </div>

      <div class="activity-item">
        <i class="fa-solid fa-calculator"></i>
        Simulasi kredit dibuat
      </div>

      <div class="activity-item">
        <i class="fa-solid fa-newspaper"></i>
        Artikel diperbarui
      </div>

      <div class="activity-item">
        <i class="fa-solid fa-tractor"></i>
        Update data unit
      </div>

    </div>

  </div>

</div>

</div>
</body>
</html>

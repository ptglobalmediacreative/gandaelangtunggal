<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<div class="main-content">

  <!-- Topbar -->
  <div class="topbar">
    <h2>Dashboard</h2>
    <a href="logout.php" class="logout-btn">Logout</a>
  </div>

  <!-- Welcome -->
  <div class="card" style="margin-bottom:20px;">
    <h3>Selamat Datang 👋</h3>
    <p>
      Halo, <strong><?= $_SESSION['admin_nama']; ?></strong>.  
      Selamat datang di sistem manajemen Dealer Alat Berat.
    </p>
  </div>

  <!-- Statistik -->
  <div class="dashboard-stats">

    <div class="stat-box">
      <div class="stat-icon">🚜</div>
      <div class="stat-info">
        <h4>Total Produk</h4>
        <p>128 Unit</p>
      </div>
    </div>

    <div class="stat-box">
      <div class="stat-icon">📦</div>
      <div class="stat-info">
        <h4>Stok Gudang</h4>
        <p>86 Unit</p>
      </div>
    </div>

    <div class="stat-box">
      <div class="stat-icon">💬</div>
      <div class="stat-info">
        <h4>Pesan Masuk</h4>
        <p>24 Pesan</p>
      </div>
    </div>

    <div class="stat-box">
      <div class="stat-icon">💰</div>
      <div class="stat-info">
        <h4>Simulasi Kredit</h4>
        <p>52 Data</p>
      </div>
    </div>

  </div>

  <!-- Informasi Perusahaan -->
  <div class="dashboard-grid">

    <!-- Profil -->
    <div class="card">
      <h3>Profil Perusahaan</h3>
      <p>
        Sistem ini digunakan untuk mengelola penjualan, stok,
        artikel, pesan pelanggan, dan simulasi kredit
        dealer alat berat LiuGong.
      </p>

      <ul class="info-list">
        <li>✔ Distributor Resmi</li>
        <li>✔ Unit Baru & Bekas</li>
        <li>✔ Sparepart Original</li>
        <li>✔ Service Center</li>
      </ul>
    </div>

    <!-- Aktivitas -->
    <div class="card">
      <h3>Aktivitas Terbaru</h3>

      <ul class="activity-list">
        <li>📦 Produk baru ditambahkan</li>
        <li>💬 Pesan baru dari pelanggan</li>
        <li>💰 Simulasi kredit dibuat</li>
        <li>📝 Artikel diperbarui</li>
        <li>🚜 Update data unit</li>
      </ul>

    </div>

  </div>

</div>

</div>
</body>
</html>

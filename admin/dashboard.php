<?php
require_once "auth.php";
require_once "config.php";

/* CEK AKSES */
if(!cekAkses('dashboard')){
    die("Akses ditolak!");
}

/* ================= HITUNG DATA ================= */

/* Total Produk */
$total_produk = $pdo->query("SELECT COUNT(*) FROM produk")->fetchColumn();

/* Total Pesan */
$total_pesan = $pdo->query("SELECT COUNT(*) FROM pesan")->fetchColumn();

/* Total Simulasi - menggunakan tabel simulasi */
$total_simulasi = $pdo->query("SELECT COUNT(*) FROM simulasi")->fetchColumn();

/* Total Komentar */
$total_komentar = $pdo->query("SELECT COUNT(*) FROM komentar")->fetchColumn();

/* ================= GRAFIK SIMULASI PER BULAN ================= */
// Menggunakan data dari tabel simulasi untuk grafik

$chartData = array_fill(1,12,0);

// Cek apakah ada kolom tanggal di tabel simulasi
// Asumsikan ada kolom created_at atau tanggal
try {
    $stmt = $pdo->query("
        SELECT 
            MONTH(created_at) AS bulan,
            COUNT(*) AS total
        FROM simulasi
        WHERE YEAR(created_at) = YEAR(CURDATE())
        GROUP BY MONTH(created_at)
    ");
    
    while($row = $stmt->fetch()){
        $chartData[(int)$row['bulan']] = (int)$row['total'];
    }
} catch (PDOException $e) {
    // Jika kolom created_at tidak ada, coba pakai kolom lain atau kosongkan grafik
    $chartData = array_fill(1,12,0);
}

$chartJson = json_encode(array_values($chartData));

?>

<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<div class="main-content">

<!-- TOPBAR -->
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


<!-- HERO -->
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


<!-- STATS -->
<div class="dashboard-stats">

  <!-- Produk -->
  <div class="stat-box">
    <i class="fa-solid fa-box stat-icon"></i>
    <div>
      <span>Total Produk</span>
      <h4><?= $total_produk ?></h4>
    </div>
  </div>

  <!-- Pesan -->
  <div class="stat-box">
    <i class="fa-solid fa-comments stat-icon"></i>
    <div>
      <span>Pesan Masuk</span>
      <h4><?= $total_pesan ?></h4>
    </div>
  </div>

  <!-- Simulasi -->
  <div class="stat-box">
    <i class="fa-solid fa-calculator stat-icon"></i>
    <div>
      <span>Simulasi Kredit</span>
      <h4><?= $total_simulasi ?></h4>
    </div>
  </div>

  <!-- Komentar -->
  <div class="stat-box">
    <i class="fa-solid fa-star stat-icon"></i>
    <div>
      <span>Total Komentar</span>
      <h4><?= $total_komentar ?></h4>
    </div>
  </div>

</div>


<!-- CHART -->
<div class="dashboard-charts">

  <div class="card chart-card">

    <h3>Simulasi Kredit Bulanan (<?= date('Y') ?>)</h3>

    <canvas id="salesChart"></canvas>

  </div>

</div>

</div>


<!-- ================= CHART SCRIPT ================= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const salesCtx = document.getElementById('salesChart');

const salesData = <?= $chartJson ?>;

new Chart(salesCtx, {

  type: 'line',

  data: {

    labels: [
      'Jan','Feb','Mar','Apr','Mei','Jun',
      'Jul','Agu','Sep','Okt','Nov','Des'
    ],

    datasets: [{

      label: 'Total Simulasi',

      data: salesData,

      borderColor: '#2563eb',

      backgroundColor: 'rgba(37,99,235,0.2)',

      tension: 0.4,

      fill: true

    }]

  },

  options: {

    responsive: true,

    plugins: {
      legend: { display: false }
    },

    scales: {

      y: {
        beginAtZero: true,
        ticks: {
          precision: 0
        }
      }

    }

  }

});

</script>

</body>
</html>
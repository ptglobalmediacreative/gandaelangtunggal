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

/* Total Simulasi */
$total_simulasi = $pdo->query("SELECT COUNT(*) FROM simulasi")->fetchColumn();

/* Total Delivery */
$total_delivery = $pdo->query("SELECT COUNT(*) FROM delivery_orders")->fetchColumn();


/* ================= GRAFIK DELIVERY PER BULAN ================= */

$chartData = array_fill(1,12,0);

$stmt = $pdo->query("
    SELECT 
        MONTH(tanggal_kirim) AS bulan,
        COUNT(*) AS total
    FROM delivery_orders
    WHERE YEAR(tanggal_kirim) = YEAR(CURDATE())
    GROUP BY MONTH(tanggal_kirim)
");

while($row = $stmt->fetch()){
    $chartData[(int)$row['bulan']] = (int)$row['total'];
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

  <!-- Delivery -->
  <div class="stat-box">
    <i class="fa-solid fa-truck stat-icon"></i>
    <div>
      <span>Delivery Order</span>
      <h4><?= $total_delivery ?></h4>
    </div>
  </div>

</div>


<!-- CHART -->
<div class="dashboard-charts">

  <div class="card chart-card">

    <h3>Delivery Order Bulanan (<?= date('Y') ?>)</h3>

    <canvas id="salesChart"></canvas>

  </div>

</div>

</div>


<!-- ================= CHART SCRIPT ================= -->
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

      label: 'Total Delivery',

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

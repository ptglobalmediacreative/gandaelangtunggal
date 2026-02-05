<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<div class="main-content">

  <div class="topbar">
    <h2>Dashboard</h2>
    <a href="logout.php" class="logout-btn">Logout</a>
  </div>

  <div class="card">
    <h3>Selamat Datang 👋</h3>
    <p>Halo, <?= $_SESSION['admin_nama']; ?>. Anda berhasil login.</p>
  </div>

</div>

</div>
</body>
</html>

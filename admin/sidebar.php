<?php
$current = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar">
  <h3>Admin Panel</h3>

  <ul>

    <li>
      <a href="dashboard.php" class="<?= $current=='dashboard.php'?'active':'' ?>">
        Dashboard
      </a>
    </li>

    <li>
      <a href="produk.php" class="<?= $current=='produk.php'?'active':'' ?>">
        Produk
      </a>
    </li>

    <li>
      <a href="artikel.php" class="<?= $current=='artikel.php'?'active':'' ?>">
        Artikel
      </a>
    </li>

    <li>
      <a href="pesan.php" class="<?= $current=='pesan.php'?'active':'' ?>">
        Pesan
      </a>
    </li>

    <li>
      <a href="simulasi.php" class="<?= $current=='simulasi.php'?'active':'' ?>">
        Simulasi Kredit
      </a>
    </li>

  </ul>
</div>

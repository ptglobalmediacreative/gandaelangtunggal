<?php
require_once __DIR__ . "/admin/config.php";

$stmt = $pdo->prepare("
    SELECT judul, slug, deskripsi, gambar, created_at
    FROM artikel
    ORDER BY created_at DESC
    LIMIT 3
");
$stmt->execute();
$artikel = $stmt->fetchAll();
?>

<?php include "header.php"; ?>

<!-- ================= HERO ================= -->
<section class="hero">

    <!-- Video Wrapper -->
    <div class="hero-video-wrapper">

    <video
      class="hero-video"
      autoplay
      muted
      loop
      playsinline
      webkit-playsinline
      preload="auto"
    >
      <source src="/images/video/vidhero.mp4" type="video/mp4">
    </video>

    </div>

    <!-- Content -->
    <div class="hero-content">

        <h1>PT Ganda Elang Tangguh</h1>
        <p>Solusi Alat Berat Profesional di Indonesia</p>

        <div class="hero-buttons">
            <a href="/produk.php" class="btn-primary">Lihat Produk</a>
            <a href="/contact.php" class="btn-secondary">Hubungi Kami</a>
        </div>

    </div>

</section>

<!-- ================= ABOUT SUMMARY ================= -->
<section class="about-summary">

  <div class="about-container">

    <h2 class="about-title">
      Sekilas Tentang PT Ganda Elang Tangguh
    </h2>

    <p class="about-text">
      PT Ganda Elang Tangguh merupakan dealer alat berat yang terpercaya
      dan berpengalaman dalam menyediakan solusi lengkap untuk kebutuhan
      industri. Dengan komitmen tinggi terhadap kualitas dan kepuasan
      pelanggan, kami terus membangun reputasi sebagai mitra bisnis yang
      andal di Indonesia.
    </p>

    <p class="about-text">
      Kami menyediakan berbagai produk alat berat berkualitas tinggi
      dari produsen terkemuka, seperti excavator, bulldozer, wheel loader,
      motor grader, serta berbagai unit pendukung lainnya. Seluruh produk
      kami dipilih secara selektif untuk menjamin performa, daya tahan,
      dan efisiensi kerja.
    </p>

    <p class="about-text">
      Didukung oleh tim profesional dan teknisi berpengalaman,
      PT Ganda Elang Tangguh juga menyediakan layanan purna jual,
      suku cadang asli, serta perawatan berkala untuk memastikan
      operasional pelanggan tetap optimal dan produktif.
    </p>

    <a href="#" class="about-link">
      → Selengkapnya Tentang Kami
    </a>

  </div>

</section>

<!-- ================= WHY US SECTION ================= -->
<section class="why-us">

  <div class="why-bg"></div>

  <div class="why-container">

    <div class="why-title">
      <h2>Kenapa Memilih Kami</h2>
      <p>Layanan Profesional & Terpercaya</p>
    </div>

    <div class="why-cards">

      <div class="why-card">
        <div class="why-icon">
          <i class="fa-solid fa-clock"></i>
        </div>
        <h3>Tepat Waktu</h3>
        <p>
          Kami selalu menjunjung tinggi profesionalisme
          dalam melayani pelanggan dengan ketepatan waktu.
        </p>
      </div>

      <div class="why-card">
        <div class="why-icon">
          <i class="fa-solid fa-tags"></i>
        </div>
        <h3>Harga Kompetitif</h3>
        <p>
          Memberikan solusi terbaik dengan harga yang
          kompetitif dan transparan sesuai kebutuhan proyek Anda.
        </p>
      </div>

      <div class="why-card">
        <div class="why-icon">
          <i class="fa-solid fa-award"></i>
        </div>
        <h3>Kualitas Terjamin</h3>
        <p>
          Seluruh unit alat berat dipilih secara selektif
          untuk memastikan performa dan daya tahan optimal.
        </p>
      </div>

      <div class="why-card">
        <div class="why-icon">
          <i class="fa-solid fa-headset"></i>
        </div>
        <h3>Pelayanan Profesional</h3>
        <p>
          Didukung oleh tim berpengalaman yang siap
          memberikan layanan cepat dan responsif.
        </p>
      </div>

    </div>

  </div>

</section>

<!-- ================= SERVICE SUPPORT ================= -->
<section class="service-support">

  <div class="service-container">

    <!-- LEFT -->
    <div class="service-left fade-up">

      <h2>
        OPTIMALKAN KINERJA ALAT BERAT
        DENGAN LAYANAN DAN DUKUNGAN
        TERBAIK
      </h2>

      <p>
        PT Ganda Elang Tangguh menghadirkan layanan purna jual terbaik
        untuk memastikan setiap pelanggan mendapatkan pengalaman
        bisnis maksimal.
      </p>

    </div>

    <!-- LINE -->
    <div class="service-line"></div>

    <!-- RIGHT -->
    <div class="service-right">

      <!-- Card 1 -->
      <div class="service-card fade-up">

        <div class="service-icon">
          <i class="fa-solid fa-gear"></i>
        </div>

        <h3>Suku Cadang</h3>

        <p>
          Kami menyediakan suku cadang asli
          untuk menjaga performa dan keandalan
          alat berat pelanggan.
        </p>

        <a href="#">Lebih Lanjut →</a>

      </div>

      <!-- Card 2 -->
      <div class="service-card fade-up">

        <div class="service-icon">
          <i class="fa-solid fa-chalkboard-user"></i>
        </div>

        <h3>Training</h3>

        <p>
          Kami menyediakan pelatihan khusus seputar alat berat Liu Gong.
        </p>

        <a href="#">Lebih Lanjut →</a>

      </div>

      <!-- Card 3 -->
      <div class="service-card fade-up">

        <div class="service-icon">
          <i class="fa-solid fa-screwdriver-wrench"></i>
        </div>

        <h3>Service Program</h3>

        <p>
          Berbagai layanan perawatan untuk memastikan
          alat berat selalu optimal dan minim downtime.
        </p>

        <a href="#">Lebih Lanjut →</a>

      </div>

    </div>

  </div>

</section>

<!-- ================= BLOG SECTION ================= -->
<section class="home-blog">

  <div class="container">

    <!-- Title -->
    <div class="blog-header" style="text-align:center; margin-bottom:50px;">
      <h2>Blog & Artikel Terbaru</h2>
      <p>Informasi, tips, dan berita terbaru seputar alat berat & industri</p>
    </div>

    <div class="blog-grid">

      <?php if (!empty($artikel)): ?>
        <?php foreach ($artikel as $row): ?>

        <div class="blog-post">

          <a href="/artikel/<?= htmlspecialchars($row['slug']) ?>">
            <?php if (!empty($row['gambar'])): ?>
              <img src="/images/uploads/artikel/<?= htmlspecialchars($row['gambar']) ?>"
                   alt="<?= htmlspecialchars($row['judul']) ?>"
                   loading="lazy">
            <?php else: ?>
              <img src="/images/hero.jpg" alt="Default Image">
            <?php endif; ?>
          </a>

          <div class="blog-content">

            <span class="blog-date">
              <i class="fa fa-calendar"></i>
              <?= date('d M Y', strtotime($row['created_at'])) ?>
            </span>

            <h2>
              <a href="/artikel/<?= htmlspecialchars($row['slug']) ?>">
                <?= htmlspecialchars($row['judul']) ?>
              </a>
            </h2>

            <p>
              <?= mb_substr(strip_tags($row['deskripsi']), 0, 120) ?>...
            </p>

            <a href="/artikel/<?= htmlspecialchars($row['slug']) ?>" class="read-more">
              Baca Selengkapnya
            </a>

          </div>

        </div>

        <?php endforeach; ?>
      <?php else: ?>
        <p style="text-align:center;">Belum ada artikel tersedia.</p>
      <?php endif; ?>

    </div>

    <!-- Button -->
    <div style="text-align:center; margin-top:50px;">
      <a href="/blog.php" class="btn-primary">
        Lihat Semua Artikel
      </a>
    </div>

  </div>

</section>

<?php include "footer.php"; ?>

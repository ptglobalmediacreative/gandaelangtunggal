<?php
require_once __DIR__ . "/admin/config.php";

$stmt = $pdo->prepare("
    SELECT judul, slug, deskripsi, gambar, created_at
    FROM artikel
    ORDER BY created_at DESC
    LIMIT 3
");
$stmt->execute();
$latestArtikel = $stmt->fetchAll();
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

        <h1>PT Ganda Elang Tangguh | Dealer Resmi LiuGong Machinery Indonesia</h1>
        <p>Dealer Resmi Alat Berat China LiuGong Indonesia</p>

        <div class="hero-buttons">
            <a href="/produk" class="btn-primary">Lihat Produk</a>
            <a href="/contact" class="btn-secondary">Hubungi Kami</a>
        </div>

    </div>

</section>

<!-- ================= ABOUT SUMMARY ================= -->
<section class="about-summary reveal">

  <div class="about-container">

    <h2 class="about-title">
      Sekilas Tentang PT Ganda Elang Tangguh | Dealer Resmi LiuGong Machinery Indonesia
    </h2>

    <p class="about-text">
      PT Ganda Elang Tangguh</strong> adalah <strong>dealer resmi LiuGong di Indonesia</strong> yang terpercaya dan berpengalaman dalam menyediakan <strong>alat berat China LiuGong</strong> berkualitas untuk industri konstruksi, pertambangan, dan infrastruktur.
    </p>

    <p class="about-text">
      Sebagai <strong>dealer LiuGong Jakarta</strong> dan seluruh Indonesia, kami menyediakan berbagai <strong>alat berat China LiuGong</strong> unggulan seperti wheel loader, excavator, motor grader, compactor, serta unit pendukung lainnya. Seluruh produk <strong>LiuGong</strong> dijamin performa, daya tahan, dan efisiensi kerja tinggi.
    </p>

    <p class="about-text">
      Didukung tim profesional dan teknisi berpengalaman, <strong>PT Ganda Elang Tangguh dealer LiuGong Indonesia</strong> juga menyediakan layanan purna jual lengkap, <strong>sparepart asli LiuGong</strong>, serta perawatan berkala agar operasional pelanggan tetap optimal dan produktif.
    </p>

    <a href="/about" class="about-link">
      Selengkapnya Tentang Kami
    </a>

  </div>

</section>

<!-- ================= WHY US SECTION ================= -->
<section class="why-us reveal">

  <div class="why-bg"></div>

  <div class="why-container">

    <div class="why-title">
      <h2>Kenapa Memilih Kami</h2>
      <p>Layanan Profesional & Terpercaya</p>
    </div>

    <div class="why-cards">

      <div class="why-card reveal-scale">
        <div class="why-icon">
          <i class="fa-solid fa-clock"></i>
        </div>
        <h3>Tepat Waktu</h3>
        <p>
          Kami selalu menjunjung tinggi profesionalisme
          dalam melayani pelanggan dengan ketepatan waktu.
        </p>
      </div>

      <div class="why-card reveal-scale">
        <div class="why-icon">
          <i class="fa-solid fa-tags"></i>
        </div>
        <h3>Harga Kompetitif</h3>
        <p>
          Memberikan solusi terbaik dengan harga yang
          kompetitif dan transparan sesuai kebutuhan proyek Anda.
        </p>
      </div>

      <div class="why-card reveal-scale">
        <div class="why-icon">
          <i class="fa-solid fa-award"></i>
        </div>
        <h3>Kualitas Terjamin</h3>
        <p>
          Seluruh unit alat berat China dipilih secara selektif
          untuk memastikan performa dan daya tahan optimal.
        </p>
      </div>

      <div class="why-card reveal-scale">
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
    <div class="service-left reveal-left">

      <h2>
        OPTIMALKAN KINERJA ALAT BERAT
        DENGAN LAYANAN DAN DUKUNGAN
        TERBAIK
      </h2>

      <p>
        PT Ganda Elang Tangguh sebagai dealer resmi LiuGong Machinery Indonesia menghadirkan layanan purna jual terbaik
        untuk memastikan setiap pelanggan mendapatkan pengalaman
        bisnis maksimal.
      </p>

    </div>

    <!-- LINE -->
    <div class="service-line"></div>

    <!-- RIGHT -->
    <div class="service-card reveal-scale">

      <!-- Card 1 -->
      <div class="service-card fade-up">

        <div class="service-icon">
          <i class="fa-solid fa-gear"></i>
        </div>

        <h3>Sparepart Asli LiuGong</h3>

        <p>
          PT Ganda Elang Tangguh dealer LiuGong Indonesia</strong> menyediakan <strong>sparepart asli LiuGong</strong> lengkap untuk menjaga performa dan keandalan <strong>alat berat China LiuGong</strong> Anda.
        </p>

      </div>

      <!-- Card 2 -->
      <div class="service-card fade-up">

        <div class="service-icon">
          <i class="fa-solid fa-chalkboard-user"></i>
        </div>

        <h3>Training Operator</h3>

        <p>
          Kami menyediakan pelatihan khusus pengoperasian <strong>alat berat China LiuGong</strong> agar operator Anda terampil dan produktivitas kerja maksimal.
        </p>

      </div>

      <!-- Card 3 -->
      <div class="service-card fade-up">

        <div class="service-icon">
          <i class="fa-solid fa-screwdriver-wrench"></i>
        </div>

        <h3>Service Program</h3>

        <p>
          Layanan servis profesional dari <strong>dealer LiuGong Jakarta</strong> untuk memastikan <strong>alat berat China LiuGong</strong> selalu optimal, andal, dan minim downtime di lapangan.
        </p>

      </div>

    </div>

  </div>

</section>

<!-- ================= BLOG SECTION ================= -->
<section class="home-blog reveal">

  <div class="blog-container">

    <!-- Title -->
    <div class="blog-header fade-blog">
      <h2>Blog & Artikel Terbaru</h2>
      <p>Informasi, tips, dan berita terbaru seputar alat berat China & industri</p>
    </div>

    <!-- Blog Grid -->
    <div class="blog-grid">

      <?php if (!empty($latestArtikel)): ?>

        <?php foreach ($latestArtikel as $row): ?>

          <div class="blog-post reveal-scale">

            <!-- Image -->
            <a href="/artikel/<?= htmlspecialchars($row['slug']) ?>">
              <?php if (!empty($row['gambar'])): ?>
                <img 
                  src="/images/uploads/artikel/<?= htmlspecialchars($row['gambar']) ?>"
                  alt="<?= htmlspecialchars($row['judul']) ?>"
                  loading="lazy"
                >
              <?php else: ?>
                <img 
                  src="/images/hero.jpg" 
                  alt="Default Image"
                  loading="lazy"
                >
              <?php endif; ?>
            </a>

            <!-- Content -->
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

              <a 
                href="/artikel/<?= htmlspecialchars($row['slug']) ?>" 
                class="read-more"
              >
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
    <div class="blog-more fade-blog">
      <a href="/blog" class="btn-blog">
        Lihat Semua Artikel
      </a>
    </div>

  </div>

</section>

<?php include "footer.php"; ?>

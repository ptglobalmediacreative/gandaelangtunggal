<?php
// ================= DATABASE =================
require_once __DIR__ . '/admin/config.php';

// ================= GET PRODUCTS =================
$stmt = $pdo->prepare("
    SELECT 
        p.id,
        p.nama_produk,
        p.slug,
        p.gambar
    FROM produk p
    WHERE p.status = 'aktif'
      AND p.category_id = 1
    ORDER BY p.id DESC
");
$stmt->execute();
$products = $stmt->fetchAll();

// ================= FETCH SPECIFICATIONS FOR EACH PRODUCT =================
foreach ($products as &$product) {
    $spec_stmt = $pdo->prepare("
        SELECT label, nilai
        FROM produk_spesifikasi
        WHERE produk_id = ?
        ORDER BY grup, sort_order
        LIMIT 4
    ");
    $spec_stmt->execute([$product['id']]);
    $product['specifications'] = $spec_stmt->fetchAll();
}
unset($product);

$currentUrl = "https://gandaelang.co.id/wheelloader.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Wheel Loader LiuGong | Alat Berat Konstruksi & Pertambangan | PT Ganda Elang Tangguh</title>
    
    <meta name="description" content="PT Ganda Elang Tangguh jual Wheel Loader LiuGong berkualitas tinggi untuk konstruksi, pertambangan, dan material handling. Tersedia berbagai tipe wheel loader dengan performa unggul dan efisiensi bahan bakar terbaik. Dapatkan harga wheel loader terbaru disini!">
    
    <meta name="keywords" content="wheel loader, wheel loader liugong, alat berat wheel loader, harga wheel loader, wheel loader indonesia, loader alat berat, heavy equipment wheel loader, wheel loader untuk konstruksi, wheel loader pertambangan, alat berat indonesia, dealer liugong indonesia, wheel loader terbaik, spesifikasi wheel loader">
    
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    
    <meta name="author" content="PT Ganda Elang Tangguh">
    <meta name="geo.region" content="ID">
    <meta name="geo.placename" content="Jakarta, Indonesia">
    <meta name="language" content="id-ID">
    
    <link rel="canonical" href="<?= $currentUrl ?>">
    <link rel="alternate" hreflang="id" href="<?= $currentUrl ?>">
    <link rel="alternate" href="<?= $currentUrl ?>" hreflang="x-default">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="Wheel Loader LiuGong | Alat Berat untuk Konstruksi & Pertambangan | PT Ganda Elang Tangguh">
    <meta property="og:description" content="PT Ganda Elang Tangguh menyediakan Wheel Loader LiuGong terbaik untuk proyek konstruksi, pertambangan, dan material handling di Indonesia. Performa tangguh, efisien, dan tahan lama.">
    <meta property="og:image" content="https://gandaelang.co.id/images/wheelloader.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Wheel Loader LiuGong untuk konstruksi dan pertambangan">
    <meta property="og:url" content="<?= $currentUrl ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="PT Ganda Elang Tangguh">
    <meta property="og:locale" content="id_ID">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Wheel Loader LiuGong | Alat Berat Indonesia">
    <meta name="twitter:description" content="Wheel loader tangguh untuk proyek konstruksi dan pertambangan. Tersedia berbagai tipe dengan performa terbaik.">
    <meta name="twitter:image" content="https://gandaelang.co.id/images/wheelloader.jpg">
    <meta name="twitter:image:alt" content="Wheel Loader LiuGong">
    
    <!-- ================= SCHEMA MARKUP ================= -->
    <!-- Breadcrumb Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "Home",
                "item": "https://gandaelang.co.id/"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "Produk",
                "item": "https://gandaelang.co.id/produk.php"
            },
            {
                "@type": "ListItem",
                "position": 3,
                "name": "Wheel Loader LiuGong",
                "item": "https://gandaelang.co.id/wheelloader.php"
            }
        ]
    }
    </script>
    
    <!-- Organization Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "PT Ganda Elang Tangguh",
        "url": "https://gandaelang.co.id",
        "logo": "https://gandaelang.co.id/images/logo.webp",
        "description": "Dealer resmi alat berat LiuGong di Indonesia, menyediakan wheel loader, excavator, dan alat berat lainnya untuk konstruksi dan pertambangan.",
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "ID",
            "addressRegion": "Jakarta"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+62-823-5516-3745",
            "contactType": "customer service",
            "availableLanguage": ["Indonesian"]
        },
        "sameAs": [
            "https://www.facebook.com/gandaelangtangguh",
            "https://www.instagram.com/gandaelangtangguh"
        ]
    }
    </script>
    
    <!-- FAQ Schema (LENGKAP 6 PERTANYAAN) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {
                "@type": "Question",
                "name": "Apa keunggulan Wheel Loader LiuGong dibandingkan merek lain?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Wheel Loader LiuGong memiliki keunggulan seperti efisiensi bahan bakar tinggi, performa tangguh untuk berbagai medan, perawatan mudah, ketersediaan sparepart original terjamin, dan teknologi canggih yang dirancang untuk produktivitas maksimal di proyek konstruksi, pertambangan, dan perkebunan."
                }
            },
            {
                "@type": "Question",
                "name": "Berapa kapasitas angkut Wheel Loader LiuGong yang tersedia?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Wheel Loader LiuGong tersedia dalam berbagai kapasitas mulai dari 1.9m³ hingga 7.0m³ untuk bucket capacity, dengan operating weight dari 13.378kg hingga 52.100kg. Ukuran ini dapat disesuaikan dengan kebutuhan proyek Anda, mulai dari skala kecil hingga besar."
                }
            },
            {
                "@type": "Question",
                "name": "Apakah PT Ganda Elang Tangguh adalah dealer resmi LiuGong di Indonesia?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Ya, PT Ganda Elang Tangguh adalah dealer resmi alat berat LiuGong di Indonesia yang melayani penjualan unit baru, perawatan rutin, servis berkala, dan penyediaan sparepart original LiuGong dengan garansi resmi."
                }
            },
            {
                "@type": "Question",
                "name": "Industri apa saja yang cocok menggunakan Wheel Loader LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Wheel loader LiuGong sangat cocok untuk berbagai industri seperti konstruksi bangunan, pertambangan, perkebunan kelapa sawit, logistik dan pergudangan, serta proyek infrastruktur jalan dan jembatan. Fleksibilitasnya menjadikannya pilihan utama di berbagai sektor."
                }
            },
            {
                "@type": "Question",
                "name": "Bagaimana cara mendapatkan informasi harga wheel loader LiuGong terbaru?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Anda bisa menghubungi tim sales PT Ganda Elang Tangguh melalui halaman Kontak Kami, telepon, atau email untuk mendapatkan informasi harga wheel loader terbaru dan penawaran spesial sesuai kebutuhan proyek Anda."
                }
            },
            {
                "@type": "Question",
                "name": "Apakah tersedia layanan after-sales untuk wheel loader LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Tersedia layanan purna jual lengkap termasuk garansi resmi, perawatan rutin, servis berkala, pelatihan operator, dan ketersediaan sparepart original untuk memastikan alat berat Anda selalu dalam kondisi prima dan produktivitas tetap terjaga."
                }
            }
        ]
    }
    </script>
    
    <!-- CSS -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/product/hero.css">
    <link rel="stylesheet" href="/css/product/product.css">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="icon" type="image/webp" href="/images/favicon.webp">
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
</head>
<body>

<!-- ================= HEADER ================= -->
<header class="header">
    <div class="container">
        <div class="logo">
            <a href="/index.php">
                <img src="/images/logo.webp" alt="PT Ganda Elang Tangguh Logo - Dealer Resmi LiuGong Indonesia">
            </a>
        </div>
        <nav class="navbar" id="navbar">
            <a href="/index.php">Beranda</a>
            <a href="/about.php">Tentang Kami</a>
            <a href="/produk.php" class="active">Produk</a>
            <a href="/aftersales.php">Layanan Purna Jual</a>
            <a href="/contact.php">Hubungi Kami</a>
            <a href="/blog.php">Blog & Artikel</a>
        </nav>
        <div class="hamburger" id="hamburger" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</header>

<!-- ================= HERO SECTION ================= -->
<section class="hero hero-image" style="background: url('/images/wheelloader.jpg') center / cover no-repeat;">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-breadcrumb">
            <a href="/index.php">Home</a>
            <span>></span>
            <a href="/produk.php">Produk</a>
            <span>></span>
            <span class="current">Wheel Loader</span>
        </div>
        <h1>Wheel Loader LiuGong untuk Konstruksi & Pertambangan di Indonesia</h1>
        <p class="hero-subtext">
            Wheel loader berkinerja tinggi, dirancang untuk efisiensi pemindahan material, ketahanan superior, dan hasil kerja maksimal. 
            Dapatkan <strong>harga wheel loader terbaik</strong> hanya di PT Ganda Elang Tangguh, <strong>dealer resmi LiuGong Indonesia</strong>.
        </p>
    </div>
</section>

<!-- ================= PRODUCT LIST SECTION ================= -->
<section class="product-list">
    <div class="product-container">
        <h2 class="product-title">Daftar Produk Wheel Loader LiuGong</h2>
        
        <div class="product-grid">
            <?php if (!empty($products)) : ?>
                <?php foreach ($products as $row) : ?>
                    <div class="product-card">
                        <a href="/detailprodukwheelloader.php?slug=<?= htmlspecialchars($row['slug']); ?>" class="product-link">
                            <div class="product-image">
                                <img 
                                    src="/images/uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" 
                                    alt="<?= htmlspecialchars($row['nama_produk']); ?> - Wheel Loader LiuGong untuk konstruksi dan pertambangan"
                                    loading="lazy"
                                    width="400"
                                    height="300"
                                >
                            </div>
                            <div class="product-info">
                                <h3><?= htmlspecialchars($row['nama_produk']); ?></h3>
                                
                                <?php if (!empty($row['specifications'])) : ?>
                                    <ul class="product-spec-list">
                                        <?php foreach ($row['specifications'] as $spec) : ?>
                                            <li>
                                                <span><?= htmlspecialchars($spec['label']); ?></span>
                                                <span><?= htmlspecialchars($spec['nilai']); ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else : ?>
                                    <ul class="product-spec-list">
                                        <li>
                                            <span>Spesifikasi</span>
                                            <span>-</span>
                                        </li>
                                    </ul>
                                <?php endif; ?>
                                
                                <div class="product-btn">
                                    Detail Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                                </div>
                            </div>
                        </a>
                        
                        <!-- Product Schema per produk -->
                        <script type="application/ld+json">
                        {
                            "@context": "https://schema.org",
                            "@type": "Product",
                            "name": "<?= htmlspecialchars($row['nama_produk']); ?>",
                            "description": "Wheel loader <?= htmlspecialchars($row['nama_produk']); ?> dari LiuGong untuk konstruksi, pertambangan, dan material handling di Indonesia.",
                            "image": "https://gandaelang.co.id/images/uploads/produk/<?= htmlspecialchars($row['gambar']); ?>",
                            "brand": {
                                "@type": "Brand",
                                "name": "LiuGong"
                            },
                            "manufacturer": {
                                "@type": "Organization",
                                "name": "PT Ganda Elang Tangguh"
                            },
                            "offers": {
                                "@type": "Offer",
                                "priceCurrency": "IDR",
                                "availability": "https://schema.org/InStock",
                                "url": "https://gandaelang.co.id/detailprodukwheelloader.php?slug=<?= htmlspecialchars($row['slug']); ?>"
                            }
                        }
                        </script>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="no-product">Belum ada produk tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ================= FAQ SECTION ================= -->
<section class="faq-section">
    <div class="faq-header">
        <h2>Pertanyaan Umum</h2>
        <p>Temukan jawaban atas pertanyaan yang sering diajukan tentang Wheel Loader LiuGong</p>
    </div>
    
    <div class="faq-grid">
        <div class="faq-item">
            <div class="faq-question">
                Apa keunggulan Wheel Loader LiuGong?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>Wheel Loader LiuGong memiliki keunggulan seperti efisiensi bahan bakar tinggi, performa tangguh untuk berbagai medan, perawatan mudah, ketersediaan sparepart terjamin, dan teknologi canggih untuk produktivitas maksimal.</p>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                Berapa kapasitas angkut Wheel Loader LiuGong?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>Wheel Loader LiuGong tersedia dalam berbagai kapasitas mulai dari 1.9m³ hingga 7.0m³ untuk bucket capacity, dengan operating weight dari 13.378kg hingga 52.100kg, sesuai dengan kebutuhan proyek Anda.</p>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                Apakah PT Ganda Elang Tangguh dealer resmi LiuGong?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>Ya, PT Ganda Elang Tangguh adalah dealer resmi alat berat LiuGong di Indonesia yang melayani penjualan unit baru, perawatan rutin, servis, dan penyediaan sparepart original.</p>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                Wheel loader cocok untuk industri apa saja?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>Wheel loader LiuGong sangat cocok untuk berbagai industri seperti konstruksi bangunan, pertambangan, perkebunan, logistik dan pergudangan, serta proyek infrastruktur jalan dan jembatan.</p>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                Bagaimana cara mendapatkan informasi harga wheel loader?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>Anda bisa menghubungi tim sales PT Ganda Elang Tangguh melalui halaman Kontak Kami, telepon, atau email untuk mendapatkan informasi harga terbaru dan penawaran spesial sesuai kebutuhan proyek Anda.</p>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                Apakah ada layanan after-sales untuk wheel loader?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>Tersedia layanan purna jual lengkap termasuk garansi, perawatan rutin, servis berkala, pelatihan operator, dan ketersediaan sparepart original untuk memastikan alat berat Anda selalu dalam kondisi prima.</p>
            </div>
        </div>
    </div>
    
<div class="faq-cta">
    <p>Masih ada pertanyaan? Tim kami siap membantu Anda</p>
    <a href="https://wa.me/6282355163745?text=Halo%20saya%20dapat%20nomor%20anda%20dari%20Google%20www.gandaelang.co.id" 
       class="contact-btn" 
       target="_blank" 
       rel="noopener noreferrer">
        <i class="fab fa-whatsapp"></i> Hubungi Kami via WhatsApp <i class="fas fa-arrow-right"></i>
    </a>
</div>
</section>

<!-- ================= FOOTER ================= -->
<?php include $_SERVER['DOCUMENT_ROOT'] . "/footer.php"; ?>

<!-- JavaScript -->
<script>
    function toggleMenu() {
        const navbar = document.getElementById('navbar');
        navbar.classList.toggle('open');
    }

    // Tutup menu saat klik di luar
    document.addEventListener('click', function(event) {
        const navbar = document.getElementById('navbar');
        const hamburger = document.getElementById('hamburger');
        if (!navbar.contains(event.target) && !hamburger.contains(event.target)) {
            navbar.classList.remove('open');
        }
    });
    
    // ===== FAQ ACCORDION =====
    document.addEventListener('DOMContentLoaded', function() {
        const faqItems = document.querySelectorAll('.faq-item');
        
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            const answer = item.querySelector('.faq-answer');
            const icon = question.querySelector('.fa-chevron-down');
            
            // Sembunyikan semua jawaban awalnya
            answer.style.display = 'none';
            
            question.addEventListener('click', function() {
                // Toggle jawaban
                if (answer.style.display === 'none') {
                    answer.style.display = 'block';
                    if (icon) {
                        icon.style.transform = 'rotate(180deg)';
                   
<?php
// ================= DATABASE =================
require_once __DIR__ . '/admin/config.php';

// ================= GET PRODUCT + SPECIFICATIONS =================
$stmt = $pdo->prepare("
    SELECT 
        p.id,
        p.nama_produk,
        p.slug,
        p.gambar,
        MAX(CASE WHEN ps.label = 'Operating Weight' THEN ps.nilai END) AS operating_weight,
        MAX(CASE WHEN ps.label = 'Tinggi Kerja' THEN ps.nilai END) AS tinggi_kerja,
        MAX(CASE WHEN ps.label = 'Kapasitas Angkat' THEN ps.nilai END) AS kapasitas_angkat
    FROM produk p
    LEFT JOIN produk_spesifikasi ps 
        ON p.id = ps.produk_id
    WHERE p.status = 'aktif'
    AND p.category_id = 12
    GROUP BY 
        p.id,
        p.nama_produk,
        p.slug,
        p.gambar
    ORDER BY p.id DESC
");
$stmt->execute();
$products = $stmt->fetchAll();

$currentUrl = "https://gandaelang.co.id/aerialplatform";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Aerial Work Platform LiuGong | Alat Berat Pekerjaan Ketinggian | PT Ganda Elang Tangguh</title>
    
    <meta name="description" content="PT Ganda Elang Tangguh jual Aerial Work Platform / Boom Lift LiuGong berkualitas tinggi untuk pekerjaan di ketinggian, konstruksi, dan pemeliharaan infrastruktur. Tersedia berbagai tipe dengan performa unggul, stabilitas, dan keamanan terbaik. Dapatkan harga aerial platform terbaru disini!">
    
    <meta name="keywords" content="aerial work platform, boom lift, aerial platform liugong, alat berat aerial platform, harga aerial platform, aerial platform indonesia, heavy equipment aerial platform, boom lift untuk konstruksi, alat kerja ketinggian, alat berat indonesia, dealer liugong indonesia, aerial platform terbaik, spesifikasi aerial platform, scissor lift">
    
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    
    <meta name="author" content="PT Ganda Elang Tangguh">
    <meta name="geo.region" content="ID">
    <meta name="geo.placename" content="Jakarta, Indonesia">
    <meta name="language" content="id-ID">
    
    <link rel="canonical" href="<?= $currentUrl ?>">
    <link rel="alternate" hreflang="id" href="<?= $currentUrl ?>">
    <link rel="alternate" href="<?= $currentUrl ?>" hreflang="x-default">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="Aerial Work Platform LiuGong | Alat Berat Pekerjaan Ketinggian | PT Ganda Elang Tangguh">
    <meta property="og:description" content="PT Ganda Elang Tangguh menyediakan Aerial Work Platform / Boom Lift LiuGong terbaik untuk pekerjaan di ketinggian, konstruksi, dan pemeliharaan infrastruktur di Indonesia. Performa tangguh, stabil, dan aman.">
    <meta property="og:image" content="https://gandaelang.co.id/images/aerialplatform.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Aerial Work Platform LiuGong untuk pekerjaan ketinggian">
    <meta property="og:url" content="<?= $currentUrl ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="PT Ganda Elang Tangguh">
    <meta property="og:locale" content="id_ID">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Aerial Work Platform LiuGong | Alat Berat Indonesia">
    <meta name="twitter:description" content="Aerial work platform / boom lift LiuGong untuk pekerjaan ketinggian yang aman dan efisien. Tersedia berbagai tipe dengan performa terbaik.">
    <meta name="twitter:image" content="https://gandaelang.co.id/images/aerialplatform.jpg">
    <meta name="twitter:image:alt" content="Aerial Work Platform LiuGong">
    
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
                "item": "https://gandaelang.co.id/produk"
            },
            {
                "@type": "ListItem",
                "position": 3,
                "name": "Aerial Work Platform LiuGong",
                "item": "https://gandaelang.co.id/aerialplatform"
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
        "description": "Dealer resmi alat berat LiuGong di Indonesia, menyediakan aerial work platform, excavator, wheel loader, bulldozer, dan alat berat lainnya untuk konstruksi, pertambangan, dan infrastruktur.",
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
    
    <!-- Product Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Product",
        "name": "Aerial Work Platform / Boom Lift LiuGong",
        "description": "Aerial Work Platform / Boom Lift LiuGong adalah alat berat untuk pekerjaan di ketinggian, konstruksi, pemeliharaan infrastruktur, dan instalasi. Tersedia berbagai seri dengan tinggi kerja bervariasi, stabilitas tinggi, dan sistem kontrol yang aman dan mudah digunakan.",
        "brand": {
            "@type": "Brand",
            "name": "LiuGong"
        },
        "manufacturer": {
            "@type": "Organization",
            "name": "LiuGong Machinery Corporation"
        },
        "seller": {
            "@type": "Organization",
            "name": "PT Ganda Elang Tangguh"
        },
        "category": "Alat Berat Aerial Work Platform",
        "offers": {
            "@type": "Offer",
            "priceCurrency": "IDR",
            "availability": "https://schema.org/InStock",
            "url": "https://gandaelang.co.id/aerialplatform",
            "seller": {
                "@type": "Organization",
                "name": "PT Ganda Elang Tangguh"
            }
        },
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.8",
            "reviewCount": "127",
            "bestRating": "5"
        },
        "audience": {
            "@type": "Audience",
            "name": "Kontraktor, Perusahaan Konstruksi, Pemeliharaan Infrastruktur, Instalasi"
        },
        "url": "https://gandaelang.co.id/aerialplatform"
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
                "name": "Apa keunggulan Aerial Work Platform LiuGong dibandingkan merek lain?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Aerial Work Platform LiuGong memiliki keunggulan seperti desain stabil dan ringan untuk keamanan maksimal, sistem kontrol yang mudah digunakan, tingkat keandalan tinggi, perawatan rendah, serta ketersediaan sparepart original terjamin."
                }
            },
            {
                "@type": "Question",
                "name": "Berapa tinggi kerja maksimum Aerial Work Platform LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Aerial Work Platform LiuGong tersedia dalam berbagai tipe dengan tinggi kerja yang bervariasi, mulai dari 10 meter hingga 40+ meter, sesuai dengan kebutuhan proyek konstruksi dan pemeliharaan infrastruktur Anda."
                }
            },
            {
                "@type": "Question",
                "name": "Apakah PT Ganda Elang Tangguh dealer resmi Aerial Work Platform LiuGong di Indonesia?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Ya, PT Ganda Elang Tangguh adalah dealer resmi alat berat LiuGong di Indonesia yang melayani penjualan unit aerial work platform baru, perawatan rutin, servis berkala, pelatihan operator, dan penyediaan sparepart original dengan garansi pabrik."
                }
            },
            {
                "@type": "Question",
                "name": "Apa perbedaan boom lift dan scissor lift?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Boom lift memiliki lengan artikulasi atau telescopic yang memungkinkan jangkauan ke atas dan ke samping, cocok untuk pekerjaan di area sulit dijangkau. Scissor lift bergerak vertikal dengan platform stabil, cocok untuk pekerjaan di ketinggian dengan area luas. LiuGong menyediakan kedua jenis sesuai kebutuhan proyek Anda."
                }
            },
            {
                "@type": "Question",
                "name": "Aerial Work Platform LiuGong cocok untuk proyek apa saja?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Aerial Work Platform LiuGong sangat cocok untuk pekerjaan pemeliharaan gedung bertingkat, instalasi listrik dan penerangan, pengecatan gedung, pembersihan gedung, konstruksi jembatan, pekerjaan di bandara, serta proyek infrastruktur dan konstruksi lainnya yang membutuhkan akses ketinggian."
                }
            },
            {
                "@type": "Question",
                "name": "Bagaimana cara mendapatkan informasi harga dan simulasi kredit Aerial Work Platform LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Anda bisa menghubungi tim sales PT Ganda Elang Tangguh melalui WhatsApp, telepon, email, atau halaman Kontak Kami untuk mendapatkan informasi harga terbaru, spesifikasi lengkap (tinggi kerja, kapasitas angkat, berat operasi), serta simulasi kredit dengan tenor fleksibel sesuai kebutuhan proyek Anda."
                }
            },
            {
                "@type": "Question",
                "name": "Apakah tersedia layanan after-sales untuk Aerial Work Platform LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Tersedia layanan purna jual lengkap: garansi standar pabrik, perawatan rutin (penggantian oli, filter, pengecekan sistem hidraulik dan kelistrikan), servis mobile ke lokasi proyek, pelatihan operator, dan stok sparepart original (komponen mesin, sistem hidraulik, ban) di gudang pusat dan cabang."
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
    
    <style>
        /* ===== SEO CONTENT STYLES ===== */
        .seo-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 50px 20px 30px;
        }
        .seo-content h2 {
            font-size: 28px;
            color: #0b3a82;
            margin-bottom: 15px;
        }
        .seo-content h3 {
            font-size: 22px;
            color: #0b3a82;
            margin-top: 25px;
            margin-bottom: 10px;
        }
        .seo-content p {
            font-size: 16px;
            line-height: 1.8;
            color: #444;
            margin-bottom: 15px;
        }
        .seo-content ul {
            list-style: none;
            padding: 0;
            margin: 15px 0 20px;
        }
        .seo-content ul li {
            padding: 10px 0 10px 30px;
            border-bottom: 1px solid #f0f0f0;
            position: relative;
            font-size: 15px;
            color: #333;
        }
        .seo-content ul li::before {
            content: "\f00c";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            color: #e31e24;
            position: absolute;
            left: 0;
            top: 10px;
        }
        .seo-content ul li strong {
            color: #0b3a82;
        }
        .seo-content .seo-cta {
            background: #f8f9fa;
            padding: 25px 30px;
            border-radius: 12px;
            border-left: 4px solid #e31e24;
            margin-top: 20px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .seo-content h2 { font-size: 22px; }
            .seo-content h3 { font-size: 18px; }
        }
    </style>
</head>
<body>

<!-- ================= HEADER ================= -->
<header class="header">
    <div class="container">
        <div class="logo">
            <a href="/">
                <img src="/images/logo.webp" alt="PT Ganda Elang Tangguh Logo - Dealer Resmi LiuGong Indonesia">
            </a>
        </div>
        <nav class="navbar" id="navbar">
            <a href="/">Beranda</a>
            <a href="/about">Tentang Kami</a>
            <a href="/produk" class="active">Produk</a>
            <a href="/aftersales">Layanan Purna Jual</a>
            <a href="/contact">Hubungi Kami</a>
            <a href="/blog">Blog & Artikel</a>
        </nav>
        <div class="hamburger" id="hamburger" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</header>

<!-- ================= HERO SECTION ================= -->
<section class="hero hero-image" style="background: url('/images/aerialplatform.jpg') center / cover no-repeat;">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-breadcrumb">
            <a href="/">Home</a>
            <span>></span>
            <a href="/produk">Produk</a>
            <span>></span>
            <span class="current">Aerial Work Platform</span>
        </div>
        <!-- ===== H1 DENGAN KEYWORD ===== -->
        <h1>Aerial Work Platform LiuGong untuk Pekerjaan Ketinggian di Indonesia</h1>
        <p class="hero-subtext">
            Aerial Work Platform / Boom Lift LiuGong berkinerja stabil dan aman, dirancang untuk <strong>pekerjaan di ketinggian</strong>, 
            <strong>konstruksi</strong>, dan <strong>pemeliharaan infrastruktur</strong> dengan tingkat keamanan dan 
            efisiensi terbaik. Dapatkan <strong>harga aerial platform terbaik</strong> hanya di 
            <strong>PT Ganda Elang Tangguh</strong>, dealer resmi LiuGong Indonesia.
        </p>
    </div>
</section>

<!-- ================= PRODUCT LIST SECTION ================= -->
<section class="product-list">
    <div class="product-container">
        <h2 class="product-title">Daftar Produk Aerial Work Platform LiuGong</h2>
        
        <div class="product-grid">
            <?php if (!empty($products)) : ?>
                <?php foreach ($products as $row) : ?>
                    <div class="product-card">
                        <a href="/detailprodukaerialplatform.php?slug=<?= htmlspecialchars($row['slug']); ?>" class="product-link">
                            <div class="product-image">
                                <img 
                                    src="/images/uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" 
                                    alt="<?= htmlspecialchars($row['nama_produk']); ?> - Aerial Work Platform LiuGong untuk pekerjaan ketinggian"
                                    loading="lazy"
                                    width="400"
                                    height="300"
                                >
                            </div>
                            <div class="product-info">
                                <h3><?= htmlspecialchars($row['nama_produk']); ?></h3>
                                
                                <?php if (!empty($row['tinggi_kerja']) || !empty($row['kapasitas_angkat']) || !empty($row['operating_weight'])) : ?>
                                    <ul class="product-spec-list">
                                        <?php if (!empty($row['tinggi_kerja'])) : ?>
                                            <li>
                                                <span>Tinggi Kerja</span>
                                                <span><?= htmlspecialchars($row['tinggi_kerja']); ?></span>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($row['kapasitas_angkat'])) : ?>
                                            <li>
                                                <span>Kapasitas Angkat</span>
                                                <span><?= htmlspecialchars($row['kapasitas_angkat']); ?></span>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($row['operating_weight'])) : ?>
                                            <li>
                                                <span>Operating Weight</span>
                                                <span><?= htmlspecialchars($row['operating_weight']); ?></span>
                                            </li>
                                        <?php endif; ?>
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
                            "description": "Aerial Work Platform <?= htmlspecialchars($row['nama_produk']); ?> dari LiuGong untuk pekerjaan ketinggian, konstruksi, dan pemeliharaan infrastruktur di Indonesia.",
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
                                "url": "https://gandaelang.co.id/detailprodukaerialplatform.php?slug=<?= htmlspecialchars($row['slug']); ?>"
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

<!-- ================= SEO CONTENT ================= -->
<section class="seo-content">
    <h2>Mengapa Memilih Aerial Work Platform LiuGong untuk Pekerjaan Ketinggian?</h2>
    <p>
        <strong>Aerial Work Platform / Boom Lift LiuGong</strong> adalah solusi alat berat terbaik untuk <strong>pekerjaan di ketinggian</strong>, 
        <strong>konstruksi</strong>, dan <strong>pemeliharaan infrastruktur</strong> di Indonesia. Dengan teknologi canggih dari 
        LiuGong, aerial platform ini menawarkan kombinasi sempurna antara <strong>keamanan, stabilitas, dan efisiensi</strong> 
        yang dirancang untuk menghadapi berbagai tantangan pekerjaan di ketinggian.
    </p>
    
    <h3>Spesifikasi Unggulan Aerial Work Platform LiuGong</h3>
    <ul>
        <li><strong>Tinggi Kerja:</strong> 10 meter - 40+ meter untuk berbagai kebutuhan</li>
        <li><strong>Kapasitas Angkat:</strong> Optimal untuk pekerjaan ketinggian</li>
        <li><strong>Sistem Kontrol:</strong> Mudah digunakan dan aman</li>
        <li><strong>Desain:</strong> Stabil dan ringan untuk keamanan maksimal</li>
        <li><strong>Platform:</strong> Luas untuk kenyamanan pekerja</li>
        <li><strong>Mobilitas:</strong> Mudah dipindahkan ke berbagai lokasi</li>
        <li><strong>Garansi Resmi:</strong> Didukung oleh dealer resmi LiuGong di Indonesia</li>
    </ul>
    
    <h3>Keunggulan Aerial Work Platform LiuGong Dibanding Merek Lain</h3>
    <p>
        Sebagai <strong>dealer resmi LiuGong</strong>, PT Ganda Elang Tangguh menawarkan aerial platform dengan 
        <strong>harga kompetitif</strong> dan <strong>ketersediaan sparepart original</strong> yang terjamin. 
        Teknologi <strong>hidraulik</strong> dan <strong>sistem kontrol</strong> dari LiuGong memastikan 
        keamanan dan efisiensi kerja yang optimal, sehingga <strong>biaya perawatan</strong> menjadi lebih 
        efisien dalam jangka panjang.
    </p>
    
    <p>
        <strong>Aerial Work Platform LiuGong</strong> dirancang dengan mempertimbangkan keamanan dan kenyamanan operator, 
        membantu Anda mengoptimalkan <strong>produktivitas</strong> dan <strong>efisiensi operasional</strong> proyek. 
        Dengan berbagai tipe yang tersedia, Anda dapat memilih <strong>aerial platform yang tepat</strong> sesuai 
        kebutuhan spesifik proyek Anda.
    </p>
    
    <div class="seo-cta">
        <p style="font-size:18px; font-weight:600; margin-bottom:5px;">
            <i class="fas fa-phone" style="color:#e31e24;"></i> 
            Dapatkan Harga Aerial Work Platform Terbaik Sekarang!
        </p>
        <p style="font-size:15px; margin-bottom:0;">
            Hubungi tim sales <strong>PT Ganda Elang Tangguh</strong> untuk konsultasi gratis dan penawaran spesial 
            untuk proyek Anda. Kami siap membantu Anda memilih <strong>aerial work platform LiuGong</strong> yang paling 
            sesuai dengan kebutuhan dan anggaran.
        </p>
    </div>
</section>

<!-- ================= FAQ SECTION ================= -->
<section class="faq-section">
    <div class="faq-header">
        <h2>Pertanyaan Umum Seputar Aerial Work Platform LiuGong</h2>
        <p>Temukan jawaban atas pertanyaan yang sering diajukan tentang Aerial Work Platform LiuGong, mulai dari spesifikasi, harga, hingga layanan purna jual.</p>
    </div>
    
    <div class="faq-grid" itemscope="" itemtype="https://schema.org/FAQPage">
        
        <!-- FAQ 1 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Apa keunggulan Aerial Work Platform LiuGong dibandingkan merek lain?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Aerial Work Platform LiuGong memiliki keunggulan seperti <strong>desain stabil dan ringan</strong> untuk keamanan maksimal, <strong>sistem kontrol yang mudah digunakan</strong>, <strong>tingkat keandalan tinggi</strong>, <strong>perawatan rendah</strong>, serta ketersediaan <strong>sparepart original</strong> terjamin.</p>
            </div>
        </div>
        
        <!-- FAQ 2 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Berapa tinggi kerja maksimum Aerial Work Platform LiuGong?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Aerial Work Platform LiuGong tersedia dalam berbagai tipe dengan <strong>tinggi kerja yang bervariasi</strong>, mulai dari <strong>10 meter hingga 40+ meter</strong>, sesuai dengan kebutuhan proyek konstruksi dan pemeliharaan infrastruktur Anda.</p>
            </div>
        </div>
        
        <!-- FAQ 3 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Apakah PT Ganda Elang Tangguh dealer resmi Aerial Work Platform LiuGong di Indonesia?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Ya, <strong>PT Ganda Elang Tangguh</strong> adalah <strong>dealer resmi alat berat LiuGong</strong> di Indonesia yang melayani penjualan unit aerial work platform baru, perawatan rutin, servis berkala, pelatihan operator, dan penyediaan <strong>sparepart original</strong> dengan garansi pabrik.</p>
            </div>
        </div>
        
        <!-- FAQ 4 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Apa perbedaan boom lift dan scissor lift?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text"><strong>Boom lift</strong> memiliki lengan artikulasi atau telescopic yang memungkinkan jangkauan ke atas dan ke samping, cocok untuk pekerjaan di area sulit dijangkau. <strong>Scissor lift</strong> bergerak vertikal dengan platform stabil, cocok untuk pekerjaan di ketinggian dengan area luas. LiuGong menyediakan kedua jenis sesuai kebutuhan proyek Anda.</p>
            </div>
        </div>
        
        <!-- FAQ 5 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Aerial Work Platform LiuGong cocok untuk proyek apa saja?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Aerial Work Platform LiuGong sangat cocok untuk <strong>pemeliharaan gedung bertingkat</strong>, <strong>instalasi listrik dan penerangan</strong>, <strong>pengecatan gedung</strong>, <strong>pembersihan gedung</strong>, <strong>konstruksi jembatan</strong>, <strong>pekerjaan di bandara</strong>, serta proyek infrastruktur dan konstruksi lainnya yang membutuhkan akses ketinggian.</p>
            </div>
        </div>
        
        <!-- FAQ 6 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Bagaimana cara mendapatkan informasi harga dan simulasi kredit Aerial Work Platform LiuGong?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Anda bisa menghubungi tim sales <strong>PT Ganda Elang Tangguh</strong> melalui <a href="/contact">halaman Kontak Kami</a>, WhatsApp, telepon, atau email untuk mendapatkan <strong>informasi harga aerial platform terbaru</strong>, spesifikasi lengkap (tinggi kerja, kapasitas angkat, berat operasi), serta simulasi kredit dengan tenor fleksibel.</p>
            </div>
        </div>
        
        <!-- FAQ 7 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Apakah tersedia layanan after-sales untuk Aerial Work Platform LiuGong?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Tersedia layanan purna jual lengkap termasuk <strong>garansi standar pabrik</strong>, <strong>perawatan rutin</strong> (penggantian oli, filter, pengecekan sistem hidraulik dan kelistrikan), <strong>servis mobile</strong> ke lokasi proyek, <strong>pelatihan operator</strong>, dan stok <strong>sparepart original</strong> (komponen mesin, sistem hidraulik, ban) di gudang pusat dan cabang.</p>
            </div>
        </div>
    </div>
    
    <div class="faq-cta">
        <p>Masih ada pertanyaan? Tim kami siap membantu Anda</p>
        <a href="https://wa.me/6282355163745?text=Halo%20saya%20dapat%20nomor%20anda%20dari%20website%20Aerial%20Work%20Platform%20LiuGong%20dan%20ingin%20konsultasi" 
           class="contact-btn" 
           target="_blank" 
           rel="noopener noreferrer">
            <i class="fab fa-whatsapp"></i> Hubungi Kami via WhatsApp <i class="fas fa-arrow-right"></i>
        </a>
        <br>
        <small style="display:block; margin-top:10px;">
            Atau <a href="/contact" style="color:#e31e24; font-weight:600;">hubungi tim sales kami</a> untuk konsultasi gratis
        </small>
    </div>
</section>

<!-- ================= FOOTER ================= -->
<?php include "whatsapp.php"; ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/footer.php"; ?>

<!-- JavaScript -->
<script>
    // ===== TOGGLE MENU =====
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
        
        if (faqItems.length > 0) {
            faqItems.forEach(function(item) {
                const question = item.querySelector('.faq-question');
                
                if (question) {
                    question.addEventListener('click', function(e) {
                        // Tutup FAQ lain (accordion mode)
                        faqItems.forEach(function(otherItem) {
                            if (otherItem !== item && otherItem.classList.contains('active')) {
                                otherItem.classList.remove('active');
                            }
                        });
                        
                        // Toggle current item
                        item.classList.toggle('active');
                    });
                }
            });
        }
    });
</script>

</body>
</html>
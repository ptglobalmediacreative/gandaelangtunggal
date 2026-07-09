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
        MAX(CASE WHEN ps.label = 'Kapasitas Angkat' THEN ps.nilai END) AS kapasitas_angkat,
        MAX(CASE WHEN ps.label = 'Tinggi Angkat' THEN ps.nilai END) AS tinggi_angkat
    FROM produk p
    LEFT JOIN produk_spesifikasi ps 
        ON p.id = ps.produk_id
    WHERE p.status = 'aktif'
    AND p.category_id = 13
    GROUP BY 
        p.id,
        p.nama_produk,
        p.slug,
        p.gambar
    ORDER BY p.id DESC
");
$stmt->execute();
$products = $stmt->fetchAll();

$currentUrl = "https://gandaelang.co.id/crane";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Crane LiuGong | PT Ganda Elang Tangguh</title>
    
    <meta name="description" content="PT Ganda Elang Tangguh jual Crane LiuGong berkualitas tinggi untuk konstruksi, pertambangan, dan industri. Tersedia berbagai tipe dengan kapasitas angkat besar, sistem hidrolik canggih, stabilitas maksimal, dan garansi resmi. Dapatkan harga crane terbaru disini!">
    
    <meta name="keywords" content="crane, crane liugong, alat berat crane, harga crane, crane indonesia, heavy equipment crane, crane untuk konstruksi, crane pertambangan, alat berat indonesia, dealer liugong indonesia, crane terbaik, spesifikasi crane, mobile crane, crawler crane">
    
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    
    <meta name="author" content="PT Ganda Elang Tangguh">
    <meta name="geo.region" content="ID">
    <meta name="geo.placename" content="Jakarta, Indonesia">
    <meta name="language" content="id-ID">
    
    <link rel="canonical" href="<?= $currentUrl ?>">
    <link rel="alternate" hreflang="id" href="<?= $currentUrl ?>">
    <link rel="alternate" href="<?= $currentUrl ?>" hreflang="x-default">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="Crane LiuGong | Alat Berat Angkat & Konstruksi | PT Ganda Elang Tangguh">
    <meta property="og:description" content="PT Ganda Elang Tangguh menyediakan Crane LiuGong terbaik untuk proyek konstruksi, pertambangan, dan industri di Indonesia. Performa tangguh, stabil, dan efisien.">
    <meta property="og:image" content="https://gandaelang.co.id/images/crane.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Crane LiuGong untuk konstruksi dan pertambangan">
    <meta property="og:url" content="<?= $currentUrl ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="PT Ganda Elang Tangguh">
    <meta property="og:locale" content="id_ID">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Crane LiuGong | Alat Berat Indonesia">
    <meta name="twitter:description" content="Crane LiuGong untuk konstruksi dan industri dengan kapasitas angkat besar dan stabilitas maksimal.">
    <meta name="twitter:image" content="https://gandaelang.co.id/images/crane.jpg">
    <meta name="twitter:image:alt" content="Crane LiuGong">
    
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
                "name": "Crane LiuGong",
                "item": "https://gandaelang.co.id/crane"
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
        "description": "Dealer resmi alat berat LiuGong di Indonesia, menyediakan crane, excavator, wheel loader, bulldozer, dan alat berat lainnya untuk konstruksi, pertambangan, dan infrastruktur.",
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
        "name": "Crane LiuGong",
        "description": "Crane LiuGong adalah alat berat untuk pekerjaan angkat dan konstruksi. Tersedia berbagai seri dengan kapasitas angkat besar, sistem hidrolik canggih untuk stabilitas dan keamanan, serta efisiensi bahan bakar optimal.",
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
        "category": "Alat Berat Crane",
        "offers": {
            "@type": "Offer",
            "priceCurrency": "IDR",
            "availability": "https://schema.org/InStock",
            "url": "https://gandaelang.co.id/crane",
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
            "name": "Kontraktor, Perusahaan Konstruksi, Industri, Pertambangan"
        },
        "url": "https://gandaelang.co.id/crane"
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
                "name": "Apa keunggulan Crane LiuGong dibandingkan merek lain?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Crane LiuGong memiliki keunggulan seperti kapasitas angkat besar, sistem hidrolik canggih untuk stabilitas dan keamanan maksimal, biaya perawatan rendah, kabin ergonomis dengan visibilitas luas, serta ketersediaan sparepart original terjamin."
                }
            },
            {
                "@type": "Question",
                "name": "Berapa kapasitas angkat maksimum Crane LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Crane LiuGong tersedia dalam berbagai tipe dengan kapasitas angkat yang bervariasi, mulai dari 10 ton hingga 100+ ton, sesuai dengan kebutuhan proyek konstruksi dan industri Anda."
                }
            },
            {
                "@type": "Question",
                "name": "Apakah PT Ganda Elang Tangguh dealer resmi Crane LiuGong di Indonesia?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Ya, PT Ganda Elang Tangguh adalah dealer resmi alat berat LiuGong di Indonesia yang melayani penjualan unit crane baru, perawatan rutin, servis berkala, pelatihan operator, dan penyediaan sparepart original dengan garansi pabrik."
                }
            },
            {
                "@type": "Question",
                "name": "Apa perbedaan mobile crane dan crawler crane?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Mobile crane memiliki roda untuk mobilitas di jalan raya, cocok untuk proyek dengan banyak lokasi. Crawler crane menggunakan track (rantai) untuk stabilitas maksimal di medan berat, cocok untuk proyek skala besar di satu lokasi. LiuGong menyediakan kedua jenis sesuai kebutuhan proyek Anda."
                }
            },
            {
                "@type": "Question",
                "name": "Crane LiuGong cocok untuk proyek apa saja?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Crane LiuGong sangat cocok untuk proyek konstruksi gedung bertingkat, pembangunan jembatan, proyek infrastruktur, pertambangan, industri manufaktur, pelabuhan, serta pemasangan struktur baja dan beton."
                }
            },
            {
                "@type": "Question",
                "name": "Bagaimana cara mendapatkan informasi harga dan simulasi kredit Crane LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Anda bisa menghubungi tim sales PT Ganda Elang Tangguh melalui WhatsApp, telepon, email, atau halaman Kontak Kami untuk mendapatkan informasi harga terbaru, spesifikasi lengkap (kapasitas angkat, tinggi angkat, berat operasi), serta simulasi kredit dengan tenor fleksibel sesuai kebutuhan proyek Anda."
                }
            },
            {
                "@type": "Question",
                "name": "Apakah tersedia layanan after-sales untuk Crane LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Tersedia layanan purna jual lengkap: garansi standar pabrik, perawatan rutin (penggantian oli, filter, pengecekan sistem hidraulik dan kelistrikan), servis mobile ke lokasi proyek, pelatihan operator, dan stok sparepart original (komponen mesin, sistem hidraulik, kabel) di gudang pusat dan cabang."
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
<section class="hero hero-image" style="background: url('/images/crane.jpg') center / cover no-repeat;">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-breadcrumb">
            <a href="/">Home</a>
            <span>></span>
            <a href="/produk">Produk</a>
            <span>></span>
            <span class="current">Crane</span>
        </div>
        <!-- ===== H1 DENGAN KEYWORD ===== -->
        <h1>Crane LiuGong untuk Konstruksi & Industri di Indonesia</h1>
        <p class="hero-subtext">
            Crane LiuGong berkinerja tangguh, dirancang untuk <strong>pekerjaan angkat</strong>, 
            <strong>konstruksi</strong>, dan <strong>industri</strong> dengan kapasitas angkat besar, 
            stabilitas maksimal, dan efisiensi operasional. Dapatkan <strong>harga crane terbaik</strong> 
            hanya di <strong>PT Ganda Elang Tangguh</strong>, dealer resmi LiuGong Indonesia.
        </p>
    </div>
</section>

<!-- ================= PRODUCT LIST SECTION ================= -->
<section class="product-list">
    <div class="product-container">
        <h2 class="product-title">Daftar Produk Crane LiuGong</h2>
        
        <div class="product-grid">
            <?php if (!empty($products)) : ?>
                <?php foreach ($products as $row) : ?>
                    <div class="product-card">
                        <a href="/detailprodukcrane.php?slug=<?= htmlspecialchars($row['slug']); ?>" class="product-link">
                            <div class="product-image">
                                <img 
                                    src="/images/uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" 
                                    alt="<?= htmlspecialchars($row['nama_produk']); ?> - Crane LiuGong untuk konstruksi dan industri"
                                    loading="lazy"
                                    width="400"
                                    height="300"
                                >
                            </div>
                            <div class="product-info">
                                <h3><?= htmlspecialchars($row['nama_produk']); ?></h3>
                                
                                <?php if (!empty($row['kapasitas_angkat']) || !empty($row['tinggi_angkat']) || !empty($row['operating_weight'])) : ?>
                                    <ul class="product-spec-list">
                                        <?php if (!empty($row['kapasitas_angkat'])) : ?>
                                            <li>
                                                <span>Kapasitas Angkat</span>
                                                <span><?= htmlspecialchars($row['kapasitas_angkat']); ?></span>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($row['tinggi_angkat'])) : ?>
                                            <li>
                                                <span>Tinggi Angkat</span>
                                                <span><?= htmlspecialchars($row['tinggi_angkat']); ?></span>
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
                            "description": "Crane <?= htmlspecialchars($row['nama_produk']); ?> dari LiuGong untuk konstruksi, pertambangan, dan industri di Indonesia.",
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
                                "url": "https://gandaelang.co.id/detailprodukcrane.php?slug=<?= htmlspecialchars($row['slug']); ?>"
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
    <h2>Mengapa Memilih Crane LiuGong untuk Proyek Konstruksi & Industri Anda?</h2>
    <p>
        <strong>Crane LiuGong</strong> adalah solusi alat berat terbaik untuk <strong>pekerjaan angkat</strong>, 
        <strong>konstruksi</strong>, dan <strong>industri</strong> di Indonesia. Dengan teknologi canggih dari 
        LiuGong, crane ini menawarkan kombinasi sempurna antara <strong>kapasitas angkat, stabilitas, dan efisiensi</strong> 
        yang dirancang untuk menghadapi berbagai tantangan proyek konstruksi dan industri.
    </p>
    
    <h3>Spesifikasi Unggulan Crane LiuGong</h3>
    <ul>
        <li><strong>Kapasitas Angkat:</strong> 10 ton - 100+ ton untuk berbagai kebutuhan</li>
        <li><strong>Tinggi Angkat:</strong> Optimal untuk proyek konstruksi dan industri</li>
        <li><strong>Sistem Hidrolik:</strong> Canggih untuk stabilitas dan keamanan</li>
        <li><strong>Kabin:</strong> Ergonomis dengan visibilitas luas untuk kenyamanan operator</li>
        <li><strong>Mobilitas:</strong> Mudah dipindahkan ke berbagai lokasi proyek</li>
        <li><strong>Garansi Resmi:</strong> Didukung oleh dealer resmi LiuGong di Indonesia</li>
    </ul>
    
    <h3>Keunggulan Crane LiuGong Dibanding Merek Lain</h3>
    <p>
        Sebagai <strong>dealer resmi LiuGong</strong>, PT Ganda Elang Tangguh menawarkan crane dengan 
        <strong>harga kompetitif</strong> dan <strong>ketersediaan sparepart original</strong> yang terjamin. 
        Teknologi <strong>hidrolik</strong> dan <strong>sistem kontrol</strong> dari LiuGong memastikan 
        keamanan dan stabilitas yang optimal, sehingga <strong>biaya perawatan</strong> menjadi lebih 
        efisien dalam jangka panjang.
    </p>
    
    <p>
        <strong>Crane LiuGong</strong> juga dilengkapi dengan sistem yang memungkinkan monitoring kondisi alat secara real-time, 
        membantu Anda mengoptimalkan <strong>produktivitas</strong> dan <strong>efisiensi operasional</strong> proyek. 
        Dengan berbagai tipe yang tersedia, Anda dapat memilih <strong>crane yang tepat</strong> sesuai kebutuhan spesifik proyek Anda.
    </p>
    
    <div class="seo-cta">
        <p style="font-size:18px; font-weight:600; margin-bottom:5px;">
            <i class="fas fa-phone" style="color:#e31e24;"></i> 
            Dapatkan Harga Crane Terbaik Sekarang!
        </p>
        <p style="font-size:15px; margin-bottom:0;">
            Hubungi tim sales <strong>PT Ganda Elang Tangguh</strong> untuk konsultasi gratis dan penawaran spesial 
            untuk proyek Anda. Kami siap membantu Anda memilih <strong>crane LiuGong</strong> yang paling sesuai 
            dengan kebutuhan dan anggaran.
        </p>
    </div>
</section>

<!-- ================= FAQ SECTION ================= -->
<section class="faq-section">
    <div class="faq-header">
        <h2>Pertanyaan Umum Seputar Crane LiuGong</h2>
        <p>Temukan jawaban atas pertanyaan yang sering diajukan tentang Crane LiuGong, mulai dari spesifikasi, harga, hingga layanan purna jual.</p>
    </div>
    
    <div class="faq-grid" itemscope="" itemtype="https://schema.org/FAQPage">
        
        <!-- FAQ 1 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Apa keunggulan Crane LiuGong dibandingkan merek lain?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Crane LiuGong memiliki keunggulan seperti <strong>kapasitas angkat besar</strong>, <strong>sistem hidrolik canggih</strong> untuk stabilitas dan keamanan maksimal, <strong>biaya perawatan rendah</strong>, <strong>kabin ergonomis</strong> dengan visibilitas luas, serta ketersediaan <strong>sparepart original</strong> terjamin.</p>
            </div>
        </div>
        
        <!-- FAQ 2 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Berapa kapasitas angkat maksimum Crane LiuGong?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Crane LiuGong tersedia dalam berbagai tipe dengan <strong>kapasitas angkat yang bervariasi</strong>, mulai dari <strong>10 ton hingga 100+ ton</strong>, sesuai dengan kebutuhan proyek konstruksi dan industri Anda.</p>
            </div>
        </div>
        
        <!-- FAQ 3 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Apakah PT Ganda Elang Tangguh dealer resmi Crane LiuGong di Indonesia?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Ya, <strong>PT Ganda Elang Tangguh</strong> adalah <strong>dealer resmi alat berat LiuGong</strong> di Indonesia yang melayani penjualan unit crane baru, perawatan rutin, servis berkala, pelatihan operator, dan penyediaan <strong>sparepart original</strong> dengan garansi pabrik.</p>
            </div>
        </div>
        
        <!-- FAQ 4 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Apa perbedaan mobile crane dan crawler crane?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text"><strong>Mobile crane</strong> memiliki roda untuk mobilitas di jalan raya, cocok untuk proyek dengan banyak lokasi. <strong>Crawler crane</strong> menggunakan track (rantai) untuk stabilitas maksimal di medan berat, cocok untuk proyek skala besar di satu lokasi. LiuGong menyediakan kedua jenis sesuai kebutuhan proyek Anda.</p>
            </div>
        </div>
        
        <!-- FAQ 5 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Crane LiuGong cocok untuk proyek apa saja?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Crane LiuGong sangat cocok untuk <strong>proyek konstruksi gedung bertingkat</strong>, <strong>pembangunan jembatan</strong>, <strong>proyek infrastruktur</strong>, <strong>pertambangan</strong>, <strong>industri manufaktur</strong>, <strong>pelabuhan</strong>, serta <strong>pemasangan struktur baja dan beton</strong>.</p>
            </div>
        </div>
        
        <!-- FAQ 6 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Bagaimana cara mendapatkan informasi harga dan simulasi kredit Crane LiuGong?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Anda bisa menghubungi tim sales <strong>PT Ganda Elang Tangguh</strong> melalui <a href="/contact">halaman Kontak Kami</a>, WhatsApp, telepon, atau email untuk mendapatkan <strong>informasi harga crane terbaru</strong>, spesifikasi lengkap (kapasitas angkat, tinggi angkat, berat operasi), serta simulasi kredit dengan tenor fleksibel.</p>
            </div>
        </div>
        
        <!-- FAQ 7 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Apakah tersedia layanan after-sales untuk Crane LiuGong?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Tersedia layanan purna jual lengkap termasuk <strong>garansi standar pabrik</strong>, <strong>perawatan rutin</strong> (penggantian oli, filter, pengecekan sistem hidraulik dan kelistrikan), <strong>servis mobile</strong> ke lokasi proyek, <strong>pelatihan operator</strong>, dan stok <strong>sparepart original</strong> (komponen mesin, sistem hidraulik, kabel) di gudang pusat dan cabang.</p>
            </div>
        </div>
    </div>
    
    <div class="faq-cta">
        <p>Masih ada pertanyaan? Tim kami siap membantu Anda</p>
        <a href="https://wa.me/6282355163745?text=Halo%20saya%20dapat%20nomor%20anda%20dari%20website%20Crane%20LiuGong%20dan%20ingin%20konsultasi" 
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
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
    AND p.category_id = 18
    GROUP BY 
        p.id,
        p.nama_produk,
        p.slug,
        p.gambar
    ORDER BY p.id DESC
");
$stmt->execute();
$products = $stmt->fetchAll();

$currentUrl = "https://gandaelang.co.id/warehousetruck";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Warehouse Truck LiuGong | Alat Berat Material Handling & Logistik | PT Ganda Elang Tangguh</title>
    
    <meta name="description" content="PT Ganda Elang Tangguh jual Warehouse Truck LiuGong berkualitas tinggi untuk kebutuhan gudang, logistik, dan material handling. Tersedia berbagai tipe dengan performa unggul, efisiensi, dan garansi resmi. Dapatkan harga warehouse truck terbaru disini!">
    
    <meta name="keywords" content="warehouse truck, warehouse truck liugong, material handling equipment, alat berat gudang, warehouse equipment indonesia, harga warehouse truck, electric warehouse truck, heavy equipment warehouse, logistik gudang, alat berat indonesia, dealer liugong indonesia, warehouse truck terbaik, spesifikasi warehouse truck">
    
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    
    <meta name="author" content="PT Ganda Elang Tangguh">
    <meta name="geo.region" content="ID">
    <meta name="geo.placename" content="Jakarta, Indonesia">
    <meta name="language" content="id-ID">
    
    <link rel="canonical" href="<?= $currentUrl ?>">
    <link rel="alternate" hreflang="id" href="<?= $currentUrl ?>">
    <link rel="alternate" href="<?= $currentUrl ?>" hreflang="x-default">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="Warehouse Truck LiuGong | Alat Berat Material Handling & Logistik | PT Ganda Elang Tangguh">
    <meta property="og:description" content="PT Ganda Elang Tangguh menyediakan Warehouse Truck LiuGong terbaik untuk kebutuhan gudang, logistik, dan material handling di Indonesia. Performa tangguh, efisien, dan tahan lama.">
    <meta property="og:image" content="https://gandaelang.co.id/images/warehousetruck.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Warehouse Truck LiuGong untuk gudang dan logistik">
    <meta property="og:url" content="<?= $currentUrl ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="PT Ganda Elang Tangguh">
    <meta property="og:locale" content="id_ID">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Warehouse Truck LiuGong | Alat Berat Material Handling">
    <meta name="twitter:description" content="Warehouse truck LiuGong untuk kebutuhan gudang, logistik, dan material handling.">
    <meta name="twitter:image" content="https://gandaelang.co.id/images/warehousetruck.jpg">
    <meta name="twitter:image:alt" content="Warehouse Truck LiuGong">
    
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
                "name": "Warehouse Truck LiuGong",
                "item": "https://gandaelang.co.id/warehousetruck"
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
        "description": "Dealer resmi alat berat LiuGong di Indonesia, menyediakan warehouse truck, excavator, wheel loader, bulldozer, dan alat berat lainnya untuk logistik, konstruksi, pertambangan, dan infrastruktur.",
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
        "name": "Warehouse Truck LiuGong",
        "description": "Warehouse Truck LiuGong adalah alat berat material handling untuk kebutuhan gudang, logistik, dan distribusi. Tersedia berbagai seri dengan kapasitas angkat bervariasi, sistem kontrol canggih, dan efisiensi operasional tinggi.",
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
        "category": "Alat Berat Warehouse Truck",
        "offers": {
            "@type": "Offer",
            "priceCurrency": "IDR",
            "availability": "https://schema.org/InStock",
            "url": "https://gandaelang.co.id/warehousetruck",
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
            "name": "Perusahaan Logistik, Pergudangan, Distribusi, Manufaktur"
        },
        "url": "https://gandaelang.co.id/warehousetruck"
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
                "name": "Apa keunggulan Warehouse Truck LiuGong dibandingkan merek lain?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Warehouse Truck LiuGong memiliki keunggulan seperti kapasitas angkat optimal, sistem kontrol canggih untuk operasional yang mudah, efisiensi energi tinggi, desain kompak untuk area gudang terbatas, perawatan rendah, serta ketersediaan sparepart original terjamin."
                }
            },
            {
                "@type": "Question",
                "name": "Berapa kapasitas angkat Warehouse Truck LiuGong yang tersedia?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Warehouse Truck LiuGong tersedia dalam berbagai kapasitas angkat yang bervariasi, sesuai dengan kebutuhan operasional gudang, logistik, dan material handling Anda."
                }
            },
            {
                "@type": "Question",
                "name": "Apakah PT Ganda Elang Tangguh dealer resmi Warehouse Truck LiuGong di Indonesia?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Ya, PT Ganda Elang Tangguh adalah dealer resmi alat berat LiuGong di Indonesia yang melayani penjualan unit warehouse truck baru, perawatan rutin, servis berkala, pelatihan operator, dan penyediaan sparepart original dengan garansi pabrik."
                }
            },
            {
                "@type": "Question",
                "name": "Warehouse Truck LiuGong cocok untuk industri apa saja?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Warehouse Truck LiuGong sangat cocok untuk industri logistik dan distribusi, pergudangan, manufaktur, e-commerce, retail, serta sektor industri yang membutuhkan material handling efisien."
                }
            },
            {
                "@type": "Question",
                "name": "Bagaimana cara mendapatkan informasi harga dan simulasi kredit Warehouse Truck LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Anda bisa menghubungi tim sales PT Ganda Elang Tangguh melalui WhatsApp, telepon, email, atau halaman Kontak Kami untuk mendapatkan informasi harga terbaru, spesifikasi lengkap (kapasitas angkat, tinggi angkat), serta simulasi kredit dengan tenor fleksibel sesuai kebutuhan operasional Anda."
                }
            },
            {
                "@type": "Question",
                "name": "Apakah tersedia layanan after-sales untuk Warehouse Truck LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Tersedia layanan purna jual lengkap: garansi standar pabrik, perawatan rutin (penggantian oli, filter, pengecekan sistem kelistrikan dan kontrol), servis mobile ke lokasi pelanggan, pelatihan operator, dan stok sparepart original (komponen mesin, sistem kontrol, ban) di gudang pusat dan cabang."
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
<section class="hero hero-image" style="background: url('/images/warehousetruck.jpg') center / cover no-repeat;">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-breadcrumb">
            <a href="/">Home</a>
            <span>></span>
            <a href="/produk">Produk</a>
            <span>></span>
            <span class="current">Warehouse Truck</span>
        </div>
        <!-- ===== H1 DENGAN KEYWORD ===== -->
        <h1>Warehouse Truck LiuGong untuk Logistik & Material Handling di Indonesia</h1>
        <p class="hero-subtext">
            Warehouse Truck LiuGong berkinerja tangguh, dirancang untuk <strong>kebutuhan gudang</strong>, 
            <strong>logistik</strong>, dan <strong>material handling</strong> dengan kapasitas angkat optimal, 
            efisiensi operasional, dan keamanan tinggi. Dapatkan <strong>harga warehouse truck terbaik</strong> 
            hanya di <strong>PT Ganda Elang Tangguh</strong>, dealer resmi LiuGong Indonesia.
        </p>
    </div>
</section>

<!-- ================= PRODUCT LIST SECTION ================= -->
<section class="product-list">
    <div class="product-container">
        <h2 class="product-title">Daftar Produk Warehouse Truck LiuGong</h2>
        
        <div class="product-grid">
            <?php if (!empty($products)) : ?>
                <?php foreach ($products as $row) : ?>
                    <div class="product-card">
                        <a href="/detailprodukwarehousetruck.php?slug=<?= htmlspecialchars($row['slug']); ?>" class="product-link">
                            <div class="product-image">
                                <img 
                                    src="/images/uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" 
                                    alt="<?= htmlspecialchars($row['nama_produk']); ?> - Warehouse Truck LiuGong untuk logistik dan material handling"
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
                            "description": "Warehouse Truck <?= htmlspecialchars($row['nama_produk']); ?> dari LiuGong untuk logistik, gudang, dan material handling di Indonesia.",
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
                                "url": "https://gandaelang.co.id/detailprodukwarehousetruck.php?slug=<?= htmlspecialchars($row['slug']); ?>"
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
    <h2>Mengapa Memilih Warehouse Truck LiuGong untuk Kebutuhan Logistik & Material Handling?</h2>
    <p>
        <strong>Warehouse Truck LiuGong</strong> adalah solusi alat berat terbaik untuk <strong>kebutuhan gudang</strong>, 
        <strong>logistik</strong>, dan <strong>material handling</strong> di Indonesia. Dengan teknologi canggih dari 
        LiuGong, warehouse truck ini menawarkan kombinasi sempurna antara <strong>kapasitas angkat, efisiensi, dan keamanan</strong> 
        yang dirancang untuk meningkatkan produktivitas operasional.
    </p>
    
    <h3>Spesifikasi Unggulan Warehouse Truck LiuGong</h3>
    <ul>
        <li><strong>Kapasitas Angkat:</strong> Bervariasi untuk berbagai kebutuhan</li>
        <li><strong>Tinggi Angkat:</strong> Optimal untuk operasional gudang</li>
        <li><strong>Sistem Kontrol:</strong> Canggih untuk kemudahan operasi</li>
        <li><strong>Desain:</strong> Kompak untuk area gudang terbatas</li>
        <li><strong>Efisiensi:</strong> Energi optimal untuk operasional</li>
        <li><strong>Garansi Resmi:</strong> Didukung oleh dealer resmi LiuGong di Indonesia</li>
    </ul>
    
    <h3>Keunggulan Warehouse Truck LiuGong Dibanding Merek Lain</h3>
    <p>
        Sebagai <strong>dealer resmi LiuGong</strong>, PT Ganda Elang Tangguh menawarkan warehouse truck dengan 
        <strong>harga kompetitif</strong> dan <strong>ketersediaan sparepart original</strong> yang terjamin. 
        Teknologi <strong>sistem kontrol</strong> dan <strong>kelistrikan</strong> dari LiuGong memastikan 
        efisiensi operasional yang optimal, sehingga <strong>biaya perawatan</strong> menjadi lebih 
        efisien dalam jangka panjang.
    </p>
    
    <p>
        <strong>Warehouse Truck LiuGong</strong> juga dilengkapi dengan sistem yang memungkinkan monitoring kondisi alat secara real-time, 
        membantu Anda mengoptimalkan <strong>produktivitas</strong> dan <strong>efisiensi operasional</strong> gudang. 
        Dengan berbagai tipe yang tersedia, Anda dapat memilih <strong>warehouse truck yang tepat</strong> sesuai kebutuhan spesifik operasional Anda.
    </p>
    
    <div class="seo-cta">
        <p style="font-size:18px; font-weight:600; margin-bottom:5px;">
            <i class="fas fa-phone" style="color:#e31e24;"></i> 
            Dapatkan Harga Warehouse Truck Terbaik Sekarang!
        </p>
        <p style="font-size:15px; margin-bottom:0;">
            Hubungi tim sales <strong>PT Ganda Elang Tangguh</strong> untuk konsultasi gratis dan penawaran spesial 
            untuk kebutuhan logistik Anda. Kami siap membantu Anda memilih <strong>warehouse truck LiuGong</strong> 
            yang paling sesuai dengan kebutuhan dan anggaran.
        </p>
    </div>
</section>

<!-- ================= FAQ SECTION ================= -->
<section class="faq-section">
    <div class="faq-header">
        <h2>Pertanyaan Umum Seputar Warehouse Truck LiuGong</h2>
        <p>Temukan jawaban atas pertanyaan yang sering diajukan tentang Warehouse Truck LiuGong, mulai dari spesifikasi, harga, hingga layanan purna jual.</p>
    </div>
    
    <div class="faq-grid" itemscope="" itemtype="https://schema.org/FAQPage">
        
        <!-- FAQ 1 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Apa keunggulan Warehouse Truck LiuGong dibandingkan merek lain?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Warehouse Truck LiuGong memiliki keunggulan seperti <strong>kapasitas angkat optimal</strong>, <strong>sistem kontrol canggih</strong> untuk operasional yang mudah, <strong>efisiensi energi tinggi</strong>, <strong>desain kompak</strong> untuk area gudang terbatas, <strong>perawatan rendah</strong>, serta ketersediaan <strong>sparepart original</strong> terjamin.</p>
            </div>
        </div>
        
        <!-- FAQ 2 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Berapa kapasitas angkat Warehouse Truck LiuGong yang tersedia?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Warehouse Truck LiuGong tersedia dalam berbagai <strong>kapasitas angkat yang bervariasi</strong>, sesuai dengan kebutuhan operasional gudang, logistik, dan material handling Anda.</p>
            </div>
        </div>
        
        <!-- FAQ 3 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Apakah PT Ganda Elang Tangguh dealer resmi Warehouse Truck LiuGong di Indonesia?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Ya, <strong>PT Ganda Elang Tangguh</strong> adalah <strong>dealer resmi alat berat LiuGong</strong> di Indonesia yang melayani penjualan unit warehouse truck baru, perawatan rutin, servis berkala, pelatihan operator, dan penyediaan <strong>sparepart original</strong> dengan garansi pabrik.</p>
            </div>
        </div>
        
        <!-- FAQ 4 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Warehouse Truck LiuGong cocok untuk industri apa saja?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Warehouse Truck LiuGong sangat cocok untuk industri <strong>logistik dan distribusi</strong>, <strong>pergudangan</strong>, <strong>manufaktur</strong>, <strong>e-commerce</strong>, <strong>retail</strong>, serta sektor industri yang membutuhkan material handling efisien.</p>
            </div>
        </div>
        
        <!-- FAQ 5 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Bagaimana cara mendapatkan informasi harga dan simulasi kredit Warehouse Truck LiuGong?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Anda bisa menghubungi tim sales <strong>PT Ganda Elang Tangguh</strong> melalui <a href="/contact">halaman Kontak Kami</a>, WhatsApp, telepon, atau email untuk mendapatkan <strong>informasi harga warehouse truck terbaru</strong>, spesifikasi lengkap (kapasitas angkat, tinggi angkat), serta simulasi kredit dengan tenor fleksibel.</p>
            </div>
        </div>
        
        <!-- FAQ 6 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Apakah tersedia layanan after-sales untuk Warehouse Truck LiuGong?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Tersedia layanan purna jual lengkap termasuk <strong>garansi standar pabrik</strong>, <strong>perawatan rutin</strong> (penggantian oli, filter, pengecekan sistem kelistrikan dan kontrol), <strong>servis mobile</strong> ke lokasi pelanggan, <strong>pelatihan operator</strong>, dan stok <strong>sparepart original</strong> (komponen mesin, sistem kontrol, ban) di gudang pusat dan cabang.</p>
            </div>
        </div>
    </div>
    
    <div class="faq-cta">
        <p>Masih ada pertanyaan? Tim kami siap membantu Anda</p>
        <a href="https://wa.me/6282355163745?text=Halo%20saya%20dapat%20nomor%20anda%20dari%20website%20Warehouse%20Truck%20LiuGong%20dan%20ingin%20konsultasi" 
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
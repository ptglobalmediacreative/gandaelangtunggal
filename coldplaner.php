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
      AND p.category_id = 8
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

$currentUrl = "https://gandaelang.co.id/coldplaner";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Cold Planer LiuGong | Alat Berat Konstruksi Jalan | PT Ganda Elang Tangguh</title>
    
    <meta name="description" content="PT Ganda Elang Tangguh jual Cold Milling Machine / Cold Planer LiuGong berkualitas tinggi untuk pengupasan aspal, konstruksi jalan, dan infrastruktur. Tersedia berbagai tipe dengan performa unggul, sistem milling presisi, dan efisiensi bahan bakar. Dapatkan harga cold planer terbaru disini!">
    
    <meta name="keywords" content="cold planer, cold milling machine, cold planer liugong, alat berat cold planer, harga cold planer, cold planer indonesia, heavy equipment cold planer, cold planer untuk konstruksi jalan, pengupasan aspal, alat berat indonesia, dealer liugong indonesia, cold planer terbaik, spesifikasi cold planer, cold milling">
    
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    
    <meta name="author" content="PT Ganda Elang Tangguh">
    <meta name="geo.region" content="ID">
    <meta name="geo.placename" content="Jakarta, Indonesia">
    <meta name="language" content="id-ID">
    
    <link rel="canonical" href="<?= $currentUrl ?>">
    <link rel="alternate" hreflang="id" href="<?= $currentUrl ?>">
    <link rel="alternate" href="<?= $currentUrl ?>" hreflang="x-default">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="Cold Milling Machine / Cold Planer LiuGong | Alat Berat Konstruksi Jalan | PT Ganda Elang Tangguh">
    <meta property="og:description" content="PT Ganda Elang Tangguh menyediakan Cold Milling Machine / Cold Planer LiuGong terbaik untuk pengupasan aspal, konstruksi jalan, dan infrastruktur di Indonesia. Performa presisi, efisien, dan tahan lama.">
    <meta property="og:image" content="https://gandaelang.co.id/images/coldplaner.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Cold Planer LiuGong untuk konstruksi jalan dan pengupasan aspal">
    <meta property="og:url" content="<?= $currentUrl ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="PT Ganda Elang Tangguh">
    <meta property="og:locale" content="id_ID">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Cold Planer LiuGong | Alat Berat Indonesia">
    <meta name="twitter:description" content="Cold milling machine / cold planer LiuGong presisi untuk pengupasan aspal dan konstruksi jalan. Tersedia berbagai tipe dengan performa terbaik.">
    <meta name="twitter:image" content="https://gandaelang.co.id/images/coldplaner.jpg">
    <meta name="twitter:image:alt" content="Cold Planer LiuGong">
    
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
                "name": "Cold Planer LiuGong",
                "item": "https://gandaelang.co.id/coldplaner"
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
        "description": "Dealer resmi alat berat LiuGong di Indonesia, menyediakan cold planer, excavator, wheel loader, bulldozer, dan alat berat lainnya untuk konstruksi, pertambangan, dan infrastruktur.",
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
        "name": "Cold Milling Machine / Cold Planer LiuGong",
        "description": "Cold Milling Machine / Cold Planer LiuGong adalah alat berat untuk pekerjaan pengupasan aspal, konstruksi jalan, dan perbaikan infrastruktur. Tersedia berbagai seri dengan sistem milling presisi, lebar pengupasan bervariasi, dan kabin ergonomis untuk kenyamanan operator.",
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
        "category": "Alat Berat Cold Planer",
        "offers": {
            "@type": "Offer",
            "priceCurrency": "IDR",
            "availability": "https://schema.org/InStock",
            "url": "https://gandaelang.co.id/coldplaner",
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
            "name": "Kontraktor Jalan, Perusahaan Konstruksi, Proyek Infrastruktur Pemerintah"
        },
        "url": "https://gandaelang.co.id/coldplaner"
    }
    </script>
    
    <!-- FAQ Schema (LENGKAP 7 PERTANYAAN) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {
                "@type": "Question",
                "name": "Apa keunggulan Cold Planer LiuGong dibandingkan merek lain?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Cold Planer LiuGong memiliki keunggulan seperti sistem milling presisi untuk pengupasan aspal yang merata, lebar pengupasan yang bervariasi, tenaga mesin optimal, kabin ergonomis dengan visibilitas luas, sistem kontrol canggih untuk efisiensi kerja, serta biaya perawatan yang kompetitif dengan ketersediaan suku cadang original."
                }
            },
            {
                "@type": "Question",
                "name": "Berapa lebar pengupasan dan kedalaman milling Cold Planer LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Cold Planer LiuGong tersedia dalam berbagai seri dengan lebar pengupasan yang bervariasi dan kedalaman milling yang dapat disesuaikan dengan kebutuhan proyek konstruksi jalan dan infrastruktur Anda."
                }
            },
            {
                "@type": "Question",
                "name": "Apakah PT Ganda Elang Tangguh dealer resmi Cold Planer LiuGong di Indonesia?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Ya, PT Ganda Elang Tangguh adalah dealer resmi alat berat LiuGong di Indonesia yang melayani penjualan unit cold planer baru, perawatan rutin, servis berkala, pelatihan operator, dan penyediaan sparepart original dengan garansi pabrik."
                }
            },
            {
                "@type": "Question",
                "name": "Apa perbedaan cold planer dengan cold milling machine?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Cold planer dan cold milling machine adalah istilah yang sama untuk alat berat pengupas aspal. LiuGong menyediakan cold planer dengan teknologi canggih untuk pengupasan aspal yang presisi dan efisien sesuai standar konstruksi jalan modern."
                }
            },
            {
                "@type": "Question",
                "name": "Cold Planer LiuGong cocok untuk proyek apa saja?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Cold Planer LiuGong sangat cocok untuk pengupasan aspal lama pada proyek perbaikan jalan, rekonstruksi jalan, pembangunan jalan tol, pengupasan permukaan jalan perkotaan, serta proyek infrastruktur pemerintahan."
                }
            },
            {
                "@type": "Question",
                "name": "Bagaimana cara mendapatkan informasi harga dan simulasi kredit Cold Planer LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Anda bisa menghubungi tim sales PT Ganda Elang Tangguh melalui WhatsApp, telepon, email, atau halaman Kontak Kami untuk mendapatkan informasi harga terbaru, spesifikasi lengkap (lebar pengupasan, kedalaman milling, tenaga mesin), serta simulasi kredit dengan tenor fleksibel sesuai kebutuhan proyek Anda."
                }
            },
            {
                "@type": "Question",
                "name": "Apakah tersedia layanan after-sales untuk Cold Planer LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Tersedia layanan purna jual lengkap: garansi standar pabrik, perawatan rutin (penggantian oli, filter, pengecekan sistem milling dan hidraulik), servis mobile ke lokasi proyek, pelatihan operator, dan stok sparepart original (milling drum, cutting tools, komponen mesin, sistem hidraulik) di gudang pusat dan cabang."
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
<section class="hero hero-image" style="background: url('/images/coldplaner.jpg') center / cover no-repeat;">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-breadcrumb">
            <a href="/">Home</a>
            <span>></span>
            <a href="/produk">Produk</a>
            <span>></span>
            <span class="current">Cold Planer</span>
        </div>
        <!-- ===== H1 DENGAN KEYWORD ===== -->
        <h1>Cold Planer LiuGong untuk Konstruksi Jalan & Pengupasan Aspal di Indonesia</h1>
        <p class="hero-subtext">
            Cold Planer / Cold Milling Machine LiuGong berkinerja presisi, dirancang untuk <strong>pengupasan aspal</strong>, 
            <strong>konstruksi jalan</strong>, dan <strong>perbaikan infrastruktur</strong> dengan hasil berkualitas tinggi 
            dan efisiensi operasional. Dapatkan <strong>harga cold planer terbaik</strong> hanya di 
            <strong>PT Ganda Elang Tangguh</strong>, dealer resmi LiuGong Indonesia.
        </p>
    </div>
</section>

<!-- ================= PRODUCT LIST SECTION ================= -->
<section class="product-list">
    <div class="product-container">
        <h2 class="product-title">Daftar Produk Cold Planer LiuGong</h2>
        
        <div class="product-grid">
            <?php if (!empty($products)) : ?>
                <?php foreach ($products as $row) : ?>
                    <div class="product-card">
                        <a href="/detailprodukcoldplaner.php?slug=<?= htmlspecialchars($row['slug']); ?>" class="product-link">
                            <div class="product-image">
                                <img 
                                    src="/images/uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" 
                                    alt="<?= htmlspecialchars($row['nama_produk']); ?> - Cold Planer LiuGong untuk konstruksi jalan dan pengupasan aspal"
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
                            "description": "Cold Planer <?= htmlspecialchars($row['nama_produk']); ?> dari LiuGong untuk konstruksi jalan, pengupasan aspal, dan infrastruktur di Indonesia.",
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
                                "url": "https://gandaelang.co.id/detailprodukcoldplaner.php?slug=<?= htmlspecialchars($row['slug']); ?>"
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
    <h2>Mengapa Memilih Cold Planer LiuGong untuk Proyek Pengupasan Aspal Anda?</h2>
    <p>
        <strong>Cold Planer / Cold Milling Machine LiuGong</strong> adalah solusi alat berat terbaik untuk <strong>pengupasan aspal</strong>, 
        <strong>konstruksi jalan</strong>, dan <strong>perbaikan infrastruktur</strong> di Indonesia. Dengan teknologi canggih dari 
        LiuGong, cold planer ini menawarkan kombinasi sempurna antara <strong>presisi pengupasan, efisiensi, dan ketahanan</strong> 
        yang dirancang untuk menghadapi berbagai tantangan proyek konstruksi jalan.
    </p>
    
    <h3>Spesifikasi Unggulan Cold Planer LiuGong</h3>
    <ul>
        <li><strong>Lebar Pengupasan:</strong> Bervariasi untuk berbagai kebutuhan proyek</li>
        <li><strong>Kedalaman Milling:</strong> Dapat disesuaikan dengan kebutuhan</li>
        <li><strong>Tenaga Mesin:</strong> Optimal untuk performa maksimal</li>
        <li><strong>Sistem Milling:</strong> Presisi untuk hasil pengupasan yang rata dan berkualitas</li>
        <li><strong>Sistem Kontrol:</strong> Canggih untuk efisiensi kerja</li>
        <li><strong>Kabin:</strong> Ergonomis dengan visibilitas luas untuk kenyamanan operator</li>
        <li><strong>Garansi Resmi:</strong> Didukung oleh dealer resmi LiuGong di Indonesia</li>
    </ul>
    
    <h3>Keunggulan Cold Planer LiuGong Dibanding Merek Lain</h3>
    <p>
        Sebagai <strong>dealer resmi LiuGong</strong>, PT Ganda Elang Tangguh menawarkan cold planer dengan 
        <strong>harga kompetitif</strong> dan <strong>ketersediaan sparepart original</strong> yang terjamin. 
        Teknologi <strong>sistem milling</strong> dan <strong>engine technology</strong> dari LiuGong memastikan 
        hasil pengupasan yang presisi dengan efisiensi bahan bakar yang optimal, sehingga <strong>biaya perawatan</strong> 
        menjadi lebih efisien dalam jangka panjang.
    </p>
    
    <p>
        <strong>Cold Planer LiuGong</strong> juga dilengkapi dengan sistem yang memungkinkan kontrol presisi dalam 
        pekerjaan pengupasan aspal, membantu Anda mengoptimalkan <strong>produktivitas</strong> dan 
        <strong>efisiensi operasional</strong> proyek. Dengan berbagai tipe yang tersedia, Anda dapat memilih 
        <strong>cold planer yang tepat</strong> sesuai kebutuhan spesifik proyek Anda.
    </p>
    
    <div class="seo-cta">
        <p style="font-size:18px; font-weight:600; margin-bottom:5px;">
            <i class="fas fa-phone" style="color:#e31e24;"></i> 
            Dapatkan Harga Cold Planer Terbaik Sekarang!
        </p>
        <p style="font-size:15px; margin-bottom:0;">
            Hubungi tim sales <strong>PT Ganda Elang Tangguh</strong> untuk konsultasi gratis dan penawaran spesial 
            untuk proyek Anda. Kami siap membantu Anda memilih <strong>cold planer LiuGong</strong> yang paling sesuai 
            dengan kebutuhan dan anggaran.
        </p>
    </div>
</section>

<!-- ================= FAQ SECTION ================= -->
<section class="faq-section">
    <div class="faq-header">
        <h2>Pertanyaan Umum Seputar Cold Planer LiuGong</h2>
        <p>Temukan jawaban atas pertanyaan yang sering diajukan tentang Cold Planer LiuGong, mulai dari spesifikasi, harga, hingga layanan purna jual.</p>
    </div>
    
    <div class="faq-grid" itemscope="" itemtype="https://schema.org/FAQPage">
        
        <!-- FAQ 1 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Apa keunggulan Cold Planer LiuGong dibandingkan merek lain?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Cold Planer LiuGong memiliki keunggulan seperti <strong>sistem milling presisi</strong> untuk pengupasan aspal yang merata, <strong>lebar pengupasan yang bervariasi</strong>, <strong>tenaga mesin optimal</strong>, <strong>kabin ergonomis</strong> dengan visibilitas luas, <strong>sistem kontrol canggih</strong> untuk efisiensi kerja, serta <strong>biaya perawatan</strong> yang kompetitif dengan ketersediaan suku cadang original.</p>
            </div>
        </div>
        
        <!-- FAQ 2 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Berapa lebar pengupasan dan kedalaman milling Cold Planer LiuGong?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Cold Planer LiuGong tersedia dalam berbagai seri dengan <strong>lebar pengupasan yang bervariasi</strong> dan <strong>kedalaman milling</strong> yang dapat disesuaikan dengan kebutuhan proyek konstruksi jalan dan infrastruktur Anda.</p>
            </div>
        </div>
        
        <!-- FAQ 3 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Apakah PT Ganda Elang Tangguh dealer resmi Cold Planer LiuGong di Indonesia?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Ya, <strong>PT Ganda Elang Tangguh</strong> adalah <strong>dealer resmi alat berat LiuGong</strong> di Indonesia yang melayani penjualan unit cold planer baru, perawatan rutin, servis berkala, pelatihan operator, dan penyediaan <strong>sparepart original</strong> dengan garansi pabrik.</p>
            </div>
        </div>
        
        <!-- FAQ 4 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Apa perbedaan cold planer dengan cold milling machine?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Cold planer dan cold milling machine adalah istilah yang sama untuk alat berat pengupas aspal. LiuGong menyediakan cold planer dengan teknologi canggih untuk pengupasan aspal yang <strong>presisi dan efisien</strong> sesuai standar konstruksi jalan modern.</p>
            </div>
        </div>
        
        <!-- FAQ 5 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Cold Planer LiuGong cocok untuk proyek apa saja?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Cold Planer LiuGong sangat cocok untuk <strong>pengupasan aspal lama</strong> pada proyek perbaikan jalan, <strong>rekonstruksi jalan</strong>, <strong>pembangunan jalan tol</strong>, <strong>pengupasan permukaan jalan perkotaan</strong>, serta proyek infrastruktur pemerintahan.</p>
            </div>
        </div>
        
        <!-- FAQ 6 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Bagaimana cara mendapatkan informasi harga dan simulasi kredit Cold Planer LiuGong?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Anda bisa menghubungi tim sales <strong>PT Ganda Elang Tangguh</strong> melalui <a href="/contact">halaman Kontak Kami</a>, WhatsApp, telepon, atau email untuk mendapatkan <strong>informasi harga cold planer terbaru</strong>, spesifikasi lengkap (lebar pengupasan, kedalaman milling, tenaga mesin), serta simulasi kredit dengan tenor fleksibel.</p>
            </div>
        </div>
        
        <!-- FAQ 7 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Apakah tersedia layanan after-sales untuk Cold Planer LiuGong?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Tersedia layanan purna jual lengkap termasuk <strong>garansi standar pabrik</strong>, <strong>perawatan rutin</strong> (penggantian oli, filter, pengecekan sistem milling dan hidraulik), <strong>servis mobile</strong> ke lokasi proyek, <strong>pelatihan operator</strong>, dan stok <strong>sparepart original</strong> (milling drum, cutting tools, komponen mesin, sistem hidraulik) di gudang pusat dan cabang.</p>
            </div>
        </div>
    </div>
    
    <div class="faq-cta">
        <p>Masih ada pertanyaan? Tim kami siap membantu Anda</p>
        <a href="https://wa.me/6282355163745?text=Halo%20saya%20dapat%20nomor%20anda%20dari%20website%20Cold%20Planer%20LiuGong%20dan%20ingin%20konsultasi" 
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
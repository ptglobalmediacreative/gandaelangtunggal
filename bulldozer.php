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
      AND p.category_id = 3
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

$currentUrl = "https://gandaelang.co.id/bulldozer.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Bulldozer LiuGong | Alat Berat Konstruksi & Pertambangan | PT Ganda Elang Tangguh</title>
    
    <meta name="description" content="PT Ganda Elang Tangguh jual Bulldozer LiuGong berkualitas tinggi untuk konstruksi, pertambangan, perkebunan, dan infrastruktur. Tersedia berbagai tipe dengan tenaga mesin hingga 550 HP, kapasitas blade hingga 10m³, dan garansi resmi. Dapatkan harga bulldozer terbaru disini!">
    
    <meta name="keywords" content="bulldozer, bulldozer liugong, alat berat bulldozer, harga bulldozer, bulldozer indonesia, heavy equipment bulldozer, bulldozer untuk konstruksi, bulldozer pertambangan, alat berat indonesia, dealer liugong indonesia, bulldozer terbaik, spesifikasi bulldozer, bulldozer LD25D, bulldozer LD40D">
    
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    
    <meta name="author" content="PT Ganda Elang Tangguh">
    <meta name="geo.region" content="ID">
    <meta name="geo.placename" content="Jakarta, Indonesia">
    <meta name="language" content="id-ID">
    
    <link rel="canonical" href="<?= $currentUrl ?>">
    <link rel="alternate" hreflang="id" href="<?= $currentUrl ?>">
    <link rel="alternate" href="<?= $currentUrl ?>" hreflang="x-default">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="Bulldozer LiuGong | Alat Berat untuk Konstruksi & Pertambangan | PT Ganda Elang Tangguh">
    <meta property="og:description" content="PT Ganda Elang Tangguh menyediakan Bulldozer LiuGong terbaik untuk land clearing, penggusuran tanah, overburden tambang, dan konstruksi infrastruktur di Indonesia. Performa tangguh, efisien, dan tahan lama. Tersedia berbagai tipe dengan tenaga hingga 550 HP.">
    <meta property="og:image" content="https://gandaelang.co.id/images/bulldozer.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Bulldozer LiuGong untuk konstruksi dan pertambangan">
    <meta property="og:url" content="<?= $currentUrl ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="PT Ganda Elang Tangguh">
    <meta property="og:locale" content="id_ID">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Bulldozer LiuGong | Alat Berat Indonesia">
    <meta name="twitter:description" content="Bulldozer LiuGong tangguh untuk land clearing, tambang, dan konstruksi. Tenaga besar, undercarriage kokoh, efisiensi bahan bakar optimal.">
    <meta name="twitter:image" content="https://gandaelang.co.id/images/bulldozer.jpg">
    <meta name="twitter:image:alt" content="Bulldozer LiuGong">
    
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
                "name": "Bulldozer LiuGong",
                "item": "https://gandaelang.co.id/bulldozer.php"
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
        "description": "Dealer resmi alat berat LiuGong di Indonesia, menyediakan bulldozer, excavator, wheel loader, dan alat berat lainnya untuk konstruksi, pertambangan, dan infrastruktur.",
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
        "name": "Bulldozer LiuGong",
        "description": "Bulldozer LiuGong adalah alat berat dengan tenaga dorong besar untuk pekerjaan land clearing, penggusuran tanah, overburden tambang, dan konstruksi infrastruktur. Tersedia berbagai seri dari 10 ton hingga 70+ ton dengan tenaga mesin 120-550+ HP, kapasitas blade 1,8-10+ m³, serta undercarriage tahan aus untuk medan ekstrem.",
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
        "category": "Alat Berat Bulldozer",
        "offers": {
            "@type": "Offer",
            "priceCurrency": "IDR",
            "availability": "https://schema.org/InStock",
            "url": "https://gandaelang.co.id/bulldozer.php",
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
            "name": "Kontraktor, Perusahaan Tambang, Perkebunan Skala Besar, Proyek Infrastruktur"
        },
        "url": "https://gandaelang.co.id/bulldozer.php"
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
                "name": "Apa keunggulan Bulldozer LiuGong dibandingkan merek lain?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Bulldozer LiuGong memiliki keunggulan: tenaga tarik (drawbar pull) besar untuk pekerjaan dorong dan gusur tanah berat, sistem hidraulik responsif, undercarriage berkualitas tinggi dengan ketahanan aus luar biasa, kabin ergonomis dengan visibilitas optimal, serta biaya perawatan yang kompetitif."
                }
            },
            {
                "@type": "Question",
                "name": "Berapa kapasitas blade dan tenaga mesin Bulldozer LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Bulldozer LiuGong tersedia dalam berbagai kelas mulai dari 10 ton hingga 70+ ton. Kapasitas blade (pisau dorong) mulai dari 1,8m³ hingga 10m³+ untuk model besar, dengan tenaga mesin dari 120 HP hingga 550+ HP, dan berat operasi berkisar antara 10.000 kg hingga 70.000 kg."
                }
            },
            {
                "@type": "Question",
                "name": "Apakah PT Ganda Elang Tangguh dealer resmi Bulldozer LiuGong di Indonesia?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Ya, PT Ganda Elang Tangguh adalah dealer resmi alat berat LiuGong di Indonesia yang melayani penjualan unit bulldozer baru, perawatan rutin (termasuk undercarriage), servis berkala, pelatihan operator, dan penyediaan sparepart original dengan garansi pabrik."
                }
            },
            {
                "@type": "Question",
                "name": "Apa perbedaan blade straight (S-blade) dan universal (U-blade) pada Bulldozer LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Straight blade (S-blade) cocok untuk pekerjaan grading dan perataan tanah dengan material keras, tanpa sisi lengkung. Universal blade (U-blade) memiliki sisi lengkung untuk kapasitas dorong lebih besar, ideal untuk memindahkan material dalam jarak menengah seperti tanah lepas dan batubara. LiuGong menyediakan kedua opsi sesuai kebutuhan proyek Anda."
                }
            },
            {
                "@type": "Question",
                "name": "Industri apa saja yang cocok menggunakan Bulldozer LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Bulldozer LiuGong sangat cocok untuk pekerjaan land clearing (pembukaan lahan), penggusuran tanah dan batuan, pembuatan terasering di perkebunan (sawit, karet), konstruksi jalan dan tanggul, reklamasi lahan, pertambangan (overburden removal), serta proyek irigasi dan bendungan."
                }
            },
            {
                "@type": "Question",
                "name": "Bagaimana cara mendapatkan informasi harga dan simulasi kredit Bulldozer LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Anda bisa menghubungi tim sales PT Ganda Elang Tangguh melalui WhatsApp, telepon, email, atau halaman Kontak Kami untuk mendapatkan informasi harga terbaru, spesifikasi lengkap (tenaga mesin, kapasitas blade, berat operasi), serta simulasi kredit dengan tenor fleksibel sesuai kebutuhan proyek Anda."
                }
            },
            {
                "@type": "Question",
                "name": "Apakah tersedia layanan after-sales untuk Bulldozer LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Tersedia layanan purna jual lengkap: garansi standar pabrik, perawatan rutin undercarriage (track shoe, track link, roller), penggantian oli dan filter, servis mobile ke lokasi proyek, pelatihan operator, dan stok sparepart original (termasuk blade, track, komponen mesin) di gudang pusat dan cabang."
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
<section class="hero hero-image" style="background: url('/images/bulldozer.jpg') center / cover no-repeat;">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-breadcrumb">
            <a href="/index.php">Home</a>
            <span>></span>
            <a href="/produk.php">Produk</a>
            <span>></span>
            <span class="current">Bulldozer</span>
        </div>
        <!-- ===== H1 DENGAN KEYWORD ===== -->
        <h1>Bulldozer LiuGong untuk Konstruksi & Pertambangan di Indonesia</h1>
        <p class="hero-subtext">
            Bulldozer LiuGong berkinerja tinggi, dirancang untuk <strong>land clearing</strong>, 
            <strong>pertambangan</strong>, dan <strong>konstruksi infrastruktur</strong> dengan tenaga dorong luar biasa 
            dan efisiensi bahan bakar optimal. Dapatkan <strong>harga bulldozer terbaik</strong> hanya di 
            <strong>PT Ganda Elang Tangguh</strong>, dealer resmi LiuGong Indonesia.
        </p>
    </div>
</section>

<!-- ================= PRODUCT LIST SECTION ================= -->
<section class="product-list">
    <div class="product-container">
        <h2 class="product-title">Daftar Produk Bulldozer LiuGong</h2>
        
        <div class="product-grid">
            <?php if (!empty($products)) : ?>
                <?php foreach ($products as $row) : ?>
                    <div class="product-card">
                        <a href="/detailprodukbulldozer.php?slug=<?= htmlspecialchars($row['slug']); ?>" class="product-link">
                            <div class="product-image">
                                <img 
                                    src="/images/uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" 
                                    alt="<?= htmlspecialchars($row['nama_produk']); ?> - Bulldozer LiuGong untuk konstruksi dan pertambangan"
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
                            "description": "Bulldozer <?= htmlspecialchars($row['nama_produk']); ?> dari LiuGong untuk konstruksi, pertambangan, dan land clearing di Indonesia.",
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
                                "url": "https://gandaelang.co.id/detailprodukbulldozer.php?slug=<?= htmlspecialchars($row['slug']); ?>"
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
    <h2>Mengapa Memilih Bulldozer LiuGong untuk Proyek Anda?</h2>
    <p>
        <strong>Bulldozer LiuGong</strong> adalah solusi alat berat terbaik untuk <strong>land clearing</strong>, 
        <strong>pertambangan</strong>, dan <strong>konstruksi infrastruktur</strong> di Indonesia. Dengan teknologi canggih dari 
        LiuGong, bulldozer ini menawarkan kombinasi sempurna antara <strong>tenaga dorong, efisiensi, dan ketahanan</strong> 
        yang dirancang untuk menghadapi berbagai tantangan medan di lapangan.
    </p>
    
    <h3>Spesifikasi Unggulan Bulldozer LiuGong</h3>
    <ul>
        <li><strong>Kapasitas Blade:</strong> 1.8m³ - 10m³+ untuk berbagai kebutuhan proyek</li>
        <li><strong>Operating Weight:</strong> 10 ton - 70+ ton menjamin stabilitas optimal</li>
        <li><strong>Tenaga Mesin:</strong> 120 HP - 550+ HP untuk performa maksimal</li>
        <li><strong>Sistem Hidrolik:</strong> Responsif untuk kontrol blade presisi</li>
        <li><strong>Undercarriage:</strong> Berkualitas tinggi dengan ketahanan aus luar biasa</li>
        <li><strong>Kabin:</strong> Ergonomis dengan visibilitas optimal untuk kenyamanan operator</li>
        <li><strong>Garansi Resmi:</strong> Didukung oleh dealer resmi LiuGong di Indonesia</li>
    </ul>
    
    <h3>Keunggulan Bulldozer LiuGong Dibanding Merek Lain</h3>
    <p>
        Sebagai <strong>dealer resmi LiuGong</strong>, PT Ganda Elang Tangguh menawarkan bulldozer dengan 
        <strong>harga kompetitif</strong> dan <strong>ketersediaan sparepart original</strong> yang terjamin. 
        Teknologi <strong>undercarriage</strong> dan <strong>engine technology</strong> dari LiuGong memastikan 
        efisiensi bahan bakar yang optimal dan daya tahan komponen yang lebih lama, sehingga <strong>biaya perawatan</strong> 
        menjadi lebih efisien dalam jangka panjang.
    </p>
    
    <p>
        <strong>Bulldozer LiuGong</strong> juga dilengkapi dengan sistem <strong>telematik</strong> yang memungkinkan 
        monitoring kondisi alat secara real-time, membantu Anda mengoptimalkan <strong>produktivitas</strong> dan 
        <strong>efisiensi operasional</strong> proyek. Dengan berbagai tipe yang tersedia, mulai dari skala kecil 
        hingga besar, Anda dapat memilih <strong>bulldozer yang tepat</strong> sesuai kebutuhan spesifik proyek Anda.
    </p>
    
    <div class="seo-cta">
        <p style="font-size:18px; font-weight:600; margin-bottom:5px;">
            <i class="fas fa-phone" style="color:#e31e24;"></i> 
            Dapatkan Harga Bulldozer Terbaik Sekarang!
        </p>
        <p style="font-size:15px; margin-bottom:0;">
            Hubungi tim sales <strong>PT Ganda Elang Tangguh</strong> untuk konsultasi gratis dan penawaran spesial 
            untuk proyek Anda. Kami siap membantu Anda memilih <strong>bulldozer LiuGong</strong> yang paling sesuai 
            dengan kebutuhan dan anggaran.
        </p>
    </div>
</section>

<!-- ================= FAQ SECTION ================= -->
<section class="faq-section">
    <div class="faq-header">
        <h2>Pertanyaan Umum Seputar Bulldozer LiuGong</h2>
        <p>Temukan jawaban atas pertanyaan yang sering diajukan tentang Bulldozer LiuGong, mulai dari spesifikasi, harga, hingga layanan purna jual.</p>
    </div>
    
    <div class="faq-grid" itemscope="" itemtype="https://schema.org/FAQPage">
        
        <!-- FAQ 1 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Apa keunggulan Bulldozer LiuGong dibandingkan merek lain?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Bulldozer LiuGong memiliki keunggulan seperti <strong>tenaga tarik (drawbar pull)</strong> besar untuk pekerjaan dorong dan gusur tanah berat, <strong>sistem hidraulik responsif</strong>, <strong>undercarriage berkualitas tinggi</strong> dengan ketahanan aus luar biasa, <strong>kabin ergonomis</strong> dengan visibilitas optimal, serta <strong>biaya perawatan</strong> yang kompetitif.</p>
            </div>
        </div>
        
        <!-- FAQ 2 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Berapa kapasitas blade dan tenaga mesin Bulldozer LiuGong?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Bulldozer LiuGong tersedia dalam berbagai kelas mulai dari <strong>10 ton hingga 70+ ton</strong>. Kapasitas blade (pisau dorong) mulai dari <strong>1,8m³ hingga 10m³+</strong> untuk model besar, dengan tenaga mesin dari <strong>120 HP hingga 550+ HP</strong>, dan berat operasi berkisar antara <strong>10.000 kg hingga 70.000 kg</strong>.</p>
            </div>
        </div>
        
        <!-- FAQ 3 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Apakah PT Ganda Elang Tangguh dealer resmi Bulldozer LiuGong di Indonesia?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Ya, <strong>PT Ganda Elang Tangguh</strong> adalah <strong>dealer resmi alat berat LiuGong</strong> di Indonesia yang melayani penjualan unit bulldozer baru, perawatan rutin (termasuk undercarriage), servis berkala, pelatihan operator, dan penyediaan <strong>sparepart original</strong> dengan garansi pabrik.</p>
            </div>
        </div>
        
        <!-- FAQ 4 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Apa perbedaan blade straight (S-blade) dan universal (U-blade) pada Bulldozer LiuGong?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text"><strong>Straight blade (S-blade)</strong> cocok untuk pekerjaan grading dan perataan tanah dengan material keras, tanpa sisi lengkung. <strong>Universal blade (U-blade)</strong> memiliki sisi lengkung untuk kapasitas dorong lebih besar, ideal untuk memindahkan material dalam jarak menengah seperti tanah lepas dan batubara. LiuGong menyediakan kedua opsi sesuai kebutuhan proyek Anda.</p>
            </div>
        </div>
        
        <!-- FAQ 5 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Industri apa saja yang cocok menggunakan Bulldozer LiuGong?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Bulldozer LiuGong sangat cocok untuk pekerjaan <strong>land clearing</strong> (pembukaan lahan), <strong>penggusuran tanah dan batuan</strong>, <strong>pembuatan terasering</strong> di perkebunan (sawit, karet), <strong>konstruksi jalan dan tanggul</strong>, <strong>reklamasi lahan</strong>, <strong>pertambangan</strong> (overburden removal), serta <strong>proyek irigasi dan bendungan</strong>.</p>
            </div>
        </div>
        
        <!-- FAQ 6 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Bagaimana cara mendapatkan informasi harga dan simulasi kredit Bulldozer LiuGong?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Anda bisa menghubungi tim sales <strong>PT Ganda Elang Tangguh</strong> melalui <a href="/contact.php">halaman Kontak Kami</a>, WhatsApp, telepon, atau email untuk mendapatkan <strong>informasi harga bulldozer terbaru</strong>, spesifikasi lengkap (tenaga mesin, kapasitas blade, berat operasi), serta simulasi kredit dengan tenor fleksibel.</p>
            </div>
        </div>
        
        <!-- FAQ 7 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Apakah tersedia layanan after-sales untuk Bulldozer LiuGong?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Tersedia layanan purna jual lengkap termasuk <strong>garansi standar pabrik</strong>, <strong>perawatan rutin undercarriage</strong> (track shoe, track link, roller), <strong>penggantian oli dan filter</strong>, <strong>servis mobile</strong> ke lokasi proyek, <strong>pelatihan operator</strong>, dan stok <strong>sparepart original</strong> (termasuk blade, track, komponen mesin) di gudang pusat dan cabang.</p>
            </div>
        </div>
    </div>
    
    <div class="faq-cta">
        <p>Masih ada pertanyaan? Tim kami siap membantu Anda</p>
        <a href="https://wa.me/6282355163745?text=Halo%20saya%20dapat%20nomor%20anda%20dari%20website%20Bulldozer%20LiuGong%20dan%20ingin%20konsultasi" 
           class="contact-btn" 
           target="_blank" 
           rel="noopener noreferrer">
            <i class="fab fa-whatsapp"></i> Hubungi Kami via WhatsApp <i class="fas fa-arrow-right"></i>
        </a>
        <br>
        <small style="display:block; margin-top:10px;">
            Atau <a href="/contact.php" style="color:#e31e24; font-weight:600;">hubungi tim sales kami</a> untuk konsultasi gratis
        </small>
    </div>
</section>

<!-- ================= FOOTER ================= -->
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
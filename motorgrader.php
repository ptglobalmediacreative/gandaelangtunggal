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
      AND p.category_id = 4
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

$currentUrl = "https://gandaelang.co.id/motorgrader";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Motor Grader LiuGong | Alat Berat Konstruksi & Pertambangan | PT Ganda Elang Tangguh</title>
    
    <meta name="description" content="PT Ganda Elang Tangguh jual Motor Grader LiuGong berkualitas tinggi untuk konstruksi, pertambangan, perkebunan, dan infrastruktur. Tersedia berbagai tipe dengan tenaga mesin hingga 260+ HP, panjang blade hingga 4,9 meter, dan garansi resmi. Dapatkan harga motor grader terbaru disini!">
    
    <meta name="keywords" content="motor grader, motor grader liugong, alat berat motor grader, harga motor grader, motor grader indonesia, heavy equipment motor grader, motor grader untuk konstruksi, motor grader pertambangan, alat berat indonesia, dealer liugong indonesia, motor grader terbaik, spesifikasi motor grader, motor grader CLG4180D, motor grader CLG4215D">
    
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    
    <meta name="author" content="PT Ganda Elang Tangguh">
    <meta name="geo.region" content="ID">
    <meta name="geo.placename" content="Jakarta, Indonesia">
    <meta name="language" content="id-ID">
    
    <link rel="canonical" href="<?= $currentUrl ?>">
    <link rel="alternate" hreflang="id" href="<?= $currentUrl ?>">
    <link rel="alternate" href="<?= $currentUrl ?>" hreflang="x-default">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="Motor Grader LiuGong | Alat Berat untuk Konstruksi & Pertambangan | PT Ganda Elang Tangguh">
    <meta property="og:description" content="PT Ganda Elang Tangguh menyediakan Motor Grader LiuGong terbaik untuk perataan tanah, pembangunan jalan, dan konstruksi infrastruktur di Indonesia. Performa presisi, efisien, dan tahan lama. Tersedia berbagai tipe dengan tenaga hingga 260+ HP.">
    <meta property="og:image" content="https://gandaelang.co.id/images/motorgrader.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Motor Grader LiuGong untuk konstruksi dan pertambangan">
    <meta property="og:url" content="<?= $currentUrl ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="PT Ganda Elang Tangguh">
    <meta property="og:locale" content="id_ID">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Motor Grader LiuGong | Alat Berat Indonesia">
    <meta name="twitter:description" content="Motor Grader LiuGong presisi untuk perataan tanah, pembangunan jalan, dan konstruksi. Performa akurat, efisien, dan tahan lama.">
    <meta name="twitter:image" content="https://gandaelang.co.id/images/motorgrader.jpg">
    <meta name="twitter:image:alt" content="Motor Grader LiuGong">
    
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
                "name": "Motor Grader LiuGong",
                "item": "https://gandaelang.co.id/motorgrader"
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
        "description": "Dealer resmi alat berat LiuGong di Indonesia, menyediakan motor grader, excavator, wheel loader, bulldozer, dan alat berat lainnya untuk konstruksi, pertambangan, dan infrastruktur.",
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
        "name": "Motor Grader LiuGong",
        "description": "Motor Grader LiuGong adalah alat berat presisi untuk pekerjaan perataan tanah, pembangunan jalan, pembuatan bahu jalan, pembentukan saluran drainase, dan pemeliharaan jalan tambang. Tersedia berbagai seri dengan tenaga mesin 125-260+ HP, panjang blade 3,7-4,9 meter, dan berat operasi 10.500-22.000 kg.",
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
        "category": "Alat Berat Motor Grader",
        "offers": {
            "@type": "Offer",
            "priceCurrency": "IDR",
            "availability": "https://schema.org/InStock",
            "url": "https://gandaelang.co.id/motorgrader",
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
            "name": "Kontraktor Jalan, Perusahaan Tambang, Perkebunan Skala Besar, Proyek Infrastruktur"
        },
        "url": "https://gandaelang.co.id/motorgrader"
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
                "name": "Apa keunggulan utama Motor Grader LiuGong dibandingkan merek lain?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Motor Grader LiuGong unggul dalam sistem hidraulik yang presisi dan responsif untuk kemiringan blade (grading) akurat, kabin ergonomis dengan visibilitas 360°, frame artikulasi yang kokoh untuk manuver tajam, serta konsumsi bahan bakar yang efisien. Didukung jaringan dealer resmi PT Ganda Elang Tangguh dengan ketersediaan suku cadang dan biaya perawatan kompetitif."
                }
            },
            {
                "@type": "Question",
                "name": "Berapa panjang blade dan berat operasi Motor Grader LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Motor Grader LiuGong tersedia dalam berbagai seri mulai dari kelas 10 ton hingga 22 ton. Panjang blade (moldboard) berkisar antara 3,7 meter hingga 4,9 meter. Tenaga mesin dari 125 HP hingga 260+ HP. Berat operasi berkisar antara 10.500 kg hingga 22.000 kg tergantung model dan konfigurasi."
                }
            },
            {
                "@type": "Question",
                "name": "Apakah PT Ganda Elang Tangguh dealer resmi Motor Grader LiuGong di Indonesia?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Ya, PT Ganda Elang Tangguh adalah dealer resmi alat berat LiuGong di Indonesia yang mencakup penjualan Motor Grader baru, perawatan berkala, servis, penyediaan suku cadang original, serta garansi pabrik untuk seluruh unit Motor Grader LiuGong."
                }
            },
            {
                "@type": "Question",
                "name": "Apa perbedaan sistem blade standar dan blade dengan hidraulik pintar pada Motor Grader LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Motor Grader LiuGong modern (seri D) dilengkapi sistem hidraulik load-sensing yang menghemat bahan bakar hingga 15% dan memberikan kontrol presisi. Untuk kebutuhan grading akurasi tinggi, LiuGong mendukung pemasangan sistem grade control (2D/3D) dari merek ternama seperti Topcon atau Leica, sehingga meningkatkan efisiensi dan mengurangi pekerjaan ulang."
                }
            },
            {
                "@type": "Question",
                "name": "Motor Grader LiuGong cocok untuk proyek apa saja?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Motor Grader LiuGong sangat cocok untuk perataan tanah (grading) pada pembangunan jalan, pembuatan bahu jalan, pembentukan saluran drainase, perapian lahan perkebunan (sawit, tebu), pemeliharaan jalan tambang dan jalan logging, penimbunan kembali (backfilling), serta pekerjaan kemiringan (sloping) untuk tanggul dan bendungan."
                }
            },
            {
                "@type": "Question",
                "name": "Bagaimana cara mendapatkan informasi harga dan simulasi kredit Motor Grader LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Anda bisa menghubungi tim sales PT Ganda Elang Tangguh melalui WhatsApp, telepon, email, atau halaman Kontak Kami untuk mendapatkan informasi harga terbaru, spesifikasi lengkap (panjang blade, tenaga mesin, berat operasi), serta simulasi kredit dengan tenor fleksibel sesuai kebutuhan proyek Anda."
                }
            },
            {
                "@type": "Question",
                "name": "Apa saja layanan after-sales untuk Motor Grader LiuGong di Indonesia?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Kami menyediakan layanan purna jual lengkap: garansi standar pabrik, perawatan rutin (penggantian oli, filter, pengecekan sistem hidraulik dan steering artikulasi), servis mobile ke lokasi proyek, pelatihan operator untuk teknik grading yang efisien, serta stok suku cadang original (moldboard blade, edge, komponen mesin, hidraulik) di gudang pusat dan cabang."
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
<section class="hero hero-image" style="background: url('/images/motorgrader.jpg') center / cover no-repeat;">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-breadcrumb">
            <a href="/">Home</a>
            <span>></span>
            <a href="/produk">Produk</a>
            <span>></span>
            <span class="current">Motor Grader</span>
        </div>
        <!-- ===== H1 DENGAN KEYWORD ===== -->
        <h1>Motor Grader LiuGong untuk Konstruksi & Pertambangan di Indonesia</h1>
        <p class="hero-subtext">
            Motor Grader LiuGong berkinerja presisi, dirancang untuk <strong>perataan tanah</strong>, 
            <strong>pembangunan jalan</strong>, dan <strong>konstruksi infrastruktur</strong> dengan akurasi luar biasa 
            dan efisiensi bahan bakar optimal. Dapatkan <strong>harga motor grader terbaik</strong> hanya di 
            <strong>PT Ganda Elang Tangguh</strong>, dealer resmi LiuGong Indonesia.
        </p>
    </div>
</section>

<!-- ================= PRODUCT LIST SECTION ================= -->
<section class="product-list">
    <div class="product-container">
        <h2 class="product-title">Daftar Produk Motor Grader LiuGong</h2>
        
        <div class="product-grid">
            <?php if (!empty($products)) : ?>
                <?php foreach ($products as $row) : ?>
                    <div class="product-card">
                        <a href="/detailprodukmotorgrader.php?slug=<?= htmlspecialchars($row['slug']); ?>" class="product-link">
                            <div class="product-image">
                                <img 
                                    src="/images/uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" 
                                    alt="<?= htmlspecialchars($row['nama_produk']); ?> - Motor Grader LiuGong untuk konstruksi dan pertambangan"
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
                            "description": "Motor Grader <?= htmlspecialchars($row['nama_produk']); ?> dari LiuGong untuk konstruksi, pertambangan, dan perataan tanah di Indonesia.",
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
                                "url": "https://gandaelang.co.id/detailprodukmotorgrader.php?slug=<?= htmlspecialchars($row['slug']); ?>"
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
    <h2>Mengapa Memilih Motor Grader LiuGong untuk Proyek Anda?</h2>
    <p>
        <strong>Motor Grader LiuGong</strong> adalah solusi alat berat presisi terbaik untuk <strong>perataan tanah</strong>, 
        <strong>pembangunan jalan</strong>, dan <strong>konstruksi infrastruktur</strong> di Indonesia. Dengan teknologi canggih dari 
        LiuGong, motor grader ini menawarkan kombinasi sempurna antara <strong>akurasi grading, efisiensi, dan ketahanan</strong> 
        yang dirancang untuk menghadapi berbagai tantangan medan di lapangan.
    </p>
    
    <h3>Spesifikasi Unggulan Motor Grader LiuGong</h3>
    <ul>
        <li><strong>Panjang Blade:</strong> 3.7m - 4.9m untuk berbagai kebutuhan proyek</li>
        <li><strong>Operating Weight:</strong> 10.5 ton - 22 ton menjamin stabilitas optimal</li>
        <li><strong>Tenaga Mesin:</strong> 125 HP - 260+ HP untuk performa maksimal</li>
        <li><strong>Sistem Hidrolik:</strong> Load-sensing presisi untuk kontrol grading akurat</li>
        <li><strong>Frame Artikulasi:</strong> Kokoh untuk manuver tajam di medan terbatas</li>
        <li><strong>Kabin:</strong> Ergonomis dengan visibilitas 360° untuk kenyamanan operator</li>
        <li><strong>Garansi Resmi:</strong> Didukung oleh dealer resmi LiuGong di Indonesia</li>
    </ul>
    
    <h3>Keunggulan Motor Grader LiuGong Dibanding Merek Lain</h3>
    <p>
        Sebagai <strong>dealer resmi LiuGong</strong>, PT Ganda Elang Tangguh menawarkan motor grader dengan 
        <strong>harga kompetitif</strong> dan <strong>ketersediaan sparepart original</strong> yang terjamin. 
        Teknologi <strong>hydraulic system</strong> dan <strong>engine technology</strong> dari LiuGong memastikan 
        efisiensi bahan bakar yang optimal dan daya tahan komponen yang lebih lama, sehingga <strong>biaya perawatan</strong> 
        menjadi lebih efisien dalam jangka panjang.
    </p>
    
    <p>
        <strong>Motor Grader LiuGong</strong> juga dilengkapi dengan sistem <strong>grade control</strong> yang memungkinkan 
        pekerjaan grading dengan akurasi tinggi, membantu Anda mengoptimalkan <strong>produktivitas</strong> dan 
        <strong>efisiensi operasional</strong> proyek. Dengan berbagai tipe yang tersedia, mulai dari skala kecil 
        hingga besar, Anda dapat memilih <strong>motor grader yang tepat</strong> sesuai kebutuhan spesifik proyek Anda.
    </p>
    
    <div class="seo-cta">
        <p style="font-size:18px; font-weight:600; margin-bottom:5px;">
            <i class="fas fa-phone" style="color:#e31e24;"></i> 
            Dapatkan Harga Motor Grader Terbaik Sekarang!
        </p>
        <p style="font-size:15px; margin-bottom:0;">
            Hubungi tim sales <strong>PT Ganda Elang Tangguh</strong> untuk konsultasi gratis dan penawaran spesial 
            untuk proyek Anda. Kami siap membantu Anda memilih <strong>motor grader LiuGong</strong> yang paling sesuai 
            dengan kebutuhan dan anggaran.
        </p>
    </div>
</section>

<!-- ================= FAQ SECTION ================= -->
<section class="faq-section">
    <div class="faq-header">
        <h2>Pertanyaan Umum Seputar Motor Grader LiuGong</h2>
        <p>Temukan jawaban atas pertanyaan yang sering diajukan tentang Motor Grader LiuGong, mulai dari spesifikasi, harga, hingga layanan purna jual.</p>
    </div>
    
    <div class="faq-grid" itemscope="" itemtype="https://schema.org/FAQPage">
        
        <!-- FAQ 1 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Apa keunggulan utama Motor Grader LiuGong dibandingkan merek lain?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Motor Grader LiuGong unggul dalam <strong>sistem hidraulik yang presisi</strong> dan responsif untuk kemiringan blade (grading) akurat, <strong>kabin ergonomis</strong> dengan visibilitas 360°, <strong>frame artikulasi</strong> yang kokoh untuk manuver tajam, serta <strong>konsumsi bahan bakar yang efisien</strong>. Didukung jaringan dealer resmi PT Ganda Elang Tangguh dengan ketersediaan suku cadang dan biaya perawatan kompetitif.</p>
            </div>
        </div>
        
        <!-- FAQ 2 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Berapa panjang blade dan berat operasi Motor Grader LiuGong?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Motor Grader LiuGong tersedia dalam berbagai seri mulai dari kelas <strong>10 ton hingga 22 ton</strong>. Panjang blade (moldboard) berkisar antara <strong>3,7 meter hingga 4,9 meter</strong>. Tenaga mesin dari <strong>125 HP hingga 260+ HP</strong>. Berat operasi berkisar antara <strong>10.500 kg hingga 22.000 kg</strong> tergantung model dan konfigurasi.</p>
            </div>
        </div>
        
        <!-- FAQ 3 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Apakah PT Ganda Elang Tangguh dealer resmi Motor Grader LiuGong di Indonesia?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Ya, <strong>PT Ganda Elang Tangguh</strong> adalah <strong>dealer resmi alat berat LiuGong</strong> di Indonesia yang mencakup penjualan Motor Grader baru, perawatan berkala, servis, penyediaan <strong>suku cadang original</strong>, serta garansi pabrik untuk seluruh unit Motor Grader LiuGong.</p>
            </div>
        </div>
        
        <!-- FAQ 4 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Apa perbedaan sistem blade standar dan blade dengan hidraulik pintar pada Motor Grader LiuGong?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Motor Grader LiuGong modern (seri D) dilengkapi <strong>sistem hidraulik load-sensing</strong> yang menghemat bahan bakar hingga 15% dan memberikan kontrol presisi. Untuk kebutuhan grading akurasi tinggi, LiuGong mendukung pemasangan <strong>sistem grade control (2D/3D)</strong> dari merek ternama seperti Topcon atau Leica, sehingga meningkatkan efisiensi dan mengurangi pekerjaan ulang.</p>
            </div>
        </div>
        
        <!-- FAQ 5 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Motor Grader LiuGong cocok untuk proyek apa saja?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Motor Grader LiuGong sangat cocok untuk <strong>perataan tanah (grading)</strong> pada pembangunan jalan, pembuatan bahu jalan, pembentukan saluran drainase, perapian lahan perkebunan (sawit, tebu), <strong>pemeliharaan jalan tambang</strong> dan jalan logging, penimbunan kembali (backfilling), serta pekerjaan kemiringan (sloping) untuk tanggul dan bendungan.</p>
            </div>
        </div>
        
        <!-- FAQ 6 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Bagaimana cara mendapatkan informasi harga dan simulasi kredit Motor Grader LiuGong?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Anda bisa menghubungi tim sales <strong>PT Ganda Elang Tangguh</strong> melalui <a href="/contact">halaman Kontak Kami</a>, WhatsApp, telepon, atau email untuk mendapatkan <strong>informasi harga motor grader terbaru</strong>, spesifikasi lengkap (panjang blade, tenaga mesin, berat operasi), serta simulasi kredit dengan tenor fleksibel.</p>
            </div>
        </div>
        
        <!-- FAQ 7 -->
        <div class="faq-item" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq-question" itemprop="name">
                <h3>Apa saja layanan after-sales untuk Motor Grader LiuGong di Indonesia?</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Kami menyediakan layanan purna jual lengkap: <strong>garansi standar pabrik</strong>, <strong>perawatan rutin</strong> (penggantian oli, filter, pengecekan sistem hidraulik dan steering artikulasi), <strong>servis mobile</strong> ke lokasi proyek, <strong>pelatihan operator</strong> untuk teknik grading yang efisien, serta stok <strong>suku cadang original</strong> (moldboard blade, edge, komponen mesin, hidraulik) di gudang pusat dan cabang.</p>
            </div>
        </div>
    </div>
    
    <div class="faq-cta">
        <p>Masih ada pertanyaan? Tim kami siap membantu Anda</p>
        <a href="https://wa.me/6282355163745?text=Halo%20saya%20dapat%20nomor%20anda%20dari%20website%20Motor%20Grader%20LiuGong%20dan%20ingin%20konsultasi" 
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
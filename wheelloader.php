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
        LIMIT 3
    ");
    $spec_stmt->execute([$product['id']]);
    $product['specifications'] = $spec_stmt->fetchAll();
}
unset($product); // Hapus referensi setelah loop
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php $currentUrl = "https://gandaelang.co.id/wheelloader.php"; ?>
    
    <title>Wheel Loader LiuGong | Alat Berat Konstruksi & Pertambangan | PT Ganda Elang Tangguh</title>
    
    <meta name="description" content="PT Ganda Elang Tangguh jual Wheel Loader LiuGong berkualitas tinggi untuk konstruksi, pertambangan, dan material handling. Tersedia berbagai tipe wheel loader dengan performa unggul dan efisiensi bahan bakar terbaik.">
    
    <meta name="keywords" content="wheel loader, wheel loader liugong, alat berat wheel loader, harga wheel loader, wheel loader indonesia, loader alat berat, heavy equipment wheel loader, wheel loader untuk konstruksi, wheel loader pertambangan, alat berat indonesia, dealer liugong indonesia">
    
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    
    <meta name="author" content="PT Ganda Elang Tangguh">
    <meta name="geo.region" content="ID">
    <meta name="geo.placename" content="Indonesia">
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
    
    <!-- Schema.org untuk Product -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Product",
        "name": "Wheel Loader LiuGong",
        "description": "Wheel loader berkualitas tinggi dari LiuGong untuk konstruksi, pertambangan, dan material handling. Tersedia berbagai tipe dengan kapasitas angkut besar dan efisiensi bahan bakar optimal.",
        "brand": {
            "@type": "Brand",
            "name": "LiuGong"
        },
        "manufacturer": {
            "@type": "Organization",
            "name": "PT Ganda Elang Tangguh"
        },
        "category": "Alat Berat",
        "audience": {
            "@type": "Audience",
            "name": "Kontraktor, Perusahaan Tambang, Logistik"
        }
    }
    </script>
    
    <!-- BreadcrumbList Schema -->
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
            "telephone": "+62-21-XXXXXXX",
            "contactType": "customer service"
        },
        "sameAs": [
            "https://www.facebook.com/gandaelangtangguh",
            "https://www.instagram.com/gandaelangtangguh"
        ]
    }
    </script>
    
    <!-- FAQ Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {
                "@type": "Question",
                "name": "Apa keunggulan Wheel Loader LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Wheel Loader LiuGong memiliki keunggulan seperti efisiensi bahan bakar tinggi, performa tangguh untuk berbagai medan, perawatan mudah, ketersediaan sparepart terjamin, dan teknologi canggih untuk produktivitas maksimal."
                }
            },
            {
                "@type": "Question",
                "name": "Berapa kapasitas angkut Wheel Loader LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Wheel Loader LiuGong tersedia dalam berbagai kapasitas mulai dari 1.9m³ hingga 7.0m³ untuk bucket capacity, dengan operating weight dari 13.378kg hingga 52.100kg, sesuai dengan kebutuhan proyek Anda."
                }
            },
            {
                "@type": "Question",
                "name": "Apakah PT Ganda Elang Tangguh dealer resmi LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Ya, PT Ganda Elang Tangguh adalah dealer resmi alat berat LiuGong di Indonesia yang melayani penjualan unit baru, perawatan rutin, servis, dan penyediaan sparepart original."
                }
            },
            {
                "@type": "Question",
                "name": "Wheel loader cocok untuk industri apa saja?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Wheel loader LiuGong sangat cocok untuk berbagai industri seperti konstruksi bangunan, pertambangan, perkebunan, logistik dan pergudangan, serta proyek infrastruktur jalan dan jembatan."
                }
            },
            {
                "@type": "Question",
                "name": "Bagaimana cara mendapatkan informasi harga wheel loader?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Anda bisa menghubungi tim sales PT Ganda Elang Tangguh melalui halaman Kontak Kami, telepon, atau email untuk mendapatkan informasi harga terbaru dan penawaran spesial sesuai kebutuhan proyek Anda."
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
        /* Reset & Base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }
        
        /* Product Specifications - Clean & Professional */
        .product-spec-list {
            list-style: none;
            padding: 0;
            margin: 16px 0 0 0;
        }
        
        .product-spec-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            padding: 10px 0;
            border-bottom: 1px solid #eaeaea;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        
        .product-spec-list li:last-child {
            border-bottom: none;
        }
        
        .product-spec-list li span:first-child {
            font-weight: 500;
            color: #555;
        }
        
        .product-spec-list li span:last-child {
            font-weight: 500;
            color: #222;
        }
        
        /* Product Title - Dark Blue */
        .product-info h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #1a3a6b;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: color 0.3s ease;
        }
        
        /* Hover Product Title - Gold/Yellow */
        .product-link:hover .product-info h3 {
            color: #c9a03d;
        }
        
        /* Button - Dark Blue */
        .product-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #1a3a6b;
            text-decoration: none;
            margin-top: 20px;
            transition: all 0.3s ease;
            font-family: 'Plus Jakarta Sans', sans-serif;
            position: absolute;
            bottom: 20px;
            left: 20px;
        }
        
        .product-btn i {
            font-size: 12px;
            transition: transform 0.3s ease;
        }
        
        /* Hover Button - Gold/Yellow */
        .product-link:hover .product-btn {
            color: #c9a03d;
        }
        
        .product-link:hover .product-btn i {
            transform: translateX(5px);
        }
        
        /* Card Container */
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .product-link {
            display: flex;
            flex-direction: column;
            height: 100%;
            text-decoration: none;
        }
        
        /* Product Info Container */
        .product-info {
            padding: 20px;
            text-align: left;
            flex: 1;
            position: relative;
            padding-bottom: 60px;
        }
        
        /* Product Image */
        .product-image {
            height: 240px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f5f5;
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
        }
        
        .product-card:hover .product-image img {
            transform: scale(1.05);
        }
        
        /* Product Grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }
        
        /* Product Container */
        .product-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        
        .product-title {
            text-align: center;
            font-size: 32px;
            font-weight: 700;
            color: #1a3a6b;
            margin-bottom: 40px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        
        /* FAQ Section Styles */
        .faq-section {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 20px;
        }
        
        .faq-section h2 {
            text-align: center;
            font-size: 32px;
            font-weight: 700;
            color: #1a3a6b;
            margin-bottom: 40px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        
        .faq-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 24px;
        }
        
        .faq-item {
            background: #fff;
            border: 1px solid #eaeaea;
            border-radius: 12px;
            padding: 20px 24px;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .faq-item:hover {
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border-color: #c9a03d;
        }
        
        .faq-question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            font-size: 18px;
            color: #1a3a6b;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        
        .faq-question i {
            color: #c9a03d;
            transition: transform 0.3s ease;
        }
        
        .faq-item.active .faq-question i {
            transform: rotate(180deg);
        }
        
        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            color: #555;
            line-height: 1.6;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        
        .faq-item.active .faq-answer {
            max-height: 200px;
            margin-top: 16px;
        }
        
        /* No Product Message */
        .no-product {
            text-align: center;
            padding: 60px;
            color: #666;
            font-size: 18px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .faq-grid {
                grid-template-columns: 1fr;
            }
            
            .faq-question {
                font-size: 16px;
            }
            
            .product-title,
            .faq-section h2 {
                font-size: 24px;
            }
            
            .product-grid {
                gap: 20px;
            }
        }
    </style>
</head>
<body>

<!-- ================= HEADER ================= -->
<header class="header">
    <div class="container">
        <div class="logo">
            <a href="/index.php">
                <img src="/images/logo.webp" alt="PT Ganda Elang Tangguh Logo">
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
        <div class="hamburger" id="hamburger">
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
            <a href="/produk.php">Product</a>
            <span>></span>
            <span class="current">Wheel Loaders</span>
        </div>
        <h1>Power That Moves Productivity</h1>
        <p class="hero-subtext">
            High-performance wheel loaders designed for efficient material handling,
            superior durability, and maximum productivity.
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
                                    alt="<?= htmlspecialchars($row['nama_produk']); ?> - Wheel Loader LiuGong"
                                    loading="lazy"
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
    <h2>Pertanyaan Umum Tentang Wheel Loader</h2>
    <div class="faq-grid">
        <div class="faq-item">
            <div class="faq-question">
                Apa keunggulan Wheel Loader LiuGong?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                Wheel Loader LiuGong memiliki keunggulan seperti efisiensi bahan bakar tinggi, performa tangguh untuk berbagai medan, perawatan mudah, ketersediaan sparepart terjamin, dan teknologi canggih untuk produktivitas maksimal.
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                Berapa kapasitas angkut Wheel Loader LiuGong?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                Wheel Loader LiuGong tersedia dalam berbagai kapasitas mulai dari 1.9m³ hingga 7.0m³ untuk bucket capacity, dengan operating weight dari 13.378kg hingga 52.100kg, sesuai dengan kebutuhan proyek Anda.
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                Apakah PT Ganda Elang Tangguh dealer resmi LiuGong?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                Ya, PT Ganda Elang Tangguh adalah dealer resmi alat berat LiuGong di Indonesia yang melayani penjualan unit baru, perawatan rutin, servis, dan penyediaan sparepart original.
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                Wheel loader cocok untuk industri apa saja?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                Wheel loader LiuGong sangat cocok untuk berbagai industri seperti konstruksi bangunan, pertambangan, perkebunan, logistik dan pergudangan, serta proyek infrastruktur jalan dan jembatan.
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                Bagaimana cara mendapatkan informasi harga wheel loader?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                Anda bisa menghubungi tim sales PT Ganda Elang Tangguh melalui halaman Kontak Kami, telepon, atau email untuk mendapatkan informasi harga terbaru dan penawaran spesial sesuai kebutuhan proyek Anda.
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                Apakah ada layanan after-sales untuk wheel loader?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                Tersedia layanan purna jual lengkap termasuk garansi, perawatan rutin, servis berkala, pelatihan operator, dan ketersediaan sparepart original untuk memastikan alat berat Anda selalu dalam kondisi prima.
            </div>
        </div>
    </div>
</section>

<!-- ================= FOOTER ================= -->
<?php include $_SERVER['DOCUMENT_ROOT'] . "/footer.php"; ?>

<!-- ================= JAVASCRIPT ================= -->
<script>
// FAQ Accordion Functionality
document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        
        if (question) {
            question.addEventListener('click', () => {
                // Close all other faq items
                faqItems.forEach(otherItem => {
                    if (otherItem !== item && otherItem.classList.contains('active')) {
                        otherItem.classList.remove('active');
                    }
                });
                
                // Toggle current item
                item.classList.toggle('active');
            });
        }
    });
    
    // Hamburger menu functionality
    const hamburger = document.getElementById('hamburger');
    const navbar = document.getElementById('navbar');
    
    if (hamburger && navbar) {
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navbar.classList.toggle('active');
        });
    }
});
</script>

</body>
</html>
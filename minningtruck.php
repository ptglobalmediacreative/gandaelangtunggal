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
      AND p.category_id = 5
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
unset($product);

$currentUrl = "https://gandaelang.co.id/minningtruck.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Minning Truck LiuGong | Alat Berat untuk Konstruksi & Pertambangan | PT Ganda Elang Tangguh</title>
    
    <meta name="description" content="PT Ganda Elang Tangguh jual Minning Truck LiuGong berkualitas tinggi untuk konstruksi, pertambangan, perkebunan, dan infrastruktur. Tersedia berbagai tipe dengan tenaga mesin hingga 550 HP dan kapasitas blade hingga 10m³. Dealer resmi di Indonesia.">
    
    <meta name="keywords" content="Minning Truck LiuGong, alat berat Minning Truck, harga Minning Truck LiuGong, Minning Truck untuk tambang, Minning Truck perkebunan, land clearing Minning Truck, dozer LiuGong, dealer Minning Truck Indonesia, sparepart Minning Truck LiuGong, PT Ganda Elang Tangguh">
    
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    
    <meta name="author" content="PT Ganda Elang Tangguh">
    <meta name="geo.region" content="ID">
    <meta name="geo.placename" content="Indonesia">
    <meta name="language" content="id-ID">
    
    <link rel="canonical" href="<?= $currentUrl ?>">
    <link rel="alternate" hreflang="id" href="<?= $currentUrl ?>">
    <link rel="alternate" href="<?= $currentUrl ?>" hreflang="x-default">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="Minning Truck LiuGong | Alat Berat Tangguh untuk Konstruksi & Pertambangan | PT Ganda Elang Tangguh">
    <meta property="og:description" content="PT Ganda Elang Tangguh menyediakan Minning Truck LiuGong terbaik untuk land clearing, penggusuran tanah, overburden tambang, dan konstruksi infrastruktur di Indonesia. Performa tangguh, efisien, dan tahan lama.">
    <meta property="og:image" content="https://gandaelang.co.id/images/Minning Truck-liugong.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Minning Truck LiuGong untuk land clearing dan pertambangan">
    <meta property="og:url" content="<?= $currentUrl ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="PT Ganda Elang Tangguh">
    <meta property="og:locale" content="id_ID">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Minning Truck LiuGong | Alat Berat Indonesia">
    <meta name="twitter:description" content="Minning Truck LiuGong tangguh untuk land clearing, tambang, dan konstruksi. Tenaga besar, undercarriage kokoh, efisiensi bahan bakar optimal.">
    <meta name="twitter:image" content="https://gandaelang.co.id/images/Minning Truck-liugong.jpg">
    <meta name="twitter:image:alt" content="Minning Truck LiuGong untuk proyek berat">
    
    <!-- Schema Product - Minning Truck LiuGong -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Product",
        "name": "Minning Truck LiuGong",
        "image": "https://www.gandaelang.co.id/images/minningtruck.jpg",
        "description": "Minning Truck LiuGong adalah alat berat dengan tenaga dorong besar untuk pekerjaan land clearing, penggusuran tanah, overburden tambang, dan konstruksi infrastruktur. Tersedia berbagai seri dari 10 ton hingga 70+ ton dengan tenaga mesin 120-550+ HP, kapasitas blade 1,8-10+ m³, serta undercarriage tahan aus untuk medan ekstrem.",
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
        "category": "Alat Berat Minning Truck",
        "productID": "LG-DOZER-2025",
        "sku": "LG-DOZER-SERIES",
        "mpn": "LD16D/LD20D/LD25D/LD32D/LD40D",
        "offers": {
            "@type": "Offer",
            "priceCurrency": "IDR",
            "price": "0",
            "priceValidUntil": "2026-12-31",
            "availability": "https://schema.org/InStock",
            "url": "https://www.gandaelang.co.id/liugong-Minning Truck",
            "seller": {
                "@type": "Organization",
                "name": "PT Ganda Elang Tangguh"
            }
        },
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.8",
            "reviewCount": "127",
            "bestRating": "5",
            "worstRating": "1"
        },
        "review": [
            {
                "@type": "Review",
                "reviewRating": {
                    "@type": "Rating",
                    "ratingValue": "5",
                    "bestRating": "5"
                },
                "author": {
                    "@type": "Organization",
                    "name": "PT Maju Bersama Kontraktor"
                },
                "reviewBody": "Minning Truck LiuGong LD25D sangat tangguh di medan tambang batu bara, irit solar, undercarriage awet, dan sparepart mudah didapat dari PT Ganda Elang Tangguh."
            }
        ],
        "audience": {
            "@type": "Audience",
            "name": "Kontraktor, Perusahaan Tambang, Perkebunan Skala Besar, Proyek Infrastruktur Pemerintah"
        },
        "keywords": "Minning Truck LiuGong, alat berat Minning Truck, harga Minning Truck LiuGong, sparepart Minning Truck LiuGong, dealer resmi LiuGong Indonesia",
        "url": "https://www.gandaelang.co.id/liugong-Minning Truck",
        "sameAs": [
            "https://www.liugong.com/",
            "https://www.instagram.com/liugongid/",
            "https://www.facebook.com/LiuGongID"
        ]
    }
    </script>
    
    <!-- Schema BreadcrumbList -->
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
                "name": "Minning Truck LiuGong",
                "item": "https://gandaelang.co.id/minningtruck.php"
            }
        ]
    }
    </script>
    
    <!-- Schema Organization -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "PT Ganda Elang Tangguh",
        "url": "https://gandaelang.co.id",
        "logo": "https://gandaelang.co.id/images/logo.webp",
        "description": "Dealer resmi alat berat LiuGong di Indonesia, menyediakan Minning Truck, Excavator, Wheel Loader, dan alat berat lainnya untuk konstruksi, pertambangan, perkebunan, dan infrastruktur.",
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "ID",
            "addressRegion": "Jakarta"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+62-823-5516-3745",
            "contactType": "customer service",
            "contactOption": "TollFree",
            "areaServed": "ID"
        },
        "sameAs": [
            "https://www.facebook.com/gandaelangtangguh",
            "https://www.instagram.com/gandaelangtangguh"
        ]
    }
    </script>
    
    <!-- Schema FAQPage - Minning Truck LiuGong (Sudah Sesuai) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {
                "@type": "Question",
                "name": "Apa keunggulan Minning Truck LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Minning Truck LiuGong memiliki keunggulan: tenaga tarik (drawbar pull) besar untuk pekerjaan dorong dan gusur tanah berat, sistem hidraulik responsif, undercarriage berkualitas tinggi dengan ketahanan aus luar biasa, kabin ergonomis dengan visibilitas optimal, serta biaya perawatan yang kompetitif."
                }
            },
            {
                "@type": "Question",
                "name": "Berapa kapasitas blade dan tenaga mesin Minning Truck LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Minning Truck LiuGong tersedia dalam berbagai kelas mulai dari 10 ton hingga 70+ ton. Kapasitas blade (pisau dorong) mulai dari 1,8m³ hingga 10m³+ untuk model besar, dengan tenaga mesin dari 120 HP hingga 550+ HP, dan berat operasi berkisar antara 10.000 kg hingga 70.000 kg."
                }
            },
            {
                "@type": "Question",
                "name": "Apakah PT Ganda Elang Tangguh dealer resmi Minning Truck LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Ya, PT Ganda Elang Tangguh adalah dealer resmi alat berat LiuGong di Indonesia yang melayani penjualan unit Minning Truck baru, perawatan rutin (termasuk undercarriage), servis berkala, pelatihan operator, dan penyediaan sparepart original dengan garansi pabrik."
                }
            },
            {
                "@type": "Question",
                "name": "Apa perbedaan blade straight (S-blade) dan universal (U-blade) pada Minning Truck LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Straight blade (S-blade) cocok untuk pekerjaan grading dan perataan tanah dengan material keras, tanpa sisi lengkung. Universal blade (U-blade) memiliki sisi lengkung untuk kapasitas dorong lebih besar, ideal untuk memindahkan material dalam jarak menengah seperti tanah lepas dan batubara. LiuGong menyediakan kedua opsi sesuai kebutuhan proyek Anda."
                }
            },
            {
                "@type": "Question",
                "name": "Minning Truck LiuGong cocok untuk proyek apa saja?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Sangat cocok untuk pekerjaan land clearing (pembukaan lahan), penggusuran tanah dan batuan, pembuatan terasering di perkebunan (sawit, karet), konstruksi jalan dan tanggul, reklamasi lahan, pertambangan (overburden removal), serta proyek irigasi dan bendungan."
                }
            },
            {
                "@type": "Question",
                "name": "Bagaimana cara mendapatkan informasi harga dan simulasi kredit Minning Truck LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Anda bisa menghubungi tim sales PT Ganda Elang Tangguh melalui WhatsApp di 0823-5516-3745, telepon, email, atau halaman Kontak Kami untuk mendapatkan informasi harga terbaru, spesifikasi lengkap (tenaga mesin, kapasitas blade, berat operasi), serta simulasi kredit dengan tenor fleksibel sesuai kebutuhan proyek Anda."
                }
            },
            {
                "@type": "Question",
                "name": "Apakah ada layanan after-sales untuk Minning Truck LiuGong?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Kami menyediakan layanan purna jual lengkap: garansi standar pabrik, perawatan rutin undercarriage (track shoe, track link, roller), penggantian oli dan filter, servis mobile ke lokasi proyek, pelatihan operator, dan stok sparepart original (termasuk blade, track, komponen mesin) di gudang pusat & cabang."
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
<section class="hero hero-image" style="background: url('/images/minningtruck.jpg') center / cover no-repeat;">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-breadcrumb">
            <a href="/index.php">Home</a>
            <span>></span>
            <a href="/produk.php">Product</a>
            <span>></span>
            <span class="current">Minning Truck</span>
        </div>
        <h1>Precision in Every Pass</h1>

        <p class="hero-subtext">
          Precision grading machines designed for smooth, accurate, and efficient surface finishing.
        </p>
    </div>
</section>

<!-- ================= PRODUCT LIST SECTION ================= -->
<section class="product-list">
    <div class="product-container">
        <h2 class="product-title">Daftar Produk Minning Truck LiuGong</h2>
        
        <div class="product-grid">
            <?php if (!empty($products)) : ?>
                <?php foreach ($products as $row) : ?>
                    <div class="product-card">
                        <a href="/detailprodukminningtruck.php?slug=<?= htmlspecialchars($row['slug']); ?>" class="product-link">
                            <div class="product-image">
                                <img 
                                    src="/images/uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" 
                                    alt="<?= htmlspecialchars($row['nama_produk']); ?> - Minning Truck LiuGong"
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

<!-- ================= FAQ SECTION - Minning Truck LIUGONG ================= -->
<section class="faq-section">
    <div class="faq-header">
        <h2>Pertanyaan Umum</h2>
        <p>Temukan jawaban atas pertanyaan yang sering diajukan tentang Minning Truck LiuGong</p>
    </div>
    
    <div class="faq-grid">
        <div class="faq-item">
            <div class="faq-question">
                Apa keunggulan utama Minning Truck LiuGong dibanding merek lain?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>Minning Truck LiuGong unggul dalam sistem hidraulik yang presisi dan responsif untuk kemiringan blade (grading) akurat, kabin ergonomis dengan visibilitas 360°, frame artikulasi yang kokoh untuk manuver tajam, serta konsumsi bahan bakar yang efisien. Didukung jaringan dealer resmi PT Ganda Elang Tangguh dengan ketersediaan suku cadang dan biaya perawatan kompetitif.</p>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                Berapa panjang blade dan berat operasi Minning Truck LiuGong?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>Minning Truck LiuGong tersedia dalam berbagai seri mulai dari kelas 10 ton hingga 22 ton. Panjang blade (moldboard) berkisar antara 3,7 meter hingga 4,9 meter. Tenaga mesin dari 125 HP hingga 260+ HP. Berat operasi berkisar antara 10.500 kg hingga 22.000 kg tergantung model dan konfigurasi (misal: CLG4180D, CLG4215D).</p>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                Apakah PT Ganda Elang Tangguh dealer resmi Minning Truck LiuGong?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>Ya, PT Ganda Elang Tangguh adalah dealer resmi alat berat LiuGong di Indonesia yang mencakup penjualan Minning Truck baru, perawatan berkala, servis, penyediaan suku cadang original, serta garansi pabrik untuk seluruh unit Minning Truck LiuGong.</p>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                Minning Truck LiuGong cocok untuk proyek apa saja?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>Sangat cocok untuk perataan tanah (grading) pada pembangunan jalan, pembuatan bahu jalan, pembentukan saluran drainase, perapian lahan perkebunan (sawit, tebu), pemeliharaan jalan tambang dan jalan logging, penimbunan kembali (backfilling), serta pekerjaan kemiringan (sloping) untuk tanggul dan bendungan.</p>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                Apa perbedaan sistem blade standar dan blade dengan hidraulik pintar pada Minning Truck LiuGong?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>Minning Truck LiuGong modern (seri D) dilengkapi sistem hidraulik load-sensing yang menghemat bahan bakar hingga 15% dan memberikan kontrol presisi. Untuk kebutuhan grading akurasi tinggi, LiuGong mendukung pemasangan sistem grade control (2D/3D) dari merek ternama seperti Topcon atau Leica, sehingga meningkatkan efisiensi dan mengurangi pekerjaan ulang.</p>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                Bagaimana cara mendapatkan harga dan simulasi kredit Minning Truck LiuGong?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>Hubungi tim sales PT Ganda Elang Tangguh melalui WhatsApp, telepon, atau form kontak. Kami akan memberikan harga terbaru, spesifikasi lengkap (panjang blade, tenaga mesin, berat operasi), serta simulasi kredit dengan tenor fleksibel sesuai kebutuhan proyek Anda.</p>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                Apa saja layanan after-sales untuk Minning Truck LiuGong di Indonesia?
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>Kami menyediakan layanan purna jual lengkap: garansi standar pabrik, perawatan rutin (penggantian oli, filter, pengecekan sistem hidraulik dan steering artikulasi), servis mobile ke lokasi proyek, pelatihan operator untuk teknik grading yang efisien, serta stok suku cadang original (moldboard blade, edge, komponen mesin, hidraulik) di gudang pusat dan cabang.</p>
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
    </div>
</section>

<!-- ================= FOOTER ================= -->
<?php include $_SERVER['DOCUMENT_ROOT'] . "/footer.php"; ?>

<!-- JavaScript -->
<script src="/js/product.js"></script>

</body>
</html>
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
    
    <title>Wheel Loader LiuGong Indonesia | PT Ganda Elang Tangguh</title>
    
    <meta name="description" content="Wheel Loader LiuGong berkualitas tinggi untuk konstruksi, pertambangan, dan material handling. Dirancang untuk kekuatan, efisiensi bahan bakar, dan produktivitas maksimal.">
    <meta name="keywords" content="wheel loader liugong, wheel loader indonesia, loader alat berat, heavy equipment wheel loader">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <meta name="author" content="PT Ganda Elang Tangguh">
    <link rel="canonical" href="<?= $currentUrl ?>">
    
    <!-- Open Graph -->
    <meta property="og:title" content="Wheel Loader LiuGong Indonesia | PT Ganda Elang Tangguh">
    <meta property="og:description" content="Temukan berbagai wheel loader LiuGong untuk konstruksi, pertambangan, dan material handling.">
    <meta property="og:image" content="https://gandaelang.co.id/images/wheelloader.jpg">
    <meta property="og:url" content="<?= $currentUrl ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="PT Ganda Elang Tangguh">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Wheel Loader LiuGong Indonesia">
    <meta name="twitter:description" content="Wheel loader tangguh untuk proyek konstruksi dan pertambangan.">
    <meta name="twitter:image" content="https://gandaelang.co.id/images/wheelloader.jpg">
    
    <!-- Schema.org -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "CollectionPage",
        "name": "Wheel Loader LiuGong",
        "description": "Daftar produk wheel loader LiuGong untuk kebutuhan konstruksi, pertambangan dan material handling.",
        "url": "https://gandaelang.co.id/wheelloader.php",
        "publisher": {
            "@type": "Organization",
            "name": "PT Ganda Elang Tangguh",
            "logo": {
                "@type": "ImageObject",
                "url": "https://gandaelang.co.id/images/logo.webp"
            }
        }
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
        
        .product-card {
            height: 100%;
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
        <h2 class="product-title">Daftar Produk</h2>
        
        <div class="product-grid">
            <?php if (!empty($products)) : ?>
                <?php foreach ($products as $row) : ?>
                    <div class="product-card">
                        <a href="/detailprodukwheelloader.php?slug=<?= htmlspecialchars($row['slug']); ?>" class="product-link">
                            <div class="product-image">
                                <img 
                                    src="/images/uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" 
                                    alt="<?= htmlspecialchars($row['nama_produk']); ?>"
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

<!-- ================= FOOTER ================= -->
<?php include $_SERVER['DOCUMENT_ROOT'] . "/footer.php"; ?>

</body>
</html>
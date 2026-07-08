<?php
// Mulai output buffering
ob_start();

require_once __DIR__ . "/admin/config.php";

// Bersihkan output buffer dari include
ob_clean();

// Set header XML
header('Content-Type: application/xml; charset=utf-8');

// Base URL website
$baseUrl = "https://gandaelang.co.id";

// Daftar kategori produk
$kategoriProduk = [
    'aerial-platform',
    'air-compressor',
    'backhoe-loader',
    'bulldozer',
    'cold-planer',
    'crone',
    'excavator',
    'forklift',
    'foundation',
    'halvester',
    'mining-truck',
    'motor-grader',
    'paver',
    'roller',
    'skid-steer',
    'tractor',
    'warehouse-truck',
    'wheel-loader'
];

// Ambil semua produk dari database
try {
    $stmt = $pdo->query("
        SELECT 
            id,
            nama,
            slug,
            kategori,
            created_at,
            updated_at
        FROM produk
        WHERE status = 'aktif' OR status IS NULL
        ORDER BY kategori, nama ASC
    ");
    $produk = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Jika tabel produk tidak ada, set kosong
    $produk = [];
}

// Mulai output XML
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <!-- Halaman Utama Produk -->
    <url>
        <loc><?= $baseUrl ?>/produk</loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <!-- Halaman Kategori Produk -->
<?php foreach ($kategoriProduk as $kategori): ?>
    <url>
        <loc><?= $baseUrl ?>/<?= $kategori ?></loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
<?php endforeach; ?>

    <!-- Halaman Detail Produk -->
<?php if (!empty($produk)): ?>
<?php foreach ($produk as $row): 
    $urlProduk = $baseUrl . '/' . $row['kategori'] . '/' . $row['slug'];
    $lastmod = date('Y-m-d', strtotime($row['updated_at'] ?? $row['created_at']));
?>
    <url>
        <loc><?= htmlspecialchars($urlProduk) ?></loc>
        <lastmod><?= $lastmod ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
<?php endforeach; ?>
<?php endif; ?>

</urlset>
<?php
// Pastikan tidak ada output tambahan
exit;
?>
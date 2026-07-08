<?php
require_once __DIR__ . "/admin/config.php";

// Set header XML
header('Content-Type: application/xml; charset=utf-8');

// Base URL website
$baseUrl = "https://gandaelang.co.id";

// Daftar kategori produk dan file detailnya
$kategoriProduk = [
    'aerial-platform' => 'detailprodukaerialplatform.php',
    'air-compressor' => 'detailprodukaircompressor.php',
    'backhoe-loader' => 'detailprodukbackhoeloader.php',
    'bulldozer' => 'detailprodukbulldozer.php',
    'cold-planer' => 'detailprodukcoldplaner.php',
    'crone' => 'detailprodukcrone.php',
    'excavator' => 'detailprodukexcavator.php',
    'forklift' => 'detailprodukforklift.php',
    'foundation' => 'detailprodukfoundation.php',
    'halvester' => 'detailprodukhalvester.php',
    'mining-truck' => 'detailprodukminningtruck.php',
    'motor-grader' => 'detailprodukmotorgrader.php',
    'paver' => 'detailprodukpaver.php',
    'roller' => 'detailprodukroller.php',
    'skid-steer' => 'detailprodukskidsteer.php',
    'tractor' => 'detailproduktractor.php',
    'warehouse-truck' => 'detailprodukwarehousetruck.php',
    'wheel-loader' => 'detailprodukwheelloader.php'
];

// Ambil semua produk dari database
// Asumsi: ada tabel produk dengan kolom: id, nama, slug, kategori, created_at, updated_at
$stmt = $pdo->query("
    SELECT 
        id,
        nama,
        slug,
        kategori,
        created_at,
        updated_at
    FROM produk
    WHERE status = 'aktif'
    ORDER BY kategori, nama ASC
");

$produk = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

<?php foreach ($kategoriProduk as $kategori => $file): ?>
    <!-- Halaman Kategori Produk -->
    <url>
        <loc><?= $baseUrl ?>/<?= $kategori ?></loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
<?php endforeach; ?>

<?php foreach ($produk as $row): 
    // Tentukan URL produk berdasarkan kategori
    $urlProduk = $baseUrl . '/' . $row['kategori'] . '/' . $row['slug'];
?>
    <url>
        <loc><?= htmlspecialchars($urlProduk) ?></loc>
        <lastmod><?= date('Y-m-d', strtotime($row['updated_at'] ?? $row['created_at'])) ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
<?php endforeach; ?>

</urlset>
<?php
require_once __DIR__ . "/admin/config.php";

// Set header XML
header('Content-Type: application/xml; charset=utf-8');

// Base URL website
$baseUrl = "https://gandaelang.co.id";

// Ambil semua artikel dari database
$stmt = $pdo->query("
    SELECT 
        slug,
        created_at,
        updated_at
    FROM artikel
    ORDER BY created_at DESC
");

$artikel = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Mulai output XML
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <!-- Halaman Utama Blog -->
    <url>
        <loc><?= $baseUrl ?>/blog</loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>

<?php foreach ($artikel as $row): ?>
    <url>
        <loc><?= $baseUrl ?>/artikel/<?= htmlspecialchars($row['slug']) ?></loc>
        <lastmod><?= date('Y-m-d', strtotime($row['updated_at'] ?? $row['created_at'])) ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
<?php endforeach; ?>

</urlset>
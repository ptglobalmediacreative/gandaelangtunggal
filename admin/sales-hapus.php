<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "auth.php";
require_once "config.php";

/* CEK AKSES */
if(!cekAkses('sales')){
    die("Akses ditolak!");
}

/* CEK ID */
$id = $_GET['id'] ?? '';

if(!$id){
    header("Location: salesmanagement.php");
    exit;
}

$id = (int)$id;


/* AMBIL DATA */
$stmt = $pdo->prepare("
    SELECT * FROM sales_management WHERE id = ?
");
$stmt->execute([$id]);

$sales = $stmt->fetch();

if(!$sales){
    die("Data sales tidak ditemukan!");
}


/* FOLDER FILE (REAL PATH) */
$upload_dir = __DIR__ . "/uploads/data-sales/";


/* ================= HAPUS FILE ================= */

$files = [
    $sales['ktp'],
    $sales['npwp'],
    $sales['sim'],
    $sales['foto']
];

foreach($files as $file){

    if($file){

        $path = $upload_dir . $file;

        if(file_exists($path)){
            unlink($path);
        }

    }
}


/* ================= HAPUS DATABASE ================= */

$del = $pdo->prepare("
    DELETE FROM sales_management WHERE id = ?
");
$del->execute([$id]);


/* REDIRECT */
header("Location: salesmanagement.php?status=delete");
exit;

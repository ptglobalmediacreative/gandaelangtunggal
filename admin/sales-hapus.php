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
if(!isset($_GET['id'])){
    header("Location: sales.php");
    exit;
}

$id = (int) $_GET['id'];


/* AMBIL DATA */
$stmt = $pdo->prepare("SELECT * FROM sales_management WHERE id=?");
$stmt->execute([$id]);
$sales = $stmt->fetch();

if(!$sales){
    die("Data sales tidak ditemukan!");
}


/* FOLDER FILE */
$upload_dir = "/uploads/data-sales/";


/* ================= HAPUS FILE ================= */

$files = [
    $sales['ktp'],
    $sales['npwp'],
    $sales['sim'],
    $sales['foto']
];

foreach($files as $file){

    if($file && file_exists($upload_dir.$file)){
        unlink($upload_dir.$file);
    }
}


/* ================= HAPUS DATABASE ================= */

$stmt = $pdo->prepare("DELETE FROM sales_managament WHERE id=?");
$stmt->execute([$id]);


/* REDIRECT */
header("Location: sales.php?status=delete");
exit;

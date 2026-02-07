<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . "/config.php";

/* ================= LOGIN ================= */

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}


/* ================= CEK ID ================= */

if (!isset($_GET['id'])) {
    header("Location: produk.php");
    exit;
}

$id = (int) $_GET['id'];


/* ================= CONFIG ================= */

$upload_path = "../images/uploads/produk/";


/* ================= FUNCTION ================= */

/* Hapus file kalau tidak dipakai di tabel lain */
function deleteIfUnused($pdo, $file, $path){

    if(empty($file)) return;

    $q1 = $pdo->prepare("SELECT COUNT(*) FROM produk WHERE gambar=?");
    $q2 = $pdo->prepare("SELECT COUNT(*) FROM produk_features WHERE image=?");
    $q3 = $pdo->prepare("SELECT COUNT(*) FROM produk_gallery WHERE image=?");

    $q1->execute([$file]);
    $q2->execute([$file]);
    $q3->execute([$file]);

    if(
        $q1->fetchColumn() == 0 &&
        $q2->fetchColumn() == 0 &&
        $q3->fetchColumn() == 0
    ){
        $filePath = $path . $file;

        if(file_exists($filePath)){
            unlink($filePath);
        }
    }
}



/* ================= AMBIL FILE LAMA ================= */

/* Thumbnail */
$q = $pdo->prepare("SELECT gambar FROM produk WHERE id=?");
$q->execute([$id]);
$produk = $q->fetch();

if(!$produk){
    header("Location: produk.php");
    exit;
}

$thumb = $produk['gambar'];


/* Feature images */
$oldFeatures = $pdo->prepare("
    SELECT image FROM produk_features WHERE produk_id=?
");
$oldFeatures->execute([$id]);
$featureImages = $oldFeatures->fetchAll(PDO::FETCH_COLUMN);


/* Gallery images */
$oldGallery = $pdo->prepare("
    SELECT image FROM produk_gallery WHERE produk_id=?
");
$oldGallery->execute([$id]);
$galleryImages = $oldGallery->fetchAll(PDO::FETCH_COLUMN);



/* ================= TRANSACTION ================= */

try {

    $pdo->beginTransaction();


    /* Hapus relasi dulu */

    $pdo->prepare("
        DELETE FROM produk_features WHERE produk_id=?
    ")->execute([$id]);

    $pdo->prepare("
        DELETE FROM produk_spesifikasi WHERE produk_id=?
    ")->execute([$id]);

    $pdo->prepare("
        DELETE FROM produk_gallery WHERE produk_id=?
    ")->execute([$id]);


    /* Hapus produk */

    $pdo->prepare("
        DELETE FROM produk WHERE id=?
    ")->execute([$id]);


    $pdo->commit();


} catch(Exception $e){

    $pdo->rollBack();

    die("Gagal hapus produk: " . $e->getMessage());
}



/* ================= CLEAN FILE ================= */

/* Thumbnail */
deleteIfUnused($pdo, $thumb, $upload_path);


/* Feature images */
foreach($featureImages as $img){
    deleteIfUnused($pdo, $img, $upload_path);
}


/* Gallery images */
foreach($galleryImages as $img){
    deleteIfUnused($pdo, $img, $upload_path);
}



/* ================= REDIRECT ================= */

header("Location: produk.php?status=deleted");
exit;

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


/* ================= ID ================= */

if (!isset($_GET['id'])) {
    header("Location: artikel.php");
    exit;
}

$id = (int) $_GET['id'];


/* ================= CONFIG ================= */

$upload_path = "../images/uploads/artikel/";


/* ================= AMBIL DATA ================= */

$q = $pdo->prepare("SELECT gambar FROM artikel WHERE id=?");
$q->execute([$id]);
$data = $q->fetch();

if(!$data){
    header("Location: artikel.php");
    exit;
}

$gambar = $data['gambar'];


/* ================= HAPUS DATABASE ================= */

$del = $pdo->prepare("DELETE FROM artikel WHERE id=?");
$del->execute([$id]);


/* ================= HAPUS FILE GAMBAR ================= */

if($gambar){

    $file = $upload_path . $gambar;

    if(file_exists($file)){
        unlink($file);
    }
}


/* ================= REDIRECT ================= */

header("Location: artikel.php?status=deleted");
exit;

<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require_once "auth.php";
require_once "config.php";

/* CEK AKSES */
if(!cekAkses('leads')){
    die("Akses ditolak!");
}


/* CEK ID */
if(!isset($_GET['id'])){
    header("Location: leads.php");
    exit;
}

$id = (int)$_GET['id'];

$upload_path = "/uploads/data-customer/";


/* AMBIL DATA */
$stmt = $pdo->prepare("SELECT npwp_image FROM leads WHERE id=?");
$stmt->execute([$id]);

$data = $stmt->fetch();

if(!$data){
    header("Location: leads.php");
    exit;
}


/* HAPUS FILE */
if($data['npwp_image']){
    $file = $upload_path.$data['npwp_image'];

    if(file_exists($file)){
        unlink($file);
    }
}


/* HAPUS DB */
$stmt = $pdo->prepare("DELETE FROM leads WHERE id=?");
$stmt->execute([$id]);


header("Location: leads.php?status=delete");
exit;

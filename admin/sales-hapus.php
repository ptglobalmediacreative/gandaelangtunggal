<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require_once "auth.php";
require_once "config.php";

/* CEK AKSES */
if(!cekAkses('sales')){
    die("Akses ditolak!");
}

if(!isset($_GET['id'])){
    header("Location: salesmanagement.php");
    exit;
}

$id = (int)$_GET['id'];

$upload = "../images/uploads/sales/";

/* AMBIL DATA */
$stmt = $pdo->prepare("SELECT * FROM sales_management WHERE id=?");
$stmt->execute([$id]);

$sales = $stmt->fetch();

if(!$sales){
    header("Location: salesmanagement.php");
    exit;
}

/* HAPUS FILE */
$files = ['ktp','npwp','sim','foto'];

foreach($files as $f){

    if($sales[$f] && file_exists($upload.$sales[$f])){
        unlink($upload.$sales[$f]);
    }
}

/* HAPUS DB */
$stmt = $pdo->prepare("DELETE FROM sales_management WHERE id=?");
$stmt->execute([$id]);

header("Location: salesmanagement.php?status=hapus");
exit;

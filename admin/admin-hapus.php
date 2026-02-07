<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require_once "auth.php";
require_once "config.php";

/* CEK AKSES */
if(!cekAkses('user')){
    die("Akses ditolak!");
}


/* CEK ID */
if(!isset($_GET['id'])){
    header("Location: admin.php");
    exit;
}

$id = (int) $_GET['id'];


/* CEK DATA ADMIN */
$stmt = $pdo->prepare("SELECT * FROM admin WHERE id=?");
$stmt->execute([$id]);

$admin = $stmt->fetch();

if(!$admin){
    die("Data admin tidak ditemukan!");
}


/* TIDAK BOLEH HAPUS DIRI SENDIRI */
if($id == $_SESSION['admin_id']){
    die("Anda tidak bisa menghapus akun sendiri!");
}


/* TIDAK BOLEH HAPUS DEVELOPER */
if(strtolower($admin['keterangan']) == 'developer'){
    die("Akun Developer tidak bisa dihapus!");
}


/* PROSES HAPUS */
$stmt = $pdo->prepare("DELETE FROM admin WHERE id=?");
$stmt->execute([$id]);


/* REDIRECT */
header("Location: admin.php?status=delete");
exit;

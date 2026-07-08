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
    // Redirect dengan pesan error
    header("Location: admin.php?status=error&message=Data tidak ditemukan");
    exit;
}


/* TIDAK BOLEH HAPUS DIRI SENDIRI */
if($id == $_SESSION['admin_id']){
    header("Location: admin.php?status=error&message=Tidak bisa menghapus akun sendiri");
    exit;
}


/* TIDAK BOLEH HAPUS DEVELOPER */
if(isset($admin['keterangan']) && strtolower($admin['keterangan']) == 'developer'){
    header("Location: admin.php?status=error&message=Akun Developer tidak bisa dihapus");
    exit;
}


/* PROSES HAPUS */
try {
    $stmt = $pdo->prepare("DELETE FROM admin WHERE id = ?");
    $stmt->execute([$id]);
    
    // Cek apakah data berhasil dihapus
    if($stmt->rowCount() > 0) {
        header("Location: admin.php?status=delete&message=Data berhasil dihapus");
    } else {
        header("Location: admin.php?status=error&message=Gagal menghapus data");
    }
    exit;
    
} catch(PDOException $e) {
    // Jika ada error database
    header("Location: admin.php?status=error&message=Terjadi kesalahan database");
    exit;
}
?>
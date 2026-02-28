<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . "/config.php";
require_once "auth.php";

/* ================= LOGIN ================= */
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

/* ================= VALIDASI ID ================= */
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: artikel.php");
    exit;
}

$id = (int) $_GET['id'];

/* ================= CONFIG ================= */
$upload_path = realpath(__DIR__ . "/../images/uploads/artikel/") . DIRECTORY_SEPARATOR;

try {

    $pdo->beginTransaction();

    /* ================= AMBIL DATA ================= */
    $stmt = $pdo->prepare("SELECT gambar FROM artikel WHERE id=? LIMIT 1");
    $stmt->execute([$id]);
    $data = $stmt->fetch();

    if (!$data) {
        $pdo->rollBack();
        header("Location: artikel.php");
        exit;
    }

    $gambar = $data['gambar'];

    /* ================= HAPUS DATABASE ================= */
    $del = $pdo->prepare("DELETE FROM artikel WHERE id=?");
    $del->execute([$id]);

    /* ================= HAPUS FILE GAMBAR ================= */
    if (!empty($gambar)) {

        // Hindari manipulasi path
        $safeFile = basename($gambar);
        $filePath = $upload_path . $safeFile;

        if (file_exists($filePath) && is_file($filePath)) {
            unlink($filePath);
        }
    }

    $pdo->commit();

} catch (Exception $e) {

    $pdo->rollBack();
    die("Terjadi kesalahan saat menghapus data.");
}

/* ================= REDIRECT ================= */
header("Location: artikel.php?status=deleted");
exit;
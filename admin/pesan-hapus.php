<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . "/config.php";

/* CEK LOGIN */
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

/* CEK ID */
if (!isset($_GET['id'])) {
    header("Location: pesan.php");
    exit;
}

$id = (int)$_GET['id'];


/* CEK DATA */
$stmt = $pdo->prepare("
    SELECT id
    FROM pesan
    WHERE id=?
");

$stmt->execute([$id]);

if(!$stmt->fetch()){
    header("Location: pesan.php");
    exit;
}


/* HAPUS DATA */
$del = $pdo->prepare("
    DELETE FROM pesan
    WHERE id=?
");

$del->execute([$id]);


/* REDIRECT */
header("Location: pesan.php?status=deleted");
exit;

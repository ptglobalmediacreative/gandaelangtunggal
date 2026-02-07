<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . "/config.php";
require_once "auth.php";

/* CEK LOGIN */
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

/* CEK ID */
if (!isset($_GET['id'])) {
    header("Location: simulasi.php");
    exit;
}

$id = (int)$_GET['id'];


/* CEK DATA */
$stmt = $pdo->prepare("
    SELECT id
    FROM simulasi
    WHERE id=?
");

$stmt->execute([$id]);

if(!$stmt->fetch()){
    header("Location: simulasi.php");
    exit;
}


/* HAPUS DATA */
$del = $pdo->prepare("
    DELETE FROM simulasi
    WHERE id=?
");

$del->execute([$id]);


/* REDIRECT */
header("Location: simulasi.php?status=deleted");
exit;

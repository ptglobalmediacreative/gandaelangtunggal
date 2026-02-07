<?php
// config.php (PDO Version)

error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$db   = "u166903321_get";
$user = "u166903321_get";
$pass = "Natanael110405";

try {

    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );

} catch (PDOException $e) {

    die("Koneksi database gagal: " . $e->getMessage());

}

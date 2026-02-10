<?php
// config.php (PDO Version)

error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$db   = "u475225363_get";
$user = "u475225363_get";
$pass = "Websiteget123";

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

<?php
// config.php

// Konfigurasi Database
$host = "localhost";
$user = "u166903321_get";       // username database
$pass = "Natanael110405";           // password database
$db   = "u166903321_get"; // ganti dengan nama database kamu

// Membuat koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Set timezone (opsional)
date_default_timezone_set("Asia/Jakarta");
?>

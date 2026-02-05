<?php
$host = "localhost"; 
$user = "u166903321_get"; 
$pass = "Natanael110405"; 
$db   = "u166903321_get";

$conn = new mysqli($host, $user, $pass, $db);

// cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

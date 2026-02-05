<?php
$host = "localhost"; 
$user = "u166903321_saleshinoidn"; 
$pass = "NatanaelH1no0504@@"; 
$db   = "u166903321_saleshinoidn";

$conn = new mysqli($host, $user, $pass, $db);

// cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

<?php
include "config.php";

$nama = "Nathan";
$no_hp = "085975287684";
$password_asli = "admin123";

// Buat hash password
$password_hash = password_hash($password_asli, PASSWORD_DEFAULT);

// Simpan ke database
$query = mysqli_query($koneksi, "
    INSERT INTO admin (nama, no_hp, password)
    VALUES ('$nama', '$no_hp', '$password_hash')
");

if ($query) {
    echo "Admin berhasil dibuat!";
} else {
    echo "Gagal: " . mysqli_error($koneksi);
}
?>

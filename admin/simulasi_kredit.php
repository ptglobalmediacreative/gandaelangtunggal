<?php
include 'config.php'; // koneksi database (mysqli)

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name    = $conn->real_escape_string($_POST['name']);
    $phone   = $conn->real_escape_string($_POST['phone']);
    $mobil   = $conn->real_escape_string($_POST['mobil']);
    $tenor   = (int) $_POST['tenor'];
    $dp      = (int) $_POST['dp'];
    $message = $conn->real_escape_string($_POST['message']);

    // Validasi sederhana
    if (
        empty($name) ||
        empty($phone) ||
        empty($mobil) ||
        $tenor <= 0 ||
        $dp <= 0 ||
        empty($message)
    ) {
        echo "<script>
                alert('Data belum lengkap!');
                history.back();
              </script>";
        exit;
    }

    $sql = "INSERT INTO simulasi_kredit 
            (name, phone, mobil, tenor, dp, message)
            VALUES 
            ('$name', '$phone', '$mobil', '$tenor', '$dp', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Simulasi kredit berhasil dikirim!');
                window.location.href = '../simulasi?status=success';
              </script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

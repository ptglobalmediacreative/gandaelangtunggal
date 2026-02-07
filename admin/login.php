<?php
session_start();
include "config.php";

/* Kalau sudah login */
if (isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit;
}

/* Error message */
$error = "";

/* Proses Login */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $no_hp    = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $password = $_POST['password'];

    /* Ambil data admin */
    $query = mysqli_query($koneksi, "
        SELECT * FROM admin 
        WHERE no_hp = '$no_hp'
        LIMIT 1
    ");

    $data = mysqli_fetch_assoc($query);

    if ($data) {

        /* Verifikasi password */
        if (password_verify($password, $data['password'])) {

            /* SESSION UTAMA */
            $_SESSION['admin_id']   = $data['id'];
            $_SESSION['admin_nama'] = $data['nama'];
            $_SESSION['keterangan'] = $data['keterangan'];

            /* SESSION AKSES */
            $_SESSION['akses_dashboard'] = $data['akses_dashboard'];
            $_SESSION['akses_produk']   = $data['akses_produk'];
            $_SESSION['akses_artikel']  = $data['akses_artikel'];
            $_SESSION['akses_pesan']    = $data['akses_pesan'];
            $_SESSION['akses_simulasi'] = $data['akses_simulasi'];
            $_SESSION['akses_user']     = $data['akses_user'];
            $_SESSION['akses_leads']    = $data['akses_leads'];
            $_SESSION['akses_sales']    = $data['akses_sales'];
            $_SESSION['akses_stock']    = $data['akses_stock'];
            $_SESSION['akses_delivery'] = $data['akses_delivery'];

            /* AUTO FULL AKSES JIKA DEVELOPER */
            if ($data['keterangan'] == 'Developer') {

                $_SESSION['akses_dashboard'] = 1;
                $_SESSION['akses_produk']   = 1;
                $_SESSION['akses_artikel']  = 1;
                $_SESSION['akses_pesan']    = 1;
                $_SESSION['akses_simulasi'] = 1;
                $_SESSION['akses_user']     = 1;
                $_SESSION['akses_leads']    = 1;
                $_SESSION['akses_sales']    = 1;
                $_SESSION['akses_stock']    = 1;
                $_SESSION['akses_delivery'] = 1;

            }

            /* Redirect */
            header("Location: dashboard.php");
            exit;

        } else {
            $error = "❌ Password salah!";
        }

    } else {
        $error = "❌ No HP tidak terdaftar!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Admin | Ganda Elang Tangguh</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Favicon -->
<link rel="icon" type="image/webp" href="../images/favicon.webp">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- CSS -->
<link rel="stylesheet" href="/admin/css/style.css">
<link rel="stylesheet" href="/admin/css/login.css">

</head>
<body>

<div class="login-box">

    <img src="../images/logo.webp" alt="Logo Ganda Elang Tangguh">

    <h2>Admin Panel</h2>

    <!-- Error -->
    <?php if ($error != ""): ?>
        <div class="error">
            <?= $error; ?>
        </div>
    <?php endif; ?>

    <!-- Form Login -->
    <form method="POST">

        <div class="form-group">
            <label>No Handphone</label>
            <input type="text" name="no_hp" required autocomplete="off">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" class="btn-login">
            Login
        </button>

    </form>

    <div class="footer-text">
        © <?= date("Y"); ?> Ganda Elang Tangguh
    </div>

</div>

</body>
</html>

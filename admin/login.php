<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "/admin/config.php"; // sesuaikan kalau beda folder

// Kalau sudah login → ke dashboard
if (isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit;
}

// Proses Login
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $no_hp    = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $password = $_POST['password'];

    // Cari admin
    $query = mysqli_query($koneksi, "SELECT * FROM admin WHERE no_hp='$no_hp'");
    $data  = mysqli_fetch_assoc($query);

    if ($data) {

        // Cek password hash
        if (password_verify($password, $data['password'])) {

            // Set session
            $_SESSION['admin_id']   = $data['id'];
            $_SESSION['admin_nama'] = $data['nama'];

            // Redirect ke dashboard
            header("Location: dashboard.php");
            exit;

        } else {
            $error = "Password salah!";
        }

    } else {
        $error = "No HP tidak terdaftar!";
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
    <form method="POST" action="">

        <div class="form-group">
            <label>No Handphone</label>
            <input type="text" name="no_hp" required>
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

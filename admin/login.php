<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // DI SINI SAJA
require_once __DIR__ . "/config.php";

// Kalau sudah login → dashboard
if (isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit;
}

$error = "";

/* ================= LOGIN ================= */

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $no_hp    = trim($_POST['no_hp'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($no_hp == '' || $password == '') {

        $error = "Semua field wajib diisi!";

    } else {

        $stmt = $pdo->prepare("SELECT * FROM admin WHERE no_hp = ?");
        $stmt->execute([$no_hp]);

        $data = $stmt->fetch();

        if ($data) {

            if (password_verify($password, $data['password'])) {

                $_SESSION['admin_id']   = $data['id'];
                $_SESSION['admin_nama'] = $data['nama'];
                $_SESSION['admin_role'] = $data['keterangan'];

                $_SESSION['akses'] = [
                    'dashboard' => $data['akses_dashboard'],
                    'produk'    => $data['akses_produk'],
                    'artikel'   => $data['akses_artikel'],
                    'pesan'     => $data['akses_pesan'],
                    'simulasi'  => $data['akses_simulasi'],
                    'user'      => $data['akses_user'],
                    'leads'     => $data['akses_leads'],
                    'sales'     => $data['akses_sales'],
                    'stock'     => $data['akses_stock'],
                    'delivery'  => $data['akses_delivery']
                ];

                header("Location: dashboard.php");
                exit;

            } else {
                $error = "Password salah!";
            }

        } else {
            $error = "No HP tidak terdaftar!";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" href="../images/favicon.webp">
<link rel="stylesheet" href="/admin/css/style.css">
<link rel="stylesheet" href="/admin/css/login.css">

</head>
<body>

<div class="login-box">

    <img src="../images/logo.webp" alt="Logo">

    <h2>Admin Panel</h2>

    <!-- ERROR -->
    <?php if($error): ?>
        <div class="error">
            <?= htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <!-- FORM -->
    <form method="POST">

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

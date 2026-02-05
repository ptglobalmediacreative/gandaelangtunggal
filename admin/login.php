<?php
session_start();

if (isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin | Ganda Elang Tangguh</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Global -->
    <link rel="stylesheet" href="/admin/css/style.css">

    <!-- CSS Login -->
    <link rel="stylesheet" href="/admin/css/login.css">

</head>
<body>

<div class="login-box">

    <img src="../images/logo.webp" alt="Logo Ganda Elang Tangguh">

    <h2>Admin Panel</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="error">
            <?= htmlspecialchars($_GET['error']); ?>
        </div>
    <?php endif; ?>

    <form action="login_proses.php" method="POST">

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

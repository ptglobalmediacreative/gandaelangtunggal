<?php
// ============================================
// REDIRECT KE HALAMAN LOGIN
// ============================================

// Jika sudah login, redirect ke dashboard
session_start();
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

// Jika belum login, redirect ke login
header('Location: login.php');
exit;
?>
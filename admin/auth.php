<?php
// ============================================
// AUTH.PHP - MANAJEMEN SESSION & AKSES
// ============================================

// ===== START SESSION =====
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ===== REGENERASI SESSION ID (CEGAH SESSION FIXATION) =====
if (!isset($_SESSION['created'])) {
    session_regenerate_id(true);
    $_SESSION['created'] = time();
}

// ===== TIMEOUT SESSION (30 MENIT) =====
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    session_unset();
    session_destroy();
    header("Location: login.php?timeout=1");
    exit;
}
$_SESSION['last_activity'] = time();

// ===== CEK SESSION HIJACKING (OPTIONAL) =====
if (isset($_SESSION['user_agent']) && $_SESSION['user_agent'] !== md5($_SERVER['HTTP_USER_AGENT'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

// ===== LOAD CONFIG =====
require_once __DIR__ . "/config.php";

// ===== CEK LOGIN =====
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

// ===== AMBIL DATA ADMIN =====
try {
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE id = ?");
    $stmt->execute([$_SESSION['admin_id']]);
    $adminLogin = $stmt->fetch();

    if (!$adminLogin) {
        // Jika admin tidak ditemukan, logout
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit;
    }
} catch (PDOException $e) {
    error_log("Auth error: " . $e->getMessage());
    die("Terjadi kesalahan sistem. Silakan coba lagi.");
}

// ===== UPDATE LAST ACTIVITY DI DATABASE (OPTIONAL) =====
// $pdo->prepare("UPDATE admin SET last_activity = NOW() WHERE id = ?")->execute([$_SESSION['admin_id']]);

// ============================================
// FUNGSI CEK AKSES
// ============================================

function cekAkses($menu) {
    global $adminLogin;

    if (!$adminLogin) {
        return false;
    }

    // Mapping menu ke kolom database
    $map = [
        'dashboard' => 'akses_dashboard',
        'produk'    => 'akses_produk',
        'artikel'   => 'akses_artikel',
        'pesan'     => 'akses_pesan',
        'simulasi'  => 'akses_simulasi',
        'user'      => 'akses_user',
    ];

    // Cek apakah menu ada di mapping
    if (!isset($map[$menu])) {
        return false;
    }

    $column = $map[$menu];

    // Cek apakah kolom ada di array adminLogin
    if (!isset($adminLogin[$column])) {
        return false;
    }

    // Return true jika nilai = 1
    return $adminLogin[$column] == 1;
}

// ============================================
// FUNGSI CEK AKSES DENGAN REDIRECT
// ============================================

function cekAksesRedirect($menu, $redirectTo = 'dashboard.php') {
    if (!cekAkses($menu)) {
        $_SESSION['error_message'] = "Maaf, Anda tidak memiliki akses ke halaman ini!";
        header("Location: " . $redirectTo);
        exit;
    }
    return true;
}

// ============================================
// FUNGSI TOLAK AKSES (JIKA DITOLAK)
// ============================================

function tolakAkses() {
    $message = "Maaf, Akses Ditolak! Anda tidak memiliki izin untuk mengakses halaman ini.";
    
    // Gunakan session untuk menyimpan pesan error
    $_SESSION['error_message'] = $message;
    
    // Redirect ke halaman sebelumnya atau dashboard
    $referer = $_SERVER['HTTP_REFERER'] ?? '';
    if (!empty($referer) && strpos($referer, $_SERVER['HTTP_HOST']) !== false) {
        // Hanya redirect ke internal URL
        $redirectUrl = $referer;
    } else {
        $redirectUrl = 'dashboard.php';
    }
    
    header("Location: " . $redirectUrl);
    exit;
}

// ============================================
// FUNGSI LOGOUT
// ============================================

function logout() {
    // Hapus semua session
    $_SESSION = array();
    
    // Hapus session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }
    
    session_destroy();
    header("Location: login.php");
    exit;
}

// ============================================
// FUNGSI CEK LEVEL ADMIN (UNTUK SUPER ADMIN)
// ============================================

function isSuperAdmin() {
    global $adminLogin;
    return isset($adminLogin['level']) && $adminLogin['level'] === 'admin';
}

function isAdmin() {
    global $adminLogin;
    return isset($adminLogin['level']) && ($adminLogin['level'] === 'admin' || $adminLogin['level'] === 'super_admin');
}

// ============================================
// FUNGSI GET DATA ADMIN (UNTUK VIEW)
// ============================================

function getAdminData() {
    global $adminLogin;
    return $adminLogin;
}

// ============================================
// TAMPILKAN ERROR MESSAGE JIKA ADA (UNTUK VIEW)
// ============================================

function showError() {
    if (isset($_SESSION['error_message'])) {
        $message = $_SESSION['error_message'];
        unset($_SESSION['error_message']);
        return $message;
    }
    return null;
}
?>
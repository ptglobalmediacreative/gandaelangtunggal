<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . "/config.php";

// ============================================
// KONFIGURASI CLOUDFLARE TURNSTILE
// ============================================
define('TURNSTILE_SITE_KEY', '0x4AAAAAADtStHRfj3URE4JN');
define('TURNSTILE_SECRET_KEY', '0x4AAAAAADtStAKGWBUGaHlyzMOCwgkaUF0');

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
    $cf_token = $_POST['cf-turnstile-response'] ?? ''; // ← TAMBAHKAN INI

    // ============================================
    // VALIDASI TURNSTILE (TAMBAHKAN INI)
    // ============================================
    if (empty($cf_token)) {
        $error = "Silakan verifikasi bahwa Anda bukan robot!";
    } else {
        // Verifikasi token ke Cloudflare
        $url = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
        $data = [
            'secret' => TURNSTILE_SECRET_KEY,
            'response' => $cf_token,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $result = json_decode($response, true);

        if ($httpCode !== 200 || !isset($result['success']) || $result['success'] !== true) {
            $error = "Verifikasi keamanan gagal! Silakan coba lagi.";
        } else {
            // ============================================
            // PROSES LOGIN (LANJUTKAN DI SINI)
            // ============================================
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

<!-- ============================================ -->
<!-- TAMBAHKAN SCRIPT TURNSTILE DI SINI -->
<!-- ============================================ -->
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

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
    <form method="POST" id="loginForm">

        <div class="form-group">
            <label>No Handphone</label>
            <input type="text" name="no_hp" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <!-- ============================================ -->
        <!-- TAMBAHKAN WIDGET TURNSTILE DI SINI -->
        <!-- ============================================ -->
        <div class="form-group">
            <div 
                class="cf-turnstile" 
                data-sitekey="<?= TURNSTILE_SITE_KEY ?>"
                data-theme="light"
                data-size="normal"
                data-callback="turnstileCallback"
            ></div>
        </div>

        <button type="submit" class="btn-login" id="loginBtn" disabled>
            Login
        </button>

    </form>

    <div class="footer-text">
        © <?= date("Y"); ?> Ganda Elang Tangguh
    </div>

</div>

<!-- ============================================ -->
<!-- TAMBAHKAN JAVASCRIPT DI SINI -->
<!-- ============================================ -->
<script>
// Aktifkan tombol login setelah Turnstile selesai
function turnstileCallback(token) {
    document.getElementById('loginBtn').disabled = false;
}

// Cegah submit jika Turnstile belum diisi
document.getElementById('loginForm').addEventListener('submit', function(e) {
    var token = document.querySelector('[name="cf-turnstile-response"]');
    if (!token || token.value === '') {
        e.preventDefault();
        alert('Silakan verifikasi bahwa Anda bukan robot!');
        return false;
    }
});
</script>

</body>
</html>
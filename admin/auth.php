<?php
session_start();
require_once "config.php";


/* CEK LOGIN */
if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}


/* AMBIL DATA ADMIN */
$stmt = $pdo->prepare("SELECT * FROM admin WHERE id=?");
$stmt->execute([ $_SESSION['admin_id'] ]);

$adminLogin = $stmt->fetch();


/* FUNGSI CEK AKSES */
function cekAkses($menu){

    global $adminLogin;

    $map = [
        'dashboard' => 'akses_dashboard',
        'produk'    => 'akses_produk',
        'artikel'   => 'akses_artikel',
        'pesan'     => 'akses_pesan',
        'simulasi'  => 'akses_simulasi',
        'user'      => 'akses_user',
        'leads'     => 'akses_leads',
        'sales'     => 'akses_sales',
        'stock'     => 'akses_stock',
        'delivery'  => 'akses_delivery'
    ];

    if(!isset($map[$menu])) return false;

    return $adminLogin[$map[$menu]] == 1;
}


/* REDIRECT + POPUP JIKA DITOLAK */
function tolakAkses(){

    echo "
    <script>
        alert('Maaf, Akses Ditolak!');
        if(document.referrer){
            window.location.href = document.referrer;
        }else{
            window.location.href = 'dashboard.php';
        }
    </script>
    ";
    exit;
}

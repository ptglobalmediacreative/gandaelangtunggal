<?php
session_start();

// Cek login
if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}

// Function cek akses
function cekAkses($menu){

    if(!isset($_SESSION['akses'][$menu])){
        return false;
    }

    return $_SESSION['akses'][$menu] == 1;
}

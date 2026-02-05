<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" href="../images/favicon.webp">

<link rel="stylesheet" href="/admin/css/style.css">
<link rel="stylesheet" href="/admin/css/dashboard.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>

<div class="admin-wrapper">

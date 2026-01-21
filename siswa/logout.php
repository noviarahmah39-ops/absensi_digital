<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="2;url=login.php">
    <title>Logout - SMA Nusa Indah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f0f7ff; height: 100vh; display: flex; align-items: center; justify-content: center; text-align: center; }
        .logo-logout { width: 100px; margin-bottom: 20px; animation: fadeOut 2s forwards; }
        @keyframes fadeOut { from { opacity: 1; } to { opacity: 0.5; } }
    </style>
</head>
<body>
    <div>
        <img src="../assets/img/logo.png" alt="Logo" class="logo-logout">
        <h4 class="text-primary fw-bold">Anda Telah Logout</h4>
        <p class="text-muted small">Kembali ke halaman login dalam 2 detik...</p>
    </div>
</body>
</html>
<?php
session_start();
include '../config/config.php';
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }

$username = $_SESSION['username'];
$query = mysqli_query($conn, "SELECT * FROM siswa WHERE username = '$username'");
$user = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - SMA Nusa Indah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; }
        #sidebar { background: #003366; min-height: 100vh; width: 260px; position: fixed; color: white; }
        .sidebar-logo { padding: 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-logo img { width: 100px; margin-bottom: 10px; }
        .nav-link { color: rgba(255,255,255,0.7); padding: 15px 25px; }
        .nav-link:hover, .nav-link.active { color: white; background: #0d6efd; }
        .content { margin-left: 260px; padding: 30px; }
    </style>
</head>
<body>

    <div id="sidebar">
        <div class="sidebar-logo">
            <img src="../assets/img/logo.png" alt="Logo">
            <h6 class="mb-0 fw-bold">SMA NUSA INDAH</h6>
        </div>
        <ul class="nav flex-column mt-3">
            <li class="nav-item"><a href="dashboard.php" class="nav-link active"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
            <li class="nav-item"><a href="presensi.php" class="nav-link"><i class="bi bi-calendar-check me-2"></i> Presensi</a></li>
            <li class="nav-item"><a href="riwayat.php" class="nav-link"><i class="bi bi-clock-history me-2"></i> Riwayat</a></li>
            <li class="nav-item"><a href="profil.php" class="nav-link"><i class="bi bi-person me-2"></i> Profil</a></li>
            <li class="nav-item mt-5"><a href="logout.php" class="nav-link text-warning"><i class="bi bi-box-arrow-left me-2"></i> Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-white rounded shadow-sm">
            <h5 class="mb-0 fw-bold text-primary">Panel Siswa</h5>
            <div class="d-flex align-items-center">
                <span class="me-3 small text-muted"><?= $user['nama']; ?></span>
                <img src="../assets/img/<?= $user['foto'] ? $user['foto'] : 'default.png'; ?>" class="rounded-circle" width="40" height="40" style="object-fit: cover;">
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white p-4 border-0 shadow-sm rounded-4">
                    <h6>Total Kehadiran</h6>
                    <h2 class="fw-bold">20 Hari</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white p-4 border-0 shadow-sm rounded-4">
                    <h6>Status Hari Ini</h6>
                    <h2 class="fw-bold small">Sudah Absen</h2>
                </div>
            </div>
            <div class="col-md-12">
                <div class="bg-white p-4 rounded-4 shadow-sm">
                    <h5 class="fw-bold">Informasi Siswa</h5>
                    <hr>
                    <p><strong>Jenis Kelamin:</strong> <?= $user['jenis_kelamin'] ? $user['jenis_kelamin'] : 'Belum diset'; ?></p>
                    <p><strong>Username:</strong> <?= $user['username']; ?></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
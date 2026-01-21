<?php
session_start();
include '../config/config.php';

if (!isset($_SESSION['admin_login'])) { 
    header("Location: login.php"); 
    exit; 
}

// Statistik
$tanggal_sekarang = date('Y-m-d');
$jml_siswa = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM siswa"));
$hadir_hari_ini = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM absensi WHERE tanggal = '$tanggal_sekarang'"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - SMA Nusa Indah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; }
        #sidebar { background: #001f3f; min-height: 100vh; width: 260px; position: fixed; color: white; transition: 0.3s; }
        .sidebar-logo { padding: 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-logo img { width: 100px; height: auto; margin-bottom: 10px; }
        .nav-link { color: rgba(255,255,255,0.7); padding: 15px 25px; }
        .nav-link:hover, .nav-link.active { color: white; background: #0d6efd; border-radius: 5px; margin: 0 10px; }
        .content { margin-left: 260px; padding: 30px; }
        .card-box { border: none; border-radius: 15px; transition: 0.3s; }
        .card-box:hover { transform: translateY(-5px); }
    </style>
</head>
<body>

    <div id="sidebar">
        <div class="sidebar-logo">
            <img src="../assets/img/logo.png" alt="Logo">
            <h6 class="fw-bold">ADMIN PANEL</h6>
        </div>
        <ul class="nav flex-column mt-3">
            <li class="nav-item"><a href="dashboard.php" class="nav-link active"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
            <li class="nav-item"><a href="infoUser.php" class="nav-link"><i class="bi bi-people me-2"></i> Info User</a></li>
            <li class="nav-item"><a href="rekap.php" class="nav-link"><i class="bi bi-file-earmark-text me-2"></i> Rekap Presensi</a></li>
            <li class="nav-item mt-5"><a href="logout.php" class="nav-link text-danger"><i class="bi bi-box-arrow-left me-2"></i> Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <h4 class="fw-bold mb-4">Selamat Datang, Administrator</h4>
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card card-box bg-white shadow-sm p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary text-white rounded-3 p-3 me-3">
                            <i class="bi bi-people fs-2"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Total Siswa Terdaftar</h6>
                            <h2 class="fw-bold mb-0"><?= $jml_siswa; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-box bg-white shadow-sm p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-success text-white rounded-3 p-3 me-3">
                            <i class="bi bi-calendar-check fs-2"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Hadir Hari Ini (<?= date('d M'); ?>)</h6>
                            <h2 class="fw-bold mb-0"><?= $hadir_hari_ini; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
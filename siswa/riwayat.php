<?php
session_start();
include '../config/config.php';
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }

$username = $_SESSION['username'];
$query = mysqli_query($conn, "SELECT * FROM absensi WHERE username = '$username' ORDER BY tanggal DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat - SMA Nusa Indah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; }
        #sidebar { background: #003366; min-height: 100vh; width: 260px; position: fixed; color: white; }
        .sidebar-logo { padding: 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-logo img { width: 50px; }
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
            <li class="nav-item"><a href="dashboard.php" class="nav-link"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
            <li class="nav-item"><a href="presensi.php" class="nav-link"><i class="bi bi-calendar-check me-2"></i> Presensi</a></li>
            <li class="nav-item"><a href="riwayat.php" class="nav-link active"><i class="bi bi-clock-history me-2"></i> Riwayat</a></li>
            <li class="nav-item"><a href="profil.php" class="nav-link"><i class="bi bi-person me-2"></i> Profil</a></li>
            <li class="nav-item mt-5"><a href="logout.php" class="nav-link text-warning"><i class="bi bi-box-arrow-left me-2"></i> Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <h4 class="fw-bold text-primary mb-4">Riwayat Kehadiran</h4>
        
        <div class="card border-0 shadow-sm p-4 rounded-4">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; while($row = mysqli_fetch_assoc($query)) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= date("d-m-Y", strtotime($row['tanggal'])); ?></td>
                        <td><?= $row['jam_masuk']; ?> WIB</td>
                        <td><span class="badge bg-success">Hadir</span></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php
session_start();
include '../config/config.php';
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }

$username = $_SESSION['username'];
$tanggal_hari_ini = date("Y-m-d");
$pesan = "";

// Cek apakah sudah absen hari ini
$cek_absen = mysqli_query($conn, "SELECT * FROM absensi WHERE username = '$username' AND tanggal = '$tanggal_hari_ini'");
$sudah_absen = mysqli_num_rows($cek_absen);

if (isset($_POST['absen'])) {
    $jam_sekarang = date("H:i:s");
    
    if ($sudah_absen == 0) {
        $insert = mysqli_query($conn, "INSERT INTO absensi (username, tanggal, jam_masuk) VALUES ('$username', '$tanggal_hari_ini', '$jam_sekarang')");
        if ($insert) {
            echo "<script>alert('Absen Berhasil!'); window.location='presensi.php';</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Presensi - SMA Nusa Indah</title>
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
        .clock { font-size: 3rem; font-weight: bold; color: #003366; }
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
            <li class="nav-item"><a href="presensi.php" class="nav-link active"><i class="bi bi-calendar-check me-2"></i> Presensi</a></li>
            <li class="nav-item"><a href="riwayat.php" class="nav-link"><i class="bi bi-clock-history me-2"></i> Riwayat</a></li>
            <li class="nav-item"><a href="profil.php" class="nav-link"><i class="bi bi-person me-2"></i> Profil</a></li>
            <li class="nav-item mt-5"><a href="logout.php" class="nav-link text-warning"><i class="bi bi-box-arrow-left me-2"></i> Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <h4 class="fw-bold text-primary mb-4">Presensi Harian</h4>
        
        <div class="card border-0 shadow-sm p-5 rounded-4 text-center">
            <div class="mb-3 text-muted fw-bold"><?= date("l, d F Y"); ?></div>
            <div id="displayClock" class="clock mb-4">00:00:00</div>

            <?php if ($sudah_absen > 0) : ?>
                <div class="alert alert-success d-inline-block">
                    <i class="bi bi-check-circle-fill me-2"></i> Anda sudah melakukan absensi hari ini.
                </div>
            <?php else : ?>
                <form method="POST">
                    <button type="submit" name="absen" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow">
                        <i class="bi bi-fingerprint me-2"></i> KLIK UNTUK HADIR
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function updateTime() {
            const now = new Date();
            const clock = document.getElementById('displayClock');
            clock.innerText = now.toLocaleTimeString('id-ID');
        }
        setInterval(updateTime, 1000);
        updateTime();
    </script>
</body>
</html>
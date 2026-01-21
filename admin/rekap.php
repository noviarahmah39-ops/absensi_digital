<?php
session_start();
include '../config/config.php';

// Proteksi: Hanya admin yang boleh masuk
if (!isset($_SESSION['admin_login'])) { 
    header("Location: login.php"); 
    exit; 
}

// Query mengambil data absensi digabung dengan nama siswa dari tabel siswa
$sql = "SELECT absensi.*, siswa.nama, siswa.jenis_kelamin 
        FROM absensi 
        JOIN siswa ON absensi.username = siswa.username 
        ORDER BY absensi.tanggal DESC, absensi.jam_masuk DESC";
$query = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Presensi - SMA Nusa Indah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', sans-serif; }
        #sidebar { background: #001f3f; min-height: 100vh; width: 260px; position: fixed; color: white; }
        .sidebar-logo { padding: 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-logo img { width: 100px; margin-bottom: 10px; }
        .nav-link { color: rgba(255,255,255,0.7); padding: 15px 25px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: white; background: #0d6efd; }
        .content { margin-left: 260px; padding: 30px; }
        
        /* Pengaturan Cetak */
        @media print {
            #sidebar, .btn-print, .btn-back { display: none !important; }
            .content { margin-left: 0; padding: 0; }
            .card { border: none !important; box-shadow: none !important; }
            .table { width: 100% !important; }
        }
    </style>
</head>
<body>

    <div id="sidebar">
        <div class="sidebar-logo">
            <img src="../assets/img/logo.png" alt="Logo">
            <h6 class="fw-bold">ADMIN PANEL</h6>
        </div>
        <ul class="nav flex-column mt-3">
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="infoUser.php" class="nav-link">
                    <i class="bi bi-people me-2"></i> Info User
                </a>
            </li>
            <li class="nav-item">
                <a href="rekap.php" class="nav-link active">
                    <i class="bi bi-file-earmark-text me-2"></i> Rekap Presensi
                </a>
            </li>
            <li class="nav-item mt-5">
                <a href="logout.php" class="nav-link text-danger">
                    <i class="bi bi-box-arrow-left me-2"></i> Logout
                </a>
            </li>
        </ul>
    </div>

    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold text-dark">Laporan Rekapitulasi Absensi</h4>
                <p class="text-muted mb-0">Seluruh data kehadiran siswa SMA Nusa Indah</p>
            </div>
            <button onclick="window.print()" class="btn btn-success btn-print shadow-sm">
                <i class="bi bi-printer me-2"></i> Cetak Laporan
            </button>
        </div>

        <div class="card border-0 shadow-sm p-4 rounded-4">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Siswa</th>
                            <th>JK</th>
                            <th>Tanggal</th>
                            <th>Jam Masuk</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        if(mysqli_num_rows($query) > 0) {
                            while($row = mysqli_fetch_assoc($query)) : 
                        ?>
                        <tr class="text-center">
                            <td><?= $no++; ?></td>
                            <td class="text-start fw-bold"><?= $row['nama']; ?></td>
                            <td><?= $row['jenis_kelamin'] == 'Laki-laki' ? 'L' : 'P'; ?></td>
                            <td><?= date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    <?= $row['jam_masuk']; ?> WIB
                                </span>
                            </td>
                            <td><span class="badge bg-success px-3">Hadir</span></td>
                        </tr>
                        <?php 
                            endwhile; 
                        } else {
                            echo "<tr><td colspan='6' class='text-center text-muted p-4'>Belum ada data absensi masuk.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
session_start();
include '../config/config.php';

// Proteksi halaman: Hanya admin yang sudah login bisa masuk
if (!isset($_SESSION['admin_login'])) { 
    header("Location: login.php"); 
    exit; 
}

// LOGIKA HAPUS USER
if (isset($_GET['hapus'])) {
    $id_siswa = $_GET['hapus'];
    
    // Query hapus data berdasarkan ID
    $delete = mysqli_query($conn, "DELETE FROM siswa WHERE id = '$id_siswa'");
    
    if ($delete) {
        echo "<script>
                alert('Siswa berhasil dihapus!');
                window.location='infoUser.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data!');
                window.location='infoUser.php';
              </script>";
    }
}

// Ambil data siswa untuk ditampilkan di tabel
$query = mysqli_query($conn, "SELECT * FROM siswa ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Siswa - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; }
        #sidebar { background: #001f3f; min-height: 100vh; width: 260px; position: fixed; color: white; }
        .content { margin-left: 260px; padding: 30px; }
        .sidebar-logo { padding: 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-logo img { width: 80px; }
        .nav-link { color: rgba(255,255,255,0.7); padding: 15px 25px; }
        .nav-link:hover, .nav-link.active { color: white; background: #0d6efd; }
    </style>
</head>
<body>

    <div id="sidebar">
        <div class="sidebar-logo">
            <img src="../assets/img/logo.png" alt="Logo">
            <h6 class="mb-0 fw-bold">ADMIN PANEL</h6>
        </div>
        <ul class="nav flex-column mt-3">
            <li class="nav-item"><a href="dashboard.php" class="nav-link"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
            <li class="nav-item"><a href="infoUser.php" class="nav-link active"><i class="bi bi-people me-2"></i> Info User</a></li>
            <li class="nav-item mt-5"><a href="logout.php" class="nav-link text-danger"><i class="bi bi-box-arrow-left me-2"></i> Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold">Manajemen Data Siswa</h4>
            <span class="badge bg-primary px-3 py-2">Total: <?= mysqli_num_rows($query); ?> Siswa</span>
        </div>

        <div class="card border-0 shadow-sm p-4 rounded-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Foto</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Password (Hash)</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($query)) : ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td>
                                <img src="../assets/img/<?= $row['foto'] ? $row['foto'] : 'default.png'; ?>" class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                            </td>
                            <td class="fw-bold"><?= $row['nama']; ?></td>
                            <td><span class="badge bg-info text-dark"><?= $row['username']; ?></span></td>
                            <td class="small text-muted text-break" style="max-width: 150px;"><?= $row['password']; ?></td>
                            <td class="text-center">
                                <a href="infoUser.php?hapus=<?= $row['id']; ?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus siswa <?= $row['nama']; ?>? Seluruh data riwayat absen siswa ini juga akan hilang.')">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
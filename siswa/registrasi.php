<?php
include '../config/config.php';
$pesan = "";

if (isset($_POST['register'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    $cek_user = mysqli_query($conn, "SELECT * FROM siswa WHERE username='$username'");
    if (mysqli_num_rows($cek_user) > 0) {
        $pesan = "<div class='alert alert-danger small py-2 text-center'>Username sudah terdaftar!</div>";
    } else {
        $query = "INSERT INTO siswa (nama, username, password) VALUES ('$nama', '$username', '$password_hashed')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Registrasi Berhasil!'); window.location='login.php';</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - SMA Nusa Indah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { 
            background: linear-gradient(135deg, #0d6efd 0%, #003366 100%); 
            min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px;
        }
        .card { 
            border-radius: 20px; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            width: 100%; max-width: 360px; background: white; padding: 35px 30px;
        }
        /* Mengatur posisi tulisan ke atas */
        .header-title { margin-top: -10px; margin-bottom: 25px; } 
        /* Jarak antara Registrasi dan Nama Sekolah */
        .header-title h4 { margin-bottom: 15px; color: #0d6efd; font-weight: 700; } 
        
        .form-control { border-radius: 8px; padding: 10px; font-size: 0.9rem; }
        .btn-primary { border-radius: 8px; padding: 12px; font-weight: bold; font-size: 0.95rem; }
        .input-group-text { background: white; border-left: none; cursor: pointer; border-radius: 0 8px 8px 0; }
        .input-password { border-right: none; }
        label { font-size: 0.85rem; font-weight: 600; margin-bottom: 5px; color: #444; }
    </style>
</head>
<body>

    <div class="card">
        <div class="text-center header-title">
            <h4>Registrasi Siswa</h4>
            <p class="text-muted small">SMA Nusa Indah</p>
        </div>

        <?php echo $pesan; ?>

        <form method="POST">
            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" placeholder="Nama lengkap" required>
            </div>
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-4">
                <label>Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control input-password" placeholder="Password" required>
                    <span class="input-group-text" id="togglePassword">
                        <i class="bi bi-eye-slash" id="eyeIcon"></i>
                    </span>
                </div>
            </div>
            <button type="submit" name="register" class="btn btn-primary w-100 shadow-sm">Daftar Akun</button>
        </form>

        <div class="text-center mt-4">
            <small class="text-muted">Sudah punya akun? <a href="login.php" class="text-decoration-none fw-bold text-primary">Login</a></small>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const eyeIcon = document.querySelector('#eyeIcon');
        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            eyeIcon.classList.toggle('bi-eye');
            eyeIcon.classList.toggle('bi-eye-slash');
        });
    </script>
</body>
</html>
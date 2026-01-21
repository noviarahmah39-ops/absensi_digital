<?php
session_start();
include '../config/config.php';
$error = "";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM siswa WHERE username = '$username'");
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['username'] = $row['username'];
            header("Location: dashboard.php");
            exit;
        }
    }
    $error = "<div class='alert alert-danger small'>Username/Password Salah!</div>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - SMA Nusa Indah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f0f7ff; min-height: 100vh; display: flex; align-items: center; }
        .login-card { border-radius: 20px; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.1); overflow: hidden; }
        .banner { background: #0d6efd; color: white; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 40px; }
        .logo-login { width: 100px; margin-bottom: 20px; filter: drop-shadow(0 5px 15px rgba(0,0,0,0.2)); }
        .input-group-text { cursor: pointer; background: white; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 row login-card g-0">
                <div class="col-md-5 banner text-center text-white">
                    <img src="../assets/img/logo.png" alt="Logo" class="logo-login">
                    <h3 class="fw-bold">SMA Nusa Indah</h3>
                    <p class="small">Absensi Digital Terintegrasi</p>
                </div>
                <div class="col-md-7 p-5 bg-white">
                    <h4 class="fw-bold text-primary mb-4">Login</h4>
                    <?php echo $error; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label small">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="passwordLogin" class="form-control" required>
                                <span class="input-group-text" id="toggleLoginPass">
                                    <i class="bi bi-eye-slash" id="eyeIconLogin"></i>
                                </span>
                            </div>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary w-100 py-2">Masuk</button>
                    </form>
                    <p class="text-center mt-4 small">Belum punya akun? <a href="registrasi.php" class="fw-bold text-decoration-none">Daftar</a></p>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('toggleLoginPass').addEventListener('click', function () {
            const pass = document.getElementById('passwordLogin');
            const icon = document.getElementById('eyeIconLogin');
            const type = pass.getAttribute('type') === 'password' ? 'text' : 'password';
            pass.setAttribute('type', type);
            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        });
    </script>
</body>
</html>
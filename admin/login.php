<?php
session_start();
include '../config/config.php';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    
    if (mysqli_num_rows($query) > 0) {
        $_SESSION['admin_login'] = true;
        $_SESSION['admin_user'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { 
            background-color: #001f3f; 
            min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px;
        }
        .card { 
            border-radius: 20px; border: none; box-shadow: 0 15px 40px rgba(0,0,0,0.5);
            width: 100%; max-width: 360px; background: white; padding: 35px 30px;
        }
        /* Mengatur posisi tulisan ke atas */
        .header-title { margin-top: -10px; margin-bottom: 25px; } 
        /* Jarak antara Administrator dan Nama Sekolah */
        .header-title h4 { margin-bottom: 15px; color: #001f3f; font-weight: 700; } 
        
        .form-control { border-radius: 8px; padding: 10px; font-size: 0.9rem; }
        .btn-dark { background-color: #001f3f; border: none; border-radius: 8px; padding: 12px; font-weight: bold; }
        label { font-size: 0.85rem; font-weight: 600; margin-bottom: 5px; color: #444; }
        .input-group-text { background: white; border-left: none; cursor: pointer; border-radius: 0 8px 8px 0; }
        .input-password { border-right: none; }
    </style>
</head>
<body>

    <div class="card">
        <div class="text-center header-title">
            <h4>Administrator</h4>
            <p class="text-muted small">Panel Kontrol SMA Nusa Indah</p>
        </div>

        <?php if(isset($error)): ?>
            <div class="alert alert-danger py-2 small text-center"><?= $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3 text-start">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username admin" required autofocus>
            </div>
            <div class="mb-4 text-start">
                <label>Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control input-password" placeholder="Password" required>
                    <span class="input-group-text" id="togglePassword">
                        <i class="bi bi-eye-slash" id="eyeIcon"></i>
                    </span>
                </div>
            </div>
            <button type="submit" name="login" class="btn btn-dark w-100 shadow-sm">
                Login Admin
            </button>
        </form>
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
<?php 
include 'db.php'; 

if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['login'])) {
    $nim = mysqli_real_escape_string($conn, $_POST['nim']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE nim = '$nim'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: index.php");
            exit();
        } else {
            $error = "Password yang Anda masukkan salah.";
        }
    } else {
        $error = "NIM tidak terdaftar di sistem.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem ID Card USU</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        :root {
            --usu-green: #1a5c2b;
            --usu-gold: #c5a059;
            --soft-gray: #f8f9fa;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e0e0e0 0%, #ffffff 100%);
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        .root {
            background-color: transparent;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bg-decoration {
            position: absolute;
            width: 500px;
            height: 500px;
            background: rgba(26, 92, 43, 0.05);
            border-radius: 50%;
            z-index: -1;
            top: -100px;
            right: -100px;
        }

        .card-login {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .login-header h3 {
            font-weight: 700;
            color: var(--usu-green);
            letter-spacing: -0.5px;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #555;
            margin-left: 4px;
        }

        .form-control {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 2px solid #eee;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--usu-green);
            box-shadow: none;
            background-color: #fff;
        }

        .btn-login {
            background: linear-gradient(to right, var(--usu-green), #2d8a41);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 0.8rem;
            font-weight: 600;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(26, 92, 43, 0.3);
            color: white;
        }

        .brand-logo {
            width: 70px;
            margin-bottom: 1.5rem;
        }

        .alert {
            border-radius: 12px;
            font-size: 0.9rem;
            border: none;
        }
    </style>
</head>
<body>
    <div class="bg-decoration"></div>
    <div class="root">
        <div class="container d-flex justify-content-center">
            <div class="card card-login" style="max-width: 400px; width: 100%;">
                <div class="card-body">
                    <div class="login-header text-center">
                        <h3>Selamat Datang</h3>
                    </div>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <div><?php echo $error; ?></div>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="nim" class="form-label">Nomor Induk Mahasiswa</label>
                            <input type="text" name="nim" class="form-control" id="nim" placeholder="Masukkan NIM" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="••••••••" required>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" name="login" class="btn btn-login mb-3">Masuk ke Sistem</button>
                        </div>
                        
                        <div class="text-center mt-2">
                            <span class="text-muted small">Belum memiliki akun?</span> 
                            <a href="register.php" class="text-success small fw-bold text-decoration-none ms-1">Daftar Sekarang</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
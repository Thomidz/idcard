<?php 
include 'db.php'; 

// Jika user sudah login, langsung arahkan ke index.php
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['login'])) {
    $nim = mysqli_real_escape_string($conn, $_POST['nim']);
    $password = $_POST['password'];

    // Mencari user berdasarkan NIM di database idcard
    $query = "SELECT * FROM users WHERE nim = '$nim'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        
        // Verifikasi password yang sudah di-hash
        if (password_verify($password, $user['password'])) {
            // Set session untuk menyimpan data user
            $_SESSION['user'] = $user;
            
            // Redirect ke index.php
            header("Location: index.php");
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "NIM tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ID CARD USU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .card-login {
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            border: none;
            background: white;
        }
        .btn-login {
            background-color: green; /* Sesuai variabel di style.css */
            color: white;
            border: none;
            padding: 10px;
            font-weight: bold;
        }
        .btn-login:hover {
            background-color: black; /* Sesuai hover di style.css */
        }
    </style>
</head>
<body>
    <div class="root">
        <div class="header">
            <h3>Tugas-2 Praktikum Pemrograman Web</h3>
        </div>

        <div class="form-container">
            <div class="card card-login" style="width: 28rem;">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4">ID CARD USU LOGIN</h3>
                    
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM (Username)</label>
                            <input type="text" name="nim" class="form-control" id="nim" placeholder="Masukkan NIM Anda" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password" required>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" name="login" class="btn btn-login">MASUK</button>
                        </div>
                        
                        <div class="text-center mt-4">
                            <p class="mb-0">Belum punya akun? 
                                <a href="register.php" style="color: green; text-decoration: none; font-weight: bold;">Daftar Sekarang</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
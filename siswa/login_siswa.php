<?php
session_start();
include "../KONEKSI.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['login'])) {
    $id_nis = $_POST['id_nis'];

    $cek = mysqli_query($conn, "SELECT * FROM siswa WHERE id_nis='$id_nis'");
    $jumlah = mysqli_num_rows($cek);

    if ($jumlah > 0) {
        $_SESSION['id_nis'] = $id_nis;
        header("Location: ../siswa/dashboard_siswa.php");
        exit;
    } else {
        $error = "NIS tidak terdaftar!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Siswa | SIPAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --main: #2563eb;
            --dark: #1e3a8a;
            --soft: #f8fafc;
            --gradient: linear-gradient(135deg, #1e3a8a, #2563eb, #3b82f6);
        }

        body {
            background: var(--gradient);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-card {
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(14px);
            border-radius: 24px;
            box-shadow: 0 25px 55px rgba(0,0,0,.35);
            overflow: hidden;
        }

        .login-header {
            background: var(--gradient);
            color: #fff;
            text-align: center;
            padding: 30px 20px;
        }

        .login-header i {
            font-size: 3rem;
            margin-bottom: 10px;
        }

        .login-header h4 {
            font-weight: 900;
            margin-bottom: 0;
            letter-spacing: .5px;
        }

        .form-control {
            border-radius: 14px;
            padding: 12px;
        }

        .form-control:focus {
            border-color: var(--main);
            box-shadow: 0 0 0 3px rgba(37,99,235,.25);
        }

        .btn-login {
            background: var(--gradient);
            border: none;
            border-radius: 14px;
            padding: 12px;
            font-weight: 700;
            box-shadow: 0 10px 25px rgba(37,99,235,.5);
        }

        .btn-login:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 16px 35px rgba(37,99,235,.65);
        }

        .login-footer {
            text-align: center;
            padding: 15px;
            font-size: .85rem;
            color: #64748b;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="login-card">

                <div class="login-header">
                    <i class="bi bi-person-circle"></i>
                    <h4>Login Siswa</h4>
                </div>

                <div class="card-body p-4">

                    <?php if (isset($error)) : ?>
                        <div class="alert alert-danger text-center">
                            <i class="bi bi-exclamation-triangle"></i>
                            <?= $error; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">NIS</label>
                            <input type="number" name="id_nis" class="form-control" placeholder="Masukkan NIS" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" name="login" class="btn btn-login text-white">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </button>
                            <a href="../index.php" class="btn btn-logout">
                                <i class="bi bi-box-arrow-right"></i> Keluar
                            </a>

                        </div>
                    </form>

                </div>

                <div class="login-footer">
                    Aplikasi Pengaduan Sarana Sekolah
                </div>

            </div>

        </div>
    </div>
</div>

</body>
</html>

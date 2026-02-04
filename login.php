<?php
session_start();
include 'KONEKSI.php';

if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM admin 
            WHERE username = '$username' 
            AND password = '$password'
            AND status = 'aktif'";

    $query = mysqli_query($conn, $sql);
    $data  = mysqli_fetch_assoc($query);

    if ($data) {
        session_regenerate_id(true);

        $_SESSION['id_admin']   = $data['id_admin'];
        $_SESSION['nama_admin'] = $data['nama_admin'];
        $_SESSION['level']      = $data['level'];

        header("Location: index.php");
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
    <title>Login Admin SIPAS</title>

    <style>
        :root {
            --main-color: #2563eb;
            --second-color: #3b82f6;
            --soft-white: rgba(255,255,255,0.18);
        }

        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            margin: 0;
            height: 100vh;
            background: linear-gradient(135deg, var(--main-color), var(--second-color));
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background: linear-gradient(
                180deg,
                rgba(255,255,255,0.22),
                rgba(255,255,255,0.12)
            );
            backdrop-filter: blur(20px);
            padding: 42px 38px;
            width: 360px;
            border-radius: 26px;
            box-shadow:
                0 30px 70px rgba(0,0,0,0.35),
                inset 0 1px 0 rgba(255,255,255,0.25);
            color: #fff;
            animation: fadeIn 0.8s ease;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 800;
            letter-spacing: 1.5px;
            font-size: 22px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            font-size: 14px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 14px 16px;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.35);
            outline: none;
            margin-bottom: 20px;
            font-size: 14px;
            background: rgba(255,255,255,0.96);
            transition: all 0.25s ease;
        }

        input::placeholder {
            color: #777;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(255,255,255,0.25);
        }

        .error {
            background: rgba(255, 0, 0, 0.25);
            padding: 12px;
            border-radius: 14px;
            margin-bottom: 18px;
            text-align: center;
            font-size: 14px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #ffffff, #f1f5ff);
            color: #2563eb;
            border: none;
            border-radius: 18px;
            font-size: 16px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        input[type="submit"]:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 35px rgba(0,0,0,0.25);
        }

        input[type="submit"]:active {
            transform: translateY(-1px);
        }

        .register-link {
            text-align: center;
            margin-top: 14px;
        }

        .register-link a {
            font-size: 13px;
            color: #eef2ff;
            text-decoration: none;
            opacity: 0.9;
            transition: 0.3s;
        }

        .register-link a:hover {
            opacity: 1;
            text-decoration: underline;
        }

        .footer {
            text-align: center;
            margin-top: 26px;
            font-size: 12px;
            opacity: 0.8;
            letter-spacing: 0.5px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<form class="login-box" method="POST">
    <h2>LOGIN ADMIN</h2>

    <?php if (isset($error)) { ?>
        <div class="error"><?= $error ?></div>
    <?php } ?>

    <label>Username</label>
    <input type="text" name="username" placeholder="Masukkan username" required>

    <label>Password</label>
    <input type="password" name="password" placeholder="Masukkan password" required>

    <input type="submit" name="login" value="Login">

    <div class="register-link">
        <a href="register.php">Register</a>
    </div>

    <div class="footer">
        SIPAS © 2026
    </div>
</form>

</body>
</html>

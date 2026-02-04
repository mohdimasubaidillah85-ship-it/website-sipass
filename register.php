<?php
session_start();
include 'KONEKSI.php';

if (isset($_POST['register'])) {

    $nama     = mysqli_real_escape_string($conn, $_POST['nama_admin']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);

    // cek username
    $cek = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Username sudah digunakan!";
    } else {

        $sql = "INSERT INTO admin 
                (nama_admin, username, password, email, level, foto, status, created_at)
                VALUES
                ('$nama', '$username', '$password', '$email', 'admin', 'default.png', 'aktif', NOW())";

        if (mysqli_query($conn, $sql)) {
            $success = "Registrasi berhasil! Silakan login.";
        } else {
            $error = "Registrasi gagal!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Register Admin SIPAS</title>

<style>
:root {
    --blue1:#2563eb;
    --blue2:#3b82f6;
    --glass:rgba(255,255,255,0.18);
}

*{
    box-sizing:border-box;
    font-family:'Segoe UI',Tahoma,Verdana,sans-serif;
}

body{
    margin:0;
    height:100vh;
    background:linear-gradient(135deg,var(--blue1),var(--blue2));
    display:flex;
    justify-content:center;
    align-items:center;
}

.register-box{
    width:420px;
    background:var(--glass);
    backdrop-filter:blur(18px);
    padding:40px;
    border-radius:26px;
    box-shadow:0 30px 60px rgba(0,0,0,0.35);
    color:#fff;
    animation:fadeIn .8s ease;
}

h2{
    text-align:center;
    margin-bottom:25px;
    letter-spacing:1px;
}

label{
    font-size:14px;
    margin-bottom:6px;
    display:block;
}

input{
    width:100%;
    padding:13px 15px;
    border-radius:14px;
    border:none;
    outline:none;
    margin-bottom:16px;
    font-size:14px;
}

button{
    width:100%;
    padding:14px;
    border:none;
    border-radius:18px;
    font-size:16px;
    font-weight:bold;
    background:#fff;
    color:#2563eb;
    cursor:pointer;
    transition:.3s;
}

button:hover{
    transform:translateY(-3px);
    box-shadow:0 15px 30px rgba(0,0,0,.25);
}

.success{
    background:rgba(0,255,0,.25);
    padding:12px;
    border-radius:14px;
    margin-bottom:18px;
    text-align:center;
}

.error{
    background:rgba(255,0,0,.25);
    padding:12px;
    border-radius:14px;
    margin-bottom:18px;
    text-align:center;
}

.footer{
    margin-top:22px;
    text-align:center;
    font-size:13px;
    opacity:.9;
}

a{
    color:#fff;
    font-weight:bold;
    text-decoration:none;
}

@keyframes fadeIn{
    from{opacity:0;transform:translateY(20px)}
    to{opacity:1;transform:translateY(0)}
}
</style>
</head>
<body>

<form method="POST" class="register-box">
    <h2>REGISTER ADMIN</h2>

    <?php if(isset($error)){ ?>
        <div class="error"><?= $error ?></div>
    <?php } ?>

    <?php if(isset($success)){ ?>
        <div class="success"><?= $success ?></div>
    <?php } ?>

    <label>Nama Admin</label>
    <input type="text" name="nama_admin" required>

    <label>Username</label>
    <input type="text" name="username" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <button type="submit" name="register">Daftar</button>

    <div class="footer">
        Sudah punya akun? <a href="login.php">Login</a><br>
        SIPAS © 2026
    </div>
</form>

</body>
</html>

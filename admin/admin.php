<?php
if (isset($_POST['simpan'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); // sesuai sistem kamu

    // 🔎 CEK USERNAME
    $cek = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'");

    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
            alert('Username sudah digunakan, silakan ganti!');
            window.history.back();
        </script>";
    } else {

        $simpan = mysqli_query($conn, "
            INSERT INTO admin (username, password)
            VALUES ('$username', '$password')
        ");

        if ($simpan) {
            echo "<script>
                alert('Admin berhasil ditambahkan');
                window.location='?open=Admin';
            </script>";
        } else {
            echo "<script>alert('Gagal menambahkan admin');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Admin | SIPAS</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ICON -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root{
            --gradient-main: linear-gradient(135deg,#1e3a8a,#2563eb,#3b82f6);
            --gradient-warn: linear-gradient(135deg,#f59e0b,#fbbf24);
            --gradient-danger: linear-gradient(135deg,#ef4444,#dc2626);
        }

        body{
            background:#f1f5f9;
            font-family:'Segoe UI', Tahoma, sans-serif;
        }

        .card-gradient{
            border:none;
            border-radius:22px;
            background:rgba(255,255,255,.93);
            backdrop-filter:blur(10px);
            box-shadow:0 22px 45px rgba(0,0,0,.25);
        }

        .header-gradient{
            background:var(--gradient-main);
            color:#fff;
            border-radius:22px 22px 0 0;
        }

        .btn-gradient-primary{
            background:var(--gradient-main);
            color:#fff;
            border:none;
        }

        .btn-gradient-warning{
            background:var(--gradient-warn);
            color:#000;
            border:none;
        }

        .btn-gradient-danger{
            background:var(--gradient-danger);
            color:#fff;
            border:none;
        }

        .btn-gradient-primary:hover,
        .btn-gradient-warning:hover,
        .btn-gradient-danger:hover{
            transform:translateY(-2px);
            opacity:.95;
        }

        table thead{
            background:var(--gradient-main);
            color:#fff;
        }

        table tbody tr:hover{
            background:#eef2ff;
        }
    </style>
</head>

<body>

<div class="container mt-5">

    <div class="card card-gradient">

        <div class="card-header header-gradient d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-people-fill"></i> Data Admin
            </h5>

            <a href="?open=Admin_Tambah" class="btn btn-light btn-sm fw-semibold">
                <i class="bi bi-plus-circle"></i> Tambah Admin
            </a>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th width="18%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($conn, "SELECT * FROM admin ORDER BY id_admin DESC");

                        if (mysqli_num_rows($query) > 0) :
                            while ($data = mysqli_fetch_assoc($query)) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($data['email'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($data['username']); ?></td>
                            <td>
                                <span class="badge bg-secondary">
                                    <?= htmlspecialchars($data['password']); ?>
                                </span>
                            </td>
                            <td>
                                <a href="?open=Admin_Edit&id=<?= $data['id_admin']; ?>"
                                   class="btn btn-gradient-warning btn-sm me-1"
                                   title="Edit Admin">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <a href="?open=Admin_Hapus&id=<?= $data['id_admin']; ?>"
                                   class="btn btn-gradient-danger btn-sm"
                                   title="Hapus Admin"
                                   onclick="return confirm('Yakin ingin menghapus admin ini?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; else : ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Data admin belum tersedia
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

</body>
</html>

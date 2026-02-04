<?php
// admin_tambah.php
include "KONEKSI.php";

if (isset($_POST['simpan'])) {

    $nama_admin = mysqli_real_escape_string($conn, $_POST['nama_admin']);
    $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $username   = mysqli_real_escape_string($conn, $_POST['username']);
    $password   = md5($_POST['password']); // sesuai sistem kamu

    // INSERT DATA
    $simpan = mysqli_query($conn, "
        INSERT INTO admin (nama_admin, email, username, password)
        VALUES ('$nama_admin', '$email', '$username', '$password')
    ");

    if ($simpan) {
        echo "<script>
                alert('Admin berhasil ditambahkan');
                window.location='?open=Admin';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan admin');
              </script>";
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">

        <div class="col-md-6">
            <div class="card shadow-lg rounded-4 border-0">

                <div class="card-header text-white text-center rounded-top-4"
                     style="background: linear-gradient(135deg, #2563eb, #3b82f6);">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-person-plus-fill"></i> Tambah Admin
                    </h5>
                </div>

                <div class="card-body p-4">

                    <form method="POST">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Admin</label>
                            <input type="text" name="nama_admin"
                                   class="form-control"
                                   placeholder="Masukkan nama admin"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email"
                                   class="form-control"
                                   placeholder="admin@email.com"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Username</label>
                            <input type="text" name="username"
                                   class="form-control"
                                   placeholder="Username login"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password"
                                   class="form-control"
                                   placeholder="Password"
                                   required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="?open=Admin" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>

                            <button type="submit" name="simpan"
                                    class="btn text-white"
                                    style="background: linear-gradient(135deg, #2563eb, #3b82f6);">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
</div>

<?php
// admin_edit.php
include "koneksi.php";

$id = $_GET['id'];

// Ambil data admin berdasarkan ID
$query = mysqli_query($conn, "SELECT * FROM admin WHERE id_admin='$id'");
$data  = mysqli_fetch_assoc($query);

// Jika tombol update ditekan
if (isset($_POST['update'])) {
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Jika password diisi → update dengan MD5
    if (!empty($password)) {
        $password_md5 = md5($password);
        $update = mysqli_query($conn, "UPDATE admin SET
                        email='$email',
                        username='$username',
                        password='$password_md5'
                        WHERE id_admin='$id'");
    } else {
        // Jika password kosong → tidak diubah
        $update = mysqli_query($conn, "UPDATE admin SET
                        email='$email',
                        username='$username'
                        WHERE id_admin='$id'");
    }

    if ($update) {
        echo "<script>
                alert('Data admin berhasil diupdate');
                window.location='?open=Admin';
              </script>";
    } else {
        echo "<script>
                alert('Gagal mengupdate data');
              </script>";
    }
}
?>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0 text-center">Edit Admin</h5>
        </div>

        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                           value="<?= htmlspecialchars($data['email']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control"
                           value="<?= htmlspecialchars($data['username']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengubah password
                    </small>
                </div>

                <div class="text-center">
                    <button type="submit" name="update" class="btn btn-warning">
                        Update
                    </button>
                    <a href="?open=Admin" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

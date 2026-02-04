<?php
// siswa_edit.php
include "KONEKSI.php";

// Ambil ID dari URL
$id = $_GET['id'];

// Ambil data siswa lama
$query = mysqli_query($conn, "SELECT * FROM siswa WHERE id_nis='$id'");
$data  = mysqli_fetch_assoc($query);

// Jika tombol update ditekan
if (isset($_POST['update'])) {
    $id_nis = mysqli_real_escape_string($conn, $_POST['id_nis']);
    $kelas  = mysqli_real_escape_string($conn, $_POST['kelas']);

    // Update data siswa
    $update = mysqli_query($conn, "UPDATE siswa SET
                    id_nis='$id_nis',
                    kelas='$kelas'
                    WHERE id_nis='$id'");

    if ($update) {
        echo "<script>
                alert('Data siswa berhasil diupdate');
                window.location='?open=Siswa';
              </script>";
    } else {
        echo "<script>
                alert('Gagal mengupdate data siswa');
              </script>";
    }
}
?>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0 text-center">Edit Siswa</h5>
        </div>

        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">ID / NIS</label>
                    <input type="text" name="id_nis"
                           class="form-control"
                           value="<?= htmlspecialchars($data['id_nis']); ?>"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kelas</label>
                    <input type="text" name="kelas"
                           class="form-control"
                           value="<?= htmlspecialchars($data['kelas']); ?>"
                           required>
                </div>

                <div class="text-center">
                    <button type="submit" name="update" class="btn btn-warning">
                        Update
                    </button>
                    <a href="?open=Siswa" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

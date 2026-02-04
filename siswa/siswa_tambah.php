<?php
// admin_tambah.php
include "KONEKSI.php"; // sesuaikan dengan file koneksi kamu

if (isset($_POST['simpan'])) {
    $id_nis = mysqli_real_escape_string($conn, $_POST['id_nis']);
    $kelas  = mysqli_real_escape_string($conn, $_POST['kelas']);


    $simpan = mysqli_query($conn, "INSERT INTO siswa (id_nis, kelas )
                                   VALUES ('$id_nis', '$kelas' )");

    if ($simpan) {
        echo "<script>
                alert('siswa berhasil ditambahkan');
                window.location='?open=Siswa';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan siswa');
              </script>";
    }
}
?>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0 text-center">Tambah Siswa</h5>
        </div>

        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">NIS</label>
                    <input type="text" name="id_nis" class="form-control"
                        pattern="[0-9]+" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">KELAS</label>
                    <input type="text" name="kelas" class="form-control" required>
                </div>
                    <button type="submit" name="simpan" class="btn btn-primary">
                        Simpan
                    </button>
                    <a href="?open=Admin" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

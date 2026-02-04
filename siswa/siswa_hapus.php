<?php
// siswa_hapus.php
include "KONEKSI.php";

// Ambil ID dari URL
$id = $_GET['id'];

// Hapus data siswa berdasarkan id_nis
$hapus = mysqli_query($conn, "DELETE FROM siswa WHERE id_nis='$id'");

if ($hapus) {
    echo "<script>
            alert('Data siswa berhasil dihapus');
            window.location='?open=Siswa';
          </script>";
} else {
    echo "<script>
            alert('Gagal menghapus data siswa');
            window.location='?open=Siswa';
          </script>";
}
?>

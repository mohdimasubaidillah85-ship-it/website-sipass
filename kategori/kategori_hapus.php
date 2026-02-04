<?php
// Cek ID
if (!isset($_GET['id'])) {
    echo "<script>
            alert('ID tidak ditemukan');
            window.location='?open=Kategori';
          </script>";
    exit;
}

$id = $_GET['id'];

// (Opsional tapi disarankan) cek apakah data ada
$cek = mysqli_query($conn, "SELECT * FROM kategori WHERE id_kategori = '$id'");
$data = mysqli_fetch_assoc($cek);

if (!$data) {
    echo "<script>
            alert('Data kategori tidak ditemukan');
            window.location='?open=Kategori';
          </script>";
    exit;
}

// Proses hapus
mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori = '$id'");

echo "<script>
        alert('Kategori berhasil dihapus');
        window.location='?open=Kategori';
      </script>";
?>

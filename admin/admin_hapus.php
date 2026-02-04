<?php
// admin_hapus.php
include "koneksi.php";

$id = $_GET['id'];

// Query hapus data admin
$hapus = mysqli_query($conn, "DELETE FROM admin WHERE id_admin='$id'");

if ($hapus) {
    echo "<script>
            alert('Data admin berhasil dihapus');
            window.location='?open=Admin';
          </script>";
} else {
    echo "<script>
            alert('Data admin gagal dihapus');
            window.location='?open=Admin';
          </script>";
}
?>

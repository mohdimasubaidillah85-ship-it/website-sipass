<?php
// Ambil ID dari URL
if (!isset($_GET['id'])) {
    echo "<script>
            alert('ID tidak ditemukan');
            window.location='?open=Kategori';
          </script>";
    exit;
}

$id = $_GET['id'];

// Ambil data kategori berdasarkan ID
$query = mysqli_query($conn, "SELECT * FROM kategori WHERE id_kategori = '$id'");
$data  = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>
            alert('Data kategori tidak ditemukan');
            window.location='?open=Kategori';
          </script>";
    exit;
}

// Proses update
if (isset($_POST['update'])) {
    $ket_kategori = mysqli_real_escape_string($conn, $_POST['ket_kategori']);

    if ($ket_kategori != '') {
        mysqli_query(
            $conn,
            "UPDATE kategori 
             SET ket_kategori = '$ket_kategori' 
             WHERE id_kategori = '$id'"
        );

        echo "<script>
                alert('Kategori berhasil diperbarui');
                window.location='?open=Kategori';
              </script>";
    } else {
        echo "<script>alert('Nama kategori tidak boleh kosong');</script>";
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-warning text-dark text-center rounded-top-4">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-pencil-square"></i> Edit Kategori
                    </h5>
                </div>

                <div class="card-body p-4">

                    <form method="POST">
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Nama Kategori
                            </label>
                            <input type="text"
                                   name="ket_kategori"
                                   class="form-control form-control-lg rounded-3"
                                   value="<?= htmlspecialchars($data['ket_kategori']); ?>"
                                   required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="?open=Kategori" class="btn btn-outline-secondary rounded-3 px-4">
                                <i class="bi bi-arrow-left"></i> Batal
                            </a>

                            <button type="submit" name="update" class="btn btn-warning rounded-3 px-4 fw-semibold">
                                <i class="bi bi-save"></i> Update
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

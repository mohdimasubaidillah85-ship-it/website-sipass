<?php
// pastikan koneksi sudah ada
if (isset($_POST['simpan'])) {
    $ket_kategori = mysqli_real_escape_string($conn, $_POST['ket_kategori']);

    if ($ket_kategori != '') {
        mysqli_query(
            $conn,
            "INSERT INTO kategori (ket_kategori) VALUES ('$ket_kategori')"
        );

        echo "<script>
                alert('Kategori berhasil ditambahkan');
                window.location='?open=Kategori';
              </script>";
    } else {
        echo "<script>alert('Nama kategori tidak boleh kosong');</script>";
    }
}
?>

<div class="container mt-5 flex-grow-1">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header text-white text-center fw-bold"
                     style="background: var(--gradient); border-radius: 16px 16px 0 0;">
                    <h5 class="mb-0">➕ Tambah Kategori</h5>
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
                                   placeholder="Contoh: Sarana Prasarana"
                                   required>
                        </div>
                            <button type="submit"
                                    name="simpan"
                                    class="btn btn-success rounded-pill px-4 fw-bold">
                                💾 Simpan
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

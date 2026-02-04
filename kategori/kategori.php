<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Kategori</h5>

            <!-- Tombol Tambah -->
            <a href="?open=Kategori_Tambah" class="btn btn-light btn-sm">
                <i class="bi bi-plus-circle"></i> Tambah Kategori
            </a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Kategori</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($conn, "SELECT * FROM kategori ORDER BY id_kategori DESC");

                    if (mysqli_num_rows($query) > 0) {
                        while ($data = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= htmlspecialchars($data['ket_kategori']); ?></td>
                            <td class="text-center">
                                <!-- Tombol Edit -->
                                <a href="?open=Kategori_Edit&id=<?= $data['id_kategori']; ?>"
                                   class="btn btn-warning btn-sm action-btn"
                                   title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <!-- Tombol Hapus -->
                                <a href="?open=Kategori_Hapus&id=<?= $data['id_kategori']; ?>"
                                   class="btn btn-danger btn-sm action-btn"
                                   title="Hapus"
                                   onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                        }
                    } else {
                    ?>
                        <tr>
                            <td colspan="3" class="text-center">Data kategori belum ada</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

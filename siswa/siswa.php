<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Siswa</h5>

            <!-- Tombol Tambah -->
            <a href="?open=Siswa_Tambah" class="btn btn-light btn-sm">
                + Siswa 
            </a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th width="5%"><center>NO</th>
						<th><center>ID_Nis</th>
						<th><center>Kelas</th>
                        <th width="20%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($conn, "SELECT * FROM siswa ORDER BY id_nis DESC");
                    if (mysqli_num_rows($query) > 0) {
                        while ($data = mysqli_fetch_assoc($query)) {
                    ?>
                            <tr>
                                <td><center><?= $no++; ?></td>
                                <td><center><?= htmlspecialchars($data['id_nis']); ?></td>
								<td><center><?= htmlspecialchars($data['kelas']); ?></td>
                                <td class="text-center">
                                    <!-- Tombol Edit -->
                                    <a href="?open=Siswa_Edit&id=<?= $data['id_nis']; ?>"
                                      
										title="Edit">
										✏️
                                    </a>
         
                                    <!-- Tombol Hapus -->
                                    <a href="?open=Siswa_Hapus&id=<?= $data['id_nis']; ?>"
									 
									title="Hapus"
									onclick="return confirm('Yakin ingin menghapus admin ini?')">
									🗑️
                                       <onclick="return confirm('Yakin ingin menghapus kategori ini?' )">
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

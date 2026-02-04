<?php
include "KONEKSI.php";

if (!isset($_SESSION['id_admin'])) {
    header("Location: ../login.php");
    exit;
}

$data = mysqli_query($conn, "
    SELECT aspirasi.*, kategori.ket_kategori 
    FROM aspirasi 
    JOIN kategori ON aspirasi.id_kategori = kategori.id_kategori
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Aspirasi | Admin SIPAS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f1f5f9;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        .page-title {
            font-weight: 800;
            color: #1e293b;
        }

        /* CARD */
        .card-custom {
            border: none;
            border-radius: 22px;
            box-shadow: 0 18px 45px rgba(0,0,0,.15);
            overflow: hidden;
        }

        /* TABLE */
        .table thead {
            background: linear-gradient(135deg, #0f766e, #14b8a6);
            color: white;
        }

        .table thead th {
            border: none;
            text-align: center;
            font-weight: 700;
        }

        .table tbody tr {
            transition: .3s;
        }

        .table tbody tr:hover {
            background: #f0fdfa;
            transform: scale(1.01);
        }

        /* BADGE STATUS */
        .badge {
            padding: 8px 14px;
            font-size: .85rem;
            border-radius: 14px;
        }

        /* BUTTON */
        .btn-sm {
            border-radius: 10px;
            padding: 6px 10px;
            font-weight: 600;
        }

        .btn-info {
            background: #38bdf8;
            border: none;
        }

        .btn-warning {
            background: #fbbf24;
            border: none;
            color: #1f2937;
        }

        .btn-success {
            background: #22c55e;
            border: none;
        }

        .btn-sm i {
            margin-right: 4px;
        }
    </style>
</head>

<body>

<div class="container mt-5">

    <h4 class="page-title mb-4">
        <i class="bi bi-clipboard-data"></i> Kelola Aspirasi Siswa
    </h4>
    <a href="admin/cetak_aspirasi.php" target="_blank" class="btn btn-dark btn-sm">
        <i class="bi bi-printer"></i> Cetak Data
    </a>

    <div class="card card-custom">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Kategori</th>
                            <th width="160">Status</th>
                            <th width="260">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php $no=1; while ($row = mysqli_fetch_assoc($data)) : ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>

                            <td class="text-center">
                                <?= htmlspecialchars($row['ket_kategori']); ?>
                            </td>

                            <!-- STATUS (KEMBALI KE AWAL, TANPA ICON) -->
                            <td class="text-center">
                                <span class="badge 
                                    <?= $row['status']=='Menunggu' ? 'bg-warning text-dark' : 
                                        ($row['status']=='Proses' ? 'bg-info text-dark' : 'bg-success') ?>">
                                    <?= htmlspecialchars($row['status']); ?>
                                </span>
                            </td>

                            <!-- AKSI (TETAP PAKAI ICON) -->
                            <td class="text-center">
                                <a href="admin/ubah_status.php?id=<?= $row['id_aspirasi'] ?>&status=Proses"
                                class="btn btn-info btn-sm">
                                    <i class="bi bi-arrow-repeat"></i> Proses
                                </a>

                                <a href="admin/ubah_status.php?id=<?= $row['id_aspirasi'] ?>&status=Selesai"
                                class="btn btn-success btn-sm">
                                    <i class="bi bi-check-circle"></i> Selesai
                                </a>

                                <a href="admin/feedback_aspirasi.php?id=<?= $row['id_aspirasi'] ?>"
                                class="btn btn-warning btn-sm">
                                    <i class="bi bi-chat-dots"></i> Feedback
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>

                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

</body>
</html>

<?php
session_start();
include "../KONEKSI.php";

// Proteksi login siswa
if (!isset($_SESSION['id_nis'])) {
    header("Location: login_siswa.php");
    exit;
}

$id_nis = $_SESSION['id_nis'];

$data = mysqli_query($conn, "
    SELECT 
        input_aspirasi.lokasi,
        input_aspirasi.ket,
        input_aspirasi.gambar,
        kategori.ket_kategori,
        COALESCE(aspirasi.status, 'Menunggu') AS status,
        aspirasi.feedback
    FROM input_aspirasi
    JOIN kategori 
        ON input_aspirasi.id_kategori = kategori.id_kategori
    LEFT JOIN aspirasi 
        ON aspirasi.id_kategori = input_aspirasi.id_kategori
    WHERE input_aspirasi.id_nis = '$id_nis'
    ORDER BY aspirasi.tgl_aspirasi DESC
");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Siswa | SIPAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --main: #2563eb;
            --dark: #1e3a8a;
            --soft: #f8fafc;
            --gradient: linear-gradient(135deg,#1e3a8a,#2563eb,#3b82f6);
        }

        body {
            background: var(--soft);
            font-family: 'Segoe UI', sans-serif;
        }

        /* NAVBAR */
        .navbar-custom {
            background: var(--gradient);
            box-shadow: 0 8px 22px rgba(37,99,235,.45);
        }

        /* CARD */
        .card-custom {
            border-radius: 20px;
            border: none;
            box-shadow: 0 18px 40px rgba(0,0,0,.25);
        }

        /* TABLE */
        .table thead {
            background: var(--gradient);
            color: #fff;
        }

        .table tbody tr:hover {
            background: rgba(37,99,235,.05);
        }

        /* BUTTON */
        .btn-main {
            background: var(--gradient);
            border: none;
            font-weight: 700;
            border-radius: 14px;
            box-shadow: 0 10px 25px rgba(37,99,235,.45);
        }

        .btn-main:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(37,99,235,.65);
        }

        /* BADGE */
        .badge {
            padding: 8px 12px;
            font-size: .85rem;
        }

        /* FOOTER */
        footer {
            background: var(--gradient);
            color: #fff;
            box-shadow: 0 -6px 18px rgba(37,99,235,.35);
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            <i class="bi bi-speedometer2"></i> SIPAS Siswa
        </a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto align-items-center gap-3">
                <li class="nav-item text-white fw-semibold">
                    <i class="bi bi-person-circle"></i> NIS: <?= $_SESSION['id_nis']; ?>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="btn btn-outline-light btn-sm"
                       onclick="return confirm('Yakin ingin logout?')">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- CONTENT -->
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">
            <i class="bi bi-clock-history"></i> Riwayat Pengaduan Saya
        </h4>

        <a href="form_input_aspirasi.php" class="btn btn-main text-white">
            <i class="bi bi-plus-circle"></i> Tambah Aspirasi
        </a>
    </div>

    <?php if (mysqli_num_rows($data) == 0) : ?>
        <div class="alert alert-info text-center">
            <i class="bi bi-info-circle"></i> Belum ada pengaduan yang dikirim.
        </div>
    <?php else : ?>

        <div class="card card-custom">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th>Feedback Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; while ($row = mysqli_fetch_assoc($data)) : ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td ><?= $row['ket_kategori']; ?></td>
                            <td><?= $row['lokasi']; ?></td>
                            <td><?= $row['ket']; ?></td>
                            <td class="text-center">
                                <?php if (!empty($row['gambar'])) : ?>
                                    <img src="../upload/<?= $row['gambar']; ?>" 
                                        width="80" 
                                        class="rounded shadow">
                                <?php else : ?>
                                    <em class="text-muted">Tidak ada</em>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <span class="badge 
                                    <?= $row['status']=='Menunggu' ? 'bg-warning text-dark' : 
                                        ($row['status']=='Proses' ? 'bg-info' : 'bg-success') ?>">
                                    <?= $row['status']; ?>
                                </span>
                            </td>
                            <td>
                                <?= $row['feedback'] 
                                    ? $row['feedback'] 
                                    : '<em class="text-muted">Belum ada feedback</em>'; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php endif; ?>

</div>

<!-- FOOTER -->
<div class="container mt-4 flex-grow-1">
<footer class="text-white text-center py-3">
    <small>© 2026 SIPAS | Dashboard Siswa</small>
</footer>


</body>
</html>

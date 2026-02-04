<?php
session_start();
include "../KONEKSI.php";

/* ================= PROTEKSI LOGIN ADMIN ================= */
if (!isset($_SESSION['id_admin'])) {
    header("Location: login_admin.php"); // ⬅️ PERBAIKAN UTAMA
    exit;
}

/* ================= CEK PARAMETER ID ================= */
if (!isset($_GET['id']) || $_GET['id'] == '') {
    header("Location: data_pengaduan.php");
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

/* ================= AMBIL DATA ASPIRASI ================= */
$data = mysqli_query($conn, "
    SELECT aspirasi.*, kategori.ket_kategori
    FROM aspirasi
    JOIN kategori ON aspirasi.id_kategori = kategori.id_kategori
    WHERE aspirasi.id_aspirasi = '$id'
");

$row = mysqli_fetch_assoc($data);

/* ================= JIKA DATA TIDAK ADA ================= */
if (!$row) {
    header("Location: data_pengaduan.php");
    exit;
}

/* ================= SIMPAN FEEDBACK ================= */
if (isset($_POST['kirim'])) {
    $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);
    $status   = mysqli_real_escape_string($conn, $_POST['status']);

    mysqli_query($conn, "
        UPDATE aspirasi
        SET feedback = '$feedback',
            status   = '$status'
        WHERE id_aspirasi = '$id'
    ");

    header("Location: data_pengaduan.php"); // ⬅️ BALIK KE KELOLA ASPIRASI
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Feedback Aspirasi | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #059669;
            --dark: #065f46;
            --soft: #ecfdf5;
            --gradient: linear-gradient(135deg, #065f46, #059669, #10b981);
        }

        body {
            background: var(--soft);
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        .card-custom {
            border: none;
            border-radius: 22px;
            box-shadow: 0 22px 45px rgba(0,0,0,.2);
            overflow: hidden;
        }

        .card-header-custom {
            background: var(--gradient);
            color: #fff;
            text-align: center;
            font-weight: 800;
            padding: 18px;
        }

        .info-box {
            background: #f0fdfa;
            border-radius: 14px;
            padding: 14px 18px;
            margin-bottom: 16px;
            font-weight: 600;
        }

        .form-control,
        .form-select {
            border-radius: 14px;
            padding: 12px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(5,150,105,.25);
        }

        .btn-save {
            background: var(--gradient);
            color: #fff;
            border: none;
            border-radius: 14px;
            padding: 10px 22px;
            font-weight: 700;
            box-shadow: 0 10px 25px rgba(5,150,105,.45);
        }

        .btn-save:hover {
            transform: translateY(-3px) scale(1.04);
            box-shadow: 0 16px 35px rgba(5,150,105,.65);
        }

        .btn-back {
            border-radius: 14px;
            padding: 10px 22px;
            font-weight: 600;
        }
    </style>
</head>

<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card card-custom">
                <div class="card-header-custom">
                    <i class="bi bi-chat-dots-fill"></i> Feedback Aspirasi
                </div>

                <div class="card-body p-4">

                    <div class="info-box">
                        <i class="bi bi-tags-fill"></i>
                        Kategori:
                        <strong><?= htmlspecialchars($row['ket_kategori']); ?></strong>
                    </div>

                    <div class="info-box">
                        <i class="bi bi-info-circle-fill"></i>
                        Status Saat Ini:
                        <strong><?= htmlspecialchars($row['status']); ?></strong>
                    </div>

                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Feedback Admin
                            </label>
                            <textarea name="feedback"
                                      class="form-control"
                                      rows="4"
                                      required><?= htmlspecialchars($row['feedback'] ?? ''); ?></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Ubah Status
                            </label>
                            <select name="status" class="form-select" required>
                                <option value="Menunggu" <?= $row['status']=='Menunggu'?'selected':''; ?>>Menunggu</option>
                                <option value="Proses" <?= $row['status']=='Proses'?'selected':''; ?>>Proses</option>
                                <option value="Selesai" <?= $row['status']=='Selesai'?'selected':''; ?>>Selesai</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="data_pengaduan.php" class="btn btn-secondary btn-back">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>

                            <button type="submit" name="kirim" class="btn btn-save">
                                <i class="bi bi-check-circle-fill"></i> Simpan Feedback
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>

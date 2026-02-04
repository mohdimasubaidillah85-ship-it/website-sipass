<?php
session_start();
include "../KONEKSI.php";

// Proteksi login siswa
if (!isset($_SESSION['id_nis'])) {
    header("Location: login_siswa.php");
    exit;
}

$id_nis = $_SESSION['id_nis'];
$pesan = "";

// Proses simpan aspirasi
if (isset($_POST['simpan'])) {

    $id_kategori = mysqli_real_escape_string($conn, $_POST['id_kategori']);
    $lokasi      = mysqli_real_escape_string($conn, $_POST['lokasi']);
    $ket         = mysqli_real_escape_string($conn, $_POST['ket']);

    // ===== UPLOAD GAMBAR =====
    $nama_file = NULL;

    if (!empty($_FILES['gambar']['name'])) {
        $folder = "../upload/";
        $ext    = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $nama_file = "aspirasi_" . time() . "." . $ext;

        move_uploaded_file($_FILES['gambar']['tmp_name'], $folder . $nama_file);
    }

    if ($id_kategori == "" || $lokasi == "" || $ket == "") {
        $pesan = "<div class='alert alert-danger'>Semua field wajib diisi!</div>";
    } else {

        // ✅ INSERT SATU KALI SAJA
        mysqli_query($conn, " INSERT INTO input_aspirasi 
                    (id_nis, id_kategori, lokasi, ket, gambar, status)
                    VALUES 
                    ('$id_nis', '$id_kategori', '$lokasi', '$ket', '$nama_file', 'Menunggu')
                ");

                /* 🔑 ambil ID aspirasi yang baru disimpan */
                $id_aspirasi = mysqli_insert_id($conn);

                /* 🔑 masukkan juga ke tabel aspirasi agar muncul di pengelola */
                mysqli_query($conn, " INSERT INTO aspirasi
                    (id_aspirasi, id_kategori, status, feedback)
                    VALUES
                    ('$id_aspirasi', '$id_kategori', 'Menunggu', NULL)
                ");

                header("Location: dashboard_siswa.php?status=berhasil");
                exit;

    }
}



// Ambil kategori
$kategori = mysqli_query($conn, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Aspirasi | SIPAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --main: #2563eb;
            --dark: #1e3a8a;
            --soft: #f8fafc;
            --gradient: linear-gradient(135deg, #1e3a8a, #2563eb, #3b82f6);
        }

        body {
            background: var(--soft);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* NAVBAR */
        .navbar-custom {
            background: var(--gradient);
            box-shadow: 0 8px 22px rgba(37,99,235,.45);
        }

        /* CARD */
        .card-custom {
            border-radius: 22px;
            border: none;
            background: rgba(255,255,255,.9);
            backdrop-filter: blur(12px);
            box-shadow: 0 22px 45px rgba(0,0,0,.25);
        }

        .card-header-custom {
            background: var(--gradient);
            color: #fff;
            font-weight: 800;
            text-align: center;
            border-radius: 22px 22px 0 0;
        }

        /* FORM */
        .form-control,
        .form-select {
            border-radius: 14px;
            padding: 12px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--main);
            box-shadow: 0 0 0 3px rgba(37,99,235,.25);
        }

        /* BUTTON */
        .btn-primary-custom {
            background: var(--gradient);
            border: none;
            font-weight: 700;
            border-radius: 14px;
            padding: 10px 18px;
            box-shadow: 0 10px 25px rgba(37,99,235,.5);
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 16px 35px rgba(37,99,235,.65);
        }

        .btn-back {
            border-radius: 14px;
            padding: 10px 18px;
            font-weight: 600;
        }

        /* FOOTER */
        footer {
            background: var(--gradient);
            color: white;
            box-shadow: 0 -6px 18px rgba(37,99,235,.35);
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-custom">
    <div class="container justify-content-center">
        <span class="navbar-brand fw-bold text-white">
            <i class="bi bi-megaphone-fill"></i> SIPAS | Input Aspirasi
        </span>
    </div>
</nav>

<!-- CONTENT -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card card-custom">
                <div class="card-header card-header-custom">
                    Form Aspirasi Siswa
                </div>

                <div class="card-body p-4">

                    <?= $pesan; ?>

                    <form method="post" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kategori Aspirasi</label>
                            <select name="id_kategori" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php while ($k = mysqli_fetch_assoc($kategori)) : ?>
                                    <option value="<?= $k['id_kategori']; ?>">
                                        <?= $k['ket_kategori']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Lokasi</label>
                            <input type="text" name="lokasi" class="form-control"
                                placeholder="Contoh: Ruang Lab Komputer" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Upload Gambar (Opsional)</label>
                            <input type="file" name="gambar" class="form-control" accept="image/*">
                            <small class="text-muted">
                                Format: JPG, PNG, JPEG (maks. 2MB)
                            </small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi Aspirasi</label>
                            <textarea name="ket" rows="4" class="form-control"
                                    placeholder="Tuliskan aspirasi atau pengaduan Anda..." required></textarea>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="dashboard_siswa.php" class="btn btn-secondary btn-back">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>

                            <button type="submit" name="simpan" class="btn btn-primary-custom text-white">
                                <i class="bi bi-send-fill"></i> Kirim Aspirasi
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="text-center py-3 mt-5">
    <small>© 2026 SIPAS | Sistem Pengaduan & Aspirasi Siswa</small>
</footer>

</body>
</html>
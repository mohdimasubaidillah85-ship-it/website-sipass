<?php
session_start();
include 'KONEKSI.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Sistem Pengaduan Sarana Sekolah</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* ================= THEME (SAMA DENGAN LOGIN) ================= */
:root {
    --primary: #2563eb;
    --primary-dark: #1e40af;
    --soft-bg: #f1f5f9;
    --glass: rgba(255,255,255,0.15);
    --gradient: linear-gradient(135deg, #2563eb, #3b82f6);
}

body {
    background: var(--soft-bg);
    font-family: 'Segoe UI', Tahoma, sans-serif;
    color: #1f2937;
}

/* ================= NAVBAR ================= */
.navbar {
    background: var(--gradient) !important;
    box-shadow: 0 6px 18px rgba(0,0,0,.25);
}

.navbar-brand,
.navbar .nav-link {
    color: #fff !important;
    font-weight: 600;
}

.navbar .nav-link:hover {
    opacity: .85;
}

/* ================= HERO ================= */
.hero {
    background: var(--gradient);
    color: #fff;
    padding: 90px 20px;
    border-radius: 0 0 70px 70px;
    box-shadow: 0 18px 40px rgba(0,0,0,.35);
    text-align: center;
}

.hero img {
    width: 180px;      /* 👉 BESAR GAMBAR */
    height: 180px;     /* 👉 BESAR GAMBAR */
    object-fit: cover; 
    border-radius: 50%;
    border: 5px solid rgba(255,255,255,.6);
    box-shadow: 0 10px 25px rgba(0,0,0,.3);
    margin-bottom: 20px;
}

.hero h1 {
    font-weight: 900;
    letter-spacing: .5px;
}

.hero p {
    max-width: 620px;
    margin: auto;
    opacity: .95;
    font-size: 1.05rem;
}

/* ================= BUTTON ================= */
.btn-primary-custom {
    background: #fff;
    color: var(--primary);
    border: none;
    padding: 13px 30px;
    border-radius: 16px;
    font-weight: 700;
    box-shadow: 0 8px 22px rgba(0,0,0,.3);
    transition: .3s;
}

.btn-primary-custom:hover {
    transform: translateY(-3px);
    background: #f1f5f9;
}

/* ================= CARD ================= */
.card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 12px 26px rgba(0,0,0,.12);
    transition: .3s;
}

.card:hover {
    transform: translateY(-8px);
}

.card-title {
    font-weight: 700;
    color: var(--primary-dark);
}

/* ================= STEP / ALUR ================= */
.step-box {
    background: #fff;
    border-radius: 18px;
    padding: 24px;
    box-shadow: 0 10px 22px rgba(0,0,0,.12);
    font-weight: 600;
}
.action-btn {
    border-radius: 10px;
    padding: 6px 10px;
    box-shadow: 0 6px 14px rgba(0,0,0,.2);
    transition: all .25s ease;
}

.action-btn:hover {
    transform: translateY(-2px) scale(1.1);
    box-shadow: 0 10px 22px rgba(0,0,0,.35);
}
.btn-logout {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: #fff;
    font-weight: 700;
    border-radius: 14px;
    padding: 10px 18px;
    box-shadow: 0 8px 22px rgba(239,68,68,.45);
    text-decoration: none;
    transition: all .3s ease;
}

.btn-logout i {
    margin-right: 6px;
}

.btn-logout:hover {
    color: #fff;
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 14px 34px rgba(239,68,68,.65);
}


.step-box i {
    font-size: 32px;
    color: var(--primary);
    margin-bottom: 10px;
}
.btn-dashboard {
    background: linear-gradient(135deg, #ffffff, #e0e7ff);
    color: #1e40af;
    padding: 14px 32px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 50px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
}

.btn-dashboard i {
    font-size: 1.3rem;
}

.btn-dashboard:hover {
    background: linear-gradient(135deg, #1e40af, #2563eb);
    color: #ffffff;
    transform: translateY(-4px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.25);
}


/* ================= FOOTER ================= */
footer {
    background: var(--primary-dark);
    color: #fff;
    box-shadow: 0 -6px 18px rgba(0,0,0,.3);
}
/* ================= LAYOUT FIX FOOTER ================= */
html, body {
    height: 100%;
}

body {
    display: flex;
    flex-direction: column;
}

.nav-logout {
    color: #dc2626 !important;          /* merah elegan */
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: all 0.3s ease;
}

.nav-logout:hover {
    color: #b91c1c !important;
    background: rgba(220,38,38,0.12);
    border-radius: 10px;
}

</style>
</head>

<body>

<?php include 'navbar.php'; ?>

<!-- ================= HERO ================= -->
<section class="hero text-center text-white">
    <div class="container">

        <!-- FOTO & JUDUL -->
        <img src="IMG/dimas.JPG" class="rounded-circle shadow mb-3"
             width="180" height="180" style="object-fit: cover;">

        <h1 class="fw-bold display-6">
            Sistem Pengaduan Sarana Sekolah
        </h1>

        <p class="lead mt-3">
            Platform resmi untuk melaporkan kerusakan fasilitas sekolah secara cepat,
            transparan, dan terpantau oleh pihak sekolah.
        </p>

        <a href="Siswa/login_siswa.php" class="btn btn-dashboard mt-4">
            <i class="bi bi-pencil-square me-2"></i>
            Masuk Dashboard Siswa
        </a>


        <!-- GARIS -->
        <hr class="my-5 text-white">
        <!-- FITUR -->
        <div class="row g-4 mt-2">
            <div class="col-md-4">
                <div class="p-4 bg-white text-dark rounded-4 shadow h-100">
                    <i class="bi bi-lightning-charge-fill fs-1 text-primary"></i>
                    <h5 class="mt-3 fw-bold">Laporan Cepat</h5>
                    <p class="mb-0">
                        Siswa dapat melaporkan kerusakan fasilitas hanya dalam hitungan menit.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-4 bg-white text-dark rounded-4 shadow h-100">
                    <i class="bi bi-eye-fill fs-1 text-success"></i>
                    <h5 class="mt-3 fw-bold">Transparan</h5>
                    <p class="mb-0">
                        Setiap laporan dapat dipantau statusnya secara real-time.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-4 bg-white text-dark rounded-4 shadow h-100">
                    <i class="bi bi-check-circle-fill fs-1 text-warning"></i>
                    <h5 class="mt-3 fw-bold">Tertindak</h5>
                    <p class="mb-0">
                        Laporan diteruskan langsung ke admin untuk segera ditindaklanjuti.
                    </p>
                </div>
            </div>
        </div>

        <!-- STATISTIK -->
        <div class="row text-white mt-5">
            <div class="col-md-4">
                <h2 class="fw-bold">120+</h2>
                <p>Laporan Masuk</p>
            </div>
            <div class="col-md-4">
                <h2 class="fw-bold">95%</h2>
                <p>Laporan Ditangani</p>
            </div>
            <div class="col-md-4">
                <h2 class="fw-bold">24 Jam</h2>
                <p>Respon Cepat</p>
            </div>
        </div>

    </div>
</section>
<?php include 'buka_halaman.php'; ?>
<!-- GALERI -->
<section class="container my-5">
    <h3 class="text-center fw-bold mb-4">Fasilitas Sekolah</h3>

    <div class="row g-4">
        <div class="col-md-3">
            <img src="IMG/1.jpg" class="img-fluid rounded-4 shadow">
        </div>
        <div class="col-md-3">
            <img src="IMG/2.jpg" class="img-fluid rounded-4 shadow">
        </div>
        <div class="col-md-3">
            <img src="IMG/3.jpg" class="img-fluid rounded-4 shadow">
        </div>
        <div class="col-md-3">
            <img src="IMG/4.jpg" class="img-fluid rounded-4 shadow">
        </div>
    </div>
</section>




<!-- ================= FITUR ================= -->
<section class="py-5">
<div class="container">
<div class="row text-center">

    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Mudah Digunakan</h5>
                <p class="card-text">
                    Antarmuka sederhana dan mudah dipahami oleh siswa maupun guru.
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Transparan</h5>
                <p class="card-text">
                    Status pengaduan dapat dipantau hingga proses selesai.
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Responsif</h5>
                <p class="card-text">
                    Bisa diakses melalui HP, tablet, maupun komputer.
                </p>
            </div>
        </div>
    </div>

</div>
</div>
</section>

<!-- ================= ALUR ================= -->
<section class="py-5" style="background:#eaf0ff;">
<div class="container">
<h2 class="text-center fw-bold mb-4">Alur Pengaduan</h2>

<div class="row text-center">
    <div class="col-md-3 mb-3">
        <div class="step-box">
            <i class="bi bi-box-arrow-in-right"></i>
            <div>Login Pengguna</div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="step-box">
            <i class="bi bi-pencil-square"></i>
            <div>Isi Pengaduan</div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="step-box">
            <i class="bi bi-search"></i>
            <div>Verifikasi Petugas</div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="step-box">
            <i class="bi bi-check-circle"></i>
            <div>Tindak Lanjut</div>
        </div>
    </div>
</div>

</div>
</section>

<!-- ================= FOOTER ================= -->
<footer class="text-center py-3">
    © 2026 Sistem Informasi Pengaduan Sarana Sekolah
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

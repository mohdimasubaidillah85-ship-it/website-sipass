<?php
include "KONEKSI.php";

if (!isset($_SESSION['id_admin'])) {
    header("Location: ../login.php");
    exit;
}

// Hitung data
$total_pengaduan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM aspirasi"));
$menunggu = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM aspirasi WHERE status='Menunggu'"));
$proses = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM aspirasi WHERE status='Proses'"));
$selesai = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM aspirasi WHERE status='Selesai'"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin | SIPAS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
<ul class="navbar-nav ms-auto">
            
            </ul>
</nav>

<div class="container mt-4">

    <h4 class="fw-bold mb-4">Ringkasan Pengaduan</h4>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card shadow text-center">
                <div class="card-body">
                    <h6>Total Pengaduan</h6>
                    <h3><?= $total_pengaduan ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow text-center border-warning">
                <div class="card-body">
                    <h6>Menunggu</h6>
                    <h3><?= $menunggu ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow text-center border-info">
                <div class="card-body">
                    <h6>Proses</h6>
                    <h3><?= $proses ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow text-center border-success">
                <div class="card-body">
                    <h6>Selesai</h6>
                    <h3><?= $selesai ?></h3>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-4">

    <h5 class="fw-bold">Menu Admin</h5>
    <div class="d-flex gap-2">
        <a href="?open=data_pengaduan" class="btn btn-primary">Kelola Pengaduan</a>
		
    </div>

</div>

</body>
</html>

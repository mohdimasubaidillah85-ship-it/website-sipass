<?php
include "../KONEKSI.php";

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
    <title>Cetak Data Aspirasi</title>

    <style>
    body {
        font-family: "Times New Roman", Georgia, serif;
        color: #000;
        margin: 30px;
    }

    /* HEADER */
    .header {
        text-align: center;
        margin-bottom: 25px;
    }

    .header h2 {
        font-size: 20px;
        font-weight: bold;
        letter-spacing: 1px;
        margin: 0;
        text-transform: uppercase;
    }

    .header p {
        font-size: 13px;
        margin: 4px 0 0;
    }

    hr {
        border: 1px solid #000;
        margin: 12px 0 20px;
    }

    /* TABLE */
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    th, td {
        border: 1px solid #000;
        padding: 8px 6px;
        text-align: center;
    }

    th {
        font-weight: bold;
        background-color: #f2f2f2;
    }

    td:nth-child(2) {
        text-align: left;
        padding-left: 10px;
    }

    /* FOOTER */
    .footer {
        margin-top: 50px;
        width: 100%;
        font-size: 13px;
    }

    .footer .right {
        float: right;
        text-align: center;
    }

    @media print {
        .no-print {
            display: none;
        }
    }
</style>

</head>
<body onload="window.print()">

<div class="header">
    <h2>Laporan Data Aspirasi Siswa</h2>
    <p>Sistem Informasi Pengelolaan Aspirasi Siswa (SIPAS)</p>
</div>

<hr>
Informasi Pengelolaan Aspirasi Siswa (SIPAS)</p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; while($row = mysqli_fetch_assoc($data)) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['ket_kategori']) ?></td>
            <td><?= htmlspecialchars($row['status']) ?></td>
            <td><?= date('d-m-Y', strtotime($row['tgl_aspirasi'])) ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>

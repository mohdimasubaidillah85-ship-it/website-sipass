<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Sarana Pengaduan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto">

        <!-- SELALU TAMPIL -->
        <li class="nav-item">
            <a class="nav-link active" href="?open=index">Beranda</a>
        </li>

        <?php if (!isset($_SESSION['id_admin'])) { ?>
            <!-- BELUM LOGIN -->
            <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
            </li>

        <?php } else { ?>
            <!-- SUDAH LOGIN (ADMIN) -->
            <li class="nav-item">
                <a class="nav-link" href="?open=Dashboard_admin">Dashboard Admin</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="?open=Kategori">Kategori</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="?open=Admin">Admin</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="?open=Siswa">Siswa</a>
            </li>

            <li class="nav-item">
                <a href="logout.php"
                onclick="return confirm('Yakin ingin logout?')"
                class="nav-link nav-logout">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </a>
            </li>

        <?php } ?>

    </ul>
</div>

    </div>
</nav>
<?php
session_start();

// Hapus semua data session
session_unset();
session_destroy();

// Arahkan kembali ke halaman login siswa
header("Location: login_siswa.php");
exit;

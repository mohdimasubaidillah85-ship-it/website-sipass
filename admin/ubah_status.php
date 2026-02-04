<?php
session_start();
include "../KONEKSI.php";

if (!isset($_SESSION['id_admin'])) {
    header("Location: ../login.php");
    exit;
}

$id     = $_GET['id'];
$status = $_GET['status'];

mysqli_query($conn, "
    UPDATE aspirasi 
    SET status='$status' 
    WHERE id_aspirasi='$id'
");

header("Location: ".$_SERVER['HTTP_REFERER']);
exit;

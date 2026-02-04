<?php
if (isset($_GET['open'])) {
    $open = $_GET['open'];

    switch ($open) {
	/////////////////////////////////////////////////////////////////////////////
        case 'Kategori':
            include 'kategori/kategori.php';
            break;
			
		case 'Kategori_Tambah':
            include 'kategori/kategori_tambah.php';
            break;

		case 'Kategori_Edit':
            include 'kategori/kategori_edit.php';
            break;
		
		case 'Kategori_Hapus':
            include 'kategori/kategori_hapus.php';
            break;

	/////////////////////////////////////////////////////////////////////////////
			

        case 'Admin':
            include 'admin/admin.php';
            break;
			
		case 'Admin_Tambah':
            include 'admin/admin_tambah.php';
            break;

		case 'Admin_Edit':
            include 'admin/admin_edit.php';
            break;
			
		case 'Admin_Hapus':
            include 'admin/admin_hapus.php';
            break;
			
		case 'Dashboard_admin':
            include 'admin/dashboard_admin.php';
            break;
			
		case 'data_pengaduan':
            include 'admin/data_pengaduan.php';
            break;

	/////////////////////////////////////////////////////////////////////////////

			
        case 'Siswa':
            include 'siswa/siswa.php';
            break;
			
		case 'Siswa_Tambah':
            include 'siswa/siswa_tambah.php';
            break;
			
		case 'Siswa_Edit':
            include 'siswa/siswa_edit.php';
            break;
			
		case 'Siswa_Hapus':
            include 'siswa/siswa_hapus.php';
            break;

        default:
            include 'halaman_utama.php';
            break;
			
	/////////////////////////////////////////////////////////////////////////////

    }
} else {
    include 'halaman_utama.php';
}
?>

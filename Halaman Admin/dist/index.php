<?php
session_start();
ob_start(); // Tambahkan di baris paling atas
include '../../koneksi.php';

if (empty($_SESSION['sID_ADMIN'])) {
	header('location:Login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | SMPN 6 TIKEP</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo/loder.png">

    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.php?ke=Dashboard"><img src="assets/images/logo/SMP2.jpeg" alt="" srcset="" style="width: 100%; height: auto;"></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body py-4 px-5">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <?php if (isset($_SESSION['sGAMBAR_ADMIN']) && !empty($_SESSION['sGAMBAR_ADMIN'])): ?>
                                    <img src="Pengguna/uploads/<?= htmlspecialchars($_SESSION['sGAMBAR_ADMIN']); ?>" alt="<?= htmlspecialchars($_SESSION['sNAMA_ADMIN']); ?>">
                                <?php else: ?>
                                    <img src="assets/images/faces/1.jpg" alt="Default Avatar"> <?php endif; ?>
                            </div>
                            <div class="ms-3 name">
                                <h6 class="font-bold mt-2"><?php echo $_SESSION['sNAMA_ADMIN'];?></h6>
                                <h6 class="font-bold mt-2">ID ADMIN :<?php echo $_SESSION['sID_ADMIN'];?></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
                        <?php
                        $currentPage = isset($_GET['ke']) ? $_GET['ke'] : '';
                        $masterDataActive = in_array($currentPage, ['datasiswa', 'pembayaran','siswaditerima']);
                        ?>

                        <li class="sidebar-item <?php if ($currentPage == 'dashboard') echo 'active'; ?>">
                            <a href="index.php?ke=dashboard" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item has-sub <?php if ($masterDataActive) echo 'active'; ?>">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Master Data</span>
                            </a>
                            <ul class="submenu <?php if ($masterDataActive) echo 'active'; ?>">
                                <li class="submenu-item <?php if ($currentPage == 'datasiswa') echo 'active'; ?>">
                                    <a href="index.php?ke=datasiswa">Data Siswa</a>
                                </li>
                                <li class="submenu-item <?php if ($currentPage == 'siswaditerima') echo 'active'; ?>">
                                    <a href="index.php?ke=siswaditerima">Siswa Diterima</a>
                                </li>
                                <li class="submenu-item <?php if ($currentPage == 'pembayaran') echo 'active'; ?>">
                                    <a href="index.php?ke=pembayaran">Pembayaran</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item <?php if ($currentPage == 'laporan') echo 'active'; ?>">
                            <a href="index.php?ke=laporan" class='sidebar-link'>
                            <i class="bi bi-file-earmark-break-fill"></i>
                                <span>Laporan</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?php if ($currentPage == 'pengguna') echo 'active'; ?>">
                            <a href="index.php?ke=pengguna" class='sidebar-link'>
                                <i class="bi bi-person-fill"></i>
                                <span>Pengguna</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="Logout.php" class='sidebar-link'>
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="cont">
                <?php
                $hal = (isset($_GET['ke'])) ? $_GET['ke'] : "main";
                
                switch ($hal) {
                    case 'dashboard':
                        include "Dashboard.php"; 
                        break;
                        //datasiswa
                    case 'datasiswa':
                        include "Master Data/Siswa/DataSiswa.php"; 
                        break;
                    case 'tambahData':
                        include "Master Data/Siswa/tambahData.php"; 
                        break;
                    case 'hapusData':
                        include "Master Data/Siswa/hapusData.php"; 
                        break;
                    case 'detailData':
                        include "Master Data/Siswa/detailData.php"; 
                        break;
                    case 'siswaditerima':
                        include "Master Data/Siswa/siswaditerima.php"; 
                        break;
                    case 'verifikasi':
                        include "Master Data/Siswa/verifikasi.php"; 
                        break;
                    case 'ditolak':
                        include "Master Data/Siswa/ditolak.php"; 
                        break;
                    case 'belum_diverifikasi';
                        include "Master Data/Siswa/belum_diverifikasi.php";

                        
                        //datapengguna
                    case 'detailPengguna':
                        include "Pengguna/detailPengguna.php"; 
                        break;
                    case 'tambahPengguna':
                        include "Pengguna/tambahPengguna.php"; 
                        break;  
                    case 'hapusPengguna':
                        include "Pengguna/hapusPengguna.php"; 
                        break;
                    case 'ubahPengguna':
                        include "Pengguna/ubahPengguna.php"; 
                        break; 
                    case 'pengguna':
                        include "Pengguna/Pengguna.php"; 
                        break;
                        //datapembayaran
                    case 'tambahPembayaran':
                        include "Master Data/tambahPembayaran.php"; 
                        break;
                    case 'detailPembayaran':
                        include "Master Data/detailPembayaran.php"; 
                        break;
                    case 'hapusPembayaran':
                        include "Master Data/hapusPembayaran.php"; 
                        break;
                    case 'ubahPembayaran':
                        include "Master Data/ubahPembayaran.php"; 
                        break;
                    case 'pembayaran':
                        include "Master Data/DataPembayaran.php"; 
                        break;
                    case 'laporan':
                        include "Laporan/Laporan.php"; 
                        break;   
                    
                    case 'main':
                    default: 
                        include "Dashboard.php";
                }
                ?>
            </div>
            <footer>
            <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> | All rights reserved </p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by SMPN 6 TIKEP</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
</body>
</html>
<?php
ob_end_flush(); // Tambahkan di baris paling bawah
?>
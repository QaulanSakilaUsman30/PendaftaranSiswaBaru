<?php
 include '../koneksi.php';
 if (isset($_POST['tambahdatasiswa'])) {
     // Data Siswa
     $NAMA_LENGKAP = mysqli_real_escape_string($conn, $_POST['NAMA_LENGKAP']);
     $NAMA_PANGGILAN = mysqli_real_escape_string($conn, $_POST['NAMA_PANGGILAN']);
     $TEMPAT_LAHIR = mysqli_real_escape_string($conn, $_POST['TEMPAT_LAHIR']);
     $TGL_LAHIR = mysqli_real_escape_string($conn, $_POST['TGL_LAHIR']);
     $JENIS_KELAMIN = mysqli_real_escape_string($conn, $_POST['JENIS_KELAMIN']);
     $TINGGI_BADAN = mysqli_real_escape_string($conn, $_POST['TINGGI_BADAN']);
     $BERAT_BADAN = mysqli_real_escape_string($conn, $_POST['BERAT_BADAN']);
     $PANJANG_TANGAN = mysqli_real_escape_string($conn, $_POST['PANJANG_TANGAN']);
     $PANJANG_KAKI = mysqli_real_escape_string($conn, $_POST['PANJANG_KAKI']);
     $AGAMA = mysqli_real_escape_string($conn, $_POST['AGAMA']);
     $ALAMAT_RUMAH = mysqli_real_escape_string($conn, $_POST['ALAMAT_RUMAH']);
     $KODE_POS_RUMAH = mysqli_real_escape_string($conn, $_POST['KODE_POS_RUMAH']);
     $TELEPON_RUMAH = mysqli_real_escape_string($conn, $_POST['TELEPON_RUMAH']);
     $ASAL_SEKOLAH = mysqli_real_escape_string($conn, $_POST['ASAL_SEKOLAH']);
     $KELAS_JURUSAN = mysqli_real_escape_string($conn, $_POST['KELAS_JURUSAN']);
     $ALAMAT_SEKOLAH = mysqli_real_escape_string($conn, $_POST['ALAMAT_SEKOLAH']);
     $KODE_POS_SEKOLAH = mysqli_real_escape_string($conn, $_POST['KODE_POS_SEKOLAH']);
     $TELEPON_SEKOLAH = mysqli_real_escape_string($conn, $_POST['TELEPON_SEKOLAH']);
     $TGL_BUAT = date('Y-m-d H:i:s');
     $HOBI = mysqli_real_escape_string($conn, $_POST['HOBI']);
     $KETERAMPILAN_KHUSUS = mysqli_real_escape_string($conn, $_POST['KETERAMPILAN_KHUSUS']);
     $PENGHARGAAN_SEKOLAH = mysqli_real_escape_string($conn, $_POST['PENGHARGAAN_SEKOLAH']);
     $PENGHARGAAN_KECAMATAN = mysqli_real_escape_string($conn, $_POST['PENGHARGAAN_KECAMATAN']);
     $PENGHARGAAN_KAB_KOTA = mysqli_real_escape_string($conn, $_POST['PENGHARGAAN_KAB_KOTA']);
     $PENGHARGAAN_PROVINSI = mysqli_real_escape_string($conn, $_POST['PENGHARGAAN_PROVINSI']);
     $PENGHARGAAN_NASIONAL = mysqli_real_escape_string($conn, $_POST['PENGHARGAAN_NASIONAL']);
     $PENGHARGAAN_INTERNASIONAL = mysqli_real_escape_string($conn, $_POST['PENGHARGAAN_INTERNASIONAL']);

     // Set status default
    $status = 'BELUM DIVERIFIKASI';

     $query_siswa = mysqli_query($conn, "INSERT INTO datasiswa SET
         NAMA_LENGKAP = '$NAMA_LENGKAP',
         NAMA_PANGGILAN = '$NAMA_PANGGILAN',
         TEMPAT_LAHIR = '$TEMPAT_LAHIR',
         TGL_LAHIR = '$TGL_LAHIR',
         JENIS_KELAMIN = '$JENIS_KELAMIN',
         TINGGI_BADAN = '$TINGGI_BADAN',
         BERAT_BADAN = '$BERAT_BADAN',
         PANJANG_TANGAN = '$PANJANG_TANGAN',
         PANJANG_KAKI = '$PANJANG_KAKI',
         AGAMA = '$AGAMA',
         ALAMAT_RUMAH = '$ALAMAT_RUMAH',
         KODE_POS_RUMAH = '$KODE_POS_RUMAH',
         TELEPON_RUMAH = '$TELEPON_RUMAH',
         ASAL_SEKOLAH = '$ASAL_SEKOLAH',
         KELAS_JURUSAN = '$KELAS_JURUSAN',
         ALAMAT_SEKOLAH = '$ALAMAT_SEKOLAH',
         KODE_POS_SEKOLAH = '$KODE_POS_SEKOLAH',
         TELEPON_SEKOLAH = '$TELEPON_SEKOLAH',
         TGL_BUAT = '$TGL_BUAT',
         HOBI = '$HOBI',
         KETERAMPILAN_KHUSUS = '$KETERAMPILAN_KHUSUS',
         PENGHARGAAN_SEKOLAH = '$PENGHARGAAN_SEKOLAH',
         PENGHARGAAN_KECAMATAN = '$PENGHARGAAN_KECAMATAN',
         PENGHARGAAN_KAB_KOTA = '$PENGHARGAAN_KAB_KOTA',
         PENGHARGAAN_PROVINSI = '$PENGHARGAAN_PROVINSI',
         PENGHARGAAN_NASIONAL = '$PENGHARGAAN_NASIONAL',
         PENGHARGAAN_INTERNASIONAL = '$PENGHARGAAN_INTERNASIONAL',
         STATUS = '$status'");
     if ($query_siswa) {
         header('location:index.php');
     }else{
         echo"<p> Data Gagal Di Simpan";
     }
 }
 ?>           
<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Daftar Siswa | SMPN 6 TIKEP</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo/loder.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/hamburgers.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Styling untuk progressbar agar tetap di atas */
.multi-step-form .progressbar-container {
    position: sticky; /* Membuat elemen tetap berada di viewport saat di-scroll */
    top: 0; /* Menempelkan elemen ke bagian atas viewport */
    background-color: #f9f9f9; /* Memberikan latar belakang agar tidak transparan saat di-scroll */
    z-index: 100; /* Memastikan berada di atas elemen lain */
    padding: 15px 0; /* Memberikan sedikit ruang di atas dan bawah progressbar */
    margin-bottom: 30px; /* Memberikan jarak dengan konten di bawahnya */
    border-bottom: 1px solid #eee; /* Garis pemisah tipis */
}

.multi-step-form .progressbar {
    list-style: none;
    padding: 0;
    margin: 0 auto;
    margin-bottom: 5%; /* Membuat progressbar berada di tengah kontainer */
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
    max-width: 700px; /* Menyesuaikan dengan lebar form-container */
}

.multi-step-form .progressbar::before {
    content: '';
    background-color: #d9d9d9;
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 2px;
    transform: translateY(-50%);
    z-index: 0;
}

.multi-step-form .progressbar li {
    width: 33.33%; /* Adjust based on the number of steps */
    text-align: center;
    position: relative;
    z-index: 1;
    cursor: pointer;
}

.multi-step-form .progressbar li::before {
    content: '';
    display: block;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #d9d9d9;
    margin: 0 auto 10px auto;
    border: 2px solid #d9d9d9;
}

.multi-step-form .progressbar li.active::before {
    background-color:#4255A4;
    border-color:#4255A4;
}

.multi-step-form .progressbar li.active span {
    font-weight: bold;
    color:#4255A4;
}

.multi-step-form .progressbar li span {
    font-size: 14px;
    color: #4255A4;
}

.multi-step-form .step-form {
    display: none;
}

.multi-step-form .step-form.active {
    display: block;
    animation: fadein 0.3s ease-in-out;
}

.multi-step-form .step-title {
    margin-bottom: 20px;
    color: #333;
    text-align:center;
    font-size: 40px;
}

.multi-step-form .form-group {
    margin-bottom: 20px;
}

.multi-step-form label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #555;
}

.multi-step-form .form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
}

.multi-step-form .form-control:focus {
    outline: none;
    border-color: #195594;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

.multi-step-form .btn-navigation {
    margin-top: 20px;
    display: flex;
    gap: 10px;
    justify-content: flex-end;
    margin-right: 90px;
}
.multi-step-form .btn-navigation1 {
    margin-top: 20px;
    display: flex;
    gap: 10px;
    justify-content: flex-end;
}

.multi-step-form .button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.multi-step-form .button-primary {
    background-color:#4255A4;
    color: white;
}

.multi-step-form .button-primary:hover {
    background-color: #0056b3;
}

.multi-step-form .button-light {
    background-color: #f0f0f0;
    color: #333;
    border: 1px solid #ccc;
}

.multi-step-form .button-light:hover {
    background-color: #e0e0e0;
}

.multi-step-form .ketentuan-list {
    padding-left: 90px;
    margin-bottom: 20px;
    padding-right: 90px;
    text-align: justify;
}

.multi-step-form .ketentuan-list li {
    margin-bottom: 10px;
    line-height: 1.6;
    color: #666;
    font-size:20px;
    font-weight: 300;
}

/* Animations */
@keyframes fadein {
    from { opacity: 0; }
    to { opacity: 1; }
}
    </style>
</head>
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text">
                <img src="assets/img/logo/loder.png" alt="">
            </div>
        </div>
    </div>
</div>
<div class="header-area header-transparent">
    <div class="main-header ">
        <div class="header-bottom  header-sticky">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo" style="width: 15em; /* Contoh lebar responsif */">
                            <a href="index.html"><img src="assets/img/logo/SMP.png" alt="" style="width: 100%; height: auto;"></a>
                        </div>
                    </div>
                    <div class="col-xl-10 col-lg-10">
                        <div class="menu-wrapper d-flex align-items-center justify-content-end">
                            <div class="main-menu d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">                                                                  
                                        <li class="active" ><a href="index.php">Home</a></li>
                                        <li><a href="#ketentuan">Ketentuan</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<main>
    <section class="slider-area slider-area2">
        <div class="slider-active">
            <div class="single-slider slider-height2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-11 col-md-12">
                            <div class="hero__caption hero__caption2">
                                <h1 data-animation="bounceIn" data-delay="0.2s">Daftar Siswa</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                        <li class="breadcrumb-item"><a href="daftarsiswa.php">Daftar Siswa</a></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="contact-section" id="ketentuan">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form class="form-contact contact_form multi-step-form"  method="POST" id="contactForm" novalidate="novalidate">
                        <div class="form-container">
                            <ul class="progressbar">
                                <li class="active" onclick="showStep(1)">Ketentuan</li>
                                <li onclick="showStep(2)">Data Siswa</li>
                            </ul>
                            <div class="step-form active" id="step-form-1">
                                <h3 class="step-title">KETENTUAN PSB SMPN 6 TIDORE KEPULAUAN</h3>
                                <ol class="ketentuan-list">
                                    <li> 1. Setiap calon siswa wajib mengisi form pendaftaran dengan lengkap.</li>
                                    <li> 2. Data-data yang diisikan pada form PPDB Online harus sesuai dengan data asli dan benar adanya.</li>
                                    <li>3. Melampirkan fotokopi akta kelahiran atau surat keterangan lahir yang dilegalisir.</li>
                                    <li>4. Siapkan scan akta, KK, Ijazah (bila sudah ada), SKL, dan Buku PIP (bagi yang memiliki) dalam format PDF maksimal berukuran 2MB yang akan di-upload melalui form pendaftaran PPDB Online.</li>
                                    <li> 5. Calon siswa yang sudah mendaftarkan diri melalui PSB Online SMPN 6 Tidore Kepulauan akan login ke website dengan Username dan Password yang nantinya akan digunakan untuk akses informasi yang berkaitan dengan PSB SMPN 6 Tidore Kepulauan.</li>
                                    <li>6. Calon siswa yang sudah mendaftarkan diri melalui  PSB Online SMPN 6 Tidore Kepulauan wajib menyerahkan dokumen persyaratan yang sudah ditentukan oleh Panitia PSB SMPN 6 Tidore Kepulauan.</li>
                                    <li>7. Data yang sudah diberikan oleh Panitia PSB SMPN 6 Tidore Kepulauan hanya digunakan untuk keperluan penerimaan siswa baru dan data tidak akan dipublikasikan serta dijaga kerahasiaannya oleh Panitia PSB.</li>
                                    
                                </ol>
                                <div class="btn-navigation">
                                    <button type="button" class="button button-primary" onclick="nextStep(1)">Saya Mengerti dan Lanjutkan</button>
                                </div>
                            </div>

                            <div class="step-form" id="step-form-2">
                                <h3 class="step-title">Data Siswa</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="NAMA_LENGKAP">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="NAMA_LENGKAP" name="NAMA_LENGKAP" required>
                                            <div class="valid-feedback"> Bagus! </div>
                                            <div class="invalid-feedback"> Wajib Diisi! </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="NAMA_PANGGILAN">Nama Panggilan</label>
                                            <input type="text" class="form-control" id="NAMA_PANGGILAN" name="NAMA_PANGGILAN" required>
                                            <div class="valid-feedback"> Bagus! </div>
                                            <div class="invalid-feedback"> Wajib Diisi! </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="TEMPAT_LAHIR">Tempat Lahir</label>
                                            <input type="text" class="form-control" id="TEMPAT_LAHIR" name="TEMPAT_LAHIR" required>
                                            <div class="valid-feedback"> Bagus! </div>
                                            <div class="invalid-feedback"> Wajib Diisi! </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="TGL_LAHIR">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="TGL_LAHIR" name="TGL_LAHIR" required>
                                            <div class="valid-feedback"> Bagus! </div>
                                            <div class="invalid-feedback"> Wajib Diisi! </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="JENIS_KELAMIN">Jenis Kelamin</label>
                                            <select class="form-control" id="JENIS_KELAMIN" name="JENIS_KELAMIN" required>
                                                <option value=""> ~~~ Pilih Jenis Kelamin ~~~ </option>
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                            <div class="valid-feedback"> Bagus! </div>
                                            <div class="invalid-feedback"> Wajib Diisi! </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="AGAMA">Agama</label>
                                            <select class="form-control" id="AGAMA" name="AGAMA" required>
                                                <option value=""> ~~~ Pilih Agama ~~~ </option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen Protestan">Kristen Protestan</option>
                                                <option value="Kristen Katolik">Kristen Katolik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Buddha">Buddha</option>
                                                <option value="Konghucu">Konghucu</option>
                                            </select>
                                            <div class="valid-feedback"> Bagus! </div>
                                            <div class="invalid-feedback"> Wajib Diisi! </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="TINGGI_BADAN">Tinggi Badan (cm)</label>
                                            <input type="number" class="form-control" id="TINGGI_BADAN" name="TINGGI_BADAN" required>
                                            <div class="valid-feedback"> Bagus! </div>
                                            <div class="invalid-feedback"> Wajib Diisi! </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="BERAT_BADAN">Berat Badan (kg)</label>
                                            <input type="number" class="form-control" id="BERAT_BADAN" name="BERAT_BADAN" required>
                                            <div class="valid-feedback"> Bagus! </div>
                                            <div class="invalid-feedback"> Wajib Diisi! </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ALAMAT_RUMAH">Alamat Rumah</label>
                                            <input class="form-control" type="text" id="ALAMAT_RUMAH" name="ALAMAT_RUMAH" required>
                                            <div class="valid-feedback"> Bagus! </div>
                                            <div class="invalid-feedback"> Wajib Diisi! </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="PANJANG_TANGAN">Panjang Tangan (cm)</label>
                                            <input type="number" class="form-control" id="PANJANG_TANGAN" name="PANJANG_TANGAN" required>
                                            <div class="valid-feedback"> Bagus! </div>
                                            <div class="invalid-feedback"> Wajib Diisi! </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="PANJANG_KAKI">Panjang Kaki (cm)</label>
                                            <input type="number" class="form-control" id="PANJANG_KAKI" name="PANJANG_KAKI" required>
                                            <div class="valid-feedback"> Bagus! </div>
                                            <div class="invalid-feedback"> Wajib Diisi! </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="KODE_POS_RUMAH">Kode Pos Rumah</label>
                                            <input type="text" class="form-control" id="KODE_POS_RUMAH" name="KODE_POS_RUMAH" required>
                                            <div class="valid-feedback"> Bagus! </div>
                                            <div class="invalid-feedback"> Wajib Diisi! </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="TELEPON_RUMAH">Telepon Rumah</label>
                                            <input type="text" class="form-control" id="TELEPON_RUMAH" name="TELEPON_RUMAH" required>
                                            <div class="valid-feedback"> Bagus! </div>
                                            <div class="invalid-feedback"> Wajib Diisi! </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ASAL_SEKOLAH">Asal Sekolah</label>
                                            <input type="text" class="form-control" id="ASAL_SEKOLAH" name="ASAL_SEKOLAH" required>
                                            <div class="valid-feedback"> Bagus! </div>
                                            <div class="invalid-feedback"> Wajib Diisi! </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="KELAS_JURUSAN">Kelas/Jurusan</label>
                                            <input type="text" class="form-control" id="KELAS_JURUSAN" name="KELAS_JURUSAN" required>
                                            <div class="valid-feedback"> Bagus! </div>
                                            <div class="invalid-feedback"> Wajib Diisi! </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ALAMAT_SEKOLAH">Alamat Sekolah</label>
                                            <input class="form-control" type="text" id="ALAMAT_SEKOLAH" name="ALAMAT_SEKOLAH" required>
                                            <div class="valid-feedback"> Bagus! </div>
                                            <div class="invalid-feedback"> Wajib Diisi! </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="KODE_POS_SEKOLAH">Kode Pos Sekolah</label>
                                            <input type="text" class="form-control" id="KODE_POS_SEKOLAH" name="KODE_POS_SEKOLAH" required>
                                            <div class="valid-feedback"> Bagus! </div>
                                            <div class="invalid-feedback"> Wajib Diisi! </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="TELEPON_SEKOLAH">Telepon Sekolah</label>
                                            <input type="text" class="form-control" id="TELEPON_SEKOLAH" name="TELEPON_SEKOLAH" required>
                                            <div class="valid-feedback"> Bagus! </div>
                                            <div class="invalid-feedback"> Wajib Diisi! </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="HOBI">Kegemaran (Hobi)</label>
                                            <input type="text" class="form-control" id="HOBI" name="HOBI">
                                            <div class="valid-feedback"> Bagus! </div>
                                            <div class="invalid-feedback"> Wajib Diisi! </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="KETERAMPILAN_KHUSUS">Keterampilan Khusus</label>
                                            <input type="text" class="form-control" id="KETERAMPILAN_KHUSUS" name="KETERAMPILAN_KHUSUS">
                                            <div class="valid-feedback"> Bagus! </div>
                                            <div class="invalid-feedback"> Wajib Diisi! </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div>
                                                <label for="PENGHARGAAN_SEKOLAH">Penghargaan Tingkat Sekolah</label>
                                                <input type="text" class="form-control" id="PENGHARGAAN_SEKOLAH" name="PENGHARGAAN_SEKOLAH" placeholder="Sebutkan penghargaan di tingkat Sekolah">
                                            </div>
                                            <br>
                                            <div>
                                                <label for="PENGHARGAAN_KECAMATAN">Penghargaan Tingkat Kecamatan</label>
                                                <input type="text" class="form-control" id="PENGHARGAAN_KECAMATAN" name="PENGHARGAAN_KECAMATAN" placeholder="Sebutkan penghargaan di tingkat kecamatan">
                                            </div>
                                            <br>
                                            <div>
                                                <label for="PENGHARGAAN_KAB_KOTA">Penghargaan Tingkat Kab/Kota</label>
                                                <input type="text" class="form-control" id="PENGHARGAAN_KAB_KOTA" name="PENGHARGAAN_KAB_KOTA" placeholder="Sebutkan penghargaan di tingkat kab/kota">
                                            </div>
                                        </div>
                                        <div class="valid-feedback">Bagus!</div>
                                        <div class="invalid-feedback">Wajib Diisi!</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div>
                                                <label for="PENGHARGAAN_PROVINSI">Penghargaan Tingkat Provinsi</label>
                                                <input type="text" class="form-control" id="PENGHARGAAN_PROVINSI" name="PENGHARGAAN_PROVINSI" placeholder="Sebutkan penghargaan di tingkat Provinsi">
                                            </div>
                                            <br>
                                            <div>
                                                <label for="PENGHARGAAN_NASIONAL">Penghargaan Tingkat Nasional</label>
                                                <input type="text" class="form-control" id="PENGHARGAAN_NASIONAL" name="PENGHARGAAN_NASIONAL" placeholder="Sebutkan penghargaan di tingkat Nasional">
                                            </div>
                                            <br>
                                            <div>
                                                <label for="PENGHARGAAN_INTERNASIONAL">Penghargaan Tingkat Internasional</label>
                                                <input type="text" class="form-control" id="PENGHARGAAN_INTERNASIONAL" name="PENGHARGAAN_INTERNASIONAL" placeholder="Sebutkan penghargaan di tingkat Internasional">
                                            </div>
                                        </div>
                                        <div class="valid-feedback">Bagus!</div>
                                        <div class="invalid-feedback">Wajib Diisi!</div>
                                    </div>
                                </div>
                                <div class="btn-navigation1">
                                    <button type="button" class="button button-light" onclick="prevStep(2)">Sebelumnya</button>
                                    <button type="submit" class="button button-primary" name="tambahdatasiswa">Kirim Pendaftaran</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
<footer>
    <div class="footer-wrappper footer-bg">
       <!-- Footer Start-->
       <!-- footer-bottom area -->
       <div class="footer-bottom-area">
           <div class="container">
               <div class="footer-border">
                   <div class="row d-flex align-items-center">
                       <div class="col-xl-12 ">
                           <div class="footer-copy-right text-center">
                               <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                 Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved 
                                 <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <!-- Footer End-->
     </div>
 </footer> 
<div id="back-top" >
    <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>

<script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="./assets/js/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>

<script src="./assets/js/owl.carousel.min.js"></script>
<script src="./assets/js/slicknav.min.js"></script>
<script src="./assets/js/wow.min.js"></script>
<script src="./assets/js/animated.headline.js"></script>
<script src="./assets/js/jquery.magnific-popup.js"></script>
<script src="./assets/js/jquery.slicknav.min.js"></script>

<script src="./assets/js/plugins.js"></script>
<script src="./assets/js/main.js"></script>
<script>
    const stepForms = document.querySelectorAll('.step-form');
    const progressbarItems = document.querySelectorAll('.progressbar li');
    let currentStep = 1;

    function showStep(stepNumber) {
        stepForms.forEach(step => step.classList.remove('active'));
        progressbarItems.forEach((item, index) => {
            if (index < stepNumber) {
                item.classList.add('active');
            } else {
                item.classList.remove('active');
            }
        });
        document.getElementById(`step-form-${stepNumber}`).classList.add('active');
        currentStep = stepNumber;
    }

    function nextStep(stepNumber) {
        if (stepNumber < stepForms.length) {
            currentStep++;
            showStep(currentStep);
        }
    }

    function prevStep(stepNumber) {
        if (stepNumber > 1) {
            currentStep--;
            showStep(currentStep);
        }
    }
</script>
</body>
</html>
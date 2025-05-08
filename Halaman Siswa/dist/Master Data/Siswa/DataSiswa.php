<?php

// Proteksi halaman, pastikan hanya siswa yang login yang bisa mengakses
if (!isset($_SESSION['ID_SISWA'])) {
    header('Location: ../../Login Siswa/index.php'); // Sesuaikan path jika perlu
    exit();
}

// Sertakan file koneksi database
require_once '../../koneksi.php'; // Sesuaikan path jika perlu

// Ambil ID siswa dari session
$id_siswa_login = $_SESSION['ID_SISWA'];

// Proses update data jika form disubmit
if (isset($_POST['ubahdata'])) {
    // Ambil semua nilai dari form
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['NAMA_LENGKAP']);
    $nama_panggilan = mysqli_real_escape_string($conn, $_POST['NAMA_PANGGILAN']);
    $tempat_lahir = mysqli_real_escape_string($conn, $_POST['TEMPAT_LAHIR']);
    $tgl_lahir = mysqli_real_escape_string($conn, $_POST['TGL_LAHIR']);
    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['JENIS_KELAMIN']);
    $agama = mysqli_real_escape_string($conn, $_POST['AGAMA']);
    $tinggi_badan = mysqli_real_escape_string($conn, $_POST['TINGGI_BADAN']);
    $berat_badan = mysqli_real_escape_string($conn, $_POST['BERAT_BADAN']);
    $panjang_tangan = mysqli_real_escape_string($conn, $_POST['PANJANG_TANGAN']);
    $panjang_kaki = mysqli_real_escape_string($conn, $_POST['PANJANG_KAKI']);
    $alamat_rumah = mysqli_real_escape_string($conn, $_POST['ALAMAT_RUMAH']);
    $kode_pos_rumah = mysqli_real_escape_string($conn, $_POST['KODE_POS_RUMAH']);
    $telepon_rumah = mysqli_real_escape_string($conn, $_POST['TELEPON_RUMAH']);
    $asal_sekolah = mysqli_real_escape_string($conn, $_POST['ASAL_SEKOLAH']);
    $kelas_jurusan = mysqli_real_escape_string($conn, $_POST['KELAS_JURUSAN']);
    $alamat_sekolah = mysqli_real_escape_string($conn, $_POST['ALAMAT_SEKOLAH']);
    $kode_pos_sekolah = mysqli_real_escape_string($conn, $_POST['KODE_POS_SEKOLAH']);
    $telepon_sekolah = mysqli_real_escape_string($conn, $_POST['TELEPON_SEKOLAH']);
    $tgl_ubah = date('Y-m-d H:i:s');
    $hobi = mysqli_real_escape_string($conn, $_POST['HOBI']);
    $keterampilan_khusus = mysqli_real_escape_string($conn, $_POST['KETERAMPILAN_KHUSUS']);
    $penghargaan_sekolah = mysqli_real_escape_string($conn, $_POST['PENGHARGAAN_SEKOLAH']);
    $penghargaan_kecamatan = mysqli_real_escape_string($conn, $_POST['PENGHARGAAN_KECAMATAN']);
    $penghargaan_kab_kota = mysqli_real_escape_string($conn, $_POST['PENGHARGAAN_KAB_KOTA']);
    $penghargaan_provinsi = mysqli_real_escape_string($conn, $_POST['PENGHARGAAN_PROVINSI']);
    $penghargaan_nasional = mysqli_real_escape_string($conn, $_POST['PENGHARGAAN_NASIONAL']);
    $penghargaan_internasional = mysqli_real_escape_string($conn, $_POST['PENGHARGAAN_INTERNASIONAL']);

    // Query untuk mengupdate data siswa
    $query_update = mysqli_query($conn, "UPDATE datasiswa SET
        NAMA_LENGKAP = '$nama_lengkap',
        NAMA_PANGGILAN = '$nama_panggilan',
        TEMPAT_LAHIR = '$tempat_lahir',
        TGL_LAHIR = '$tgl_lahir',
        JENIS_KELAMIN = '$jenis_kelamin',
        AGAMA = '$agama',
        TINGGI_BADAN = '$tinggi_badan',
        BERAT_BADAN = '$berat_badan',
        PANJANG_TANGAN = '$panjang_tangan',
        PANJANG_KAKI = '$panjang_kaki',
        ALAMAT_RUMAH = '$alamat_rumah',
        KODE_POS_RUMAH = '$kode_pos_rumah',
        TELEPON_RUMAH = '$telepon_rumah',
        ASAL_SEKOLAH = '$asal_sekolah',
        KELAS_JURUSAN = '$kelas_jurusan',
        ALAMAT_SEKOLAH = '$alamat_sekolah',
        KODE_POS_SEKOLAH = '$kode_pos_sekolah',
        TELEPON_SEKOLAH = '$telepon_sekolah',
        TGL_UBAH = '$tgl_ubah',
        HOBI = '$hobi',
        KETERAMPILAN_KHUSUS = '$keterampilan_khusus',
        PENGHARGAAN_SEKOLAH = '$penghargaan_sekolah',
        PENGHARGAAN_KECAMATAN = '$penghargaan_kecamatan',
        PENGHARGAAN_KAB_KOTA = '$penghargaan_kab_kota',
        PENGHARGAAN_PROVINSI = '$penghargaan_provinsi',
        PENGHARGAAN_NASIONAL = '$penghargaan_nasional',
        PENGHARGAAN_INTERNASIONAL = '$penghargaan_internasional'
        WHERE ID_SISWA = '$id_siswa_login'");

    // Cek apakah query berhasil dijalankan
    if ($query_update) {
        echo "<script>alert('Data siswa berhasil diubah.'); window.location.href='index.php?ke=datasiswa';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat mengubah data siswa: " . mysqli_error($conn) . "');</script>";
    }
}

// Proses update data jika form disubmit
if (isset($_POST['ubahdataortu'])) {
    // Ambil semua nilai dari form
    $nama_ayah = mysqli_real_escape_string($conn, $_POST['NAMA_AYAH']);
    $tempat_lahir_ayah = mysqli_real_escape_string($conn, $_POST['TEMPAT_LAHIR_AYAH']);
    $tgl_lahir_ayah = mysqli_real_escape_string($conn, $_POST['TGL_LAHIR_AYAH']);
    $pendidikan_terakhir_ayah = mysqli_real_escape_string($conn, $_POST['PENDIDIKAN_TERAKHIR_AYAH']);
    $agama_ayah = mysqli_real_escape_string($conn, $_POST['AGAMA_AYAH']); // Menambahkan agama ayah
    $pekerjaan_ayah = mysqli_real_escape_string($conn, $_POST['PEKERJAAN_AYAH']);
    $kode_pos_ayah = mysqli_real_escape_string($conn, $_POST['KODE_POS_AYAH']);
    $telepon_ayah = mysqli_real_escape_string($conn, $_POST['TELEPON_AYAH']);
    $alamat_rumah_ayah = mysqli_real_escape_string($conn, $_POST['ALAMAT_RUMAH_AYAH']);

    $nama_ibu = mysqli_real_escape_string($conn, $_POST['NAMA_IBU']);
    $tempat_lahir_ibu = mysqli_real_escape_string($conn, $_POST['TEMPAT_LAHIR_IBU']);
    $tgl_lahir_ibu = mysqli_real_escape_string($conn, $_POST['TGL_LAHIR_IBU']);
    $pendidikan_terakhir_ibu = mysqli_real_escape_string($conn, $_POST['PENDIDIKAN_TERAKHIR_IBU']);
    $agama_ibu = mysqli_real_escape_string($conn, $_POST['AGAMA_IBU']); // Mengambil agama ibu
    $pekerjaan_ibu = mysqli_real_escape_string($conn, $_POST['PEKERJAAN_IBU']);
    $kode_pos_ibu = mysqli_real_escape_string($conn, $_POST['KODE_POS_IBU']);
    $telepon_ibu = mysqli_real_escape_string($conn, $_POST['TELEPON_IBU']);
    $alamat_rumah_ibu = mysqli_real_escape_string($conn, $_POST['ALAMAT_RUMAH_IBU']);


    $nama_wali = mysqli_real_escape_string($conn, $_POST['NAMA_WALI']);
    $tempat_lahir_wali = mysqli_real_escape_string($conn, $_POST['TEMPAT_LAHIR_WALI']);
    $tgl_lahir_wali = mysqli_real_escape_string($conn, $_POST['TGL_LAHIR_WALI']);
    $pendidikan_terakhir_wali = mysqli_real_escape_string($conn, $_POST['PENDIDIKAN_TERAKHIR_WALI']);
    $agama_wali = mysqli_real_escape_string($conn, $_POST['AGAMA_WALI']); // Menambahkan agama wali
    $pekerjaan_wali = mysqli_real_escape_string($conn, $_POST['PEKERJAAN_WALI']);
    $kode_pos_wali = mysqli_real_escape_string($conn, $_POST['KODE_POS_WALI']);
    $telepon_wali = mysqli_real_escape_string($conn, $_POST['TELEPON_WALI']);
    // Perbaiki baris berikut dengan pemeriksaan isset()
    $hubungan_wali = isset($_POST['HUBUNGAN_WALI']) ? mysqli_real_escape_string($conn, $_POST['HUBUNGAN_WALI']) : '';
    $alamat_rumah_wali = mysqli_real_escape_string($conn, $_POST['ALAMAT_RUMAH_WALI']);
    $tgl_ubah1= date('Y-m-d H:i:s');

    // Query untuk mengupdate data orang tua dan wali
    $query_update = mysqli_query($conn, "UPDATE dataortu_wali SET
        NAMA_AYAH = '$nama_ayah',
        TEMPAT_LAHIR_AYAH = '$tempat_lahir_ayah',
        TGL_LAHIR_AYAH = '$tgl_lahir_ayah',
        PENDIDIKAN_TERAKHIR_AYAH = '$pendidikan_terakhir_ayah',
        AGAMA_AYAH = '$agama_ayah',
        PEKERJAAN_AYAH = '$pekerjaan_ayah',
        KODE_POS_AYAH = '$kode_pos_ayah',
        TELEPON_AYAH = '$telepon_ayah',
        ALAMAT_RUMAH_AYAH = '$alamat_rumah_ayah',
        NAMA_IBU = '$nama_ibu',
        TEMPAT_LAHIR_IBU = '$tempat_lahir_ibu',
        TGL_LAHIR_IBU = '$tgl_lahir_ibu',
        PENDIDIKAN_TERAKHIR_IBU = '$pendidikan_terakhir_ibu',
        AGAMA_IBU = '$agama_ibu',
        PEKERJAAN_IBU = '$pekerjaan_ibu',
        KODE_POS_IBU = '$kode_pos_ibu',
        TELEPON_IBU = '$telepon_ibu',
        ALAMAT_RUMAH_IBU = '$alamat_rumah_ibu',
        NAMA_WALI = '$nama_wali',
        TEMPAT_LAHIR_WALI = '$tempat_lahir_wali',
        TGL_LAHIR_WALI = '$tgl_lahir_wali',
        PENDIDIKAN_TERAKHIR_WALI = '$pendidikan_terakhir_wali',
        AGAMA_WALI = '$agama_wali',
        PEKERJAAN_WALI = '$pekerjaan_wali',
        KODE_POS_WALI = '$kode_pos_wali',
        TELEPON_WALI = '$telepon_wali',
        HUBUNGAN_WALI = '$hubungan_wali',
        ALAMAT_RUMAH_WALI = '$alamat_rumah_wali',
        TGL_UBAH1 = '$tgl_ubah1'
        WHERE ID_SISWA = '$id_siswa_login'"); // Pastikan ada klausa WHERE untuk mengupdate data siswa yang benar

    // Cek apakah query berhasil dijalankan
    if ($query_update) {
        echo "<script>alert('Data orang tua dan wali berhasil diubah.'); window.location.href='index.php?ke=datasiswa';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat mengubah data orang tua dan wali: " . mysqli_error($conn) . "');</script>";
    }
}

// Query untuk mengambil data siswa berdasarkan ID yang login
$query_detail = mysqli_query($conn, "SELECT * FROM datasiswa WHERE ID_SISWA = '$id_siswa_login'");
$data_siswa = mysqli_fetch_assoc($query_detail);

// Direktori penyimpanan dokumen
$upload_dir = 'Master Data/dokumen/'; // Sesuaikan path jika perlu

// Query untuk mengambil data dokumen siswa berdasarkan ID yang login
$query_dokumen = mysqli_query($conn, "SELECT * FROM dokumen WHERE ID_SISWA = '$id_siswa_login'");
$data_dokumen = mysqli_fetch_assoc($query_dokumen);

// Query untuk mengambil data orang tua dan wali berdasarkan ID yang login
$query_detail_ortu = mysqli_query($conn, "SELECT * FROM dataortu_wali WHERE ID_SISWA = '$id_siswa_login'");
$data_ortu_wali = mysqli_fetch_assoc($query_detail_ortu);


// Menampilkan form dengan data yang ada
?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Siswa</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li style="margin-right:15px;"><a href="index.php?ke=dashboard" class="btn icon icon-left btn-primary"><svg fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
                        Kembali</a></li>
                        <li style="margin-right:15px;"><a href="Master Data\Siswa\cetak.php" class="btn icon icon-left btn-warning"><svg fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M128 0C92.7 0 64 28.7 64 64l0 96 64 0 0-96 226.7 0L384 93.3l0 66.7 64 0 0-66.7c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0L128 0zM384 352l0 32 0 64-256 0 0-64 0-16 0-16 256 0zm64 32l32 0c17.7 0 32-14.3 32-32l0-96c0-35.3-28.7-64-64-64L64 192c-35.3 0-64 28.7-64 64l0 96c0 17.7 14.3 32 32 32l32 0 0 64c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-64zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
                        Cetak PDF</a></li>
                        <li><a href="Master Data\Siswa\cetak_excel.php" class="btn icon icon-left btn-success"><svg fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M128 0C92.7 0 64 28.7 64 64l0 96 64 0 0-96 226.7 0L384 93.3l0 66.7 64 0 0-66.7c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0L128 0zM384 352l0 32 0 64-256 0 0-64 0-16 0-16 256 0zm64 32l32 0c17.7 0 32-14.3 32-32l0-96c0-35.3-28.7-64-64-64L64 192c-35.3 0-64 28.7-64 64l0 96c0 17.7 14.3 32 32 32l32 0 0 64c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-64zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
                        Cetak EXCEL</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Siswa</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <?php if ($data_siswa): ?>
                                <form class="form" method="POST">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="nama-lengkap-column">Nama lengkap</label>
                                                <input type="text" id="nama-lengkap-column" class="form-control" name="NAMA_LENGKAP" value="<?php echo $data_siswa['NAMA_LENGKAP']; ?>" required minlength="10">                                              <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="nama-panggilan-column">Nama Panggilan</label>
                                                <input type="text" id="nama-panggilan-column" class="form-control" name="NAMA_PANGGILAN" value="<?php echo $data_siswa['NAMA_PANGGILAN']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="tempat-lahir-column">Tempat Lahir</label>
                                                <input type="text" id="tempat-lahir-column" class="form-control" name="TEMPAT_LAHIR" value="<?php echo $data_siswa['TEMPAT_LAHIR']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="tgl-lahir-column">Tanggal Lahir</label>
                                                <input type="date" id="tgl-lahir-column" class="form-control" name="TGL_LAHIR" value="<?php echo $data_siswa['TGL_LAHIR']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="jenis-kelamin-column">Jenis Kelamin</label>
                                                <input type="text" id="jenis-kelamin-column" class="form-control" name="JENIS_KELAMIN" value="<?php echo $data_siswa['JENIS_KELAMIN']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="agama-column">Agama</label>
                                                <input type="text" id="agama-column" class="form-control" name="AGAMA" value="<?php echo $data_siswa['AGAMA']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="tinggi-badan-column">Tinggi Badan (cm)</label>
                                                <input type="text" id="tinggi-badan-column" class="form-control" name="TINGGI_BADAN" value="<?php echo $data_siswa['TINGGI_BADAN']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="berat-badan-column">Berat Badan (kg)</label>
                                                <input type="text" id="berat-badan-column" class="form-control" name="BERAT_BADAN" value="<?php echo $data_siswa['BERAT_BADAN']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="panjang-tangan-column">Panjang Tangan (cm)</label>
                                                <input type="text" id="panjang-tangan-column" class="form-control" name="PANJANG_TANGAN" value="<?php echo $data_siswa['PANJANG_TANGAN']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="panjang-kaki-column">Panjang Kaki (cm)</label>
                                                <input type="text" id="panjang-kaki-column" class="form-control" name="PANJANG_KAKI" value="<?php echo $data_siswa['PANJANG_KAKI']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                        <div class="form-group">
                                                <label for="alamat-rumah-column">Alamat Rumah</label>
                                                <input type="text" id="alamat-rumah-column" class="form-control" name="ALAMAT_RUMAH" value="<?php echo $data_siswa['ALAMAT_RUMAH']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="kode-pos-rumah-column">Kode Pos</label>
                                                <input type="text" id="kode-pos-rumah-column" class="form-control" name="KODE_POS_RUMAH" value="<?php echo $data_siswa['KODE_POS_RUMAH']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="telepon-rumah-column">Nomor Telepon</label>
                                                <input type="text" id="telepon-rumah-column" class="form-control" name="TELEPON_RUMAH" value="<?php echo $data_siswa['TELEPON_RUMAH']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="asal-sekolah-column">Asal Sekolah</label>
                                                <input type="text" id="asal-sekolah-column" class="form-control" name="ASAL_SEKOLAH" value="<?php echo $data_siswa['ASAL_SEKOLAH']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="kelas-jurusan-column">Kelas / Jurusan</label>
                                                <input type="text" id="kelas-jurusan-column" class="form-control" name="KELAS_JURUSAN" value="<?php echo $data_siswa['KELAS_JURUSAN']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="alamat-sekolah-column">Alamat Sekolah</label>
                                                <input type="text" id="alamat-sekolah-column" class="form-control" name="ALAMAT_SEKOLAH" value="<?php echo $data_siswa['ALAMAT_SEKOLAH']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="kode-pos-sekolah-column">Kode Pos</label>
                                                <input type="text" id="kode-pos-sekolah-column" class="form-control" name="KODE_POS_SEKOLAH" value="<?php echo $data_siswa['KODE_POS_SEKOLAH']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="telepon-sekolah-column">Nomor Telepon</label>
                                                <input type="text" id="telepon-sekolah-column" class="form-control" name="TELEPON_SEKOLAH" value="<?php echo $data_siswa['TELEPON_SEKOLAH']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                            <label for="hobi-column">Hobi</label>
                                                <input type="text" id="hobi-column" class="form-control" name="HOBI" value="<?php echo $data_siswa['HOBI']; ?>">
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="keterampilan-khusus-column">Keterampilan Khusus</label>
                                                <input type="text" id="keterampilan-khusus-column" class="form-control" name="KETERAMPILAN_KHUSUS" value="<?php echo $data_siswa['KETERAMPILAN_KHUSUS']; ?>">
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="penghargaan-sekolah-column">Penghargaan Sekolah</label>
                                                <input type="text" id="penghargaan-sekolah-column" class="form-control" name="PENGHARGAAN_SEKOLAH" value="<?php echo $data_siswa['PENGHARGAAN_SEKOLAH']; ?>">
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="penghargaan-kecamatan-column">Penghargaan Kecamatan</label>
                                                <input type="text" id="penghargaan-kecamatan-column" class="form-control" name="PENGHARGAAN_KECAMATAN" value="<?php echo $data_siswa['PENGHARGAAN_KECAMATAN']; ?>">
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="penghargaan-kab-kota-column">Penghargaan Kab/Kota</label>
                                                <input type="text" id="penghargaan-kab-kota-column" class="form-control" name="PENGHARGAAN_KAB_KOTA" value="<?php echo $data_siswa['PENGHARGAAN_KAB_KOTA']; ?>">
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="penghargaan-provinsi-column">Penghargaan Provinsi</label>
                                                <input type="text" id="penghargaan-provinsi-column" class="form-control" name="PENGHARGAAN_PROVINSI" value="<?php echo $data_siswa['PENGHARGAAN_PROVINSI']; ?>">
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="penghargaan-nasional-column">Penghargaan Nasional</label>
                                                <input type="text" id="penghargaan-nasional-column" class="form-control" name="PENGHARGAAN_NASIONAL" value="<?php echo $data_siswa['PENGHARGAAN_NASIONAL']; ?>">
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="penghargaan-internasional-column">Penghargaan Internasional</label>
                                                <input type="text" id="penghargaan-internasional-column" class="form-control" name="PENGHARGAAN_INTERNASIONAL" value="<?php echo $data_siswa['PENGHARGAAN_INTERNASIONAL']; ?>">
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="tgl-buat-column">Tanggal Buat</label>
                                                <input type="text" id="tgl-buat-column" class="form-control" name="TGL_BUAT" value="<?php echo $data_siswa['TGL_BUAT']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="tgl-ubah-column">Tanggal Ubah</label>
                                                <input type="text" id="tgl-ubah-column" class="form-control" name="TGL_UBAH" value="<?php echo $data_siswa['TGL_UBAH']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1" name="ubahdata">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            <?php else: ?>
                                <p>Data siswa tidak ditemukan.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Ayah Kandung</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST">
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="nama-ayah-column">Nama Ayah</label>
                                            <input type="text" id="nama-ayah-column" class="form-control" name="NAMA_AYAH" value="<?php echo $data_ortu_wali['NAMA_AYAH']; ?>" required>
                                            <div class="valid-feedback">Bagus!</div>
                                            <div class="invalid-feedback">Wajib Diisi!</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="tempat-lahir-ayah-column">Tempat Lahir</label>
                                            <input type="text" id="tempat-lahir-ayah-column" class="form-control" name="TEMPAT_LAHIR_AYAH" value="<?php echo $data_ortu_wali['TEMPAT_LAHIR_AYAH']; ?>" required>
                                            <div class="valid-feedback">Bagus!</div>
                                            <div class="invalid-feedback">Wajib Diisi!</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="tgl-lahir-ayah-column">Tanggal Lahir</label>
                                            <input type="date" id="tgl-lahir-ayah-column" class="form-control" name="TGL_LAHIR_AYAH" value="<?php echo $data_ortu_wali['TGL_LAHIR_AYAH']; ?>" required>
                                            <div class="valid-feedback">Bagus!</div>
                                            <div class="invalid-feedback">Wajib Diisi!</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="pendidikan-terakhir-ayah-column">Pendidikan Terakhir</label>
                                            <select class="form-control" id="pendidikan-terakhir-ayah-column" name="PENDIDIKAN_TERAKHIR_AYAH" required>
                                                <option value="">-- Pilih Pendidikan Terakhir --</option>
                                                <option value="SD" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_AYAH'] == 'SD') ? 'selected' : ''; ?>>Sekolah Dasar (SD)</option>
                                                <option value="SMP" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_AYAH'] == 'SMP') ? 'selected' : ''; ?>>Sekolah Menengah Pertama (SMP)</option>
                                                <option value="SMA/SMK" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_AYAH'] == 'SMA/SMK') ? 'selected' : ''; ?>>Sekolah Menengah Atas (SMA) / Sekolah Menengah Kejuruan (SMK)</option>
                                                <option value="D1" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_AYAH'] == 'D1') ? 'selected' : ''; ?>>Diploma 1 (D1)</option>
                                                <option value="D2" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_AYAH'] == 'D2') ? 'selected' : ''; ?>>Diploma 2 (D2)</option>
                                                <option value="D3" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_AYAH'] == 'D3') ? 'selected' : ''; ?>>Diploma 3 (D3)</option>
                                                <option value="D4/S1" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_AYAH'] == 'D4/S1') ? 'selected' : ''; ?>>Diploma 4 (D4) / Sarjana (S1)</option>
                                                <option value="S2" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_AYAH'] == 'S2') ? 'selected' : ''; ?>>Magister (S2)</option>
                                                <option value="S3" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_AYAH'] == 'S3') ? 'selected' : ''; ?>>Doktor (S3)</option>
                                                <option value="Lainnya" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_AYAH'] == 'Lainnya') ? 'selected' : ''; ?>>Lainnya</option>
                                            </select>
                                            <div class="valid-feedback">Bagus!</div>
                                            <div class="invalid-feedback">Wajib Diisi!</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="AGAMA_AYAH">Agama</label>
                                            <select class="form-control" id="AGAMA_AYAH" name="AGAMA_AYAH" required>
                                                <option value=""> ~~~ Pilih Agama ~~~ </option>
                                                <option value="Islam" <?php echo ($data_ortu_wali['AGAMA_AYAH'] == 'Islam') ? 'selected' : ''; ?>>Islam</option>
                                                <option value="Kristen Protestan" <?php echo ($data_ortu_wali['AGAMA_AYAH'] == 'Kristen Protestan') ? 'selected' : ''; ?>>Kristen Protestan</option>
                                                <option value="Kristen Katolik" <?php echo ($data_ortu_wali['AGAMA_AYAH'] == 'Kristen Katolik') ? 'selected' : ''; ?>>Kristen Katolik</option>
                                                <option value="Hindu" <?php echo ($data_ortu_wali['AGAMA_AYAH'] == 'Hindu') ? 'selected' : ''; ?>>Hindu</option>
                                                <option value="Buddha" <?php echo ($data_ortu_wali['AGAMA_AYAH'] == 'Buddha') ? 'selected' : ''; ?>>Buddha</option>
                                                <option value="Konghucu" <?php echo ($data_ortu_wali['AGAMA_AYAH'] == 'Konghucu') ? 'selected' : ''; ?>>Konghucu</option>
                                            </select>
                                            <div class="valid-feedback"> Bagus! </div>
                                            <div class="invalid-feedback"> Wajib Diisi! </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="pekerjaan-ayah-column">Pekerjaan</label>
                                            <input type="text" id="pekerjaan-ayah-column" class="form-control" name="PEKERJAAN_AYAH" value="<?php echo $data_ortu_wali['PEKERJAAN_AYAH']; ?>" required>
                                            <div class="valid-feedback">Bagus!</div>
                                            <div class="invalid-feedback">Wajib Diisi!</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="kode-pos-ayah-column">Kode Pos</label>
                                            <input type="number" id="kode-pos-ayah-column" class="form-control" name="KODE_POS_AYAH" value="<?php echo $data_ortu_wali['KODE_POS_AYAH']; ?>" required>
                                            <div class="valid-feedback">Bagus!</div>
                                            <div class="invalid-feedback">Wajib Diisi!</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="telepon-ayah-column">Nomor Telepon</label>
                                            <input type="number" id="telepon-ayah-column" class="form-control" name="TELEPON_AYAH" value="<?php echo $data_ortu_wali['TELEPON_AYAH']; ?>" required>
                                            <div class="valid-feedback">Bagus!</div>
                                            <div class="invalid-feedback">Wajib Diisi!</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="alamat-rumah-ayah-column">Alamat Rumah</label>
                                            <textarea id="alamat-rumah-ayah-column" class="form-control" name="ALAMAT_RUMAH_AYAH" required style="height:80px"><?php echo $data_ortu_wali['ALAMAT_RUMAH_AYAH']; ?></textarea>
                                            <div class="valid-feedback">Bagus!</div>
                                            <div class="invalid-feedback">Wajib Diisi!</div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-header">
                                    <h4 class="card-title">Data Ibu Kandung</h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="NAMA_IBU">Nama Ibu</label>
                                                <input type="text" id="NAMA_IBU" class="form-control" name="NAMA_IBU" value="<?php echo $data_ortu_wali['NAMA_IBU']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                                <div class="invalid-feedback">Wajib Diisi!</div>
                                            </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="tempat-lahir-ibu-column">Tempat Lahir</label>
                                                <input type="text" id="tempat-lahir-ibu-column" class="form-control" name="TEMPAT_LAHIR_IBU" value="<?php echo $data_ortu_wali['TEMPAT_LAHIR_IBU']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                                <div class="invalid-feedback">Wajib Diisi!</div>
                                            </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="tgl-lahir-ibu-column">Tanggal Lahir</label>
                                                <input type="date" id="tgl-lahir-ibu-column" class="form-control" name="TGL_LAHIR_IBU" value="<?php echo $data_ortu_wali['TGL_LAHIR_IBU']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                                <div class="invalid-feedback">Wajib Diisi!</div>
                                            </div>
                                    </div>
                                    <div class="col-md-6 ">
                                            <div class="form-group">
                                                <label for="PENDIDIKAN_TERAKHIR_IBU">Pendidikan Terakhir</label>
                                                <select class="form-control" id="PENDIDIKAN_TERAKHIR_IBU" name="PENDIDIKAN_TERAKHIR_IBU" required>
                                                    <option value="">-- Pilih Pendidikan Terakhir --</option>
                                                    <option value="SD" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_IBU'] == 'SD') ? 'selected' : ''; ?>>Sekolah Dasar (SD)</option>
                                                    <option value="SMP" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_IBU'] == 'SMP') ? 'selected' : ''; ?>>Sekolah Menengah Pertama (SMP)</option>
                                                    <option value="SMA/SMK" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_IBU'] == 'SMA/SMK') ? 'selected' : ''; ?>>Sekolah Menengah Atas (SMA) / Sekolah Menengah Kejuruan (SMK)</option>
                                                    <option value="D1" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_IBU'] == 'D1') ? 'selected' : ''; ?>>Diploma 1 (D1)</option>
                                                    <option value="D2" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_IBU'] == 'D2') ? 'selected' : ''; ?>>Diploma 2 (D2)</option>
                                                    <option value="D3" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_IBU'] == 'D3') ? 'selected' : ''; ?>>Diploma 3 (D3)</option>
                                                    <option value="D4/S1" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_IBU'] == 'D4/S1') ? 'selected' : ''; ?>>Diploma 4 (D4) / Sarjana (S1)</option>
                                                    <option value="S2" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_IBU'] == 'S2') ? 'selected' : ''; ?>>Magister (S2)</option>
                                                    <option value="S3" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_IBU'] == 'S3') ? 'selected' : ''; ?>>Doktor (S3)</option>
                                                    <option value="Lainnya" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_IBU'] == 'Lainnya') ? 'selected' : ''; ?>>Lainnya</option>
                                                </select>
                                                <div class="valid-feedback">Bagus!</div>
                                                <div class="invalid-feedback">Wajib Diisi!</div>
                                            </div>
                                    </div>
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="AGAMA_IBU">Agama</label>
                                                <select class="form-control" id="AGAMA_IBU" name="AGAMA_IBU" required>
                                                    <option value=""> ~~~ Pilih Agama ~~~ </option>
                                                    <option value="Islam" <?php echo ($data_ortu_wali['AGAMA_IBU'] == 'Islam') ? 'selected' : ''; ?>>Islam</option>
                                                    <option value="Kristen Protestan" <?php echo ($data_ortu_wali['AGAMA_IBU'] == 'Kristen Protestan') ? 'selected' : ''; ?>>Kristen Protestan</option>
                                                    <option value="Kristen Katolik" <?php echo ($data_ortu_wali['AGAMA_IBU'] == 'Kristen Katolik') ? 'selected' : ''; ?>>Kristen Katolik</option>
                                                    <option value="Hindu" <?php echo ($data_ortu_wali['AGAMA_IBU'] == 'Hindu') ? 'selected' : ''; ?>>Hindu</option>
                                                    <option value="Buddha" <?php echo ($data_ortu_wali['AGAMA_IBU'] == 'Buddha') ? 'selected' : ''; ?>>Buddha</option>
                                                    <option value="Konghucu" <?php echo ($data_ortu_wali['AGAMA_IBU'] == 'Konghucu') ? 'selected' : ''; ?>>Konghucu</option>
                                                </select>
                                                <div class="valid-feedback"> Bagus! </div>
                                                <div class="invalid-feedback"> Wajib Diisi! </div>
                                            </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="pekerjaan-ibu-column">Pekerjaan</label>
                                                <input type="text" id="pekerjaan-ibu-column" class="form-control" name="PEKERJAAN_IBU" value="<?php echo $data_ortu_wali                                            ['PEKERJAAN_IBU']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                                <div class="invalid-feedback">Wajib Diisi!</div>
                                            </div>                                       
                                    </div>
                                    <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="kode-pos-ibu-column">Kode Pos</label>
                                                <input type="number" id="kode-pos-ibu-column" class="form-control" name="KODE_POS_IBU" value="<?php echo $data_ortu_wali['KODE_POS_IBU']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                                <div class="invalid-feedback">Wajib Diisi!</div>
                                            </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="telepon-ibu-column">Nomor Telepon</label>
                                                <input type="number" id="telepon-ibu-column" class="form-control" name="TELEPON_IBU" value="<?php echo $data_ortu_wali['TELEPON_IBU']; ?>" required>
                                                <div class="valid-feedback">Bagus!</div>
                                                <div class="invalid-feedback">Wajib Diisi!</div>
                                            </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="alamat-rumah-ibu-column">Alamat Rumah</label>
                                                <textarea id="alamat-rumah-ibu-column" class="form-control" name="ALAMAT_RUMAH_IBU" required style="height:80px"><?php echo $data_ortu_wali['ALAMAT_RUMAH_IBU']; ?></textarea>
                                                <div class="valid-feedback">Bagus!</div>
                                                <div class="invalid-feedback">Wajib Diisi!</div>
                                            </div>
                                    </div>
                                <hr>
                                <div class="card-header">
                                    <h4 class="card-title">Data Wali</h4>
                                </div>
                                <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="nama-wali-column">Nama Wali</label>
                                                    <input type="text" id="nama-wali-column" class="form-control" name="NAMA_WALI" value="<?php echo $data_ortu_wali['NAMA_WALI']; ?>" >
                                                    <div class="valid-feedback">Bagus!</div>
                                                    <div class="invalid-feedback">Wajib Diisi!</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="tempat-lahir-wali-column">Tempat Lahir</label>
                                                    <input type="text" id="tempat-lahir-wali-column" class="form-control" name="TEMPAT_LAHIR_WALI" value="<?php echo $data_ortu_wali['TEMPAT_LAHIR_WALI']; ?>" >
                                                    <div class="valid-feedback">Bagus!</div>
                                                    <div class="invalid-feedback">Wajib Diisi!</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="tgl-lahir-wali-column">Tanggal Lahir</label>
                                                    <input type="date" id="tgl-lahir-wali-column" class="form-control" name="TGL_LAHIR_WALI" value="<?php echo $data_ortu_wali['TGL_LAHIR_WALI']; ?>" >
                                                    <div class="valid-feedback">Bagus!</div>
                                                    <div class="invalid-feedback">Wajib Diisi!</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                <label for="pendidikan-terakhir-wali-column">Pendidikan Terakhir</label>
                                                    <select class="form-control" id="pendidikan-terakhir-wali-column" name="PENDIDIKAN_TERAKHIR_WALI" >
                                                        <option value="">-- Pilih Pendidikan Terakhir --</option>
                                                        <option value="SD" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_WALI'] == 'SD') ? 'selected' : ''; ?>>Sekolah Dasar (SD)</option>
                                                        <option value="SMP" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_WALI'] == 'SMP') ? 'selected' : ''; ?>>Sekolah Menengah Pertama (SMP)</option>
                                                        <option value="SMA/SMK" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_WALI'] == 'SMA/SMK') ? 'selected' : ''; ?>>Sekolah Menengah Atas (SMA) / Sekolah Menengah Kejuruan (SMK)</option>
                                                        <option value="D1" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_WALI'] == 'D1') ? 'selected' : ''; ?>>Diploma 1 (D1)</option>
                                                        <option value="D2" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_WALI'] == 'D2') ? 'selected' : ''; ?>>Diploma 2 (D2)</option>
                                                        <option value="D3" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_WALI'] == 'D3') ? 'selected' : ''; ?>>Diploma 3 (D3)</option>
                                                        <option value="D4/S1" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_WALI'] == 'D4/S1') ? 'selected' : ''; ?>>Diploma 4 (D4) / Sarjana (S1)</option>
                                                        <option value="S2" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_WALI'] == 'S2') ? 'selected' : ''; ?>>Magister (S2)</option>
                                                        <option value="S3" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_WALI'] == 'S3') ? 'selected' : ''; ?>>Doktor (S3)</option>
                                                        <option value="Lainnya" <?php echo ($data_ortu_wali['PENDIDIKAN_TERAKHIR_WALI'] == 'Lainnya') ? 'selected' : ''; ?>>Lainnya</option>
                                                    </select>
                                                    <div class="valid-feedback">Bagus!</div>
                                                    <div class="invalid-feedback">Wajib Diisi!</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="AGAMA_WALI">Agama</label>
                                                    <select class="form-control" id="AGAMA_WALI" name="AGAMA_WALI" >
                                                        <option value=""> ~~~ Pilih Agama ~~~ </option>
                                                        <option value="Islam" <?php echo ($data_ortu_wali['AGAMA_WALI'] == 'Islam') ? 'selected' : ''; ?>>Islam</option>
                                                        <option value="Kristen Protestan" <?php echo ($data_ortu_wali['AGAMA_WALI'] == 'Kristen Protestan') ? 'selected' : ''; ?>>Kristen Protestan</option>
                                                        <option value="Kristen Katolik" <?php echo ($data_ortu_wali['AGAMA_WALI'] == 'Kristen Katolik') ? 'selected' : ''; ?>>Kristen Katolik</option>
                                                        <option value="Hindu" <?php echo ($data_ortu_wali['AGAMA_WALI'] == 'Hindu') ? 'selected' : ''; ?>>Hindu</option>
                                                        <option value="Buddha" <?php echo ($data_ortu_wali['AGAMA_WALI'] == 'Buddha') ? 'selected' : ''; ?>>Buddha</option>
                                                        <option value="Konghucu" <?php echo ($data_ortu_wali['AGAMA_WALI'] == 'Konghucu') ? 'selected' : ''; ?>>Konghucu</option>
                                                    </select>
                                                    <div class="valid-feedback"> Bagus! </div>
                                                    <div class="invalid-feedback"> Wajib Diisi! </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="pekerjaan-wali-column">Pekerjaan</label>
                                                    <input type="text" id="pekerjaan-wali-column" class="form-control" name="PEKERJAAN_WALI" value="<?php echo $data_ortu_wali['PEKERJAAN_WALI']; ?>" >
                                                    <div class="valid-feedback">Bagus!</div>
                                                    <div class="invalid-feedback">Wajib Diisi!</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="kode-pos-wali-column">Kode Pos</label>
                                                    <input type="number" id="kode-pos-wali-column" class="form-control" name="KODE_POS_WALI" value="<?php echo $data_ortu_wali['KODE_POS_WALI']; ?>" >
                                                    <div class="valid-feedback">Bagus!</div>
                                                    <div class="invalid-feedback">Wajib Diisi!</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="telepon-wali-column">Nomor Telepon</label>
                                                    <input type="number" id="telepon-wali-column" class="form-control" name="TELEPON_WALI" value="<?php echo $data_ortu_wali['TELEPON_WALI']; ?>">
                                                    <div class="valid-feedback">Bagus!</div>
                                                    <div class="invalid-feedback">Wajib Diisi!</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="hubungan-wali-column">Hubungan dengan Siswa</label>
                                                    <input type="text" id="hubungan-wali-column" class="form-control" name="HUBUNGAN_WALI" value="<?php echo $data_ortu_wali['HUBUNGAN_WALI']; ?>">
                                                    <div class="valid-feedback">Bagus!</div>
                                                    <div class="invalid-feedback">Wajib Diisi!</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="alamat-rumah-wali-column">Alamat Rumah</label>
                                                    <textarea id="alamat-rumah-wali-column" class="form-control" name="ALAMAT_RUMAH_WALI"  style="height:80px"><?php echo $data_ortu_wali['ALAMAT_RUMAH_WALI']; ?></textarea>
                                                    <div class="valid-feedback">Bagus!</div>
                                                    <div class="invalid-feedback">Wajib Diisi!</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="tgl-buat-column">Tanggal Buat</label>
                                                    <input type="text" id="tgl-buat-column" class="form-control" name="TGL_BUAT1" value="<?php echo $data_ortu_wali['TGL_BUAT1']; ?>" required>
                                                    <div class="valid-feedback">Bagus!</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="tgl-ubah-column">Tanggal Ubah</label>
                                                    <input type="text" id="tgl-ubah-column" class="form-control" name="TGL_UBAH1" value="<?php echo $data_ortu_wali['TGL_UBAH1']; ?>" required>
                                                    <div class="valid-feedback">Bagus!</div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1" name="ubahdataortu">Submit</button>
                                            </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Siswa (Dokumen)</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" method="POST" enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="row">
                                      <div class="buttons">
                                          <a href="<?php echo $upload_dir . (isset($data_dokumen['AKTA']) ? $data_dokumen['AKTA'] : 'AKTA_' . $id_siswa_login . '.pdf && .docx'); ?>" target="_blank" class="btn btn-primary rounded-pill btn-lg <?php echo (empty($data_dokumen['AKTA']) ?  : ''); ?>">
                                              Show Akta Kelahiran
                                          </a>
                                          <a href="<?php echo $upload_dir . (isset($data_dokumen['KARTU_KELUARGA']) ? $data_dokumen['KARTU_KELUARGA'] : 'KARTU_KELUARGA_' . $id_siswa_login . '.jpg'); ?>" target="_blank" class="btn btn-secondary rounded-pill btn-lg <?php echo (empty($data_dokumen['KARTU_KELUARGA']) ? : ''); ?>">
                                              Show Kartu Keluarga
                                          </a>
                                          <a href="<?php echo $upload_dir . (isset($data_dokumen['IJAZAH']) ? $data_dokumen['IJAZAH'] : 'IJAZAH_' . $id_siswa_login . '.pdf'); ?>"
                                              target="_blank" class="btn btn-info rounded-pill btn-lg <?php echo (empty($data_dokumen['IJAZAH']) ?  : ''); ?>">
                                              Show Ijazah
                                          </a>
                                          <a href="<?php echo $upload_dir . (isset($data_dokumen['SKL']) ? $data_dokumen['SKL'] : 'SKL_' . $id_siswa_login . '.pdf'); ?>"
                                              target="_blank" class="btn btn-warning rounded-pill btn-lg <?php echo (empty($data_dokumen['SKL']) ?  : ''); ?>">
                                              Show SKL
                                          </a>
                                          <a href="<?php echo $upload_dir . (isset($data_dokumen['BUKU_PIP']) ? $data_dokumen['BUKU_PIP'] : 'BUKU_PIP_' . $id_siswa_login . '.pdf'); ?>"
                                              target="_blank" class="btn btn-danger rounded-pill btn-lg <?php echo (empty($data_dokumen['BUKU_PIP']) ? : ''); ?>">
                                              Show Buku PIP
                                          </a>
                                      </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

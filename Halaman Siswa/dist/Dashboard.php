<?php

// Periksa apakah siswa sudah login
if (!isset($_SESSION['ID_SISWA'])) {
    header('Location: ../../Login Siswa/index.php'); // Sesuaikan path jika perlu
    exit();
}

$ID_SISWA_LOGGED_IN = $_SESSION['ID_SISWA'];

// Sertakan file koneksi database
include '../../koneksi.php'; // Sesuaikan path jika perlu

// Fungsi untuk membersihkan input
function clean_input($data) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($data));
}

// Proses form saat disubmit
if (isset($_POST['tambahdata'])) {
    // Validasi dan sanitasi input
    $NAMA_AYAH = clean_input($_POST['NAMA_AYAH']);
    $TEMPAT_LAHIR_AYAH = clean_input($_POST['TEMPAT_LAHIR_AYAH']);
    $TGL_LAHIR_AYAH = clean_input($_POST['TGL_LAHIR_AYAH']);
    $PENDIDIKAN_TERAKHIR_AYAH = clean_input($_POST['PENDIDIKAN_TERAKHIR_AYAH']);
    $AGAMA_AYAH = clean_input($_POST['AGAMA_AYAH']);
    $PEKERJAAN_AYAH = clean_input($_POST['PEKERJAAN_AYAH']);
    $ALAMAT_RUMAH_AYAH = clean_input($_POST['ALAMAT_RUMAH_AYAH']);
    $KODE_POS_AYAH = clean_input($_POST['KODE_POS_AYAH']);
    $TELEPON_AYAH = clean_input($_POST['TELEPON_AYAH']);

    $NAMA_IBU = clean_input($_POST['NAMA_IBU']);
    $TEMPAT_LAHIR_IBU = clean_input($_POST['TEMPAT_LAHIR_IBU']);
    $TGL_LAHIR_IBU = clean_input($_POST['TGL_LAHIR_IBU']);
    $PENDIDIKAN_TERAKHIR_IBU = clean_input($_POST['PENDIDIKAN_TERAKHIR_IBU']);
    $AGAMA_IBU = clean_input($_POST['AGAMA_IBU']);
    $PEKERJAAN_IBU = clean_input($_POST['PEKERJAAN_IBU']);
    $ALAMAT_RUMAH_IBU = clean_input($_POST['ALAMAT_RUMAH_IBU']);
    $KODE_POS_IBU = clean_input($_POST['KODE_POS_IBU']);
    $TELEPON_IBU = clean_input($_POST['TELEPON_IBU']);

    $NAMA_WALI = clean_input($_POST['NAMA_WALI']);
    $TEMPAT_LAHIR_WALI = clean_input($_POST['TEMPAT_LAHIR_WALI']);
    $TGL_LAHIR_WALI = clean_input($_POST['TGL_LAHIR_WALI']);
    $PENDIDIKAN_TERAKHIR_WALI = clean_input($_POST['PENDIDIKAN_TERAKHIR_WALI']);
    $AGAMA_WALI = clean_input($_POST['AGAMA_WALI']);
    $PEKERJAAN_WALI = clean_input($_POST['PEKERJAAN_WALI']);
    $ALAMAT_RUMAH_WALI = clean_input($_POST['ALAMAT_RUMAH_WALI']);
    $KODE_POS_WALI = clean_input($_POST['KODE_POS_WALI']);
    $TELEPON_WALI = clean_input($_POST['TELEPON_WALI']);
    $HUBUNGAN_WALI = clean_input($_POST['HUBUNGAN_WALI']);
    $TGL_BUAT1 = date('Y-m-d H:i:s');

    $pesan = "";
    $berhasil = true; // Flag untuk menandakan apakah semua query berhasil

    // Fungsi untuk menjalankan query dan menangani kesalahan
    function jalankan_query($conn, $query) {
        if (mysqli_query($conn, $query)) {
            return "<div class='alert alert-success'>Data berhasil disimpan.</div>";
        } else {
            global $berhasil;
            $berhasil = false;
            return "<div class='alert alert-danger'>Terjadi kesalahan saat menyimpan data: " . mysqli_error($conn) . "</div>";
        }
    }

    // Query untuk menyimpan data ayah, ibu, dan wali dalam satu entri
    $query = "INSERT INTO dataortu_wali (ID_SISWA, NAMA_AYAH, TEMPAT_LAHIR_AYAH, TGL_LAHIR_AYAH, PENDIDIKAN_TERAKHIR_AYAH, AGAMA_AYAH, PEKERJAAN_AYAH, ALAMAT_RUMAH_AYAH, KODE_POS_AYAH, TELEPON_AYAH,
                NAMA_IBU, TEMPAT_LAHIR_IBU, TGL_LAHIR_IBU, PENDIDIKAN_TERAKHIR_IBU, AGAMA_IBU, PEKERJAAN_IBU, ALAMAT_RUMAH_IBU, KODE_POS_IBU, TELEPON_IBU,
                NAMA_WALI, TEMPAT_LAHIR_WALI, TGL_LAHIR_WALI, PENDIDIKAN_TERAKHIR_WALI, AGAMA_WALI, PEKERJAAN_WALI, ALAMAT_RUMAH_WALI, KODE_POS_WALI, TELEPON_WALI, HUBUNGAN_WALI,TGL_BUAT1) 
                VALUES ('$ID_SISWA_LOGGED_IN', '$NAMA_AYAH', '$TEMPAT_LAHIR_AYAH', '$TGL_LAHIR_AYAH', '$PENDIDIKAN_TERAKHIR_AYAH', '$AGAMA_AYAH', '$PEKERJAAN_AYAH', '$ALAMAT_RUMAH_AYAH', '$KODE_POS_AYAH', '$TELEPON_AYAH',
                '$NAMA_IBU', '$TEMPAT_LAHIR_IBU', '$TGL_LAHIR_IBU', '$PENDIDIKAN_TERAKHIR_IBU', '$AGAMA_IBU', '$PEKERJAAN_IBU', '$ALAMAT_RUMAH_IBU', '$KODE_POS_IBU', '$TELEPON_IBU',
                '$NAMA_WALI', '$TEMPAT_LAHIR_WALI', '$TGL_LAHIR_WALI', '$PENDIDIKAN_TERAKHIR_WALI', '$AGAMA_WALI', '$PEKERJAAN_WALI', '$ALAMAT_RUMAH_WALI', '$KODE_POS_WALI', '$TELEPON_WALI', '$HUBUNGAN_WALI','$TGL_BUAT1')";

    $pesan .= jalankan_query($conn, $query);

    // Simpan pesan ke session
    $_SESSION['pesan_ortu'] = $pesan;

    // Redirect hanya jika semua query berhasil
    if ($berhasil) {
        header("Location: ../index.php"); // Sesuaikan path jika perlu
        exit();
    }
}
?>

<div class="content-wrapper container">
    <div class="page-heading">
        <h3>SELAMAT DATANG DI WEBSITE KAMI <?php echo $_SESSION['namaSiswa'];?></h3>
    </div>
    <div class="page-content" style="margin-bottom:32%;">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-12 col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="accordion-container" id="accordion-container">
                                            <h2 class="accordion-title">INFORMASI PENGUMUMAN SISWA</h2>
                                            <p class="accordion-description">
                                                Klik pada setiap item di bawah ini untuk melengkapi data- data berikut :<br>Jika ada yang ditanyakan silahkan hubungi admin sekolah
                                                <ul><h6>1. Data - Data Orang Tua/ Wali </h6></ul>
                                                <ul><h6>2. Data Siswa (Dokumen)</h6>
                                                <li style="margin-left:40px;">Akta Kelahiran</li>
                                                <li style="margin-left:40px;">Kartu Keluarga</li>
                                                <li style="margin-left:40px;">Ijazah (bila sudah ada)</li>
                                                <li style="margin-left:40px;">Surat Keterangan Lulus (SKL)</li>
                                                <li style="margin-left:40px;">Buku PIP (bagi yang memiliki)</li>
                                                </ul> 
                                            </p>

                                            <div class="accordion-item accordion-item-blue">
                                                <button class="accordion-header" aria-expanded="true"
                                                    aria-controls="item1-content">
                                                    <b>DATA ORANG TUA / WALI</b>
                                                    <span class="accordion-icon"></span>
                                                </button>
                                                <div id="item1-content" class="accordion-content show">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="ID_SISWA"
                                                                    value="<?php echo $ID_SISWA_LOGGED_IN; ?>">

                                                                <div class="divider">
                                                                    <div class="divider-text mb-3">
                                                                        <label>Data Ayah Kandung</label>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Nama Ayah</label>
                                                                            <input type="text" class="form-control"
                                                                                name="NAMA_AYAH" required>
                                                                            <div class="valid-feedback">Bagus!</div>
                                                                            <div class="invalid-feedback">Wajib Diisi!</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Tempat Lahir</label>
                                                                            <input type="text" class="form-control"
                                                                                name="TEMPAT_LAHIR_AYAH" required>
                                                                            <div class="valid-feedback">Bagus!</div>
                                                                            <div class="invalid-feedback">Wajib Diisi!</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Tanggal Lahir</label>
                                                                            <input type="date" class="form-control"
                                                                                name="TGL_LAHIR_AYAH" required>
                                                                            <div class="valid-feedback">Bagus!</div>
                                                                            <div class="invalid-feedback">Wajib Diisi!</div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="PENDIDIKAN_TERAKHIR_AYAH">Pendidikan
                                                                                Terakhir</label>
                                                                            <select class="form-control"
                                                                                id="PENDIDIKAN_TERAKHIR_AYAH"
                                                                                name="PENDIDIKAN_TERAKHIR_AYAH" required>
                                                                                <option value="">-- Pilih Pendidikan
                                                                                    Terakhir --</option>
                                                                                <option value="SD">Sekolah Dasar (SD)</option>
                                                                                <option value="SMP">Sekolah Menengah Pertama
                                                                                    (SMP)</option>
                                                                                <option value="SMA/SMK">Sekolah Menengah Atas
                                                                                    (SMA) / Sekolah Menengah Kejuruan (SMK)
                                                                                </option>
                                                                                <option value="D1">Diploma 1 (D1)</option>
                                                                                <option value="D2">Diploma 2 (D2)</option>
                                                                                <option value="D3">Diploma 3 (D3)</option>
                                                                                <option value="D4/S1">Diploma 4 (D4) /
                                                                                    Sarjana (S1)</option>
                                                                                <option value="S2">Magister (S2)</option>
                                                                                <option value="S3">Doktor (S3)</option>
                                                                                <option value="Lainnya">Lainnya</option>
                                                                            </select>
                                                                            <div class="valid-feedback">Bagus!</div>
                                                                            <div class="invalid-feedback">Wajib Diisi!</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="AGAMA_AYAH">Agama</label>
                                                                            <select class="form-control" id="AGAMA_AYAH" name="AGAMA_AYAH" required>
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
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Pekerjaan</label>
                                                                            <input type="text" class="form-control"
                                                                                name="PEKERJAAN_AYAH" required>
                                                                            <div class="valid-feedback">Bagus!</div>
                                                                            <div class="invalid-feedback">Wajib Diisi!</div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Alamat Rumah</label>
                                                                            <textarea class="form-control"
                                                                                name="ALAMAT_RUMAH_AYAH" required
                                                                                style="height:80px"></textarea>
                                                                            <div class="valid-feedback">Bagus!</div>
                                                                            <div class="invalid-feedback">Wajib Diisi!</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Kode Pos</label>
                                                                            <input type="number" class="form-control"
                                                                                name="KODE_POS_AYAH" required>
                                                                            <div class="valid-feedback">Bagus!</div>
                                                                            <div class="invalid-feedback">Wajib Diisi!</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Nomor Telepon</label>
                                                                            <input type="number" class="form-control"
                                                                                name="TELEPON_AYAH" required>
                                                                            <div class="valid-feedback">Bagus!</div>
                                                                            <div class="invalid-feedback">Wajib Diisi!</div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="divider mt-4">
                                                                    <div class="divider-text mb-3">
                                                                        <label>Data Ibu Kandung</label>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Nama Ibu</label>
                                                                            <input type="text" class="form-control"
                                                                                name="NAMA_IBU" required>
                                                                            <div class="valid-feedback">Bagus!</div>
                                                                            <div class="invalid-feedback">Wajib Diisi!</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Tempat Lahir</label>
                                                                            <input type="text" class="form-control"
                                                                                name="TEMPAT_LAHIR_IBU" required>
                                                                            <div class="valid-feedback">Bagus!</div>
                                                                            <div class="invalid-feedback">Wajib Diisi!</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Tanggal Lahir</label>
                                                                            <input type="date" class="form-control"
                                                                                name="TGL_LAHIR_IBU" required>
                                                                            <div class="valid-feedback">Bagus!</div>
                                                                            <div class="invalid-feedback">Wajib Diisi!</div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="PENDIDIKAN_TERAKHIR_IBU">Pendidikan
                                                                            Terakhir</label>
                                                                        <select class="form-control"
                                                                            id="PENDIDIKAN_TERAKHIR_IBU"
                                                                            name="PENDIDIKAN_TERAKHIR_IBU" required>
                                                                            <option value="">-- Pilih Pendidikan
                                                                                Terakhir --</option>
                                                                            <option value="SD">Sekolah Dasar (SD)</option>
                                                                            <option value="SMP">Sekolah Menengah Pertama
                                                                                (SMP)</option>
                                                                            <option value="SMA/SMK">Sekolah Menengah Atas
                                                                                (SMA) / Sekolah Menengah Kejuruan (SMK)
                                                                            </option>
                                                                            <option value="D1">Diploma 1 (D1)</option>
                                                                            <option value="D2">Diploma 2 (D2)</option>
                                                                            <option value="D3">Diploma 3 (D3)</option>
                                                                            <option value="D4/S1">Diploma 4 (D4) /
                                                                                Sarjana (S1)</option>
                                                                            <option value="S2">Magister (S2)</option>
                                                                            <option value="S3">Doktor (S3)</option>
                                                                            <option value="Lainnya">Lainnya</option>
                                                                        </select>
                                                                        <div class="valid-feedback">Bagus!</div>
                                                                        <div class="invalid-feedback">Wajib Diisi!</div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="AGAMA_IBU">Agama</label>
                                                                        <select class="form-control" id="AGAMA_IBU" name="AGAMA_IBU" required>
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
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Pekerjaan</label>
                                                                        <input type="text" class="form-control"
                                                                            name="PEKERJAAN_IBU" required>
                                                                        <div class="valid-feedback">Bagus!</div>
                                                                        <div class="invalid-feedback">Wajib Diisi!</div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Alamat Rumah</label>
                                                                        <textarea class="form-control"
                                                                            name="ALAMAT_RUMAH_IBU" required
                                                                            style="height:80px"></textarea>
                                                                        <div class="valid-feedback">Bagus!</div>
                                                                        <div class="invalid-feedback">Wajib Diisi!</div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Kode Pos</label>
                                                                        <input type="number" class="form-control"
                                                                            name="KODE_POS_IBU" required>
                                                                        <div class="valid-feedback">Bagus!</div>
                                                                        <div class="invalid-feedback">Wajib Diisi!</div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Nomor Telepon</label>
                                                                        <input type="number" class="form-control"
                                                                            name="TELEPON_IBU" required>
                                                                        <div class="valid-feedback">Bagus!</div>
                                                                        <div class="invalid-feedback">Wajib Diisi!</div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="divider mt-4">
                                                                <div class="divider-text mb-3">
                                                                    <label>Data Wali (Jika Ada)</label>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Nama Wali</label>
                                                                        <input type="text" class="form-control"
                                                                            name="NAMA_WALI">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Tempat Lahir</label>
                                                                        <input type="text" class="form-control"
                                                                            name="TEMPAT_LAHIR_WALI">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Tanggal Lahir</label>
                                                                        <input type="date" class="form-control"
                                                                            name="TGL_LAHIR_WALI">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="PENDIDIKAN_TERAKHIR_WALI">Pendidikan
                                                                            Terakhir</label>
                                                                        <select class="form-control"
                                                                            id="PENDIDIKAN_TERAKHIR_WALI"
                                                                            name="PENDIDIKAN_TERAKHIR_WALI">
                                                                            <option value="">-- Pilih Pendidikan
                                                                                Terakhir --</option>
                                                                            <option value="SD">Sekolah Dasar (SD)</option>
                                                                            <option value="SMP">Sekolah Menengah Pertama
                                                                                (SMP)</option>
                                                                            <option value="SMA/SMK">Sekolah Menengah Atas
                                                                                (SMA) / Sekolah Menengah Kejuruan (SMK)
                                                                            </option>
                                                                            <option value="D1">Diploma 1 (D1)</option>
                                                                            <option value="D2">Diploma 2 (D2)</option>
                                                                            <option value="D3">Diploma 3 (D3)</option>
                                                                            <option value="D4/S1">Diploma 4 (D4) /
                                                                                Sarjana (S1)</option>
                                                                            <option value="S2">Magister (S2)</option>
                                                                            <option value="S3">Doktor (S3)</option>
                                                                            <option value="Lainnya">Lainnya</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="AGAMA_WALI">Agama</label>
                                                                        <select class="form-control" id="AGAMA_WALI" name="AGAMA_WALI" >
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
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Pekerjaan</label>
                                                                        <input type="text" class="form-control"
                                                                            name="PEKERJAAN_WALI">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Alamat Rumah</label>
                                                                        <textarea class="form-control"
                                                                            name="ALAMAT_RUMAH_WALI"
                                                                            style="height:80px"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Kode Pos</label>
                                                                        <input type="number" class="form-control"
                                                                            name="KODE_POS_WALI">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Nomor Telepon</label>
                                                                        <input type="number" class="form-control"
                                                                            name="TELEPON_WALI">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Hubungan dengan Siswa</label>
                                                                        <input type="text" class="form-control" name="HUBUNGAN_WALI">
                                                                        <div class="valid-feedback"> Bagus! </div>
                                                                        <div class="invalid-feedback"> Wajib Diisi! </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 d-flex justify-content-end">
                                                                <button type="submit" name="tambahdata"
                                                                    class="btn btn-primary me-1 mb-1">Simpan</button>
                                                                <button type="reset"
                                                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                            </div>
                                                        </form>
                                                        <?php
                                                        if (isset($_SESSION['pesan_ortu'])) {
                                                            echo $_SESSION['pesan_ortu'];
                                                            unset($_SESSION['pesan_ortu']);
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item accordion-item-blue">
                                                <button class="accordion-header" aria-expanded="true"
                                                    aria-controls="item1-content">
                                                    <b>DATA SISWA (DOKUMEN)</b>
                                                    <span class="accordion-icon"></span>
                                                </button>
                                                <div id="item1-content" class="accordion-content show">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <form action="proses_dokumen.php" method="POST" enctype="multipart/form-data">
                                                                <input type="hidden" name="ID_SISWA"
                                                                    value="<?php echo $ID_SISWA_LOGGED_IN; ?>">
                                                  
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-lg-6 col-md-12">
                                                                        <div class="mb-3">
                                                                            <label for="aktaKelahiran" class="form-label">Akta Kelahiran</label>
                                                                            <input class="form-control" type="file" id="aktaKelahiran" name="AKTA">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="kartuKeluarga" class="form-label">Kartu Keluarga</label>
                                                                            <input class="form-control" type="file" id="kartuKeluarga" name="KARTU_KELUARGA">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="ijazah" class="form-label">Ijazah (bila sudah ada)</label>
                                                                            <input class="form-control" type="file" id="ijazah" name="IJAZAH">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-12">
                                                                        <div class="mb-3">
                                                                            <label for="skl" class="form-label">Surat Keterangan Lulus (SKL)</label>
                                                                            <input class="form-control" type="file" id="skl" name="SKL">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="bukuPip" class="form-label">Buku PIP (bagi yang memiliki)</label>
                                                                            <input class="form-control" type="file" id="bukuPip" name="BUKU_PIP">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 d-flex justify-content-end">
                                                                <button type="submit" name="tambahdokumen"
                                                                    class="btn btn-primary me-1 mb-1">Simpan</button>
                                                                <button type="reset"
                                                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                            </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <style>
        .custom-button-width {
            padding-left: 10px !important;
            /* Kurangi padding kiri lebih banyak */
            padding-right: 10px !important;
            /* Kurangi padding kanan lebih banyak */
        }

        .accordion-item-blue .accordion-header {
            background-color: rgb(67, 94, 190);
            /* Latar belakang header biru muda */
            color: #0d6efd;
            /* Warna teks header biru tua */
        }

        .accordion-item-blue .accordion-header .accordion-icon {
            background-image:
                url('data:image/svg+xml,%3csvg viewBox=%220 0 16 16%22 fill=%22%230d6efd%22 xmlns=%22[http://www.w3.org/2000/svg%22%3e%3cpath](http://www.w3.org/2000/svg%22%3e%3cpath) fill-rule=%22evenodd%22 d=%22M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z%22/%3e%3c/svg%3e');
            /* Ikon panah biru */
        }

        .accordion-item-blue .accordion-header[aria-expanded="true"] .accordion-icon {
            background-image:
                url('data:image/svg+xml,%3csvg viewBox=%220 0 16 16%22 fill=%22%230d6efd%22 xmlns=%22[http://www.w3.org/2000/svg%22%3e%3cpath](http://www.w3.org/2000/svg%22%3e%3cpath) fill-rule=%22evenodd%22 d=%22M1.646 11.354a.5.5 0 0 0 .708 0L8 5.707l5.646 5.647a.5.5 0 0 0 .708-.708l-6-6a.5.5 0 0 0-.708 0l-6 6a.5.5 0 0 0 0 .708z%22/%3e%3c/svg%3e');
            /* Ikon panah biru saat terbuka */
        }

        .accordion-item-blue .accordion-content {
            background-color: white;
            /* Latar belakang konten biru sangat muda */
        }

        .accordion-container {
            /* width: 400px; */
            /* Hapus lebar tetap */
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 20px auto;
            /* Agar tetap berada di tengah jika ada margin pada parent */
            overflow: hidden;
            display: block;
            /* Pastikan menjadi block-level element */
        }

        .accordion-title {
            padding: 15px;
            margin: 0;
            background-color: rgb(67, 94, 190);
            border-bottom: 1px solid #ccc;
            text-align: center;
            font-size: 1.2em;
            color: white;
        }

        .accordion-description {
            padding: 10px 15px;
            margin-bottom: 10px;
            color: #777;
            font-size: 1.2em;
        }

        .accordion-item {
            border-bottom: 1px solid #eee;
        }

        .accordion-item:last-child {
            border-bottom: none;
        }

        .accordion-header {
            background-color: #fff;
            color: #333;
            padding: 12px 15px;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background-color 0.2s ease-in-out;
        }

        .accordion-header:hover {
            background-color: #f9f9f9;
        }

        .accordion-header b {
            font-size: 1em;
            color: white;
        }

        .accordion-icon {
            width: 1em;
            height: 1em;
            margin-left: 10px;
            background-image:
                url('data:image/svg+xml,%3csvg viewBox=%220 0 16 16%22 fill=%22%23333%22 xmlns=%22[http://www.w3.org/2000/svg%22%3e%3cpath](http://www.w3.org/2000/svg%22%3e%3cpath) fill-rule=%22evenodd%22 d=%22M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z%22/%3e%3c/svg%3e');
            /* Panah bawah */
            background-repeat: no-repeat;
            background-size: contain;
            transition: transform 0.2s ease-in-out;
        }

        .accordion-header[aria-expanded="true"] .accordion-icon {
            transform: rotate(180deg);
            /* Panah menghadap atas saat terbuka */
            background-image:
                url('data:image/svg+xml,%3csvg viewBox=%220 0 16 16%22 fill=%22%23007bff%22 xmlns=%22[http://www.w3.org/2000/svg%22%3e%3cpath](http://www.w3.org/2000/svg%22%3e%3cpath) fill-rule=%22evenodd%22 d=%22M1.646 11.354a.5.5 0 0 0 .708 0L8 5.707l5.646 5.647a.5.5 0 0 0 .708-.708l-6-6a.5.5 0 0 0-.708 0l-6 6a.5.5 0 0 0 0 .708z%22/%3e%3c/svg%3e');
            /* Panah atas (warna biru) */
        }

        .accordion-content {
            padding: 0 15px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out, padding 0.3s ease-in-out;
            background-color: #fff;
        }

        .accordion-content.open {
            max-height: 2000px;
            /* Atur tinggi maksimum sesuai kebutuhan */
            padding: 15px;
        }
        </style>

        <script>
        const accordionHeaders = document.querySelectorAll('.accordion-header');

        accordionHeaders.forEach(header => {
            header.addEventListener('click', () => {
                const content = header.nextElementSibling;
                const isExpanded = header.getAttribute('aria-expanded') === 'true' || false;

                header.setAttribute('aria-expanded', !isExpanded);
                content.classList.toggle('open');

                // Tutup accordion item lain jika perlu (opsional)
                // accordionHeaders.forEach(otherHeader => {
                //     if (otherHeader !== header && otherHeader.getAttribute('aria-expanded') === 'true') {
                //         otherHeader.setAttribute('aria-expanded', false);
                //         otherHeader.nextElementSibling.classList.remove('open');
                //     }
                // });
            });

        });
        </script>
        <link rel="stylesheet" href="[https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css](https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css)">
 

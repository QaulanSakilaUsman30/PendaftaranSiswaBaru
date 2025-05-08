<?php
require_once '../../../../vendor/autoload.php';
use Dompdf\Dompdf;

// Sertakan file koneksi database
require_once '../../../../koneksi.php'; // Sesuaikan path jika perlu

// Ambil ID siswa dari parameter GET
$id_siswa = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';
if (empty($id_siswa)) {
    die("ID siswa tidak ditemukan.");
}

// Query untuk mengambil data siswa berdasarkan ID yang login
$query_detail = mysqli_query($conn, "SELECT * FROM datasiswa WHERE ID_SISWA = '$id_siswa'");
if (!$query_detail) {
    die("Query gagal: " . mysqli_error($conn));
}
$data_siswa = mysqli_fetch_assoc($query_detail);

// Query untuk mengambil data orang tua dan wali berdasarkan ID yang login
$query_detail_ortu = mysqli_query($conn, "SELECT * FROM dataortu_wali WHERE ID_SISWA = '$id_siswa'");
if (!$query_detail_ortu) {
    die("Query gagal: " . mysqli_error($conn));
}
$data_ortu_wali = mysqli_fetch_assoc($query_detail_ortu);

// Cek apakah data siswa dan orang tua/wali ditemukan
if (!$data_siswa || !$data_ortu_wali) {
    die("Data siswa atau orang tua tidak ditemukan.");
}

// Instantiate and use the Dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml('
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Form SMP Negeri 6 Tidore Kepulauan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Times+New+Roman&display=swap");
      body {
        font-family: "Times New Roman", serif;
        background: white;
        margin: 0;
        padding: 0;
        color: #1a1a1a;
      }
      @page {
        size: A4 portrait;
        margin: 20mm 25mm 20mm 25mm;
      }
      .container {
        max-width: 720px;
        margin: 0 auto;
      }
      header {
        display: flex;
        align-items: center; /* Menyusun gambar dan teks sejajar secara vertikal */
        margin-bottom: 20px;
        text-align:center;
      }
      header img {
        height: 70px;
        width: 70px;
        margin-right: 10px; /* Jarak antara gambar dan teks */
        text-align:left;
      }
      .section-title {
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 0.75rem;
        padding-bottom: 0.25rem;
      }
      .field-label {
        
        margin-left:20px;
        margin-bottom:16px;
        font-size:13px;
      }
      .dotted-line {
        border-bottom: 1px dotted #6b7280;
        width: 100%;
        height: 1px;
        margin-left: 0.5rem;
      }
        p{
        margin:5px;
      }
        .section1{
        text-align:center;
      }
         .section1 p{
        font-size:15px;
        margin-bottom:5px;
      }
        .ttd{
        margin-left:68%;
      }
        .ttd p{
          margin-top:5px;
        }
          .signature-line {
            border-top: 1px solid #000; /* Garis hitam tipis di atas */
            margin-top: 70%; /* Jarak di atas garis */
            margin-bottom: 20px; /* Jarak di bawah garis */
            padding-top: 5px; /* Ruang di atas garis untuk teks tanda tangan */
          }

    </style>
  </head>
  <body>
    <div class="container py-4">
        <header>
          <div>
              <p class="mb-0" style="font-size:15px;">PEMERINTAH KOTA TIDORE KEPULAUAN</p>
              <p class="mb-0">DINAS PENDIDIKAN</p>
              <p class="mb-0 fw-bold text-uppercase" style="font-size:17px;"><b>SMP NEGERI 6 TIDORE KEPULAUAN</b></p>
              <p class="mb-0 fst-italic"><i>Jln Sultan Mansyur Telp. (0921) 3316396.</i></p>
          </div>
          <hr style="border:solid 2px black;">
        </header>
        
        <section class="section1">
            <p class="mb-0">JATI DIRI SISWA BARU</p>
            <p class="mb-0">SMP NEGERI 6 TIDORE KEPULAUAN</p>
            <p class="mb-0">KOTA TIDORE KEPULAUAN</p>
            <p class="mb-0" style="margin-bottom:10px;">TAHUN PELAJARAN 2024 - 2025</p>
        </section>
        
        <section style="font-size: 12px; margin-bottom: 2rem;">
            <p class="section-title">I. DATA SISWA</p>
            <div>
                <div class="field-label">
                                        <span style="margin-right: 13%;">1. Nama Lengkap</span>: 
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_siswa['NAMA_LENGKAP']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 69px;">2. Nama Panggilan</span>: 
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_siswa['NAMA_PANGGILAN']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 60px;">3. Tempat/Tgl. Lahir</span>: 
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_siswa['TEMPAT_LAHIR']) . ', ' . date('d-m-Y', strtotime($data_siswa['TGL_LAHIR'])) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 82px;">4. Jenis Kelamin</span>: 
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_siswa['JENIS_KELAMIN']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 84px;">5. Tinggi Badan</span>: 
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_siswa['TINGGI_BADAN']) . ' cm</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 89px;">6. Berat Badan</span>: 
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_siswa['BERAT_BADAN']) . ' kg</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 12%;">7. Panjang Tangan</span>: 
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_siswa['PANJANG_TANGAN']) . ' cm</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 85px;">8. Panjang Kaki</span>: 
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_siswa['PANJANG_KAKI']) . ' cm</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 20%;">9. Agama</span>: 
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_siswa['AGAMA']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 70px;">10. Alamat Rumah</span>: 
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_siswa['ALAMAT_RUMAH']) . '</span>
                </div>
                <div class="field-label" style="margin-left: 32%; display: flex; align-items: center;">
                    <span style="margin-right: 10px;">Kode Pos</span>:
                    <span style="margin-left: 20px; margin-right:20px;">' . htmlspecialchars($data_siswa['KODE_POS_RUMAH']) . '</span>
                    <span style="margin-right: 10px;">Telepon </span>:
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_siswa['TELEPON_RUMAH']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 81px;">13. Asal Sekolah</span>: 
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_siswa['ASAL_SEKOLAH']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 78px;">14. Kelas/Jurusan</span>: 
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_siswa['KELAS_JURUSAN']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 68px;">15. Alamat Sekolah</span>: 
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_siswa['ALAMAT_SEKOLAH']) . '</span>
                </div>
                                <div class="field-label" style="margin-left: 32%; display: flex; align-items: center;">
                    <span style="margin-right: 10px;">Kode Pos</span>:
                    <span style="margin-left: 20px; margin-right:20px;">' . htmlspecialchars($data_siswa['KODE_POS_SEKOLAH']) . '</span>
                    <span style="margin-right: 10px;">Telepon </span>:
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_siswa['TELEPON_SEKOLAH']) . '</span>
                </div>
            </div>
        </section>

        <section style="font-size: 12px; line-height: 1.5; margin-bottom: 2rem;">
            <p class="section-title">II. DATA ORANG TUA / WALI</p>
            <div>
                <div class="field-label">
                    <span style="margin-right: 97px;">1. Nama Ayah</span>:
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_ortu_wali['NAMA_AYAH']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 57px;">2. Tempat Lahir Ayah</span>:
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_ortu_wali['TEMPAT_LAHIR_AYAH']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 55px;">3. Tanggal Lahir Ayah</span>:
                    <span style="margin-left: 20px;">' . date('d-m-Y', strtotime($data_ortu_wali['TGL_LAHIR_AYAH'])) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 5%;">4. Pendidikan Terakhir Ayah</span>:
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_ortu_wali['PENDIDIKAN_TERAKHIR_AYAH']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 17%;">5. Agama Ayah</span>:
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_ortu_wali['AGAMA_AYAH']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 86px;">6. Pekerjaan Ayah</span>:
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_ortu_wali['PEKERJAAN_AYAH']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 59px;">7. Alamat Rumah Ayah</span>:
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_ortu_wali['ALAMAT_RUMAH_AYAH']) . '</span>
                </div>
                <div class="field-label" style="margin-left: 34%; display: flex; align-items: center;">
                    <span style="margin-right: 10px;">Kode Pos</span>:
                    <span style="margin-left: 20px; margin-right:20px;">' . htmlspecialchars($data_ortu_wali['KODE_POS_AYAH']) . '</span>
                    <span style="margin-right: 10px;">Telepon </span>:
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_ortu_wali['TELEPON_AYAH']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 19%;">10. Nama Ibu</span>:
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_ortu_wali['NAMA_IBU']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 71px;">11. Tempat Lahir Ibu</span>:
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_ortu_wali['TEMPAT_LAHIR_IBU']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 69px;">12. Tanggal Lahir Ibu</span>:
                                        <span style="margin-left: 20px;">' . date('d-m-Y', strtotime($data_ortu_wali['TGL_LAHIR_IBU'])) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 37px;">13. Pendidikan Terakhir Ibu</span>:
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_ortu_wali['PENDIDIKAN_TERAKHIR_IBU']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 106px;">14. Agama Ibu</span>:
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_ortu_wali['AGAMA_IBU']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 93px;">15. Pekerjaan Ibu</span>:
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_ortu_wali['PEKERJAAN_IBU']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 65px;">16. Alamat Rumah Ibu</span>:
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_ortu_wali['ALAMAT_RUMAH_IBU']) . '</span>
                </div>
                <div class="field-label" style="margin-left: 34%; display: flex; align-items: center;">
                    <span style="margin-right: 10px;">Kode Pos</span>:
                    <span style="margin-left: 20px; margin-right:20px;">' . htmlspecialchars($data_ortu_wali['KODE_POS_IBU']) . '</span>
                    <span style="margin-right: 10px;">Telepon </span>:
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_ortu_wali['TELEPON_IBU']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 105px;">19. Nama Wali</span>:
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_ortu_wali['NAMA_WALI']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 65px;">20. Tempat Lahir Wali</span>:
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_ortu_wali['TEMPAT_LAHIR_WALI']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 63px;">21. Tanggal Lahir Wali</span>:
                    <span style="margin-left: 20px;">' . date('d-m-Y', strtotime($data_ortu_wali['TGL_LAHIR_WALI'])) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 30px;">22. Pendidikan Terakhir Wali</span>:
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_ortu_wali['PENDIDIKAN_TERAKHIR_WALI']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 99px;">23. Agama Wali</span>:
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_ortu_wali['AGAMA_WALI']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 86px;">24. Pekerjaan Wali</span>:
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_ortu_wali['PEKERJAAN_WALI']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 58px;">25. Alamat Rumah Wali</span>:
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_ortu_wali['ALAMAT_RUMAH_WALI']) . '</span>
                </div>
                <div class="field-label" style="margin-left: 34%; display: flex; align-items: center;">
                    <span style="margin-right: 10px;">Kode Pos</span>:
                                        <span style="margin-left: 20px; margin-right:20px;">' . htmlspecialchars($data_ortu_wali['KODE_POS_WALI']) . '</span>
                    <span style="margin-right: 10px;">Telepon </span>:
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_ortu_wali['TELEPON_WALI']) . '</span>
                </div>
                <div class="field-label">
                    <span style="margin-right: 14%;">28. Hubungan Wali</span>:
                    <span style="margin-left: 20px;">' . htmlspecialchars($data_ortu_wali['HUBUNGAN_WALI']) . '</span>
                </div>
            </div>
        </section>
         
      <section style="font-size: 12px; line-height: 1.5; margin-bottom: 2rem;">
        <p class="section-title">III. LAIN -LAIN</p>
        <div>
          <div class="field-label">
                <span style="margin-right: 25%;">1. Hobi</span>:
                <span style="margin-left: 20px;">'. $data_siswa['HOBI'].'</span>
          </div>
          <div class="field-label">
              <span style="margin-right: 60px;">2. Keterampilan Khusus</span>:
              <span style="margin-left: 20px;">'. $data_siswa['KETERAMPILAN_KHUSUS'].'</span>
          </div>
          <div class="field-label">
              <span style="margin-right: 62px;">3. Penghargaan Sekolah</span>:
              <span style="margin-left: 20px;">'. $data_siswa['PENGHARGAAN_SEKOLAH'].'</span>
          </div>
          <div class="field-label">
              <span style="margin-right: 46px;">4. Penghargaan Kecamatan</span>:
              <span style="margin-left: 20px;">'. $data_siswa['PENGHARGAAN_KECAMATAN'].'</span>
          </div>
          <div class="field-label">
              <span style="margin-right: 55px;">5. Penghargaan Kab/Kota</span>:
              <span style="margin-left: 20px;">'. $data_siswa['PENGHARGAAN_KAB_KOTA'].'</span>
          </div>
          <div class="field-label">
              <span style="margin-right:63px;">6. Penghargaan Provinsi</span>:
              <span style="margin-left: 20px;">'. $data_siswa['PENGHARGAAN_PROVINSI'].'</span>
          </div>
          <div class="field-label">
              <span style="margin-right: 60px;">7. Penghargaan Nasional</span>:
              <span style="margin-left: 20px;">'. $data_siswa['PENGHARGAAN_NASIONAL'].'</span>
          </div>
          <div class="field-label">
              <span style="margin-right: 39px;">8. Penghargaan Internasional</span>:
              <span style="margin-left: 20px;">'. $data_siswa['PENGHARGAAN_INTERNASIONAL'].'</span>
          </div>
        </div>
      </section>

        <div class="ttd">
            <p>
                Tidore,
                <span style="display:inline-block; width: 4rem;">
                    <span style="border-bottom: 1px dotted #000; padding-bottom: 2px; width: 8em; display: inline-block;"></span>
                </span>
            </p>
            <p>Yang Membuat</p>
            <div class="signature-line"></div>
        </div>

        <div class="small-text mt-5" style="max-width: 400px;">
            <p>*) Diisi oleh siswa sebelum waktu pendaftaran</p>
            <p>**) Coret yang tidak perlu</p>
        </div>
    </div>
  </body>
</html>
');

// Setting kertas dan orientasi jika perlu
$dompdf->setPaper('A4', 'portrait');

// Render HTML menjadi PDF
$dompdf->render();

// Kirim output PDF ke browser
$dompdf->stream("Formulir_Pendaftaran.pdf", array("Attachment" => 0));
?>
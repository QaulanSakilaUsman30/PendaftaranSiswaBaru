<?php
require_once '../../../vendor/autoload.php';
use Dompdf\Dompdf;

// Sertakan file koneksi database
require_once '../../../koneksi.php'; // Sesuaikan path jika perlu

// Query untuk mengambil semua data siswa yang statusnya DIVERIFIKASI dan data orang tua/wali
$query = "
    SELECT 
        ds.ID_SISWA, 
        ds.NAMA_LENGKAP, 
        ds.NAMA_PANGGILAN, 
        ds.TGL_LAHIR, 
        ds.JENIS_KELAMIN, 
        ds.HOBI, 
        ds.KETERAMPILAN_KHUSUS, 
        ds.PENGHARGAAN_SEKOLAH, 
        ds.PENGHARGAAN_KECAMATAN, 
        ds.PENGHARGAAN_KAB_KOTA, 
        ds.PENGHARGAAN_PROVINSI, 
        ds.PENGHARGAAN_NASIONAL, 
        ds.PENGHARGAAN_INTERNASIONAL,
        dw.NAMA_AYAH, 
        dw.TEMPAT_LAHIR_AYAH, 
        dw.TGL_LAHIR_AYAH, 
        dw.PENDIDIKAN_TERAKHIR_AYAH, 
        dw.AGAMA_AYAH, 
        dw.PEKERJAAN_AYAH, 
        dw.ALAMAT_RUMAH_AYAH, 
        dw.KODE_POS_AYAH, 
        dw.TELEPON_AYAH,
        dw.NAMA_IBU, 
        dw.TEMPAT_LAHIR_IBU, 
        dw.TGL_LAHIR_IBU, 
        dw.PENDIDIKAN_TERAKHIR_IBU, 
        dw.AGAMA_IBU, 
        dw.PEKERJAAN_IBU, 
        dw.ALAMAT_RUMAH_IBU, 
        dw.KODE_POS_IBU, 
        dw.TELEPON_IBU,
        dw.NAMA_WALI, 
        dw.TEMPAT_LAHIR_WALI, 
        dw.TGL_LAHIR_WALI, 
        dw.PENDIDIKAN_TERAKHIR_WALI, 
        dw.AGAMA_WALI, 
        dw.PEKERJAAN_WALI, 
        dw.ALAMAT_RUMAH_WALI, 
        dw.KODE_POS_WALI, 
        dw.TELEPON_WALI, 
        dw.HUBUNGAN_WALI
    FROM 
        datasiswa ds
    INNER JOIN 
        dataortu_wali dw ON ds.ID_SISWA = dw.ID_SISWA
    WHERE 
        ds.STATUS = 'DIVERIFIKASI'
";

$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}

// Instantiate and use the Dompdf class
$dompdf = new Dompdf();
$html = '
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Laporan Pendaftaran Siswa</title>
    <style>
      body {
        font-family: "Times New Roman", serif;
        background: white;
        margin: 0;
        padding: 0;
        color: #1a1a1a;
      }
      @page {
        size: A4 landscape; /* Change to landscape */
        margin: 20mm 25mm 20mm 25mm;
      }
      .container {
        max-width: 100%; /* Allow full width for landscape */
        margin: 0 auto;
      }
        header {
        display: flex;
        align-items: center; /* Menyusun gambar dan teks sejajar secara vertikal */            
        text-align:center;
        }
        p{
                margin:5px;
            }
      table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
      }
      th, td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
      }
      th {
        background-color: #f2f2f2;
      }
         .ttd{
                margin-left:68%;
            }
            .ttd p{
                margin-top:5px;
            }
            .signature-line {
                border-top: 1px solid #000; /* Garis hitam tipis di atas */
                margin-top: 40%; /* Jarak di atas garis */
                margin-bottom: 50px; /* Jarak di bawah garis */
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
         <section style="text-align: center; margin-bottom: 20px;">
            <h2 style="font-size:18px; font-weight: bold; margin-bottom: 8px;">Laporan  Pendaftaran Siswa</h2>
            <h3 style="font-size:16px; margin-bottom: 8px;">SMP NEGERI 6 TIDORE KEPULAUAN</h3>
            <h3 style="font-size:16px; margin-bottom: 8px;">KOTA TIDORE KEPULAUAN</h3>
        </section>
        
        <section>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Nama Ayah</th>
                        <th>Nama Ibu</th>
                        <th>Nama Wali</th>
                        <th>Agama Ayah</th>
                        <th>Pekerjaan Ayah</th>
                        <th>Agama Ibu</th>
                        <th>Pekerjaan Ibu</th>
                        <th>Agama Wali</th>
                        <th>Pekerjaan Wali</th>
                    </tr>
                </thead>
                <tbody>';

                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $html .= '
                    <tr>
                        <td>' . $no++ . '</td>
                        <td>' . htmlspecialchars($row['NAMA_LENGKAP']) . '</td>
                        <td>' . date('d-m-Y', strtotime($row['TGL_LAHIR'])) . '</td>
                        <td>' . htmlspecialchars($row['JENIS_KELAMIN']) . '</td>
                        <td>' . htmlspecialchars($row['NAMA_AYAH']) . '</td>
                        <td>' . htmlspecialchars($row['NAMA_IBU']) . '</td>
                        <td>' . htmlspecialchars($row['NAMA_WALI']) . '</td>
                        <td>' . htmlspecialchars($row['AGAMA_AYAH']) . '</td>
                        <td>' . htmlspecialchars($row['PEKERJAAN_AYAH']) . '</td>
                        <td>' . htmlspecialchars($row['AGAMA_IBU']) . '</td>
                        <td>' . htmlspecialchars($row['PEKERJAAN_IBU']) . '</td>
                        <td>' . htmlspecialchars($row['AGAMA_WALI']) . '</td>
                        <td>' . htmlspecialchars($row['PEKERJAAN_WALI']) . '</td>
                    </tr>';
                }

$html .= '
                </tbody>
            </table>
        </section>

        <div class="ttd">
            <p>
                Tidore,
                <span style="width: 4rem;">
                    <span style="border-bottom: 1px dotted #000; padding-bottom: 2px; width: 8em; display: inline-block;"></span>
                </span>
            </p>
            <p>Yang Membuat</p>
            <div class="signature-line"></div>
        </div>
    </div>
  </body>
</html>
';

// Load the HTML content into Dompdf
$dompdf->loadHtml($html);

// Setting kertas dan orientasi jika perlu
$dompdf->setPaper('legal', 'landscape');

// Render HTML menjadi PDF
$dompdf->render();

// Kirim output PDF ke browser
$dompdf->stream("Laporan_Pendaftaran_Siswa.pdf", array("Attachment" => 0));
?>

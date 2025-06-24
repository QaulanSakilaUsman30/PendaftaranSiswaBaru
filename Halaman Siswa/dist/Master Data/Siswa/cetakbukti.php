<?php
require '../../../../vendor/autoload.php';
use Dompdf\Dompdf;

session_start();

if (!isset($_SESSION['ID_SISWA'])) {
    header('Location: ../../Login Siswa/index.php');
    exit();
}

require_once '../../../../koneksi.php';

$id_siswa_login = $_SESSION['ID_SISWA'];
$query_detail = mysqli_query($conn, "SELECT * FROM datasiswa WHERE ID_SISWA = '$id_siswa_login'");
$data = mysqli_fetch_assoc($query_detail);

$dompdf = new Dompdf();

$dompdf->loadHtml('
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran</title>
    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            padding: 40px;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 700px;
            margin: auto;
            border: 1px solid #ccc;
            padding: 30px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            background-color: #007BFF;
            color: white;
            padding: 10px;
            border-radius: 4px;
            font-size: 20px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            margin-top: 10px;
            font-size: 14px;
        }
        td {
            padding: 6px 4px;
            vertical-align: top;
        }
        tr td:first-child {
            width: 40%;
            font-weight: bold;
            color: #333;
        }
        tr td:last-child {
            color: #444;
        }
        .info {
            margin-top: 20px;
            font-size: 13px;
            color: #555;
            background-color: #e9f5ff;
            padding: 10px;
            border-left: 3px solid #007BFF;
            border-radius: 4px;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
            font-size: 14px;
            color: #444;
        }
        .ttd-line {
            margin-top: 60px;
            border-top: 1px dashed #444;
            width: 200px;
            margin-left: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Bukti Pendaftaran Peserta Didik Baru</h2>
        <p><strong>Tanggal Cetak:</strong> ' . date('d-m-Y') . '</p>
        <table>
            <tr><td>Nomor Pendaftaran</td><td>: ' . $data['NOMOR_PENDAFTARAN'] . '</td></tr>
            <tr><td>Nama Lengkap</td><td>: ' . $data['NAMA_LENGKAP'] . '</td></tr>
            <tr><td>Tempat, Tanggal Lahir</td><td>: ' . $data['TEMPAT_LAHIR'] . ', ' . date('d-m-Y', strtotime($data['TGL_LAHIR'])) . '</td></tr>
            <tr><td>Jenis Kelamin</td><td>: ' . $data['JENIS_KELAMIN'] . '</td></tr>
            <tr><td>Alamat Rumah</td><td>: ' . $data['ALAMAT_RUMAH'] . '</td></tr>
            <tr><td>Asal Sekolah</td><td>: ' . $data['ASAL_SEKOLAH'] . '</td></tr>
            <tr><td>Username</td><td>: ' . $data['USERNAME'] . '</td></tr>
        </table>

        <div class="info">
            <p><strong>Catatan:</strong> Simpan bukti pendaftaran ini dan bawa saat proses verifikasi di sekolah.</p>
        </div>

        <div class="footer">
            <p>Tidore, .........................</p>
            <p>Tanda Tangan Siswa</p>
            <div class="ttd-line"></div>
        </div>
    </div>
</body>
</html>
');

$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("Bukti_Pendaftaran_Siswa.pdf", array("Attachment" => 0));
?>

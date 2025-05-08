<?php

require '../../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Style\Border;

// Sertakan file koneksi database
require_once '../../../../koneksi.php';

// Mulai session jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Periksa apakah ID siswa ada di session
if (!isset($_SESSION['ID_SISWA'])) {
    header('Location: ../../../../Login Siswa/index.php');
    exit();
}

// Ambil ID siswa dari session
$id_siswa_login = $_SESSION['ID_SISWA'];

// Query untuk mengambil data siswa
$query_siswa = mysqli_query($conn, "SELECT * FROM datasiswa WHERE ID_SISWA = '$id_siswa_login'");
$data_siswa = mysqli_fetch_assoc($query_siswa);

// Query untuk mengambil data orang tua/wali
$query_ortu = mysqli_query($conn, "SELECT * FROM dataortu_wali WHERE ID_SISWA = '$id_siswa_login'");
$data_ortu_wali = mysqli_fetch_assoc($query_ortu);

// Buat objek Spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Atur properti dokumen
$spreadsheet->getProperties()->setCreator("SIMAK-SMK")
    ->setLastModifiedBy("SIMAK-SMK")
    ->setTitle("Formulir Pendaftaran Siswa Baru")
    ->setSubject("Formulir Pendaftaran Siswa Baru")
    ->setDescription("Formulir Pendaftaran Siswa Baru")
    ->setKeywords("formulir, pendaftaran, siswa baru")
    ->setCategory("Formulir Pendaftaran");

// Fungsi untuk menambahkan label dan nilai pada sheet
function addLabelAndValue($sheet, $row, $label, $value) {
    $sheet->setCellValue('A' . $row, $label);
    $sheet->setCellValue('B' . $row, $value);
    $sheet->getStyle('A' . $row)->getFont()->setBold(true);
    $sheet->getRowDimension($row)->setRowHeight(20);
    $sheet->getStyle('A' . $row . ':B' . $row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
    $sheet->getStyle('B' . $row)->getAlignment()->setWrapText(true);
    return $row + 1;
}

$row = 1;
// Judul Laporan
$sheet->setCellValue('A' . $row, 'FORMULIR PENDAFTARAN SISWA BARU');
$sheet->mergeCells('A' . $row . ':B' . $row);
$sheet->getStyle('A' . $row)->getFont()->setSize(16)->setBold(true);
$sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getRowDimension($row)->setRowHeight(25);
$row++;

$sheet->setCellValue('A' . $row, 'SMP NEGERI 6 TIDORE KEPULAUAN - TAHUN PELAJARAN ' . date('Y') . '-' . (date('Y') + 1));
$sheet->mergeCells('A' . $row . ':B' . $row);
$sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getRowDimension($row)->setRowHeight(20);
$row += 2; // Tambah 2 untuk memberi jarak

// Bagian I: Data Siswa
$sheet->setCellValue('A' . $row, 'I. DATA SISWA');
$sheet->getStyle('A' . $row)->getFont()->setBold(true)->setSize(14);
$row++;

$row = addLabelAndValue($sheet, $row, 'Nama Lengkap', $data_siswa['NAMA_LENGKAP']);
$row = addLabelAndValue($sheet, $row, 'Nama Panggilan', $data_siswa['NAMA_PANGGILAN']);
$row = addLabelAndValue($sheet, $row, 'Tempat/Tgl. Lahir', $data_siswa['TEMPAT_LAHIR'] . ', ' . date('d-m-Y', strtotime($data_siswa['TGL_LAHIR'])));
$row = addLabelAndValue($sheet, $row, 'Jenis Kelamin', $data_siswa['JENIS_KELAMIN']);
$row = addLabelAndValue($sheet, $row, 'Tinggi Badan (cm)', $data_siswa['TINGGI_BADAN']);
$row = addLabelAndValue($sheet, $row, 'Berat Badan (kg)', $data_siswa['BERAT_BADAN']);
$row = addLabelAndValue($sheet, $row, 'Panjang Tangan (cm)', $data_siswa['PANJANG_TANGAN']);
$row = addLabelAndValue($sheet, $row, 'Panjang Kaki (cm)', $data_siswa['PANJANG_KAKI']);
$row = addLabelAndValue($sheet, $row, 'Agama', $data_siswa['AGAMA']);
$row = addLabelAndValue($sheet, $row, 'Alamat Rumah', $data_siswa['ALAMAT_RUMAH']);
$row = addLabelAndValue($sheet, $row, 'Kode Pos Rumah', $data_siswa['KODE_POS_RUMAH']);
$row = addLabelAndValue($sheet, $row, 'Telepon Rumah', $data_siswa['TELEPON_RUMAH']);
$row = addLabelAndValue($sheet, $row, 'Asal Sekolah', $data_siswa['ASAL_SEKOLAH']);
$row = addLabelAndValue($sheet, $row, 'Kelas/Jurusan', $data_siswa['KELAS_JURUSAN']);
$row = addLabelAndValue($sheet, $row, 'Alamat Sekolah', $data_siswa['ALAMAT_SEKOLAH']);
$row = addLabelAndValue($sheet, $row, 'Kode Pos Sekolah', $data_siswa['KODE_POS_SEKOLAH']);
$row = addLabelAndValue($sheet, $row, 'Telepon Sekolah', $data_siswa['TELEPON_SEKOLAH']);
$row = addLabelAndValue($sheet, $row, 'Hobi', $data_siswa['HOBI']);
$row = addLabelAndValue($sheet, $row, 'Keterampilan Khusus', $data_siswa['KETERAMPILAN_KHUSUS']);
$row = addLabelAndValue($sheet, $row, 'Penghargaan Sekolah', $data_siswa['PENGHARGAAN_SEKOLAH']);
$row = addLabelAndValue($sheet, $row, 'Penghargaan Kecamatan', $data_siswa['PENGHARGAAN_KECAMATAN']);
$row = addLabelAndValue($sheet, $row, 'Penghargaan Kab/Kota', $data_siswa['PENGHARGAAN_KAB_KOTA']);
$row = addLabelAndValue($sheet, $row, 'Penghargaan Provinsi', $data_siswa['PENGHARGAAN_PROVINSI']);
$row = addLabelAndValue($sheet, $row, 'Penghargaan Nasional', $data_siswa['PENGHARGAAN_NASIONAL']);
$row = addLabelAndValue($sheet, $row, 'Penghargaan Internasional', $data_siswa['PENGHARGAAN_INTERNASIONAL']);

$row += 2; // Tambah 2 untuk memberi jarak

// Bagian II: Data Orang Tua/Wali
$sheet->setCellValue('A' . $row, 'II. DATA ORANG TUA / WALI');
$sheet->getStyle('A' . $row)->getFont()->setBold(true)->setSize(14);
$row++;

$row = addLabelAndValue($sheet, $row, 'Nama Ayah', $data_ortu_wali['NAMA_AYAH']);
$row = addLabelAndValue($sheet, $row, 'Tempat Lahir Ayah', $data_ortu_wali['TEMPAT_LAHIR_AYAH']);
$row = addLabelAndValue($sheet, $row, 'Tanggal Lahir Ayah', date('d-m-Y', strtotime($data_ortu_wali['TGL_LAHIR_AYAH'])));
$row = addLabelAndValue($sheet, $row, 'Pendidikan Ayah', $data_ortu_wali['PENDIDIKAN_TERAKHIR_AYAH']);
$row = addLabelAndValue($sheet, $row, 'Agama Ayah', $data_ortu_wali['AGAMA_AYAH']);
$row = addLabelAndValue($sheet, $row, 'Pekerjaan Ayah', $data_ortu_wali['PEKERJAAN_AYAH']);
$row = addLabelAndValue($sheet, $row, 'Alamat Rumah Ayah', $data_ortu_wali['ALAMAT_RUMAH_AYAH']);
$row = addLabelAndValue($sheet, $row, 'Kode Pos Ayah', $data_ortu_wali['KODE_POS_AYAH']);
$row = addLabelAndValue($sheet, $row, 'Telepon Ayah', $data_ortu_wali['TELEPON_AYAH']);
$row = addLabelAndValue($sheet, $row, 'Nama Ibu', $data_ortu_wali['NAMA_IBU']);
$row = addLabelAndValue($sheet, $row, 'Tempat Lahir Ibu', $data_ortu_wali['TEMPAT_LAHIR_IBU']);
$row = addLabelAndValue($sheet, $row, 'Tanggal Lahir Ibu', date('d-m-Y', strtotime($data_ortu_wali['TGL_LAHIR_IBU'])));
$row = addLabelAndValue($sheet, $row, 'Pendidikan Ibu', $data_ortu_wali['PENDIDIKAN_TERAKHIR_IBU']);
$row = addLabelAndValue($sheet, $row, 'Agama Ibu', $data_ortu_wali['AGAMA_IBU']);
$row = addLabelAndValue($sheet, $row, 'Pekerjaan Ibu', $data_ortu_wali['PEKERJAAN_IBU']);
$row = addLabelAndValue($sheet, $row, 'Alamat Rumah Ibu', $data_ortu_wali['ALAMAT_RUMAH_IBU']);
$row = addLabelAndValue($sheet, $row, 'Kode Pos Ibu', $data_ortu_wali['KODE_POS_IBU']);
$row = addLabelAndValue($sheet, $row, 'Telepon Ibu', $data_ortu_wali['TELEPON_IBU']);
$row = addLabelAndValue($sheet, $row, 'Nama Wali', $data_ortu_wali['NAMA_WALI']);
$row = addLabelAndValue($sheet, $row, 'Tempat Lahir Wali', $data_ortu_wali['TEMPAT_LAHIR_WALI']);
$row = addLabelAndValue($sheet, $row, 'Tanggal Lahir Wali', date('d-m-Y', strtotime($data_ortu_wali['TGL_LAHIR_WALI'])));
$row = addLabelAndValue($sheet, $row, 'Pendidikan Wali', $data_ortu_wali['PENDIDIKAN_TERAKHIR_WALI']);
$row = addLabelAndValue($sheet, $row, 'Agama Wali', $data_ortu_wali['AGAMA_WALI']);
$row = addLabelAndValue($sheet, $row, 'Pekerjaan Wali', $data_ortu_wali['PEKERJAAN_WALI']);
$row = addLabelAndValue($sheet, $row, 'Alamat Rumah Wali', $data_ortu_wali['ALAMAT_RUMAH_WALI']);
$row = addLabelAndValue($sheet, $row, 'Kode Pos Wali', $data_ortu_wali['KODE_POS_WALI']);
$row = addLabelAndValue($sheet, $row, 'Telepon Wali', $data_ortu_wali['TELEPON_WALI']);
$row = addLabelAndValue($sheet, $row, 'Hubungan Wali', $data_ortu_wali['HUBUNGAN_WALI']);

$row += 2;

// Bagian III: Tanda Tangan
$sheet->setCellValue('A' . $row, 'III. TANDA TANGAN');
$sheet->getStyle('A' . $row)->getFont()->setBold(true)->setSize(14);
$row++;

$sheet->setCellValue('A' . $row, 'Calon Siswa');
$sheet->setCellValue('B' . $row, 'Orang Tua / Wali');
$sheet->setCellValue('C' . $row, 'Panitia Pendaftaran');
$row++;
$row+=2; //loncat 2 baris, sebelumnya diubah menjadi $sheet++ yang menyebabkan error.
$row+=2; //loncat 2 baris

$sheet->setCellValue('A' . $row, '(...........................)');
$sheet->setCellValue('B' . $row, '(...........................)');
$sheet->setCellValue('C' . $row, '(...........................)');

// Tambahkan border di sekeliling area tanda tangan
$styleSignArea = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => 'FF000000'],
        ],
    ],
];
$sheet->getStyle('A' . ($row - 3) . ':C' . $row)->applyFromArray($styleSignArea);

// Atur tinggi baris untuk tanda tangan
$sheet->getRowDimension($row)->setRowHeight(30);
$sheet->getStyle('A' . $row . ':C' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Center align tanda tangan

// Atur ukuran kertas dan orientasi
$sheet->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_A4);
$sheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_PORTRAIT);

// Atur judul worksheet
$sheet->setTitle('Formulir Pendaftaran');

// Buat objek Writer untuk format XLSX
$writer = new Xlsx($spreadsheet);

// Tentukan nama file yang akan diunduh
$filename = 'Formulir Pendaftaran_ID_Siswa' . $id_siswa_login . '.xlsx';

// Atur header HTTP untuk memaksa download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Tulis spreadsheet ke output browser
$writer->save('php://output');

exit();
?>

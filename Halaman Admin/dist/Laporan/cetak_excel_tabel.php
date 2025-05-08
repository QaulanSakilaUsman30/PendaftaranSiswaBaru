<?php
require_once '../../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Sertakan file koneksi database
require_once '../../../koneksi.php'; // Sesuaikan path jika perlu

// Query untuk mengambil semua data siswa dan data orang tua/wali
$query = "
    SELECT 
        ds.ID_SISWA, 
        ds.NAMA_LENGKAP, 
        ds.NAMA_PANGGILAN, 
        ds.TEMPAT_LAHIR, 
        ds.TGL_LAHIR, 
        ds.JENIS_KELAMIN, 
        ds.TINGGI_BADAN, 
        ds.BERAT_BADAN, 
        ds.PANJANG_TANGAN, 
        ds.PANJANG_KAKI, 
        ds.AGAMA, 
        ds.ALAMAT_RUMAH, 
        ds.KODE_POS_RUMAH, 
        ds.TELEPON_RUMAH, 
        ds.ASAL_SEKOLAH, 
        ds.KELAS_JURUSAN, 
        ds.ALAMAT_SEKOLAH, 
        ds.KODE_POS_SEKOLAH, 
        ds.TELEPON_SEKOLAH, 
        ds.HOBI, 
        ds.TGL_BUAT, 
        ds.TGL_UBAH, 
        ds.STATUS, 
        ds.KETERAMPILAN_KHUSUS, 
        ds.PENGHARGAAN_SEKOLAH, 
        ds.PENGHARGAAN_KECAMATAN, 
        ds.PENGHARGAAN_KAB_KOTA, 
        ds.PENGHARGAAN_PROVINSI, 
        ds.PENGHARGAAN_NASIONAL, 
        ds.PENGHARGAAN_INTERNASIONAL,
        dw.ID_ORTU_WALI, 
        dw.NAMA_AYAH, 
        dw.TEMPAT_LAHIR_AYAH, 
        dw.TGL_LAHIR_AYAH, 
        dw.AGAMA_AYAH, 
        dw.PENDIDIKAN_TERAKHIR_AYAH, 
        dw.PEKERJAAN_AYAH, 
        dw.ALAMAT_RUMAH_AYAH, 
        dw.KODE_POS_AYAH, 
        dw.TELEPON_AYAH, 
        dw.NAMA_IBU, 
        dw.TEMPAT_LAHIR_IBU, 
        dw.TGL_LAHIR_IBU, 
        dw.AGAMA_IBU, 
        dw.PENDIDIKAN_TERAKHIR_IBU, 
        dw.PEKERJAAN_IBU, 
        dw.ALAMAT_RUMAH_IBU, 
        dw.KODE_POS_IBU, 
        dw.TELEPON_IBU, 
        dw.NAMA_WALI, 
        dw.TEMPAT_LAHIR_WALI, 
        dw.TGL_LAHIR_WALI, 
        dw.AGAMA_WALI, 
        dw.PENDIDIKAN_TERAKHIR_WALI, 
        dw.PEKERJAAN_WALI, 
        dw.ALAMAT_RUMAH_WALI, 
        dw.KODE_POS_WALI, 
        dw.TELEPON_WALI, 
        dw.HUBUNGAN_WALI, 
        dw.TGL_BUAT1, 
        dw.TGL_UBAH1
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

// Create a new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set the title and header
$sheet->mergeCells('A1:BI1');
$sheet->setCellValue('A1', 'PEMERINTAH KOTA TIDORE KEPULAUAN');
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(15);
$sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

$sheet->mergeCells('A2:BI2');
$sheet->setCellValue('A2', 'DINAS PENDIDIKAN');
$sheet->getStyle('A2')->getFont()->setBold(true);
$sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

$sheet->mergeCells('A3:BI3');
$sheet->setCellValue('A3', 'SMP NEGERI 6 TIDORE KEPULAUAN');
$sheet->getStyle('A3')->getFont()->setBold(true)->setSize(17);
$sheet->getStyle('A3')->getAlignment()->setHorizontal('center');

$sheet->mergeCells('A4:BI4');
$sheet->setCellValue('A4', 'Jln Sultan Mansyur Telp. (0921) 3316396.');
$sheet->getStyle('A4')->getFont()->setItalic(true);
$sheet->getStyle('A4')->getAlignment()->setHorizontal('center');

$sheet->mergeCells('A5:BI5');
$sheet->setCellValue('A5', 'Laporan Pendaftaran');
$sheet->getStyle('A5')->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A5')->getAlignment()->setHorizontal('center');

// Add a horizontal line
$sheet->getStyle('A6:BI6')->applyFromArray([
    'borders' => [
        'top' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
            'color' => ['argb' => 'FF000000'],
        ],
    ],
]);

// Set the header row
$headers = [
    'No', 'ID Siswa', 'Nama Lengkap', 'Nama Panggilan', 'Tempat Lahir', 'Tanggal Lahir', 
    'Jenis Kelamin', 'Tinggi Badan', 'Berat Badan', 'Panjang Tangan', 'Panjang Kaki', 
    'Agama', 'Alamat Rumah', 'Kode Pos Rumah', 'Telepon Rumah', 'Asal Sekolah', 
    'Kelas Jurusan', 'Alamat Sekolah', 'Kode Pos Sekolah', 'Telepon Sekolah', 
    'Hobi', 'Tanggal Buat', 'Tanggal Ubah', 'Status', 'Keterampilan Khusus', 
    'Penghargaan Sekolah', 'Penghargaan Kecamatan', 'Penghargaan Kab/Kota', 
    'Penghargaan Provinsi', 'Penghargaan Nasional', 'Penghargaan Internasional', 
    'ID Ortuwali', 'Nama Ayah', 'Tempat Lahir Ayah', 'Tanggal Lahir Ayah', 
    'Agama Ayah', 'Pendidikan Terakhir Ayah', 'Pekerjaan Ayah', 
    'Alamat Rumah Ayah', 'Kode Pos Ayah', 'Telepon Ayah', 'Nama Ibu', 
    'Tempat Lahir Ibu', 'Tanggal Lahir Ibu', 'Agama Ibu', 
    'Pendidikan Terakhir Ibu', 'Pekerjaan Ibu', 'Alamat Rumah Ibu', 
    'Kode Pos Ibu', 'Telepon Ibu', 'Nama Wali', 'Tempat Lahir Wali', 
    'Tanggal Lahir Wali', 'Agama Wali', 'Pendidikan Terakhir Wali', 
    'Pekerjaan Wali', 'Alamat Rumah Wali', 'Kode Pos Wali', 
    'Telepon Wali', 'Hubungan Wali', 'Tanggal Buat Wali', 'Tanggal Ubah Wali'
];

// Set header values
$column = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($column . '7', $header);
    $column++;
}

// Set header style
$sheet->getStyle('A7:BI7')->getFont()->setBold(true);
$sheet->getStyle('A7:BI7')->getAlignment()->setHorizontal('center');
$sheet->getStyle('A7:BI7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
$sheet->getStyle('A7:BI7')->getFill()->getStartColor()->setARGB('FFCCCCCC');

// Populate the data
$rowNumber = 8; // Start from the eighth row
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $sheet->setCellValue('A' . $rowNumber, $no++);
    $sheet->setCellValue('B' . $rowNumber, htmlspecialchars($row['ID_SISWA']));
    $sheet->setCellValue('C' . $rowNumber, htmlspecialchars($row['NAMA_LENGKAP']));
    $sheet->setCellValue('D' . $rowNumber, htmlspecialchars($row['NAMA_PANGGILAN']));
    $sheet->setCellValue('E' . $rowNumber, htmlspecialchars($row['TEMPAT_LAHIR']));
    $sheet->setCellValue('F' . $rowNumber, date('d-m-Y', strtotime($row['TGL_LAHIR'])));
    $sheet->setCellValue('G' . $rowNumber, htmlspecialchars($row['JENIS_KELAMIN']));
    $sheet->setCellValue('H' . $rowNumber, htmlspecialchars($row['TINGGI_BADAN']));
    $sheet->setCellValue('I' . $rowNumber, htmlspecialchars($row['BERAT_BADAN']));
    $sheet->setCellValue('J' . $rowNumber, htmlspecialchars($row['PANJANG_TANGAN']));
    $sheet->setCellValue('K' . $rowNumber, htmlspecialchars($row['PANJANG_KAKI']));
    $sheet->setCellValue('L' . $rowNumber, htmlspecialchars($row['AGAMA']));
    $sheet->setCellValue('M' . $rowNumber, htmlspecialchars($row['ALAMAT_RUMAH']));
    $sheet->setCellValue('N' . $rowNumber, htmlspecialchars($row['KODE_POS_RUMAH']));
    $sheet->setCellValue('O' . $rowNumber, htmlspecialchars($row['TELEPON_RUMAH']));
    $sheet->setCellValue('P' . $rowNumber, htmlspecialchars($row['ASAL_SEKOLAH']));
    $sheet->setCellValue('Q' . $rowNumber, htmlspecialchars($row['KELAS_JURUSAN']));
    $sheet->setCellValue('R' . $rowNumber, htmlspecialchars($row['ALAMAT_SEKOLAH']));
    $sheet->setCellValue('S' . $rowNumber, htmlspecialchars($row['KODE_POS_SEKOLAH']));
    $sheet->setCellValue('T' . $rowNumber, htmlspecialchars($row['TELEPON_SEKOLAH']));
    $sheet->setCellValue('U' . $rowNumber, htmlspecialchars($row['HOBI']));
    $sheet->setCellValue('V' . $rowNumber, date('d-m-Y', strtotime($row['TGL_BUAT'])));
    $sheet->setCellValue('W' . $rowNumber, date('d-m-Y', strtotime($row['TGL_UBAH'])));
    $sheet->setCellValue('X' . $rowNumber, htmlspecialchars($row['STATUS']));
    $sheet->setCellValue('Y' . $rowNumber, htmlspecialchars($row['KETERAMPILAN_KHUSUS']));
    $sheet->setCellValue('Z' . $rowNumber, htmlspecialchars($row['PENGHARGAAN_SEKOLAH']));
    $sheet->setCellValue('AA' . $rowNumber, htmlspecialchars($row['PENGHARGAAN_KECAMATAN']));
    $sheet->setCellValue('AB' . $rowNumber, htmlspecialchars($row['PENGHARGAAN_KAB_KOTA']));
    $sheet->setCellValue('AC' . $rowNumber, htmlspecialchars($row['PENGHARGAAN_PROVINSI']));
    $sheet->setCellValue('AD' . $rowNumber, htmlspecialchars($row['PENGHARGAAN_NASIONAL']));
    $sheet->setCellValue('AE' . $rowNumber, htmlspecialchars($row['PENGHARGAAN_INTERNASIONAL']));
    $sheet->setCellValue('AF' . $rowNumber, htmlspecialchars($row['ID_ORTU_WALI']));
    $sheet->setCellValue('AG' . $rowNumber, htmlspecialchars($row['NAMA_AYAH']));
    $sheet->setCellValue('AH' . $rowNumber, htmlspecialchars($row['TEMPAT_LAHIR_AYAH']));
    $sheet->setCellValue('AI' . $rowNumber, date('d-m-Y', strtotime($row['TGL_LAHIR_AYAH'])));
    $sheet->setCellValue('AJ' . $rowNumber, htmlspecialchars($row['AGAMA_AYAH']));
    $sheet->setCellValue('AK' . $rowNumber, htmlspecialchars($row['PENDIDIKAN_TERAKHIR_AYAH']));
    $sheet->setCellValue('AL' . $rowNumber, htmlspecialchars($row['PEKERJAAN_AYAH']));
    $sheet->setCellValue('AM' . $rowNumber, htmlspecialchars($row['ALAMAT_RUMAH_AYAH']));
    $sheet->setCellValue('AN' . $rowNumber, htmlspecialchars($row['KODE_POS_AYAH']));
    $sheet->setCellValue('AO' . $rowNumber, htmlspecialchars($row['TELEPON_AYAH']));
    $sheet->setCellValue('AP' . $rowNumber, htmlspecialchars($row['NAMA_IBU']));
    $sheet->setCellValue('AQ' . $rowNumber, htmlspecialchars($row['TEMPAT_LAHIR_IBU']));
    $sheet->setCellValue('AR' . $rowNumber, date('d-m-Y', strtotime($row['TGL_LAHIR_IBU'])));
    $sheet->setCellValue('AS' . $rowNumber, htmlspecialchars($row['AGAMA_IBU']));
    $sheet->setCellValue('AT' . $rowNumber, htmlspecialchars($row['PENDIDIKAN_TERAKHIR_IBU']));
    $sheet->setCellValue('AU' . $rowNumber, htmlspecialchars($row['PEKERJAAN_IBU']));
    $sheet->setCellValue('AV' . $rowNumber, htmlspecialchars($row['ALAMAT_RUMAH_IBU']));
    $sheet->setCellValue('AW' . $rowNumber, htmlspecialchars($row['KODE_POS_IBU']));
    $sheet->setCellValue('AX' . $rowNumber, htmlspecialchars($row['TELEPON_IBU']));
    $sheet->setCellValue('AY' . $rowNumber, htmlspecialchars($row['NAMA_WALI']));
    $sheet->setCellValue('AZ' . $rowNumber, htmlspecialchars($row['TEMPAT_LAHIR_WALI']));
    $sheet->setCellValue('BA' . $rowNumber, date('d-m-Y', strtotime($row['TGL_LAHIR_WALI'])));
    $sheet->setCellValue('BB' . $rowNumber, htmlspecialchars($row['AGAMA_WALI']));
    $sheet->setCellValue('BC' . $rowNumber, htmlspecialchars($row['PENDIDIKAN_TERAKHIR_WALI']));
    $sheet->setCellValue('BD' . $rowNumber, htmlspecialchars($row['PEKERJAAN_WALI']));
    $sheet->setCellValue('BE' . $rowNumber, htmlspecialchars($row['ALAMAT_RUMAH_WALI']));
    $sheet->setCellValue('BF' . $rowNumber, htmlspecialchars($row['KODE_POS_WALI']));
    $sheet->setCellValue('BG' . $rowNumber, htmlspecialchars($row['TELEPON_WALI']));
    $sheet->setCellValue('BH' . $rowNumber, htmlspecialchars($row['HUBUNGAN_WALI']));
    $sheet->setCellValue('BI' . $rowNumber, date('d-m-Y', strtotime($row['TGL_BUAT1'])));
    $sheet->setCellValue('BJ' . $rowNumber, date('d-m-Y', strtotime($row['TGL_UBAH1'])));
    $rowNumber++;
}

// Set the column widths for better readability
foreach (range('A', 'BJ') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Set the title of the Excel file
$filename = "Laporan_Pendaftaran_Siswa.xlsx";

// Create a new Xlsx writer
$writer = new Xlsx($spreadsheet);

// Set the content type and filename for the download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Save the file to output
$writer->save('php://output');
exit;
?>
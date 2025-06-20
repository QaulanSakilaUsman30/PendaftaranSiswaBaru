<?php
include '../../koneksi.php';

// Cek koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ambil ID Siswa dari parameter GET dan sanitasi
$id_siswa = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

if (!empty($id_siswa)) {
    // Cek apakah siswa ada
    $cek_query = "SELECT * FROM datasiswa WHERE ID_SISWA = '$id_siswa'";
    $cek_result = mysqli_query($conn, $cek_query);

    if (mysqli_num_rows($cek_result) > 0) {

        // 1. Cek data orang tua (ayah dan ibu) dari dataortu_wali
        $ortu_query = "SELECT NAMA_AYAH, NAMA_IBU FROM dataortu_wali WHERE ID_SISWA = '$id_siswa'";
        $ortu_result = mysqli_query($conn, $ortu_query);
        $ortu_lengkap = false;

        if ($ortu_row = mysqli_fetch_assoc($ortu_result)) {
            $ortu_lengkap = !empty($ortu_row['NAMA_AYAH']) && !empty($ortu_row['NAMA_IBU']);
        }

        // 2. Cek dokumen penting (AKTA, SKL, KARTU_KELUARGA)
        $dokumen_query = "SELECT AKTA, SKL, KARTU_KELUARGA FROM dokumen WHERE ID_SISWA = '$id_siswa'";
        $dokumen_result = mysqli_query($conn, $dokumen_query);
        $dokumen_lengkap = false;

        if ($dokumen_row = mysqli_fetch_assoc($dokumen_result)) {
            $dokumen_lengkap = !empty($dokumen_row['AKTA']) &&
                               !empty($dokumen_row['SKL']) &&
                               !empty($dokumen_row['KARTU_KELUARGA']);
        }

        // Jika data penting lengkap
        if ($ortu_lengkap && $dokumen_lengkap) {
            $update_query = "UPDATE datasiswa SET STATUS = 'DIVERIFIKASI' WHERE ID_SISWA = '$id_siswa'";

            if (mysqli_query($conn, $update_query)) {
                echo "<script>alert('Status siswa berhasil diubah menjadi DIVERIFIKASI.'); window.location.href='index.php?ke=siswaditerima';</script>";
                exit;
            } else {
                echo "Error saat mengupdate status: " . mysqli_error($conn);
            }
        } else {
            echo "<script>alert('Gagal memverifikasi. Pastikan data AYAH, IBU, dan dokumen AKTA, SKL, serta KARTU KELUARGA sudah lengkap.'); window.location.href='index.php?ke=datasiswa';</script>";
        }

    } else {
        echo "<script>alert('Data siswa tidak ditemukan.'); window.location.href='index.php?ke=datasiswa';</script>";
    }
} else {
    echo "<script>alert('ID Siswa tidak valid.'); window.location.href='index.php?ke=datasiswa';</script>";
}

mysqli_close($conn);
?>

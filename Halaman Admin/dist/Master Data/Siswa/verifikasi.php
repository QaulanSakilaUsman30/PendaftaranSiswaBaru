<?php
include '../../koneksi.php';

// Cek koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ambil ID Siswa dari parameter GET dan sanitasi untuk keamanan
$id_siswa = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

// Cek apakah ID Siswa ada dan valid
if (!empty($id_siswa)) {
    // Pastikan siswa ada
    $cek_query = "SELECT * FROM datasiswa WHERE ID_SISWA = '$id_siswa'";
    $cek_result = mysqli_query($conn, $cek_query);

    if (mysqli_num_rows($cek_result) > 0) {
        // Update status siswa menjadi DIVERIFIKASI di tabel datasiswa
        $update_query = "UPDATE datasiswa SET STATUS = 'DIVERIFIKASI' WHERE ID_SISWA = '$id_siswa'";

        if (mysqli_query($conn, $update_query)) {
            // Redirect ke halaman siswaditerima setelah update berhasil
            echo "<script>alert('Status siswa berhasil diubah menjadi DIVERIFIKASI.'); window.location.href='index.php?ke=datasiswa';</script>";
            exit;
        } else {
            echo "Error saat mengupdate status: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Data siswa tidak ditemukan.'); window.location.href='index.php?ke=datasiswa';</script>";
    }
} else {
    echo "<script>alert('ID Siswa tidak valid.'); window.location.href='index.php?ke=datasiswa';</script>";
}

mysqli_close($conn);
?>
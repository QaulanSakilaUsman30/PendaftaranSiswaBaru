<?php
include '../../koneksi.php';

// Cek koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ambil ID Siswa dari parameter GET dan sanitasi untuk keamanan
$id_siswa = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';
$aksi = isset($_GET['ke']) ? $_GET['ke'] : ''; // Ambil nilai 'ke' untuk menentukan aksi

// Cek apakah ID Siswa ada dan valid serta aksi adalah 'ditolak'
if (!empty($id_siswa) && $aksi == 'ditolak') {
    // Pastikan siswa ada
    $cek_query = "SELECT * FROM datasiswa WHERE ID_SISWA = '$id_siswa'";
    $cek_result = mysqli_query($conn, $cek_query);

    if (mysqli_num_rows($cek_result) > 0) {
        // Update status siswa menjadi DITOLAK di tabel datasiswa
        $update_query = "UPDATE datasiswa SET STATUS = 'DITOLAK' WHERE ID_SISWA = '$id_siswa'";

        if (mysqli_query($conn, $update_query)) {
            // Redirect kembali ke halaman data siswa setelah update berhasil
            echo "<script>alert('Status siswa DITOLAK.'); window.location.href='index.php?ke=datasiswa';</script>";
            exit;
        } else {
            echo "Error saat mengupdate status: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Data siswa tidak ditemukan.'); window.location.href='index.php?ke=datasiswa';</script>";
    }
} elseif ($aksi != '') {
    // Jika aksi tidak kosong tapi bukan 'ditolak', Anda bisa menambahkan logika lain di sini jika perlu
    echo "<script>alert('Aksi tidak valid.'); window.location.href='index.php?ke=datasiswa';</script>";
} else {
    echo "<script>alert('ID Siswa tidak valid.'); window.location.href='index.php?ke=datasiswa';</script>";
}

mysqli_close($conn);
?>
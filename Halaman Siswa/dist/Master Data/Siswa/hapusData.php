<?php
include 'koneksi.php'; // Sesuaikan path ke file koneksi Anda

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_siswa = mysqli_real_escape_string($conn, $_GET['id']);

    // Query untuk menghapus data siswa berdasarkan ID
    $query_delete = mysqli_query($conn, "DELETE FROM data_siswa WHERE Id_Data_Siswa = '$id_siswa'");

    if ($query_delete) {
        // Jika penghapusan berhasil, redirect kembali ke halaman daftar siswa
        header('location: index.php?ke=datasiswa'); // Sesuaikan path jika perlu
        exit();
    } else {
        // Jika terjadi kesalahan saat menghapus
        echo "<p>Gagal menghapus data siswa.</p>";
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Jika tidak ada ID yang diterima atau ID kosong
    echo "<p>ID siswa tidak valid untuk dihapus.</p>";
}

mysqli_close($conn);
?>
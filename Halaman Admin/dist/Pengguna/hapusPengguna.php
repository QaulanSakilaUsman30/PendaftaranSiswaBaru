<?php
include '../../koneksi.php'; // Sesuaikan path ke file koneksi Anda

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_admin= mysqli_real_escape_string($conn, $_GET['id']);

    // Query untuk menghapus data siswa berdasarkan ID
    $query_delete = mysqli_query($conn, "DELETE FROM dataadmin WHERE ID_ADMIN = '$id_admin'");

    if ($query_delete) {
        // Jika penghapusan berhasil, redirect kembali ke halaman daftar siswa
        header('location: index.php?ke=pengguna'); // Sesuaikan path jika perlu
        exit();
    } else {
        // Jika terjadi kesalahan saat menghapus
        echo "<p>Gagal menghapus data pengguna.</p>";
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Jika tidak ada ID yang diterima atau ID kosong
    echo "<p>ID admin tidak valid untuk dihapus.</p>";
}

mysqli_close($conn);
?>
<?php
include '../../koneksi.php';

// Ambil ID pengguna yang akan diubah dari parameter GET
$id_pengguna = $_GET['id'];

// Query untuk mengambil data pengguna berdasarkan ID
$data = mysqli_query($conn, "SELECT `ID_ADMIN`, `NAMA_ADMIN`, `TELEPON`, `USERNAME`, `PASSWORD`, `GAMBAR` FROM `dataadmin` WHERE `ID_ADMIN`='$id_pengguna'") or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($data);

// Cek apakah form disubmit
if (isset($_POST['ubahDataPengguna'])) {
    // Ambil dan sanitasi data dari form
    $nama_admin = mysqli_real_escape_string($conn, $_POST['NAMA_ADMIN']);
    $TELEPON = mysqli_real_escape_string($conn, $_POST['TELEPON']);
    $username = mysqli_real_escape_string($conn, $_POST['USERNAME']);
    $password_baru = $_POST['PASSWORD'];
    $gambar_lama = $row['GAMBAR'];
    $upload_error = false;

    // Proses upload gambar baru jika ada
    if (!empty($_FILES['GAMBAR_BARU']['name'])) {
        $target_dir = "Pengguna/uploads/";
        $target_file = $target_dir . basename($_FILES['GAMBAR_BARU']['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validasi file gambar
        $check = getimagesize($_FILES['GAMBAR_BARU']['tmp_name']);
        if ($check === false) {
            echo "<script>alert('File yang diupload bukan gambar.');</script>";
            $upload_error = true;
        }
        if ($_FILES['GAMBAR_BARU']['size'] > 2000000) { // Batas 2MB
            echo "<script>alert('Ukuran file terlalu besar.');</script>";
            $upload_error = true;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "<script>alert('Hanya file JPG, JPEG, dan PNG yang diperbolehkan.');</script>";
            $upload_error = true;
        }

        if (!$upload_error) {
            // Buat direktori jika belum ada
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }
            if (move_uploaded_file($_FILES['GAMBAR_BARU']['tmp_name'], $target_file)) {
                // Hapus gambar lama jika ada
                if (!empty($gambar_lama) && file_exists($target_dir . $gambar_lama)) {
                    unlink($target_dir . $gambar_lama);
                }
                $gambar = basename($_FILES['GAMBAR_BARU']['name']);
            } else {
                echo "<script>alert('Terjadi kesalahan saat mengupload gambar.');</script>";
                $gambar = $gambar_lama; // Gunakan gambar lama jika upload gagal
            }
        } else {
            $gambar = $gambar_lama; // Gunakan gambar lama jika ada error validasi
        }
    } else {
        $gambar = $gambar_lama; // Gunakan gambar lama jika tidak ada gambar baru diupload
    }

    // Query untuk mengupdate data pengguna
    $sql = "UPDATE `dataadmin` SET
                `NAMA_ADMIN`='$nama_admin',
                `TELEPON`='$TELEPON',
                `USERNAME`='$username',
                `GAMBAR`='$gambar'";

    // Hanya update password jika ada nilai baru
    if (!empty($password_baru)) {
        $sql .= ", `PASSWORD`='$password_baru'"; // PERHATIAN: Ini menyimpan password dalam teks biasa, sangat tidak aman!
    }

    $sql .= " WHERE `ID_ADMIN`='$id_pengguna'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data pengguna berhasil diubah.'); window.location.href='index.php?ke=pengguna';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Data Pengguna</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php?ke=dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="index.php?ke=pengguna">Data Pengguna</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ubah Data Pengguna</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="index.php?ke=pengguna" type="button" class="btn btn-primary daterange-btn icon-left btn-icon">
                        <svg style="margin-right:5px; color:gray;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="white" d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8 .4 34.3z"/>
                        </svg>Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="section-title mt-0 ml-4">Ubah Data Pengguna</div>
                    <form class="needs-validation" novalidate action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" name="NAMA_ADMIN" required value="<?= htmlspecialchars($row['NAMA_ADMIN']); ?>">
                                <div class="valid-feedback">Baguss!</div>
                            </div>
                            <div class="form-group">
                                <label>TELEPON</label>
                                <input type="TELEPON" class="form-control" name="TELEPON" required value="<?= htmlspecialchars($row['TELEPON']); ?>">
                                <div class="valid-feedback">Baguss!</div>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="USERNAME" required value="<?= htmlspecialchars($row['USERNAME']); ?>">
                                <div class="valid-feedback">Baguss!</div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="PASSWORD" value="">
                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                                <div class="valid-feedback">Baguss!</div>
                            </div>
                            <div class="form-group">
                                <label>Gambar Saat Ini</label><br>
                                <?php if (!empty($row['GAMBAR'])): ?>
                                    <img src="Pengguna/uploads/<?= htmlspecialchars($row['GAMBAR']); ?>" height="150" style="border: 1px solid #ccc;">
                                <?php else: ?>
                                    <p>Tidak ada gambar.</p>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label>Ubah Gambar (Optional)</label>
                                <input type="file" class="form-control" name="GAMBAR_BARU" accept="image/jpg, image/jpeg, image/png">
                                <small class="form-text text-muted">Pilih file gambar baru jika ingin mengubah gambar pengguna.</small>
                            </div>
                            <br>
                            <div class="modal-footer bg-whitesmoke br">
                                <a href="index.php?ke=pengguna" type="button" class="btn btn-secondary">Batal</a>
                                <button class="btn btn-primary" name="ubahDataPengguna" type="submit">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
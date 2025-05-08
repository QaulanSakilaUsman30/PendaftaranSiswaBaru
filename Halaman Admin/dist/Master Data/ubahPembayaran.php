<?php
include '../../koneksi.php';

// Ambil ID data yang akan diubah dari parameter GET
$id_administrasi = $_GET['id'];

// Query untuk mengambil data administrasi berdasarkan ID
$data = mysqli_query($conn, "SELECT `ID_BAYAR`, `ID_SISWA`, `NAMA_BANK`, `BUKTI_TRANSFER`, `STATUS`, `JUMLAH_BIAYA`, `TGL_BUAT` FROM `administrasi` WHERE `ID_BAYAR`='$id_administrasi'") or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($data);

// Ambil data siswa berdasarkan ID_SISWA
$id_siswa = $row['ID_SISWA'];
$siswa_data = mysqli_query($conn, "SELECT `NAMA_LENGKAP` FROM `datasiswa` WHERE `ID_SISWA`='$id_siswa'") or die(mysqli_error($conn));
$siswa_row = mysqli_fetch_assoc($siswa_data);

// Cek apakah form disubmit
if (isset($_POST['ubahDataAdministrasi'])) {
    // Ambil dan sanitasi data dari form
    $id_siswa = mysqli_real_escape_string($conn, $_POST['ID_SISWA']);
    $nama_bank = mysqli_real_escape_string($conn, $_POST['NAMA_BANK']);
    $status = mysqli_real_escape_string($conn, $_POST['STATUS']);
    $jumlah_biaya = mysqli_real_escape_string($conn, $_POST['Jumlah_Biaya']);
    $bukti_transfer_lama = $row['BUKTI_TRANSFER'];
    $upload_error = false;

    // Proses upload bukti transfer baru jika ada
    if (!empty($_FILES['BUKTI_TRANSFER_BARU']['name'])) {
        $target_dir = "Master Data/bukti/";
        $target_file = $target_dir . basename($_FILES['BUKTI_TRANSFER_BARU']['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validasi file
        $check = getimagesize($_FILES['BUKTI_TRANSFER_BARU']['tmp_name']);
        if ($check === false) {
            echo "<script>alert('File yang diupload bukan gambar.');</script>";
            $upload_error = true;
        }
        if ($_FILES['BUKTI_TRANSFER_BARU']['size'] > 2000000) { // Batas 2MB
            echo "<script>alert('Ukuran file terlalu besar.');</script>";
            $upload_error = true;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "<script>alert('Hanya file JPG, JPEG, dan PNG yang diperbolehkan.');</script>";
            $upload_error = true;
        }

        if (!$upload_error) {
            if (move_uploaded_file($_FILES['BUKTI_TRANSFER_BARU']['tmp_name'], $target_file)) {
                // Hapus bukti transfer lama jika ada
                if (!empty($bukti_transfer_lama) && file_exists($target_dir . $bukti_transfer_lama)) {
                    unlink($target_dir . $bukti_transfer_lama);
                }
                $bukti_transfer = basename($_FILES['BUKTI_TRANSFER_BARU']['name']);
            } else {
                echo "<script>alert('Terjadi kesalahan saat mengupload file.');</script>";
                $bukti_transfer = $bukti_transfer_lama; // Gunakan file lama jika upload gagal
            }
        } else {
            $bukti_transfer = $bukti_transfer_lama; // Gunakan file lama jika ada error validasi
        }
    } else {
        $bukti_transfer = $bukti_transfer_lama; // Gunakan file lama jika tidak ada file baru diupload
    }

    // Query untuk mengupdate data administrasi
    $sql = "UPDATE `administrasi` SET
                `ID_SISWA`='$id_siswa',
                `NAMA_BANK`='$nama_bank',
                `BUKTI_TRANSFER`='$bukti_transfer',
                `STATUS`='$status',
                `JUMLAH_BIAYA`='$jumlah_biaya'
            WHERE `ID_BAYAR`='$id_administrasi'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data pembayaran berhasil diubah.'); window.location.href='index.php?ke=pembayaran';</script>";
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
            <h3>Pembayaran</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php?ke=dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="index.php?ke=administrasi">Pembayaran</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ubah Data Pembayaran</li>
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
                    <a href="index.php?ke=pembayaran" type="button" class="btn btn-primary daterange-btn icon-left btn-icon">
                        <svg style="margin-right:5px; color:gray;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="white" d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8 .4 34.3z"/>
                        </svg>Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="section-title mt-0 ml-4">Ubah Data Pembayaran</div>
                    <form class="needs-validation" novalidate action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>ID Siswa</label>
                                <input type="text" class="form-control" name="ID_SISWA" required value="<?= htmlspecialchars($row['ID_SISWA']); ?>" readonly>
                                <div class="valid-feedback">Baguss!</div>
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars($siswa_row['NAMA_LENGKAP']); ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama Bank</label>
                                <input type="text" class="form-control" name="NAMA_BANK" required value="<?= htmlspecialchars($row['NAMA_BANK']); ?>">
                                <div class="valid-feedback">Baguss!</div>
                            </div>
                            <div class="form-group">
                                <label>Status Pembayaran</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="STATUS" id="BELUM_LUNAS" value="BELUM LUNAS" <?= ($row['STATUS'] == 'BELUM LUNAS') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="BELUM_LUNAS">Belum Lunas</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="STATUS" id="LUNAS" value="LUNAS" <?= ($row['STATUS'] == 'LUNAS') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="LUNAS">Lunas</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Biaya</label>
                                <input type="number" class="form-control" name="Jumlah_Biaya" required value="<?= htmlspecialchars($row['JUMLAH_BIAYA']); ?>">
                                <div class="valid-feedback">Baguss!</div>
                            </div>
                            <div class="form-group">
                                <label>Bukti Transfer</label><br>
                                <?php if (!empty($row['BUKTI_TRANSFER'])): ?>
                                    <img src="Master Data/bukti/<?= htmlspecialchars($row['BUKTI_TRANSFER']); ?>" height="300" width="300" style="border: 2px solid #666666;" alt="Bukti Transfer Lama">
                                <?php else: ?>
                                    <p>Tidak ada bukti transfer.</p>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label>Ubah Bukti Transfer (Optional)</label>
                                <input type="file" class="form-control" name="BUKTI_TRANSFER_BARU" accept="image/jpg, image/jpeg, image/png">
                                <small class="form-text text-muted">Pilih file gambar baru jika ingin mengubah bukti transfer.</small>
                            </div>
                            <br>
                            <div class="modal-footer bg-whitesmoke br">
                                <a href="index.php?ke=pembayaran" type="button" class="btn btn-secondary">Batal</a>
                                <button class="btn btn-primary" name="ubahDataAdministrasi" type="submit">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
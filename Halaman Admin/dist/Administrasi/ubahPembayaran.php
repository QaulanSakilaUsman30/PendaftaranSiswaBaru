<?php
include '../../koneksi.php';

// Ambil ID data yang akan diubah dari parameter GET
$id_administrasi = $_GET['id'];

// Query untuk mengambil data administrasi berdasarkan ID
$data = mysqli_query($conn, "SELECT `Id_Administrasi`, `Nama_Peserta_Didik`, `Nama_Bank`, `Bukti_Transfer`, `Status` FROM `administrasi` WHERE `Id_Administrasi`='$id_administrasi'") or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($data);

// Cek apakah form disubmit
if (isset($_POST['ubahDataAdministrasi'])) {
    // Ambil dan sanitasi data dari form
    $nama_peserta_didik = mysqli_real_escape_string($conn, $_POST['Nama_Peserta_Didik']);
    $nama_bank = mysqli_real_escape_string($conn, $_POST['Nama_Bank']);
    $status = mysqli_real_escape_string($conn, $_POST['Status']);
    
    // Query untuk mengupdate data administrasi
    $sql = "UPDATE `administrasi` SET
            `Nama_Peserta_Didik`='$nama_peserta_didik',
            `Nama_Bank`='$nama_bank',
            `Status`='$status'
            WHERE `Id_Administrasi`='$id_administrasi'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data administrasi berhasil diubah.'); window.location.href='index.php?ke=administrasi';</script>";
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
            <h3>Administrasi</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php?ke=dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="index.php?ke=administrasi">Administrasi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ubah Data Administrasi</li>
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
                    <a href="index.php?ke=administrasi" type="button" class="btn btn-primary daterange-btn icon-left btn-icon">
                        <svg style="margin-right:5px; color:gray;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="white" d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8 .4 34.3z"/>
                        </svg>Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="section-title mt-0 ml-4">Ubah Data Administrasi</div>
                    <form class="needs-validation" novalidate action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Siswa</label>
                                <input type="text" class="form-control" name="Nama_Peserta_Didik" required minlength="10" value="<?= $row['Nama_Peserta_Didik']; ?>">
                                <div class="valid-feedback"> Baguss! </div>
                            </div>
                            <div class="form-group">
                                <label>Nama Bank</label>
                                <input type="text" class="form-control" name="Nama_Bank" required minlength="16" value="<?= $row['Nama_Bank']; ?>">
                                <div class="valid-feedback"> Baguss! </div>
                            </div>
                            <div class="form-group">
                                <label>Status Pembayaran</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Status" id="Belum Lunas" value="Belum Lunas" <?= ($row['Status'] == 'Belum Lunas') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="Belum Lunas">
                                        Belum Lunas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Status" id="Lunas" value="Lunas" <?= ($row['Status'] == 'Lunas') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="Lunas">
                                        Lunas
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Bukti Transfer</label>
                                        <td>
                                            <img src="<?php echo 'Administrasi/bukti/' . $row['Bukti_Transfer']; ?>" height="300" width="300" style="border: 2px solid #666666;" alt="">
                                        </td>
                            </div>
                            <br>
                            <div class="modal-footer bg-whitesmoke br">
                                <a href="index.php?ke=administrasi" type="button" class="btn btn-secondary">Batal</a>
                                <button class="btn btn-primary" name="ubahDataAdministrasi">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
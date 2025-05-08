<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Pembayaran</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php?ke=dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Data Pembayaran</li>
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
                <?php
include '../../koneksi.php'; // Pastikan koneksi dilakukan di atas

// Ambil data siswa dari tabel datasiswa untuk dropdown
$siswa_result = $conn->query("SELECT ID_SISWA, NAMA_LENGKAP FROM datasiswa ORDER BY NAMA_LENGKAP ASC");

// Cek apakah form disubmit
if (isset($_POST['tambahDataPembayaran'])) {
    // Ambil dan sanitasi data dari form
    $id_siswa = mysqli_real_escape_string($conn, $_POST['ID_Siswa']);
    $NAMA_BANK = mysqli_real_escape_string($conn, $_POST['NAMA_BANK']);
    $STATUS = mysqli_real_escape_string($conn, $_POST['STATUS']);
    $JUMLAH_BIAYA = mysqli_real_escape_string($conn, $_POST['JUMLAH_BIAYA']);
    $BUKTI_TRANSFER = $_FILES['BUKTI_TRANSFER']['name'];
    $tgl_buat = date('Y-m-d H:i:s');

    // Cek apakah ID_SISWA sudah ada di tabel administrasi
    $check_sql = "SELECT * FROM administrasi WHERE ID_SISWA = '$id_siswa'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "<div class='alert alert-danger'>Data dengan ID Siswa ini sudah ada.</div>";
    } else {
        // Validasi file gambar
        $target_dir = "Master Data/bukti/"; // Folder untuk menyimpan gambar
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $uploadOk = 1;

        // Cek apakah file diunggah
        if (!empty($BUKTI_TRANSFER)) {
            $target_file = $target_dir . basename($BUKTI_TRANSFER);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Cek ukuran file max 3MB
            if ($_FILES['BUKTI_TRANSFER']['size'] > 3145728) {
                echo "<div class='alert alert-danger'>Maaf, ukuran file terlalu besar (max 3MB).</div>";
                $uploadOk = 0;
            }

            // Cek format file yang diperbolehkan
            if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
                echo "<div class='alert alert-danger'>Maaf, hanya file JPG, JPEG, & PNG yang diperbolehkan.</div>";
                $uploadOk = 0;
            }

            // Jika semua validasi berhasil
            if ($uploadOk == 1) {
                // Pindahkan file ke folder tujuan
                if (move_uploaded_file($_FILES['BUKTI_TRANSFER']['tmp_name'], $target_file)) {
                    // Query untuk menambah data pembayaran
                    $sql = "INSERT INTO administrasi (ID_SISWA, NAMA_BANK, STATUS, JUMLAH_BIAYA, BUKTI_TRANSFER, TGL_BUAT)
                            VALUES ('$id_siswa', '$NAMA_BANK', '$STATUS', '$JUMLAH_BIAYA', '$BUKTI_TRANSFER', '$tgl_buat')";

                    if ($conn->query($sql) === TRUE) {
                        header('Location: index.php?ke=pembayaran');
                        exit(); // Pastikan untuk menghentikan eksekusi setelah redirect
                    } else {
                        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Maaf, terjadi kesalahan saat mengupload gambar.</div>";
                }
            }
        } else {
            // Jika BUKTI_TRANSFER tidak diisi, tetap lakukan insert tanpa BUKTI_TRANSFER
            $sql = "INSERT INTO administrasi (ID_SISWA, NAMA_BANK, STATUS, JUMLAH_BIAYA, TGL_BUAT)
                    VALUES ('$id_siswa', '$NAMA_BANK', '$STATUS', '$JUMLAH_BIAYA', '$tgl_buat')";

            if ($conn->query($sql) === TRUE) {
                header('Location: index.php?ke=pembayaran');
                exit(); // Pastikan untuk menghentikan eksekusi setelah redirect
            } else {
                echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
            }
        }
    }
}
?>
                    <div class="section-title mt-0 ml-4">Tambah Pembayaran</div>
                    <form class="needs-validation" novalidate action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="ID_Siswa">Nama Siswa</label>
                                <select class="form-control" name="ID_Siswa" id="ID_Siswa" required>
                                    <option value="" selected disabled>Pilih Nama Siswa</option>
                                    <?php
                                    if ($siswa_result && $siswa_result->num_rows > 0) {
                                        while ($row = $siswa_result->fetch_assoc()) {
                                            echo '<option value="' . htmlspecialchars($row['ID_SISWA']) . '">' . htmlspecialchars($row['NAMA_LENGKAP']) . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">Data siswa tidak tersedia</option>';
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">Harap pilih Nama Siswa.</div>
                            </div>
                            <div class="form-group">
                                <label>Nama Bank</label>
                                <input type="text" class="form-control" name="NAMA_BANK" required minlength="16">
                                <div class="valid-feedback"> Baguss! </div>
                            </div>
                            <div class="form-group">
                                <label>Status Pembayaran</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="STATUS" id="BELUM LUNAS" value="BELUM LUNAS">
                                    <label class="form-check-label" for="belum">
                                        Belum Lunas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="STATUS" id="LUNAS" value="LUNAS">
                                    <label class="form-check-label" for="lunas">
                                        Lunas
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Biaya</label>
                                <input type="number" class="form-control" name="JUMLAH_BIAYA" required minlength="16">
                                <div class="valid-feedback"> Baguss! </div>
                            </div>
                            <div class="form-group">
                                <label>Bukti Transfer</label>
                                <input name="BUKTI_TRANSFER" accept="image/png,image/jpeg,image/jpg" type="file" id="BUKTI_TRANSFER" class="form-control" autocomplete="off"/> *max 3mb
                                <div class="valid-feedback"> Baguss! </div>
                            </div>
                            <br>
                            <div class="modal-footer bg-whitesmoke br">
                                <a href="index.php?ke=pembayaran" type="button" class="btn btn-secondary">Batal</a>
                                <button class="btn btn-primary" name="tambahDataPembayaran">Simpan</button>
                            </div>
                        </div>
                    </form>
                    </div>
            </div>
        </div>
    </div>
</div>
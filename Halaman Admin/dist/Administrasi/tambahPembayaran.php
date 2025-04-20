<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Administrasi</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php?ke=dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Administrasi</li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Data Administrasi</li>
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
                    <?php
                    include '../../koneksi.php'; // Pastikan koneksi dilakukan di atas

                    // Cek apakah form disubmit
                    if (isset($_POST['tambahDataAdministrasi'])) {
                        // Ambil dan sanitasi data dari form
                        $nama_peserta_didik= mysqli_real_escape_string($conn, $_POST['Nama_Peserta_Didik']);
                        $nama_bank= mysqli_real_escape_string($conn, $_POST['Nama_Bank']);
                        $Status = mysqli_real_escape_string($conn, $_POST['Status']);
                        $bukti_transfer = $_FILES['Bukti_Transfer']['name'];
                        $tgl_buat = date('Y-m-d H:i:s');

                        // Validasi file gambar
                        $target_dir = "Administrasi/bukti/"; // Folder untuk menyimpan gambar
                        $target_file = $target_dir . basename($bukti_transfer);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                        // Cek ukuran file
                        if ($_FILES['Bukti_Transfer']['size'] > 25165824) {
                            echo "Maaf, ukuran file terlalu besar.";
                            $uploadOk = 0;
                        }

                        // Cek format file
                        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                            echo "Maaf, hanya file JPG, JPEG, & PNG yang diperbolehkan.";
                            $uploadOk = 0;
                        }

                        // Jika semua validasi berhasil
                        if ($uploadOk == 1) {
                            // Pindahkan file ke folder tujuan
                            if (move_uploaded_file($_FILES['Bukti_Transfer']['tmp_name'], $target_file)) {
                                // Query untuk menambah data pengguna
                                $sql = "INSERT INTO administrasi (Nama_Peserta_Didik, Nama_Bank, Status,Bukti_Transfer, tgl_buat)
                                VALUES ('$nama_peserta_didik', '$nama_bank', '$Status','$bukti_transfer', '$tgl_buat')";

                                if ($conn->query($sql) === TRUE) {
                                    header('Location: index.php?ke=administrasi');
                                    exit(); // Pastikan untuk menghentikan eksekusi setelah redirect
                                } else {
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                }
                            } else {
                                echo "Maaf, terjadi kesalahan saat mengupload gambar.";
                            }
                        }
                    }

                    $conn->close();
                    ?>
                    <div class="section-title mt-0 ml-4">Tambah Administrasi</div>
                    <form class="needs-validation" novalidate action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Siswa</label>
                                <input type="text" class="form-control" name="Nama_Peserta_Didik" required minlength="10">
                                <div class="valid-feedback"> Baguss! </div>
                            </div>
                            <div class="form-group">
                                <label>Nama Bank</label>
                                <input type="text" class="form-control" name="Nama_Bank" required minlength="16">
                                <div class="valid-feedback"> Baguss! </div>
                            </div>
                            <div class="form-group">
                                <label>Status Pembayaran</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Status" id="Belum Lunas" value="Belum Lunas">
                                    <label class="form-check-label" for="belum">
                                        Belum Lunas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Status" id="Lunas" value="Lunas">
                                    <label class="form-check-label" for="lunas">
                                        Lunas
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Bukti Transfer</label>
                                <input name="Bukti_Transfer" accept="image/png,image/jpeg,image/jpg" type="file" id="Bukti_Transfer" class="form-control" autocomplete="off"/> *max 3mb
                                <div class="valid-feedback"> Baguss! </div>
                            </div>
                            <br>
                            <div class="modal-footer bg-whitesmoke br">
                                <a href="index.php?ke=pengguna" type="button" class="btn btn-secondary">Batal</a>
                                <button class="btn btn-primary" name="tambahDataAdministrasi">Simpan</button>
                            </div>
                        </div>
                    </form>
                    </div>
            </div>
        </div>
    </div>
</div>
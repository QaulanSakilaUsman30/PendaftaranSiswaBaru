<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Data Pengguna</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php?ke=dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Pengguna</li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Data Pengguna</li>
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
                <?php
                    include '../../koneksi.php'; // Pastikan koneksi dilakukan di atas

                    // Cek apakah form disubmit
                    if (isset($_POST['tambahDataPengguna'])) {
                        // Ambil dan sanitasi data dari form
                        $nama_admin = mysqli_real_escape_string($conn, $_POST['NAMA_ADMIN']);
                        $TELEPON = mysqli_real_escape_string($conn, $_POST['TELEPON']);
                        $username = mysqli_real_escape_string($conn, $_POST['USERNAME']);
                        $password = mysqli_real_escape_string($conn, $_POST['PASSWORD']); // Password tidak di-hash
                        $gambar = $_FILES['GAMBAR']['name'];
                        $tgl_buat = date('Y-m-d H:i:s');

                        // Validasi file gambar
                        $target_dir = "Pengguna/uploads/"; // Folder untuk menyimpan gambar
                        $target_file = $target_dir . basename($gambar);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                        // Cek ukuran file
                        if ($_FILES['GAMBAR']['size'] > 25165824) {
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
                            if (move_uploaded_file($_FILES['GAMBAR']['tmp_name'], $target_file)) {
                                // Query untuk menambah data pengguna (password disimpan tanpa hash)
                                $sql = "INSERT INTO dataadmin (NAMA_ADMIN, TELEPON, USERNAME, PASSWORD, GAMBAR, TGL_BUAT) VALUES ('$nama_admin', '$TELEPON', '$username', '$password', '$gambar', '$tgl_buat')";

                                if ($conn->query($sql) === TRUE) {
                                    header('Location: index.php?ke=pengguna');
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
                    <div class="section-title mt-0 ml-4">Tambah Data Pengguna</div>
                    <form class="needs-validation" novalidate action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" name="NAMA_ADMIN" required minlength="10">
                                <div class="valid-feedback"> Baguss! </div>
                            </div>
                            <div class="form-group">
                                <label>TELEPON</label>
                                <input type="TELEPON" class="form-control" name="TELEPON" required minlength="16">
                                <div class="valid-feedback"> Baguss! </div>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="USERNAME" required minlength="16">
                                <div class="valid-feedback"> Baguss! </div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="PASSWORD" required>
                                <div class="valid-feedback"> Baguss! </div>
                            </div>
                            <div class="form-group">
                                <label>Gambar</label>
                                <input name="GAMBAR" accept="image/png,image/jpeg,image/jpg" type="file" id="gambar" class="form-control" autocomplete="off"/> *max 3mb 
                                <div class="valid-feedback"> Baguss! </div>
                            </div>
                            <br>
                            <div class="modal-footer bg-whitesmoke br">
                                <a href="index.php?ke=pengguna" type="button" class="btn btn-secondary">Batal</a>
                                <button class="btn btn-primary" name="tambahDataPengguna">Simpan</button>
                            </div>
                        </div>
                    </form>
                    <!-- penutup Tambah Data -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Data Pengguna</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php?ke=dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item " aria-current="page">Data Pengguna</li>
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
                        <svg style="margin-right:5px; color:gray;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="white" d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8 .4 34.3z"/></svg>Kembali 
                    </a>
                </div>
                <div class="card-body">
                    <?php
                    // Ambil ID pengguna dari URL
                    $id_pengguna = $_GET['id']; // Pastikan Anda mengirimkan ID pengguna yang ingin diubah

                    // Ambil data pengguna dari database
                    $sql = "SELECT * FROM pengguna WHERE id_admin = '$id_pengguna'";
                    $result = $conn->query($sql);
                    $user = $result->fetch_assoc();

                    // Cek apakah form disubmit
                    if (isset($_POST['ubahDataPengguna'])) {
                        $nama_admin = $_POST['nama_admin'];
                        $email = $_POST['email'];
                        $username = $_POST['username'];
                        $password = $_POST["password"];
                        $tgl_buat = date('Y-m-d H:i:s');

                        // Cek apakah file gambar diupload
                        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== UPLOAD_ERR_NO_FILE) {
                            if ($_FILES['gambar']['error'] !== UPLOAD_ERR_OK) {
                                echo "Terjadi kesalahan saat mengupload gambar: " . $_FILES['gambar']['error'];
                            } else {
                                $gambar = $_FILES['gambar']['name'];

                                // Validasi file gambar
                                $target_dir = "Pengguna/uploads/"; // Folder untuk menyimpan gambar
                                $target_file = $target_dir . basename($gambar);
                                $uploadOk = 1;
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                                                                // Cek ukuran file
                                                                if ($_FILES['gambar']['size'] > 20000000) {
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
                                                                    // Cek apakah folder uploads ada
                                                                    if (!is_dir($target_dir)) {
                                                                        echo "Folder untuk menyimpan gambar tidak ditemukan.";
                                                                    } else {
                                                                        // Pindahkan file ke folder tujuan
                                                                        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
                                                                            // Query untuk memperbarui data pengguna
                                                                            $sql = "UPDATE pengguna SET nama_admin='$nama_admin', email='$email', username='$username', password='$password', gambar='$gambar', tgl_buat='$tgl_buat' WHERE id_admin='$id_pengguna'";
                                
                                                                            if ($conn->query($sql) === TRUE) {
                                                                                header('location:index.php?ke=pengguna');
                                                                            } else {
                                                                                echo "Error: " . $sql . "<br>" . $conn->error;
                                                                            }
                                                                        } else {
                                                                            echo "Maaf, terjadi kesalahan saat mengupload gambar.";
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        } else {
                                                            // Jika tidak ada gambar yang diupload, hanya update data lain
                                                            $sql = "UPDATE pengguna SET nama_admin='$nama_admin', email='$email', username='$username', password='$password', tgl_buat='$tgl_buat' WHERE id_admin='$id_pengguna'";
                                
                                                            if ($conn->query($sql) === TRUE) {
                                                                header('location:index.php?ke=pengguna');
                                                            } else {
                                                                echo "Error: " . $sql . "<br>" . $conn->error;
                                                            }
                                                        }
                                                    }
                                
                                                    $conn->close();
                                                    ?>
                                                    
                                                    <div class="section-title mt-0 ml-4">Ubah Data Pengguna</div>
                                                    <!-- Ubah Data -->
                                                    <form class="needs-validation" novalidate="" action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Nama Lengkap</label>
                                                                <input type="text" class="form-control" name="nama_admin" value="<?php echo $user['nama_admin']; ?>" required="" minlength="10">
                                                                <div class="valid-feedback"> Baguss! </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" required="" minlength="16">
                                                                <div class="valid-feedback"> Baguss! </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Username</label>
                                                                <input type="text" class="form-control" name="username" value="<?php echo $user['username']; ?>" required="" minlength="16">
                                                                <div class="valid-feedback"> Baguss! </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Password</label>
                                                                <input type="password" class="form-control" name="password" value="<?php echo $user['password']; ?>">
                                                                <div class="valid-feedback"> Baguss! </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Gambar</label>
                                                                <input name="gambar" accept="image/png,image/jpeg,image/jpg" type="file" id="gambar" class="form-control" autocomplete="off"/> *max 2mb 
                                                                <div class="valid-feedback"> Baguss! </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Foto Sebelumnya <span class="required">*</span></label>
                                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                                    <img src="Pengguna/uploads/<?php echo $user['gambar']; ?>" class="img-circle" height="80" width="80" style="border: 2px solid #666666;" /> 
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="modal-footer bg-whitesmoke br">
                                                            <a href="index.php?ke=pengguna" type="button" class="btn btn-secondary">Batal</a>
                                <button class="btn btn-primary" name="ubahDataPengguna">Ubah</button>
                            </div>
                        </div>
                    </form>
                    <!-- penutup Ubah Data -->

                </div>
            </div>
        </div>
    </div>
</div>
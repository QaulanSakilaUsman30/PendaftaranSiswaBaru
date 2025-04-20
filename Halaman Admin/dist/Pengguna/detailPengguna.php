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
                    <li class="breadcrumb-item active" aria-current="page">Detail Data Pengguna</li>
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

                    <div class="section-title mt-0 ml-4">Detail Data Pengguna</div>
                    <?php
                        // Bagian untuk menampilkan detail data siswa dalam bentuk form tabel
                        if (isset($_GET['id'])) {
                            $id_admin = mysqli_real_escape_string($conn, $_GET['id']);
                            $query_detail = mysqli_query($conn, "SELECT * FROM pengguna WHERE id_admin = '$id_admin'");
                            $data_admin = mysqli_fetch_assoc($query_detail);

                            if ($data_admin) {
                    ?>
                    <form class="needs-validation" novalidate="" action="" method="POST">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Nama Pengguna</th>
                                        <td><?php echo $data_admin['nama_admin']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?php echo $data_admin['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Username</th>
                                        <td><?php echo $data_admin['username']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Password</th>
                                        <td><?php echo $data_admin['password']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Gambar</th>
                                        <td>
                                            <img src="<?php echo 'Pengguna/uploads/' . $data_admin['gambar']; ?>" height="80" width="80" style="border: 2px solid #666666;" alt="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Buat</th>
                                        <td><?php echo $data_admin['tgl_buat']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="modal-footer bg-whitesmoke br">
                            <a href="index.php?ke=pengguna" type="button" class="btn btn-secondary">Kembali</a>
                            </div>
                    </form>
                        <?php
                                } else {
                                    echo "<p>Data siswa tidak ditemukan.</p>";
                                }
                            } else {
                                // Bagian form tambah data (tetap ada jika Anda ingin menggabungkannya dalam satu halaman)
                        ?>
                        <?php
                            }
                        ?>
                        
                </div>
            </div>
        </div>
    </div>
</div>
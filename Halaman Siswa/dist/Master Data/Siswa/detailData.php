<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Data Siswa</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php?ke=dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item " aria-current="page">Data Siswa</li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Data Siswa</li>
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
                    <a href="index.php?ke=datasiswa" type="button" class="btn btn-primary daterange-btn icon-left btn-icon">
                        <svg style="margin-right:5px; color:gray;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="white" d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8 .4 34.3z"/></svg>Kembali
                    </a>
                </div>
                <div class="card-body">

                    <div class="section-title mt-0 ml-4">Detail Data Siswa</div>
                    <?php
                        // Bagian untuk menampilkan detail data siswa dalam bentuk form tabel
                        if (isset($_GET['id'])) {
                            $id_siswa = mysqli_real_escape_string($conn, $_GET['id']);
                            $query_detail = mysqli_query($conn, "SELECT * FROM data_siswa WHERE Id_Data_Siswa = '$id_siswa'");
                            $data_siswa = mysqli_fetch_assoc($query_detail);

                            if ($data_siswa) {
                    ?>
                    <form class="needs-validation" novalidate="" action="" method="POST">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>NISN</th>
                                        <td><?php echo $data_siswa['NISN']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. KK</th>
                                        <td><?php echo $data_siswa['No_KK']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>NIK</th>
                                        <td><?php echo $data_siswa['NIK']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Panggilan</th>
                                        <td><?php echo $data_siswa['Nama_Panggilan']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Lengkap Peserta Didik</th>
                                        <td><?php echo $data_siswa['Nama_Peserta_Didik']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tempat Lahir</th>
                                        <td><?php echo $data_siswa['Tempat_Lahir']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <td><?php echo $data_siswa['Tanggal_Lahir']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td><?php echo $data_siswa['Jenis_Kelamin']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Agama</th>
                                        <td><?php echo $data_siswa['Agama']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Golongan Darah</th>
                                        <td><?php echo $data_siswa['Gol_Darah']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tinggi Badan</th>
                                        <td><?php echo $data_siswa['Tinggi_Badan']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Berat Badan</th>
                                        <td><?php echo $data_siswa['Berat_Badan']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Suku</th>
                                        <td><?php echo $data_siswa['Suku']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Bahasa</th>
                                        <td><?php echo $data_siswa['Bahasa']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Kewarganegaraan</th>
                                        <td><?php echo $data_siswa['Kewarganegaraan']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Status Anak</th>
                                        <td><?php echo $data_siswa['Status_Anak']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Anak Ke</th>
                                        <td><?php echo $data_siswa['Anak_Ke']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Saudara</th>
                                        <td><?php echo $data_siswa['Jml_Saudara']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Tinggal</th>
                                        <td><?php echo $data_siswa['Jenis_Tinggal']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Alamat Tinggal</th>
                                        <td><?php echo nl2br($data_siswa['Alamat_Tinggal']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Provinsi Tinggal</th>
                                        <td><?php echo $data_siswa['Provinsi_Tinggal']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Kabupaten/Kota Tinggal</th>
                                        <td><?php echo $data_siswa['Kab_Kota_Tinggal']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Kecamatan Tinggal</th>
                                        <td><?php echo $data_siswa['Kec_Tinggal']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Kelurahan Tinggal</th>
                                        <td><?php echo $data_siswa['Kelurahan_Tinggal']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Kode POS</th>
                                        <td><?php echo $data_siswa['Kode_POS']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jarak Ke Sekolah (Meter)</th>
                                        <td><?php echo $data_siswa['Jarak_ke_Sekolah']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Riwayat Penyakit</th>
                                        <td><?php echo nl2br($data_siswa['Riwayat_Penyakit']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Dibuat</th>
                                        <td><?php echo $data_siswa['tgl_buat']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="modal-footer bg-whitesmoke br">
                            <a href="index.php?ke=datasiswa" type="button" class="btn btn-secondary">Kembali</a>
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
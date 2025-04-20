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
                                    <li class="breadcrumb-item active" aria-current="page">Tambah Data Siswa</li>
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
            <!-- <h4>Basic DataTables</h4> -->
            <a href="index.php?ke=datasiswa" type="button" class="btn btn-primary daterange-btn icon-left btn-icon">
            <svg style="margin-right:5px; color:gray;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="white" d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8 .4 34.3z"/></svg>Kembali 
            </a>
          </div>
          <div class="card-body">
          	
          	<div class="section-title mt-0 ml-4">Tambah Data Siswa</div>
            <?php
                if (isset($_POST['tambahDataSiswa'])) {
                    $nisn 				= mysqli_real_escape_string($conn, $_POST['nisn']); 
                    $no_kk 				= mysqli_real_escape_string($conn, $_POST['no_kk']); 
                    $nik 				= mysqli_real_escape_string($conn, $_POST['nik']); 
                    $nama_panggilan		= mysqli_real_escape_string($conn, $_POST['nama_panggilan']); 
                    $nama_lengkap		= mysqli_real_escape_string($conn, $_POST['nama_lengkap']); 
                    $tempat_lahir		= mysqli_real_escape_string($conn, $_POST['tempat_lahir']); 
                    $tanggal_lahir		= mysqli_real_escape_string($conn, $_POST['tanggal_lahir']); 
                    $jenis_kelamin		= mysqli_real_escape_string($conn, $_POST['jenis_kelamin']); 
                    $agama				= mysqli_real_escape_string($conn, $_POST['agama']); 
                    $gol_darah			= mysqli_real_escape_string($conn, $_POST['gol_darah']); 
                    $tinggi_badan		= mysqli_real_escape_string($conn, $_POST['tinggi_badan']);
                    $berat_badan		= mysqli_real_escape_string($conn, $_POST['berat_badan']); 
                    $suku				= mysqli_real_escape_string($conn, $_POST['suku']);
                    $bahasa				= mysqli_real_escape_string($conn, $_POST['bahasa']);
                    $kewarganegaraan	= mysqli_real_escape_string($conn, $_POST['kewarganegaraan']);
                    $status_anak		= mysqli_real_escape_string($conn, $_POST['suku']);
                    $anak_ke			= mysqli_real_escape_string($conn, $_POST['anak_ke']);
                    $jumlah_saudara		= mysqli_real_escape_string($conn, $_POST['jumlah_saudara']);
                    $jenis_tinggal		= mysqli_real_escape_string($conn, $_POST['jenis_tinggal']);
                    $alamat_tinggal		= mysqli_real_escape_string($conn, $_POST['alamat_tinggal']);
                    $provinsi_tinggal	= mysqli_real_escape_string($conn, $_POST['provinsi_tinggal']);
                    $kab_kota_tinggal	= mysqli_real_escape_string($conn, $_POST['kab_kota_tinggal']);
                    $kecamatan_tinggal	= mysqli_real_escape_string($conn, $_POST['kecamatan_tinggal']);
                    $kelurahan_tinggal	= mysqli_real_escape_string($conn, $_POST['kelurahan_tinggal']);
                    $kode_pos			= mysqli_real_escape_string($conn, $_POST['kode_pos']);
                    $jarak_ke_sekolah	= mysqli_real_escape_string($conn, $_POST['jarak_ke_sekolah']);
                    $riwayat_penyakit	= mysqli_real_escape_string($conn, $_POST['riwayat_penyakit']);
                    $tgl_buat 			= date('Y-m-d H:i:s');
            
                    $query = mysqli_query($conn, "INSERT INTO data_siswa SET NISN = '$nisn',
                                                                                  No_KK = '$no_kk',
                                                                                  NIK = '$nik',
                                                                                  Nama_Panggilan = '$nama_panggilan',
                                                                                  Nama_Peserta_Didik = '$nama_lengkap',
                                                                                  Tempat_Lahir = '$tempat_lahir',
                                                                                  Tanggal_Lahir = '$tanggal_lahir',
                                                                                  Jenis_Kelamin = '$jenis_kelamin',
                                                                                  Agama = '$agama',
                                                                                  Gol_Darah = '$gol_darah',
                                                                                  Tinggi_Badan = '$tinggi_badan',
                                                                                  Berat_Badan = '$berat_badan',
                                                                                  Suku = '$suku',
                                                                                  Bahasa = '$bahasa',
                                                                                  Kewarganegaraan = '$kewarganegaraan',
                                                                                  Status_Anak = '$status_anak',
                                                                                  Anak_Ke = '$anak_ke',
                                                                                  Jml_Saudara = '$jumlah_saudara',
                                                                                  Jenis_Tinggal = '$jenis_tinggal',
                                                                                  Alamat_Tinggal = '$alamat_tinggal',
                                                                                  Provinsi_Tinggal = '$provinsi_tinggal',
                                                                                  Kab_Kota_Tinggal = '$kab_kota_tinggal',
                                                                                  Kec_Tinggal = '$kecamatan_tinggal',
                                                                                  Kelurahan_Tinggal = '$kelurahan_tinggal',
                                                                                  Kode_POS = '$kode_pos',
                                                                                  Jarak_ke_Sekolah = '$jarak_ke_sekolah',
                                                                                  Riwayat_Penyakit = '$riwayat_penyakit',
                                                                                  tgl_buat = '$tgl_buat' ");
                                                                                  if ($query) {
                                                                                    header('location:index.php?ke=datasiswa');
                                                                                }else{
                                                                                    echo"<p> Data Gagal Di Simpan";
                                                                                }
                }            
            ?>

            <!-- Tambah Data -->
            <form class="needs-validation" novalidate="" action="" method="POST">
		      <div class="modal-body">
		        <div class="form-group">
		          <label>NISN</label>
		          <input type="number" class="form-control" name="nisn" required="" minlength="10">
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Minimal 10 kata</div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>No. KK</label>
		          <input type="text" class="form-control" name="no_kk" required="" minlength="16">
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Minimal 16 kata</div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>NIK</label>
		          <input type="text" class="form-control" name="nik" required="" minlength="16">
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Minimal 8 kata </div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>Nama Panggilan</label>
		          <input type="text" class="form-control" name="nama_panggilan" required="">
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Wajib Diisi! </div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>Nama Lengkap Peserta Didik</label>
		          <input type="text" class="form-control" name="nama_lengkap" required="">
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Wajib Diisi! </div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>Tempat Lahir</label>
		          <input type="text" class="form-control" name="tempat_lahir" required="">
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Wajib Diisi! </div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>Tanggal Lahir</label>
		          <input type="date" class="form-control" name="tanggal_lahir" required="">
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Wajib Diisi! </div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>Jenis Kelamin</label>
		          <select class="form-control" name="jenis_kelamin" required="">
		            <option value=""> ~~~ PILIH JENIS KELAMIN ~~~ </option>
		            <option value="Laki-Laki">Laki-Laki</option>
		            <option value="Perempuan">Perempuan</option>
		          </select>
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Wajib Diisi! </div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>Agama</label>
		          <input type="text" class="form-control" name="agama" required="">
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Wajib Diisi! </div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>Gol Darah</label>
		          <input type="text" class="form-control" name="gol_darah" required="">
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Wajib Diisi! </div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>Tinggi Badan</label>
		          <input type="number" class="form-control" name="tinggi_badan" required="">
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Wajib Diisi! </div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>Berat Badan</label>
		          <input type="number" class="form-control" name="berat_badan" required="">
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Wajib Diisi! </div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>Suku</label>
		          <input type="text" class="form-control" name="suku" required="">
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Wajib Diisi! </div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>Bahasa</label>
		          <input type="text" class="form-control" name="bahasa" required="">
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Wajib Diisi! </div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>Kewarganegaraan</label>
		          <input type="text" class="form-control" name="kewarganegaraan" required="">
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Wajib Diisi! </div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>Status Anak</label>
		          <input type="text" class="form-control" name="status_anak" required="">
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Wajib Diisi! </div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>Anak Ke</label>
		          <input type="number" class="form-control" name="anak_ke" required="">
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Wajib Diisi! </div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>Jumlah Saudara</label>
		          <input type="number" class="form-control" name="jumlah_saudara" required="">
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Wajib Diisi! </div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>Jenis Tinggal</label>
		          <input type="text" class="form-control" name="jenis_tinggal" required="">
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Wajib Diisi! </div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>Alamat Tinggal</label>
		          <textarea type="text" class="form-control" name="alamat_tinggal" required="" style="height:80px"></textarea>
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Wajib Diisi! </div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>Provinsi Tinggal</label>
		          <input type="text" class="form-control" name="provinsi_tinggal" required="">
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Wajib Diisi! </div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>Kabupaten / Kota Tinggal</label>
		          <input type="text" class="form-control" name="kab_kota_tinggal" required="">
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Wajib Diisi! </div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>Kecamatan Tinggal</label>
		          <input type="text" class="form-control" name="kecamatan_tinggal" required="">
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Wajib Diisi! </div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>Kelurahan Tinggal</label>
		          <input type="text" class="form-control" name="kelurahan_tinggal" required="">
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Wajib Diisi! </div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>Kode POS</label>
		          <input type="number" class="form-control" name="kode_pos" required="">
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Wajib Diisi! </div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>Jarak Ke Sekolah (Meter)</label>
		          <input type="number" class="form-control" name="jarak_ke_sekolah" required="">
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Wajib Diisi! </div>
		          <!-- End Validation -->
		        </div>
		        <div class="form-group">
		          <label>Riwayat Penyakit</label>
		          <textarea type="text" class="form-control" name="riwayat_penyakit" required="" style="height:80px"></textarea>
		          <!-- Validation -->
		          <div class="valid-feedback"> Baguss! </div>
		          <div class="invalid-feedback"> Wajib Diisi! </div>
		          <!-- End Validation -->
		        </div>
		        <br>
		        <div class="modal-footer bg-whitesmoke br">
		          <a href="index.php?ke=datasiswa" type="button" class="btn btn-secondary">Batal</a>
		          <button class="btn btn-primary" name="tambahDataSiswa">Simpan</button>
		        </div>
		      </div>
		    </form>
            <!-- penutup Tambah Data -->

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
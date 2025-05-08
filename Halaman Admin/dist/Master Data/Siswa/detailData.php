<?php
// Ambil ID siswa dari parameter GET
$id_siswa = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';


// Sertakan file koneksi database
require_once '../../koneksi.php'; // Sesuaikan path jika perlu
// Query untuk mengambil data siswa berdasarkan ID yang login
$query_detail = mysqli_query($conn, "SELECT * FROM datasiswa WHERE ID_SISWA = '$id_siswa'");
$data_siswa = mysqli_fetch_assoc($query_detail);

// Query untuk mengambil data orang tua dan wali berdasarkan ID yang login
$query_detail_ortu = mysqli_query($conn, "SELECT * FROM dataortu_wali WHERE ID_SISWA = '$id_siswa'");
$data_ortu_wali = mysqli_fetch_assoc($query_detail_ortu);

// Direktori penyimpanan dokumen
$upload_dir = '../../Halaman Siswa/dist/Master Data/dokumen/'; // Sesuaikan path jika perlu

// Query untuk mengambil data dokumen siswa berdasarkan ID yang login
$query_dokumen = mysqli_query($conn, "SELECT * FROM dokumen WHERE ID_SISWA = '$id_siswa'");
$data_dokumen = mysqli_fetch_assoc($query_dokumen);
?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Siswa</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li style="margin-right:15px;"><a href="index.php?ke=datasiswa" class="btn icon icon-left btn-primary"><svg fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
                        Kembali</a></li>
                        <li style="margin-right:15px;"><a href="Master Data/Siswa/cetak.php?id=<?=$data_siswa['ID_SISWA']?>" class="btn icon icon-left btn-warning"><svg fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M128 0C92.7 0 64 28.7 64 64l0 96 64 0 0-96 226.7 0L384 93.3l0 66.7 64 0 0-66.7c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0L128 0zM384 352l0 32 0 64-256 0 0-64 0-16 0-16 256 0zm64 32l32 0c17.7 0 32-14.3 32-32l0-96c0-35.3-28.7-64-64-64L64 192c-35.3 0-64 28.7-64 64l0 96c0 17.7 14.3 32 32 32l32 0 0 64c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-64zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
                        Cetak PDF</a></li>
                        <li style="margin-right:15px;"><a href="Master Data/Siswa/cetak_excel.php?id=<?=$data_siswa['ID_SISWA']?>" class="btn icon icon-left btn-success"><svg fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M128 0C92.7 0 64 28.7 64 64l0 96 64 0 0-96 226.7 0L384 93.3l0 66.7 64 0 0-66.7c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0L128 0zM384 352l0 32 0 64-256 0 0-64 0-16 0-16 256 0zm64 32l32 0c17.7 0 32-14.3 32-32l0-96c0-35.3-28.7-64-64-64L64 192c-35.3 0-64 28.7-64 64l0 96c0 17.7 14.3 32 32 32l32 0 0 64c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-64zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
                        Cetak EXCEL</a></li>
                        <li><a href="index.php?ke=hapusData&id=<?= htmlspecialchars($data_siswa['ID_SISWA']); ?>" class="btn icon icon-left btn-danger"><svg fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.7 23.7 0 0 0 -21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0 -16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"/></svg>
                        Hapus</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Siswa</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <?php if ($data_siswa): ?>
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Nama Lengkap</td>
                                        <td><?php echo $data_siswa['NAMA_LENGKAP']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Panggilan</td>
                                        <td><?php echo $data_siswa['NAMA_PANGGILAN']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tempat Lahir</td>
                                        <td><?php echo $data_siswa['TEMPAT_LAHIR']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Lahir</td>
                                        <td><?php echo $data_siswa['TGL_LAHIR']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td><?php echo $data_siswa['JENIS_KELAMIN']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Agama</td>
                                        <td><?php echo $data_siswa['AGAMA']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tinggi Badan (cm)</td>
                                        <td><?php echo $data_siswa['TINGGI_BADAN']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Berat Badan (kg)</td>
                                        <td><?php echo $data_siswa['BERAT_BADAN']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Panjang Tangan (cm)</td>
                                        <td><?php echo $data_siswa['PANJANG_TANGAN']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Panjang Kaki (cm)</td>
                                        <td><?php echo $data_siswa['PANJANG_KAKI']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat Rumah</td>
                                        <td><?php echo $data_siswa['ALAMAT_RUMAH']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kode Pos</td>
                                        <td><?php echo $data_siswa['KODE_POS_RUMAH']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Telepon</td>
                                        <td><?php echo $data_siswa['TELEPON_RUMAH']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Asal Sekolah</td>
                                        <td><?php echo $data_siswa['ASAL_SEKOLAH']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kelas / Jurusan</td>
                                        <td><?php echo $data_siswa['KELAS_JURUSAN']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat Sekolah</td>
                                        <td><?php echo $data_siswa['ALAMAT_SEKOLAH']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kode Pos Sekolah</td>
                                        <td><?php echo $data_siswa['KODE_POS_SEKOLAH']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Telepon Sekolah</td>
                                        <td><?php echo $data_siswa['TELEPON_SEKOLAH']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Hobi</td>
                                        <td><?php echo $data_siswa['HOBI']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Keterampilan Khusus</td>
                                        <td><?php echo $data_siswa['KETERAMPILAN_KHUSUS']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Penghargaan Sekolah</td>
                                        <td><?php echo $data_siswa['PENGHARGAAN_SEKOLAH']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Penghargaan Kecamatan</td>
                                        <td><?php echo $data_siswa['PENGHARGAAN_KECAMATAN']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Penghargaan Kab/Kota</td>
                                        <td><?php echo $data_siswa['PENGHARGAAN_KAB_KOTA']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Penghargaan Provinsi</td>
                                        <td><?php echo $data_siswa['PENGHARGAAN_PROVINSI']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Penghargaan Nasional</td>
                                        <td><?php echo $data_siswa['PENGHARGAAN_NASIONAL']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Penghargaan Internasional</td>
                                        <td><?php echo $data_siswa['PENGHARGAAN_INTERNASIONAL']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Buat</td>
                                        <td><?php echo $data_siswa['TGL_BUAT']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Ubah</td>
                                        <td><?php echo $data_siswa['TGL_UBAH']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>Data siswa tidak ditemukan.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Orang Tua</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <?php if ($data_ortu_wali): ?>
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Nama Ayah</td>
                                        <td><?php echo $data_ortu_wali['NAMA_AYAH']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tempat Lahir Ayah</td>
                                        <td><?php echo $data_ortu_wali['TEMPAT_LAHIR_AYAH']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Lahir Ayah</td>
                                        <td><?php echo $data_ortu_wali['TGL_LAHIR_AYAH']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pendidikan Terakhir Ayah</td>
                                        <td><?php echo $data_ortu_wali['PENDIDIKAN_TERAKHIR_AYAH']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Agama Ayah</td>
                                        <td><?php echo $data_ortu_wali['AGAMA_AYAH']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pekerjaan Ayah</td>
                                        <td><?php echo $data_ortu_wali['PEKERJAAN_AYAH']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kode Pos Ayah</td>
                                        <td><?php echo $data_ortu_wali['KODE_POS_AYAH']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Telepon Ayah</td>
                                        <td><?php echo $data_ortu_wali['TELEPON_AYAH']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat Rumah Ayah</td>
                                        <td><?php echo $data_ortu_wali['ALAMAT_RUMAH_AYAH']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Ibu</td>
                                        <td><?php echo $data_ortu_wali['NAMA_IBU']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tempat Lahir Ibu</td>
                                        <td><?php echo $data_ortu_wali['TEMPAT_LAHIR_IBU']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Lahir Ibu</td>
                                        <td><?php echo $data_ortu_wali['TGL_LAHIR_IBU']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pendidikan Terakhir Ibu</td>
                                        <td><?php echo $data_ortu_wali['PENDIDIKAN_TERAKHIR_IBU']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Agama Ibu</td>
                                        <td><?php echo $data_ortu_wali['AGAMA_IBU'];  ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Pekerjaan Ibu</td>
                                        <td><?php echo $data_ortu_wali['PEKERJAAN_IBU']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kode Pos Ibu</td>
                                        <td><?php echo $data_ortu_wali['KODE_POS_IBU']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Telepon Ibu</td>
                                        <td><?php echo $data_ortu_wali['TELEPON_IBU']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat Rumah Ibu</td>
                                        <td><?php echo $data_ortu_wali['ALAMAT_RUMAH_IBU']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Wali</td>
                                        <td><?php echo $data_ortu_wali['NAMA_WALI']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tempat Lahir Wali</td>
                                        <td><?php echo $data_ortu_wali['TEMPAT_LAHIR_WALI']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Lahir Wali</td>
                                        <td><?php echo $data_ortu_wali['TGL_LAHIR_WALI']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pendidikan Terakhir Wali</td>
                                        <td><?php echo $data_ortu_wali['PENDIDIKAN_TERAKHIR_WALI']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Agama Wali</td>
                                        <td><?php echo $data_ortu_wali['AGAMA_WALI']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pekerjaan Wali</td>
                                        <td><?php echo $data_ortu_wali['PEKERJAAN_WALI']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kode Pos Wali</td>
                                        <td><?php echo $data_ortu_wali['KODE_POS_WALI']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Telepon Wali</td>
                                        <td><?php echo $data_ortu_wali['TELEPON_WALI']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Hubungan dengan Siswa</td>
                                        <td><?php echo $data_ortu_wali['HUBUNGAN_WALI']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat Rumah Wali</td>
                                        <td><?php echo $data_ortu_wali['ALAMAT_RUMAH_WALI']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Buat</td>
                                        <td><?php echo $data_ortu_wali['TGL_BUAT1']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Ubah</td>
                                        <td><?php echo $data_ortu_wali['TGL_UBAH1']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>Data orang tua tidak ditemukan.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Siswa (Dokumen)</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" method="POST" enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="row">
                                      <div class="buttons">
                                          <a href="<?php echo $upload_dir . (isset($data_dokumen['AKTA']) ? $data_dokumen['AKTA'] : 'AKTA_' . $id_siswa_login . '.pdf && .docx'); ?>" target="_blank" class="btn btn-primary rounded-pill btn-lg <?php echo (empty($data_dokumen['AKTA']) ?  : ''); ?>">
                                              Show Akta Kelahiran
                                          </a>
                                          <a href="<?php echo $upload_dir . (isset($data_dokumen['KARTU_KELUARGA']) ? $data_dokumen['KARTU_KELUARGA'] : 'KARTU_KELUARGA_' . $id_siswa_login . '.jpg'); ?>" target="_blank" class="btn btn-secondary rounded-pill btn-lg <?php echo (empty($data_dokumen['KARTU_KELUARGA']) ? : ''); ?>">
                                              Show Kartu Keluarga
                                          </a>
                                          <a href="<?php echo $upload_dir . (isset($data_dokumen['IJAZAH']) ? $data_dokumen['IJAZAH'] : 'IJAZAH_' . $id_siswa_login . '.pdf'); ?>"
                                              target="_blank" class="btn btn-info rounded-pill btn-lg <?php echo (empty($data_dokumen['IJAZAH']) ?  : ''); ?>">
                                              Show Ijazah
                                          </a>
                                          <a href="<?php echo $upload_dir . (isset($data_dokumen['SKL']) ? $data_dokumen['SKL'] : 'SKL_' . $id_siswa_login . '.pdf'); ?>"
                                              target="_blank" class="btn btn-warning rounded-pill btn-lg <?php echo (empty($data_dokumen['SKL']) ?  : ''); ?>">
                                              Show SKL
                                          </a>
                                          <a href="<?php echo $upload_dir . (isset($data_dokumen['BUKU_PIP']) ? $data_dokumen['BUKU_PIP'] : 'BUKU_PIP_' . $id_siswa_login . '.pdf'); ?>"
                                              target="_blank" class="btn btn-danger rounded-pill btn-lg <?php echo (empty($data_dokumen['BUKU_PIP']) ? : ''); ?>">
                                              Show Buku PIP
                                          </a>
                                      </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</section>
</div>

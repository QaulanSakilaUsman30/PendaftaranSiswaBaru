<?php
include '../../koneksi.php';

// Ambil ID data yang akan ditampilkan dari parameter GET
$id_administrasi = $_GET['id'];

// Query untuk mengambil data administrasi berdasarkan ID
$data = mysqli_query($conn, "SELECT `ID_BAYAR`, `ID_SISWA`, `NAMA_BANK`, `BUKTI_TRANSFER`, `STATUS`, `JUMLAH_BIAYA`, `TGL_BUAT`, `TGL_UBAH` FROM `administrasi` WHERE `ID_BAYAR`='$id_administrasi'") or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($data);

// Ambil data siswa berdasarkan ID_SISWA
$id_siswa = $row['ID_SISWA'];
$siswa_data = mysqli_query($conn, "SELECT `NAMA_LENGKAP` FROM `datasiswa` WHERE `ID_SISWA`='$id_siswa'") or die(mysqli_error($conn));
$siswa_row = mysqli_fetch_assoc($siswa_data);

$conn->close();
?>

<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Detail Pembayaran</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php?ke=dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="index.php?ke=pembayaran">Pembayaran</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Pembayaran</li>
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
                    <div class="section-title mt-0 ml-4">Detail Data Pembayaran</div>
                    <?php if ($row): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>ID Pembayaran</th>
                                        <td><?= htmlspecialchars($row['ID_BAYAR']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>ID Siswa</th>
                                        <td><?= htmlspecialchars($row['ID_SISWA']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <td><?= htmlspecialchars($siswa_row['NAMA_LENGKAP']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Bank</th>
                                        <td><?= htmlspecialchars($row['NAMA_BANK']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Bukti Transfer</th>
                                        <td>
                                            <?php if (!empty($row['BUKTI_TRANSFER'])): ?>
                                                <img src="Master Data/bukti/<?= htmlspecialchars($row['BUKTI_TRANSFER']); ?>" height="200" style="border: 1px solid #ccc;" alt="Bukti Transfer">
                                            <?php else: ?>
                                                Tidak ada bukti transfer.
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status Pembayaran</th>
                                        <td><?= htmlspecialchars($row['STATUS']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Biaya</th>
                                        <td><?= htmlspecialchars($row['JUMLAH_BIAYA']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Buat</th>
                                        <td><?= htmlspecialchars($row['TGL_BUAT']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Ubah</th>
                                        <td><?= htmlspecialchars($row['TGL_UBAH']); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="modal-footer bg-whitesmoke br">
                            <a href="index.php?ke=pembayaran" type="button" class="btn btn-secondary">Kembali</a>
                        </div>
                    <?php else: ?>
                        <p>Data pembayaran tidak ditemukan.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
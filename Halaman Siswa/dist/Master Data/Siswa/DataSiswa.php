        <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Data Siswa</h3>
                            <p class="text-subtitle text-muted">Data siswa yang mendaftar</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php?ke=dashboard">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <a href="index.php?ke=tambahData" type="button" class="btn btn-primary daterange-btn icon-left btn-icon">
                            <svg style="margin-right:5px; color:gray;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="white" d="M416 208H272V64c0-17.7-14.3-32-32-32h-32c-17.7 0-32 14.3-32 32v144H32c-17.7 0-32 14.3-32 32v32c0 17.7 14.3 32 32 32h144v144c0 17.7 14.3 32 32 32h32c17.7 0 32-14.3 32-32V304h144c17.7 0 32-14.3 32-32v-32c0-17.7-14.3-32-32-32z"/>
                            </svg>Tambah Data Siswa 
                            </a>
                        </div>
                        
                        <div class="card-body">
                            <table class="table table-striped" id="table-1">
                                <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                <div class="dataTable-top">
                                    <div class="dataTable-dropdown">
                                        <select class="dataTable-selector form-select">
                                            <option value="5">5</option>
                                            <option value="10" selected="">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                        </select>
                                        <label>entries per page</label>
                                    </div>
                                    <div class="dataTable-search">
                                        <input class="dataTable-input" placeholder="Search..." type="text">
                                    </div>
                                </div>
                                <div class="dataTable-container">
                                    <table class="table table-striped dataTable-table" id="table1">
                                <thead>
                                <tr>
                                    <th class="text-center"> No </th>
                                    <th>NISN</th>
                                    <th>Nama Lengkap</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>Tanggal Buat</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $no = 1;
                                    $data = mysqli_query($conn, "SELECT Id_Data_Siswa, NISN, Nama_Peserta_Didik, Tanggal_Lahir, Alamat_Tinggal, tgl_ubah FROM data_siswa") or die(mysqli_error($conn));
                                    foreach ($data as $row) { 
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['NISN']; ?></td>
                                    <td><?= $row['Nama_Peserta_Didik']; ?></td>
                                    <td><?= $row['Tanggal_Lahir']; ?></td>
                                    <td><?= $row['Alamat_Tinggal']; ?></td>
                                    <td><?= $row['tgl_ubah']; ?></td>              	
                                    <td class="text-center" width="120px">
                                    <div style="display: flex; gap: 10px;">
                                        <a href="index.php?ke=detailData&id=<?= $row['Id_Data_Siswa']; ?>" class="btn btn-warning my-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="white" d="M572.5 241.4C518.3 135.6 410.9 64 288 64S57.7 135.6 3.5 241.4a32.4 32.4 0 0 0 0 29.2C57.7 376.4 165.1 448 288 448s230.3-71.6 284.5-177.4a32.4 32.4 0 0 0 0-29.2zM288 400a144 144 0 1 1 144-144 143.9 143.9 0 0 1 -144 144zm0-240a95.3 95.3 0 0 0 -25.3 3.8 47.9 47.9 0 0 1 -66.9 66.9A95.8 95.8 0 1 0 288 160z"/></svg></a>
                                        <a href="index.php?ke=hapusData&id=<?= $row['Id_Data_Siswa']; ?>" class="btn btn-danger my-2" onclick="return confirm('Anda Yakin');"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="white" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1 -32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1 -32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1 -32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.7 23.7 0 0 0 -21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0 -16-16z"/></svg></a>
                                    </div>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tbody>
                                </table>
                            </div>
                            <div class="dataTable-bottom">
                                <div class="dataTable-info">Showing 1 to 10 of 26 entries</div>
                                <ul class="pagination pagination-primary float-end dataTable-pagination">
                                    <li class="page-item pager">
                                        <a href="#" class="page-link" data-page="1">‹</a>
                                    </li>
                                    <li class="page-item active">
                                        <a href="#" class="page-link" data-page="1">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link" data-page="2">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link" data-page="3">3</a>
                                    </li>
                                    <li class="page-item pager">
                                        <a href="#" class="page-link" data-page="2">›</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </table>
                </div>
            </div>
    </section>
  </div>

<div class="page-heading">
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
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="index.php?ke=tambahPengguna" type="button" class="btn btn-primary daterange-btn icon-left btn-icon">
                    <svg style="margin-right:5px; color:gray;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path fill="white" d="M416 208H272V64c0-17.7-14.3-32-32-32h-32c-17.7 0-32 14.3-32 32v144H32c-17.7 0-32 14.3-32 32v32c0 17.7 14.3 32 32 32h144v144c0 17.7 14.3 32 32 32h32c17.7 0 32-14.3 32-32V304h144c17.7 0 32-14.3 32-32v-32c0-17.7-14.3-32-32-32z"/>
                    </svg>Tambah Data Pengguna 
                </a>
            </div>
            <div class="card-body">
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
                                    <th>Nama Pengguna</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Tanggal Buat</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;
                                    $data = mysqli_query($conn, "SELECT `id_admin`, `nama_admin`, `email`, `username`, `password`, `gambar`, `tgl_buat` FROM `pengguna`") or die(mysqli_error($conn));
                                    foreach ($data as $row) { 
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['nama_admin']; ?></td>
                                    <td><?= $row['email']; ?></td>
                                    <td><?= $row['username']; ?></td>
                                    <td><?= $row['tgl_buat']; ?></td>              	
                                    <td class="text-center" width="120px">
                                        <div style="display: flex; gap: 10px;">
                                            <a href="index.php?ke=detailPengguna&id=<?= $row['id_admin']; ?>" class="btn btn-warning my-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                    <path fill="white" d="M572.5 241.4C518.3 135.6 410.9 64 288 64S57.7 135.6 3.5 241.4a32.4 32.4 0 0 0 0 29.2C57.7 376.4 165.1 448 288 448s230.3-71.6 284.5-177.4a32.4 32.4 0 0 0 0-29.2zM288 400a144 144 0 1 1 144-144 143.9 143.9 0 0 1 -144 144zm0-240a95.3 95.3 0 0 0 -25.3 3.8 47.9 47.9 0 0 1 -66.9 66.9A95.8 95.8 0 1 0 288 160z"/>
                                                </svg>
                                            </a>
                                            <a href="index.php?ke=ubahPengguna&id=<?= $row['id_admin']; ?>" class="btn btn-primary my-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path fill="white" d="M497.9 142.1l-46.1 46.1c-4.7 4.7-12.3 4.7-17 0l-111-111c-4.7-4.7-4.7-12.3 0-17l46.1-46.1c18.7-18.7 49.1-18.7 67.9 0l60.1 60.1c18.8 18.7 18.8 49.1 0 67.9zM284.2 99.8L21.6 362.4 .4 483.9c-2.9 16.4 11.4 30.6 27.8 27.8l121.5-21.3 262.6-262.6c4.7-4.7 4.7-12.3 0-17l-111-111c-4.8-4.7-12.4-4.7-17.1 0zM124.1 339.9c-5.5-5.5-5.5-14.3 0-19.8l154-154c5.5-5.5 14.3-5.5 19.8 0s5.5 14.3 0 19.8l-154 154c-5.5 5.5-14.3 5.5-19.8 0zM88 424h48v36.3l-64.5 11.3-31.1-31.1L51.7 376H88v48z"/>
                                                </svg>
                                            </a>
                                            <a href="index.php?ke=hapusPengguna&id=<?= $row['id_admin']; ?>" class="btn btn-danger my-2" onclick="return confirm('Anda Yakin');">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                    <path fill="white" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1 -32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1 -32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1 -32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.7 23.7 0 0 0                                                    <path fill="white" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1 -32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1 -32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1 -32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.7 23.7 0 0 0 -21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0 -16-16z"/>
                                                </svg>
                                            </a>
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
            </div>
        </div>
    </section>
</div>
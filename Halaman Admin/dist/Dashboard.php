            <div class="page-heading">
                <h3>Dashboard</h3>
            </div>
            <div class="page-content" style="margin-bottom:32%;">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <div class="col-4 col-lg-4 col-md-4">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldShow"></i>
                                                </div>
                                            </div>
                                            <?php include '../../koneksi.php';
                                            $sql1		= "SELECT * FROM datasiswa";  
                                            $query1  	= mysqli_query($conn, $sql1);
                                            $jumlah1   = mysqli_num_rows($query1);
                                            ?>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Total Pendaftar</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo "$jumlah1" ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 col-lg-4 col-md-4">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <?php include '../../koneksi.php';
                                           $status_dicari = 'diverifikasi'; // Ganti dengan nilai status yang sebenarnya di database Anda

                                           $sql_diverifikasi = "SELECT * FROM datasiswa WHERE STATUS = '$status_dicari'";
                                           $query_diverifikasi = mysqli_query($conn, $sql_diverifikasi);
                                           $jumlah_diverifikasi = mysqli_num_rows($query_diverifikasi);
                                            ?>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Total Pendaftar yang Terverifikasi</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo "$jumlah_diverifikasi" ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 col-lg-4 col-md-4">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="stats-icon green">
                                                    <i class="iconly-boldAdd-User"></i>
                                                </div>
                                            </div>
                                            <?php include '../../koneksi.php';
                                            $sql1		= "SELECT * FROM dataadmin";  
                                            $query1  	= mysqli_query($conn, $sql1);
                                            $jumlah1   = mysqli_num_rows($query1);
                                            ?>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Total Pengguna</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo "$jumlah1" ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
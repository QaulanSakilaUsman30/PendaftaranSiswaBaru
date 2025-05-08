<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login - Siswa</title>
    <link rel="icon" type="image/png" href="assets/images/logo/loder.png"/>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">

</head>

<body>
    <div id="auth">
        <div class="row h-100" style="display: flex; align-items: stretch;">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img src="assets/images/logo/SMP2.jpeg" alt="Logo" style="width: 50%; height: auto;"></a>
                    </div>
                    <h1 class="auth-title" style="font-size: 35px">Selamat Datang di PSB</h1>
                    <p class="auth-subtitle mb-5" style=" font-size: 20px">Sebelum Anda memulai, Anda harus masuk atau mendaftar jika Anda belum memiliki akun.</p>
                    <?php
					session_start();
					include '../../koneksi.php';

					if (isset($_POST['loginData'])) {
						$Telp = mysqli_real_escape_string($conn, $_POST['TELEPON_RUMAH']);
						$tanggal_lahir = mysqli_real_escape_string($conn, $_POST['TGL_LAHIR']);
						// Debugging
						var_dump($Telp, $tanggal_lahir);

						$query = mysqli_query($conn, "SELECT * FROM datasiswa WHERE TELEPON_RUMAH = '$Telp' AND TGL_LAHIR = '$tanggal_lahir'") or die(mysqli_error($conn));

						if (mysqli_num_rows($query) > 0) {
							foreach ($query as $row) {
								$_SESSION['ID_SISWA'] = $row['ID_SISWA']; // Tambahkan session ID siswa
								$_SESSION['TelpSiswa'] = $Telp;
								$_SESSION['namaSiswa'] = $row['NAMA_LENGKAP'];
								$_SESSION['tlPeserta'] = $tanggal_lahir;
								header('Location: index.php');
								exit();
							}
						} else {
							echo "<p>Telepon Rumah dan Tanggal Lahir tidak cocok!</p>";
						}
					}
					?>
                    <form method="POST">
                        <label for="" class="mb-2"><b>Username</b></label>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" name="TELEPON_RUMAH" placeholder="Silahkan masukkan no.telp rumah">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <label for="" class="mb-2" ><b>Password</b></label>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="date" class="form-control form-control-xl" name="TGL_LAHIR" placeholder="Silahkan Masukkan Tgl Lahir">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="container-login100-form-btn">
                            <div style="display: flex; align-items: center;">
                                <a href="../../index/index.php" style="color: white; margin-top: 2%; margin-right: 180px;" class="btn btn-primary btn-block btn-lg shadow-lg mt-5"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Kembali</a>
                                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" style="margin-left: auto;" name="loginData">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Belum Punya akun ? <a href="../../index/daftarsiswa.php"
                                class="font-bold">Daftar</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block" >
                <div id="auth-right" style="height: auto;">
                    <img src="assets/images/bg/hisu-lee-V4Pn7QeYdPQ-unsplash.jpg" alt="Login Image" style="width: 100%; height:100%; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</body>

</html>
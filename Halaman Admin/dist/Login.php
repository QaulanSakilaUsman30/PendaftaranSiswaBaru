<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login - Admin</title>
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
                    <h1 class="auth-title" >Log in Admin</h1>
                    <p class="auth-subtitle mb-5" style=" font-size: 20px">Silahkan isi Username dan Password untuk login</p>
                    <?php
                        session_start();
                        include '../../koneksi.php';

                        if (isset($_POST['loginData'])) {
                            if (isset($_POST['USERNAME']) && isset($_POST['PASSWORD'])) {
                                $USERNAME = $_POST['USERNAME']; // Baris 37
                                $PASSWORD = $_POST['PASSWORD']; // Baris 38

                                $query = mysqli_query($conn, "SELECT * FROM dataadmin WHERE USERNAME ='$USERNAME' AND PASSWORD = '$PASSWORD'");

                                if (mysqli_num_rows($query) > 0) {
                                    $userData = mysqli_fetch_array($query);
                                    $_SESSION['sID_ADMIN'] = $userData['ID_ADMIN'];
                                    $_SESSION['sNAMA_ADMIN'] = $userData['NAMA_ADMIN'];
                                    $_SESSION['sGAMBAR_ADMIN'] = $userData['GAMBAR']; // Simpan nama gambar ke dalam sesi


                                    header('location:index.php');
                                    exit();
                                } else {
                                    echo "<p>Username dan password salah!</p>";
                                }
                            } else {
                                echo "<p>Username dan password belum diisi!</p>";
                            }
                        }
                        ?>
                    <form method="POST">
                        <label for="" class="mb-2"><b>Username</b></label>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" name="USERNAME" placeholder="Username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <label for="" class="mb-2" ><b>Password</b></label>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="PASSWORD" placeholder="Password">
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
                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved 
                                  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
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
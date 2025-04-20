<?php
session_start();
include '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login | SMPN 6 TIKEP</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/loder.png"/>
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
            <div class="wrap-login100">
                <form class="login100-form validate-form" method="POST" action="">
                    <span class="login100-form-logo">
                        <img src="images/icons/loder.png" alt="" width="50px" height="50px">
                    </span>
                    <span class="login100-form-title p-b-34 p-t-27">
                        Log in Pegawai
                    </span>
                    <?php
                    if (isset($_POST['loginData'])) {
                        $username = $_POST['username'];
                        $password = $_POST['password'];

                        $query = mysqli_query($conn, "SELECT * FROM pengguna WHERE username ='$username' AND password = '$password'");

                        if (mysqli_num_rows($query) > 0) {
                            $userData = mysqli_fetch_array($query);
                            $_SESSION['sid_admin'] = $userData['id_admin'];
                            $_SESSION['snama_admin'] = $userData['nama_admin'];
                            

                            header('location:../Halaman Admin/dist/index.php');
                        } else {
                            echo "<p>Username dan password salah!</p>";
                        }
                    }
                    ?>
                    <div class="wrap-input100 validate-input" data-validate = "Masukkan username">
                        <input class="input100" type="text" name="username" placeholder="Username" id="username">
                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Masukkan password">
                        <input class="input100" type="password" name="password" placeholder="Password" id="password">
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>

                    <div class="contact100-form-checkbox">
                        <label style="color: rgb(18, 3, 104); align-items:justify; text-align: justify;">
                            <i class="fa fa-thumb-tack fa-4" aria-hidden="true" style="color: rgb(18, 3, 104); margin-right: 6px;"></i>Masukkan Username dan Password untuk login !
                        </label>
                    </div>

                    <div class="container-login100-form-btn">
                        <div style="display: flex; align-items: center;">
                            <a href="../index/index.php" style="color: white; margin-top: 2%; margin-right: 180px;"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Kembali</a>
                            <button class="login100-form-btn" style="margin-left: auto;" name="loginData">
                                Login
                            </button>
                        </div>
                    </div>
                </form>

                <div class="text-center p-t-90">
                    <a class="txt1" href="#">
                        Copyright <i class="fa fa-copyright" aria-hidden="true"></i> SMPN 6 TIKEP
                    </a>
                </div>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <script src="js/main.js"></script>

</body>
</html>
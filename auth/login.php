<?php

session_start();

if (isset($_SESSION["ssLoginPOS"])) {
    header("location: ../dashboard.php");
    exit();
}

require "../config/config.php";

if (isset($_POST['login'])) {
    $username   = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password   = mysqli_real_escape_string($koneksi, $_POST['password']);

    $queryLogin = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");

    if (mysqli_num_rows($queryLogin) === 1) {
        $row = mysqli_fetch_assoc($queryLogin);
        if (password_verify($password, $row['password'])) {
            // set session
            $_SESSION["ssLoginPOS"] = true;
            $_SESSION["ssUserPOS"] = $username;


            header("location: ../dashboard.php");
            exit();
        } else {
            echo "<script>alert('Password salah..');</script>";
        }
    } else {
        echo "<script>alert('Username tidak terdaftar..');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Kasir ViaaMart</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= $main_url ?>asset/AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= $main_url ?>asset/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= $main_url ?>asset/AdminLTE/dist/css/adminlte.min.css">
    <!-- favicon -->
    <link rel="shorcut icon" href="<?= $main_url ?>asset/image/cart.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>

<body class="hold-transition login-page" id="bg-login">
    <div class="login-box slide-down" style="margin-top: -70px;">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1"><b>Kasir</b> ViaaMart</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="" method="post">
                    <div class="input-group mb-4">
                        <input type="text" name="username" class="form-control" placeholder="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <button type="submit" name="login" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </form>
                <p class="my-3 text-center">
                    <strong>Copyright &copy; 2023 <span class="text-info">oktaviafatma</span> </strong>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= $main_url ?>asset/AdminLTE/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= $main_url ?>asset/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= $main_url ?>asset/AdminLTE/dist/js/adminlte.min.js"></script>
</body>

</html>
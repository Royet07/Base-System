<!-- Include : Login Controller -->
<?php
include './Controller.php';
?>
<!-- END -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sasad Pharmacy | Login</title>
  <link rel="shortcut icon" href="../../Assets/images/bg.png" type="image/x-icon" />

  <!-- Google Font: Source Poppins -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap">

  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../Contents/fontAwesome/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../Contents/icheck_bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../Contents/css/adminlte.min.css">
  <!-- Custom style -->
  <link rel="stylesheet" href="../../Contents/css/custom.css">
</head>

<body class="hold-transition login-page bg-back">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="" class="brand-link">
          <img src="../../Assets/images/bg.png" alt="Sasad Logo" width="120">
        </a>
        <p class="p-class">Sasad Pharmacy Management System</p>
      </div>
      <div class="card-body">
        <!-- Login Validation -->
        <div class="card-body">
          <div id="Loginerror" class="text-center">
            <p id="invalidCreds" class="text-white"></p>
          </div>
          <!-- END -->
          <form id="frmLogin">
            <div class="input-group mb-3">
              <div class="input-group-append">
                <div class="input-group-text color">
                  <span class="fas fa-user"></span>
                </div>
              </div>
              <input id="inputUsername" type="text" class="form-control" placeholder="Username" name="Username" value="<?php if (isset($_POST['Username'])) {
                                                                                                                          echo $_POST['Username'];
                                                                                                                        } ?>" required>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-append">
                <div class="input-group-text color">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
              <input id="inputPassword" type="password" class="form-control" placeholder="Password" name="Password" value="" required>
            </div>
            <div class="input-group mb-3 justify-content-end">
              <a href="../login/forgotpassword.php" type="submit" class="">Forgot Password?</a>
            </div>
            <div class="row">
              <div class="col-6 offset-3">
                <button id="btnLogin" name="Login" class="btn btn-block btn-bg" style="background-color: rgb(31,108,163); color: white;">Login</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../../Scripts/js/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../Scripts/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../Scripts/js/adminlte.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../Scripts/js/customjs.js"></script>
</body>

</html>
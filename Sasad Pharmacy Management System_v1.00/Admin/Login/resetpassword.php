<?php
    include './Controller.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sasad Pharmacy | Reset Password</title>
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
        <div class="card card-outline card-info">
            <div class="card-header text-center">
                <a href="" class="brand-link">
                    <img src="../../Assets/images/bg.png" alt="Sasad Logo" width="120">
                </a>
                <p class="p-class">Sasad Pharmacy Management System</p>
            </div>
            <div class="card-body">
            <?php 
                if(isset($_SESSION['info'])){
                    ?>
                        <div class="alert alert-success text-center" style="padding: 0.4rem 0.4rem">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                <?php
                unset($_SESSION['info']);
                }
                ?>
                
                <?php
                if(count($errors) > 0){
                ?>
                    <div class="alert alert-danger text-center">
                        <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                        ?>
                    </div>
                <?php
                }
                ?>
                <p class="login-box-msg">Create New Password</p>
                <form id="frmNewpassword">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text color">
                                <span class="fas fa-key"></span>
                            </div>
                        </div>
                        <input id="curpass" type="password" class="form-control" placeholder="Current Password" name="curpass" maxlength=""
                        value="<?php if(isset($_POST['curpass'])){ echo $_POST['curpass'];} ?>" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text color">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input id="newpass" type="password" class="form-control" placeholder="New Password" name="newpass" maxlength=""
                        value="<?php if(isset($_POST['newpass'])){ echo $_POST['newpass'];} ?>" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text color">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input id="connewpass" type="password" class="form-control" placeholder="Confirm New Password" name="connewpass" maxlength=""
                        value="<?php if(isset($_POST['connewpass'])){ echo $_POST['connewpass'];} ?>" required>
                    </div>
                    <p id="invalidPass" class="login-box-msg text-red"></p>
                    <div class="row">
                        <div class="col-6 offset-3">
                            <button id="changePassword" class="btn btn-block btn-bg"
                                style="background-color: rgb(31,108,163); color: white;">Change Password</button>
                        </div>
                    </div>
                    <div class="input-group mb-3 justify-content-start">
                            <a href="../login/forgotpassword.php" type="submit" class="">Back</a>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
</body>
<script src="../../Scripts/js/jquery.min.js" type="text/javascript"></script>
<script src="../../Scripts/js/customjs.js" type="text/javascript"></script>
</html>
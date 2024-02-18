<?php
    include './Controller.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sasad Pharmacy | Verify OTP</title>
    <link rel="shortcut icon" href="../../Assets/images/bg.png" type="image/x-icon" />

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
                <p class="login-box-msg">An email has been sent to - <span class="text-bold"><?php if(isset($_SESSION['mail'])){ echo $_SESSION['mail']; }else{ echo ""; } ?></span>. Kindly check your email for the OTP Code.</p>
                <form id="frmForgotpassword">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text color">
                                <span class="fas fa-lock-open"></span>
                            </div>
                        </div>
                        <input id="sessionCode" type="hidden" value="<?php if(isset($_SESSION['code'])){ echo $_SESSION['code']; }else{ echo "0"; } ?>">
                        <input id="code" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control" placeholder="6-Digit Code" name="code" maxlength="6"
                        value="<?php if(isset($_POST['code'])){ echo $_POST['code'];} ?>" required>
                    </div>
                    <p id="invalidCode" class="login-box-msg text-red"></p>
                    <div class="row">
                        <div class="col-6 offset-3">
                            <button id="verifyCode" class="btn btn-block btn-bg"
                                style="background-color: rgb(31,108,163); color: white;">Verify Code</button>
                        </div>
                    </div>
                    <div class="input-group mb-3 justify-content-start">
                            <a href="../Login/forgotpassword.php" type="submit" class="">Back</a>
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
<?php 
require "../../DB_folder/db_connection.php";
$username='';
$errors = array();


//Change New Password
if(isset($_POST['changePass'])) {
    $username = mysqli_real_escape_string($con, $_POST['Username']);
    $curpass = mysqli_real_escape_string($con, $_POST['Connewpass']);
    $hashPassword = md5($curpass);

    $check_username = "SELECT * FROM users WHERE Username = '$username'";
    $res = mysqli_query($con, $check_username);
    if(mysqli_num_rows($res) > 0)
    {
        $fetch = mysqli_fetch_assoc($res);
        $fetch_Id = $fetch['Id'];
        $fetch_mail = $fetch['Email'];

        //Update Password
        $update_data = "UPDATE users 
        SET Password = '$hashPassword'
            WHERE Id='$fetch_Id'";

        $data_check = mysqli_query($con, $update_data);      
        if ($data_check) 
        { 
            echo json_encode(array('isChange' => 1));
        }
        else{ 
            echo json_encode(array('isChange' => 0));
        }
    }
    else{
        echo json_encode(array('invalidChange' => 1));
    }
}

//Check User Current Pass
if(isset($_POST['checkCurrentPass'])) {
    $username = mysqli_real_escape_string($con, $_POST['Username']);
    $curpass = mysqli_real_escape_string($con, $_POST['curpass']);

    $check_username = "SELECT * FROM users WHERE Username = '$username'";
    $res = mysqli_query($con, $check_username);
    if(mysqli_num_rows($res) > 0)
    {
        $fetch = mysqli_fetch_assoc($res);
        $fetch_mail = $fetch['Email'];
        $fetch_pass = $fetch['Password'];

        if($fetch_pass === md5($curpass)){
            echo json_encode(array('isCurrent' => 1));
        }else{
            echo json_encode(array('isCurrent' => 0));
        }
    }
    else{
        echo json_encode(array('invalidUsername' => 1));
    }
}

//Check User Email
if(isset($_POST['checkUserMail'])) {
    $username = mysqli_real_escape_string($con, $_POST['Username']);
    $mail = mysqli_real_escape_string($con, $_POST['Email']);

    $check_username = "SELECT * FROM users WHERE Username = '$username'";
    $res = mysqli_query($con, $check_username);
    if(mysqli_num_rows($res) > 0)
    {
        $fetch = mysqli_fetch_assoc($res);
        $fetch_mail = $fetch['Email'];

        if($fetch_mail === $mail){
            echo json_encode(array('checkMail' => 1));
        }else{
            echo json_encode(array('invalidMail' => 1));
        }
    }
    else{
        echo json_encode(array('invalidUsername' => 1));
    }
}

//if user click login button
if(isset($_POST['fnLogin'])){
    $username = mysqli_real_escape_string($con, $_POST['Username']);
    $password = mysqli_real_escape_string($con, $_POST['Password']);

    $check_username = "SELECT * FROM users WHERE Username = '$username'";
    $res = mysqli_query($con, $check_username);
    if(mysqli_num_rows($res) > 0)
    {
        $fetch = mysqli_fetch_assoc($res);
        $fetch_pass = $fetch['Password'];
        $accountType = $fetch['AccountType'];
        $status = $fetch['Status'];
                    
        if(md5($password) == $fetch_pass && $accountType == 1)
        {
                $_SESSION['Uid'] =$fetch['Uid'];
                $_SESSION['Id'] = $fetch['Id'];
                $_SESSION['Username'] = $fetch['Username'];
                $_SESSION['Fullname'] = $fetch['Firstname'].' '.$fetch['Lastname'];
                $_SESSION['AccountType'] = $fetch['AccountType'];
                $_SESSION['Status'] = $fetch['Status'];

                echo json_encode(array('isLogin' => 1));
        }
        // else if(md5($password) == $fetch_pass && $accountType=="Staff")
        // {
        //     if((int)$status === 1)
        //     {
        //         $errors['username'] = "Your Account has been Deactivated. Please Contact Your Administrator.";
        //     }else{
        //         $_SESSION['unique_id'] =$fetch['unique_id'];
        //         $_SESSION['admin_id'] = $fetch['id'];
        //         $_SESSION['username'] = $fetch['username'];
        //         $_SESSION['fullname'] = $fetch['fname'].' '.$fetch['lname'];
        //         $_SESSION['username'] = $fetch['username'];
        //         $_SESSION['group_lvl'] = $fetch['group_lvl'];

        //         echo "<script>if(confirm('Login Successfully !')){document.location.href='../home.php'};</script>";    
        //     }
        // }
        // else if(md5($password) == $fetch_pass && $accountType=="Client")
        // {
        //     if((int)$status === 1)
        //     {
        //         $errors['username'] = "Your Account has been Deactivated. Please Contact Your Administrator.";
        //     }else{
        //         $_SESSION['unique_id'] =$fetch['unique_id'];
        //         $_SESSION['admin_id'] = $fetch['id'];
        //         $_SESSION['username'] = $fetch['username'];
        //         $_SESSION['fullname'] = $fetch['fname'].' '.$fetch['lname'];
        //         $_SESSION['username'] = $fetch['username'];
        //         $_SESSION['group_lvl'] = $fetch['group_lvl'];

        //         echo "<script>if(confirm('Login Successfully !')){document.location.href='../home.php'};</script>";    
        //     }
        // }
        else{
            echo json_encode(array('invalidCreds' => 1));
        } 
    }else 
    { 
        echo json_encode(array('notRegistered' => 1));
    }
}
    
   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: login-user.php');
    }
?>
<?php
require "../DB_folder/db_connection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

if(isset($_POST['send'])){

    $six_digit_random_number = random_int(100000, 999999);
    $_SESSION["code"] = $six_digit_random_number;
    $_SESSION["mail"] = $_POST['email'];

    $email = $_POST['email'];
    $subject = "Reset Password Code";
    $message = "Reset Code: ".$six_digit_random_number;

    $query = "SELECT * FROM users WHERE Email = '$email'";
    $result = mysqli_query($con, $query);
    if ($result)
    {
        if (mysqli_num_rows($result) > 0) 
        {
            //Load composer's autoloader
            $mail = new PHPMailer(true);                            
            try {
                //Server settings
                $mail->isSMTP();                                     
                $mail->Host = 'smtp.gmail.com';                      
                $mail->SMTPAuth = true;                             
                $mail->Username = 'otpgeneratortest@gmail.com
';     
                $mail->Password = 'miakhqqluuciigbe';             
                $mail->SMTPOptions = array(
                    'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                    )
                );                         
                $mail->SMTPSecure = 'ssl';                           
                $mail->Port = 465;                                   

                //Send Email
                $mail->setFrom('otpgeneratortest@gmail.com
');
                
                //Recipients
                $mail->addAddress($email);              
                $mail->addReplyTo('otpgeneratortest@gmail.com
');
                
                //Content
                $mail->isHTML(true);                                  
                $mail->Subject = $subject;
                $mail->Body    = $message;

                $mail->send();
                
                $_SESSION['code'] = $six_digit_random_number;

                echo json_encode(array("isSent"=> true));
            } catch (Exception $e) {
                echo json_encode(array("isSent"=> false));
            }
            
        } 
        else 
        {
            echo json_encode(array("isRegistered"=> false));
        }
    } else {
        echo json_encode(array("isSent"=> false));
    }
}



<?php
session_start();
include ('config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


function send_password_reset($get_name,$get_email,$token)
{
    $mail = new PHPMailer(true);
   $mail->isSMTP();
   $mail->SMTPAuth = true;

   $mail->Host       = 'smtp.gmail.com';
   $mail->SMTPAuth   = true;
   $mail->Username   = 'bsumain99@gmail.com';
   $mail->Password   = 'vobi xjfy izzr gcmj'; // Replace with your Gmail App Password

   $mail->SMTPSecure = "tls";
   $mail->Port = 587;

   $mail->setFrom('bsumain99@gmail.com', $get_name);
   $mail->addAddress($get_email);

   $mail->isHTML(true);
   $mail->Subject = "BSU Admission Account RESET PASSWORD Notification";

   $email_template = "
   <h2>Reset your password now</h2>
   <a href='http://localhost/Admission_System/backend/reset-password.php?token=$token'>Reset Password</a>";
   
   $mail->Body = $email_template;

}

if(isset($_POST['reset_password']))
{

        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $token = md5(rand());

        $check_email = " SELECT email FROM users WHERE email='$email' LIMIT 1 ";
        $check_email_run = mysqli_query($conn,$check_email);

        if(mysqli_num_rows($check_email_run)> 0)
        {
            $row= mysqli_fetch_array($check_email_run);
            $get_name = $row['name'];
            $get_email = $row['email'];

            $update_token = "UPDATE users SET TOKEN = '$token' WHERE email = '$email' LIMIT 1";
            $update_token_run = mysqli_query($conn,$update_token);

            if($update_token_run)
            {
                send_password_reset($get_name, $get_email, $token);
                $_SESSION['status']="Reset link is already sent";
                header("Location:reset-password.php");
                exit(0);

            }
            else
            {
                $_SESSION['status'] = "Something went wrong";
                header("Location: reset-password.php");
                exit(0);
            }

        }
        else
        {
            $_SESSION['status'] = "no email found";
            header("Location: reset-password.php");
            exit(0);
        }
}
?>
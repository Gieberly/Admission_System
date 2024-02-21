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
   <a href='http://127.0.0.1/Admission_System/Backend/change-password.php?token=$token&email=$get_email'>Reset Password</a>";
   
   $mail->Body = $email_template;
   $mail->send();

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
            $get_name = $row['lname'];
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


if(isset($_POST['change-password']))
{
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $confirm_password = password_hash($_POST['confirm_password'], PASSWORD_DEFAULT);
    $token = mysqli_real_escape_string($conn,$_POST['password_token']);

    if(!empty($token))
    {
        if(!empty($email) && !empty($new_password) && !empty($confirm_password))
        {
            //CHeck token if valid or not
            $check_token = "SELECT token FROM users WHERE token=$token LIMIT 1";
            $check_token_run = mysqli_query($conn,$check_token);

            if(mysqli_num_rows($check_token_run)>0)
            {
                if($new_password ==  $confirm_password)
                {
                    $update_password = "UPDATE users SET password = ' $new_password' WHERE token = '$token' LIMIT 1";
                    $update_password_run = mysqli_query($conn, $update_password);

                    if($update_password_run)
                    {
                        $_SESSION['status'] = "Your password Sucessfully Changed!";
                        header("Location: ../Backend/loginpage.php");
                        exit(0);
                    }
                    else
                    {
                        $_SESSION['status'] = "Somethings Wrong! Can't update your password";
                        header("Location: change-password.php?token=$token&email=$email");
                        exit(0);
                    }
                }
                else
                {
                    $_SESSION['status'] = "Password does not match";
                    header("Location: change-password.php?token=$token&email=$email");
                    exit(0);
                }
            }
            else
            {
                $_SESSION['status'] = "Invalid Token";
                header("Location: change-password.php?token=$token&email=$email");
                exit(0);
            }

        }
        else
        {
        $_SESSION['status'] = "All fields are mandatory";
        header("Location: change-password.php?token=$token&email=$email");
        exit(0);
        }
    }
    else
    {
        $_SESSION['status'] = "no Token available";
        header("Location: change-password.php");
        exit(0);
    }
}
?>
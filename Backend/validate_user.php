<?php
session_start();
include ('config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

function sendemail_verify($lname, $email, $token)
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

   $mail->setFrom('bsumain99@gmail.com', $lname);
   $mail->addAddress($email);

   $mail->isHTML(true);
   $mail->Subject = "Email Verification for BSU Admission";

   $email_template = "
   <h2>Verify your email</h2>
   <a href='http://localhost/Admission_System/backend/verify_email.php?token=$token'>Verify</a>";

   $mail->Body = $email_template;

   try {
      $mail->send();
      echo 'Message has been sent';
   } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
   }
}

if (isset($_POST['register_btn'])) {
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $userType = $_POST['userType'];
    $token = md5(rand());

}

   $check_email_query = "SELECT email FROM users WHERE email ='$email' LIMIT 1";
   $check_email_query_run = mysqli_query($conn, $check_email_query);

// Check if the email already exists
if (mysqli_num_rows($check_email_query_run) > 0) {
    $_SESSION['status'] = "EMAIL or ACCOUNT ALREADY EXISTS";
    header("Location: register.php");
} else {
    // Insert User Data
    $query = "INSERT INTO users (lname,fname,mname, email, password, userType, token) VALUES ('$lname','$fname','$mname', '$email', '$password', '$userType', '$token')";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        sendemail_verify($lname, $email, $token);
        $_SESSION['status'] = "Registration Successful! Activate your account now";
        header("Location: register.php");
    } else {
        $_SESSION['status'] = "Registration failed!";
        header("Location: register.php");
    }
}
   
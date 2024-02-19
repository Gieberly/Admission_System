<?php
session_start();
include ('config.php');

if (isset($_GET['token'])) 
{
    $token = $_GET['token'];
    $verify_query = "SELECT status,token FROM users WHERE token = '$token' LIMIT 1";
    $verify_query_run = mysqli_query($conn, $verify_query);

    if (mysqli_num_rows($verify_query_run) > 0) 
    {
        $row = mysqli_fetch_array($verify_query_run);
        echo $row['token'];

        if ($row['status'] == "pending") {
            $clicked_token = $row['token'];
            $update_query = "UPDATE users SET status = 'verified' WHERE token = '$clicked_token' LIMIT 1";
            $update_query_run = mysqli_query($conn, $update_query);
            if ($update_query_run) {
                $_SESSION['status'] = "Your Account has been verified successfully!";
                header("Location: loginpage.php");
                exit(0);
            } else {
                $_SESSION['status'] = "Verification failed!";
                header("Location: loginpage.php");
                exit(0);
            }
        } 
        else 
        {
            $_SESSION['status'] = "Email Already verified";
            header("Location: loginpage.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "This Token does not exist";
        header("Location: loginpage.php");
        exit(0);
    }
} else {
    $_SESSION['status'] = "Not allowed";
    header("Location: loginpage.php");
    exit(0);
}
?>

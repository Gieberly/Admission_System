<?php
session_start();
include('config.php');

if(isset($_POST['login_btn']))
{
    if(!empty(trim($_POST['email'])) && !empty(trim($_POST['password'])))
    {
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);

        $login_query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
        $login_query_run = mysqli_query($conn, $login_query);

        if(mysqli_num_rows($login_query_run)>0)
        {
            $row = mysqli_fetch_array($login_query_run);
            
            if($row['status'] == 'verified')
            {
                header("Location:../Backend/admin.php");
                exit(0);
            }
            else
            {
                $_SESSION['err_status'] = "Please verify your account";
                header("Location:loginpage.php");
                exit(0);
            }
        }
        else
        {
            $_SESSION['err_status'] = "Invalid email or password";
            header("Location:../Backend/loginpage.php");
        }
    }
    else
    {
        $_SESSION['err_status'] = "All files are mandatory";
        header("Location:../Backend/loginpage.php");
    }
}
else
{

}
?>
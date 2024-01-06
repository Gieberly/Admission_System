<?php
session_start();

if(isset($_SESSION['authenticated']))
{
    $_SESSION['status']= "LOgin now";
    header("Location:../Backend/loginpage.php");
    exit(0);
}
?>k
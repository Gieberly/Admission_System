<?php
session_start();
include("config.php");

if(isset($_POST['login_btn'])){
        
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $stmt = $conn->prepare("SELECT id, password, userType, status, state FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $Password, $userType, $status, $state);
            $stmt->fetch();


                if ($userType == 'Student') {
                    header("Location: Backend/studentDashboard.php"); // Redirect to studentform.php
                    exit();
                } elseif ($userType == 'Faculty') {
                    
                    if(strtolower($status) == 'verified' & strtolower($state) == 'Activated')
                    {
                            header("Location: Backend/facultydashboard.php");  // Redirect to faculty.php if approved
                            exit();
                    }
                    elseif(strtolower($status) == 'verified'& strtolower($state) == 'Pending')
                    {
                        echo "User is registered. Please wait for admin confirmation";
                        header("Location: Backend/register.php"); // Redirect to register.php if the user is not found
                        exit();
                    }
                    elseif(strtolower($status) == 'verified' & strtolower($state) == 'Rejected')
                    {
                        echo "User not found.Please contact the administrator";
                        header("Location: Backend/register.php"); // Redirect to register.php if the user is not found
                        exit();
                    }
                    else
                    {
                        echo "User not found";
                        header("Location: Backend/register.php"); // Redirect to register.php if the user is not found
                        exit();
                    }
                        
                } elseif ($userType == 'Staff') {
                    if(strtolower($status) == 'verified' || strtolower($state) == 'Activated')
                    {
                            header("Location: Backend/Personnel_dashboard.php");  // Redirect to faculty.php if approved
                            exit();
                    }
                    elseif(strtolower($status) == 'verified' || strtolower($state) == 'Pending')
                    {
                        echo "User is registered. Please wait for admin confirmation";
                        header("Location: Backend/register.php"); // Redirect to register.php if the user is not found
                        exit();
                    }
                    elseif(strtolower($status) == 'verified' || strtolower($state) == 'Rejected')
                    {
                        echo "User not found.Please contact the administrator";
                        header("Location: Backend/register.php"); // Redirect to register.php if the user is not found
                        exit();
                    }
                    else
                    {
                        echo "User not found";
                        header("Location: Backend/register.php"); // Redirect to register.php if the user is not found
                        exit();
                    }
                } elseif ($userType == 'Admin' || $userType == 'admin') {
                    header("Location: admin/dashboard_admin.php");
                    exit();
                } else {
                    echo "User not found";
                    header("Location:register.php"); // Redirect to register.php if the user is not found
                    exit();
                }
            } 

        $stmt->close();
    }
}elseif (isset($_POST['signup_btn'])){
    header("Location:../Backend/register.php");
    exit(0);

}
$conn->close();
?>

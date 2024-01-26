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
            $stmt->bind_result($id, $hashedPassword, $userType, $status, $state);
            $stmt->fetch();

            if (password_verify($password, $hashedPassword)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['user_type'] = $userType;
                // Store additional user information in session
                $_SESSION['last_name'] = $lname;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_department'] = $department; // Assuming $department is available


                if ($userType == 'Student') {
                    header("Location: ../Backend/studentform.php"); // Redirect to studentform.php
                    exit();
                } elseif ($userType == 'Faculty') {
                    
                    if(strtolower($status) == 'verified')
                    {
                        if(strtolower($state) == 'approved')
                        {
                            header("Location: ../Backend/facultydashboard.php");  // Redirect to faculty.php if approved
                            exit();
                        }
                        elseif(strtolower($state) == 'pending')
                        {
                            echo "User is registered. Please wait for admin confirmation";
                            header("Location: ../Backend/register.php"); // Redirect to register.php if the user is not found
                            exit();
                        }
                        elseif(strtolower($state) == 'rejected')
                        {
                            echo "User not found.Please contact the administrator";
                            header("Location: ../Backend/register.php"); // Redirect to register.php if the user is not found
                            exit();
                        }
                        
                    }
                    else
                    {
                        echo "User not found";
                        header("Location: ../Backend/register.php"); // Redirect to register.php if the user is not found
                        exit();
                    }
                        
                } elseif ($userType == 'Staff') {
                    if (strtolower($status) == 'verified') 
                    {
                        if(strtolower($state) == 'approved')
                        {
                            header("Location: ../Backend/personnel.php");
                            exit();
                        }
                        elseif(strtolower($state) == 'pending')
                        {
                            echo "User is registered. Please for Administrator's Approval";
                            header("Location: ../Backend/loginpage.php"); // Redirect to register.php if the user is not found
                            exit();
                        }
                        elseif(strtolower($state) == 'Rejected')
                        {
                            echo "User not found. Please for contact the Administrator";
                            header("Location: ../Backend/loginpage.php"); // Redirect to register.php if the user is not found
                            exit();
                        }
                        
                    }
                    else
                    {
                        echo "User not found";
                        header("Location: ../Backend/register.php"); // Redirect to register.php if the user is not found
                        exit();
                    }
                } elseif ($userType == 'Admin') {
                    header("Location: ../backend/admin.php");
                    exit();
                } else {
                    echo "User not found";
                    header("Location: ../Backend/register.php"); // Redirect to register.php if the user is not found
                    exit();
                }
            } else {
                echo "Incorrect password";
            }
        } else {
            echo "User not found";
            // Additional error handling or redirection can be added here
        }

        $stmt->close();
    }
}elseif (isset($_POST['signup_btn'])){
    header("Location:../Backend/register.php");
    exit(0);

}
$conn->close();
?>
?>
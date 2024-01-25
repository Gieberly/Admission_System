<?php
session_start();
include("config.php");

if(isset($_POST['login_btn'])){
        
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $stmt = $conn->prepare("SELECT id, password, userType, status FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hashedPassword, $userType, $status);
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
                } elseif ($userType == 'faculty') {
                    
                        header("Location: ../Backend/facultydashboard.php");  // Redirect to faculty.php if approved
                        exit();

                } elseif ($userType == 'staff') {
                    if (strtolower($status) == 'verified') 
                    {
                        header("Location: ../Backend/personnel.php");
                        exit();
                    }
                    else 
                    {
                        echo "Your registration is not yet approved. Please wait for admin approval.";
                    }
                } elseif ($userType == 'admin') {
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
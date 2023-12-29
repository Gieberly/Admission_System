<?php
session_start();
include("config.php");

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
            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_department'] = $department; // Assuming $department is available


            if ($userType == 'Student') {
                header("Location: ../Backend/studentform.php"); // Redirect to studentform.php
                exit();
            } elseif ($userType == 'Faculty') {
                if (strtolower($status) == 'approved') {
                    header("Location: ../Backend/facultydashboard.php");  // Redirect to faculty.php if approved
                    exit();
                } elseif (strtolower($status) == 'pending') {
                    echo "Your registration is pending approval.";
                } elseif (strtolower($status) == 'rejected') {
                    echo "Your registration has been rejected. Please contact the administrator.";
                } else {
                    echo "Your registration is not yet approved. Please wait for admin approval.";
                }
            } elseif ($userType == 'Staff') {
                if (strtolower($status) == 'approved') {
                    header("Location: ../Backend/personnel.php");
                    exit();
                } elseif (strtolower($status) == 'pending') {
                    echo "Your registration is pending approval.";
                } elseif (strtolower($status) == 'rejected') {
                    echo "Your registration has been rejected. Please contact the administrator.";
                } else {
                    echo "Your registration is not yet approved. Please wait for admin approval.";
                }
            } elseif ($userType == 'admin') {
                header("Location: ../Backend/admin.php");
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

$conn->close();
?>

<!-- Your HTML login form here -->

<!-- Rest of your HTML code -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin and Faculty login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <header>
        <div class="icon">
            <a href="#" class="logo"><img src="assets/images/BSU Logo1.png" alt="BSU Logo"></a>
            <h2 class="scname">Benguet State University</h2>
            <div class="alert">
                <?php
                if (isset($_SESSION['status'])) {
                    echo "<h4>" . $_SESSION['status'] . "</h4>";
                    unset($_SESSION['status']);
                }
                ?>
            </div>
        </div>
    </header>
    <style>
        body {
            background-image: url('assets/images/banner.jpg');
        }
    </style>
    <section class="content">
        <div class="side">
            <h1>Welcome to<br><span>Benguet State <br>University </span> <br>Admission</h1>
            <button class="cn" id="joinUsButton">JOIN US</button>
        </div>
        <div class="form" id="loginForm" style="display: block;">
            <form method="POST" >
                <h2>Login</h2>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button class="btnn" type="submit" name= "login_btn">Login</button>
                <p class="link">
                    <a href="reset-password.php">Forgot Password?</a>
                    or Don't have an account?<a href="register.php" id="signupLink">Sign up </a> here
                </p>
                
            </form>
        </div> 
        </div>
        </div>
    </section>
    <footer>
    </footer>
    <script src="assets\js\login.js"></script>
</body>
</html>

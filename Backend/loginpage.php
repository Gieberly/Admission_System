<?php
session_start();
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT id, password, userType, lstatus FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashedPassword, $userType, $lstatus);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_type'] = $userType;
            $_SESSION['user_email'] = $email;
       

            if ($userType == 'Student') {
                header("Location: ../Backend/Student_Dashboard.php");
                exit();
            } elseif ($userType == 'Faculty') {
                if (strtolower($lstatus) == 'approved') {
                    header("Location: ../Backend/facultydashboard.php");
                    exit();
                } elseif (strtolower($lstatus) == 'Pending') {
                    $_SESSION['message'] = "Your registration is pending approval.";
                    header("Location: loginpage.php");
                    exit();
                } elseif (strtolower($lstatus) == 'rejected') {
                    $_SESSION['message'] = "Your registration has been rejected. Please contact the administrator.";
                    header("Location: loginpage.php");
                    exit();
                } else {
                    $_SESSION['message'] = "Your registration is not yet approved. Please wait for admin approval.";
                    header("Location: loginpage.php");
                    exit();
                }
            } elseif ($userType == 'Staff') {
                if (strtolower($lstatus) == 'approved') {
                    header("Location: ../Backend/Personnel_dashboard.php");
                    exit();
                } elseif (strtolower($lstatus) == 'Pending') {
                    $_SESSION['message'] = "Your registration is pending approval.";
                    header("Location: loginpage.php");
                    exit();
                } elseif (strtolower($lstatus) == 'rejected') {
                    $_SESSION['message'] = "Your registration has been rejected. Please contact the administrator.";
                    header("Location: loginpage.php");
                    exit();
                } else {
                    $_SESSION['message'] = "Your registration is not yet approved. Please wait for admin approval.";
                    header("Location: loginpage.php");
                    exit();
                }
            } elseif ($userType == 'admin') {
                header("Location: ../backend/admin.php");
                exit();
            }
        } else {
            $_SESSION['message'] = "Incorrect password";
            header("Location: loginpage.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "User not found";
        header("Location: loginpage.php");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/BSU Logo1.png" type="image/x-icon">
    <title>Admin and Faculty login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <style>
    
    body {
        background-image: url('assets/images/banner.jpg');
        background-attachment: fixed;
        background-size: cover;
        background-position: center;
    }
        .message {
            display: block;
            padding: 5px;
            margin-top: 10px;
            margin-bottom: 10px;
            background-color: #f2dede;
            border: 1px solid #ebccd1;
            color: #a94442;
            /* Dark red text color */
            border-radius: 4px;
            opacity: 0.9;
            /* Adjust opacity as needed */
            animation: slideUp 0.5s ease-out;
            /* Animation settings */
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 0.9;
                transform: translateY(0);
                /* Final position at the top */
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="icon">
            <a href="#" class="logo"><img src="assets/images/BSU Logo1.png" alt="BSU Logo"></a>
            <h2 class="scname">Benguet State University</h2>
        </div>
    </header>

    <section class="content">
        <div class="side">
            <h1 class="text_content">Welcome to<br><span>Benguet State <br>University </span> <br>Admission</h1>
        </div>
        <div class="form" id="loginForm" style="display: block;">
            <form action="loginpage.php" method="POST">
                <h2>Login</h2>
                <?php if (isset($_SESSION['message'])) : ?>
                    <div class="message"><?php echo $_SESSION['message']; ?></div>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['success_message'])) : ?>
                    <div id="successMessage" class="message" style="background-color: #dff0d8; color: #3c763d;"><?php echo $_SESSION['success_message']; ?></div>
                    <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>

                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button class="btnn" type="submit">Login</button>
                <p class="link">Don't have an account<br>
                    <a href="register.php" id="signupLink">Sign up </a> here</p>
            </form>
        </div>
    </section>
    <script src="assets\js\login.js"></script>
</body>

</html>
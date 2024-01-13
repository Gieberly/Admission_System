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
       
            $_SESSION['user_email'] = $email;
         


  // Check if the user is a student and has filled out the admission form
  if ($userType == 'Student') {
    $checkAdmissionQuery = "SELECT id FROM admission_data WHERE email = ?";
    $stmtCheckAdmission = $conn->prepare($checkAdmissionQuery);
    $stmtCheckAdmission->bind_param("s", $email);
    $stmtCheckAdmission->execute();
    $stmtCheckAdmission->store_result();

    if ($stmtCheckAdmission->num_rows > 0) {
        // User has already filled out the admission form, redirect to student dashboard
        header("Location: ../Backend/studentcontent_sidebar.php");
        exit();
    } else {
        // User needs to fill out the admission form, redirect to admission form
        header("Location: ../Backend/studentform.php");
        exit();
    }

            } elseif ($userType == 'Faculty') {
                if (strtolower($status) == 'approved') {
                    header("Location: ../Backend/facultydashboard.php");  // Redirect to faculty.php if approved
                    exit();
                } elseif (strtolower($status) == 'Pending') {
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
                } elseif (strtolower($status) == 'Pending') {
                    echo "Your registration is pending approval.";
                } elseif (strtolower($status) == 'rejected') {
                    echo "Your registration has been rejected. Please contact the administrator.";
                } else {
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
    <!-- Announcements -->
    <div class="announcement_popup">
        <h2>Admission Policy</h2>
        <p>The Office of the University Registrar (OUR) is a service unit of the University responsible for the repository and official source of the academic records of all University students and student-related data/reports. Coupled with this responsibility is the mandate to maintain and protect the integrity and confidentiality of student records.
            General Functions of the Office of the University Registrar</p>
        <button id="close">Close</button>
    </div>
    <!-- Announcements -->
    <header>
        <div class="icon">
            <a href="#" class="logo"><img src="assets/images/BSU Logo1.png" alt="BSU Logo"></a>
            <h2 class="scname">Benguet State University</h2>
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
          
        </div>
        <div class="form" id="loginForm" style="display: block;">
            <form action="loginpage.php" method="POST">
                <h2>Login</h2>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button class="btnn" type="submit">Login</button>
                <p class="link">Don't have an account<br>
                    <a href="register.php" id="signupLink">Sign up </a> here
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
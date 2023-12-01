<?php
session_start();
include ('config.php');
?>

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

      
        <div class="form" id="registrationForm" style="display: block;">
        <form method="POST" id="RegForm" action="validate_user.php">
            <h2>Register</h2>
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" id="registerEmail" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <br>
                <label for="userType">Select User Type:</label>
                <select id="userType" name="userType" required>
                    <option value="admin">Admin</option>
                    <option value="student">Student</option>
                    <option value="staff">Staff</option>
                </select>
                <button class="btnn" type="submit" name="register_btn">Register</button>
                <p class="link">Already have an account<br>
                    <a href="loginpage.php" id="loginLink">Login</a> here
                </p>
            </form>
           
        </div>
        </div>
    </section>



    <footer>

    </footer>

    <script src="assets\js\reg.js"></script>
    <script>
    // JavaScript to show an alert if there is a message
    document.addEventListener('DOMContentLoaded', function () {
        var alertMessage = "<?php echo isset($_SESSION['status']) ? $_SESSION['status'] : ''; ?>";
        if (alertMessage !== "") {
            alert(alertMessage);
        }
    });
</script>
</body>

</html>
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
        <div class="form" id="loginForm" style="display: block;">
            <form action="reset-password-code.php" method="POST" >
                <input type="hidden" value="
                <?php 
                if(isset($_GET['token']))
                {
                    echo $_GET['token'];
                }
                ?>">
            <h2>Change Password</h2>
                <input type="email" name="email" placeholder="Enter Email Address" required value="
                <?php 
                if(isset($_GET['email']))
                {
                    echo $_GET['email'];
                }
                ?>">
                <input type="password" id="registerEmail" name="new_password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <button class="btnn" type="submit" name ="change_password">Update Password</button>
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
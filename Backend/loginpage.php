
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
                if (isset($_SESSION['err_status'])) {
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
            <form method="POST" action="logincode.php">
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

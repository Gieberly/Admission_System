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
        .divider {
            
            position: relative;
            display: inline-block;
            width: 100%;
            height: 1px;
            background-color: #ccc; /* Adjust the color as needed */
            top: 50%; /* Adjust the vertical position of the line */
            transform: translateY(-50%);
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
                <div class="input-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <br>
                <div class="button-group">
                    <button class="btnn" type="submit" name= "login_btn">Login</button>
                    <p style= "text-align:left"><a href="reset-password.php" >Forgot Password? </a> 
                    <br> Did not receive your Verification Email? <a href="register.php">Resend Link</a>
                    </p>
                    <div class="divider"></div> 
                    <p style= "text-align:center"> OR</p>                    
                    <button class="btnn" type="submit" name= "signup_btn"><a href="register.php">Sign Up</a></button>
                </div> 
                
                <br>
                
                       
        </div> 
    </section>
    <footer>
    </footer>
    <script src="assets\js\login.js"></script>
</body>
</html>

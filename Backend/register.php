<?php
session_start();
include("config.php");

// Fetch data from the database and sort by College and Course
$sql = "SELECT * FROM Programs ORDER BY College, Courses ASC";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input
    $name = $_POST['name'];
    $mname = $_POST['mname'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
 
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $userType = $_POST['userType'];
    
    // Set status and department based on user type
    if ($userType == 'Student') {
        $lstatus = 'Approved';
        $department = NULL;
    } elseif ($userType == 'Staff' || $userType == 'Faculty') {
        $lstatus = 'Pending';
        $department = ($userType == 'Faculty') ? $_POST['description'] : NULL;
    } else {
        $lstatus = NULL;
        $department = NULL;
    }
    // Check if the email already exists
    $emailExistsQuery = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($emailExistsQuery);

    if ($result->num_rows > 0) {
        $error_message = "Email address already exists. Please choose a different email.";

    } else {
        // Email does not exist, proceed with registration 
        $sql = "INSERT INTO users (name, last_name, mname, email, password, userType, lstatus, Department) 
                VALUES ('$name', '$last_name', '$mname', '$email', '$password', '$userType', '$lstatus', '$department')";

        if ($conn->query($sql) === TRUE) {
            $success_message = "You have successfully Registered, Redirecting to Login Page!";

            // Redirect to loginpage.php after 3 seconds
            header("refresh:3;url=loginpage.php");
        } else {
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin and Faculty login</title>
    <link rel="icon" href="assets/images/BSU Logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/login.css">
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
            <h1>Welcome to<br><span>Benguet State <br>University </span> <br>Admission</h1>
        </div>


        <div class="form" id="registrationForm" style="display: block;">
        <form method="POST" id="RegForm" onsubmit="return validateForm();">
                <h2>Register</h2>
                <?php if (!empty($error_message)) : ?>
                    <div class="error-message"><?php echo $error_message; ?></div>
                <?php endif; ?>
                <!-- Display the success message with slide-up animation and red outer color -->
                <?php if (!empty($success_message)) : ?>
                    <div class="success-message"><?php echo $success_message; ?></div>
                <?php endif; ?>
            
                <input class="register_in" type="text" name="name" placeholder="First Name*" autocomplete="name" required>
                <input class="register_in" type="text" name="mname" placeholder="Middle Name" >
                <input class="register_in" type="text" name="last_name" placeholder="Last Name*" autocomplete="family-name" required>
                <input class="register_in" type="email" name="email" placeholder="Email*" autocomplete="on">
                <input class="register_in" type="password" id="registerEmail" autocomplete="on" name="password" placeholder="Password*" required required maxlength="8" oninput="validatePassword()">
                <input class="register_in" type="password" name="confirm_password" autocomplete="password" placeholder="Confirm Password*" required maxlength="8" oninput="validateConfirmPassword()">
                <div id="passwordError" class="error-message"></div>

                <br>

                <select id="userType" name="userType" required onchange="toggleDepartmentDropdown()">
                    <option value="" disabled selected>Select User Type*</option>
                    <option value="Student">Student</option>
                    <option value="Staff">Staff</option>
                    <option value="Faculty">Faculty</option>
                </select>
                <!-- Style for the "Select Department" dropdown -->

                <select name="description" id="description">
                    <option value="" disabled selected>Select Department:</option>
                    <?php
        // Loop through the fetched data and group courses under their respective colleges
        if ($result->num_rows > 0) {
            $currentCollege = null;
            while ($row = $result->fetch_assoc()) {
                $college = $row['College'];
                $course = $row['Courses'];

                if ($college != $currentCollege) {
                    if ($currentCollege !== null) {
                        echo "</optgroup>";
                    }
                    echo "<optgroup label=\"$college\">";
                    $currentCollege = $college;
                }

                echo "<option value=\"$course\">$course</option>";
            }
            echo "</optgroup>";
        } else {
            echo "<option value=\"\">No programs available</option>";
        }
        ?>
                </select>

                <button class="btnn" type="submit">Register</button>
                <p class="link">Already have an account<br>
                    <a href="loginpage.php" id="loginLink">Login</a> here
                </p>
            </form>

        </div>

<?php
    // Check if the checkbox is clicked
    $showPopup = isset($_POST['agree_checkbox']) && $_POST['agree_checkbox'] === 'on';
    if (!$showPopup) {
        // Show the popup if the checkbox is not clicked
        echo '<div class="popup-container" id="popupContainer">
                <div class="popup">
                <h3>Privacy Notice</h3>
                <div class="border-pop">
                    
                    <p>Pursuant to the Data Privacy Act of 2012 and the BSU Data Policy from the Office of the University Registrar, concerned Personnel of BSU La Trinidad, BSU Buguias Campus and Bokod Campus are committed to keep with utmost confidentiality, all sensitive personal information collected from applicants. Personal information are collected, accessed, used and or disclosed on a “need to know basis” and only as reasonably required. Confidential information either within or outside the University will not be communicated, except to persons authorized to receive such information. Authorized hardware, software, or other authorized equipment shall be used only in accessing, processing and transmitting such information. Read more on BSU Data Privacy Notice: <a href="http://www.bsu.edu.ph/dpa/bsu-data-privacy-notice-students" target="_blank">Click here to visit the BSU Data Privacy Notice for Students
                        Pursuant to the Data Privacy Act of 2012 and the BSU Data Policy from the Office of the University Registrar, concerned Personnel of BSU La Trinidad, BSU Buguias Campus and Bokod Campus are committed to keep with utmost confidentiality, all sensitive personal information collected from applicants. Personal information are collected, accessed, used and or disclosed on a “need to know basis” and only as reasonably required. Confidential information either within or outside the University will not be communicated, except to persons authorized to receive such information. Authorized hardware, software, or other authorized equipment shall be used only in accessing, processing and transmitting such information. Read more on BSU Data Privacy Notice:
                            Pursuant to the Data Privacy Act of 2012 and the BSU Data Policy from the Office of the University Registrar, concerned Personnel of BSU La Trinidad, BSU Buguias Campus and Bokod Campus are committed to keep with utmost confidentiality, all sensitive personal information collected from applicants. Personal information are collected, accessed, used and or disclosed on a “need to know basis” and only as reasonably required. Confidential information either within or outside the University will not be communicated, except to persons authorized to receive such information. Authorized hardware, software, or other authorized equipment shall be used only in accessing, processing and transmitting such information. Read more on BSU Data Privacy Notice:</a></p></div>
                    <form method="post">
                        <input type="checkbox" name="agree_checkbox" id="agreeCheckbox" >
                        <label for="agreeCheckbox">By clicking this, you agree to share your personal information to Benguet State University - Office of the University Registrar.</label>
                        <button type="submit" id="agreeButton" class="agree">I agree</button>
                    </form>
                </div>
            </div>';
    }
    ?>

    </section>

    <style>
       body {
            background-image: url('assets/images/banner.jpg');
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
        }
    </style>

    <footer>
    </footer>

    <script src="assets\js\reg.js"></script>
</body>
</html>
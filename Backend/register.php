<?php
session_start();
include("config.php");

// Fetch data from the database and sort by Nature_of_Degree and Description
$sql = "SELECT * FROM Programs ORDER BY Nature_of_Degree ASC, Description ASC";
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
            $success_message = "You have successfully Registered!";

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
    <script>
        // Your other JavaScript code here
    </script>
    <link rel="stylesheet" href="assets/css/login.css">
</head>


<body>
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

        .error-message {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
            animation: slideUp 0.5s ease;
            text-shadow: 0 0 5px red;
        }

        .success-message {
            color: #155724;
            /* Dark green text color */
            background-color: #d4edda;
            /* Light green background color */
            border: 1px solid #c3e6cb;
            /* Border color */
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
            animation: slideUp 0.5s ease;
            text-shadow: 0 0 5px green;
            /* Dark green outer shadow */
        }

        /* Keyframes for the slide-up animation */
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>


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
            
                <input type="text" name="name" placeholder="First Name" autocomplete="name" required>
                <input type="text" name="mname" placeholder="Middle Name" required>
                <input type="text" name="last_name" placeholder="Last Name" autocomplete="family-name" required>
                <input type="email" name="email" placeholder="Email" autocomplete="on">
                <input type="password" id="registerEmail" autocomplete="on" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" autocomplete="password" placeholder="Confirm Password" required oninput="validatePassword()">
                <div id="passwordError" class="error-message"></div>

                <br>

                <select id="userType" name="userType" required onchange="toggleDepartmentDropdown()">
                    <option value="" disabled selected>Select User Type</option>
                    <option value="Student">Student</option>
                    <option value="Staff">Staff</option>
                    <option value="Faculty">Faculty</option>
                </select>
                <!-- Style for the "Select Department" dropdown -->

                <select name="description" id="description">
                    <option value="" disabled selected>Select Department:</option>
                    <?php
                    if ($result->num_rows > 0) {
                        $currentNature = null;
                        while ($row = $result->fetch_assoc()) {
                            $nature = $row['Nature_of_Degree'];
                            $description = $row['Description'];

                            if ($nature != $currentNature) {
                                if ($currentNature !== null) {
                                    echo "</optgroup>";
                                }
                                echo "<optgroup label=\"$nature Programs\">";
                                $currentNature = $nature;
                            }

                            echo "<option value=\"$description\">$description</option>";
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


    </section>


    <style>
        @keyframes fadeOut {
            to {
                opacity: 0;
            }
        }

        /* Style for the dropdowns */
        select {
            font-size: 16px;
            padding: 2px;
            width: 100%;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            color: #555;
        }

        /* Style for the options within the dropdowns */
        option {
            font-size: 14px;
        }


        .hidden {
            display: none;
        }

        #description {
            display: none;
        }
    </style>
    <script>
        // JavaScript to show/hide "Select Department" dropdown based on "Select User Type"
        function toggleDepartmentDropdown() {
            var userTypeDropdown = document.getElementById("userType");
            var departmentDropdown = document.getElementById("description");

            if (userTypeDropdown.value === "Faculty") {
                // If "Faculty" is selected, show the "Select Department" dropdown
                departmentDropdown.style.display = "block";
            } else {
                // Otherwise, hide the "Select Department" dropdown
                departmentDropdown.style.display = "none";
            }
        }
  document.addEventListener("DOMContentLoaded", function () {
        // Hide the password error message initially
        var errorContainer = document.getElementById("passwordError");
        errorContainer.style.display = "none";
    });

    function validatePassword() {
        var password = document.getElementById("registerEmail").value;
        var confirmPassword = document.getElementsByName("confirm_password")[0].value;
        var confirmPwdInput = document.getElementsByName("confirm_password")[0];
        var errorContainer = document.getElementById("passwordError");

        if (password !== confirmPassword) {
            // Passwords don't match, show error message and highlight the field
            confirmPwdInput.classList.add("password-error");
            errorContainer.innerHTML = "Passwords don't match";
            errorContainer.style.display = "block"; // Show the error message
            return false;
        } else {
            // Passwords match, reset the border color and clear error message
            confirmPwdInput.classList.remove("password-error");
            errorContainer.innerHTML = "";
            errorContainer.style.display = "none"; // Hide the error message
            return true;
        }
    }

    function validateForm() {
        var password = document.getElementById("registerEmail").value;
        var confirmPassword = document.getElementsByName("confirm_password")[0].value;

        // Check if passwords match
        if (password !== confirmPassword) {
            alert("Password and Confirm Password do not match");
            return false;
        }

        // Call validatePassword only if the user attempts to register
        if (password !== "" || confirmPassword !== "") {
            return validatePassword();
        }

        return true;
    }
    </script>

    <style>
        /* Style for the password fields with red background shadow */
        .password-error {
            box-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
        }
    </style>


    <footer>

    </footer>

    <script src="assets\js\reg.js"></script>
</body>

</html>
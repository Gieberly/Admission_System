<?php
session_start();
include("config.php");

// Fetch data from the database and sort by Nature_of_Degree and Description
$sql = "SELECT * FROM Programs ORDER BY Nature_of_Degree ASC, Description ASC";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $userType = $_POST['userType'];
    $department = $_POST['description']; 
// Set default status to "pending" for Staff and Faculty
$status = ($userType === 'Staff' || $userType === 'Faculty') ? 'pending' : 'approved';
    // Check if the email already exists
    $checkEmailQuery = "SELECT id FROM users WHERE email = ?";
    $stmtCheckEmail = $conn->prepare($checkEmailQuery);
    $stmtCheckEmail->bind_param("s", $email);
    $stmtCheckEmail->execute();
    $stmtCheckEmail->store_result();

    if ($stmtCheckEmail->num_rows > 0) {
        // Email already exists, inform the user
        echo "Email already in use. Please choose another email.";
        $stmtCheckEmail->close();
        $conn->close();
        exit(); // Stop execution
    }

    // Proceed with user registration if the email is unique
    $_SESSION['registered_email'] = $email;
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, userType, status, Department) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $hashedPassword, $userType, $status, $department);

    if ($stmt->execute()) {
        header("Location: loginpage.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin and Faculty login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" href="assets/images/BSU Logo1.png" type="image/x-icon">

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
    </style>


    <section class="content">
        <div class="side">
            <h1>Welcome to<br><span>Benguet State <br>University </span> <br>Admission</h1>
            <button class="cn" id="joinUsButton">JOIN US</button>
        </div>


        <div class="form" id="registrationForm" style="display: block;">
            <form method="POST" id="RegForm" onsubmit="return validateForm();">
                <h2>Register</h2>
                <input type="text" name="name" placeholder="Full Name" autocomplete="name" required>
                <input type="email" name="email" placeholder="Email" autocomplete="on">
                <input type="password" id="registerEmail" autocomplete="on" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" autocomplete="password" placeholder="Confirm Password" required>
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
                                echo "<optgroup label=\"$nature\">";
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
        -
    </section>
    <style>
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
    </script>

    <footer>

    </footer>

    <script src="assets\js\reg.js"></script>
</body>

</html>
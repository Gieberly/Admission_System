<?php
include("config.php");
include("studentcover.php");

// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Student') {
    header("Location: loginpage.php");
    exit();
}

$studentId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $studentId);
$stmt->execute();
$result = $stmt->get_result();
$studentData = $result->fetch_assoc();

$stmt->close();

$message = ""; // Initialize message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission for updating user password
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];

    // Check if the entered old password matches the stored hashed password
    if (password_verify($oldPassword, $studentData['password'])) {
        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Perform the update query
        $updateStmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $updateStmt->bind_param("si", $hashedPassword, $studentId);

        if ($updateStmt->execute()) {
            // Update successful
            $message = "Password updated successfully!";
        } else {
            // Update failed
            $message = "Error updating password: " . $conn->error;
        }

        $updateStmt->close();
    } else {
        // Old password does not match
        $message = "Old password is incorrect. Please try again.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="icon" href="assets/images/BSU Logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/student.css" />
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="assets\js\jspdf.min.js"></script>
    <!-- Include the pdf.js library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<section id="content">
    <main>
        <!--Student Profile-->
        <div id="student-profile-content">
            <div class="head-title">
                <div class="left">
                    <h1>Password</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Password</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="studentDashboard.php">Home</a></li>
                    </ul>
                </div>
            </div>
            <!--profile-->
            <div id="student-profile">
                <div class="table-data">
                    <div class="order">
                        <h1 style="text-align: center;">CHANGE PASSWORD</h1>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <label for="old_password">Old Password:</label>
                            <input type="password" id="old_password" name="old_password" required>
                            <br>
                            <label for="new_password">New Password:</label>
                            <input type="password" id="new_password" name="new_password" required>
                            <br>
                            <!-- Add other fields for additional information editing -->
                            <input type="submit" id="updatePasswordBtn" value="Update Password">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>
<div class="popup" id="confirmationPopup">
  <div class="popup-content">
    <p>Are you sure you want to change your password?</p>
    <button id="confirmBtn">Yes</button>
    <button id="cancelBtn">Cancel</button>
  </div>
</div>
<style>
    
    .head-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    #student-profile {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    input {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    /* Custom style for popup message */
    .popup-message {
        position: fixed;
        top: 30%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: green;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        display: none;
    }
</style>

<script>
    $(document).ready(function () {
        // Check if message is not empty
        var message = "<?php echo $message; ?>";
        if (message !== "") {
            // Create and display the popup message
            var popupMessage = $("<div class='popup-message'></div>").text(message);
            $("body").append(popupMessage);
            popupMessage.fadeIn();
            // Hide the popup message after 2 seconds
            setTimeout(function () {
                popupMessage.fadeOut(function () {
                    $(this).remove(); // Remove the popup message from the DOM
                });
            }, 2000);
        }
    });
</script>

</body>
</html>

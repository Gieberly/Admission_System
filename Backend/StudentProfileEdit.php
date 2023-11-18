<?php
include("config.php");

session_start();

// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'student') {
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
            header("Location: student.php");
            exit();
        } else {
            // Update failed
            echo "Error updating password: " . $conn->error;
        }

        $updateStmt->close();
    } else {
        // Old password does not match
        echo "Old password is incorrect. Please try again.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    <h1>Edit Your Profile</h1>
    <p>Name: <?php echo $studentData['name']; ?></p>
    <p>Email: <?php echo $studentData['email']; ?></p>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="old_password">Old Password:</label>
        <input type="password" id="old_password" name="old_password" required>
        <br>

        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required>
        <br>

        <!-- Add other fields for additional information editing -->

        <input type="submit" value="Update Password">
    </form>
    
    <!-- Add a link or button to go back to student.php without updating -->
    <a href="student.php">Return to dashboard</a>
</body>
</html>

<?php
session_start();
include("config.php");

// Check if the user is logged in, otherwise redirect them
if (!isset($_SESSION['user_id'])) {
    header("Location: loginpage.php");
    exit();
}

// Fetch user information from the database based on user ID
$userID = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, email, userType, status FROM users WHERE id = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($name, $email, $userType, $status);
$stmt->fetch();
$stmt->close();

// Update user information if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Additional fields to update if needed

    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $email, $hashedPassword, $userID);

    if ($stmt->execute()) {
        // Update successful
        header("Location: EditInfo.php?success=true");
        exit();
    } else {
        // Update failed
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Information</title>
    <!-- Add your CSS styles or link to external stylesheets here -->
</head>

<body>
    <h1>Edit Information</h1>

    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $name; ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $email; ?>" required>

        <label for="password">New Password:</label>
        <input type="password" name="password" placeholder="Leave blank to keep the current password">

        <!-- Additional fields to update if needed -->


        <a href="EditInfo.php" class="btn-link">
    <button type="submit">Update Information</button>
    <a href="<?php echo ($userType === 'staff') ? 'personnel.php' : 'admin.php'; ?>">Return to dashboard</a>
</a>
    </form>

    <!-- Add additional HTML or form fields as needed -->

    <!-- Display success message if the update was successful -->
    <?php
    if (isset($_GET['success']) && $_GET['success'] === 'true') {
        echo "<p>Information updated successfully!</p>";
    }
    ?>

    <!-- Add your footer content here -->
</body>

</html>

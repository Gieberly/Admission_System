<?php
include("config.php");

session_start();

// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Student') {
    header("Location: loginpage.php");
    exit();
}

$studentId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM admission_data WHERE id = ?");
$stmt->bind_param("i", $studentId);
$stmt->execute();
$result = $stmt->get_result();
$studentData = $result->fetch_assoc();

$stmt->close();

// Set default values if no data is present
$appointmentDate = isset($studentData['appointment_date']) ? $studentData['appointment_date'] : '';
$appointmentTime = isset($studentData['appointment_time']) ? $studentData['appointment_time'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Set form field values
    $appointmentDate = $_POST['appointment_date'];
    $appointmentTime = $_POST['appointment_time'];

    // Perform the update query
    $updateStmt = $conn->prepare("UPDATE admission_data SET appointment_date = ?, appointment_time = ? WHERE id = ?");
    $updateStmt->bind_param("ssi", $appointmentDate, $appointmentTime, $studentId);

    if ($updateStmt->execute()) {
        // Update successful
        header("Location: student.php");
        exit();
    } else {
        // Update failed
        echo "Error updating appointment date and time: " . $conn->error;
    }

    $updateStmt->close();
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
  
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <!-- Add other fields for additional information editing -->
        <label for="appointment_date">Appointment Date:</label>
        <input type="date" id="appointment_date" name="appointment_date" value="<?php echo $appointmentDate; ?>">
        <br>

        <label for="appointment_time">Appointment Time:</label>
        <input type="text" id="appointment_time" name="appointment_time" value="<?php echo $appointmentTime; ?>">
        <br>

        <input type="submit" value="Update Appointment">
    </form>
    
    <!-- Add a link or button to go back to student.php without updating -->
    <a href="student.php">Return to dashboard</a>
</body>
</html>

<?php
include("config.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user ID
    $studentId = $_SESSION['user_id'];

    // Retrieve and sanitize form data
    $appointmentDate = mysqli_real_escape_string($conn, $_POST['appointment_date']);
    $appointmentTime = mysqli_real_escape_string($conn, $_POST['appointment_time']);

    // Update the database
    $stmtUpdate = $conn->prepare("UPDATE admission_data SET appointment_date = ?, appointment_time = ? WHERE user_id = ?");
    $stmtUpdate->bind_param("ssi", $appointmentDate, $appointmentTime, $studentId);
    
    if ($stmtUpdate->execute()) {
        echo "Appointment updated successfully!";
    } else {
        echo "Error updating appointment: " . $stmtUpdate->error;
    }

    // Close the statement
    $stmtUpdate->close();
}

// Close the database connection
$conn->close();
?>

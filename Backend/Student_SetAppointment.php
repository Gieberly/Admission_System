<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $selectedDate = $_POST['selectedDate'];
    $selectedTime = $_POST['selectedTime']; // Add this line
    $studentId = $_SESSION['user_id'];

    // Update the student's admission data with the selected appointment date and time
    $stmt = $conn->prepare("UPDATE admission_data SET appointmentDate = ?, appointmentTime = ? WHERE id = ?");
    $stmt->bind_param("ssi", $selectedDate, $selectedTime, $studentId);

    if ($stmt->execute()) {
        echo "Appointment set successfully!";
    } else {
        echo "Error setting appointment: " . $stmt->error;
    }
    $stmt->close();
} else {
    // Redirect if the form is not submitted
    header("Location: Student_Transaction_page.php");
    exit();
}

<?php
// Include the configuration file
include('config.php');

// Check if the appointment ID is provided via POST
if(isset($_POST['appointment_id'])) {
    // Sanitize the appointment ID to prevent SQL injection
    $appointmentId = mysqli_real_escape_string($conn, $_POST['appointment_id']);

    // Delete the appointment from the database
    $sql = "DELETE FROM appointmentdate WHERE appointment_id = $appointmentId";

    if ($conn->query($sql) === TRUE) {
        // Appointment deleted successfully
        echo json_encode(array('status' => 'success', 'message' => 'Appointment deleted successfully.'));
    } else {
        // Error deleting appointment
        echo json_encode(array('status' => 'error', 'message' => 'Error deleting appointment: ' . $conn->error));
    }
} else {
    // Error: Appointment ID not provided
    echo json_encode(array('status' => 'error', 'message' => 'Appointment ID not provided.'));
}

// Close the database connection
$conn->close();
?>

<?php
include('config.php');

// Check if the required parameters are set in the URL
if (isset($_GET['id']) && isset($_GET['status'])) {
    // Sanitize and get the values from the URL
    $admissionId = mysqli_real_escape_string($conn, $_GET['id']);
    $newStatus = mysqli_real_escape_string($conn, $_GET['status']);

    // Update the status in the database
    $updateSql = "UPDATE admission_data SET appointment_status = '$newStatus' WHERE id = '$admissionId'";
    if ($conn->query($updateSql) === TRUE) {
        // Send a success response
        $response = array('success' => true);
    } else {
        // Send an error response
        $response = array('success' => false, 'error' => $conn->error);
    }
} else {
    // Send an error response if parameters are not set
    $response = array('success' => false, 'error' => 'Missing parameters');
}

// Close the database connection
$conn->close();

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>

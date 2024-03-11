<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Update the appointment_status in the database
    $updateQuery = "UPDATE admission_data SET appointment_status = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $status, $id);

    $response = array(); // Create an array to store the response

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "Status updated successfully";
    } else {
        $response['success'] = false;
        $response['message'] = "Error updating status";
    }

    $stmt->close();
    $conn->close();

    // Send the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    echo "Invalid request";
}
?>

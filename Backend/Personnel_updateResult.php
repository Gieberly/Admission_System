<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the parameters from the AJAX request
    $id = $_POST['id'];
    $newStatus = $_POST['newStatus'];

    // Update the database with the new status
    $updateQuery = "UPDATE admission_data SET result = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param('si', $newStatus, $id);

    if ($stmt->execute()) {
        // Send a success response
        echo json_encode(['status' => 'success', 'message' => 'Status updated successfully']);
    } else {
        // Send an error response
        echo json_encode(['status' => 'error', 'message' => 'Failed to update status']);
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>

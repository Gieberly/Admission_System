<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Update the appointment_status in the database
    $updateQuery = "UPDATE admission_data SET appointment_status = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request";
}
?>

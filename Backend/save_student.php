<?php
session_start();
include("config.php");

// Get the data from the AJAX request
$data = json_decode(file_get_contents("php://input"), true);

// Extract programID and updatedData from the data
$id = $data['id'];
$updatedData = $data['updatedData'];

// Update the data in the database
$sql = "UPDATE admission_data SET ";
foreach ($updatedData as $field => $value) {
    $sql .= "$field = '$value', ";
}
$sql = rtrim($sql, ', ');
$sql .= " WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>

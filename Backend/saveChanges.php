<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $column = $_POST['column'];
    $value = $_POST['value'];

    // Validate input
    // You may want to perform additional validation here

    // Update the database
    $updateQuery = "UPDATE admission_data SET $column = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $value, $id);

    if ($stmt->execute()) {
        echo "Update successful";
    } else {
        echo "Update failed";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request";
}
?>

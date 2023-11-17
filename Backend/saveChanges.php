<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $column = $_POST['column'];
    $value = $_POST['value'];

    // Update the specified column in the database
    $query = "UPDATE admission_data SET $column = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $value, $id);
    $stmt->execute();
    $stmt->close();

    echo "Data updated successfully!";
}
?>

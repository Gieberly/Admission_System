<?php
session_start();
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    // Perform the delete operation in your database
    $sql = "DELETE FROM admission_data WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $response = array("success" => true);
    } else {
        $response = array("success" => false);
    }

    // Return the response as JSON
    header("Content-Type: application/json");
    echo json_encode($response);
    exit;
}
?>

<?php
session_start();
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $programID = $_POST["programID"];

    // Perform the delete operation in your database
    $sql = "DELETE FROM Programs WHERE ProgramID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $programID);

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

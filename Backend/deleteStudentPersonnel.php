<?php
session_start();
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    // Move the record to the backup table before deleting
    $stmtMoveToBackup = $conn->prepare("INSERT INTO deleted_admission_data SELECT * FROM admission_data WHERE id = ?");
    $stmtMoveToBackup->bind_param("i", $id);
    $stmtMoveToBackup->execute();

    // Perform the delete operation in your main table
    $stmtDelete = $conn->prepare("DELETE FROM admission_data WHERE id = ?");
    $stmtDelete->bind_param("i", $id);

    if ($stmtDelete->execute()) {
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

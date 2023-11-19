<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["stepID"])) {
    $stepID = $_GET["stepID"];

    // Delete the Re-application Step from the database
    $sql = "DELETE FROM Reapplication WHERE StepID = $stepID";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: Reapplication.php"); // Redirect back to the Reapplication.php page after deleting the step
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

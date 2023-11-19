<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stepID = $_POST["reappStepID"]; // Retrieve the StepID
    $stepText = $_POST["reappStep"];

    // You may add additional validation here

    // Update the Re-application Step in the database
    $sql = "UPDATE Reapplication SET Steps = '$stepText' WHERE StepID = $stepID";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: Reapplication.php"); // Redirect back to the Reapplication.php page after editing the step
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

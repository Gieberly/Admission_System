<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reappStep = $_POST["reappStep"];

    // You may add additional validation here

    // Insert the new re-application step into the database
    $sql = "INSERT INTO Reapplication (Steps) VALUES ('$reappStep')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: Reapplication.php"); // Redirect back to the Reapplication.php page after adding the step
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

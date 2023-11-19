<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $courseName = $_POST["courseName"];
    $totalSlots = $_POST["totalSlots"];
    $availableSlots = $_POST["availableSlots"];

    // You may add additional validation here

    // Insert the new course into the database
    $sql = "INSERT INTO Courses (CourseName, TotalSlots, AvailableSlots) VALUES ('$courseName', $totalSlots, $availableSlots)";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: PersonnelEditSlot.php"); // Redirect back to the Slot.php page after adding the course
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
 
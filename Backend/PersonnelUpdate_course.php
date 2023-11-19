<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $courseID = $_POST["courseID"];
    $courseName = $_POST["courseName"];
    $totalSlots = $_POST["totalSlots"];
    $availableSlots = $_POST["availableSlots"];

    // You may add additional validation here

    // Update the course information in the database
    $sql = "UPDATE Courses SET CourseName = '$courseName', TotalSlots = $totalSlots, AvailableSlots = $availableSlots WHERE CourseID = $courseID";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: PersonnelEditSlot.php"); // Redirect back to the Slot.php page after updating the course
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
 
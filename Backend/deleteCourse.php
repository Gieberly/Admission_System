<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["courseID"])) {
    $courseID = $_GET["courseID"];

    // Delete the course from the database
    $sql = "DELETE FROM Courses WHERE CourseID = $courseID";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: PersonneleditSlot.php"); // Redirect back to the Slot.php page after deleting the course
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
 
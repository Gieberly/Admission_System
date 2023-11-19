<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["courseID"])) {
    $courseID = $_GET["courseID"];
    $sql = "SELECT * FROM Courses WHERE CourseID = $courseID";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $course = $result->fetch_assoc();
    } else {
        echo "Course not found!";
        exit();
    }
} else {
    echo "Invalid request!";
    exit();
}
?>

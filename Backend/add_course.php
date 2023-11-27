<?php
session_start();
include("config.php");

// Get the data from the AJAX request
$data = json_decode(file_get_contents("php://input"), true);

// Extract newCourseData from the data
$newCourseData = $data['newCourseData'];

// Insert the new course data into the database
$sql = "INSERT INTO Programs (Courses, Description, Nature_of_Degree, Overall_Slots) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssss', $newCourseData['Courses'], $newCourseData['Description'], $newCourseData['Nature_of_Degree'], $newCourseData['Overall_Slots']);
$stmt->execute();
$stmt->close();

$conn->close();
?>

<?php
session_start();
include("config.php");
// Get the data from the AJAX request
$data = json_decode(file_get_contents("php://input"), true);
// Extract newCourseData from the data
$newCourseData = $data['newCourseData'];
// Insert the new course data into the database
$sql = "INSERT INTO Programs (College, Courses,Nature_of_Degree, No_of_Sections, No_of_Students_Per_Section, Number_of_Available_Slots) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssiii', $newCourseData['College'], $newCourseData['Courses'], $newCourseData['Nature_of_Degree'], $newCourseData['No_of_Sections'],  $newCourseData['No_of_Students_Per_Section'],  $newCourseData['Number_of_Available_Slots']);
$stmt->execute();
$stmt->close();
$conn->close();
?>
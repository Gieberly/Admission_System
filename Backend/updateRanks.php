<?php
// updateRanks.php

// Assuming you have a database connection
$servername = "your_database_server";
$username = "your_database_username";
$password = "your_database_password";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get ranks data from the AJAX request
$ranksData = json_decode($_POST['ranks'], true);

// Update ranks in the database
foreach ($ranksData as $data) {
    $studentId = $data['studentId'];
    $rank = $data['rank'];

    // Assuming you have a table named 'students' with columns 'student_id' and 'rank'
    $sql = "UPDATE students SET rank = $rank WHERE student_id = $studentId";

    if ($conn->query($sql) !== TRUE) {
        echo "Error updating rank for student ID $studentId: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

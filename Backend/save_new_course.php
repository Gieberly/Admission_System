<?php
session_start();
include("config.php");

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the POST request
    $courses = $_POST["Courses"];
    $description = $_POST["Description"];
    $nature_of_degree = $_POST["Nature_of_Degree"];
    $overall_slots = $_POST["Overall_Slots"];

    // Validate the data (add your validation logic here)

    // Insert new course into the database
    $sql = "INSERT INTO Programs (Courses, Description, Nature_of_Degree, Overall_Slots)
            VALUES (?, ?, ?, ?)";

    // Using prepared statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $courses, $description, $nature_of_degree, $overall_slots);

    // Execute the statement
    if ($stmt->execute()) {
        // Return a success response
        $response = array("success" => true);
        echo json_encode($response);
    } else {
        // Return an error response
        $response = array("success" => false);
        echo json_encode($response);
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

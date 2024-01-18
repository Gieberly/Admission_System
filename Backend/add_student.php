<?php
// Include the database configuration file
include("config.php");

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Decode the JSON data received from the client
    $postData = json_decode(file_get_contents("php://input"), true);

    // Get the new student data
    $newStudentData = $postData['newStudentData'];

    // Validate and sanitize data (you may need to enhance this depending on your requirements)
    $applicantNumber = mysqli_real_escape_string($conn, $newStudentData['applicant_number']);
    $natureOfDegree = mysqli_real_escape_string($conn, $newStudentData['nature_of_degree']);
    $degreeApplied = mysqli_real_escape_string($conn, $newStudentData['degree_applied']);
    $applicantName = mysqli_real_escape_string($conn, $newStudentData['applicant_name']);
    $academicClassification = mysqli_real_escape_string($conn, $newStudentData['academic_classification']);
    $mathGrade = mysqli_real_escape_string($conn, $newStudentData['math_grade']);
    $scienceGrade = mysqli_real_escape_string($conn, $newStudentData['science_grade']);
    $englishGrade = mysqli_real_escape_string($conn, $newStudentData['english_grade']);
    $gwaGrade = mysqli_real_escape_string($conn, $newStudentData['gwa_grade']);
    $result = mysqli_real_escape_string($conn, $newStudentData['result']);

    // Perform the insertion query
    $insertQuery = "INSERT INTO admission_data (applicant_number, nature_of_degree, degree_applied, applicant_name, academic_classification, math_grade, science_grade, english_grade, gwa_grade, result) 
                    VALUES ('$applicantNumber', '$natureOfDegree', '$degreeApplied', '$applicantName', '$academicClassification', '$mathGrade', '$scienceGrade', '$englishGrade', '$gwaGrade', '$result')";

    if ($conn->query($insertQuery)) {
        // If the insertion is successful, send a success response
        echo json_encode(array('success' => true));
    } else {
        // If there is an error, send an error response
        echo json_encode(array('success' => false, 'error' => $conn->error));
    }

    // Close the database connection
    $conn->close();
} else {
    // If the request is not a POST request, redirect or handle accordingly
    header("Location: Applicants.php");
    exit();
}
?>
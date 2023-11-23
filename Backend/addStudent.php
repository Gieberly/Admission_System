<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $applicantNumber = $_POST["applicantNumber"];
    $natureOfDegree = $_POST["natureOfDegree"];
    $degreeApplied = $_POST["degreeApplied"];
    $applicantName = $_POST["applicantName"];
    $academicClassification = $_POST["academicClassification"];
    $mathGrade = $_POST["mathGrade"];
    $scienceGrade = $_POST["scienceGrade"];
    $englishGrade = $_POST["englishGrade"];
    $gwaGrade = $_POST["gwaGrade"];

    // Perform database insertion here
    $query = "INSERT INTO admission_data (applicant_number, nature_of_degree, degree_applied, applicant_name, academic_classification, math_grade, science_grade, english_grade, gwa_grade) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssss", $applicantNumber, $natureOfDegree, $degreeApplied, $applicantName, $academicClassification, $mathGrade, $scienceGrade, $englishGrade, $gwaGrade);
    
    if ($stmt->execute()) {
        echo "Student added successfully";
    } else {
        echo "Error adding student";
    }

    $stmt->close();
    $conn->close();
}
?>

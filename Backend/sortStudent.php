<?php
include("config.php");

// Function to get all admission data and sort by GWA
function getAndSortAdmissionData() {
    global $conn;
    $query = "SELECT id, math_grade, science_grade, english_grade, gwa_grade, rank FROM admission_data WHERE admission_status = 'NOR' OR admission_status = 'NOA' ORDER BY gwa_grade DESC";
    $result = $conn->query($query);
    return $result;
}

// Get and sort admission data
$sortedData = getAndSortAdmissionData();

// Return the sorted data as JSON
echo json_encode($sortedData->fetch_all(MYSQLI_ASSOC));

$conn->close();
?>

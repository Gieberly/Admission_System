<?php
session_start();
include("config.php");

// fetch_program_details.php
$programId = $_GET['program_id'];

// Fetch program details based on the program ID from the database
$sqlFetchProgramDetails = "SELECT Math, Science, English, GWA FROM academicclassification WHERE ProgramID = $programId";
$resultFetchProgramDetails = $conn->query($sqlFetchProgramDetails);

if ($resultFetchProgramDetails && $resultFetchProgramDetails->num_rows > 0) {
  $programDetails = $resultFetchProgramDetails->fetch_assoc();

  // Return program details as JSON 
  echo json_encode($programDetails);
} else {
  // Handle the case where program details are not found
  echo json_encode(null);
}
?>
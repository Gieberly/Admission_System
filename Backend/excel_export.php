<?php 
 
// Load the database configuration file 
include_once 'config.php'; 
 
// Include XLSX generator library 
require_once 'PhpXlsxGenerator.php'; 
 
// Excel file name for download 
$fileName = "appointments_" . date('Y-m-d') . ".xlsx"; 
 
// Define column names 
$excelData[] = array('APPLICATION NUMBER', 'NATURE OF DEGREE', 'PROGRAM', 'NAME', 'ACADEMIC CLASSIFICATION', 'APPLICATION DATE', 'APPLICATION TIME', 'STATUS'); 
 
// Fetch records from database and store in an array 
$query = $conn->query("SELECT * FROM admission_data ORDER BY id ASC"); 
if($query->num_rows > 0){ 
    while($row = $query->fetch_assoc()){ 
        $status = ($row['status'] == 1)?'Active':'Inactive'; 
        $lineData = array($row['applicant_number'], $row['nature_of_degree'], $row['degree_applied'], $row['applicant_name'],
         $row['academic_classification'], $row['appointment_date'], $row['appointment_time'], $row['appointment_status']);  
        $excelData[] = $lineData; 
    } 
} 
 
// Export data to excel and download as xlsx file 
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
$xlsx->downloadAs($fileName); 
 
exit; 
 
?>
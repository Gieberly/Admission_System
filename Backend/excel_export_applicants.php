<?php 
 
// Load the database configuration file 
include_once 'config.php'; 
 
// Include XLSX generator library 
require_once 'PhpXlsxGenerator.php'; 
 
// Excel file name for download 
$fileName = "Applicants_" . date('Y-m-d') . ".xlsx"; 
 
// Define column names 
$excelData[] = array('NAME', 'APPLICATION NUMBER', 'NATURE OF DEGREE', 'PROGRAM', 'ACADEMIC CLASSIFICATION',
 'MATH 1', 'MATH 2', 'MATH 3' , 'SCIENCE 1', 'SCIENCE 2', 'SCIENCE 3' , 'ENGLISH 1', 'ENGLISH 2', 'ENGLISH 3', 'GWA'); 
 
// Fetch records from database and store in an array 
$query = $conn->query("SELECT * FROM admission_data ORDER BY id ASC"); 
if($query->num_rows > 0){ 
    while($row = $query->fetch_assoc()){ 
        $status = ($row['status'] == 1)?'Active':'Inactive'; 
        $lineData = array($row['applicant_name'], $row['applicant_number'], $row['nature_of_degree'], $row['degree_applied'],
         $row['academic_classification'], $row['math_grade'], $row['math_2'], $row['math_3'], $row['science_grade'], $row['science_2'], $row['science_3'],
          $row['english_grade'], $row['english_2'], $row['english_3'], $row['gwa_grade']);  
        $excelData[] = $lineData; 
    } 
} 
 
// Export data to excel and download as xlsx file 
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
$xlsx->downloadAs($fileName); 
 
exit; 
 
?>
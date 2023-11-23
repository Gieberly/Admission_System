<?php
require 'PHPExcel/PHPExcel.php';

// Retrieve student data from the database
$query = "SELECT id, applicant_name, applicant_number, academic_classification, email, math_grade, science_grade, english_grade, gwa_grade, rank, result, nature_of_degree, degree_applied FROM admission_data ORDER BY applicant_name ASC";
$result = $conn->query($query);

// Create a new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set column headers
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', '#')
    ->setCellValue('B1', 'Application No.')
    ->setCellValue('C1', 'Nature of Degree')
    ->setCellValue('D1', 'Program')
    ->setCellValue('E1', 'Name')
    ->setCellValue('F1', 'Academic Classification')
    ->setCellValue('G1', 'Math')
    ->setCellValue('H1', 'Science')
    ->setCellValue('I1', 'English')
    ->setCellValue('J1', 'GWA')
    ->setCellValue('K1', 'Rank')
    ->setCellValue('L1', 'Result');

// Populate data from the database
$rowNumber = 2;
while ($row = $result->fetch_assoc()) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . $rowNumber, $rowNumber - 1)
        ->setCellValue('B' . $rowNumber, $row['applicant_number'])
        ->setCellValue('C' . $rowNumber, $row['nature_of_degree'])
        ->setCellValue('D' . $rowNumber, $row['degree_applied'])
        ->setCellValue('E' . $rowNumber, $row['applicant_name'])
        ->setCellValue('F' . $rowNumber, $row['academic_classification'])
        ->setCellValue('G' . $rowNumber, $row['math_grade'])
        ->setCellValue('H' . $rowNumber, $row['science_grade'])
        ->setCellValue('I' . $rowNumber, $row['english_grade'])
        ->setCellValue('J' . $rowNumber, $row['gwa_grade'])
        ->setCellValue('K' . $rowNumber, $row['rank'])
        ->setCellValue('L' . $rowNumber, $row['result']);

    $rowNumber++;
}

// Set column widths
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);

// Save the Excel file
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit();
?>

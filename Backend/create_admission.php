<?php
include("..\config.php"); // Include your database configuration file

if(isset($_POST['save_admission'])) {
    // Get form data
    $start = mysqli_real_escape_string($conn, $_POST['start']);
    $end = mysqli_real_escape_string($conn, $_POST['end']);
    $sem = mysqli_real_escape_string($conn, $_POST['sem']);
    $acad = mysqli_real_escape_string($conn, $_POST['acad']);

    // Mandatory field check
    if(empty($start) || empty($end) || empty($sem) || empty($acad)) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    // Insert data into database using prepared statement
    $sql = "INSERT INTO admission_period (start, end, sem, acad_year) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $start, $end, $sem, $acad);
    $sql_run = mysqli_stmt_execute($stmt);

    // Check if insertion was successful
    if($sql_run) {
        // Insertion successful
        $res = [
            'status' => 200,
            'message' => 'Admission Period Created Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        // Insertion failed
        $res = [
            'status' => 500,
            'message' => 'Admission Period Not Created'
        ];
        echo json_encode($res);
        return;
    }
} 
?>

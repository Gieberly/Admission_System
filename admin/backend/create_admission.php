<?php
include("../config.php");
 if(isset($_POST['submit_admission']))
 {
    $start= mysqli_real_escape_string($conn, $_POST['start']);
    $end= mysqli_real_escape_string($conn, $_POST['end']);
    $sem= mysqli_real_escape_string($conn, $_POST['sem']);
    $acad= mysqli_real_escape_string($conn, $_POST['acad']);

    if($start == NULL || $end == NULL || $sem== NULL|| $acad==NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return false;
    }
    $query = "INSERT INTO admission_period (start, end, sem, acad_year) VALUES  ( '$start', '$end','$sem','$acad')";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'New Admission is created'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Admission cannot be created'
        ];
        echo json_encode($res);
        return false;
    }
 }
?>

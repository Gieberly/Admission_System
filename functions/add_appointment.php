<?php
require '../config.php';

if(isset($_POST['save_appointment']))
{
    $date = mysqli_real_escape_string($conn,$_POST['date']);
    $time = mysqli_real_escape_string($conn,$_POST['time']);
    $slots = mysqli_real_escape_string($conn,$_POST['slots']);

    $query = "INSERT INTO appointmentdate (
        appointment_date,	
        appointment_time,
        available_slots	
        ) VALUES ('$date','$time','$slots')";

    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Appointment Created Successfully";
        header("Location: ..\admin\admin.php#schedule-result-content");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Appointment not created";
        header("Location : ..\admin\admin.php");
        exit(0);
    }
}
?>
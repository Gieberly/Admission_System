<?php
include("config.php");




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedDate = $_POST['selectedDate'];
    $selectedTime = $_POST['selectedTime'];

    // Perform necessary actions with the selected date and time
    // Insert into the database or perform any other operations

    // Redirect to a success page or any other page as needed
    header("Location: success_page.php");
    exit();
} else {
    // Redirect to the main page if accessed without a POST request
    header("Location: StudentSetAppointment.php");
    exit();
}
?>

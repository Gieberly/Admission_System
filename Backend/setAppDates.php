<?php
include 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a session started
    $userID = $_SESSION['user_id'];

    // Retrieve user input from the form
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];

    // Insert data into ApplicationDates table
    $stmt = $conn->prepare("INSERT INTO ApplicationDates (StartDate, EndDate) VALUES (?, ?)");
    $stmt->bind_param("ss", $startDate, $endDate);
    $stmt->execute();
    $stmt->close();

    // Redirect to a success page or do additional processing
    header("Location: Reapplication.php");
    exit();
}
?>


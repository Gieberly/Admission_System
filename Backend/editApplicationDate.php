<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dateID = $_POST["dateID"];
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];

    // Update the record in the database
    $stmt = $conn->prepare("UPDATE ApplicationDate SET StartDate=?, EndDate=? WHERE ApplicationDateID=?");
    $stmt->bind_param("ssi", $startDate, $endDate, $dateID);
    $stmt->execute();
    $stmt->close();

    // Redirect back to the page displaying application dates
    header("Location: Reapplication.php");
    exit();
}
?>

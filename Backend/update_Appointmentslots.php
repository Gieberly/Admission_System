<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $month = $_POST["month"];
    $day = $_POST["day"];
    $time = $_POST["time"];

    // Update the database slots based on the received data
    updateDatabaseSlots($conn, $month, $day, $time);

    // You can send a response if needed
    echo "Slots updated successfully";
} else {
    // Handle invalid requests
    header("HTTP/1.1 400 Bad Request");
    echo "Invalid request";
}

function updateDatabaseSlots($conn, $month, $day, $time) {
    // Assuming your table structure has columns 'Date', 'AMSlot', and 'PMSlot'
    $formattedDate = date("Y-m-d", strtotime("$month $day"));
    $columnName = ($time == 'AM') ? 'AMSlot' : 'PMSlot';

    // Update the database record
    $sql = "UPDATE appointments SET $columnName = $columnName - 1 WHERE Date = '$formattedDate'";
    $conn->query($sql);
}

$conn->close();
?>

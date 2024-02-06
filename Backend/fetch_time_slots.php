<?php
// Include necessary files and establish a database connection
include("config.php");

// Check if the selected date is provided in the POST request
if (isset($_POST['selectedDate'])) {
    $selectedDate = $_POST['selectedDate'];

    // Prepare and execute the SQL query to fetch available time slots for the selected date
    $sql = "SELECT appointment_time FROM appointmentdate WHERE appointment_date = ? AND available_slots > 0 ORDER BY appointment_time ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selectedDate);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch time slots and generate HTML options
    $options = "";
    while ($row = $result->fetch_assoc()) {
        $time24Format = $row['appointment_time'];
        $time12Format = date("h:i A", strtotime($time24Format));

        $options .= "<option value='{$time24Format}'>{$time12Format}</option>";
    }

    // Output the HTML options
    echo $options;
} else {
    // If selected date is not provided, return an empty string or handle the error as needed
    echo "";
}

// Close the database connection
$stmt->close();
$conn->close();
?>

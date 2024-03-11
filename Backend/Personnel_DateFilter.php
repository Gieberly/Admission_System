<?php
// Include necessary files and establish database connection

// Check if the selected appointment date is set
if (isset($_POST['selected_appointment_date'])) {
    $selectedDate = $_POST['selected_appointment_date'];

    // Modify your SQL query to fetch data based on the selected appointment date
    $query = "SELECT * FROM admission_data WHERE `application_date` = '$selectedDate'";

    $result = $conn->query($query);

    // Fetch and display the filtered data
    while ($row = $result->fetch_assoc()) {
        echo "<tr class='editRow' data-id='" . $row['id'] . "'>";
        // Add the rest of your table row content here
        echo "</tr>";
    }

    // Close the database connection
    $conn->close();
}
?>

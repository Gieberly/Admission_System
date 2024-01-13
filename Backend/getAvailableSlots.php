<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selectedDate'])) {
    $selectedDate = $_POST['selectedDate'];

    // Fetch available slots for the selected date and time from the database
    $sql = "SELECT * FROM Appointments WHERE Date = ? AND (AMSlot IS NOT NULL OR PMSlot IS NOT NULL)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selectedDate);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<label for="availableSlots">Available Slots:</label>';
        echo '<select name="availableSlots" required>';
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['AMSlot'] . "|" . $row['PMSlot'] . "'>AM: " . $row['AMSlot'] . " | PM: " . $row['PMSlot'] . "</option>";
        }
        echo '</select>';
    } else {
        echo '<p>No available slots for the selected date and time</p>';
    }
    $stmt->close();
} else {
    echo '<p>Invalid request</p>';
}

?>
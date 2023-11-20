<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming the form data is submitted via POST
    $newReleaseDate = $_POST['edit_release_date'];

    // Validate and update the releasing date in the database
    $stmt = $conn->prepare("UPDATE ReleasingDates SET release_date = ? WHERE ReleaseID = 1"); // Assuming ReleaseID is 1
    $stmt->bind_param("s", $newReleaseDate);

    if ($stmt->execute()) {
        echo "Releasing date updated successfully!";
    } else {
        echo "Error updating releasing date: " . $stmt->error;
    }

    $stmt->close();
}

// Redirect back to the original page after the update
header("Location: ReleasingDate.php");
exit();
?>

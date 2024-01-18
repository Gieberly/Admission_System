<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $releaseDate = $_POST["releaseDate"];

    // Update the record in the database
    $stmt = $conn->prepare("UPDATE ReleasingOfResults SET ReleaseDate=?");
    $stmt->bind_param("s", $releaseDate);
    $stmt->execute();
    $stmt->close();

    // Redirect back to the page displaying releasing dates
    header("Location: Reapplication.php");
    exit();
}
?>

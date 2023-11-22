<?php

include("config.php");

// Check if the request contains the necessary parameters
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Perform the delete operation
    $deleteQuery = "DELETE FROM admission_data WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Row deleted successfully!";
    } else {
        echo "Error deleting row: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Invalid request. Please provide an 'id' parameter.";
}

// Close the database connection
$conn->close();
?>

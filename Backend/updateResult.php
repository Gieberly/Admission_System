<?php
include("config.php");

// Check if the form for updating result is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['admissionId']) && isset($_POST['newResult'])) {
    $admissionId = $_POST['admissionId'];
    $newResult = $_POST['newResult'];

    // Function to update result
    updateResult($admissionId, $newResult);
}

// Function to update result
function updateResult($admissionId, $newResult) {
    global $conn;
    $query = "UPDATE admission_data SET result = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $newResult, $admissionId);

    if ($stmt->execute()) {
        echo "Result updated successfully!";
    } else {
        echo "Error updating result: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

$conn->close();
?>

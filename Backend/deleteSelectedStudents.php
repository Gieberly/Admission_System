<?php
include("config.php");

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve selected row IDs from the request
    $selectedRowIds = json_decode($_POST['selectedRowIds']);

    // Check if there are selected rows
    if (!empty($selectedRowIds)) {
        // Prepare a SQL statement to delete selected rows
        $stmt = $conn->prepare("DELETE FROM admission_data WHERE id IN (" . implode(',', $selectedRowIds) . ")");
        
        // Execute the statement
        if ($stmt->execute()) {
            // Return success response
            echo json_encode(['success' => true]);
            exit();
        } else {
            // Return error response
            echo json_encode(['success' => false, 'error' => 'Error deleting selected rows. Please try again.']);
            exit();
        }
    } else {
        // No rows selected
        echo json_encode(['success' => false, 'error' => 'No rows selected for deletion.']);
        exit();
    }
} else {
    // Invalid request method
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
    exit();
}
?>

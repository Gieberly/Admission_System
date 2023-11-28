<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedRowIds = json_decode($_POST['selectedRowIds']);

    if (!empty($selectedRowIds)) {
        // Move selected rows to the backup table
        $stmtMoveToBackup = $conn->prepare("INSERT INTO deleted_admission_data SELECT * FROM admission_data WHERE id IN (" . implode(',', $selectedRowIds) . ")");
        $stmtMoveToBackup->execute();

        // Delete selected rows from the main table
        $stmtDelete = $conn->prepare("DELETE FROM admission_data WHERE id IN (" . implode(',', $selectedRowIds) . ")");
        $stmtDelete->execute();

        // Return success response
        echo json_encode(['success' => true]);
        exit();
    } else {
        echo json_encode(['success' => false, 'error' => 'No rows selected for deletion.']);
        exit();
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
    exit();
}
?>

<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_students'], $_POST['result_value'])) {
    $selectedStudents = $_POST['selected_students'];
    $resultValue = $_POST['result_value'];

    // Update the database for selected students with the new result value
    $updateQuery = "UPDATE admission_data SET Result = ? WHERE id IN (" . implode(',', array_fill(0, count($selectedStudents), '?')) . ")";
    $stmtUpdate = $conn->prepare($updateQuery);

    $stmtUpdate->bind_param('s' . str_repeat('i', count($selectedStudents)), $resultValue, ...$selectedStudents);
    $stmtUpdate->execute();
    $stmtUpdate->close();

    // Return a success response
    echo 'Changes saved successfully';
} else {
    // Handle invalid or missing data
    echo 'Invalid request';
}
?>

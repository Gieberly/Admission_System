<?php
include 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id']; // Assuming you're passing the ID from the form
    $nature_qualification = !empty($_POST['nature_qualification']) ? $_POST['nature_qualification'] : null;
    $Degree_Remarks = !empty($_POST['Degree_Remarks']) ? $_POST['Degree_Remarks'] : null;
   
    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("UPDATE admission_data SET nature_qualification=?, Degree_Remarks=? WHERE id=?");
    $stmt->bind_param("ssi", $nature_qualification, $Degree_Remarks, $id); // Assuming id is an integer

    // Execute the statement
    if ($stmt->execute()) {
        // Set a session variable for success message
        session_start();
        $_SESSION['update_success'] = true;

        // Redirect to desired page
        header("Location: Personnel_Applicants.php");
        exit();
    } else {
        // Print error if update fails
        echo "Error updating record: " . $conn->error;
    }
}

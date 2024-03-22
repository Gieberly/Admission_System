<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id']; // Assuming you're passing the ID from the form
    $Gr12_GWA = !empty($_POST['Gr12_GWA']) ? $_POST['Gr12_GWA'] : null;
    $Qualification_Nature_Degree = !empty($_POST['Qualification_Nature_Degree']) ? $_POST['Qualification_Nature_Degree'] : null;
    $Degree_Remarks = !empty($_POST['Degree_Remarks']) ? $_POST['Degree_Remarks'] : null;
   
    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("UPDATE admission_data SET Qualification_Nature_Degree=?, Degree_Remarks=? WHERE id=?");
    $stmt->bind_param("ddi", $Qualification_Nature_Degree,$Degree_Remarks, $id);

    // Execute the statement
    if ($stmt->execute()) {
        // Set a session variable for success message
        session_start();
        $_SESSION['update_success'] = true;

        // Redirect to desired page
        header("Location: Personnel_Applicants.php");
        exit();
    }
}

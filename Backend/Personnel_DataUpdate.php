<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id']; // Assuming you're passing the ID from the form
    $applicant_name = $_POST['applicant_name'];
    $gender = $_POST['gender'];
    // Retrieve other form fields in a similar manner

    // Prepare and bind parameters
    $stmt = $conn->prepare("UPDATE admission_data SET applicant_name=?, gender=? WHERE id=?");
    $stmt->bind_param("ssi", $applicant_name, $gender, $id);

    // Execute the update statement
    if ($stmt->execute()) {
        // If update successful, redirect to a success page or display a success message
        header("Location: Personnel_Verification.php");
        exit();
   
    }
} else {
    // If the request method is not POST, redirect to an error page or display an error message
    header("Location: error.php");
    exit();
}


<?php

// Include the function to add data into a table
include 'redirect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $tableName = isset($_POST["college_name"]) ? $_POST["college_name"] : "";

    // Function to convert date format safely
    function convertDateFormat($dateString)
    {
        $date = DateTime::createFromFormat('m/d/Y', $dateString);
        return $date ? $date->format('Y-m-d') : null;
    }

    $data = array(
        'id_picture' => isset($_FILES['id_picture']) ? $_FILES['id_picture']['name'] : null,
        'applicant_name' => $_POST['applicant_name'],
        'gender' => $_POST['gender'],
        'birthdate' => convertDateFormat($_POST['birthdate']),
        'birthplace' => $_POST['birthplace'],
        'age' => $_POST['age'],
        'civil_status' => $_POST['civil_status'],
        'citizenship' => $_POST['citizenship'],
        'nationality' => $_POST['nationality'],
        'permanent_address' => $_POST['permanent_address'],
        'zip_code' => $_POST['zip_code'],
        'phone_number' => $_POST['phone_number'],
        'facebook' => $_POST['facebook'],
        'email' => $_POST['email'],
        'contact_person_1' => $_POST['contact_person_1'],
        'contact1_phone' => $_POST['contact1_phone'],
        'relationship_1' => $_POST['relationship_1'],
        'contact_person_2' => $_POST['contact_person_2'],
        'contact_person_2_mobile' => $_POST['contact_person_2_mobile'],
        'relationship_2' => $_POST['relationship_2'],
        'academic_classification' => $_POST['academic_classification'],
        'high_school_name_address' => $_POST['high_school_name_address'],
        'lrn' => $_POST['lrn'],
        'degree_applied' => $_POST['degree_applied'],
        'nature_of_degree' => $_POST['nature_of_degree'],
        'applicant_number' => $_POST['applicant_number'],
        'application_date' => convertDateFormat($_POST['application_date']),
    );

    // File upload handling
    if (isset($_FILES['id_picture'])) {
        $targetDir = "uploads/"; // Directory where the file will be uploaded

        // Create the directory if it doesn't exist
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true); // Create directory recursively
        }

        $fileName = basename($_FILES["id_picture"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        // Move uploaded file to specified directory
        if (move_uploaded_file($_FILES["id_picture"]["tmp_name"], $targetFilePath)) {
            $data['id_picture'] = $fileName;
        } else {
            echo "Error uploading file.";
        }
    }
    // Add data to the table
    insertDataIntoTable($tableName, $data);
}

?>

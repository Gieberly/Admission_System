<?php
include 'config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $id = $_POST['id'];
    $Gr11_A1 = $_POST['Gr11_A1'];
    $Gr11_A2 = $_POST['Gr11_A2'];
    $Gr11_A3 = $_POST['Gr11_A3'];
    $Gr11_GWA = $_POST['Gr11_GWA'];
    $Gr12_A1 = $_POST['Gr12_A1'];
    $Gr12_A2 = $_POST['Gr12_A2'];
    $Gr12_A3 = $_POST['Gr12_A3'];
    $Gr12_GWA = $_POST['Gr12_GWA'];
    $English_Oral_Communication_Grade = $_POST['English_Oral_Communication_Grade'];
    $English_Reading_Writing_Grade = $_POST['English_Reading_Writing_Grade'];
    $English_Academic_Grade = $_POST['English_Academic_Grade'];
    $English_Other_Courses_Grade = $_POST['English_Other_Courses_Grade'];
    $Science_Earth_Science_Grade = $_POST['Science_Earth_Science_Grade'];
    $Science_Earth_and_Life_Science_Grade = $_POST['Science_Earth_and_Life_Science_Grade'];
    $Science_Physical_Science_Grade = $_POST['Science_Physical_Science_Grade'];
    $Science_Disaster_Readiness_Grade = $_POST['Science_Disaster_Readiness_Grade'];
    $Science_Other_Courses_Grade = $_POST['Science_Other_Courses_Grade'];
    $Math_General_Mathematics_Grade = $_POST['Math_General_Mathematics_Grade'];
    $Math_Statistics_and_Probability_Grade = $_POST['Math_Statistics_and_Probability_Grade'];
    $Math_Other_Courses_Grade = $_POST['Math_Other_Courses_Grade'];
    $Old_HS_English_Grade = $_POST['Old_HS_English_Grade'];
    $Old_HS_Math_Grade = $_POST['Old_HS_Math_Grade'];
    $Old_HS_Science_Grade = $_POST['Old_HS_Science_Grade'];
    $ALS_Grade = $_POST['ALS_Grade'];
    
    // Update data in the database
    $sql = "UPDATE admission_data SET 
            Gr11_A1 = '$Gr11_A1',
            Gr11_A2 = '$Gr11_A2',
            Gr11_A3 = '$Gr11_A3',
            Gr11_GWA = '$Gr11_GWA',
            Gr12_A1 = '$Gr12_A1',
            Gr12_A2 = '$Gr12_A2',
            Gr12_A3 = '$Gr12_A3',
            Gr12_GWA = '$Gr12_GWA',
            English_Oral_Communication_Grade = '$English_Oral_Communication_Grade',
            English_Reading_Writing_Grade = '$English_Reading_Writing_Grade',
            English_Academic_Grade = '$English_Academic_Grade',
            English_Other_Courses_Grade = '$English_Other_Courses_Grade',
            Science_Earth_Science_Grade = '$Science_Earth_Science_Grade',
            Science_Earth_and_Life_Science_Grade = '$Science_Earth_and_Life_Science_Grade',
            Science_Physical_Science_Grade = '$Science_Physical_Science_Grade',
            Science_Disaster_Readiness_Grade = '$Science_Disaster_Readiness_Grade',
            Science_Other_Courses_Grade = '$Science_Other_Courses_Grade',
            Math_General_Mathematics_Grade = '$Math_General_Mathematics_Grade',
            Math_Statistics_and_Probability_Grade = '$Math_Statistics_and_Probability_Grade',
            Math_Other_Courses_Grade = '$Math_Other_Courses_Grade',
            Old_HS_English_Grade = '$Old_HS_English_Grade',
            Old_HS_Math_Grade = '$Old_HS_Math_Grade',
            Old_HS_Science_Grade = '$Old_HS_Science_Grade',
            ALS_Grade = '$ALS_Grade'
            WHERE id = '$id'";
    
    if ($conn->query($sql) === TRUE) {
        $success_message = "Updated successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    
    // Close connection
    $conn->close();
}

// Redirect to Personnel_Applicants.php
header("Location: Personnel_Applicants.php?success_message=" . urlencode($success_message));
exit();
?>
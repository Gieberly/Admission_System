<?php
include 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id']; // Assuming you're passing the ID from the form

    // Assuming you have received all these values in the POST request
    $Gr11_A1 = $_POST['Gr11_A1'];
    $Gr11_A2 = $_POST['Gr11_A2'];
    $Gr11_A3 = $_POST['Gr11_A3'];
    $Gr11_GWA = $_POST['Gr11_GWA'];
    $GWA_OTAS = $_POST['GWA_OTAS'];
    $Gr12_A1 = $_POST['Gr12_A1'];
    $Gr12_A2 = $_POST['Gr12_A2'];
    $Gr12_A3 = $_POST['Gr12_A3'];
    $Gr12_GWA = $_POST['Gr12_GWA'];
    $English_Oral_Communication_Grade = $_POST['English_Oral_Communication_Grade'];
    $English_Reading_Writing_Grade = $_POST['English_Reading_Writing_Grade'];
    $English_Academic_Grade = $_POST['English_Academic_Grade'];
    $English_Other_Courses_Grade = $_POST['English_Other_Courses_Grade'];
    $Science_Earth_Science_Grade = $_POST['Science_Earth_Science_Grade'];
    $academic_classification = $_POST['academic_classification'];
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
    $Requirements = $_POST['Requirements'];
    $Requirements_Remarks = $_POST['Requirements_Remarks'];
    $OSS_Endorsement_Slip = $_POST['OSS_Endorsement_Slip'];
    $OSS_Admission_Test_Score = $_POST['OSS_Admission_Test_Score'];
    $OSS_Remarks = $_POST['OSS_Remarks'];
    $Qualification_Nature_Degree = $_POST['Qualification_Nature_Degree'];
    $Interview_Result = $_POST['Interview_Result'];
    $Endorsed = $_POST['Endorsed'];
    $Confirmed_Slot = $_POST['Confirmed_Slot'];
    $Final_Remarks = $_POST['Final_Remarks'];
    $degree_applied = $_POST['degree_applied'];
    $nature_of_degree = $_POST['nature_of_degree'];
    $college = $_POST['college'];

   // Prepare the SQL update statement
$stmt = $conn->prepare("UPDATE admission_data SET 
Gr11_A1=?, 
Gr11_A2=?, 
Gr11_A3=?, 
Gr11_GWA=?, 
GWA_OTAS=?, 
Gr12_A1=?, 
Gr12_A2=?, 
Gr12_A3=?, 
Gr12_GWA=?, 
English_Oral_Communication_Grade=?, 
English_Reading_Writing_Grade=?, 
English_Academic_Grade=?, 
English_Other_Courses_Grade=?, 
Science_Earth_Science_Grade=?, 
academic_classification=?, 
Science_Earth_and_Life_Science_Grade=?, 
Science_Physical_Science_Grade=?, 
Science_Disaster_Readiness_Grade=?, 
Science_Other_Courses_Grade=?, 
Math_General_Mathematics_Grade=?, 
Math_Statistics_and_Probability_Grade=?, 
Math_Other_Courses_Grade=?, 
Old_HS_English_Grade=?, 
Old_HS_Math_Grade=?, 
Old_HS_Science_Grade=?, 
ALS_Grade=?, 
Requirements=?, 
Requirements_Remarks=?, 
OSS_Endorsement_Slip=?, 
OSS_Admission_Test_Score=?, 
OSS_Remarks=?, 
Qualification_Nature_Degree=?, 
Interview_Result=?, 
Endorsed=?, 
Confirmed_Slot=?, 
Final_Remarks=?, 
degree_applied=?, 
nature_of_degree=?, 
college=?
WHERE id=?");

// Bind parameters to the prepared statement
$stmt->bind_param("ssssssssssssssssssssssssssssssssi", 
$Gr11_A1, 
$Gr11_A2, 
$Gr11_A3, 
$Gr11_GWA, 
$GWA_OTAS, 
$Gr12_A1, 
$Gr12_A2, 
$Gr12_A3, 
$Gr12_GWA, 
$English_Oral_Communication_Grade, 
$English_Reading_Writing_Grade, 
$English_Academic_Grade, 
$English_Other_Courses_Grade, 
$Science_Earth_Science_Grade, 
$academic_classification, 
$Science_Earth_and_Life_Science_Grade, 
$Science_Physical_Science_Grade, 
$Science_Disaster_Readiness_Grade, 
$Science_Other_Courses_Grade, 
$Math_General_Mathematics_Grade, 
$Math_Statistics_and_Probability_Grade, 
$Math_Other_Courses_Grade, 
$Old_HS_English_Grade, 
$Old_HS_Math_Grade, 
$Old_HS_Science_Grade, 
$ALS_Grade, 
$Requirements, 
$Requirements_Remarks, 
$OSS_Endorsement_Slip, 
$OSS_Admission_Test_Score, 
$OSS_Remarks, 
$Qualification_Nature_Degree, 
$Interview_Result, 
$Endorsed, 
$Confirmed_Slot, 
$Final_Remarks, 
$degree_applied, 
$nature_of_degree, 
$college,
$id
);


    // Execute the prepared statement
    if ($stmt->execute()) {
        // Set a session variable for success message
        session_start();
        $_SESSION['update_success'] = true;

        header("Location: Personnel_Applicants.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

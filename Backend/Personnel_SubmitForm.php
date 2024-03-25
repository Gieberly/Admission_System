<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id']; // Assuming you're passing the ID from the form
    $Gr11_A1 = !empty($_POST['Gr11_A1']) ? $_POST['Gr11_A1'] : null;
    $Gr11_A2 = !empty($_POST['Gr11_A2']) ? $_POST['Gr11_A2'] : null;
    $Gr11_A3 = !empty($_POST['Gr11_A3']) ? $_POST['Gr11_A3'] : null;
    $Gr11_GWA = !empty($_POST['Gr11_GWA']) ? $_POST['Gr11_GWA'] : null;
    $GWA_OTAS = !empty($_POST['GWA_OTAS']) ? $_POST['GWA_OTAS'] : null;
    $Gr12_A1 = !empty($_POST['Gr12_A1']) ? $_POST['Gr12_A1'] : null;
    $Gr12_A2 = !empty($_POST['Gr12_A2']) ? $_POST['Gr12_A2'] : null;
    $Gr12_A3 = !empty($_POST['Gr12_A3']) ? $_POST['Gr12_A3'] : null;
    $Gr12_GWA = !empty($_POST['Gr12_GWA']) ? $_POST['Gr12_GWA'] : null;
    $English_Oral_Communication_Grade = !empty($_POST['English_Oral_Communication_Grade']) ? $_POST['English_Oral_Communication_Grade'] : null;
    $English_Reading_Writing_Grade = !empty($_POST['English_Reading_Writing_Grade']) ? $_POST['English_Reading_Writing_Grade'] : null;
    $English_Academic_Grade = !empty($_POST['English_Academic_Grade']) ? $_POST['English_Academic_Grade'] : null;
    $English_Other_Courses_Grade = !empty($_POST['English_Other_Courses_Grade']) ? $_POST['English_Other_Courses_Grade'] : null;
    $Science_Earth_Science_Grade = !empty($_POST['Science_Earth_Science_Grade']) ? $_POST['Science_Earth_Science_Grade'] : null;
    $Science_Earth_and_Life_Science_Grade = !empty($_POST['Science_Earth_and_Life_Science_Grade']) ? $_POST['Science_Earth_and_Life_Science_Grade'] : null;
    $Science_Physical_Science_Grade = !empty($_POST['Science_Physical_Science_Grade']) ? $_POST['Science_Physical_Science_Grade'] : null;
    $Science_Disaster_Readiness_Grade = !empty($_POST['Science_Disaster_Readiness_Grade']) ? $_POST['Science_Disaster_Readiness_Grade'] : null;
    $Science_Other_Courses_Grade = !empty($_POST['Science_Other_Courses_Grade']) ? $_POST['Science_Other_Courses_Grade'] : null;
    $Math_General_Mathematics_Grade = !empty($_POST['Math_General_Mathematics_Grade']) ? $_POST['Math_General_Mathematics_Grade'] : null;
    $Math_Statistics_and_Probability_Grade = !empty($_POST['Math_Statistics_and_Probability_Grade']) ? $_POST['Math_Statistics_and_Probability_Grade'] : null;
    $Math_Other_Courses_Grade = !empty($_POST['Math_Other_Courses_Grade']) ? $_POST['Math_Other_Courses_Grade'] : null;
    $Old_HS_English_Grade = !empty($_POST['Old_HS_English_Grade']) ? $_POST['Old_HS_English_Grade'] : null;
    $Old_HS_Math_Grade = !empty($_POST['Old_HS_Math_Grade']) ? $_POST['Old_HS_Math_Grade'] : null;
    $Old_HS_Science_Grade = !empty($_POST['Old_HS_Science_Grade']) ? $_POST['Old_HS_Science_Grade'] : null;
    $ALS_Math = !empty($_POST['ALS_Math']) ? $_POST['ALS_Math'] : null;
    $ALS_English = !empty($_POST['ALS_English']) ? $_POST['ALS_English'] : null;
    $Qualification_Nature_Degree = !empty($_POST['Qualification_Nature_Degree']) ? $_POST['Qualification_Nature_Degree'] : null;
    $nature_qualification = !empty($_POST['nature_qualification']) ? $_POST['Qualification_Nature_Degree'] : null;

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("UPDATE admission_data SET nature_qualification=?, Qualification_Nature_Degree=?, Gr11_A1=?, Gr11_A2=?, Gr11_A3=?, Gr11_GWA=?, GWA_OTAS=?, Gr12_A1=?, Gr12_A2=?, Gr12_A3=?, Gr12_GWA=?, English_Oral_Communication_Grade=?, English_Reading_Writing_Grade=?, English_Academic_Grade=?, English_Other_Courses_Grade=?, Science_Earth_Science_Grade=?, Science_Earth_and_Life_Science_Grade=?, Science_Physical_Science_Grade=?, Science_Disaster_Readiness_Grade=?, Science_Other_Courses_Grade=?, Math_General_Mathematics_Grade=?, Math_Statistics_and_Probability_Grade=?, Math_Other_Courses_Grade=?, Old_HS_English_Grade=?, Old_HS_Math_Grade=?, Old_HS_Science_Grade=?, ALS_Math=?,ALS_English=?  WHERE id=?");
    $stmt->bind_param("ddddddddddddddddddddddddddddi", $nature_qualification, $Qualification_Nature_Degree, $Gr11_A1, $Gr11_A2, $Gr11_A3, $Gr11_GWA, $GWA_OTAS, $Gr12_A1, $Gr12_A2, $Gr12_A3, $Gr12_GWA, $English_Oral_Communication_Grade, $English_Reading_Writing_Grade, $English_Academic_Grade, $English_Other_Courses_Grade, $Science_Earth_Science_Grade, $Science_Earth_and_Life_Science_Grade, $Science_Physical_Science_Grade, $Science_Disaster_Readiness_Grade, $Science_Other_Courses_Grade, $Math_General_Mathematics_Grade, $Math_Statistics_and_Probability_Grade, $Math_Other_Courses_Grade, $Old_HS_English_Grade, $Old_HS_Math_Grade, $Old_HS_Science_Grade, $ALS_Math,$ALS_English, $id);

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

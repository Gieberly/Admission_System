<?php
include('config.php'); // Include your database configuration file

if (isset($_GET['rowId'])) {
    $rowId = $_GET['rowId'];

    // Fetch the academic classification based on the rowId
    $query = "SELECT academic_classification FROM admission_data WHERE id = $rowId";
    $result = $conn->query($query);

    if ($result && $row = $result->fetch_assoc()) {
        $classification = $row['academic_classification'];

        // Call the function to render requirements
        renderRequirements($classification, $conn);
    } else {
        // Handle the case where no matching row is found
        echo "<p>No data found for the selected row.</p>";
    }
}

function renderRequirements($classification, $conn)
{
    $requirements_query = "SELECT * FROM academicclassification WHERE Classification = '$classification'";
    $requirements_result = $conn->query($requirements_query);

    if ($requirements_result && $requirements_row = $requirements_result->fetch_assoc()) {
        echo "<h2>Student Requirements</h2>";

        echo "<div class='form-group'>";
        echo "<input name='academic_classification' class='input' id='academic_classification' value='$classification' disabled>";
        echo "</div>";

        for ($i = 1; $i <= 7; $i++) {
            $requirement_key = "Requirement$i";
            echo "<div class='requirement'>$requirement_key: " . $requirements_row[$requirement_key] . "</div>";
        }
    } else {
        // Handle the case where no matching classification is found
        echo "<p>Requirements not available for the selected academic classification.</p>";
    }
}
?>

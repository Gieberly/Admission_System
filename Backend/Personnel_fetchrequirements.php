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

        // Fetch additional data for the form
        $admissionDataQuery = "SELECT * FROM admission_data WHERE id = $rowId";
        $admissionDataResult = $conn->query($admissionDataQuery);

        if ($admissionDataResult && $admissionData = $admissionDataResult->fetch_assoc()) {
?>
            <form id="updateProfileForm" class="tab1-content" method="post" action="Personnel_DataUpdate.php">
              

                <button type="submit">Update Profile</button>
            </form>
<?php
        } else {
            // Handle the case where no matching row is found for admission data
            echo "<p>No admission data found for the selected row.</p>";
        }
    } else {
        // Handle the case where no matching row is found for academic classification
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
            
            // Check if the requirement has data before creating a checkbox
            if (!empty($requirements_row[$requirement_key])) {
                echo "<div class='requirement'>";
                echo "<input type='checkbox' name='requirements[]' value='$i' id='requirement_$i'>";
                echo "<label for='requirement_$i'>" . $requirements_row[$requirement_key] . "</label>";
                echo "</div>";
            }
        }
    } else {
        // Handle the case where no matching classification is found
        echo "<p>Requirements not available for the selected academic classification.</p>";
    }
}

<?php
include("config.php");

$selectedNonBoardClassification = $_GET['non_board_classification'];

$sql = "SELECT * FROM nonboardacadclass WHERE Classification = '$selectedNonBoardClassification'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Check if GWA is available for the selected Non-Board classification
    $gwaAvailable = !empty($row['GWA']);
    
    // Display GWA input field and submit button if available
    if ($gwaAvailable) {
        echo '<div id="GWA-fieldNonBoard" class="gradeFields">';
        echo '<label for="GWA">GWA</label>';
        echo '<input  class="input grades-input"  type="text" name="GWA" id="GWA" value="" required>';
        echo '</div>';

        // Add the submit button for non-board classification
        echo '<button type="button" onclick="checkUserInputNonBoard()">Submit GWA (Non-Board)</button>';
    } else {
        echo '<p>No GWA data found for the selected Non-Board classification.</p>';
    }
    
    // Include the JavaScript function to check user input for Non-Board classification
    echo '<script>';
    echo 'function checkUserInputNonBoard() {';
    echo '  var gwaInput = parseFloat(document.getElementById("GWA").value) || 0;';
    echo '  if (!isNaN(gwaInput) && gwaInput >= ' . $row['GWA'] . ') {';
    echo '    alert("Congratulations! Your Grade is eligible for the Program. Please proceed completing the Admission Form.");';
    echo '  } else {';
    echo '    alert("Sorry! Your Grade didn\'t pass the required Grade for the Program. We advise you not to continue filling the Admission Form. Thank you.");';
    echo '  }';
    echo '}';
    echo '</script>';
} else {
    echo '<p>No data found for the selected Non-Board classification.</p>';
}

$conn->close();
?>

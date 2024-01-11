<?php
include("config.php");

$selectedClassification = $_GET['classification'];

$sql = "SELECT * FROM academicclassification WHERE Classification = '$selectedClassification'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Check if only GWA is available
    $onlyGWA = !empty($row['GWA']) && empty($row['Math']) && empty($row['Science']) && empty($row['English']);

    echo '<div id="gradeForm class="programFields">';  

    if (!empty($row['Math'])) {
        echo '<div id="Math-field" class="gradeFields">';
        echo '<label for="Math">Math Grade</label>';
        echo '<input class="input grades-input" type="text" name="Math" id="Math" value="" required>';
        echo '</div>';
    }

    if (!empty($row['Science'])) {
        echo '<div id="Science-field" class="gradeFields">';
        echo '<label for="Science">Science Grade</label>';
        echo '<input class="input grades-input" type="text" name="Science" id="Science" value="" required>';
        echo '</div>';
    }

    if (!empty($row['English'])) {
        echo '<div id="English-field" class="gradeFields">';
        echo '<label for="English">English Grade</label>';
        echo '<input class="input grades-input" type="text" name="English" id="English" value="" required>';
        echo '</div>';
    }

    if (!empty($row['GWA'])) {
        echo '<div id="GWA-field" class="gradeFields">';
        echo '<label for="GWA">GWA</label>';
        echo '<input class="input grades-input" type="text" name="GWA" id="GWA" value="" required>';
        echo '</div>';
    }

    // Display the appropriate submit button(s)
    if ($onlyGWA) {
        echo '<button type="button" onclick="checkUserInputGWA()">Submit GWA</button>';
    } else {
        echo '<button type="button" onclick="checkUserInput()">Submit</button>';
    }

    echo '</div>';

    // JavaScript function to check user input
    echo '<script>';
    echo 'function checkUserInput() {';
    echo '  var mathInput = parseFloat(document.getElementById("Math").value) || 0;';
    echo '  var scienceInput = parseFloat(document.getElementById("Science").value) || 0;';
    echo '  var englishInput = parseFloat(document.getElementById("English").value) || 0;';
    echo '  var gwaInput = parseFloat(document.getElementById("GWA").value) || 0;';

    echo '  function checkPassed(userInput, subjectGrade) {';
    echo '    return (!isNaN(userInput) && userInput >= subjectGrade);';
    echo '  }';

    echo '  if (checkPassed(mathInput, ' . $row['Math'] . ') &&';
    echo '      checkPassed(scienceInput, ' . $row['Science'] . ') &&';
    echo '      checkPassed(englishInput, ' . $row['English'] . ') &&';
    echo '      checkPassed(gwaInput, ' . $row['GWA'] . ')) {';
    echo '    alert("Congratulations! Your Grade is eligible for the Program. Please proceed with completing the Admission Form.");';
    echo '  } else {';
    echo '    alert("Failed! Your Grade didn\'t pass the required Grade for the Program. We advise you not to continue filling the Admission Form. Thank you");';
    echo '  }';
    echo '}';
    if ($onlyGWA) {
        echo 'function checkUserInputGWA() {';
        echo '  var gwaInput = parseFloat(document.getElementById("GWA").value) || 0;';
        echo '  if (!isNaN(gwaInput) && gwaInput >= ' . $row['GWA'] . ') {';
        echo '    alert("Congratulations! Your Grade is eligible for the Program. Please proceed with completing the Admission Form.");';
        echo '  } else {';
        echo '    alert("Failed! Your Grade didn\'t pass the required Grade for the Program. We advise you not to continue filling the Admission Form. Thank you.");';
        echo '  }';
        echo '}';
    }

    echo '</script>';
} else {
    echo '<p>No data found for the selected classification.</p>';
}

$conn->close();
?>

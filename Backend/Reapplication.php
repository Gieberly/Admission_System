<?php
include("config.php");
include("Personnel_Cover.php");


// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Staff') {
    header("Location: loginpage.php");
    exit();
}
$userID = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, email, userType, status FROM users WHERE id = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($name, $email, $userType, $status);
$stmt->fetch();
$stmt->close();


function getReapplicationSteps($conn) {
    $steps = array();

    $sql = "SELECT * FROM Reapplication";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $steps[] = $row;
        }
    }

    return $steps;
    
}
function getApplicationDates($conn) {
    $dates = array();

    $sql = "SELECT * FROM ApplicationDate";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dates[] = $row;
        }
    }

    return $dates;
}

function getReleasingOfResults($conn) {
    $results = array();

    $sql = "SELECT ReleaseDate FROM ReleasingOfResults";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
    }

    return $results;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BSU OUR Admission Unit Personnel</title>
    <link rel="icon" href="assets/images/BSU Logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css//personnel.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!-- SIDEBAR -->
   
    <section id="content">


        <main>

    <div id="announcements-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Annoucement</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Announcement</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><p>FAQ</p></li>
                        </ul>
                    </div>
                </div>

                <!--form-->
                <div class="tabs">
                    <button class="tab-button" data-tab="tab3"  onclick="window.location.href='faq.php'">FAQ</button>
                    <button class="tab-button" data-tab="tab5" onclick="window.location.href='PersonnelEditSlot.php'">Slot</button>
                    <button class="tab-button active" data-tab="tab4"  onclick="window.location.href='Reapplication.php'">Admission</button>

                  

                </div>
                     
<div class="table-data">
                        <div class="order">
                        
                            <div class="head">
						<h3>Steps for Reapplication</h3>
                        <button class="button save" id="addcoursepop" >Add Steps</button>
						
					</div>
                
                   

       
                <div class="tab-content" id="tab4" style="display: block;">
              
                <div>
                <table id=courses-table>
                <colgroup>
                                        <col style="width: 5%;">
                                        <col style="width:55%;">
                                        <col style="width:35%;">

                                       
                                       
                                    </colgroup>
                    <thead>
               <tr>
                <th>#</th>
                <th>Admission Date</th>
         
                <th>Action</th>
            </tr>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
        $reappSteps = getReapplicationSteps($conn);

        foreach ($reappSteps as $index => $step) {
            echo "<tr>";
            echo "<td>" . ($index + 1) . "</td>";
            echo "<td>" . $step['Steps'] . "</td>";
            echo "<td>";
            echo "<button class='button edit' onclick='editReappStep(" . $step['StepID'] . ", \"" . $step['Steps'] . "\")'>Edit</button>";
            echo "<button class='button delete' onclick='deleteReappStep(" . $step['StepID'] . ")'>Delete</button>";
            echo "</td>";
            echo "</tr>";
        }
    ?>
        </tbody>
    </table>
    
    <div id="edit-reapp-step-section" style="display: none;">
    <h2>Edit Re-application Step</h2>
    <form id="edit-reapp-step-form" action="editReappSteps.php" method="post">
        <input type="hidden" id="edit-reapp-step-ID" name="reappStepID"> <!-- Add this line for StepID -->
        <label for="edit-reapp-step">Re-application Step:</label>
        <input type="text" id="edit-reapp-step" name="reappStep" required>
        <button type="button" class="button save" onclick="saveEditedReappStep()">Save Step</button>
    </form>
</div>

<div id="add-reapp-step-section">
    <form id="add-reapp-step-form" action="addReappSteps.php" method="post" style="display: none;">
        <h2>Add New Re-application Step</h2>
        <label for="new-reapp-step">Re-application Step:</label>
        <input type="text" id="new-reapp-step" name="reappStep" required>
        <button type="button" class="button save" onclick="addNewReappStep()">Add Step</button>
    </form>
</div>

    </div></div>
    <script>
   function editReappStep(stepID, stepText) {
        // Set values in the edit form
        document.getElementById('edit-reapp-step-ID').value = stepID;
        document.getElementById('edit-reapp-step').value = stepText;

        // Show the edit form and hide other sections
        document.getElementById('edit-reapp-step-section').style.display = 'block';
        document.getElementById('courses-table').style.display = 'none';
        document.getElementById('add-reapp-step-form').style.display = 'none';
    }

    function saveEditedReappStep() {
        // Submit the form for saving the edited Re-application Step
        document.getElementById('edit-reapp-step-form').submit();
    }

    function addNewReappStep() {
        // Submit the form for adding a new Re-application Step
        document.getElementById('add-reapp-step-form').submit();
    }

    function deleteReappStep(stepID) {
        if (confirm("Are you sure you want to delete this Re-application Step?")) {
            window.location.href = 'deleteReappSteps.php?stepID=' + stepID;
        }
    }

    document.getElementById('addcoursepop').addEventListener('click', function() {
        // Show the add course form and hide other sections
        document.getElementById('add-reapp-step-form').style.display = 'block';
        document.getElementById('edit-reapp-step-section').style.display = 'none';
        document.getElementById('courses-table').style.display = 'none';
    });
    document.getElementById('announcements-link').parentElement.classList.add('active');

// ... your existing JavaScript code ...

function editApplicationDate(dateID, startDate, endDate) {
    // Set values in the edit form
    document.getElementById('edit-date-ID').value = dateID;
    document.getElementById('edit-start-date').value = startDate;
    document.getElementById('edit-end-date').value = endDate;

    // Show the edit form and hide other sections
    document.getElementById('edit-date-section').style.display = 'block';
  

}

function saveEditedApplicationDate() {
    // Submit the form for saving the edited application date
    document.getElementById('edit-date-form').submit();
}

function editReleasingDate(releaseDate) {
    // Set values in the edit form
    document.getElementById('edit-release-date').value = releaseDate;

    // Show the edit form and hide other sections
    document.getElementById('edit-releasing-date-section').style.display = 'block';
}

function saveEditedReleasingDate() {
    // Submit the form for saving the edited releasing date
    document.getElementById('edit-releasing-date-form').submit();
}


</script>

    </div>
    <div class="todo">
					<div class="head">
						<h3>Set Admission</h3>
						<i class='bx bx-plus' ></i>
						<i class='bx bx-filter' ></i>
					</div>
  <?php
                $applicationDates = getApplicationDates($conn);

                foreach ($applicationDates as $index => $date) {
                    echo "<tr>";
                    echo "<td>" . date('F j, Y', strtotime($date['StartDate'])) . "</td>";
                    echo "<td> to </td>";
                    echo "<td>" . date('F j, Y', strtotime($date['EndDate'])) . "</td>";
                     echo "<td>";
                     
                    echo "<button class='button edit' onclick='editApplicationDate(" . $date['ApplicationDateID'] . ", \"" . $date['StartDate'] . "\", \"" . $date['EndDate'] . "\")'>Edit</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            ?>    
            
<div id="edit-date-section" style="display: none;">
    <h2>Edit Application Date</h2>
    <form id="edit-date-form" action="editApplicationDate.php" method="post">
        <input type="hidden" id="edit-date-ID" name="dateID">
        <label for="edit-start-date">Start Date:</label>
        <input type="date" id="edit-start-date" name="startDate" required>
        <label for="edit-end-date">End Date:</label>
        <input type="date" id="edit-end-date" name="endDate" required>
        <button type="button" class="button save" onclick="saveEditedApplicationDate()">Save Date</button>
    </form>
</div>

<?php
            $releasingDates = getReleasingOfResults($conn);

            foreach ($releasingDates as $index => $date) {
                echo "<tr>";
                echo "<td>" . ($index + 1) . "</td>";
                echo "<td>" . $date['ReleaseDate'] . "</td>";
                echo "<td>";
                echo "<button class='button edit' onclick='editReleasingDate(\"" . $date['ReleaseDate'] . "\")'>Edit</button>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
            <!-- Edit Releasing of Results Date Form -->
<div id="edit-releasing-date-section" style="display: none;">
    <h2>Edit Releasing of Results Date</h2>
    <form id="edit-releasing-date-form" action="editReleasingDate.php" method="post">
        <label for="edit-release-date">Release Date:</label>
        <input type="date" id="edit-release-date" name="releaseDate" required>
        <button type="button" class="button save" onclick="saveEditedReleasingDate()">Save Release Date</button>
    </form>
</div>

</div>

        </div>
				</div>


</div>

</main>
</section>
  

</body>
</html>
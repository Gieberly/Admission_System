<?php
include("config.php");
include("Reapplication.php");

session_start();

// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'staff') {
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
    <section id="sidebar">
        <a class="brand">
            <img class="bsulogo" src="assets/images/BSU Logo1.png" alt="BSU LOGO">
            <span class="text">Personnel</span>
        </a>

        <ul class="side-menu top">
            <li class="active">
                <a href="personnel.php" id="dashboard-link">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>

            <li class="">
                <a href="PersonnelMasterList.php" id="master-list-link">
                    <i class='bx bxs-user-pin'></i>
                    <span class="text">Master List</span>
                </a>
            </li>

            <li class="">
                <a href="PersonnelStudentresult.php" id="student-result-link">
                    <i class='bx bxs-window-alt'></i>
                    <span class="text">Student Result</span>
                </a>
            </li>

            <li class="">
                <a href="faq.php" id="announcements-link">
                    <i class='bx bxs-book-content'></i>
                    <span class="text">Announcements</span>
                </a>
            </li>
        </ul>
    </section>
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <a>Categories</a>
            <form id="search-form">
                <div class="form-input" style="display: none;">
                    <input type="text" id="searchInput" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <div id="clock">8:10:45</div>
           
            <a href="#" class="profile" id="profile-button">
                <img src="assets/images/human icon.png" alt="User Profile">
            </a>

        </nav>
        <!-- NAVBAR -->

 
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->

        <main>

    <div id="announcements-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Annoucement</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Announcement</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="staff.html">Home</a></li>
                        </ul>
                    </div>
                </div>
                <div class="table-data">
                        <div class="order">
                            <div class="head">
                <!--form-->
                <div class="tabs">
                    <button class="tab-button" data-tab="tab3"  onclick="window.location.href='faq.php'">FAQ</button>
                    <button class="tab-button" data-tab="tab5" onclick="window.location.href='PersonnelEditSlot.php'">Slot</button>
                    <button class="tab-button" data-tab="tab4"  onclick="window.location.href='Reapplication.php'">Readmission Date</button>
                    <button class="tab-button" data-tab="tab6"  onclick="window.location.href='ReleasingDate.php'">Releasing of Result</button>
                    <button class="button save" id="addcoursepop" >Add Steps</button>

                </div>

                <div class="tab-content" id="tab4">
              
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

    </div></div></div>
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


</script>

    </div>

</body>


    </section>

 
    <!-- Add the profile popup container here -->
    <div class="profile-popup" id="profile-popup">
        <!-- Popup content -->
        <div class="popup-content" id="profile-content">
            <div class="profile-header">
                <img src="assets/images/human icon.png" alt="User Profile Picture" class="profile-picture" id="profile-picture">
                <p class="profile-name" id="applicant-name"><?php echo $name; ?></p>
            </div>
           

            <hr>
            <div class="profile-menu">
                <a href="#" id="settings" class="profile-item"> <i class='bx bx-sun'></i>Display</a>

                <div class="dropdown" id="settings-dropdown">
                    <a href="#">Dark Mode
                        <input type="checkbox" id="switch-mode" hidden>
                        <label for="switch-mode" class="switch-mode"></label></a>



                </div>
                <a href="EditInfo.php" id="settings" class="profile-item" ><i class='bx bx-cog'></i> Settings</a>              
    
                <a href="#" id="help" class="profile-item"><i class='bx bx-question-mark'></i> Help and Support</a>
<div class="dropdown" id="help-dropdown">
                   <!-- Content for Help and Support dropdown -->
                  <!-- Trigger for the FAQ pop-up -->
<a href="faq_page.html" onclick="openPopup('faq-popup')">FAQ</a>
<a href="#" onclick="toggleDevonContent()">Connect With us</a>
<div id="devon-content"class style="display: none;">
<div class="social-icons-container">
    <!-- Facebook -->
    <a href="https://www.facebook.com/BenguetStateUniversity/" target="_blank" title="Facebook"><i class='bx bxl-facebook'></i></a>

    <!-- Email -->
    <a href="mailto:web.admin@bsu.edu.ph?subject=General%20Inquiry" target="_blank" title="Email"><i class='bx bx-envelope'></i></a>

    <!-- Twitter -->
    <a href="https://twitter.com/benguetstateu" target="_blank" title="Twitter"><i class='bx bxl-twitter'></i></a>

    <!-- Instagram -->
    <a href="https://www.instagram.com/benguetstateuniversityofficial/" target="_blank" title="Instagram"><i class='bx bxl-instagram'></i></a>

    <!-- YouTube -->
    <a href="https://www.youtube.com/channel/UCGPVCY6CmxRi68_3SE6MzCg" target="_blank" title="YouTube"><i class='bx bxl-youtube'></i></a>
</div>

            </div>
           </div>
            <a href="#" id="logout" class="profile-item" onclick="confirmLogout()"><i class='bx bx-log-out'></i> Logout</a>

        </div>

</div>


<script src="assets/js/EditSlot.js"></script>
  

</body>
</html>
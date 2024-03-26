<?php
include("config.php");
include("Personnel_Cover.php");

// Check if the user is a staff member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Staff') {
  header("Location: loginpage.php");
  exit();
}


// Retrieve admission data from the database with date filter
$search = isset($_GET['search']) ? $_GET['search'] : '';
$filterDate = isset($_GET['appointment_date']) ? $_GET['appointment_date'] : '';

$query = "SELECT * FROM admission_data WHERE 

            (
              `Name` LIKE '%$search%' OR 
             `Middle_Name` LIKE '%$search%' OR 
             `Last_Name` LIKE '%$search%' OR 
             `academic_classification` LIKE '%$search%' OR 
             `email` LIKE '%$search%' OR 
             `nature_of_degree` LIKE '%$search%' OR 
             `degree_applied` LIKE '%$search%' OR
             `Name` LIKE '%$search%' OR 
             `Middle_Name` LIKE '%$search%' OR 
             `Last_Name` LIKE '%$search%'
            )
            AND (DATE(appointment_date) = '$filterDate' OR '$filterDate' = '')
            AND `appointment_date` IS NOT NULL
            AND `appointment_status` = 'Complete'
            ORDER BY applicant_number ASC";


$result = $conn->query($query);

// Fetch user information from the database based on user ID
$userID = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, email, userType, status FROM users WHERE id = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($name, $email, $userType, $status);
$stmt->fetch();

// Close statement
$stmt->close();
?>





<head>
  <meta charset="UTF-8">

  <title>BSU OUR Admission Unit Personnel</title>

</head>

<body>

  <style>
    #sendButton {
      background-color: transparent;
      border: none;
      cursor: pointer;
      padding: 0;
    }

    #sendButton i {
      font-size: 14px;
      color: black;
    }

    #sendButton:hover i {
      color: green;
      transform: scale(1.2);
    }



    #toast {
      position: fixed;
      top: 10%;
      right: 10%;
      width: 300px;
      background-color: #4CAF50;
      color: #fff;
      border-radius: 5px;
      padding: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      opacity: 0;
      transition: opacity 0.5s ease-in-out;
    }

    #toast.show {
      opacity: 1;
    }

    @keyframes slideInUp {
      from {
        transform: translateY(100%);
      }

      to {
        transform: translateY(0);
      }
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.4);

    }

    /* Modal Content/Box */
    .modal-content {
      background-color: #fefefe;
      margin: 15% auto;
      /* 15% from the top and centered */
      padding: 20px;
      border: 1px solid #888;
      width: 30%;
      /* Could be more or less, depending on screen size */
      border-radius: 10px;
    }

    /* Close Button */

    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }

    /* Buttons */
    /* Buttons */
    #confirmSend,
    .yes,
    .cancel {
      padding: 10px 15px;
      margin: 5px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
      text-align: center;
      display: inline-block;
    }

    #confirmSend,
    .yes {
      background-color: #4CAF50;
      /* Green color for "Confirm" button */
      color: white;
    }

    .cancel {
      background-color: #ff5757;
      /* Red color for "Cancel" button */
      color: white;
      float: right;
      /* Float the "Cancel" button to the right */
    }

    #confirmSend:hover,
    .cancel:hover {
      opacity: 0.8;
    }

    .confirmation-message {
      background-color: #f44336;
      color: white;
      padding: 15px;
      border-radius: 5px;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 1000;
    }

    #deleteConfirmationModal,
    #errorModal,
    #selectRowModal,
    #sendSuccessModal {
      display: none;
    }

    .field-group {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }

    .field-group>* {
      flex-basis: calc(25% - 10px);
      margin-bottom: 10px;
    }

    .success-message {
      position: fixed;
      top: 15%;
      right: 10%;
      background-color: #4CAF50;
      color: white;
      padding: 10px;
      border-radius: 4px;
      z-index: 9;
      animation: slideInUp 0.3s ease-in-out;
      display: none;
    }

    @keyframes slideInUp {
      from {
        transform: translateY(100%);
      }

      to {
        transform: translateY(0);
      }
    }

    #calendarFilterForm button {
      background: none;
      border: none;
      cursor: pointer;
      padding: 0;
      font-size: 0;
      color: #000;
    }

    #calendarFilterForm button i {
      font-size: 18px;
    }

    #calendarFilterForm input[type="date"] {
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-right: 10px;
    }

    #toast {
      position: fixed;
      top: 10%;
      right: 10%;
      width: 300px;
      background-color: #4CAF50;
      color: #fff;
      border-radius: 5px;
      padding: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      opacity: 0;
      transition: opacity 0.5s ease-in-out;
    }

    #toast.show {
      opacity: 1;
    }

    @keyframes slideInUp {
      from {
        transform: translateY(100%);
      }

      to {
        transform: translateY(0);
      }
    }

    .close-form {
      transition: background-color 0.3s, transform 0.3s;
      border-radius: 50%;
    }

    .close-form:hover {
      background-color: rgba(255, 0, 0, 0.2);
    }

    .form-container1 {
      display: grid;
      grid-template-columns: 50% 23% 23%;
      gap: 2%;
    }

    .form-container2 {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 2%;
    }

    .form-container7 {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 2%;
    }

    .form-container7 .form-group {
      display: grid;
      grid-template-columns: 1fr;
      align-items: start;
      /* Align items to the start of the grid cell */
    }

    .form-container7 .form-group .small-label {
      margin-bottom: 10px;
      white-space: normal;
      text-align: left;
      word-wrap: break-word;
    }

    .form-container7 .form-group input {
      width: 100%;
      /* Take up full width of the grid cell */
    }



    .form-container8 {
      display: grid;
      grid-template-columns: 20% 10% 20% 10% 20% 10%;

      gap: 2%;
    }

    .form-container8 .form-group {
      display: flex;
      flex-direction: column;
      text-align: left;
    }

    .form-container9 {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      /* evenly distribute columns */
      gap: 2%;
    }

    .form-container9 .form-group {
      display: flex;
      flex-direction: column;

    }

    .form-container9 .form-group .small-label {
      margin-bottom: 10px;
      max-height: 3em;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: normal;
      text-align: left;
    }

    .form-container8 .form-group .small-label {
      margin-bottom: 10px;
      max-height: 3em;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: normal;
      text-align: left;
    }

    .form-container3 {
      display: grid;
      grid-template-columns: 18% 18% 18% 18% 18%;
      gap: 2%;
    }

    .form-container4 {
      display: grid;
      grid-template-columns: 100%;
      gap: 10px;
    }

    .form-container5 {
      display: grid;
      grid-template-columns: 40% 40% 15%;
      gap: 10px;
    }

    .form-container6 {
      display: grid;
      grid-template-columns: 50% 15%;
      gap: 10px;
    }

    .form-group {
      margin-bottom: 15px;
      display: flex;
      flex-direction: column;
    }

    .small-label {
      display: block;
      font-size: .9vw;
      margin-bottom: 5px;
    }

    .input {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      font-size: .8vw;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 2% 4%;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 1vw;
    }

    input[type="submit"]:hover {
      background-color: darkcyan;
    }

    .personal_information {
      font-size: 1vw;
      font-weight: bold;
      margin-bottom: 10px;
    }

    #updateProfileForm {
      max-width: 800px;
      margin: 0 auto;
    }

    .success-message {
      background-color: #4CAF50;
      color: white;
      padding: 10px;
      border-radius: 4px;
      margin-bottom: 10px;
    }

    @media screen and (max-width: 881px) {
      .form-group {
        width: 100%;
      }
    }

    #update_success {
      position: fixed;
      top: 75px;
      /* Adjust the distance from the top */
      right: 20px;
      /* Adjust the distance from the right */
      padding: 10px 20px;
      background-color: green;
      color: white;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
      z-index: 9999;
      opacity: 0;
      animation: slideUp 0.5s ease forwards, fadeOut 0.5s 2.5s forwards;
    }

    @keyframes slideUp {
      0% {
        opacity: 0;
        transform: translateY(100%);
      }

      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .auto-expand {
      min-height: 50px;
      /* Set a minimum height for the textarea */
    }
    #toggleSubjects {
    background-color: green;
    border-radius: 5px;
    padding: 10px 20px;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
    width: auto; /* Set width to auto */
    float: right; /* Float it to the right */
  }

  #toggleSubjects:hover {
    background-color: darkgreen;
  }

  .other_subject {
    display: none;
  }
  </style>
  <section id="content">
    <?php

    // Check if the success message session variable is set
    if (isset($_SESSION['update_success']) && $_SESSION['update_success']) {
      // Display success message with animation
      echo '<div class="success-message" id="successMessage">Data successfully updated!</div>';

      // Unset the session variable to avoid displaying the message again on page refresh
      unset($_SESSION['update_success']);
    }
    ?>


    <main>
      <div class="head-title">
        <div class="left">
          <h1>Applicants</h1>
          <ul class="breadcrumb">
            <li><a href="#">Applicants</a></li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li>
            <li><a class="active" href="Personnel_dashboard.php">Home</a></li>
            </li>
          </ul>
        </div>
        <div class="button-container">

          <a href="excel_export_appointments.php" class="btn-download">
            <i class='bx bxs-file-export'></i>
            <span class="text">Excel Export</span>
          </a>
        </div>
      </div>

      <div class="table-data">
        <div class="order">
          <div class="head">
            <h3>List of Students</h3>
            <!-- Add this input field for date filtering -->
            <div class="headfornaturetosort">
              <form method="GET" action="" id="calendarFilterForm">
                <label for="appointment_date"></label>
                <input type="date" name="appointment_date" id="appointment_date">
                <button type="submit"><i class='bx bx-filter'></i></button>
              </form>
              <button type="button" id="toggleSelection">
                <i class='bx bx-select-multiple'></i> Toggle Selection
              </button>
              <button style="display: none;" type="button" id="deleteSelected">
                <i class='bx bx-trash'></i> Delete Selected
              </button>
              <button type="button" id="sendButton" style="display: none;">
                <i class='bx bx-send'></i>
              </button>
            </div>
          </div>


          <table id="studentTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Application No.</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>

                <th>Nature of Degree</th>
                <th>Program</th>

                <th>Academic Classification</th>
                <th style="display: none;" id="selectColumn">
                  <input type="checkbox" id="selectAllCheckbox">
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
              $counter = 1; // Initialize the counter before the loop

              while ($row = $result->fetch_assoc()) {
                echo "<tr class='editRow' data-id='" . $row['id'] . "' data-date='" . $row['application_date'] . "'>";
                echo "<td>" . $counter . "</td>";
                echo "<td>" . $row['applicant_number'] . "</td>";
                echo "<td>" . $row['Last_Name'] . "</td>";
                echo "<td>" . $row['Name'] . "</td>";
                echo "<td>" . $row['Middle_Name'] . "</td>";

                echo "<td>" . $row['nature_of_degree'] . "</td>";
                echo "<td>" . $row['degree_applied'] . "</td>";
                echo "<td>" . $row['academic_classification'] . "</td>";
                echo "<td  id='checkbox-{$row['id']}'><input type='checkbox'style='display: none;' class='select-checkbox'></td>";
                echo "</tr>";
                $counter++; // Increment the counter for the next row
              }
              ?>

            </tbody>
          </table>
          <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
              <strong class="mr-auto">Success!</strong>

            </div>
            <div class="toast-body" id="toast-body"></div>
          </div>
          <div id="confirmationModal" class="modal">
            <div class="modal-content">
              <span class="close"></span>
              <p>Are you sure you want to send these applicants to the faculty?</p>
              <button id="confirmSend">Confirm</button>
              <button class="cancel">Cancel</button>
            </div>
          </div>



          <div id="deleteSelectedConfirmationModal" class="modal">
            <div class="modal-content">
              <span class="close"></span>
              <p>Are you sure you want to delete the selected rows?</p>
              <button id="confirmDeleteSelected" class="yes">Confirm</button>
              <button class="cancel" onclick="closeDeleteSelectedConfirmationModal()">Cancel</button>
            </div>
          </div>
          <div id="errorModal" class="modal">
            <div class="modal-content">
              <span class="close"></span>
              <p id="errorMessage"></p>
              <button class="ok" onclick="closeErrorModal()">OK</button>
            </div>
          </div>
          <div id="sendErrorModal" class="modal">
            <div class="modal-content">
              <span class="close"></span>
              <p id="sendErrorMessage"></p>
              <button class="ok" onclick="closeSendErrorModal()">OK</button>
            </div>
          </div>

        </div>

        <div class="todo" style="display: none;">
          <i class="bx bx-x close-form" style="float: right;font-size: 24px;"></i>

          <input type="radio" id="tab1" name="tabGroup1" class="tab" checked>
          <label class="tab-label" for="tab1">Student Grades</label>
          <input type="radio" id="tab2" name="tabGroup1" class="tab">
          <label class="tab-label" for="tab2">Student Remarks</label>

          <div class="tab-content" id="content1">

            <form id="updateProfileForm" class="tab1-content" method="post" action="Personnel_SubmitForm.php">

              <input type="hidden" name="academic_classification" class="input" id="academic_classification" value="<?php echo $admissionData['academic_classification']; ?>" readonly>
              <!-- Senior High School Graduates -->
              <div class="SHS-Graduate-Average" style="display:none;">
                <h2>Senior High School Graduates</h2>

                <p class="personal_information"> Grade 11 Average</p>
                <div class="form-container2">

                  <div class="form-group">
                    <!-- Gr11_A1 -->
                    <label class="small-label" for="Gr11_A1">1st SEM</label>
                    <input name="Gr11_A1" class="input numeric-input" id="Gr11_A1" placeholder="Enter Grade" value="<?php echo $admissionData['Gr11_A1']; ?>">
                    <!-- Gr11_A2 -->
                  </div>
                  <div class="form-group">
                    <label class="small-label" for="Gr11_A2">2nd SEM</label>
                    <input name="Gr11_A2" class="input numeric-input" autocomplete="off" id="Gr11_A2" placeholder="Enter Grade" value="<?php echo $admissionData['Gr11_A2']; ?>">
                  </div>
                  <div class="form-group">
                    <!-- Gr11_A3 -->
                    <label class="small-label" for="Gr11_A3">3rd SEM</label>
                    <input name="Gr11_A3" class="input numeric-input" autocomplete="off" id="Gr11_A3" placeholder="Enter Grade" value="<?php echo $admissionData['Gr11_A3']; ?>">
                  </div>
                  <div class="form-group"> <!-- Gr11_GWA -->
                    <label class="small-label" for="Gr11_GWA">GWA</label>
                    <input name="Gr11_GWA" class="input numeric-input" autocomplete="off" id="Gr11_GWA" placeholder="Enter Grade" value="<?php echo $admissionData['Gr11_GWA']; ?>">
                  </div>

                </div>
              </div>
              <div class="Gr-12-Average" style="display: none;">
                <h2> Grade 12</h2>
                <p class="personal_information">Grade 12 Average</p>
                <div class="form-container2">
                  <div class="form-group">
                    <!-- Gr12_A1 -->
                    <label class="small-label" for="Gr12_A1">1st SEM</label>
                    <input name="Gr12_A1" class="input numeric-input" id="Gr12_A1" placeholder="Enter Grade" value="<?php echo $admissionData['Gr12_A1']; ?>">

                  </div>
                  <div class="form-group"> <!-- Gr12_A2 -->
                    <label class="small-label" for="Gr12_A2">2nd SEM</label>
                    <input name="Gr12_A2" class="input numeric-input" autocomplete="off" id="Gr12_A2" placeholder="Enter Grade" value="<?php echo $admissionData['Gr12_A2']; ?>">
                  </div>
                  <div class="form-group"> <!-- Gr12_A3 -->
                    <label class="small-label" for="Gr12_A3">3rd SEM</label>
                    <input name="Gr12_A3" class="input numeric-input" autocomplete="off" id="Gr12_A3" placeholder="Enter Grade" value="<?php echo $admissionData['Gr12_A3']; ?>">

                  </div>
                  <div class="form-group"> <!-- Gr12_GWA -->
                    <label class="small-label" for="Gr12_GWA">GWA</label>
                    <input name="Gr12_GWA" class="input numeric-input" autocomplete="off" id="Gr12_GWA" placeholder="Enter Grade" value="<?php echo $admissionData['Gr12_GWA']; ?>">
                  </div>
                </div>
              </div>
              <div class="Subjects" style="display: none;">
              <p id="toggleSubjects">Other Subjects</p>
<br>
              <div class="core_subject" >
                <p class="personal_information">Grade in English</p>
                  
                <div class="form-container7">
                  <div class="form-group">
                    <!-- English_Oral_Communication_Grade -->
                    <label class="small-label" for="English_Oral_Communication_Grade">Oral Communication in Context
                    </label>
                    <input name="English_Oral_Communication_Grade" class="input numeric-input" autocomplete="off" id="English_Oral_Communication_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['English_Oral_Communication_Grade']; ?>">
                  </div>
                  <div class="form-group"> <!-- English_Reading_Writing_Grade -->
                    <label class="small-label" for="English_Reading_Writing_Grade">Reading and Writing Skills</label>
                    <input name="English_Reading_Writing_Grade" class="input numeric-input" autocomplete="off" id="English_Reading_Writing_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['English_Reading_Writing_Grade']; ?>">
                  </div>
                  <div class="form-group"> <!-- English_Academic_Grade -->
                    <label class="small-label" for="English_Academic_Grade">Academic and Professional Purposes</label>
                    <input name="English_Academic_Grade" class="input numeric-input" autocomplete="off" id="English_Academic_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['English_Academic_Grade']; ?>">
                  </div>
                </div>
                </div>
                <div class="other_subject" style="display: none;">
                <p class="personal_information">OTHER ENGLISH COURSES (INDICATE COURSE AND GRADE ONLY IF THERE IS NO CORE ENGLISH COURSE)</p>

                <div class="form-container8">
                  <div class="form-group">
                    <!-- English_Subject_1 -->
                    <label class="small-label" for="English_Subject_1">Course</label>
                    <input name="English_Subject_1" class="input numeric-input" autocomplete="off" id="English_Subject_1" placeholder="Course" value="<?php echo $admissionData['English_Subject_1']; ?>">
                  </div>
                  <div class="form-group">
                    <!-- English_Other_Courses_Grade -->
                    <label class="small-label" for="English_Other_Courses_Grade">&nbsp;</label>
                    <input name="English_Other_Courses_Grade" class="input numeric-input" autocomplete="off" id="English_Other_Courses_Grade" placeholder="Grade" value="<?php echo $admissionData['English_Other_Courses_Grade']; ?>">
                  </div>
                  <div class="form-group">
                    <!-- English_Subject_2 -->
                    <label class="small-label" for="English_Subject_2">Course</label>
                    <input name="English_Subject_2" class="input numeric-input" autocomplete="off" id="English_Subject_2" placeholder="Course" value="<?php echo $admissionData['English_Subject_2']; ?>">
                  </div>
                  <div class="form-group">
                    <label class="small-label" for="English_Other_Courses_Grade_2">&nbsp; </label>
                    <input name="English_Other_Courses_Grade_2" class="input numeric-input" autocomplete="off" id="English_Other_Courses_Grade_2" placeholder="Grade" value="<?php echo $admissionData['English_Other_Courses_Grade_2']; ?>">
                  </div>
                  <div class="form-group">
                    <label class="small-label" for="English_Subject_3">Course</label>
                    <input name="English_Subject_3" class="input numeric-input" autocomplete="off" id="English_Subject_3" placeholder="Course" value="<?php echo $admissionData['English_Subject_3']; ?>">

                  </div>


                  <div class="form-group">
                    <label class="small-label" for="English_Other_Courses_Grade_3">&nbsp; </label>
                    <input name="English_Other_Courses_Grade_3" class="input numeric-input" autocomplete="off" id="English_Other_Courses_Grade_3" placeholder="Grade" value="<?php echo $admissionData['English_Other_Courses_Grade_3']; ?>">

                  </div>

                </div>
                </div>
                <div class="core_subject" >

                <p class="personal_information">Grade in Science</p>

                <div class="form-container9">
                  <div class="form-group">
                    <!-- Science_Earth_Science_Grade -->
                    <label class="small-label" for="Science_Earth_Science_Grade">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      Earth Science</label>
                    <input name="Science_Earth_Science_Grade" class="input numeric-input" autocomplete="off" id="Science_Earth_Science_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['Science_Earth_Science_Grade']; ?>">
                  </div>
                  <div class="form-group"> <!-- Science_Earth_and_Life_Science_Grade -->
                    <label class="small-label" for="Science_Earth_and_Life_Science_Grade">Earth and Life Science</label>
                    <input name="Science_Earth_and_Life_Science_Grade" class="input numeric-input" autocomplete="off" id="Science_Earth_and_Life_Science_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['Science_Earth_and_Life_Science_Grade']; ?>">
                  </div>
                  <div class="form-group"> <!-- Science_Physical_Science_Grade -->
                    <label class="small-label" for="Science_Physical_Science_Grade">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      Physical Science</label>
                    <input name="Science_Physical_Science_Grade" class="input numeric-input" autocomplete="off" id="Science_Physical_Science_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['Science_Physical_Science_Grade']; ?>">
                  </div>
                  <div class="form-group"> <!-- Science_Disaster_Readiness_Grade -->
                    <label class="small-label" for="Science_Disaster_Readiness_Grade">DRRR for STEM and GAS strands</label>
                    <input name="Science_Disaster_Readiness_Grade" class="input numeric-input" autocomplete="off" id="Science_Disaster_Readiness_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['Science_Disaster_Readiness_Grade']; ?>">
                  </div>
                </div>
                </div>

                <div class="other_subject" style="display: none;">
                <p class="personal_information">OTHER SCIENCE COURSES (INDICATE COURSE AND GRADE ONLY IF THERE IS NO CORE ENGLISH COURSE)</p>
                <div class="form-container8">
                  <div class="form-group">
                    <!-- Science_Other_Courses_Grade -->
                    <label class="small-label" for="Science_Other_Courses_Grade">Course</label>
                    <input name="Science_Other_Courses_Grade" class="input numeric-input" autocomplete="off" id="Science_Other_Courses_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['Science_Other_Courses_Grade']; ?>">
                  </div>
                  <div class="form-group">
                    <label class="small-label" for="Science_Other_Courses_Grade">&nbsp; </label>
                    <input name="Science_Other_Courses_Grade" class="input numeric-input" autocomplete="off" id="Science_Other_Courses_Grade" placeholder="Grade" value="<?php echo $admissionData['Science_Other_Courses_Grade']; ?>">
                  </div>
                  <div class="form-group">
                    <!-- Science_Other_Courses_Grade -->
                    <label class="small-label" for="Science_Other_Courses_Grade_2">Course</label>
                    <input name="Science_Other_Courses_Grade_2" class="input numeric-input" autocomplete="off" id="Science_Other_Courses_Grade_2" placeholder="Enter Grade" value="<?php echo $admissionData['Science_Other_Courses_Grade_2']; ?>">
                  </div>
                  <div class="form-group">
                    <label class="small-label" for="Science_Other_Courses_Grade_2">&nbsp; </label>
                    <input name="Science_Other_Courses_Grade_2" class="input numeric-input" autocomplete="off" id="Science_Other_Courses_Grade_2" placeholder="Grade" value="<?php echo $admissionData['Science_Other_Courses_Grade_2']; ?>">
                  </div>
                  <div class="form-group">
                    <!-- Science_Other_Courses_Grade -->
                    <label class="small-label" for="Science_Other_Courses_Grade_3">Course</label>
                    <input name="Science_Other_Courses_Grade_3" class="input numeric-input" autocomplete="off" id="Science_Other_Courses_Grade_3" placeholder="Enter Grade" value="<?php echo $admissionData['Science_Other_Courses_Grade_3']; ?>">
                  </div>
                  <div class="form-group">
                    <label class="small-label" for="Science_Other_Courses_Grade_3">&nbsp; </label>
                    <input name="Science_Other_Courses_Grade_3" class="input numeric-input" autocomplete="off" id="Science_Other_Courses_Grade_3" placeholder="Grade" value="<?php echo $admissionData['Science_Other_Courses_Grade_3']; ?>">
                  </div>
                </div>
                </div>
                <div class="core_subject" >
                <p class="personal_information">Grade in Math</p>
                <div class="form-container2">
                  <div class="form-group">
                    <!-- Math_General_Mathematics_Grade -->
                    <label class="small-label" for="Math_General_Mathematics_Grade">General Mathematics</label>
                    <input name="Math_General_Mathematics_Grade" class="input numeric-input" autocomplete="off" id="Math_General_Mathematics_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['Math_General_Mathematics_Grade']; ?>">
                  </div>
                  <div class="form-group">
                    <!-- Math_Statistics_and_Probability_Grade -->
                    <label class="small-label" for="Math_Statistics_and_Probability_Grade">Statistics and Probability</label>
                    <input name="Math_Statistics_and_Probability_Grade" class="input numeric-input" autocomplete="off" id="Math_Statistics_and_Probability_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['Math_Statistics_and_Probability_Grade']; ?>">
                  </div>
                </div>
                </div>
                <div class="other_subject" style="display: none;">
                <p class="personal_information">OTHER SCIENCE COURSES (INDICATE COURSE AND GRADE ONLY IF THERE IS NO CORE ENGLISH COURSE)</p>

                <div class="form-container8">
                  <div class="form-group">
                    <!-- Math_Other_Courses_Grade -->
                    <label class="small-label" for="Math_Other_Courses_Grade">Course</label>
                    <input name="Math_Other_Courses_Grade" class="input numeric-input" autocomplete="off" id="Math_Other_Courses_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['Math_Other_Courses_Grade']; ?>">
                  </div>
                  <div class="form-group">
                    <label class="small-label" for="Math_Other_Courses_Grade">&nbsp; </label>
                    <input name="Math_Other_Courses_Grade" class="input numeric-input" autocomplete="off" id="Math_Other_Courses_Grade" placeholder="Grade" value="<?php echo $admissionData['Math_Other_Courses_Grade']; ?>">
                  </div>
                  <div class="form-group">
                    <!-- Math_Other_Courses_Grade -->
                    <label class="small-label" for="Math_Other_Courses_Grade_2">Course</label>
                    <input name="Math_Other_Courses_Grade_2" class="input numeric-input" autocomplete="off" id="Math_Other_Courses_Grade_2" placeholder="Enter Grade" value="<?php echo $admissionData['Math_Other_Courses_Grade_2']; ?>">
                  </div>
                  <div class="form-group">
                    <label class="small-label" for="Math_Other_Courses_Grade_2">&nbsp; </label>
                    <input name="Math_Other_Courses_Grade_2" class="input numeric-input" autocomplete="off" id="Math_Other_Courses_Grade_2" placeholder="Grade" value="<?php echo $admissionData['Math_Other_Courses_Grade_2']; ?>">
                  </div>
                  <div class="form-group">
                    <!-- Math_Other_Courses_Grade -->
                    <label class="small-label" for="Math_Other_Courses_Grade_3">Course</label>
                    <input name="Math_Other_Courses_Grade_3" class="input numeric-input" autocomplete="off" id="Math_Other_Courses_Grade_3" placeholder="Enter Grade" value="<?php echo $admissionData['Math_Other_Courses_Grade_3']; ?>">
                  </div>
                  <div class="form-group">
                    <label class="small-label" for="Math_Other_Courses_Grade_3">&nbsp; </label>
                    <input name="Math_Other_Courses_Grade_3" class="input numeric-input" autocomplete="off" id="Math_Other_Courses_Grade_3" placeholder="Grade" value="<?php echo $admissionData['Math_Other_Courses_Grade_3']; ?>">
                  </div>
                </div>
                </div>
              </div>
              <div class="Transferee" style="display: none;">
                <h2> Transferee</h2>
              </div>


              <div class="ALS" style="display: none;">
                <h2> ALS/PEPT Completers </h2>
                <div class="form-container2">
                  <div class="form-group">
                    <!-- ALS_Math -->
                    <label class="small-label" for="ALS_Math">Math</label>
                    <input name="ALS_Math" class="input numeric-input" autocomplete="off" id="ALS_Math" placeholder="Enter Grade" value="<?php echo $admissionData['ALS_Math']; ?>">
                  </div>

                  <div class="form-group">
                    <!-- ALS_Math -->
                    <label class="small-label" for="ALS_English">English</label>
                    <input name="ALS_English" class="input numeric-input" autocomplete="off" id="ALS_English" placeholder="Enter Grade" value="<?php echo $admissionData['ALS_English']; ?>">
                  </div>
                </div>
              </div>

              <div class="HS-Graduate" style="display: none;">
                <h2> School (Old Curriculum) Graduates </h2>

                <div class="form-container2">
                  <div class="form-group">
                    <!-- Old_HS_English_Grade -->
                    <label class="small-label" for="Old_HS_English_Grade">English</label>
                    <input name="Old_HS_English_Grade" class="input numeric-input" autocomplete="off" id="Old_HS_English_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['Old_HS_English_Grade']; ?>">
                  </div>
                  <div class="form-group">
                    <!-- Old_HS_Math_Grade -->
                    <label class="small-label" for="Old_HS_Math_Grade">Math</label>
                    <input name="Old_HS_Math_Grade" class="input numeric-input" autocomplete="off" id="Old_HS_Math_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['Old_HS_Math_Grade']; ?>">
                  </div>
                  <div class="form-group">
                    <!-- Old_HS_Science_Grade -->
                    <label class="small-label" for="Old_HS_Science_Grade">Science</label>
                    <input name="Old_HS_Science_Grade" class="input numeric-input" autocomplete="off" id="Old_HS_Science_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['Old_HS_Science_Grade']; ?>">
                  </div>

                </div>
              </div>

              <div class="2nd-degree" style="display: none;">
                <h2> Second Degree</h2>

              </div>
              <div class="GWA-OTAS" style="display: none;">
                <div class="form-container2">
                  <div class="form-group"> <!-- GWA_OTAS -->
                    <label class="small-label" for="GWA_OTAS">Average</label>
                    <input name="GWA_OTAS" class="input numeric-input" autocomplete="off" id="GWA_OTAS" placeholder="Enter Grade" value="<?php echo $admissionData['GWA_OTAS']; ?>">
                  </div>
                </div>
              </div>



              <input type="hidden" name="id" value="<?php echo $admissionData['id']; ?>">
              <input type="submit" name="submit">
            </form>

          </div>

          <div class="tab-content" id="content2">
            <form id="updateProfileForm" class="tab1-content" method="post" action="Personnel_SubmitForm2.php">

              <div class="form-container5">

                <div class="form-group">
                  <!-- College -->
                  <label class="small-label" for="college">College</label>
                  <input name="college" class="input" id="college" value="<?php echo $admissionData['college']; ?>" readonly>
                </div>
                <div class="form-group">
                  <!-- Degree -->
                  <label class="small-label" for="degree_applied">Degree</label>
                  <input name="degree_applied" class="input" id="degree_applied" value="<?php echo $admissionData['degree_applied']; ?>" readonly>
                </div>

                <div class="form-group">
                  <!-- Nature -->
                  <label class="small-label" for="nature_of_degree" style="white-space: nowrap;">Nature</label>
                  <input name="nature_of_degree" class="input" id="nature_of_degree" value="<?php echo $admissionData['nature_of_degree']; ?>" readonly>
                </div>
              </div>
              <div class="form-container6">
                <div class="form-group">
                  <label class="small-label" for="nature_qualification" style="white-space: nowrap;">Qualification</label>
                  <select name="nature_qualification" class="input" id="nature_qualification">
                    <option value="" disabled selected>Select qualification</option>
                    <option value="Non-Board/Board">Non-Board/Board</option>
                    <option value="Non-Board">Non-Board</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="small-label" for="Degree_Remarks" style="white-space: nowrap;">Degree meets admission policy</label>
                  <select name="Degree_Remarks" class="input" id="Degree_Remarks">
                    <option value="" disabled selected>Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>


              </div>
              <label class="small-label" for="Requirements_Remarks" style="white-space: nowrap;">Remarks</label>
              <textarea name="Requirements_Remarks" placeholder="Enter remarks..." class="input auto-expand" id="Requirements_Remarks"><?php echo $admissionData['Requirements_Remarks']; ?></textarea>

              <br>
              <input type="hidden" name="id" value="<?php echo $admissionData['id']; ?>">
              <input type="submit" name="submit">
            </form>

          </div>


        </div>
      </div>



      </div>
      </div>
    </main>
    <!-- MAIN -->
  </section>

  <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">


    </div>
    <div class="toast-body" id="toast-body"></div>
  </div>


  <script>
    $(document).ready(function() {

      $('.editRow').click(function() {
        // Check if the click was on the buttons
        if (!$(event.target).is('button') && !$(event.target).is('i') && !$(event.target).is(':checkbox')) {
          // Get the 'data-userid' attribute from the clicked row
          var userId = $(this).data('id');

          // Send an AJAX request to fetch the user data based on the user ID
          $.ajax({
            url: 'Personnel_fetchStudentdata.php', // replace with the actual URL for fetching user data
            type: 'POST',
            data: {
              userId: userId
            },
            dataType: 'json',
            success: function(response) {

              $('#applicantPicture').attr('src', response.id_picture);
              $('#updateProfileForm input[name="Gr11_A1"]').val(response.Gr11_A1);
              $('#updateProfileForm input[name="academic_classification"]').val(response.academic_classification);
              $('#updateProfileForm input[name="college"]').val(response.college);
              $('#updateProfileForm input[name="id"]').val(response.id);
              $('#updateProfileForm input[name="high_school_name_address"]').val(response.high_school_name_address);
              $('#updateProfileForm input[name="lrn"]').val(response.lrn);
              $('#updateProfileForm input[name="degree_applied"]').val(response.degree_applied);
              $('#updateProfileForm input[name="nature_of_degree"]').val(response.nature_of_degree);
              $('#updateProfileForm input[name="Gr11_A1"]').val(response.Gr11_A1);
              $('#updateProfileForm input[name="Gr11_A2"]').val(response.Gr11_A2);
              $('#updateProfileForm input[name="Gr11_A3"]').val(response.Gr11_A3);
              $('#updateProfileForm input[name="Gr11_GWA"]').val(response.Gr11_GWA);
              $('#updateProfileForm input[name="GWA_OTAS"]').val(response.GWA_OTAS);
              $('#updateProfileForm select[name="nature_qualification"]').val(response.nature_qualification);
              $('#updateProfileForm select[name="Degree_Remarks"]').val(response.Degree_Remarks);
              $('#updateProfileForm input[name="English_Subject_1"]').val(response.English_Subject_1);
              $('#updateProfileForm input[name="English_Subject_2"]').val(response.English_Subject_2);
              $('#updateProfileForm input[name="English_Subject_3"]').val(response.English_Subject_3);
              $('#updateProfileForm input[name="Science_Subject_1"]').val(response.Science_Subject_1);
              $('#updateProfileForm input[name="Science_Subject_2"]').val(response.Science_Subject_2);
              $('#updateProfileForm input[name="Science_Subject_3"]').val(response.Science_Subject_3);
              $('#updateProfileForm input[name="Math_Subject_1"]').val(response.Math_Subject_1);
              $('#updateProfileForm input[name="Math_Subject_2"]').val(response.Math_Subject_2);
              $('#updateProfileForm input[name="Math_Subject_3"]').val(response.Math_Subject_3);
              $('#updateProfileForm input[name="Gr12_A1"]').val(response.Gr12_A1);
              $('#updateProfileForm input[name="Gr12_A2"]').val(response.Gr12_A2);
              $('#updateProfileForm input[name="Gr12_A3"]').val(response.Gr12_A3);
              $('#updateProfileForm input[name="Gr12_GWA"]').val(response.Gr12_GWA);
              $('#updateProfileForm input[name="English_Oral_Communication_Grade"]').val(response.English_Oral_Communication_Grade);
              $('#updateProfileForm input[name="English_Reading_Writing_Grade"]').val(response.English_Reading_Writing_Grade);
              $('#updateProfileForm input[name="English_Academic_Grade"]').val(response.English_Academic_Grade);
              $('#updateProfileForm input[name="English_Other_Courses_Grade"]').val(response.English_Other_Courses_Grade);
              $('#updateProfileForm input[name="English_Other_Courses_Grade_2"]').val(response.English_Other_Courses_Grade_2);
              $('#updateProfileForm input[name="English_Other_Courses_Grade_3"]').val(response.English_Other_Courses_Grade_3);
              $('#updateProfileForm input[name="Science_Earth_Science_Grade"]').val(response.Science_Earth_Science_Grade);
              $('#updateProfileForm input[name="academic_classification"]').val(response.academic_classification);
              $('#updateProfileForm input[name="Science_Earth_and_Life_Science_Grade"]').val(response.Science_Earth_and_Life_Science_Grade);
              $('#updateProfileForm input[name="Science_Physical_Science_Grade"]').val(response.Science_Physical_Science_Grade);
              $('#updateProfileForm input[name="Science_Disaster_Readiness_Grade"]').val(response.Science_Disaster_Readiness_Grade);
              $('#updateProfileForm input[name="Science_Other_Courses_Grade"]').val(response.Science_Other_Courses_Grade);
              $('#updateProfileForm input[name="Science_Other_Courses_Grade_2"]').val(response.Science_Other_Courses_Grade_2);
              $('#updateProfileForm input[name="Science_Other_Courses_Grade_3"]').val(response.Science_Other_Courses_Grade_3);
              $('#updateProfileForm input[name="Math_General_Mathematics_Grade"]').val(response.Math_General_Mathematics_Grade);
              $('#updateProfileForm input[name="Math_Statistics_and_Probability_Grade"]').val(response.Math_Statistics_and_Probability_Grade);
              $('#updateProfileForm input[name="Math_Other_Courses_Grade"]').val(response.Math_Other_Courses_Grade);
              $('#updateProfileForm input[name="Math_Other_Courses_Grade_2"]').val(response.Math_Other_Courses_Grade_2);
              $('#updateProfileForm input[name="Math_Other_Courses_Grade_3"]').val(response.Math_Other_Courses_Grade_3);
              $('#updateProfileForm input[name="Old_HS_English_Grade"]').val(response.Old_HS_English_Grade);
              $('#updateProfileForm input[name="Old_HS_Math_Grade"]').val(response.Old_HS_Math_Grade);
              $('#updateProfileForm input[name="Old_HS_Science_Grade"]').val(response.Old_HS_Science_Grade);
              $('#updateProfileForm input[name="ALS_Math"]').val(response.ALS_Math);
              $('#updateProfileForm input[name="ALS_English"]').val(response.ALS_English);

              $('#updateProfileForm input[name="Requirements"]').val(response.Requirements);
              $('#updateProfileForm input[name="OSS_Endorsement_Slip"]').val(response.OSS_Endorsement_Slip);
              $('#updateProfileForm input[name="OSS_Admission_Test_Score"]').val(response.OSS_Admission_Test_Score);
              $('#updateProfileForm input[name="OSS_Remarks"]').val(response.OSS_Remarks);
              $('#updateProfileForm input[name="Qualification_Nature_Degree"]').val(response.Qualification_Nature_Degree);
              $('#updateProfileForm textarea[name="Requirements_Remarks"]').val(response.Requirements_Remarks);

              $('#updateProfileForm input[name="Interview_Result"]').val(response.Interview_Result);
              $('#updateProfileForm input[name="Endorsed"]').val(response.Endorsed);
              $('#updateProfileForm input[name="Confirmed_Slot"]').val(response.Confirmed_Slot);
              $('#updateProfileForm input[name="Final_Remarks"]').val(response.Final_Remarks);
              $('#updateProfileForm input[name="degree_applied"]').val(response.degree_applied);
              $('#updateProfileForm input[name="nature_of_degree"]').val(response.nature_of_degree);

              $('#updateProfileForm input[name="college"]').val(response.college);

              var academicClassification = response.academic_classification;
              $('.todo').show(); // Show the form container

              // Show the relevant div based on academic classification
              $('.SHS-Graduate-Average,.Gr-12-Average, .ALS, .Subjects, .GWA-OTAS, .Transferee, .Gr-12, .HS-Graduate, .2nd-degree').hide(); // Hide all divs first
              if (academicClassification === 'Senior High School Graduates') {
                $('.SHS-Graduate-Average, .Subjects ').show();
              } else if (academicClassification === 'Grade 12') {
                $('.Gr-12-Average, .Subjects').show();
              } else if (academicClassification === 'Transferees') {
                $('.Transferee, .GWA-OTAS').show();
              } else if (academicClassification === 'ALS/PEPT Completers') {
                $('.ALS, .GWA-OTAS').show();
              } else if (academicClassification === 'High School (Old Curriculum) Graduates') {
                $('.HS-Graduate, .GWA-OTAS').show();
              } else if (academicClassification === 'Second Degree') {
                $('.2nd-degree, .GWA-OTAS').show();
              }

              // Add similar logic for other form fields

            },
            error: function(error) {
              console.error('Error fetching user data: ', error);
            }
          });
        }
      });

      // Click event handler for the close button
      $('.close-form').click(function() {
        // Hide the form
        $('.todo').hide();
      });
    });
    var toggleState = false; // Initial state

document.getElementById('toggleSubjects').addEventListener('click', function() {
  var coreSubjects = document.querySelectorAll('.core_subject');
  var otherSubjects = document.querySelectorAll('.other_subject');

  if (toggleState) { // If currently showing other subjects, switch to showing core subjects
    coreSubjects.forEach(function(subject) {
      subject.style.display = 'block';
    });

    otherSubjects.forEach(function(subject) {
      subject.style.display = 'none';
    });

    this.textContent = "Other Subjects"; // Update text
    toggleState = false; // Update toggle state
  } else { // If currently showing core subjects, switch to showing other subjects
    coreSubjects.forEach(function(subject) {
      subject.style.display = 'none';
    });

    otherSubjects.forEach(function(subject) {
      subject.style.display = 'block';
    });

    this.textContent = "Show Core Subjects"; // Update text
    toggleState = true; // Update toggle state
  }
});
    function showToast(message, type) {
      // Display a toast message
      $('#toast-body').text(message);
      $('#toast').removeClass().addClass('toast').addClass(type).addClass('show');

      // Hide the toast after a few seconds
      setTimeout(function() {
        $('#toast').removeClass('show');
      }, 3000);
    }
    document.addEventListener('DOMContentLoaded', function() {
      var successMessage = document.getElementById('successMessage');

      if (successMessage) {
        successMessage.style.display = 'block';

        setTimeout(function() {
          successMessage.style.display = 'none';
        }, 3000);
      }
    });
    document.addEventListener("DOMContentLoaded", function() {
      // Add click event listener to each row
      var rows = document.querySelectorAll('.editRow');
      rows.forEach(function(row) {
        row.addEventListener('click', function() {
          // Remove 'selected' class from all rows
          rows.forEach(function(r) {
            r.classList.remove('selected');
          });

          // Add 'selected' class to the clicked row
          this.classList.add('selected');
        });
      });
    });

    function toggleSendButtonVisibility() {
      var sendButton = document.getElementById('sendButton');
      sendButton.style.display = (sendButton.style.display === 'none' || sendButton.style.display === '') ? 'block' : 'none';
    }

    // Add an event listener to the "Toggle Selection" button
    document.getElementById('toggleSelection').addEventListener('click', toggleSendButtonVisibility);

    function deleteAdmissionData(id) {
      // Display the delete confirmation modal
      var modal = document.getElementById('deleteConfirmationModal');
      modal.style.display = 'block';

      // Add a click event listener to the "Confirm" button in the modal
      document.getElementById('confirmDelete').addEventListener('click', function() {
        // Send an AJAX request to delete the course
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "deleteStudentPersonnel.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              // Remove the deleted row from the table
              var row = document.querySelector(`tr[data-id='${id}']`);
              row.remove();

              // Show a toast notification for success
              showSuccessToast();
            } else {
              // Handle errors from the server if needed
              alert('Error deleting the course. Please try again.');
            }

            // Close the delete confirmation modal after processing
            closeDeleteConfirmationModal();
          }
        };

        // Encode the data to be sent in the request
        var data = "id=" + encodeURIComponent(id);
        xhr.send(data);
      });
    }

    // Function to close the delete confirmation modal
    function closeDeleteConfirmationModal() {
      var modal = document.getElementById('deleteConfirmationModal');
      modal.style.display = 'none';
    }
    // Add an event listener to the "Delete Selected" button
    document.getElementById('deleteSelected').addEventListener('click', function() {
      // Display the delete confirmation modal for selected rows
      var modal = document.getElementById('deleteSelectedConfirmationModal');
      modal.style.display = 'block';

      // Add a click event listener to the "Confirm" button in the modal
      document.getElementById('confirmDeleteSelected').addEventListener('click', function() {
        // Call the function to delete the selected admission data
        deleteSelectedAdmissionData();

        // Close the delete confirmation modal after processing
        closeDeleteSelectedConfirmationModal();
      });
    });

    // Function to close the delete confirmation modal for selected rows
    function closeDeleteSelectedConfirmationModal() {
      var modal = document.getElementById('deleteSelectedConfirmationModal');
      modal.style.display = 'none';
    }

    function showErrorModal(message) {
      var errorModal = document.getElementById('errorModal');
      var errorMessage = document.getElementById('errorMessage');
      errorMessage.textContent = message;
      errorModal.style.display = 'block';
    }

    // Function to close the error modal
    function closeErrorModal() {
      var errorModal = document.getElementById('errorModal');
      errorModal.style.display = 'none';
    }
    // Function to delete selected rows
    function deleteSelectedAdmissionData() {
      // Get all checkboxes
      var checkboxes = document.querySelectorAll('.select-checkbox:checked');

      // Check if at least one checkbox is selected
      if (checkboxes.length > 0) {
        // Create an array to store the selected row IDs
        var selectedRowIds = [];

        // Iterate over selected checkboxes and store the corresponding row IDs
        checkboxes.forEach(function(checkbox) {
          var row = checkbox.closest('tr');
          var rowId = row.getAttribute('data-id');
          selectedRowIds.push(rowId);
        });

        // Send an AJAX request to delete the selected rows
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "deleteSelectedStudents.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              // Remove the selected rows from the table
              selectedRowIds.forEach(function(rowId) {
                var row = document.querySelector(`tr[data-id='${rowId}']`);
                row.remove();
              });

              // Show a success toast
              showSuccessToast();
            } else {
              // Show an error modal with a custom message
              showErrorModal('Error deleting selected rows. Please try again.');
            }
          }
        };

        // Encode the data to be sent in the request
        var data = "selectedRowIds=" + encodeURIComponent(JSON.stringify(selectedRowIds));
        xhr.send(data);
      } else {
        // If no checkboxes are selected, show an error modal
        showErrorModal('Please select at least one student to delete.');
      }
    }
    // Function to toggle the visibility of the Select column and checkboxes
    function toggleSelectionVisibility() {
      // Toggle the visibility of the Select column in the table header
      var selectColumn = document.getElementById('selectColumn');
      selectColumn.style.display = (selectColumn.style.display === 'none' || selectColumn.style.display === '') ? 'table-cell' : 'none';

      // Toggle the visibility of the checkboxes in each row
      var checkboxes = document.querySelectorAll('.select-checkbox');
      checkboxes.forEach(function(checkbox) {
        checkbox.style.display = (checkbox.style.display === 'none' || checkbox.style.display === '') ? 'table-cell' : 'none';
      });

      // Toggle the visibility of the "Delete Selected" button
      var deleteSelectedButton = document.getElementById('deleteSelected');
      deleteSelectedButton.style.display = (deleteSelectedButton.style.display === 'none' || deleteSelectedButton.style.display === '') ? 'block' : 'none';
    }

    // Add an event listener to the "Toggle Selection" button
    document.getElementById('toggleSelection').addEventListener('click', toggleSelectionVisibility);
    // Function to check/uncheck all checkboxes
    function checkAllCheckboxes(checked) {
      var checkboxes = document.querySelectorAll('.select-checkbox');
      checkboxes.forEach(function(checkbox) {
        checkbox.checked = checked;
      });
    }

    // Add an event listener to the "selectAllCheckbox" checkbox
    document.getElementById('selectAllCheckbox').addEventListener('change', function() {
      checkAllCheckboxes(this.checked);
    });

    // Add an event listener to the "Send" button
    document.getElementById('sendButton').addEventListener('click', function() {
      // Show the confirmation modal
      var modal = document.getElementById('confirmationModal');
      modal.style.display = 'block';
    });

    // Get the confirmation modal
    var modal = document.getElementById('confirmationModal');

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName('close')[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = 'none';
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = 'none';
      }
    };

    // Add an event listener to the "Confirm" button in the confirmation modal
    document.getElementById('confirmSend').addEventListener('click', function() {
      modal.style.display = 'none'; // Close the modal
      sendSelectedStudents(); // Proceed with sending the applicants
    });

    // Add an event listener to the "Cancel" button in the confirmation modal
    document.getElementsByClassName('cancel')[0].addEventListener('click', function() {
      modal.style.display = 'none'; // Close the modal
    });
    // Function to show a send success modal
    function showSendSuccessModal() {
      var sendSuccessModal = document.getElementById('sendSuccessModal');
      sendSuccessModal.style.display = 'block';
    }

    // Function to close the send success modal
    function closeSendSuccessModal() {
      var sendSuccessModal = document.getElementById('sendSuccessModal');
      sendSuccessModal.style.display = 'none';
    }

    // Function to show a send error modal with a custom message
    function showSendErrorModal(message) {
      var sendErrorModal = document.getElementById('sendErrorModal');
      var sendErrorMessage = document.getElementById('sendErrorMessage');
      sendErrorMessage.textContent = message;
      sendErrorModal.style.display = 'block';
    }

    // Function to close the send error modal
    function closeSendErrorModal() {
      var sendErrorModal = document.getElementById('sendErrorModal');
      sendErrorModal.style.display = 'none';
    }


    function sendSelectedStudents() {
      // Get all checkboxes
      var checkboxes = document.querySelectorAll('.select-checkbox:checked');

      // Check if at least one checkbox is selected
      if (checkboxes.length > 0) {
        // Create an array to store the selected row IDs
        var selectedRowIds = [];

        // Iterate over selected checkboxes and store the corresponding row IDs
        checkboxes.forEach(function(checkbox) {
          var row = checkbox.closest('tr');
          var rowId = row.getAttribute('data-id');
          selectedRowIds.push(rowId);
        });

        // Send an AJAX request to update the 'sent' field in the database
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "send_selected_applicants.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              // Show a success modal
              showSendSuccessModal();

              // Optionally, you can update the UI or perform other actions here
            } else {
              // Show a send error modal with a custom message
              showSendErrorModal('Error updating sent status. Please try again.');
            }
          }
        };

        // Encode the data to be sent in the request
        var data = "selectedRowIds=" + encodeURIComponent(JSON.stringify(selectedRowIds));
        xhr.send(data);
      } else {
        // If no checkboxes are selected, show a send error modal
        showSendErrorModal('Please select at least one student to send.');
      }
    }
  </script>



  </div>

  </div>
  </div>
  </div>
  </div>



  </main>
  <!-- MAIN -->


  </section>
</body>

</html>
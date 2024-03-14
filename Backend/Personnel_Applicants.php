<?php
include("config.php");
include("Personnel_Cover.php");

// Check if the user is a staff member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Staff') {
  header("Location: loginpage.php");
  exit();
}

// Fetch data from the academicclassification table for the Classification column
$sqlClassification = "SELECT DISTINCT Classification FROM academicclassification";
$resultClassification = $conn->query($sqlClassification);

// Retrieve admission data from the database with date filter
$search = isset($_GET['search']) ? $_GET['search'] : '';
$filterDate = isset($_GET['appointment_date']) ? $_GET['appointment_date'] : '';

$query = "SELECT * FROM admission_data WHERE 
            (`applicant_name` LIKE '%$search%' OR 
             `applicant_number` LIKE '%$search%' OR 
             `academic_classification` LIKE '%$search%' OR 
             `email` LIKE '%$search%' OR 
             `result` LIKE '%$search%' OR 
             `nature_of_degree` LIKE '%$search%' OR 
             `degree_applied` LIKE '%$search%')
            AND (DATE(appointment_date) = '$filterDate' OR '$filterDate' = '')
            AND `appointment_date` IS NOT NULL
            AND `appointment_status` = 'Complete'
          ORDER BY nature_of_degree ASC, degree_applied ASC, applicant_name ASC";

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
          <a href="Personnels_AppointmentDate.php" class="btn-appointment">
            <i class='bx bxs-calendar calendar-icon'></i>
            <span class="text">Set Dates</span>
          </a>
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
            </div>
          </div>


          <table id="studentTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Application No.</th>
                <th>Nature of Degree</th>
                <th>Program</th>
                <th>Name</th>
                <th>Academic Classification</th>

              </tr>
            </thead>
            <tbody>
              <?php
              $counter = 1; // Initialize the counter before the loop

              while ($row = $result->fetch_assoc()) {
                echo "<tr class='editRow' data-id='" . $row['id'] . "' data-date='" . $row['application_date'] . "'>";
                echo "<td>" . $counter . "</td>";
                echo "<td>" . $row['applicant_number'] . "</td>";
                echo "<td>" . $row['nature_of_degree'] . "</td>";
                echo "<td>" . $row['degree_applied'] . "</td>";
                echo "<td>" . $row['applicant_name'] . "</td>";
                echo "<td>" . $row['academic_classification'] . "</td>";



                echo "<td style='display: none;'><input type='checkbox' name='select[]' value='" . $row["id"] . "'></td>";
                echo "</tr>";

                $counter++; // Increment the counter for the next row
              }
              ?>

            </tbody>
          </table>

        </div>

        <div class="todo" style="display: none;">

          <input type="radio" id="tab1" name="tabGroup1" class="tab" checked>
          <label class="tab-label" for="tab1">Student Data</label>

          <input type="radio" id="tab2" name="tabGroup1" class="tab">
          <label class="tab-label" for="tab2">Student Requirements</label>

          <div class="tab-content" id="content1">

            <form id="updateProfileForm" class="tab1-content" method="post" action="Personnel_DataUpdate.php">
              <div class="form-container2">
               
                <div class="form-group">
                  <!-- Gr11_A1 -->
                  <label class="small-label" for="Gr11_A1">Gr.11 Average 1st SEM</label>
                  <input name="Gr11_A1" class="input" id="Gr11_A1" placeholder="Enter Grade" value="<?php echo $admissionData['Gr11_A1']; ?>">
                  <!-- Gr11_A2 -->
                </div>
                <div class="form-group">

                  <label class="small-label" for="Gr11_A2">Gr. 11 Average 2nd SEM</label>
                  <input name="Gr11_A2" class="input" autocomplete="off" id="Gr11_A2" placeholder="Enter Grade" value="<?php echo $admissionData['Gr11_A2']; ?>" readonly>
                </div>
                <div class="form-group">
                  <!-- Gr11_A3 -->
                  <label class="small-label" for="Gr11_A3">Gr. 11 Average 3rd SEM</label>
                  <input name="Gr11_A3" class="input" autocomplete="off" id="Gr11_A3" placeholder="Enter Grade" value="<?php echo $admissionData['Gr11_A3']; ?>" readonly>
                </div>
                <div class="form-group"> <!-- Gr11_GWA -->
                  <label class="small-label" for="Gr11_GWA">Gr. 11 GWA</label>
                  <input name="Gr11_GWA" class="input" autocomplete="off" id="Gr11_GWA" placeholder="Enter Grade" value="<?php echo $admissionData['Gr11_GWA']; ?>" readonly>
                </div>
               
              </div>
              <div class="form-container2">
              <div class="form-group"> <!-- GWA_OTAS -->
                  <label class="small-label" for="GWA_OTAS">Average</label>
                  <input name="GWA_OTAS" class="input" autocomplete="off" id="GWA_OTAS" placeholder="Enter Grade" value="<?php echo $admissionData['GWA_OTAS']; ?>" readonly>
                </div>
              </div>
                <div class="form-container2">
                <!-- Repeat the same structure for the next set of fields -->
                <div class="form-group">
                  <!-- Gr12_A1 -->
                  <label class="small-label" for="Gr12_A1">Gr. 12 Average 1st SEM</label>
                  <input name="Gr12_A1" class="input" id="Gr12_A1" placeholder="Enter Grade" value="<?php echo $admissionData['Gr12_A1']; ?>">

                </div>
                <div class="form-group"> <!-- Gr12_A2 -->
                  <label class="small-label" for="Gr12_A2">Gr. 12 Average2nd SEM</label>
                  <input name="Gr12_A2" class="input" autocomplete="off" id="Gr12_A2" placeholder="Enter Grade" value="<?php echo $admissionData['Gr12_A2']; ?>" readonly>

                </div>
                <div class="form-group"> <!-- Gr12_A3 -->
                  <label class="small-label" for="Gr12_A3">Gr. 12 Average 3rd SEM</label>
                  <input name="Gr12_A3" class="input" autocomplete="off" id="Gr12_A3" placeholder="Enter Grade" value="<?php echo $admissionData['Gr12_A3']; ?>" readonly>

                </div>
                <div class="form-group"> <!-- Gr12_GWA -->
                  <label class="small-label" for="Gr12_GWA">Gr. 12 GWA</label>
                  <input name="Gr12_GWA" class="input" autocomplete="off" id="Gr12_GWA" placeholder="Enter Grade" value="<?php echo $admissionData['Gr12_GWA']; ?>" readonly>
                </div>
                </div>
                <div class="form-container2">
                <!-- Repeat the same structure for the next set of fields -->
                <div class="form-group">
                  <!-- English_Oral_Communication_Grade -->
                  <label class="small-label" for="English_Oral_Communication_Grade">English Oral Communication Grade</label>
                  <input name="English_Oral_Communication_Grade" class="input" autocomplete="off" id="English_Oral_Communication_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['English_Oral_Communication_Grade']; ?>" readonly>
                </div>
                <div class="form-group"> <!-- English_Reading_Writing_Grade -->
                  <label class="small-label" for="English_Reading_Writing_Grade">English Reading Writing Grade</label>
                  <input name="English_Reading_Writing_Grade" class="input" autocomplete="off" id="English_Reading_Writing_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['English_Reading_Writing_Grade']; ?>" readonly>
                </div>
                <div class="form-group"> <!-- English_Academic_Grade -->
                  <label class="small-label" for="English_Academic_Grade">English Academic Grade</label>
                  <input name="English_Academic_Grade" class="input" autocomplete="off" id="English_Academic_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['English_Academic_Grade']; ?>" readonly>
                </div>
                <div class="form-group"> <!-- English_Other_Courses_Grade -->
                  <label class="small-label" for="English_Other_Courses_Grade">English Other Courses Grade</label>
                  <input name="English_Other_Courses_Grade" class="input" autocomplete="off" id="English_Other_Courses_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['English_Other_Courses_Grade']; ?>" readonly>
                </div>
                </div>
                <div class="form-container2">
                <!-- Repeat the same structure for the next set of fields -->
                <div class="form-group">

                  <!-- Science_Earth_Science_Grade -->
                  <label class="small-label" for="Science_Earth_Science_Grade">Science Earth Science Grade</label>
                  <input name="Science_Earth_Science_Grade" class="input" autocomplete="off" id="Science_Earth_Science_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['Science_Earth_Science_Grade']; ?>" readonly>
                </div>
                <div class="form-group"> <!-- Science_Earth_and_Life_Science_Grade -->
                  <label class="small-label" for="Science_Earth_and_Life_Science_Grade">Science Earth and Life Science Grade</label>
                  <input name="Science_Earth_and_Life_Science_Grade" class="input" autocomplete="off" id="Science_Earth_and_Life_Science_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['Science_Earth_and_Life_Science_Grade']; ?>" readonly>
                </div>
                <div class="form-group"> <!-- Science_Physical_Science_Grade -->
                  <label class="small-label" for="Science_Physical_Science_Grade">Science Physical Science Grade</label>
                  <input name="Science_Physical_Science_Grade" class="input" autocomplete="off" id="Science_Physical_Science_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['Science_Physical_Science_Grade']; ?>" readonly>
                </div>
                <div class="form-group"> <!-- Science_Disaster_Readiness_Grade -->
                  <label class="small-label" for="Science_Disaster_Readiness_Grade">Science Disaster Readiness Grade</label>
                  <input name="Science_Disaster_Readiness_Grade" class="input" autocomplete="off" id="Science_Disaster_Readiness_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['Science_Disaster_Readiness_Grade']; ?>" readonly>
                </div>

                <!-- Repeat the same structure for the next set of fields -->
                <div class="form-group">
                  <!-- Science_Other_Courses_Grade -->
                  <label class="small-label" for="Science_Other_Courses_Grade">Science Other Courses Grade</label>
                  <input name="Science_Other_Courses_Grade" class="input" autocomplete="off" id="Science_Other_Courses_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['Science_Other_Courses_Grade']; ?>" readonly>
                </div>
                </div>
                <div class="form-container2">
                <div class="form-group">
                  <!-- Math_General_Mathematics_Grade -->
                  <label class="small-label" for="Math_General_Mathematics_Grade">Math General Mathematics Grade</label>
                  <input name="Math_General_Mathematics_Grade" class="input" autocomplete="off" id="Math_General_Mathematics_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['Math_General_Mathematics_Grade']; ?>" readonly>
                </div>
                <div class="form-group">
                  <!-- Math_Statistics_and_Probability_Grade -->
                  <label class="small-label" for="Math_Statistics_and_Probability_Grade">Math Statistics and Probability Grade</label>
                  <input name="Math_Statistics_and_Probability_Grade" class="input" autocomplete="off" id="Math_Statistics_and_Probability_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['Math_Statistics_and_Probability_Grade']; ?>" readonly>
                </div>
                <div class="form-group">
                  <!-- Math_Other_Courses_Grade -->
                  <label class="small-label" for="Math_Other_Courses_Grade">Math Other Courses Grade</label>
                  <input name="Math_Other_Courses_Grade" class="input" autocomplete="off" id="Math_Other_Courses_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['Math_Other_Courses_Grade']; ?>" readonly>
                </div>
                </div>
                <div class="form-container2">
                <div class="form-group">
                  <!-- Old_HS_English_Grade -->
                  <label class="small-label" for="Old_HS_English_Grade">Old HS English Grade</label>
                  <input name="Old_HS_English_Grade" class="input" autocomplete="off" id="Old_HS_English_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['Old_HS_English_Grade']; ?>" readonly>
                </div>
                <div class="form-group">
                  <!-- Old_HS_Math_Grade -->
                  <label class="small-label" for="Old_HS_Math_Grade">Old HS Math Grade</label>
                  <input name="Old_HS_Math_Grade" class="input" autocomplete="off" id="Old_HS_Math_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['Old_HS_Math_Grade']; ?>" readonly>
                </div>
                <div class="form-group">
                  <!-- Old_HS_Science_Grade -->
                  <label class="small-label" for="Old_HS_Science_Grade">Old HS Science Grade</label>
                  <input name="Old_HS_Science_Grade" class="input" autocomplete="off" id="Old_HS_Science_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['Old_HS_Science_Grade']; ?>" readonly>
                </div>
                </div>
                <div class="form-container2">
                <div class="form-group">
                  <!-- ALS_Grade -->
                  <label class="small-label" for="ALS_Grade">ALS Grade</label>
                  <input name="ALS_Grade" class="input" autocomplete="off" id="ALS_Grade" placeholder="Enter Grade" value="<?php echo $admissionData['ALS_Grade']; ?>" readonly>
                </div>




                <div class="form-group">
                  <!-- Qualification_Nature_Degree -->
                  <label class="small-label" for="Qualification_Nature_Degree">Qualification Nature Degree</label>
                  <input name="Qualification_Nature_Degree" class="input" autocomplete="off" id="Qualification_Nature_Degree" value="<?php echo $admissionData['Qualification_Nature_Degree']; ?>" readonly>
                </div>




              </div>
              <br>
              <input type="hidden" name="id" value="<?php echo $admissionData['id']; ?>">
              <input type="submit" name="submit">
            </form>


          </div>

          <div class="tab-content" id="content2"></div>



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

  <style>
    .field-group {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }

    .field-group>* {
      flex-basis: calc(25% - 10px);
      /* Adjust the width as needed */
      margin-bottom: 10px;
      /* Adjust the vertical spacing as needed */
    }

    .success-message {
      position: fixed;
      top: 10%;
      right: 10%;
      background-color: #4CAF50;
      color: white;
      padding: 10px;
      border-radius: 4px;
      animation: slideInRight 0.5s ease-in-out;
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

    .button.ekis-btn {
      position: relative;
      background: none;
      border: none;
      padding: 0;
      cursor: pointer;
    }

    .button.ekis-btn i {
      font-size: 15px;
      pointer-events: auto;
      color: black;

    }

    .button.ekis-btn:hover i {
      color: red;
    }

    .button.ekis-btn::after {
      content: attr(data-tooltip);
      position: absolute;
      bottom: -100%;
      left: 50%;
      transform: translateX(-50%);
      background-color: #333;
      color: white;
      padding: 5px;
      border-radius: 3px;
      font-size: 12px;
      opacity: 0;
      transition: opacity 0.3s;
      z-index: 2;
      pointer-events: none;
    }



    .button.inc-btn {
      background: none;
      border: none;
      padding: 0;
      cursor: pointer;
      position: relative;
    }

    .button.inc-btn i {
      font-size: 15px;
      pointer-events: auto;
      color: black;

    }

    .button.inc-btn:hover i {
      color: orange;
    }

    .button.inc-btn::after {
      content: attr(data-tooltip);
      position: absolute;
      bottom: -100%;
      left: 50%;
      transform: translateX(-50%);
      background-color: #333;
      color: white;
      padding: 5px;
      border-radius: 3px;
      font-size: 12px;
      opacity: 0;
      transition: opacity 0.3s;
      z-index: 2;
      pointer-events: none;
    }


    .button.check-btn {
      background: none;
      border: none;
      padding: 0;
      cursor: pointer;
      position: relative;
    }

    .button.check-btn i {
      font-size: 15px;
      pointer-events: auto;
      color: black;
    }

    .button.check-btn:hover i {
      color: green;

    }

    .button.check-btn::after {
      content: attr(data-tooltip);
      position: absolute;
      bottom: -100%;
      left: 50%;
      transform: translateX(-50%);
      background-color: #333;
      color: white;
      padding: 5px;
      border-radius: 3px;
      font-size: 12px;
      opacity: 0;
      transition: opacity 0.3s;
      z-index: 2;
      pointer-events: none;
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
      /* Red with 80% opacity */
    }

    /* Apply styles to the form container */
    .form-container1 {
      display: grid;
      grid-template-columns: 50% 23% 23%;
      gap: 2%;
    }

    .form-container2 {
      display: grid;
      grid-template-columns: 20% 20% 20% 20%;
      gap: 2%;
    }

    .form-container3 {
      display: grid;
      grid-template-columns: 65% 33%;
      gap: 2%;
    }

    .form-container4 {
      display: grid;
      grid-template-columns: 100%;
      gap: 10px;
    }

    /* Apply styles to the form groups */
    .form-group {
      margin-bottom: 15px;
      display: flex;
      flex-direction: column;
    }

    /* Apply styles to the labels */
    .small-label {
      display: block;
      font-size: .9vw;
      margin-bottom: 5px;
    }

    /* Apply styles to the input fields */
    .input {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      font-size: .8vw;
    }

    /* Apply styles to the submit button */
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

    /* Style for the personal information headings */
    .personal_information {
      font-size: 1vw;
      font-weight: bold;
      margin-bottom: 10px;
    }

    /* Style for the form container */
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

    /* Responsive styles for smaller screens */
    @media screen and (max-width: 881px) {
      .form-group {
        width: 100%;
      }
    }

    /* Add this CSS to your existing styles */
    .confirmation-dialog {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 20px;
      background-color: #fff;
      border: 1px solid #ccc;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      z-index: 1000;
      border-radius: 5px;
    }

    .confirmation-dialog p {
      margin-bottom: 15px;
    }

    .confirmation-buttons {
      text-align: center;
      outline: none;
      margin: 0 10px;
    }



    .confirmation-buttons button[data-confirmed="true"] {
      background-color: green;
      color: white;
      transition: background-color 0.3s ease;
    }

    /* Hover effect for Confirm button */
    .confirmation-buttons button[data-confirmed="true"]:hover {
      background-color: #4caf50;
    }


    /* Styling for Cancel button */
    .confirmation-buttons button[data-confirmed="false"] {
      background-color: red;
      color: white;
      transition: background-color 0.3s ease;
    }

    /* Hover effect for Cancel button */
    .confirmation-buttons button[data-confirmed="false"]:hover {
      background-color: #e57373;
    }

    .confirmation-dialog-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 999;
    }

    #applicantPicture {
      width: 100%;
      /* Adjust width as a percentage of the container */
      max-width: 192px;
      min-width: 20px;
      height: auto;
      border-radius: 2%;
      float: right;
    }
  </style>

  <div class="confirmation-dialog-overlay"></div>
  <div class="confirmation-dialog">
    <p></p>
    <div class="confirmation-buttons">
      <button data-confirmed="true">Confirm</button>
      <button data-confirmed="false">Cancel</button>
    </div>
  </div>


  <script>
    $(document).ready(function() {


      $('.editRow').click(function() {
        // Check if the click was on the buttons
        if (!$(event.target).is('button') && !$(event.target).is('i')) {
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
              // Populate the form fields with the fetched data

              $('#applicantPicture').attr('src', response.id_picture);
              $('#updateProfileForm input[name="Gr11_A1"]').val(response.Gr11_A1);
              $('#updateProfileForm input[name="Gr11_A2"]').val(response.Gr11_A2);
              $('#updateProfileForm input[name="Gr11_A3"]').val(response.Gr11_A3);
              $('#updateProfileForm input[name="Gr11_GWA"]').val(response.Gr11_GWA);
              $('#updateProfileForm input[name="GWA_OTAS"]').val(response.GWA_OTAS);
              $('#updateProfileForm input[name="Gr12_A1"]').val(response.Gr12_A1);
              $('#updateProfileForm input[name="Gr12_A2"]').val(response.Gr12_A2);
              $('#updateProfileForm input[name="Gr12_A3"]').val(response.Gr12_A3);
              $('#updateProfileForm input[name="Gr12_GWA"]').val(response.Gr12_GWA);
              $('#updateProfileForm input[name="English_Oral_Communication_Grade"]').val(response.English_Oral_Communication_Grade);
              $('#updateProfileForm input[name="English_Reading_Writing_Grade"]').val(response.English_Reading_Writing_Grade);
              $('#updateProfileForm input[name="English_Academic_Grade"]').val(response.English_Academic_Grade);
              $('#updateProfileForm input[name="English_Other_Courses_Grade"]').val(response.English_Other_Courses_Grade);
              $('#updateProfileForm input[name="Science_Earth_Science_Grade"]').val(response.Science_Earth_Science_Grade);
              $('#updateProfileForm input[name="Science_Earth_and_Life_Science_Grade"]').val(response.Science_Earth_and_Life_Science_Grade);
              $('#updateProfileForm input[name="Science_Physical_Science_Grade"]').val(response.Science_Physical_Science_Grade);
              $('#updateProfileForm input[name="Science_Disaster_Readiness_Grade"]').val(response.Science_Disaster_Readiness_Grade);
              $('#updateProfileForm input[name="Science_Other_Courses_Grade"]').val(response.Science_Other_Courses_Grade);
              $('#updateProfileForm input[name="Math_General_Mathematics_Grade"]').val(response.Math_General_Mathematics_Grade);
              $('#updateProfileForm input[name="Math_Statistics_and_Probability_Grade"]').val(response.Math_Statistics_and_Probability_Grade);
              $('#updateProfileForm input[name="Math_Other_Courses_Grade"]').val(response.Math_Other_Courses_Grade);
              $('#updateProfileForm input[name="Old_HS_English_Grade"]').val(response.Old_HS_English_Grade);
              $('#updateProfileForm input[name="Old_HS_Math_Grade"]').val(response.Old_HS_Math_Grade);
              $('#updateProfileForm input[name="Old_HS_Science_Grade"]').val(response.Old_HS_Science_Grade);
              $('#updateProfileForm input[name="ALS_Grade"]').val(response.ALS_Grade);
              $('#updateProfileForm input[name="Requirements"]').val(response.Requirements);
              $('#updateProfileForm input[name="Requirements_Remarks"]').val(response.Requirements_Remarks);
              $('#updateProfileForm input[name="OSS_Endorsement_Slip"]').val(response.OSS_Endorsement_Slip);
              $('#updateProfileForm input[name="OSS_Admission_Test_Score"]').val(response.OSS_Admission_Test_Score);
              $('#updateProfileForm input[name="OSS_Remarks"]').val(response.OSS_Remarks);
              $('#updateProfileForm input[name="Qualification_Nature_Degree"]').val(response.Qualification_Nature_Degree);
              $('#updateProfileForm input[name="Interview_Result"]').val(response.Interview_Result);
              $('#updateProfileForm input[name="Endorsed"]').val(response.Endorsed);
              $('#updateProfileForm input[name="Confirmed_Slot"]').val(response.Confirmed_Slot);
              $('#updateProfileForm input[name="Final_Remarks"]').val(response.Final_Remarks);

              // Add similar lines for other form fields

              // Display the form for editing
              $('.todo').show();
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

    function updateContent(rowId) {
      // Make an Ajax request to fetch requirements based on the clicked row
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          // Update the content2 div with the fetched requirements
          document.getElementById("content2").innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "Personnel_fetchrequirements.php?rowId=" + rowId, true);
      xhttp.send();
    }

    // Attach click event listener to table rows
    var rows = document.getElementsByClassName("editRow");
    for (var i = 0; i < rows.length; i++) {
      rows[i].addEventListener("click", function() {
        var rowId = this.getAttribute("data-id");
        updateContent(rowId);
      });
    }


    function updateStatus(id, status) {
      // Show the confirmation dialog
      $('.confirmation-dialog').show();
      $('.confirmation-dialog-overlay').show();

      // Set the message in the dialog
      $('.confirmation-dialog p').text('Are you sure you want to set the status to ' + status + '?');

      // Handle button clicks in the confirmation dialog
      $('.confirmation-buttons button').click(function() {
        var userConfirmed = $(this).data('confirmed');
        if (userConfirmed) {
          // User confirmed, send the AJAX request to update the status
          $.ajax({
            type: 'POST',
            url: 'Personnel_UpdateStatus.php',
            data: {
              id: id,
              status: status
            },
            dataType: 'json', // Expect JSON response
            success: function(response) {
              if (response.success) {
                // Update the status in the table cell
                $('[data-id="' + id + '"] [data-field="appointment_status"]').text(status);
                showToast(response.message, 'success');
              } else {
                showToast(response.message, 'error');
              }
            },
            error: function(error) {
              console.error('Error updating status:', error);
            }
          });
        }

        // Hide the confirmation dialog and overlay
        $('.confirmation-dialog').hide();
        $('.confirmation-dialog-overlay').hide();
      });
    }

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
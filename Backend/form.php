<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); // Start the session

// Check if the registered_email session variable is set
if (!isset($_SESSION['registered_email'])) {
    // Redirect to register.php or handle the case where the user is not registered
    header("Location: register.php");
    exit();
}
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data
    $id_picture = $_FILES['id_picture'];
    $applicant_name = $_POST['applicant_name'];
    $gender = $_POST['gender'];
    $birthdate = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['birthdate'])));
    $birthplace = $_POST['birthplace'];
    $age = $_POST['age'];
    $civil_status = $_POST['civil_status'];
    $citizenship = $_POST['citizenship'];
    $nationality = $_POST['nationality'];
    $permanent_address = $_POST['permanent_address'];
    $zip_code = $_POST['zip_code'];
    $phone = $_POST['phone'];
    $facebook = $_POST['facebook'];
    $email = $_POST['email'];
    $contact_person_1 = $_POST['contact_person_1'];
    $contact_person_1_mobile = $_POST['contact_person_1_mobile'];
    $relationship_1 = $_POST['relationship_1'];
    $contact_person_2 = $_POST['contact_person_2'];
    $contact_person_2_mobile = $_POST['contact_person_2_mobile'];
    $relationship_2 = $_POST['relationship_2'];
    $academic_classification = $_POST['academic_classification'];
    $high_school_name_address = $_POST['high_school_name_address'];
    $als_pept_name_address = $_POST['als_pept_name_address'];
    $college_name_address = $_POST['college_name_address'];
    $lrn = $_POST['lrn'];
    $degree_applied = $_POST['degree_applied'];
    $nature_of_degree = $_POST['nature_of_degree'];
    $applicant_number = $_POST['applicant_number'];
    $application_date = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['application_date'])));
    $english_grade = $_POST['englishGrade'];
    $math_grade = $_POST['mathGrade'];
    $science_grade = $_POST['scienceGrade'];
    $gwa_grade = $_POST['gwaGrade'];
    $rank = isset($_POST['rank']) ? $_POST['rank'] : null;  // Check if 'rank' key exists
    $result = isset($_POST['result']) ? $_POST['result'] : null;  // Check if 'result' key exists
    
         // Check if the email entered in the admission form matches the one saved in the session
    $registered_email = $_SESSION['registered_email'];
    if ($email !== $registered_email) {
        echo "Error: Email mismatch. Please use the same email as in registration.";
        exit();
    }

// Check if a file was uploaded
if ($id_picture['error'] === UPLOAD_ERR_OK) {
    // Ensure the file is an image (optional)
    $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
    if (!in_array($id_picture['type'], $allowed_types)) {
        echo "Invalid file type. Please upload a valid image.";
        exit();
    }

    // Move the uploaded file to the 'uploads' folder
    $upload_folder = 'assets/uploads/';
    $file_name = uniqid() . '_' . basename($id_picture['name']);
    $target_path = $upload_folder . $file_name;

    if (move_uploaded_file($id_picture['tmp_name'], $target_path)) {
        echo "File uploaded successfully!";
    } else {
        echo "Error moving file to the server.";
        exit();
    }

// Save file path in the database
$id_picture_data = $target_path;
} else {
    echo "Error uploading ID picture. Please ensure it's a valid image file.";
    exit();
}



// Prepare SQL statement for inserting data into admission_data table
$stmt = $conn->prepare("INSERT INTO admission_data (id_picture, applicant_name, gender, birthdate, birthplace, age, civil_status, citizenship, nationality, permanent_address, zip_code, phone, facebook, email, contact_person_1, contact_person_1_mobile, relationship_1, contact_person_2, contact_person_2_mobile, relationship_2, academic_classification, high_school_name_address, als_pept_name_address, college_name_address, lrn, degree_applied, nature_of_degree, applicant_number, application_date, english_grade, math_grade, science_grade, gwa_grade, Rank, Result) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Bind parameters
$stmt->bind_param("sssssissssiisssississssssssssddddss", 
    $id_picture_data, $applicant_name, $gender, $birthdate, $birthplace, $age, $civil_status, $citizenship, $nationality, $permanent_address, $zip_code, $phone, $facebook, $email, $contact_person_1, $contact_person_1_mobile, $relationship_1, $contact_person_2, $contact_person_2_mobile, $relationship_2, $academic_classification, $high_school_name_address, $als_pept_name_address, $college_name_address, $lrn, $degree_applied, $nature_of_degree, $applicant_number, $application_date, $english_grade, $math_grade, $science_grade, $gwa_grade, $rank, $result);

  // Execute the statement
  if ($stmt->execute()) {
    // Set a session variable indicating that the admission form is filled out
    $_SESSION['admission_form_filled'] = true;

    // Redirect to student dashboard
    header("Location: ../Backend/student.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement
$stmt->close();
    // Unset the session variable to remove the stored email (optional)
    unset($_SESSION['registered_email']);
}


$conn->close();
?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admission Application</title>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link rel="icon" href="../frontend/assets/images/BSU Logo1.png" type="image/x-icon">
  <link rel="stylesheet" href="..\frontend\assets\css\admissionform.css">
  <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
  <script>
        // JavaScript function to check if the entered email matches the registered email
        function checkEmail() {
            var enteredEmail = document.getElementById('email').value;
            var registeredEmail = '<?php echo $_SESSION['registered_email']; ?>';

            if (enteredEmail !== registeredEmail) {
                alert('Error: Email mismatch. Please use the same email as in registration.');
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }
    </script>

</head>

<body>
  <header class="header">
    <div class="logo-brand-container">
      <div class="logo">
        <img src="../frontend/assets/images/BSU Logo1.png" alt="Logo">
      </div>
      <div class="brand">
        <p>Republic of the Philippines</p>
        <h1 style="font-family: algerian;">BENGUET STATE UNIVERSITY</h1>
        <p><i>OFFICE OF UNIVERSITY REGISTRAR</i></p>
        <p>La Trinidad, Benguet</p>
      </div>
    </div>
  </header>

  <form id="registrationForm" action="form.php" method="POST" onsubmit="return checkEmail()" enctype="multipart/form-data">


    <div class="progress-bar">
      <span class="step" id="step-1">1</span>
      <span class="step-connector"></span>
      <span class="step" id="step-2">2</span>
      <span class="step-connector"></span>
      <span class="step" id="step-3">3</span>
      <span class="step-connector"></span>
      <span class="step" id="step-4">4</span>
    </div>

    <div class="tab" id="tab-1">
      <div class="page-container">
        <h2>GENERAL GUIDELINES</h2>
        <p class="section-title"><strong><u>GENERAL INSTRUCTIONS</u></strong></p>
        <ol class="rac-list">
          <li>Read and understand the Admission Guidelines and requirements before proceeding to the next step.</li>
          <li>Fill out all the fields completely and accurately in this application form for admission.</li>
          <li>Submit the Application form with complete requirements.</li>
        </ol>
        <ul>
          <li>Submitted documents in compliance with the application for admission shall become the property of BSU and
            will not be returned to the applicant. As such, required photocopies of documents must be submitted and not
            original documents.</li>
          <li><i><u>Admission to the university is based on:</u></i></li>
        </ul>
        <ol class="rac-list">
          <li>General Weighted Average (GWA) requirement: 86% or better for degree programs with licensure examination
            ("board programs"), and 80% or better for degree programs not requiring a licensure examination ("non-board
            programs").</li>
          <li>Grade requirement of 86% or better for courses (subjects) English, Math, and Science for degree programs
            with licensure examination ("board programs").</li>
          <li>Result of an interview of qualified Applicants (Qualifiers) by the College or Campus offering the degree
            program chosen (Interview based on grades).</li>
          <li>Extracurricular activities may be considered in the qualification of the applicant.</li>
          <li>Quota requirement (limit on the maximum number of students/sections that may be admitted per degree
            program) of the various degrees of the different colleges and campuses where the ranking of an applicant
            among all other applicants is considered.</li>
        </ol>
        <ul>
          <li>Notice of the result of the application for admission shall be announced in your student dashboard</li>
          </ul>
          <div class="message">
     <span class="important-text">PLEASE ENTER THE CORRECT GRADE OR GWA.THIS IS NOT A BASIS FOR RANKING, BUT TO GUIDE YOU IN CHOOSING YOUR COURSE IF YOU MEET THE REQUIRED GWA.</span>
  
       
        <h2>Course guide for Application</h2>
        <div class="page-container">
          <div class="form-container">
            <div class="form-group">
              <label class="small-label" for="categoryDropdown">Select Program</label>
              <select class="input" id="categoryDropdown" name="categoryDropdown" onchange="updateSelection()">
                <option value="" disabled selected>Select nature of degree</option>
                <option value="Board">Board</option>
                <option value="Non-board">Non-Board</option>
              </select>
            </div>
          
            <!-- Input grades for Board selection -->
            <div id="boardFields" class="programFields">
              <label class="small-label" for="englishGrade">English Grade</label>
              <input type="number" class="input" name="englishGrade" id="englishGrade"
                placeholder="Enter English grade">

              <label class="small-label" for="mathGrade">Math Grade</label>
              <input type="number" class="input" name="mathGrade" id="mathGrade" placeholder="Enter Math grade">

              <label class="small-label" for="scienceGrade">Science Grade</label>
              <input type="number" class="input" name="scienceGrade" id="scienceGrade" placeholder="Enter Science grade">

              <button type="button" onclick="calculateGWA()">Submit</button>
              <p id="gwaResult"></p>
            </div>

            <!-- Input field for Non-Board selection -->
            <div id="nonBoardField" class="programFields">
              <label class="small-label" for="gwaGrade">GWA Grade</label>
              <input type="number" class="input" name="gwaGrade" id="gwaGrade" placeholder="Enter GWA grade">

              <button type="button" onclick="submitNonBoardForm()">Submit</button>
              <p id="nonBoardGwaResult"></p>
            </div>


            <div class="form-group">
              <div id="boardProgramsDropdown" class="programFields">
                <label for="board-programs">Board Programs</label>
                <select name="board-programs" id="board-programs" class="input" onchange="updateDegreeFields()">
                  <option value="">Board Programs</option>
                  <optgroup label="College of Teacher Education">
                    <option value="Bachelor of Early Childhood Education">Bachelor of Early Childhood Education</option>
                    <option value="Bachelor of Elementary Education">Bachelor of Elementary Education </option>
                    <option value="Bachelor of Secondary Education (BSEd) Major in English">Bachelor of Secondary
                      Education
                      (BSEd) Major in English</option>
                    <option value="Bachelor of Secondary Education (BSEd) Major in Filipino">Bachelor of Secondary
                      Education
                      (BSEd) Major in Filipino</option>
                    <option value="Bachelor of Secondary Education (BSEd) Major in Mathematics">Bachelor of Secondary
                      Education (BSEd) Major in Mathematics</option>
                    <option value="Bachelor of Secondary Education (BSEd) Major in Science">Bachelor of Secondary
                      Education
                      (BSEd) Major in Science</option>
                    <option value="Bachelor of Secondary Education (BSEd) Major in Social Studies">Bachelor of Secondary
                      Education (BSEd) Major in Social Studies</option>
                    <option value="Bachelor of Secondary Education (BSEd) Major in Values">Bachelor of Secondary
                      Education
                      (BSEd) Major in Values</option>
                    <option value="Bachelor of Technology and Livelihood Education Major in Agri-Fisheries">Bachelor of
                      Technology and Livelihood
                      Education Major in Agri-Fisheries</option>
                    <option value="Bachelor of Technology and Livelihood Education Major in Home Economics">Bachelor of
                      Technology and Livelihood
                      Education Major in Home Economics</option>
                    <option value="Doctor of Veterinary Medicine">Doctor of Veterinary Medicine</option>
                  </optgroup>
                  <optgroup label="College of Natural Sciences">
                    <option value="Bachelor of Science in Biology">Bachelor of Science in Biology</option>
                    <option value="Bachelor of Science in Environmental Science">Bachelor of Science in Environmental
                      Science</option>
                    <option value="Bachelor of Science in Chemistry">Bachelor of Science in Chemistry</option>
                  </optgroup>

                  <optgroup label="College of Numeracy and Applied Sciences">
                    <option value="Bachelor of Science in Mathematics">Bachelor of Science in Mathematics</option>
                    <option value="Bachelor of Science in Statistics">Bachelor of Science in Statistics</option>
                  </optgroup>

                  <optgroup label="College of Social Sciences">
                    <option value="Bachelor of Arts in History">Bachelor of Arts in History</option>
                    <option value="Bachelor of Arts in Psychology">Bachelor of Arts in Psychology</option>
                  </optgroup>



                  <optgroup label="College of Public Administration and Governance">
                    <option value="Bachelor in Public Administration">Bachelor in Public Administration</option>
                    <option value="Diploma in Public Administration">Diploma in Public Administration</option>
                    <option value="Certificate in Public Administration">Certificate in Public Administration</option>
                  </optgroup>



                  <optgroup label="College of Engineering">
                    <option value="Bachelor of Science in Agricultural and Biosystems Engineering">Bachelor of Science
                      in
                      Agricultural and Biosystems Engineering</option>
                    <option value="Bachelor of Science in Civil Engineering">Bachelor of Science in Civil Engineering
                    </option>
                    <option value="Bachelor of Science in Industrial Engineering">Bachelor of Science in Industrial
                      Engineering</option>
                    <option value="Bachelor of Science in Electrical Engineering">Bachelor of Science in Electrical
                      Engineering</option>
                  </optgroup>



                  <optgroup label="">
                    <option value="Bachelor of Science in Forestry (BSF)">Bachelor of Science in Forestry (BSF)</option>
                    <option value="Bachelor of Science in Nursing (BSN)">Bachelor of Science in Nursing (BSN)</option>
                    <option value="Doctor of Veterinary Medicine (DVM)">Doctor of Veterinary Medicine (DVM)</option>
                  </optgroup>
                </select>
              </div>



              <div id="nonBoardProgramsDropdown" class="programFields">
                <label for="NonBoardProgram">Non-Board Programs</label>
                <select name="NonBoardProgram" id="NonBoardProgram" class="input" onchange="updateDegreeFields()">

                  <option value="">Non-Board Programs</option>
                  <optgroup label="College of Agriculture">
                    <option value="Bachelor of Science in Agriculture (BSA)">Bachelor of Science in Agriculture (BSA)
                    </option>
                    <option value="Bachelor of Science in Agribusiness (BSAB)">Bachelor of Science in Agribusiness
                      (BSAB)
                    </option>
                  </optgroup>
                  <optgroup label="College of Arts and Humanities">
                    <option value="Bachelor of Arts in Communication">Bachelor of Arts in Communication</option>
                    <option value="Bachelor of Arts in English Language">Bachelor of Arts in English Language</option>
                    <option value="Bachelor of Arts in Filipino Language">Bachelor of Arts in Filipino Language</option>
                  </optgroup>

                  <optgroup label="College of Home Economics and Technology">
                    <option value="Bachelor of Science in Hospitality Management">Bachelor of Science in Hospitality
                      Management</option>
                    <option value="Bachelor of Science in Nutrition and Dietetics">Bachelor of Science in Nutrition and
                      Dietetics</option>
                    <option value="Bachelor of Science in Entrepreneurship specialized in Apparel & Fashion Enterprise">
                      Bachelor of Science in Entrepreneurship specialized in Apparel & Fashion Enterprise</option>
                    <option value="Bachelor of Science in Food Technology">Bachelor of Science in Food Technology
                    </option>
                    <option value="Bachelor of Science in Tourism Management">Bachelor of Science in Tourism Management
                    </option>
                    <option value="Bachelor of Science in Entrepreneurship specialized in Food Enterprise">Bachelor of
                      Science in Entrepreneurship specialized in Food Enterprise</option>
                  <optgroup label="College of Human Kinetics">
                    <option value="Bachelor of Science in Exercise and Sports Science">Bachelor of Science in Exercise
                      and
                      Sports Science</option>
                    <option value="Bachelor in Physical Education">Bachelor in Physical Education</option>
                  </optgroup>
                  <optgroup label="College of Information Sciences">
                    <option value="Bachelor of Library and Information Science (BLIS)">Bachelor of Library and
                      Information
                      Science (BLIS)</option>
                    <option value="Bachelor of Science in Information Technology (BSIT)">Bachelor of Science in
                      Information
                      Technology (BSIT)</option>
                    <option value="Bachelor of Science in Development Communication (BSCD) major in:">Bachelor of
                      Science in
                      Development Communication (BSCD) major in:</option>
                  </optgroup>

                </select>
              </div>
            </div>
          </div>
        </div>
        </div>
        <p class="coa"><strong><em>Classification of the applicant.</em></strong> An Applicant may only be classified
          in
          one category (except for second degree transferee):</p>
        <ol class="rac-list">
          <li><b>Senior High School Graduates</b> - those who did not enroll in any technical/vocational/college
            degree
            program in any other school after graduation.</li>
          <li><b>High School of the Old High school curriculum</b> - those who did not enroll in any college degree
            program in any other school after graduation from high school.</li>
          <li><b>Grade 12</b> as of application period (Currently enrolled as Grade 12).</li>
          <li><b>ALS/PEPT Completers</b> - those whose ALS/PEPT Certificate of Rating indicates that they are eligible
            for College Admission/Rating is equivalent to Senior High and similar terms.</li>
          <li><b>Transferees</b> - those who started college schooling in another school and intend to continue
            schooling in BSU.</li>
          <li><b>Second Degree</b> - those who have already graduated from a degree program in College. This may
            either
            be Second degree (BSU graduate of a Baccalaureate program) or Second Degree-transferees (Graduates of a
            Baccalaureate degree from another school who will enroll another degree in BSU).</li>
        </ol>

        <p><strong><u><i> Requirements per application classification:</i> </u></strong></p>
        <ol type="I" class="custom-list">
          <strong>
            <li>Senior High School Graduate who did not enroll in any college degree
              program/technical/vocational/degree
              program in any other school after graduation and will only enroll for the immediately following School
              Year:</li>
          </strong>
          <ol class="rac-list" type="a">
            <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
            <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
              family
              name/surname of the husband</li>
            <li>Hard copy One (1) 2x2 recent formal studio "type" photo (not necessarily taken in a studio) with
              nametag
            </li>
            <li>Certified true copy of Grade 12 Report Card. Photocopy /scanned copy will suffice if the applicant can
              present the original copy for comparison purposes.</li>
            <li>Certification of Enrollment from the last school attended (most recent).</li>
          </ol>

          <strong>
            <li>High School Graduate of the Old High School curriculum who did not enroll in any college degree
              program
              in any other school after graduation from high school and will only enroll this S.Y. 2021-2022:</li>
          </strong>
          <ol class="rac-list" type="a">
            <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
            <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
              family
              name/surname of the husband</li>
            <li>Hard copy One (1) 2x2 recent formal studio "type" photo (not necessarily taken in a studio) with
              nametag
            </li>
            <li>Certified true copy of High School Card/Form 138. Photocopy /scanned copy will suffice if the
              applicant
              can present the original copy for comparison purposes.</li>
            <li>Certification of Enrollment from the last school attended (most recent).</li>
          </ol>
          <strong>
            <li>Grade 12 as of application period (Currently enrolled as Grade 12):</li>
          </strong>
          <ol class="rac-list" type="a">
            <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
            <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
              family
              name/surname of the husband</li>
            <li>Hard copy One (1) 2x2 recent formal studio "type" photo (not necessarily taken in a studio) with
              nametag
            </li>
            <li>Certified photocopy of Grade 11 Card</li>
            <li>Certification of Enrollment from the last school attended.</li>
          </ol>
          <strong>
            <li>ALS/PEPT Completer:</li>
          </strong>
          <ol class="rac-list" type="a">
            <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
            <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
              family
              name/surname of the husband</li>
            <li>Hard copy One (1) 2x2 recent formal studio "type" photo (not necessarily taken in a studio) with
              nametag
            </li>
            <li>Certified true copy ALS Certificate of Rating – For completers of Alternative Learning System (ALS) OR
              PEPT. Photocopy /scanned copy will suffice if the applicant can present the original copy for comparison
              purposes.</li>
            <li>Certification of Enrollment from the last school attended (most recent).</li>
          </ol>
          <strong>
            <li>Transferee:</li>
          </strong>
          <ol class="rac-list" type="a">
            <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
            <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
              family
              name/surname of the husband</li>
            <li>Hard copy One (1) 2x
            <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
            <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
              family
              name/surname of the husband</li>
            <li>Hard copy One (1) 2x2 recent formal studio "type" photo (not necessarily taken in a studio) with
              nametag
            </li>
            <li>Certified true copy of Copy of Grades or Transcript of Records (Applicable only for Second Degree
              Transferees). Photocopy /scanned copy will suffice if the applicant can present the original copy for
              comparison purposes.</li>
            <li>Certification of Enrollment from the last school attended (most recent) or presently enrolled in.</li>
            <li>Certification of General Weighted Average (GWA) issued by the Registrar's Office/equivalent Office of
              your previous School.</li>
          </ol>

          <strong>
            <li>Second Degree:</li>
          </strong>
          <ol class="rac-list" type="a">
            <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
            <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
              family
              name/surname of the husband</li>
            <li>Hard copy One (1) 2x2 recent formal studio "type" photo (not necessarily taken in a studio) with
              nametag
            </li>
            <li>Certified true copy of Copy of Grades or Transcript of Records (Applicable only for Second Degree
              Transferees). Photocopy /scanned copy will suffice if the applicant can present the original copy for
              comparison purposes.</li>
            <li>Photocopy/scanned copy of Grades or Transcript of Records for graduates Where BSU is the last school
              attended</li>
            <li>Certification of Enrollment from the last school attended (most recent) or presently enrolled in.</li>
            <li>Certification of General Weighted Average (GWA) issued by the Registrar's Office/equivalent Office of
              your previous School.</li>
          </ol>
        </ol>
        <p></p>

        <p><label class="checkbox-container">
        <input type="checkbox" id="read-guidelines" required>
        <span class="checkmark"></span> NOTE: CHECK AND PROCEED ONLY TO THE NEXT STEP IF ALL REQUIREMENTS ARE COMPLETE, INCOMPLETE REQUIREMENTS WILL NOT BE ENTERTAINED!</p>
      </label>
      
    </div>

     



      <div class="index-btn-wrapper">
        <div class="index-btn" onclick="run(1, 2);">Next</div>
      </div>
    </div>


    <!--Form 2-->
    <div class="tab" id="tab-2">

      <div class="page-containerr">

        <h2 align="center">ADMISSION FORM</h2>

        <!-- ID Picture upload section -->

        <div id="id_picture_preview_container">
          <div>
            <img id="id_picture_preview_img">
          </div>
          <div id="upload-instructions">
            <p><strong>SUBMIT RECENT 2"x 2" ID PICTURE</strong> (clear/standard photo) with white background and name
              tag <i>(Signature over printed name)</i></p>
          </div>
        </div>
        <input type="file" name="id_picture" id="id_picture" accept="image/*" style="display: none" required>

        <u>
          <p class="head_information"> Privacy Notice</p>
        </u>
        <p class="privacy-notice-text">Persuant to the data Privacy Act of 2012 and BSU Data Privacy, Personnel from
          the
          office of the University Registrar,.Persuant to the data Privacy Act of 2012 and BSU Data Privacy, Personnel
          from the office of the University Registrar,.Persuant to the data Privacy Act of 2012 and BSU Data Privacy,
          Personnel from the office of the University Registrar,.Persuant to the data Privacy Act of 2012 and BSU Data
          Privacy, Personnel from the office of the University Registrar,.Persuant to the data Privacy Act of 2012 and
          BSU Data Privacy, Personnel from the office of the University Registrar,.</p>

        <p class="binformation"> Background Information of Applicant</p>
        <p class="personal_information"> Personal Information</p>
        <!--Full name-->


        <div class="form-container">
          <!-- Full name -->
          <!-- Last Name Input -->
          <div class="form-group">
            <label class="small-label" for="last_name">Last Name</label>
            <input type="text" name="last_name" class="input" id="last_name" placeholder="Last Name" required
              oninput="updateApplicantName()">
          </div>

          <!-- First Name Input -->
          <div class="form-group">
            <label class="small-label" for="first_name">First Name</label>
            <input type="text" name="first_name" class="input" id="first_name" placeholder="First Name"
              autocomplete="name" required oninput="updateApplicantName()">
          </div>

          <!-- Middle Name Input -->
          <div class="form-group">
            <label class="small-label" for="middle_name">Middle Name</label>
            <input type="text" name="middle_name" class="input" id="middle_name" placeholder="Middle Name"
              autocomplete="middle" required oninput="updateApplicantName()">
          </div>

          <!-- Gender at Birth -->
          <div class="form-group">
            <label class="small-label" for="gender">Gender at birth</label>
            <select name="gender" class="input" id="gender" required>
              <option value="" disabled selected>Select Gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
          </div>
          <div class="form-group">
            <label class="small-label" for="birthdate">Birthdate</label>
            <input type="date" name="birthdate" class="input" id="birthdate" onchange="calculateAge()" required>
          </div>
        </div>
        <p class="birthplace"></p>
        <div class="form-container">
          <!-- Birthplace -->
          <!-- Birthplace -->
          <div class="form-group">
            <label class="small-label" for="birthplace">Birthplace</label>
            <input type="text" name="birthplace" class="input" id="birthplace"
              placeholder="Municipality/City, Province, Country" required>
          </div>
          <!-- Age -->
          <div class="form-group">
            <label class="small-label" for="age">Age</label>
            <input type="number" name="age" class="input" id="age" placeholder="Age" required>
          </div>

          <!-- civil status -->
          <div class="form-group">
            <label class="small-label" for="civil_status">Civil Status</label>
            <select name="civil_status" class="input" id="civil_status" required>
              <option value="" disabled selected>Select Civil Status</option>
              <option value="single">Not Married</option>
              <option value="married">Married</option>
            </select>
          </div>
          <!-- Citizenship -->
          <div class="form-group">
            <label class="small-label" for="citizenship">Citizenship</label>
            <input type="text" name="citizenship" class="input" id="citizenship" placeholder="Citizenship" required>

          </div>
          <!-- Nationality-->
          <div class="form-group">
            <label class="small-label" for="nationality">Nationality</label>
            <input type="text" name="nationality" class="input" id="nationality" placeholder="Nationality" required>
          </div>
        </div>

        <p class="personal_information">Permanent Home Address</p>
        <div class="form-container">
          <div class="form-group">
            <label class="small-label" for="permanent_address">Address</label>
            <input type="text" name="permanent_address" class="input" id="permanent_address"
              placeholder="House # & Street, Barangay/Subdivision, Municipality(town)/City, Province, Country/State"
              required>
          </div>
          <!-- zip-code -->
          <div class="form-group">
            <label class="small-label" for="zip_code">Zip Code</label>
            <input type="number" name="zip_code" class="input" id="zip_code" placeholder="Zip Code" required>
          </div>
        </div>

        <p class="personal_information">Contact Information</p>
        <div class="form-container">
          <!-- Telephone/Mobile No -->
          <div class="form-group">
            <label class="small-label" for="phone">Telephone/Mobile No.</label>
            <input type="tel" name="phone" class="input" id="phone" placeholder="Enter phone number"
              autocomplete="number" required oninput="validatePhoneNumber('phone')">
            <p id="phone-error" style="color: red;"></p>
          </div>
          <!-- Facebook Account Name -->
          <div class="form-group">
            <label class="small-label" for="facebook">Facebook Account Name</label>
            <input type="text" name="facebook" class="input" id="facebook" placeholder="account should be your name"
              required>
          </div>
          <!--Email Address -->
          <div class="form-group">
            <label class="small-label" for="email">Email Address</label>
            <input type="text" name="email" class="input" id="email" placeholder="Enter active email address"
              autocomplete="email:" required oninput="validateEmail()">
            <p id="email-error" style="color: red;"></p>
          </div>

        </div>
        <p class="personal_information">Contact person(s) in case of emergency</p>

        <div class="form-container">
          <!-- Contact Person 1 -->
          <div class="form-group">
            <label class="small-label" for="contact_person_1">Contact Person</label>
            <input type="text" name="contact_person_1" class="input" id="contact_person_1"
              placeholder="Full Name of Contact Person" required>
          </div>
          <div class="form-group">
            <label class="small-label" for="contact_person_1_mobile">Mobile Number</label>
            <input type="tel" name="contact_person_1_mobile" class="input" id="contact_person_1_mobile"
              placeholder="Enter mobile number" required oninput="validatePhoneNumber('contact_person_1_mobile')">
            <p id="contact_person_1_mobile-error" style="color: red;"></p>
          </div>
          <div class="form-group">
            <label class="relationship-label" for="relationship_1">Relationship with Contact Person</label>
            <select name="relationship_1" class="input custom-dropdown" id="relationship_1" required>
              <option value="" disabled selected>Select Relationship</option>
              <option value="parent">Parent</option>
              <option value="guardian">guardian</option>

            </select>
          </div>
        </div>
        <div class="form-container">
          <!-- Contact Person 2 -->
          <div class="form-group">
            <label class="small-label" for="contact_person_2">Contact Person</label>
            <input type="text" name="contact_person_2" class="input" id="contact_person_2"
              placeholder="Full Name of Contact Person" required>
          </div>
          <div class="form-group">
            <label class="small-label" for="contact_person_2_mobile">Mobile Number</label>
            <input type="tel" name="contact_person_2_mobile" class="input" id="contact_person_2_mobile"
              placeholder="Enter mobile number" required oninput="validatePhoneNumber('contact_person_2_mobile')">
            <p id="contact_person_2_mobile-error" style="color: red;"></p>
          </div>
          <div class="form-group">
            <label class="relationship-label" for="relationship_2">Relationship with Contact Person</label>
            <select name="relationship_2" class="input custom-dropdown" id="relationship_2" required>
              <option value="" disabled selected>Select Relationship</option>
              <option value="parent">Parent</option>
              <option value="guardian">guardian</option>

            </select>
          </div>
        </div>

        <p class="personal_information">Academic Classification</p>
        <div class="form-container">
          <!-- Academic Classification -->
          <div class="form-group">
            <label class="small-label" for="academic_classification">Academic Classification</label>
            <select name="academic_classification" class="input" id="academic_classification" required>
              <option value="" disabled selected>Select Academic Classification</option>
              <option value="grade_12">Currently enrolled as Grade 12 student (Graduating for the current year)
              </option>
              <option value="shs_graduate">Senior High School Graduate (who did not enroll in any other school after
                graduation)</option>
              <option value="hs_graduate">High School Graduate (who did not enroll in any other school after
                graduation)
              </option>
              <option value="als_pept_passer">ALS A&E SHS level passer/ PEPT Passer</option>
              <option value="transferee">Transferee (previously enrolled as a college student from another school)
              </option>
              <option value="vocational_completers">Vocational/Technical-Vocational Completers</option>
              <option value="second_degree">Second (2nd) Degree</option>
            </select>
          </div>
        </div>
        <p class="personal_information">Academic Background </p>
        <div class="form-container">
          <!-- Academic Background -->
          <div class="form-group">
            <label class="small-label" for="high_school_name_address" style="white-space: nowrap;">High School/Senior
              High School</label>
            <input type="text" name="high_school_name_address" class="input" id="high_school_name_address" required
              placeholder="Enter Name and Address">

          </div>
        </div>
        <div class="form-container">
          <div class="form-group">
            <label class="small-label" for="als_pept_name_address" style="white-space: nowrap;">ALS/PEPT was
              taken:</label>
            <input type="text" name="als_pept_name_address" class="input" id="als_pept_name_address" required
              placeholder="Enter Name and Address">

          </div>
        </div>
        <div class="form-container">
          <div class="form-group">

            <label class="small-label" for="college_name_address">College/University:</label>
            <input type="text" name="college_name_address" class="input" id="college_name_address" required
              placeholder="Enter Name and Address">
          </div>
        </div>
          <div class="form-container">
          <div class="form-group">
            <label class="small-label" for="lrn" style="white-space: nowrap;">Learner's Reference Number</label>
            <input type="number" name="lrn" class="input" id="lrn" placeholder="Enter LRN" pattern="[0-9]*"
              maxlength="12" required>
          </div>


          <div class="form-group">
            <label class="small-label" for="degree_applied">Degree</label>
            <!-- Display the selected program in this input field -->
            <input type="text" name="degree_applied" class="input" id="degree_applied" readonly required>
          </div>


          <div class="form-group">
            <label class="small-label" for="nature_of_degree" style="white-space: nowrap;">Nature of degree</label>
            <input type="text" name="nature_of_degree" class="input" id="nature_of_degree" readonly required>

          </div>
        </div>
        <p class="attestation-head">Attestation and Consent</p>

        <p class="attestation-note">I affirm that I have read and understood all the instructions contained in this
          application form that the information suplied are true. I affirm that I have read and understood all the
          instructions contained in this application form that the information suplied are true. I affirm that I have
          read and understood all the instructions contained in this application form that the information suplied are
          true.I affirm that I have read and understood all the instructions contained in this application form that
          the
          information suplied are true.</p>


        <br><br>

        <!-- Inside your HTML form (admissionform.html), add the following lines where you see fit, perhaps after the signature pad for the student -->
    

      </div>
      <br><br>
      <div class="index-btn-wrapper">
        <div class="index-btn" onclick="run(2, 1);">Previous</div>
        <div class="index-btn" onclick="run(2, 3);">Next</div>
      </div>
    </div>
    <!--Form 3-->
    <div class="tab" id="tab-3">
      <br>
      <h2>ACKNOWLEDGEMENT SLIP OF APPLICATION FOR ADMISSION</h2>

      <table class="table-3-class">
        <tr>
          <td>Document
            Code:
          </td>
          <td>QF-ADM-
            08
          </td>
          <td>Rev.
            No.:
          </td>
          <td>01&nbsp</td>
        </tr>
        <tr>
          <td>Effectivity
            Date:

          </td>
          <td>January 5,
            2023
          </td>
          <td colspan="2">&nbsp</td>
        </tr>

      </table>
      <h3 class="privacy-heading">PRIVACY NOTICE</h3>
      <p class="privacy-notice">
        Pursuant to the Data Privacy Act of 2012 and the BSU Data Policy from the Office of the University Registrar,
        concerned Personnel of BSU La Trinidad, BSU Buguias Campus, and Bokod Campus are committed to keep with utmost
        confidentiality all sensitive personal information collected from applicants. Personal information is
        collected,
        accessed, used, and disclosed on a "need to know basis" and only as reasonably required. Confidential
        information either within or outside the University will not be communicated except to persons authorized to
        receive such information. Authorized hardware, software, or other authorized equipment shall be used only in
        accessing, processing, and transmitting such information. Read more on BSU Data Privacy Notice: <a
          href="http://www.bsu.edu.ph/dpa/bsu-data-privacy-notice-students">http://www.bsu.edu.ph/dpa/bsu-data-privacy-notice-students</a>.
      </p>

      <p class="to-be-filled">To be filled-out by Applicant</p>

      <div class="form-container">
        <div class="form-group">
          <label for="applicant_name">Name of Applicant</label>
          <input type="text" placeholder="Enter Full Name" name="applicant_name" id="applicant_name">
        </div>


        <div class="form-group">
          <label for="slip_degree">Degree applied</label>
          <input type="text" name="slip_degree" id="slip_degree" class="input" readonly required>
        </div>

        <div class="form-group">
          <label for="application_date">Date of Application</label>
          <input type="date" name="application_date" class="input" id="application_date" required>
        </div>
      </div>
      <p class="attestation-head" style="text-align: center;">Attestation and Consent</p>

      <p class="attestation-note">I affirm that I have read and understood all the instructions contained in this
        application form that the information suplied are true. I affirm that I have read and understood all the
        instructions contained in this application form that the information suplied are true. I affirm that I have
        read
        and understood all the instructions contained in this application form that the information suplied are true.I
        affirm that I have read and understood all the instructions contained in this application form that the
        information suplied are true.</p>

      <div class="applicant_number">
        <label for="applicant_number" class="applicant_number">Applicant Number:</label>
        <input type="text" name="applicant_number" id="applicant_number" readonly>
      </div>
      <p class="signature-label">Applicant's E-Signature:</p>
     
      <div class="index-btn-wrapper">
        <div class="index-btn" onclick="run(3, 2);">Previous</div>
        <div class="index-btn" onclick="run(3, 4);">Next</div>
      </div>
    </div>
    <div class="tab" id="tab-4">

      <div class="page-containerr">
        <p>Make sure you filled-out all the fields correctly before submitting</p>
      </div>
      <div class="index-btn-wrapper">
        <div class="index-btn" onclick="run(4, 3);">Previous</div>
        <button class="index-btn" type="submit" name="submit" style="background: blue;">Submit</button>


      </div>
    </div>


  </form>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>


  <script src="..\frontend\assets\js\admissionform.js"></script>


</body>

</html>

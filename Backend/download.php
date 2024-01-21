<?php
session_start();
include("config.php");

$studentId = $_SESSION['user_id'];
$stmtUser = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmtUser->bind_param("i", $studentId);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$studentData = $resultUser->fetch_assoc();

// Retrieve the admission data based on the user's email
$email = $studentData['email'];
$stmtAdmission = $conn->prepare("SELECT * FROM admission_data WHERE email = ?");
$stmtAdmission->bind_param("s", $email);
$stmtAdmission->execute();
$resultAdmission = $stmtAdmission->get_result();
$admissionData = $resultAdmission->fetch_assoc();

// Get the current day and month with leading zeros
$currentDay = date('d');
$currentMonth = date('m');

// Generate the applicant number in the format 00-00-000
$applicantNumber = sprintf("%02d-%02d-%04d", $currentDay, $currentMonth, $studentId);

$sql = "SELECT * FROM programs WHERE Nature_of_Degree = 'Board' AND Overall_Slots IS NOT NULL AND Overall_Slots <> 0";
$result = $conn->query($sql);

// Fetch data from the database where Nature_of_Degree is 'Non-Board' and Overall_Slots is not empty or zero
$sqlNonBoard = "SELECT * FROM programs WHERE Nature_of_Degree = 'Non-Board' AND Overall_Slots IS NOT NULL AND Overall_Slots <> 0";
$resultNonBoard = $conn->query($sqlNonBoard);


// Fetch 'Classification' values for 'Non-Board' from the 'NonBoardAcadClass' table
$sqlNonBoardClassifications = "SELECT Classification FROM NonBoardAcadClass";
$resultNonBoardClassifications = $conn->query($sqlNonBoardClassifications);

// Fetch data from the academicclassification table for the Classification column
$sqlClassification = "SELECT DISTINCT Classification FROM academicclassification";
$resultClassification = $conn->query($sqlClassification);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Process form data
  $id_picture = isset($_FILES['id_picture']) ? $_FILES['id_picture'] : null;

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

  $rank = isset($_POST['rank']) ? $_POST['rank'] : null;  // Check if 'rank' key exists
  $result = isset($_POST['result']) ? $_POST['result'] : null;  // Check if 'result' key exists
  }
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admission Application</title>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link rel="icon" href="assets/images/BSU Logo1.png" type="image/x-icon">
  <link rel="stylesheet" href="assets\css\applicationformdownload.css">
  <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <!-- Additional styling for the download button -->
</head>

<button onclick="downloadPDF()"> Download </button>

<body>
      <div class="page-containerr" id="DownloadForm">
        <!-- LOGO -->
            <img src="assets/images/BSU Logo1.png" class="logo" alt="logo"width="80" height="80" style="float:left;">
        <!-- Office and Location -->
        <div style="text-align: center;">
            <p>Republic of the Philippines</p>
            <h5 style="font-family: 'Old English Text MT'; color: rgb(22, 62, 4);">Benguet State University</h5>
            <strong>Office of University Registrar</strong><br>
            <p>La Trinidad, Benguet</p>
        </div>
        <!-- ID Picture upload section -->
        <div style="float: right; margin-left: 10px;">
            <div id="id_picture_preview_container">
                <div>
                    <img id="id_picture_preview_img">
                </div>
                <div id="upload-instructions">
                    <p><strong>SUBMIT TWO (2) PIECES 2"x 2" RECENT FORMAL STUDIO TYPE PHOTO</strong> with white background and 
                    nametag <i>(Signature over printed name)</i></p>
                </div>
            </div>
            <input type="file" name="id_picture" id="id_picture" accept="image/*" style="display: none" required>
        </div><br><br>
        <h2 align="center">APPLICATION FOR ADMISSION</h2>
        <p class="head_information">PRIVACY NOTICE:</p>
        <p class="privacy-notice-text">Pursuant to the Data Privacy Act of 2012 and the BSU Data Privacy, Personnel from the 
            Office of the University Registrar,.Persuant to the data Privacy Act of 2012 and BSU Data Privacy, Personnel from 
            the office of the University Registrar, concerned Personnel of the different Colleges of BSU La Trinidad, BSU Buguias 
            Campus and Bokod Campus are commited to keep with utmost confidentiality, all sinsetive personal information collected 
            from applicants. Personal information are collected, accessed, used and or disclosed on a "need to  know basis" and only 
            as reasonably required. Confidential information either within or outside the University will not be communicated, except 
            to persons authorized to receive such information. Authorized hardware, software, or other authorized equipment shall be 
            used only in accessing, processing, and transmitting such personal information. Read more on BSU Data Privacy Notice: 
            <a href="http://www.bsu.edu.ph/dpa/bsu-data-privacy-notice-students">http://www.bsu.edu.ph/dpa/bsu-data-privacy-notice-students</a>
          </p>
        <p class="head_information">BACKGROUND INFORMATION OF APPLICANT</p>
        <p class="personal_information">Personal Information</p>
        <div class="form-container">
          <!-- Full name -->
          <div class="form-group">
            <label class="small-label" for="applicant_name">Complete Name</label>
            <input name="applicant_name" class="input" id="applicant_name" value="<?php echo $admissionData['applicant_name']; ?>">
          </div>
          <!-- Sex at Birth -->
          <div class="form-group">
            <label class="small-label" for="gender">Sex at birth</label>
            <input name="gender" class="input" id="gender" value="<?php echo $admissionData['gender']; ?>">
          </div>
          <!-- Birthdate -->
          <div class="form-group">
            <label class="small-label" for="birthdate">Birthdate</label>
            <input name="birthdate" class="input" id="birthdate" value="<?php echo $admissionData['birthdate']; ?>">
          </div>
        <!-- Age -->
        <div class="form-group">
            <label class="small-label" for="age">Age</label>
            <input name="age" class="input" id="age" value="<?php echo $admissionData['age']; ?>">
          </div>
          </div>

        <p class="birthplace"></p>
        <div class="form-container">
        <!-- Birthplace -->
          <div class="form-group">
            <label class="small-label" for="birthplace">Birthplace</label>
            <input name="birthplace" class="input" id="birthplace" value="<?php echo $admissionData['birthplace']; ?>">
          </div>
          <!-- civil status -->
          <div class="form-group">
            <label class="small-label" for="civil_status">Civil Status</label>
            <input name="civil_status" class="input" id="civil_status" value="<?php echo $admissionData['civil_status']; ?>">
          </div>
          <!-- Citizenship -->
          <div class="form-group">
            <label class="small-label" for="citizenship">Citizenship</label>
            <input name="citizenship" class="input" id="citizenship" value="<?php echo $admissionData['citizenship']; ?>">
          </div>
          <!-- Nationality-->
          <div class="form-group">
            <label class="small-label" for="nationality">Nationality</label>
            <input name="nationality" class="input" id="nationality" value="<?php echo $admissionData['nationality']; ?>">
          </div>
        </div>

        <p class="personal_information">Permanent Home Address</p>
        <div class="form-container">

          <div class="form-group">
            <label class="small-label" for="permanent_address">Address</label>
            <input name="permanent_address" class="input" id="permanent_address" value="<?php echo $admissionData['permanent_address']; ?>">
          </div>
          <!-- zip-code -->
          <div class="form-group">
            <label class="small-label" for="zip_code">Zip Code</label>
            <input name="zip_code" class="input" id="zip_code" value="<?php echo $admissionData['zip_code']; ?>">
          </div>
        </div>

        <p class="personal_information">Contact Information</p>
        <div class="form-container">
          <!-- Telephone/Mobile No -->
          <div class="form-group">
            <label class="small-label" for="phone">Telephone/Mobile No.</label>
            <input name="phone" class="input" id="phone" value="<?php echo $admissionData['phone']; ?>">
          </div>

          <!-- Facebook Account Name -->
          <div class="form-group">
            <label class="small-label" for="facebook">Facebook Account Name</label>
            <input name="facebook" class="input" id="facebook" value="<?php echo $admissionData['facebook']; ?>">
          </div>
          <!--Email Address -->
          <div class="form-group">
            <label class="small-label" for="email">Email Address</label>
            <input name="email" class="input" id="email" value="<?php echo $admissionData['email']; ?>">
          </div>

        </div>
        <p class="personal_information">Contact Person(s) in Case of Emergency</p>

        <div class="form-container">
          <!-- Contact Person 1 -->
          <div class="form-group">
            <label class="small-label" for="contact_person_1">Contact Person</label>
            <input name="contact_person_1" class="input" id="contact_person_1" value="<?php echo $admissionData['contact_person_1']; ?>">
          </div>
          <div class="form-group">
            <label class="small-label" for="contact_person_1_mobile">Mobile Number</label>
            <input name="contact_person_1_mobile" class="input" id="contact_person_1_mobile" value="<?php echo $admissionData['contact_person_1_mobile']; ?>">
          </div>
          <div class="form-group">
            <label class="relationship-label" for="relationship_1">Relationship with Contact Person</label>
            <input name="relationship_1" class="input" id="relationship_1" value="<?php echo $admissionData['relationship_1']; ?>">
          </div>
        </div>
        <div class="form-container">
          <!-- Contact Person 2 -->
          <div class="form-group">
            <label class="small-label" for="contact_person_2">Contact Person</label>
            <input name="contact_person_2" class="input" id="contact_person_2" value="<?php echo $admissionData['contact_person_2']; ?>">
          </div>
          <div class="form-group">
            <label class="small-label" for="contact_person_2_mobile">Mobile Number</label>
            <input name="contact_person_2_mobile" class="input" id="contact_person_2_mobile" value="<?php echo $admissionData['contact_person_2_mobile']; ?>">
          </div>
          <div class="form-group">
            <label class="relationship-label" for="relationship_2">Relationship with Contact Person</label>
            <input name="relationship_2" class="input" id="relationship_2" value="<?php echo $admissionData['relationship_2']; ?>">
          </div>
        </div>

        <p class="personal_information">Academic Classification</p>
        <div class="form-container">
          <!-- Academic Classification -->
          <div class="form-group">
            <label class="small-label" for="academic_classification">Academic Classification</label>
            <input name="academic_classification" class="input" id="academic_classification" value="<?php echo $admissionData['academic_classification']; ?>">
          </div>
        </div>
        <p class="personal_information">Academic Background </p>
        <div class="form-container">
          <!-- Academic Background -->
          <div class="form-group">
            <label class="small-label" for="high_school_name_address" style="white-space: nowrap;">High School/Senior High School</label>
            <input name="high_school_name_address" class="input" id="high_school_name_address" value="<?php echo $admissionData['high_school_name_address']; ?>">

          </div>
        </div>
        <div class="form-container">
          <div class="form-group">
            <label class="small-label" for="als_pept_name_address" style="white-space: nowrap;">ALS/PEPT was taken:</label>
            <input name="als_pept_name_address" class="input" id="als_pept_name_address" value="<?php echo $admissionData['als_pept_name_address']; ?>">
          </div>
        </div>
        <div class="form-container">
          <div class="form-group">
            <label class="small-label" for="college_name_address">College/University:</label>
            <input name="college_name_address" class="input" id="college_name_address" value="<?php echo $admissionData['college_name_address']; ?>">
        </div>
        <div class="form-container">
          <div class="form-group">
            <label class="small-label" for="lrn" style="white-space: nowrap;">Learner's Reference Number</label>
            <input name="lrn" class="input" id="lrn" value="<?php echo $admissionData['lrn']; ?>">
          </div>
          <div class="form-group">
            <label class="small-label" for="degree_applied">Degree</label>
            <!-- Display the selected program in this input field -->
            <input name="degree_applied" class="input" id="degree_applied" value="<?php echo $admissionData['degree_applied']; ?>">
          </div>
          <div class="form-group">
            <label class="small-label" for="nature_of_degree" style="white-space: nowrap;">Nature of degree</label>
            <input name="nature_of_degree" class="input" id="nature_of_degree" value="<?php echo $admissionData['nature_of_degree']; ?>">
          </div>
        </div>

        <p class="attestation-head" style="text-align: center;">ATTESTATION AND CONSENT</p>
        <p class="attestation-note"><i>I affirm that I have read and understood all the instructions contained in this acknowledgement 
            slip and that the information supplied are true, complete and accurate. I promise to abide by the rules and regulations 
            of the admission process of Benguet State University. I am aware that any information I have concealed, falsely given 
            and/or withheld is enough basis for the invalidation/cancellation of my application. I have understood the Data Privacy 
            Notice above and freely give my consent to the legitimate use of my personal data by the University thru my signature 
            which I have affixed herein.</i></p><br><br>
</div>
</body>

<!-- Include html2pdf.js library from a local file -->
<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
<script>
    function downloadPDF(){
        // var element = document.getElementById("DownloadForm")
        // html2pdf().from(element).save()
        var element = document.getElementById("DownloadForm");
        var opt = {
            margin: 6.35,
            filename: 'Admission Form.pdf',
            jsPDF: {unit: 'mm', format: [215.9, 330.2], orientation: 'portrait'},
            pagebreak: { before: '#page-containerr', avoid: '.avoid-this' }
        };
        html2pdf().set(opt).from(element).save();
    }
</script>
</html>
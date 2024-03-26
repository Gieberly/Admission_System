<?php
session_start();
include("config.php");

// Include the mPDF library
// require_once __DIR__ . '/vendor/autoload.php';

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

$sql = "SELECT * FROM programs WHERE Nature_of_Degree = 'Board' AND Number_of_Available_Slots IS NOT NULL AND Number_of_Available_Slots <> 0";
$result = $conn->query($sql);

// Fetch data from the database where Nature_of_Degree is 'Non-Board' and Number_of_Available_Slots is not empty or zero
$sqlNonBoard = "SELECT * FROM programs WHERE Nature_of_Degree = 'Non-Board' AND Number_of_Available_Slots IS NOT NULL AND Number_of_Available_Slots <> 0";
$resultNonBoard = $conn->query($sqlNonBoard);

// Fetch data from the academicclassification table for the Classification column
$sqlClassification = "SELECT DISTINCT Classification FROM academicclassification";
$resultClassification = $conn->query($sqlClassification);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Process form data
  $id = $_POST['id']; 
  $id_picture = isset($_FILES['id_picture']) ? $_FILES['id_picture'] : null;

  $Name = $_POST['Name'];
    $Middle_Name = $_POST['Middle_Name'];
    $Last_Name = $_POST['Last_Name'];
  $gender = $_POST['gender'];
  $birthdate = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['birthdate'])));
  $birthplace = $_POST['birthplace'];
  $age = $_POST['age'];
  $civil_status = $_POST['civil_status'];
  $citizenship = $_POST['citizenship'];
  $ethnicity = $_POST['ethnicity'];
  $permanent_address = $_POST['permanent_address'];
  $zip_code = $_POST['zip_code'];
  $phone_number = $_POST['phone_number'];
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
  
  $appointment_time = $_POST['appointment_time'];
  $rank = isset($_POST['rank']) ? $_POST['rank'] : null;  // Check if 'rank' key exists
  $result = isset($_POST['result']) ? $_POST['result'] : null;  // Check if 'result' key exists
  }
$conn->close();

$pdfContent = '';

ob_start(); // Start output buffering
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

</head>

<button onclick="downloadPDF()"> Download </button>

<body>
      <div class="page-containerr" id="DownloadForm">
        <div class="inline-heading">
        <!-- LOGO -->
        <img src="assets/images/BSU Logo1.png" class="logo" alt="logo"width="90" height="90" style="float:left;">
        <!-- Office and Location -->
        <div class="head-der">
            <p>Republic of the Philippines</p>
            <h5 style="font-family: 'Old English Text MT'; color: rgb(22, 62, 4);">Benguet State University</h5>
            <strong>Office of University Registrar</strong><br>
            <p>La Trinidad, Benguet</p>
            <br><br>
            <h2 style="font-size: 14px">APPLICATION FOR ADMISSION</h2>
            <br><br>
            <p class="head_information">BACKGROUND INFORMATION OF APPLICANT</p>
        </div>
        <!-- ID Picture upload section -->
        <div id="id_picture_preview_container" >
            <p><strong>SUBMIT TWO (2) PIECES 2"x 2" RECENT FORMAL STUDIO TYPE PHOTO</strong> with white background and 
            nametag <i>(Signature over printed name)</i></p>
        </div>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
        <p class="personal_information">Personal Information</p>
          <h3 style="font-size: 14px;">Applicant Number: <span style="color: red;"><?php echo $admissionData['applicant_number'];?></span></h3>
        </div>
        <div class="form-container1">
          <!-- Full name -->
          <div class="form-group">
            <label class="small-label" for="applicant_name">Complete Name</label>
            <input name="applicant_name" class="input" id="applicant_name" value="<?php echo $admissionData['Name'] . ' ' . $admissionData['Middle_Name'] . ' ' . $admissionData['Last_Name']; ?>" readonly>

          </div>

          <!-- Birthplace -->
          <div class="form-group">
            <label class="small-label" for="birthplace">Birthplace</label>
            <input name="birthplace" class="input" id="birthplace" value="<?php echo $admissionData['birthplace']; ?>" readonly>
          </div>
        </div>

        <div class="form-container2">
          <!-- Sex at Birth -->
          <div class="form-group">
            <label class="small-label" for="gender">Sex at birth</label>
            <input name="gender" class="input" id="gender" value="<?php echo $admissionData['gender']; ?>" readonly>
          </div>
          <!-- Birthdate -->
          <div class="form-group">
            <label class="small-label" for="birthdate">Birthdate</label>
            <input name="birthdate" class="input" id="birthdate" value="<?php echo $admissionData['birthdate']; ?>" readonly>
          </div>
        <!-- Age -->
        <div class="form-group">
            <label class="small-label" for="age">Age</label>
            <input name="age" class="input" id="age" value="<?php echo $admissionData['age']; ?>" readonly>
          </div>
          <!-- civil status -->
          <div class="form-group">
            <label class="small-label" for="civil_status">Civil Status</label>
            <input name="civil_status" class="input" id="civil_status" value="<?php echo $admissionData['civil_status']; ?>" readonly>
          </div>
          <!-- Citizenship -->
          <div class="form-group">
            <label class="small-label" for="citizenship">Citizenship</label>
            <input name="citizenship" class="input" id="citizenship" value="<?php echo $admissionData['citizenship']; ?>" readonly>
          </div>
          <!-- Ethnicity-->
          <div class="form-group">
            <label class="small-label" for="ethnicity">Ethnicity</label>
            <input name="ethnicity" class="input" id="ethnicity" value="<?php echo $admissionData['ethnicity']; ?>" readonly>
          </div>
        </div>

        <p class="personal_information">Permanent Home Address</p>

        <div class="form-container3">
          <div class="form-group">
            <label class="small-label" for="permanent_address">Address</label>
            <input name="permanent_address" class="input" id="permanent_address" value="<?php echo $admissionData['permanent_address']; ?>" readonly>
          </div>
          <!-- zip-code -->
          <div class="form-group">
            <label class="small-label" for="zip_code">Zip Code</label>
            <input name="zip_code" class="input" id="zip_code" value="<?php echo $admissionData['zip_code']; ?>" readonly>
          </div>
        </div>

        <p class="personal_information">Contact Information</p>
        <div class="form-container4">
          <!-- Telephone/Mobile No -->
          <div class="form-group">
            <label class="small-label" for="phone_number">Telephone/Mobile No.</label>
            <input name="phone_number" class="input" id="phone" value="+63<?php echo $admissionData['phone_number']; ?>" readonly>
          </div>

          <!-- Facebook Account Name -->
          <div class="form-group">
            <label class="small-label" for="facebook">Facebook Account Name</label>
            <input name="facebook" class="input" id="facebook" value="<?php echo $admissionData['facebook']; ?>" readonly>
          </div>
          <!--Email Address -->
          <div class="form-group">
            <label class="small-label" for="email">Email Address</label>
            <input name="email" class="input" id="email" value="<?php echo $admissionData['email']; ?>" readonly>
          </div>
        </div>

        <p class="personal_information">Contact Person(s) in Case of Emergency</p>
        <div class="form-container7">
          <!-- Contact Person 1 -->
          <div class="form-group">
            <label class="small-label" for="contact_person_1">Contact Person</label>
            <input name="contact_person_1" class="input" id="contact_person_1" value="<?php echo $admissionData['contact_person_1']; ?>" readonly>
          </div>
          <div class="form-group">
            <label class="small-label" for="contact_person_1_mobile">Mobile Number</label>
            <input name="contact_person_1_mobile" class="input" id="contact_person_1_mobile" value="+63<?php echo $admissionData['contact1_phone']; ?>" readonly>
          </div>
          <div class="form-group">
            <label class="small-label" for="relationship_1">Relationship with Contact Person</label>
            <input name="relationship_1" class="input" id="relationship_1" value="<?php echo $admissionData['relationship_1']; ?>" readonly>
          </div>
        </div>
        <div class="form-container7">
          <!-- Contact Person 2 -->
          <div class="form-group">
            <label class="small-label" for="contact_person_2">Contact Person</label>
            <input name="contact_person_2" class="input" id="contact_person_2" value="<?php echo $admissionData['contact_person_2']; ?>" readonly>
          </div>
          <div class="form-group">
            <label class="small-label" for="contact_person_2_mobile">Mobile Number</label>
            <input name="contact_person_2_mobile" class="input" id="contact_person_2_mobile" value="+63<?php echo $admissionData['contact_person_2_mobile']; ?>" readonly>
          </div>
          <div class="form-group">
            <label class="small-label" for="relationship_2">Relationship with Contact Person</label>
            <input name="relationship_2" class="input" id="relationship_2" value="<?php echo $admissionData['relationship_2']; ?>" readonly>
          </div>
        </div>

        <p class="personal_information">Academic Classification</p>
        <div class="form-container6">
          <!-- Academic Classification -->
          <div class="form-group">
    <label class="small-label" for="academic_classification">Academic Classification</label>
    <input name="academic_classification" class="input" id="academic_classification" value="<?php echo $admissionData['academic_classification']; ?>" readonly>
</div>

          <div class="form-group">
            <label class="small-label" for="degree_applied">Degree</label>
            <!-- Display the selected program in this input field -->
            <input name="degree_applied" class="input" id="degree_applied" value="<?php echo $admissionData['degree_applied']; ?>" readonly>
          </div>
          <div class="form-group">
            <label class="small-label" for="nature_of_degree" style="white-space: nowrap;">Nature of degree</label>
            <input name="nature_of_degree" class="input" id="nature_of_degree" value="<?php echo $admissionData['nature_of_degree']; ?>" readonly>
          </div>
        </div>
        <p class="personal_information">Academic Background </p>
        <div class="form-container5">
          <!-- Academic Background -->
          <div class="form-group">
            <label class="small-label" for="high_school_name_address" style="white-space: nowrap;">High School/Senior High School</label>
            <input name="high_school_name_address" class="input" id="high_school_name_address" value="<?php echo $admissionData['high_school_name_address']; ?>" readonly>
          </div>
          <div class="form-group">
            <label class="small-label" for="lrn" style="white-space: nowrap;">Learner's Reference Number</label>
            <input name="lrn" class="input" id="lrn" value="<?php echo $admissionData['lrn']; ?>" readonly>
          </div>
        </div>
        <p class="attestation-head">ATTESTATION AND CONSENT</p>
        <p class="attestation-note"><i>I affirm that I have read and understood all the instructions contained in this acknowledgement 
            slip and that the information supplied are true, complete and accurate. I promise to abide by the rules and regulations 
            of the admission process of Benguet State University. I am aware that any information I have concealed, falsely given 
            and/or withheld is enough basis for the invalidation/cancellation of my application. I have understood the Data Privacy 
            Notice above and freely give my consent to the legitimate use of my personal data by the University thru my signature 
            which I have affixed herein.</i></p><br><br><br>

        <div class="student_signature">
            <p>Signature Over Printed Name</p>
        </div><br><br>
        <div class="form-group">
        <h5>APPOINTMENT DATE: <span style="color: red;"><?php echo date('F d, Y', strtotime($admissionData['appointment_date'])); ?> <?php echo date('h:i A', strtotime($admissionData['appointment_time'])); ?></span></h5>


        <?php
$requirements = "";  // Initialize requirements variable

switch ($admissionData['academic_classification']) {
    case "Senior High School Graduates":
        $requirements = "
            <ul class='custom-list' type='a'>
                <h3>Bring the following documents during your appointment.</h3>
                <strong>
                    <li>Senior High School Graduate who did not enroll in any college degree program/technical/vocational/degree program in any other school after graduation and will only enroll for the immediately following School Year:</li>
                </strong>
                <ol class='rac-list' type='a'>
                    <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
                    <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the family name/surname of the husband</li>
                    <li>Hard copy two (2) 2x2 recent formal studio 'type' photo with nametag and signature</li>
                    <li>Certified true copy of Grade 12 Report Card. Photocopy /scanned copy will suffice if the applicant can present the original copy for comparison purposes.</li>
                    <li>Certification of Enrollment from the last school attended (most recent).</li>
                </ol>
                <h4>APPLICANTS WITH INCOMPLETE AND INCORRECT REQUIREMENTS WILL NOT BE ENTERTAINED.</h4>
            </ul>";
        break;

    case "High School (Old Curriculum) Graduates":
        $requirements = "
            <ul class='custom-list' type='a'>
            <h3>Bring the following documents during your appointment.</h3>
                <strong>
                    <li>High School Graduate of the Old High School curriculum who did not enroll in any college degree program in any other school after graduation from high school and will only enroll this School Year:</li>
                </strong>
                <ol class='rac-list' type='a'>
                    <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
                    <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the family name/surname of the husband</li>
                    <li>Hard copy two (2) 2x2 recent formal studio 'type' photo with nametag and signature</li>
                    <li>Certified true copy of High School Card/Form 138. Photocopy /scanned copy will suffice if the applicant can present the original copy for comparison purposes.</li>
                    <li>Certification of Enrollment from the last school attended (most recent).</li>
                </ol>
                <h4>APPLICANTS WITH INCOMPLETE AND INCORRECT REQUIREMENTS WILL NOT BE ENTERTAINED.</h4>
            </ul>";
        break;

    case "Grade 12":
        $requirements = "
            <ul class='custom-list' type='a'>
            <h3>Bring the following documents during your appointment.</h3>
                <strong>
                <li>Grade 12 as of application period (Currently enrolled as Grade 12):</li>
                </strong>
                <ol class='rac-list' type='a'>
                <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
                <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
                  family
                  name/surname of the husband</li>
                <li>Hard copy One (1) 2x2 recent formal studio (type) photo  with
                  nametag and signature
                </li>
                <li>Certified photocopy of Grade 11 Card</li>
                <li>Certification of Enrollment from the last school attended.</li>
                </ol>
                <h4>APPLICANTS WITH INCOMPLETE AND INCORRECT REQUIREMENTS WILL NOT BE ENTERTAINED.</h4>
            </ul>";
        break;

    case "ALS/PEPT Completers":
        $requirements = "
            <ul class='custom-list' type='a'>
            <h3>Bring the following documents during your appointment.</h3>
                <strong>
                    <li>ALS/PEPT Completer:</li>
                </strong>
                <ol class='rac-list' type='a'>
                    <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
                    <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the family name/surname of the husband</li>
                    <li>Hard copy two (2) 2x2 recent formal studio 'type' photo with nametag and signature</li>
                    <li>Certified true copy ALS Certificate of Rating – For completers of Alternative Learning System (ALS) OR PEPT. Photocopy /scanned copy will suffice if the applicant can present the original copy for comparison purposes.</li>
                    <li>Certification of Enrollment from the last school attended (most recent).</li>
                </ol>
                <h4>APPLICANTS WITH INCOMPLETE AND INCORRECT REQUIREMENTS WILL NOT BE ENTERTAINED.</h4>
            </ul>";
        break;

    case "Transferees":
        $requirements = "
            <ul class='custom-list' type='a'>
            <h3>Bring the following documents during your appointment.</h3>
                <strong>
                    <li>Transferee:</li>
                </strong>
                <ol class='rac-list' type='a'>
                    <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
                    <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the family name/surname of the husband</li>
                    <li>Hard copy two (2) 2x2 recent formal studio 'type' photo with nametag and signature</li>
                    <li>Certified true copy of Copy of Grades or Transcript of Records (Applicable only for Second Degree Transferees). Photocopy /scanned copy will suffice if the applicant can present the original copy for comparison purposes.</li>
                    <li>Certification of Enrollment from the last school attended (most recent) or presently enrolled in.</li>
                    <li>Certification of General Weighted Average (GWA) issued by the Registrar's Office/equivalent Office of your previous School.</li>
                </ol>
                <h4>APPLICANTS WITH INCOMPLETE AND INCORRECT REQUIREMENTS WILL NOT BE ENTERTAINED.</h4>
            </ul>";
        break;

    case "Second Degree":
        $requirements = "
            <ul class='custom-list' type='a'>
            <h3>Bring the following documents during your appointment.</h3>
                <strong>
                    <li>Second Degree:</li>
                </strong>
                <ol class='rac-list' type='a'>
                    <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
                    <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the family name/surname of the husband</li>
                    <li>Hard copy two (2) 2x2 recent formal studio 'type' photo with nametag and signature</li>
                    <li>Certified true copy of Copy of Grades or Transcript of Records (Applicable only for Second Degree Transferees).<br>Photocopy /scanned copy will suffice if the applicant can present the original copy for comparison purposes.</li>
                    <li>Photocopy/scanned copy of Grades or Transcript of Records for graduates Where BSU is the last school attended</li>
                    <li>Certification of Enrollment from the last school attended (most recent) or presently enrolled in.</li>
                    <li>Certification of General Weighted Average (GWA) issued by the Registrar's Office/equivalent Office of your previous School.</li>
                </ol>
                  <h4>APPLICANTS WITH INCOMPLETE AND INCORRECT REQUIREMENTS WILL NOT BE ENTERTAINED.</h4>
            </ul>";
        break;

    default:
        // Default case if no match is found.
        break;
}


// Output the requirements
echo $requirements;
?>
<style>

   h4 {
        color: red;
        margin-top: 10px;
        text-align: center;
    }
    .custom-list {
        list-style-type: none;
        padding-left: 0;
    }

    h3 {
        color: #333;
        text-align: center;
        font-size: 13px;
    }

    .custom-list > strong {
        font-weight: bold;
        color: #007bff;
    }

    .rac-list {
        list-style-type: lower-alpha;
        margin-top: 0;
        padding-left: 20px;
    }

    .rac-list > li {
        margin-bottom: 5px;
        font-size: 13px;
    }
</style>

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
            margin: 0.39,
            html2canvas: { scale:5},
            filename: 'Admission Form.pdf',
            jsPDF: {unit: 'in', format: [8.5, 13], orientation: 'portrait'},
            pagebreak: { before: '#page-containerr', avoid: '.avoid-this' }
        };
        html2pdf().set(opt).from(element).save();
    }
</script>
</html>
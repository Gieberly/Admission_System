<?php
session_start();
include("config.php");



$user_id = $_SESSION['user_id'];
// Check if user_id is undefined
if (!isset($user_id)) {
    // Redirect to register.php
    header("Location: register.php");
    exit();
}

// Fetch user data from the database
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();



// Check if the query was successful
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_name = $row['last_name'];
    $name = $row['name'];
    $mname = $row['mname'];
    $email = $row['email'];
} else {

    exit();
}

// Check if the user already has data in the admission_data table based on email
$sqlCheckData = "SELECT COUNT(*) as count FROM admission_data WHERE email = ?";
$stmtCheckData = $conn->prepare($sqlCheckData);
$stmtCheckData->bind_param("s", $email);
$stmtCheckData->execute();
$resultCheckData = $stmtCheckData->get_result();
$countData = $resultCheckData->fetch_assoc()['count'];

// Close the statement
$stmtCheckData->close();

if ($countData > 0) {
    // User has data, redirect to Student_Transaction_page.php
    header("Location: Student_Transaction_page.php");
    exit();
}
// Get the current year's last two digits
$currentYearLastTwoDigits = date('y');

// Fetch semester data from the table school_semester
$sqlSemester = "SELECT semester FROM school_semester WHERE id = 1"; // Assuming the semester data is in row with id = 1
$resultSemester = $conn->query($sqlSemester);

if ($resultSemester && $resultSemester->num_rows > 0) {
    $rowSemester = $resultSemester->fetch_assoc();
    $semester = $rowSemester['semester'];
} else {
    $semester = 0; // Default value if semester data is not found
}

// Generate the applicant number in the format YEAR-SEM-ID
$applicantNumber = sprintf("%02d-%d-%05d", $currentYearLastTwoDigits, $semester, $user_id);



// Fetch data from the academicclassification table for the Classification column
$sqlClassification = "SELECT DISTINCT Classification FROM academicclassification";
$resultClassification = $conn->query($sqlClassification);

// Fetch data from the ethnicity table for the ethnicity_name column
$sqlEthnicity = "SELECT DISTINCT ethnicity_name FROM ethnicity";
$resultEthnicity = $conn->query($sqlEthnicity);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['set_button_clicked'])) {
        // The "Set" button was clicked, do not process the form submission
        echo "Set button clicked. Form not submitted.";
        exit();
    }
    // Process form data
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
    $contact1_phone = $_POST['contact1_phone'];
    $relationship_1 = $_POST['relationship_1'];
    $contact_person_2 = $_POST['contact_person_2'];
    $contact_person_2_mobile = $_POST['contact_person_2_mobile'];
    $relationship_2 = $_POST['relationship_2'];
    $academic_classification = $_POST['academic_classification'];


    $high_school_name_address = $_POST['high_school_name_address'];
    $lrn = $_POST['lrn'];
    $degree_applied = $_POST['degree_applied'];
    $nature_of_degree = $_POST['nature_of_degree'];
    $applicant_number = $_POST['applicant_number'];
    $application_date = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['application_date'])));

    $rank = isset($_POST['rank']) ? $_POST['rank'] : null;  // Check if 'rank' key exists
    $result = isset($_POST['result']) ? $_POST['result'] : null;  // Check if 'result' key exists
    $college = $_POST['college'];

    // Check if a file was uploaded
    if (isset($id_picture) && $id_picture['error'] === UPLOAD_ERR_OK) {
        // Ensure the file is an image using exif_imagetype
        $allowed_types = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF);
        $detected_type = exif_imagetype($id_picture['tmp_name']);

        if (!in_array($detected_type, $allowed_types)) {
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
    $stmt = $conn->prepare("INSERT INTO admission_data (id_picture,  Name, Middle_Name, Last_Name, gender, birthdate, birthplace, age, 
    civil_status, citizenship, ethnicity, permanent_address, zip_code, phone_number, facebook, email, contact_person_1, 
    contact1_phone, relationship_1, contact_person_2, contact_person_2_mobile, relationship_2, academic_classification, 
    high_school_name_address, lrn, degree_applied, nature_of_degree, applicant_number, application_date, college) VALUES (?, ?, 
    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");

    // Bind parameters
    $stmt->bind_param(
        "sssssssissssiisssississsssssss",
        $id_picture_data,
        $Name,
        $Middle_Name,
        $Last_Name,
        $gender,
        $birthdate,
        $birthplace,
        $age,
        $civil_status,
        $citizenship,
        $ethnicity,
        $permanent_address,
        $zip_code,
        $phone_number,
        $facebook,
        $email,
        $contact_person_1,
        $contact1_phone,
        $relationship_1,
        $contact_person_2,
        $contact_person_2_mobile,
        $relationship_2,
        $academic_classification,
        $high_school_name_address,
        $lrn,
        $degree_applied,
        $nature_of_degree,
        $applicant_number,
        $application_date,
        $college,
    );


    // Execute the SQL statement
    if ($stmt->execute()) {
        echo "Form submitted successfully!";
        // Redirect the user to student.php or another appropriate page
        header("Location: ../Backend/Student_Appointment.php");
        exit();
    } else {
        echo "Error submitting form: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
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
    <link rel="icon" href="assets/images/BSU Logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="assets\css\studentform.css">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@20.1.0/build/css/intlTelInput.css">
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@20.1.0/build/js/intlTelInput.min.js"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.min.js"></script>


</head>

<body>
    <script>

    </script>
    <header class="header">
        <div class="logo-brand-container">
            <div class="logo">
                <img src="assets/images/BSU Logo1.png" alt="Logo">
            </div>
            <div class="brand">
                <p>Republic of the Philippines</p>
                <h1 style="font-family: algerian;">BENGUET STATE UNIVERSITY</h1>
                <p><i>OFFICE OF THE UNIVERSITY REGISTRAR</i></p>
                <p>La Trinidad, Benguet</p>
            </div>
        </div>
    </header>

    <form id="registrationForm" action="Student_Forms.php" method="POST" onsubmit="return checkEmail()" enctype="multipart/form-data">


        <div class="progress-bar">
            <span class="step" id="step-1">1</span>
            <span class="step-connector"></span>
            <span class="step" id="step-2">2</span>
            <span class="step-connector"></span>
            <span class="step" id="step-3">3</span>

        </div>

        <div class="tab" id="tab-1">
            <div class="page-container">
                <h2>GENERAL INSTRUCTIONS</h2>
                <p class="section-title"><strong><u></u></strong></p>
                <ol class="rac-list">
                    <li>Read and understand the Admission Guidelines and requirements before proceeding to the next step.</li>
                    <li>Fill out all the fields completely and accurately in this application form for admission.</li>
                    <li>Submit the Application form with complete requirements.</li>
                </ol>


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
                <br>
                <div class="message">

                    <h2>Program Guide for Requirments in Application</h2>
                    <div class="page-container">
                        <div class="form-container">
                            <div class="form-group">
                                <label class="small-label" for="categoryDropdown">Nature of Degree</label>
                                <?php
                                if (isset($_GET['degree'])) {
                                    $degree = $_GET['degree'];
                                    echo "<input type='text'class='input' id='categoryDropdown' name='nature_of_degree' value='$degree' readonly>";
                                } else {
                                    echo "<p>No degree information available.</p>";
                                }
                                ?>
                            </div>

                            <!-- Board Programs -->
                            <div class="form-group">

                                <label class="small-label" for="board-programs">Board Programs</label>
                                <?php
                                if (isset($_GET['Courses'])) {
                                    $Courses = $_GET['Courses'];
                                    echo "<input type='text' class='input' id='board-programs' name='board_programs' value='$Courses' readonly>";
                                } else {
                                    echo "<p>No program Courses available.</p>";
                                }
                                ?>
                            </div>



                            <div id="boardclassificationFields">
                                <label class="small-label" for="academic_classification_board">Academic Classification</label>
                                <select name="academic_classification" class="inputs" id="academic_classification_board" onchange="BoardRequirements()">
                                    <option value="">Select Academic Classification</option>
                                    <?php
                                    // Check if the query was successful
                                    if ($resultClassification && $resultClassification->num_rows > 0) {
                                        while ($rowClassification = $resultClassification->fetch_assoc()) {
                                            $classification = $rowClassification['Classification'];
                                            echo "<option value=\"$classification\">$classification</option>";
                                        }
                                    } else {
                                        echo "<option value=\"\">No classifications found</option>";
                                    }
                                    ?>
                                </select>
                            </div>



                        </div>
                        <br>
                        <div id="classificationInfo"></div>



                    </div>

                    <p class="note-color"><label class="checkbox-container">
                            <input type="checkbox" id="read-guidelines" required>
                            <span class="checkmark"></span> NOTE: CHECK AND PROCEED ONLY TO THE NEXT STEP IF ALL REQUIREMENTS ARE COMPLETE, INCOMPLETE REQUIREMENTS WILL NOT BE ENTERTAINED!</p>
                    </label>

                </div>

                <div class="index-btn-wrapper" id="index-btn-wrapper">
                    <div class="index-btn" onclick="run(1,2);">Next</div>
                </div>
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
                <input type="file" name="id_picture" id="id_picture" accept="image/*" required>

                <p class="binformation"> Background Information of Applicant</p>
                <p class="personal_information"> Personal Information</p>

                <div class="form-container">
                    <!-- Full name -->
                    <div class="form-group">
                        <label class="small-label" for="Last_Name">Last Name<span style="color: red; font-weight: bold;">*</span></label>
                        <input type="text" name="Last_Name" class="input" id="last_name" placeholder="e.g. Dela Cruz" value="<?php echo $last_name; ?>" required>
                        <div class="note" id="last_name_note">e.g. Dela Cruz</div>
                    </div>

                    <div class="form-group">
                        <label class="small-label" for="Name">First Name<span style="color: red; font-weight: bold;">*</span></label>
                        <input type="text" name="Name" class="input" id="first_name" placeholder="e.g. Mario Jr." value="<?php echo $name; ?>" autocomplete="name" required>
                        <div class="note" id="first_name_note">e.g. Mario Jr.</div>
                    </div>

                    <div class="form-group">
                        <label class="small-label" for="Middle_Name">Middle Name</label>
                        <input type="text" name="Middle_Name" class="input" id="middle_name" placeholder="Middle Name" autocomplete="middle" value="<?php echo $mname; ?>">
                        <div class="note" id="middle_name_note">e.g. Lim</div>
                    </div>

                    <!-- Sex at Birth -->
                    <div class="form-group">
                        <label class="small-label" for="gender">Sex at birth<span style="color: red; font-weight: bold;">*</span></label>
                        <select name="gender" class="input" id="gender" required>
                            <option value="" disabled selected>Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <!-- Birthdate -->
                    <div class="form-group">
                        <label class="small-label" for="birthdate">Birthdate<span style="color: red; font-weight: bold;">*</span></label>
                        <!-- <input type="date" name="birthdate" class="input" id="birthdate" required oninput="calculateAge();"> -->
                        <input type="date" name="birthdate" class="input" id="birthdate" required oninput="validateBirthdate(); calculateAge();">
                        <div id="birthdateError" style="color: red; font-size: 12px; display: none;">Age must be at least 10 years old.</div>
                    </div>
                    <!-- Age -->
                    <div class="form-group">
                        <label class="small-label" for="age">Age<span style="color: red; font-weight: bold;">*</span></label>
                        <input type="text" pattern="[0-9]*" name="age" class="input" id="age" placeholder="Age" required maxlength="2" required oninput="this.value = this.value.replace(/[^0-9]/g, ''); calculateAge();">
                    </div>
                </div>

                <div class="form-container">
                    <!-- civil status -->
                    <div class="form-group">
                        <label class="small-label" for="civil_status">Civil Status<span style="color: red; font-weight: bold;">*</span></label>
                        <select name="civil_status" class="input" id="civil_status" required>
                            <option value="" disabled selected>Select Civil Status</option>
                            <option value="single">Not Married</option>
                            <option value="married">Married</option>
                        </select>
                    </div>
                    <!-- Citizenship -->
                    <div class="form-group">
                        <label class="small-label" for="citizenship">Citizenship<span style="color: red; font-weight: bold;">*</span></label>
                        <input type="text" name="citizenship" class="input" id="citizenship" placeholder="Citizenship" required maxlength="28">
                        <div class="note" id="citizenship_note">e.g. Filipino</div>
                    </div>
                    <!-- Ethnicity-->
                    <div class="form-group">
                    <label class="small-label" for="ethnicity">Ethnicity<span style="color: red; font-weight: bold;">*</span></label>
                        <select name="ethnicity" class="input" id="ethnicity" maxlength="28" required onchange="handleEthnicityChange()">
                            <option value="" disabled selected>Select Ethnicity</option>
                            <?php
                                    // Check if the query was successful
                                    if ($resultEthnicity && $resultEthnicity->num_rows > 0) {
                                        while ($rowEthnicity = $resultEthnicity->fetch_assoc()) {
                                            $ethnicity = $rowEthnicity['ethnicity_name'];
                                            echo "<option value=\"$ethnicity\">$ethnicity</option>";
                                        }
                                    } else {
                                        echo "<option value=\"\">No Ethnicity found</option>";
                                    }
                                    ?>
                                <option value="others">Others</option>
                        </select>
                    </div>
                </div>

                <!-- Birthplace -->
                <p class="personal_information">Birthplace</p>
                <div class="form-container">
                    <div class="form-group">
                        <label class="small-label" for="Country_birthplace">Country<span style="color: red; font-weight: bold;">*</span></label>
                        <select name="Country_birthplace" class="input country" id="Country_birthplace" required onchange="loadStates()" onchange="updateBirthplace()">
                            <option value="" disabled selected>Select Country</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="small-label" for="Province_birthplace">Province<span style="color: red; font-weight: bold;">*</span></label>
                        <select name="Province_birthplace" class="input state" id="Province_birthplace" required onchange="loadCities()" onchange="updateBirthplace()">
                            <option value="" disabled selected>Select Province</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="small-label" for="Municipality_birthplace">Municipality/City<span style="color: red; font-weight: bold;">*</span></label>
                        <select name="Municipality_birthplace" class="input city" id="Municipality_birthplace" required onchange="updateBirthplace()">
                            <option value="" disabled selected>Select Municipality/City</option>
                        </select>
                    </div>
                </div>

                <p class="personal_information">Permanent Home Address</p>
                <div class="form-container2">
                    <!-- Permanent Address -->
                    <div class="form-group">
                        <label class="small-label" for="permanent_address">Address<span style="color: red; font-weight: bold;">*</span></label>
                        <input type="text" class="input" name="permanent_address" id="permanent_address" placeholder="House # & Street, Barangay/Subdivision, Municipality(town)/City, Province, Country/State" required>
                        <div class="note" id="permanent_address_note">e.g. 01-A, Balili, La Trinidad, Benguet, Philippines</div>
                    </div>
                </div>

                <!-- zip-code -->
                <div class="form-container">
                <div class="form-group">
                    <label class="small-label" for="zip_code">Zip Code</label>
                    <input type="text" pattern="[0-9]*" name="zip_code" class="input" id="zip_code" placeholder="Zip Code" required maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    <div class="note" id="zip_code_note">e.g. 2601</div>
                </div>
                </div>

                <p class="personal_information">Contact Information</p>
                <div class="form-container">
                    <!-- Telephone/Mobile No -->
                    <div class="form-group">
                        <label class="small-label" for="phone_number">Telephone/Mobile No.<span style="color: red; font-weight: bold;">*</span></label>
                        <input type="tel" name="phone_number" class="input" id="phone_number" placeholder="Enter phone number" autocomplete="number" maxlength="15">
                        <div class="note" id="phone_number_note">e.g. 09091010222</div>
                    </div>

                    <!-- Facebook Account Name -->
                    <div class="form-group">
                        <label class="small-label" for="facebook">Facebook Account Name<span style="color: red; font-weight: bold;">*</span></label>
                        <input type="text" name="facebook" class="input" id="facebook" placeholder="account should be your name" required>
                        <div class="note" id="facebook_note">e.g. Mario Lim Dela Cruz Jr.</div>
                    </div>
                    <!--Email Address -->
                    <div class="form-group">
                        <label class="small-label" for="email">Email Address<span style="color: red; font-weight: bold;">*</span></label>
                        <input type="text" name="email" class="input" id="email" placeholder="Enter active email address" value="<?php echo $email; ?>" autocomplete="email:" required oninput="validateEmail()" readonly>
                        <p id="email-error" style="color: red;"></p>
                    </div>

                </div>
                <p class="personal_information">Contact person(s) in case of emergency</p>

                <div class="form-container">
                    <!-- Contact Person 1 -->
                    <div class="form-group">
                        <label class="small-label" for="contact_person_1">Contact Person<span style="color: red; font-weight: bold;">*</span></label>
                        <input type="text" name="contact_person_1" class="input" id="contact_person_1" placeholder="Full Name of Contact Person" required>
                        <div class="note" id="contact_person_1_note">e.g. Juana Dela Cruz</div>
                    </div>
                    <div class="form-group">
                        <label class="small-label" for="contact1_phone">Mobile Number<span style="color: red; font-weight: bold;">*</span></label>
                        <input type="tel" name="contact1_phone" class="input" id="contact1_phone" placeholder="Enter mobile number" required oninput="validatePhoneNumber('contact1_phone')" maxlength="15">
                        <div class="note" id="contact1_phone_note">e.g. 09101112222</div>
                        <p id="contact1_phone-error" style="color: red;"></p>
                    </div>
                    <div class="form-group">
                        <label class="small-label" for="relationship_1">Relationship w/ Contact Person<span style="color: red; font-weight: bold;">*</span></label>
                        <select name="relationship_1" class="input custom-dropdown" id="relationship_1" required>
                            <option value="" disabled selected>Select Relationship</option>
                            <option value="Parent">Parent</option>
                            <option value="Guardian">Guardian</option>

                        </select>
                    </div>
                </div>
                <div class="form-container">
                    <!-- Contact Person 2 -->
                    <div class="form-group">
                        <label class="small-label" for="contact_person_2">Contact Person</label>
                        <input type="text" name="contact_person_2" class="input" id="contact_person_2" placeholder="Full Name of Contact Person">
                        <div class="note" id="contact_person_2_note">e.g. Juan Dela Cruz</div>
                    </div>
                    <div class="form-group">
                        <label class="small-label" for="contact_person_2_mobile">Mobile Number</label>
                        <input type="tel" name="contact_person_2_mobile" class="input" id="contact_person_2_mobile" placeholder="Enter mobile number" oninput="validatePhoneNumber('contact_person_2_mobile')" maxlength="15">
                        <div class="note" id="contact_person_2_mobile_note">e.g. 09102223333</div>
                        <p id="contact_person_2_mobile-error" style="color: red;"></p>
                    </div>
                    <div class="form-group">
                        <label class="small-label" for="relationship_2">Relationship w/ Contact Person</label>
                        <select name="relationship_2" class="input custom-dropdown" id="relationship_2">
                            <option value="" disabled selected>Select Relationship</option>
                            <option value="Parent">Parent</option>
                            <option value="Guardian">Guardian</option>

                        </select>
                    </div>
                </div>

                <p class="personal_information">Academic Classification</p>
                <div class="form-container">
                    <!-- Academic Classification -->
                    <div class="form-group">
                        <label class="small-label" for="academic_classification">Academic Classification<span style="color: red; font-weight: bold;">*</span></label>
                        <input type="text" name="academic_classification" class="input" id="academic_classification" readonly required>
                    </div>
                </div>
                <p class="personal_information">Academic Background </p>
                <div class="form-container3">
                    <!-- Academic Background -->
                    <div class="form-group2">
                        <label class="small-label" for="high_school_name_address">Last School Attended<span style="color: red; font-weight: bold;">*</span></label>
                        <input type="text" name="high_school_name_address" class="input" id="high_school_name_address" required placeholder="Enter Name and Address">
                        <div class="note" id="high_school_name_address_note">e.g. Benguet National high School/Wangal, La Trinidad, Benguet</div>
                    </div>
                </div>

                <div class="form-container">
                    <div class="form-group">
                        <label class="small-label" for="lrn" style="white-space: nowrap;">Learner's Reference Number</label>
                        <input type="text" name="lrn" class="input" id="lrn" placeholder="Enter LRN" oninput="validateLRN(this)">
                        <div class="note" id="lrn_note">e.g. 157936123439</div>
                    </div>


                    <div class="form-group">
                        <label class="small-label" for="degree_applied">Program<span style="color: red; font-weight: bold;">*</span></label>
                        <!-- Display the selected program in this input field -->


                        <?php
                        if (isset($_GET['Courses'])) {
                            $Courses = $_GET['Courses'];
                            echo "<input type='text' name='degree_applied' class='input' id='degree_applied'  value='$Courses' readonly>";
                        } else {
                            echo "<p>No program Courses available.</p>";
                        }
                        ?>
                    </div>


                    <div class="form-group">
                        <label class="small-label" for="nature_of_degree" style="white-space: nowrap;">Nature of degree<span style="color: red; font-weight: bold;">*</span></label>

                        <?php
                        if (isset($_GET['degree'])) {
                            $degree = $_GET['degree'];
                            echo "<input type='text' name='nature_of_degree' class='input' id='nature_of_degree' value='$degree' readonly>";
                        } else {
                            echo "<p>No degree information available.</p>";
                        }
                        ?>
                    </div>
                </div>

                <br><br>

                <!-- Inside your HTML form (admissionform.html), add the following lines where you see fit, perhaps after the signature pad for the student -->


            </div>


            <div class="applicant_number" style="display: none;">
                <label for="applicant_number" class="applicant_number">Applicant Number:</label>
                <input type="text" name="applicant_number" id="applicant_number" readonly value="<?php echo $applicantNumber; ?>">
            </div>
   
            <div class="form-group" style="display: none;">

                <div class="form-group">
                    <label class="small-label" for="college">Selected College</label>
                    <?php
                    if (isset($_GET['college'])) {
                        $college = $_GET['college'];
                        echo "<input type='text' class='input' id='selectedCollege' name='college' value='$college' readonly>";
                    } else {
                        echo "<p>No college information available.</p>";
                    }
                    ?>
                </div>

            </div>

            <div class="applicant_number" style="display: none;">
                <label for="application_date"><strong>DATE OF APPLICATION:</strong></label>
                <input type="date" name="application_date" class="input" id="application_date" value="<?php echo date('Y-m-d'); ?>" required>
            </div>
            <div class="form-group">
                        <label class="small-label" for="birthplace" style="display: none;">Birthplace<span style="color: red; font-weight: bold;">*</span></label>
                        <input type="text" name="birthplace" class="input" id="birthplace" placeholder="Municipality/City, Province, Country" required style="display: none;" value="">
                    </div>

            <div class="index-btn-wrapper">
                <div class="index-btn" onclick="run(2, 1);">Previous</div>
                <div class="index-btn" onclick="run(2, 3);">Next</div>
            </div>
        </div>
        <!--Tab 3-->
        <div class="tab" id="tab-3">
            <br>
            <h2></h2>
            <div class="page-container">
                <p class="note-color" style=" text-align: center;"> <span class="checkmark"></span>SUBMIT ONLY THE FORM IF ALL REQUIREMENTS ARE COMPLETE, INCOMPLETE AND INCORRECT REQUIREMENTS WILL NOT BE ENTERTAINED.</p>
                <p>Make sure that you read and understood all the instructions contained in this Application form and that the information supplied are true, complete and accurate. Be aware that any information that have concealed, falsely given and/or withheld is enough basis for the invalidation/cancellation of your application. </p>
                <p style="color: green; font-weight: bold; text-align: center; font-size: 16px">After Submission, set your appointment and print the admission form during your appointment date with the needed requirements.</p>
            </div>



            <div class="index-btn-wrapper">
                <div class="index-btn" onclick="run(3, 2);">Previous</div>
                <button class="index-btn" type="submit" name="submit" style="background: blue;">Submit</button>
            </div>
        </div>

        </div>
        </div>


    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
    <script src="assets\js\studentform.js"></script>
    <script src="CountryStateCity.js"></script>
    <!-- <script>
        const input = document.querySelector("#phone_number");
        window.intlTelInput(input, {
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@20.1.0/build/js/utils.js",
    });
    </script> -->
</body>

</html>
<?php
include("config.php");

session_start();

// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'student') {
    header("Location: loginpage.php");
    exit();
}

// Retrieve the student's information from the users table
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

// Display the student's and admission data
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="icon" href="assets/images/BSU Logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/student.css" />
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="assets\js\jspdf.min.js"></script>
<!-- Include the pdf.js library -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <img class="bsulogo" src="assets/images/BSU Logo1.png" alt="BSU LOGO">
            <span class="text">Student</span>
        </a>

        <ul class="side-menu top">
            <li class="active">
                <a href="#" id="profile-link">
                    <i class='bx bxs-group'></i>
                    <span class="text">Profile</span>
                </a>
            </li>

            <li class="">
                <a href="#" id="student-profile-link">
                    <i class='bx bxs-megaphone'></i>
                    <span class="text">Announcements</span>
                </a>
            </li>

            <li class="">
                <a href="#" id="student-result-link">
                    <i class='bx bxs-window-alt'></i>
                    <span class="text">Student Result</span>
                </a>
            </li>




        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
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
                <img src="assets/images/human icon.png" alt="User Profile" id="profile-image">
            </a>


        </nav>


        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div id="dashboard-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Announcement</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Announcement</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="student.html">Home</a></li>
                        </ul>
                    </div>
                </div>

                <ul class="box-info">
                    <li id="available-box" class="box-icon">
                        <i class='bx bx-clipboard'></i>
                        <span class="text">
                            <h3>1020</h3>
                            <p>Available Slots</p>
                        </span>
                    </li>



                    <li id="readmitted-box">
                        <i class='bx bx-calendar'></i>
                        <span class="text">

                            <p>Readmission Date</p>
                        </span>
                    </li>

                    <li id="nonqualified-box">
                        <i class='bx bx-calendar'></i>
                        <span class="text">

                            <p>Releasing of Result Date</p>
                        </span>
                    </li>


                </ul>

                <!--Available Slots-->
                <div id="available-slot">
                    <div class="table-data">
                        <div class="order">
                            <div class="head">
                                <h3>Available Slots</h3>

                            </div>
                            <table id="available-table">
                                <thead>
                                    <tr data-college="CIS">
                                        <th>Program</th>
                                        <th>College</th>
                                        <th>Total Slots</th>
                                        <th>Available Slots</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>Bachelor of Science in Agriculture (BSA)</p>
                                        </td>
                                        <td>College of Agriculture</td>

                                        <td>100</td>
                                        <td>50</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Bachelor of Science in Agribusiness (BSAB)</p>
                                        </td>
                                        <td>College of Agriculture</td>

                                        <td>100</td>
                                        <td>50</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Bachelor of Secondary Education (BSE)</p>
                                        </td>
                                        <td>College of Teacher Education</td>

                                        <td>100</td>
                                        <td>50</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Bachelor of Elementary Education (BEE)</p>
                                        </td>
                                        <td>College of Teacher Education</td>

                                        <td>100</td>
                                        <td>50</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Bachelor of Early Childhood Education</p>
                                        </td>
                                        <td>College of Teacher Education</td>

                                        <td>100</td>
                                        <td>50</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Bachelor of Early Childhood Education</p>
                                        </td>
                                        <td>College of Teacher Education</td>

                                        <td>100</td>
                                        <td>50</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Bachelor of Technology and Livelihood Education</p>
                                        </td>
                                        <td>College of Teacher Education</td>

                                        <td>100</td>
                                        <td>50</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Bachelor of Arts in Communication</p>
                                        </td>
                                        <td>College of Arts and Humanities</td>

                                        <td>100</td>
                                        <td>50</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Bachelor of Arts in English Language</p>
                                        </td>
                                        <td>College of Arts and Humanities</td>

                                        <td>100</td>
                                        <td>50</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Bachelor of Arts in Filipino Language</p>
                                        </td>
                                        <td>College of Arts and Humanities</td>

                                        <td>100</td>
                                        <td>50</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Bachelor of Science in Biology</p>
                                        </td>
                                        <td>College of Natural Sciences</td>

                                        <td>100</td>
                                        <td>50</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Bachelor of Science in Environmental Science</p>
                                        </td>
                                        <td>College of Natural Sciences</td>

                                        <td>100</td>
                                        <td>50</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Bachelor of Science in Mathematics</p>
                                        </td>
                                        <td>College of Numeracy and Applied Sciences</td>

                                        <td>100</td>
                                        <td>50</td>
                                    </tr>

                                </tbody>

                            </table>
                            <button id="see-more-button">
                                See More <i class='bx bx-chevrons-right'></i>
                            </button>

                        </div>
                    </div>
                </div>
                <div id="readmission-announce" style="display: none;">
                    <div class="table-data">
                        <div class="order">
                            <div class="head">
                                <h3>Readmission Date</h3>
                            </div>
                            <div>Readmission will start January 1- to 29</div>
                        </div>
                    </div>
                </div>
                <div id="releasing-annouce" style="display: none;">
                    <div class="table-data">
                        <div class="order">
                            <div class="head">
                                <h3>Releasing Of Result</h3>
                            </div>
                            <div>
                                <p class="result-status-dets">PLEASE BE INFORMED THAT BSU ADMISSION 2023-2024 RESULTS
                                    ARE NOT YET AVAILABLE</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!--Student Profile-->
            <div id="student-profile-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Profile</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Profile</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="student.html">Home</a></li>
                        </ul>
                    </div>
                    <a href="#" class="btn-download" onclick="generatePDF()">
            <i class='bx bxs-cloud-download'></i>
            <span class="text">Download PDF</span>
        </a>
    
                </div>
                <!--profile-->
                <div id="student-profile">
                    <div class="table-data">
                        <div class="order">
                            <div class="order-profile">
                                <div class="profile-result">
                                    <form action="">



                                        <div class="Picture">
                                            <h2 class="pi">Personal Information</h2>
                                            <div id="date-of-application"><?php echo $admissionData['application_date']; ?></div>
                                            <br>
                                            <div id="result-id-picture"><img src="<?php echo $admissionData['id_picture']; ?>" alt="ID Picture"></div>

                                        </div>

                                        <div class="profile-info-content">

                                            <div class="column">
                                                <p class="fnp">
                                                <strong>Full Name</strong><br>
                                                    <span id="result-Full-Name"><?php echo $admissionData['applicant_name']; ?></span>
                                                    
                                                </p>
                                            </div>
                                            <div class="column">
                                                <p class="genderp">
                                                    <strong>Gender at birth:</strong><br>
                                                    <span id="result-Gender"><?php echo $admissionData['gender']; ?></span>
                                                </p>
                                            </div>
                                            <div class="column">
                                                <p class="bdate">
                                                    <strong>Birthdate:</strong><br>
                                                    <span id="result-Birthdate"><?php echo $admissionData['birthdate']; ?></span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="profile-info-content">
                                            <div class="column">
                                                <p>
                                                    <strong>Birthplace:</strong><br>
                                                    <span id="result-City"><?php echo $admissionData['birthplace']; ?></span>,
                                               </p>
                                            </div>

                                            <div class="column">
                                                <p>
                                                    <strong>Age:</strong><br>
                                                    <span id="result-Age"><?php echo $admissionData['age']; ?></span>
                                                </p>
                                            </div>
                                            <div class="column">
                                                <p>
                                                    <strong>Civil Status:</strong><br>
                                                    <span id="result-Civil"> <?php echo $admissionData['civil_status']; ?></span>
                                                </p>
                                            </div>
                                            <div class="column">
                                                <p>
                                                    <strong>Citizenship:</strong><br>
                                                    <span id="result-Citizenship"><?php echo $admissionData['citizenship']; ?></span>
                                                </p>
                                            </div>
                                            <div class="column">
                                                <p>
                                                    <strong>Nationality:</strong><br>
                                                    <span id="result-Nationality"><?php echo $admissionData['nationality']; ?></span>
                                                </p>
                                            </div>
                                        </div>
                                        <p class="content-header"><strong>Permanent Home Address</strong></p>
                                        <br>
                                        <div class="profile-info-twos">

                                            <div class="column">

                                                <p class="ContactInfo"> <strong>Address:</strong><br>

                                                <?php echo $admissionData['permanent_address']; ?>
                                                </p>

                                            </div>

                                            <div class="column">
                                                <p>
                                                    <strong>Zip Code:</strong><br>
                                                    <span id="result-ZipCode"> <?php echo $admissionData['zip_code']; ?></span>
                                                </p>
                                            </div>
                                        </div>
                                        <br>
                                        <p class="content-header">
                                            <strong>Contact Information</strong>
                                        </p>

                                        <div class="profile-info-twos">
                                            <div class="column">
                                                <p>
                                                    <strong>Telephone/Mobile No.:</strong>
                                                    <span id="result-Telephone"><?php echo $admissionData['phone']; ?></span>
                                                </p>


                                                <p>
                                                    <strong>Facebook Account Name:</strong>
                                                    <span id="result-Facebook"><?php echo $admissionData['facebook']; ?></span>
                                                </p>

                                                <p>
                                                    <strong>Email Address:</strong>
                                                    <span id="result-Email"> <?php echo $admissionData['email']; ?></span>
                                                </p>
                                            </div>
                                        </div>
                                        <p class="content-header">
                                            <strong>Contact Persons</strong>
                                        </p>
                                        <div class="profile-info-twos">
                                            <div class="column">



                                                <p>
                                                    <strong>Contact Person:</strong>
                                                    <span id="result-ContactOne"><?php echo $admissionData['contact_person_1']; ?></span>
                                                </p>

                                                <p>
                                                    <strong>Mobile Number:</strong>
                                                    <span id="result-NumberOne"><?php echo $admissionData['contact_person_1_mobile']; ?></span>
                                                </p>

                                                <p>
                                                    <strong>Relationship:</strong>
                                                    <span id="result-RelationshipOne"><?php echo $admissionData['relationship_1']; ?></span>
                                                </p>
                                            </div>
                                            <div class="column">
                                                <p>
                                                    <strong>Contact Person:</strong>
                                                    <span id="result-ContactTwo"> <?php echo $admissionData['contact_person_2']; ?></span>
                                                </p>

                                                <p>
                                                    <strong>Mobile Number:</strong>
                                                    <span id="result-NumberTwo"><?php echo $admissionData['contact_person_2_mobile']; ?></span>
                                                </p>

                                                <p>
                                                    <strong>Relationship:</strong>
                                                    <span id="result-RelationshipTwo"><?php echo $admissionData['relationship_2']; ?></span>
                                                </p>

                                            </div>
                                            <div class="column">
                                                <p class="content-header">
                                                    <strong>Academic Classification:</strong>
                                                    <span id="result-classification"><?php echo $admissionData['academic_classification']; ?></span>
                                                </p>
                                            </div>
                                        </div>
                                        <p class="content-header">
                                            <strong>Academic Background</strong>
                                        </p>

                                        <div class="profile-info-one">
                                            <div class="column">
                                                <p>
                                                    <strong>Name and Address of High School/Senior High School:</strong>
                                                    <span id="high_school_name_address"> <?php echo $admissionData['high_school_name_address']; ?></span>
                                                </p>

                                                <p>
                                                    <strong>Name and Address of Division where ALS/PEPT was
                                                        taken:</strong>
                                                    <span id="result-ALS"><?php echo $admissionData['als_pept_name_address']; ?></span>
                                                </p>

                                                <p>
                                                    <strong>Name and Address of College/University:</strong>
                                                    <span id="college_name_address"> <?php echo $admissionData['college_name_address']; ?></span>
                                                </p>
                                                <p>
                                                    <strong>Learner's Reference Number:</strong>
                                                    <span id="result-LRN"><?php echo $admissionData['lrn']; ?></span>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="profile-info-twos">

                                            <div class="column">
                                                <p>
                                                    <strong>Degree:</strong>
                                                    <span id="result-Degree"><?php echo $admissionData['degree_applied']; ?></span>
                                                </p>
                                            </div>
             
                                            <div class="column">
                                                <p>
                                                    <strong>Nature of degree:</strong>
                                                    <span id="result-natureDegree"><?php echo $admissionData['nature_of_degree']; ?></span>
                                                </p>

                                            </div>
                                        </div>
                                        

                                    

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- Student Result -->
            <div id="student-result-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Result</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Result</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="student.html">Home</a></li>
                        </ul>
                    </div>

                </div>
                <!--result(NOA)-->
                <div id="student-result">
                    <div class="table-data">
                        <div class="order">

                            <div class="StudentResult-Content">
                                <div id="StudentResult-picture" class="student-picture"><img src="<?php echo $admissionData['id_picture']; ?>" alt="ID Picture">
                                </div>

                                <div class="result-info">
                                    <div class="result-style">
                                        <p class="result-p">
                                            <strong>Applicant Name:</strong>
                                            <span id="result-ApplicantName" class="applicant-name"><?php echo $admissionData['applicant_name']; ?></span>
                                        </p>
                                    </div>

                                    <div class="result-style">
                                        <p class="result-p">
                                            <strong>Applicant Number:</strong>
                                            <span id="result-ApplicantNumber" class="applicant-number"><?php echo $admissionData['applicant_number']; ?> </span>
                                        </p>
                                    </div>


                                    <div class="result-style">
                                        <p class="result-p">
                                            <strong>Program:</strong>
                                            <span id="result-Program" class="program-info"><?php echo $admissionData['degree_applied']; ?></span>
                                        </p>
                                    </div>

                                    <div class="result-style">
                                        <p class="result-p">
                                            <strong>Status of Result:</strong>
                                            <a href="#" id="Pending" class="status-pending">Pending</a>
                                        </p>
                                    </div>
                                    
                                </div>
                            </div>


                        </div>
                    </div>


                </div>



        </main>
        <!-- MAIN -->



    </section>





    <!-- Add the profile popup container here -->
    <div class="profile-popup" id="profile-popup">
        <!-- Popup content -->
        <div class="popup-content" id="profile-content">
            <div class="profile-header">
                <img src="assets/images/human icon.png" alt="User Profile Picture" class="profile-picture" id="profile-picture">
                <p class="profile-name" id="applicant-name"><?php echo $studentData['name']; ?></p>
            </div>
           

            <hr>
            <div class="profile-menu">
                <a href="#" id="settings" class="profile-item"> <i class='bx bx-sun'></i>Display</a>

                <div class="dropdown" id="settings-dropdown">
                    <a href="#">Dark Mode
                        <input type="checkbox" id="switch-mode" hidden>
                        <label for="switch-mode" class="switch-mode"></label></a>

  

                </div>
                <a href="StudentProfileEdit.php" id="settings" class="profile-item" ><i class='bx bx-cog'></i> Settings</a>              

          
                <a href="#" id="help" class="profile-item"><i class='bx bx-question-mark'></i> Help and Support</a>
<div class="dropdown" id="help-dropdown">
                   <!-- Content for Help and Support dropdown -->
                  <!-- Trigger for the FAQ pop-up -->
<a href="faq_page.html" onclick="openPopup('faq-popup')">FAQ </a>
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



        <!-- CONTENT -->
        <script src="assets/js/student.js"></script>
</body>

</html>
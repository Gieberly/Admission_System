<?php

include("config.php");
include("studentcover.php");

// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Student') {
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
    <section id="content">
    <main>
  <!--Student Profile-->

  <?php
$studentId = $_SESSION['user_id'];
$stmtUser = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmtUser->bind_param("i", $studentId);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$studentData = $resultUser->fetch_assoc();

?>
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
                           
                    <?php
                    $studentId = $_SESSION['user_id'];
                    $stmtUser = $conn->prepare("SELECT * FROM users WHERE id = ?");
                    $stmtUser->bind_param("i", $studentId);
                    $stmtUser->execute();
                    $resultUser = $stmtUser->get_result();
                    $studentData = $resultUser->fetch_assoc();

                    ?>
                    <p align="right">
                        <a href="download.php?user_id=<?php echo $_SESSION['user_id'];?>" ><input type="button" class="btn-calendar" value="Generate Application Form"></input></a></p>
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
    </main></section>
    </body>
</html>
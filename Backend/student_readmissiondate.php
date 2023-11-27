<?php

include("config.php");
include("studentcover.php");

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
            <section id="content">
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
                            <a href="studentannouncement_sidebar.php">
                            <span class="text">
                                <h3>1020</h3>
                                <p>Available Slots</p>
                            </span></a>
                        </li>



                        <li id="readmitted-box" class="box-icon">
                            <a href="student_readmissiondate.php">
                            <i class='bx bx-calendar'></i>
                            <span class="text">

                                <p>Readmission Date</p>
                            </span></a>
                        </li>

                        <li id="nonqualified-box" class="box-icon">
                        <a href="student_releasingAnnounce.php">
                            <i class='bx bx-calendar'></i>
                            <span class="text">

                                <p>Releasing of Result Date</p>
                            </span></a>
                        </li>


                    </ul>

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
                </div>
                </main>
            </section>
    </body>
</html>
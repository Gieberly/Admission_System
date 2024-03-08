<?php

include("config.php");
include("Student_Cover.php");

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
       <!-- MAIN -->
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
                        <span class="text">
                            <h3>1020</h3>
                            <p>Available Slots</p>
                        </span>
                    </li>



                    <li id="readmitted-box" class="box-icon">
                        <a href="student_readmissiondate.php">
                            <i class='bx bx-calendar'></i>
                            <span class="text">

                                <p>Readmission Date</p>
                            </span>
                        </a>
                    </li>

                    <li id="nonqualified-box" class="box-icon">
                        <a href="student_releasingAnnounce.php">
                            <i class='bx bx-calendar'></i>
                            <span class="text">

                                <p>Releasing of Result Date</p>
                            </span>
                        </a>
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
                                a
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
       </main>
       </section>
</body>
</html>
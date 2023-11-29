<?php

include("config.php");
include("facultyCover.php");


// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Faculty') {
    header("Location: loginpage.php");
    exit();
}

// Fetch user's department
$userId = $_SESSION['user_id'];
$fetchDepartmentQuery = "SELECT Department FROM users WHERE id = ?";
$stmtFetchDepartment = $conn->prepare($fetchDepartmentQuery);
$stmtFetchDepartment->bind_param("i", $userId);
$stmtFetchDepartment->execute();
$stmtFetchDepartment->bind_result($department);
$stmtFetchDepartment->fetch();
$stmtFetchDepartment->close();

// Fetch Overall_Slots for the user's department
$fetchOverallSlotsQuery = "SELECT Overall_Slots FROM programs WHERE Description = ?";
$stmtFetchOverallSlots = $conn->prepare($fetchOverallSlotsQuery);
$stmtFetchOverallSlots->bind_param("s", $department);
$stmtFetchOverallSlots->execute();
$stmtFetchOverallSlots->bind_result($overallSlots);
$stmtFetchOverallSlots->fetch();
$stmtFetchOverallSlots->close();

// Fetch the count of students without a result in the faculty's department
$fetchStudentCountQuery = "SELECT COUNT(*) FROM admission_data WHERE degree_applied = ? AND (Result IS NULL OR Result NOT IN ('NOR', 'NOA'))";
$stmtFetchStudentCount = $conn->prepare($fetchStudentCountQuery);
$stmtFetchStudentCount->bind_param("s", $department);
$stmtFetchStudentCount->execute();
$stmtFetchStudentCount->bind_result($studentCountForAdmission);
$stmtFetchStudentCount->fetch();
$stmtFetchStudentCount->close();

// Fetch the count of students with the result 'NOA' in the faculty's department
$fetchAdmittedStudentCountQuery = "SELECT COUNT(*) FROM admission_data WHERE degree_applied = ? AND Result = 'NOA'";
$stmtFetchAdmittedStudentCount = $conn->prepare($fetchAdmittedStudentCountQuery);
$stmtFetchAdmittedStudentCount->bind_param("s", $department);
$stmtFetchAdmittedStudentCount->execute();
$stmtFetchAdmittedStudentCount->bind_result($admittedStudentCount);
$stmtFetchAdmittedStudentCount->fetch();
$stmtFetchAdmittedStudentCount->close();

// Fetch the count of students with the result 'NOR' in the faculty's department
$fetchNORStudentCountQuery = "SELECT COUNT(*) FROM admission_data WHERE degree_applied = ? AND Result = 'NOR'";
$stmtFetchNORStudentCount = $conn->prepare($fetchNORStudentCountQuery);
$stmtFetchNORStudentCount->bind_param("s", $department);
$stmtFetchNORStudentCount->execute();
$stmtFetchNORStudentCount->bind_result($NORStudentCount);
$stmtFetchNORStudentCount->fetch();
$stmtFetchNORStudentCount->close();


$conn->close();



?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BSU OUR Admission Unit Personnel</title>
    <link rel="icon" href="assets/images/BSU Logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css//personnel.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <section id="content">
        <main>
            <!--Dashboard-->
            <div id="dashboard-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Dashboard</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="facultydashboard.php">Home</a></li>
                        </ul>
                    </div>
                </div>

                <ul class="box-info">
                    <li id="available-box">
                        <a href="">
                            <i class='bx bx-clipboard'></i></a>
                        <span class="text">
                            <h3><?php echo $overallSlots; ?></h3>
                            <p>Available Slots</p>
                        </span>
                    </li>

                    <li id="admission-box">
                        <a href="facultyApplicants.php">
                            <i class='bx bxs-group'></i>
                        </a>
                        <span class="text">
                        <h3><?php echo $studentCountForAdmission; ?></h3>
                            <p>Students For Admission</p>
                        </span>
                    </li>


                    <li id="admitted-box">
                        <a href="your_destination_url_here">
                            <i class='bx bx-user-check'></i></a>
                        <span class="text">
                        <h3><?php echo $admittedStudentCount; ?></h3>
                            <p>Admitted Students</p>
                        </span>
                    </li>

                    <li id="readmitted-box">
                        <a href="your_destination_url_here">
                            <i class='bx bxs-user-x'></i></a>
                        <span class="text">
                        <h3><?php echo $NORStudentCount; ?></h3>
                            <p>Students For Readmission</p>
                        </span>
                    </li>
                </ul>

            </div>






        </main>
        <!-- MAIN -->

    </section>
</body>

</html>
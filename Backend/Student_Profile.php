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

// Check if admission data is available
if ($resultAdmission->num_rows > 0) {
    $admissionData = $resultAdmission->fetch_assoc();

    // Display the student's and admission data
    // ... (your existing HTML code for displaying data)
} else {
    // Display a message indicating that data is not set
   
}
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
            <div id="student-profile-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Profile</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Profile</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="Student_Dashboard.php">Home</a></li>
                        </ul>
                    </div>

                </div>
                <!--profile-->
                <div id="student-profile">
                    <div class="table-data">
                        <div class="order">
                            <div class="order-profile">


                                <div class="StudentResult-Content">
                                    <div id="StudentResult-picture" class="student-picture">
                                        <?php if (!empty($admissionData) && isset($admissionData['id_picture'])) : ?>
                                            <img src="<?php echo $admissionData['id_picture']; ?>" alt="ID Picture">
                                        <?php else : ?>
                                            <p></p>
                                        <?php endif; ?>
                                    </div>

                                    <div class="result-info">
                                        <?php if (!empty($admissionData)) : ?>
                                            <div class="result-style">
                                                <p class="result-p">
                                                    <strong>Applicant Name:</strong>
                                                    <span id="result-ApplicantName" class="applicant-name">
                                                        <?php echo isset($admissionData['applicant_name']) ? $admissionData['applicant_name'] : 'Data not set'; ?>
                                                    </span>
                                                </p>
                                            </div>

                                            <div class="result-style">
                                                <p class="result-p">
                                                    <strong>Applicant Number:</strong>
                                                    <span id="result-ApplicantNumber" class="applicant-number">
                                                        <?php echo isset($admissionData['applicant_number']) ? $admissionData['applicant_number'] : 'Data not set'; ?>
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="result-style">
            <p class="result-p">
                <strong>Program:</strong>
                <span id="result-Program" class="program-info">
                    <?php echo isset($admissionData['degree_applied']) ? $admissionData['degree_applied'] : 'Data not set'; ?>
                </span>
            </p>
        </div>
                                             <div class="result-style">
            <p class="result-p">
                <strong>Status of Result:</strong>
                <?php
                $resultStatus = isset($admissionData['Result']) ? $admissionData['Result'] : 'Pending';
                echo '<a href="#" id="Pending" class="status-pending">' . $resultStatus . '</a>';
                ?>
            </p>
        </div>


                                        <?php else : ?>
                                            <p class="apply-program">NO DATA FOUND <br><a href="Student_Dashboard.php"></a></p>
                                        <?php endif; ?>
                                    </div>


<style>
    
.apply-program a:hover {
    text-decoration: underline;
}
</style>



                                </div>



                            </div>
                        </div>
                    </div>
                </div>
        </main>
    </section>
    <script>
        $(document).ready(function() {
            $('#downloadPdf').on('click', function() {
                // Create a new jsPDF instance
                var pdf = new jsPDF();

                // Get the content of the main section
                var content = $('#content')[0];

                // Generate the PDF
                pdf.fromHTML(content, 15, 15, {
                    'width': 170
                });

                // Download the PDF
                pdf.save('student_profile.pdf');
            });
        });
    </script>
</body>

</html>

<?php
include("config.php");
include("studentcover.php");

// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Student') {
    header("Location: loginpage.php");
    exit();
}

// Retrieve the student's information from the users table
$userEmail = $_SESSION['user_email'];

// Prepare and execute the SQL query to fetch admission data based on the user's email
$sql = "SELECT * FROM admission_data WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userEmail);
$stmt->execute();
$result = $stmt->get_result();

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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $appointmentDate = mysqli_real_escape_string($conn, $_POST['appointment_date']);
    $appointmentTime = mysqli_real_escape_string($conn, $_POST['appointment_time']);

    // Update the database
    $stmtUpdate = $conn->prepare("UPDATE admission_data SET appointment_date = ?, appointment_time = ? WHERE email = ?");
    $stmtUpdate->bind_param("sss", $appointmentDate, $appointmentTime, $email);

    if ($stmtUpdate->execute()) {
        echo "Appointment updated successfully!";
        // Update the $admissionData array with the new values
        $admissionData['appointment_date'] = $appointmentDate;
        $admissionData['appointment_time'] = $appointmentTime;
    } else {
        echo "Error updating appointment: " . $stmtUpdate->error;
    }

    // Close the statement
    $stmtUpdate->close();
}

// Close the database connection
$conn->close();
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
<style>
      .custom-list {
            font-size: 14px;
            margin-left: 20px; /* Adjust the left margin as needed */
        }

        .custom-list ol {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .custom-list ol li {
            margin-bottom: 5px;
        }

        .requirements {
            font-size: 12px; /* Adjust the font size for requirements */
        }

        .requirements h3 {
            color: #333;
        } .not-set {
        color: red;
    }


        .requirements strong {
            color: #007BFF;
        }
    </style>
    <section id="content">
        <main>
            <div id="student-result-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Transaction</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Transaction</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="studentcontent_sidebar.php">Home</a></li>
                        </ul>
                    </div>

                </div>
                <!--result(NOA)-->
                <div id="student-result">
                    <div class="table-data">
                        <div class="order">
                        <div id="table-container">
                            <table id="searchableTable">
                            <thead>
                                        
                                        <th>application date</th>
                                            <th>degree applied</th>
                                        
                                         
                                           
                                          <!-- New Column -->
                                            <th>Requirements</th> <!-- New Column -->
                                            <th>Appointment Date</th>
                                            <th>Action</th> <!-- Added Action column -->
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        // Loop through the result set and display data in the table
                                        $count = 1; // Initialize the count
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                           // Display the count
                                           echo "<td>" . $row['application_date'] . "</td>";
                                           
                                            echo "<td>" . $row['degree_applied'] . "</td>";
                                          
                                           
                                          
                                        
                                        
  // Generate Requirements based on academic_classification
  $requirements = "";
  switch ($row['academic_classification']) {
      case "Senior High School Graduates":
          $requirements = "
              <ol type='I' class='custom-list'>
                 
                  <strong>
                      <li>Senior High School Graduate who did not enroll in any college degree program/technical/vocational/degree program in any other school after graduation and will only enroll for the immediately following School Year:</li>
                  </strong>
                  <ol class='rac-list'>
                      <li>1. Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
                      <li>2. Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the family name/surname of the husband</li>
                      <li>3. Hard copy two (2) 2x2 recent formal studio 'type' photo with nametag and signature</li>
                      <li>4. Certified true copy of Grade 12 Report Card. Photocopy /scanned copy will suffice if the applicant can present the original copy for comparison purposes.</li>
                      <li>5. Certification of Enrollment from the last school attended (most recent).</li>
                  </ol>
              </ol>";
          break;

      case "High School (Old Curriculum) Graduates":
          $requirements = "
              <ol type='I' class='custom-list'>
                 
                  <strong>
                      <li>High School Graduate of the Old High School curriculum who did not enroll in any college degree program in any other school after graduation from high school and will only enroll this S.Y. 2021-2022:</li>
                  </strong>
                  <ol class='rac-list'>
                      <li>1. Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
                      <li>2. Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the family name/surname of the husband</li>
                      <li>3. Hard copy two (2) 2x2 recent formal studio 'type' photo with nametag and signature</li>
                      <li>4. Certified true copy of High School Card/Form 138. Photocopy /scanned copy will suffice if the applicant can present the original copy for comparison purposes.</li>
                      <li>5. Certification of Enrollment from the last school attended (most recent).</li>
                  </ol>
              </ol>";
          break;

      case "Grade 12":
          $requirements = "
              <ol type='I' class='custom-list'>
                 
                  <strong>
                      <li>ALS/PEPT Completer:</li>
                  </strong>
                  <ol class='rac-list'>
                      <li>1. Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
                      <li>2. Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the family name/surname of the husband</li>
                      <li>3. Hard copy two (2) 2x2 recent formal studio 'type' photo with nametag and signature</li>
                      <li>4. Certified true copy ALS Certificate of Rating – For completers of Alternative Learning System (ALS) OR PEPT. Photocopy /scanned copy will suffice if the applicant can present the original copy for comparison purposes.</li>
                      <li>5. Certification of Enrollment from the last school attended (most recent).</li>
                  </ol>
              </ol>";
          break;

      case "ALS/PEPT Completers":
          $requirements = "
              <ol type='I' class='custom-list'>
                 
                  <strong>
                      <li>ALS/PEPT Completer:</li>
                  </strong>
                  <ol class='rac-list'>
                      <li>1. Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
                      <li>2. Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the family name/surname of the husband</li>
                      <li>3. Hard copy two (2) 2x2 recent formal studio 'type' photo with nametag and signature</li>
                      <li>4. Certified true copy ALS Certificate of Rating – For completers of Alternative Learning System (ALS) OR PEPT. Photocopy /scanned copy will suffice if the applicant can present the original copy for comparison purposes.</li>
                      <li>5. Certification of Enrollment from the last school attended (most recent).</li>
                  </ol>
              </ol>";
          break;

      case "Transferees":
          $requirements = "
              <ol type='I' class='custom-list'>
                 
                  <strong>
                      <li>Transferee:</li>
                  </strong>
                  <ol class='rac-list'>
                      <li>1. Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
                      <li>2. Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the family name/surname of the husband</li>
                      <li>3. Hard copy two (2) 2x2 recent formal studio 'type' photo with nametag and signature</li>
                      <li>4. Certified true copy of Copy of Grades or Transcript of Records (Applicable only for Second Degree Transferees). Photocopy /scanned copy will suffice if the applicant can present the original copy for comparison purposes.</li>
                      <li>5. Certification of Enrollment from the last school attended (most recent) or presently enrolled in.</li>
                      <li>6. Certification of General Weighted Average (GWA) issued by the Registrar's Office/equivalent Office of your previous School.</li>
                  </ol>
              </ol>";
          break;

      case "Second Degree":
          $requirements = "
              <ol type='I' class='custom-list'>
                 
                  <strong>
                      <li>Second Degree:</li>
                  </strong>
                  <ol class='rac-list'>
                      <li>1. Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
                      <li>2. Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the family name/surname of the husband</li>
                      <li>3. Hard copy two (2) 2x2 recent formal studio 'type' photo with nametag and signature</li>
                      <li>4. Certified true copy of Copy of Grades or Transcript of Records (Applicable only for Second Degree Transferees). Photocopy /scanned copy will suffice if the applicant can present the original copy for comparison purposes.</li>
                      <li>5. Photocopy/scanned copy of Grades or Transcript of Records for graduates Where BSU is the last school attended</li>
                      <li>6. Certification of Enrollment from the last school attended (most recent) or presently enrolled in.</li>
                      <li>7. Certification of General Weighted Average (GWA) issued by the Registrar's Office/equivalent Office of your previous School.</li>
                  </ol>
              </ol>";
          break;

      // Add more cases for other academic_classifications

      default:
          // Default case if academic_classification is not handled
          $requirements = "<li>Requirements not specified for this classification.</li>";
  }

  // Apply styling to the requirements
  echo "<td class='requirements'>" . $requirements . "</td>";
   $appointmentDate = !empty($row['appointment_date']) ? $row['appointment_date'] : "<span class='not-set'>Not Set</span>";
    echo "<td>" . $appointmentDate . " </td> ";

  echo "<td><a href='download.php?id=" . $row['id'] . "'>DownLoad PDF</a> </td>";
  echo "</tr>" ;
  $count++;
}

// Your existing code...
?>

                                </tbody>
                            </table>
                               <?php
    // Check if there are any rows in the result set
    if ($result->num_rows === 0) {
        echo "<p>No transaction records found.</p>";
    }
    ?>
                        </div>

                        </div>
                    </div>

                    </div>
<style>
     
        h1 {
            text-align: center;
        }

        .calendar {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .month {
            flex-basis: 30%;
        }

        .smalllabel {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .smalllabel th, .smalllabel td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .smalllabel th{
            background-color: #f2f2f2;
        }

        .available {
            background-color: #aaffaa; /* Light green for available dates */
            cursor: pointer;
        }

        .slot {
            display: none;
            margin-top: 10px;
        }

        .time-selection {
            margin-top: 10px;
        }

        .set-button {
            margin-top: 10px;
        }

        .form-group {
            margin-top: 20px;
        }
    </style>
     
                                </div>
                       
                </div>
            </div>
        </main>
    </section>

</body>

</html>
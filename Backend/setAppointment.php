
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
        echo "<script>alert('Appointment updated successfully!'); window.location.href = 'Student_Transaction_page.php';</script>";
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

    <section id="content">
        <main>
            <div id="student-result-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Set Appointment</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Appointment</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="studentcontent_sidebar.php">Home</a></li>
                        </ul>
                    </div>

                </div>
                <!--result(NOA)-->
                <div id="student-result">
                    <div class="table-data">
                        <div class="order">
                        <h1>Available Dates</h1>
    <div class="calendar">
 
    <?php
    // Your existing calendar code here
    include 'config.php';

    // Function to update database slots
    function updateDatabaseSlots($conn, $month, $day, $time) {
        // Assuming your table structure has columns 'Date', 'AMSlot', and 'PMSlot'
        $formattedDate = date("Y-m-d", strtotime("$month $day"));
        $columnName = ($time == 'AM') ? 'AMSlot' : 'PMSlot';

        // Update the database record
        $sql = "UPDATE appointments SET $columnName = $columnName - 1 WHERE Date = '$formattedDate'";
        $conn->query($sql);
    }

    // Perform query
    $sql = "SELECT * FROM appointments";
    $result = $conn->query($sql);

    // Check for errors
    if (!$result) {
        die("Error: " . $conn->error);
    }

    // Organize appointments by month and day
    $calendarData = array();
    while ($row = $result->fetch_assoc()) {
        $date = new DateTime($row['Date']);
        $month = $date->format('F'); // Full month name
        $dayOfMonth = $date->format('j');

        $calendarData[$month][$dayOfMonth] = array('AM' => $row['AMSlot'], 'PM' => $row['PMSlot']);
    }

    // Display the calendar
    foreach ($calendarData as $month => $days) {
        echo "<div class='month'>";
        echo "<h2>$month</h2>";
        echo "<table class='smalllabel'>";
        echo "<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>";

        $firstDayOfMonth = date('w', strtotime("1 $month")); // Get the day of the week for the first day of the month

        echo "<tr>";

        // Output empty cells for days before the first day of the month
        for ($i = 0; $i < $firstDayOfMonth; $i++) {
            echo "<td></td>";
        }

        // Output days with slots
        for ($day = 1; $day <= 31; $day++) {
            echo "<td";

            // Check if the date is available
            if (isset($days[$day])) {
                echo " class='available' onclick='toggleSlots(this)' data-am='" . $days[$day]['AM'] . "' data-pm='" . $days[$day]['PM'] . "'";
                echo ">";
                echo "<strong>$day</strong>";
            } else {
                echo ">";
                echo $day;
            }

            echo "</td>";

            if (($firstDayOfMonth + $day) % 7 == 0) {
                echo "</tr><tr>";
            }
        }

        echo "</tr>";
        echo "</table>";

        echo "</div>";
    }

    // Close connection
    $conn->close();
    ?>
</div>

<div class="appointment-slots">
    <?php
    // Output slots for each day
    foreach ($days as $dayOfMonth => $slots) {
        echo "<div class='slot' id='slots_$month$dayOfMonth'>";
        echo "<h3>Select times</h3>";
        echo "<p><strong>$month $dayOfMonth</strong></p>";
        echo "<div class='time-options'>";
        echo "<div class='time-option'>";
        echo "<input type='radio' name='time_$month$dayOfMonth' id='am_radio_$month$dayOfMonth' value='AM'>";
        echo "<label for='am_radio_$month$dayOfMonth'>AM</label>";
        echo "</div>";
        echo "<div class='time-option'>";
        echo "<input type='radio' name='time_$month$dayOfMonth' id='pm_radio_$month$dayOfMonth' value='PM'>";
        echo "<label for='pm_radio_$month$dayOfMonth'>PM</label>";
        echo "</div>";
        echo "</div>";
        echo "<button class='set-appointment-btn' onclick='setAppointment(\"$month\", $dayOfMonth)'>Submit</button>";
        echo "</div>";
    }
    ?>
</div>


 
<!-- Add this form within the <div id="student-profile"> section -->
<form action="" id="formid" style="display: none;" method="post" >
                <div class="result-style">
                    <p class="result-p">
                        <strong>Appointment Date:</strong>
                        <input type="date" name="appointment_date" id="appointment-date" value="<?php echo $admissionData['appointment_date']; ?>" readonly>
                    </p>
                </div>

                <div class="result-style">
                    <p class="result-p">
                        <strong>Appointment Time:</strong>
                        <input type="text" name="appointment_time" id="appointment-time"  value="<?php echo $admissionData['appointment_time']; ?>" readonly>
                    </p>
                </div>

                <div class="result-style">
                    <p class="result-p">
                        <button type="submit">Submit Appointment</button>
                    </p>
                </div>
            </form>
            

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
           
        }


        .calendar {
  display: flex;
  justify-content: center;
  z-index: 1; /* Set a lower z-index value */
}


        .appointment-slots {
            background-color: #f2f2f2;
    margin-top: 20px;
    position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 2; /* Set a higher z-index value */
}

.slot {
    border: 1px solid #ccc;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.slot h3 {
    font-size: 18px;
    margin-bottom: 10px;
}

.time-options {
    display: flex;
    justify-content: space-between;
}

.time-option {
    display: flex;
    align-items: center;
}

.time-option input {
    margin-right: 5px;
}

.set-appointment-btn {
    background-color: #4caf50;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

.set-appointment-btn:hover {
    background-color: #45a049;
}


        .form-group {
            margin-top: 20px;
        }
    </style>
   
  
            <script>
            function toggleSlots(element) {
                // Hide all slots
                var slots = document.querySelectorAll('.slot');
                slots.forEach(function (slot) {
                    slot.style.display = 'none';
                });

                // Show slots for the clicked date
                var date = element.textContent;
                var month = element.closest('.month').querySelector('h2').textContent;
                var slotsId = 'slots_' + month + date;
                var slotsToShow = document.getElementById(slotsId);
                if (slotsToShow) {
                    slotsToShow.style.display = 'block';
                }
            }
            function setAppointment(month, day) {
    var radios = document.querySelectorAll('input[name="time_' + month + day + '"]');
    var selectedTime = '';
    radios.forEach(function (radio) {
        if (radio.checked) {
            selectedTime = radio.value;
        }
    });

    if (selectedTime) {
        // Update the database slots
        updateDatabaseSlots(month, day, selectedTime);

        // Set the appointment date and time in the form
        var formattedDate = new Date().getFullYear() + "-" + ('0' + (new Date(month + " " + day).getMonth() + 1)).slice(-2) + "-" + ('0' + day).slice(-2);
        document.getElementById("appointment-date").value = formattedDate;
        document.getElementById("appointment-time").value = selectedTime;

        // Hide the slot information
        var slotsId = 'slots_' + month + day;
        var slotsElement = document.getElementById(slotsId);
        if (slotsElement) {
            slotsElement.style.display = 'none';
        }

        // Alert the user
        alert("Appointment set for " + month + " " + day + " at " + selectedTime);

        // Submit the form
        document.getElementById("formid").submit();

        // You can perform additional actions here if needed.
    } else {
        alert("Please select a time before setting the appointment.");
    }
}




            function updateDatabaseSlots(month, day, time) {
                // Assuming your backend endpoint to handle database updates
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "update_Appointmentslots.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Handle the response if needed
                        console.log(xhr.responseText);
                    }
                };
                xhr.send("month=" + encodeURIComponent(month) + "&day=" + encodeURIComponent(day) + "&time=" + encodeURIComponent(time));
            }
         
          
      
        </script>
                                </div>
                       
                </div>
            </div>
        </main>
    </section>

</body>

</html>
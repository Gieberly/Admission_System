<?php

include("config.php");
include("Personnel_Cover.php");

// Check if the user is a staff member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Staff') {
    header("Location: loginpage.php");
    exit();
}

// Fetch data from the academicclassification table for the Classification column
$sqlClassification = "SELECT DISTINCT Classification FROM academicclassification";
$resultClassification = $conn->query($sqlClassification);

// Retrieve admission data from the database
$search = isset($_GET['search']) ? $_GET['search'] : '';

$query = "SELECT * FROM admission_data WHERE 
            `applicant_name` LIKE '%$search%' OR 
            `applicant_number` LIKE '%$search%' OR 
            `academic_classification` LIKE '%$search%' OR 
            `email` LIKE '%$search%' OR 
            `math_grade` LIKE '%$search%' OR 
            `science_grade` LIKE '%$search%' OR 
            `english_grade` LIKE '%$search%' OR 
            `gwa_grade` LIKE '%$search%' OR 
            `result` LIKE '%$search%' OR 
            `nature_of_degree` LIKE '%$search%' OR 
            `degree_applied` LIKE '%$search%'
          ORDER BY nature_of_degree ASC, degree_applied ASC, applicant_name ASC";

$result = $conn->query($query);

// Fetch user information from the database based on user ID
$userID = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, email, userType, status FROM users WHERE id = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($name, $email, $userType, $status);
$stmt->fetch();

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
            <div class="head-title">
                <div class="left">
                    <h1>Appointments</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Appointments</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                        <li><a class="active" href="personnel.php">Home</a></li>
                        </li>
                    </ul>
                </div>
                <div class="button-container">
                    <a href="PersonnelsAppointmentDate.php" class="btn-appointment">
                        <i class='bx bxs-calendar calendar-icon'></i>
                        <span class="text">Set Dates</span>
                    </a>
                    <a href="excel_export_appointments.php" class="btn-download">
                        <i class='bx bxs-file-export'></i>
                        <span class="text">Excel Export</span>
                    </a>
                </div>
            </div>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>List of Students</h3>
                        <div class="headfornaturetosort">

                            <form method="post" action="" id="calendarFilterForm">
                                <label for="selectedAppointmentDate"></label>
                                <input type="date" id="selectedAppointmentDate" name="selected_appointment_date" required>
                                <button type="button" onclick="filterByDate()"><i class='bx bx-filter'></i></button>
                            </form>

                        </div>
                    </div>
                   
<table id="studentTable">
    <thead>
        <tr>
            <th>Application No.</th>
            <th>Nature of Degree</th>
            <th>Program</th>
            <th>Name</th>
            <th>Academic Classification</th>
            <th>Application Date</th>
            <th>Application Time</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr class='editRow' data-userid='" . $row['id'] . "'>";
            echo "<td>" . $row['applicant_number'] . "</td>";
            echo "<td>" . $row['nature_of_degree'] . "</td>";
            echo "<td>" . $row['degree_applied'] . "</td>";
            echo "<td>" . $row['applicant_name'] . "</td>";
            echo "<td>" . $row['academic_classification'] . "</td>";
            echo "<td>" . $row['application_date'] . "</td>";
            echo "<td>" . $row['appointment_time'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td><button class='editBtn'>Edit</button></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

                </div>
              
<div class="todo" style="display: none;">
    <div class="head">
        <h3>Student Data</h3>
    </div>
    <h1 style="text-align: center;">Edit Profile</h1>
    <form id="updateProfileForm" method="post" action="Student_update.php">
        <input type="hidden" id="selectedUserId" name="selectedUserId" value="">
        <label for="id_picture">Photo:</label>
        <input type="file" id="id_picture" name="id_picture">
        <!-- Personal Information -->
        <p class="personal_information">Personal Information</p>
        <label for="applicant_name">Applicant Name:</label>
        <input type="text" id="applicant_name" name="applicant_name" value="">
        <label for="gender">Gender:</label>
        <input type="text" id="gender" name="gender" value="">
        <!-- Repeat similar input fields for other personal information -->
        <!-- ... -->

        <!-- Permanent Home Address -->
        <p class="personal_information">Permanent Home Address</p>
        <label for="permanent_address">Permanent Address:</label>
        <input type="text" id="permanent_address" name="permanent_address" value="">
        <label for="zip_code">Zip Code:</label>
        <input type="text" id="zip_code" name="zip_code" value="">
        <!-- ... -->

        <!-- Contact Information -->
        <p class="personal_information">Contact Information</p>
        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" value="">
        <!-- ... -->

        <!-- Contact Person(s) in Case of Emergency -->
        <p class="personal_information">Contact Person(s) in Case of Emergency</p>
        <!-- ... -->

        <!-- Academic Classification -->
        <p class="personal_information">Academic Classification</p>
        <label for="academic_classification">Academic Classification:</label>
        <input type="text" id="academic_classification" name="academic_classification" value="">
        <label for="high_school_name_address">High School Name/Address:</label>
        <input type="text" id="high_school_name_address" name="high_school_name_address" value="">
        <label for="lrn">Learner's Reference Number:</label>
        <input type="text" id="lrn" name="lrn" value="">
        <label for="degree_applied">Degree Applied:</label>
        <input type="text" id="degree_applied" name="degree_applied" value="">
        <label for="nature_of_degree">Nature of Degree:</label>
        <input type="text" id="nature_of_degree" name="nature_of_degree" value="">
        <!-- ... -->

        <!-- Academic Background -->
        <p class="personal_information">Academic Background</p>
        <label for="english_grade">English Grade:</label>
        <input type="text" id="english_grade" name="english_grade" value="">
        <label for="math_grade">Math Grade:</label>
        <input type="text" id="math_grade" name="math_grade" value="">
        <label for="science_grade">Science Grade:</label>
        <input type="text" id="science_grade" name="science_grade" value="">
        <label for="gwa_grade">GWA Grade:</label>
        <input type="text" id="gwa_grade" name="gwa_grade" value="">
        <label for="test_score">Test Score:</label>
        <input type="text" id="test_score" name="test_score" value="">
        <!-- ... -->

        <!-- Result and Status -->
        <p class="personal_information">Result and Status</p>
        <label for="result">Result:</label>
        <input type="text" id="result" name="result" value="">
        <label for="status">Status:</label>
        <input type="text" id="status" name="status" value="">
        <!-- ... -->

        <!-- Appointment Information -->
        <p class="personal_information">Appointment Information</p>
        <label for="appointment_date">Appointment Date:</label>
        <input type="text" id="appointment_date" name="appointment_date" value="">
        <label for="appointment_time">Appointment Time:</label>
        <input type="text" id="appointment_time" name="appointment_time" value="">
        <label for="appointment_status">Appointment Status:</label>
        <input type="text" id="appointment_status" name="appointment_status" value="">
        <!-- ... -->

        <input type="submit" value="Update Profile" onclick="return confirmUpdateProfile();">
    </form>
</div>
            </div>
        </main>
        <!-- MAIN -->
    </section>

    <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="mr-auto">Success!</strong>

        </div>
        <div class="toast-body" id="toast-body"></div>
    </div>

    <style>
        #calendarFilterForm button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            font-size: 0;
            color: #000;

        }

        #calendarFilterForm button i {
            font-size: 18px;
        }




        #calendarFilterForm input[type="date"] {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }

        #toast {
            position: fixed;
            top: 10%;
            right: 10%;
            width: 300px;
            background-color: #4CAF50;
            color: #fff;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        #toast.show {
            opacity: 1;
        }

        @keyframes slideInUp {
            from {
                transform: translateY(100%);
            }

            to {
                transform: translateY(0);
            }
        }
    </style>


    <script>
     document.addEventListener("DOMContentLoaded", function () {
        var editButtons = document.querySelectorAll('.editBtn');
        var selectedUserIdInput = document.getElementById('selectedUserId');
        var todoDiv = document.querySelector('.todo');

        editButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var userId = this.closest('tr').getAttribute('data-userid');
                selectedUserIdInput.value = userId;

                // Show the form for editing
                todoDiv.style.display = 'block';

                // You can add logic to fetch the user data using AJAX and populate the form fields
                // For simplicity, let's assume you have a JavaScript function named `populateForm`:
                populateForm(userId);
            });
        });
        function populateForm(userId) {
            // Add logic to fetch user data using AJAX and populate the form fields
            // Example using PHP and AJAX:
            // var xhr = new XMLHttpRequest();
            // xhr.onreadystatechange = function () {
            //     if (xhr.readyState == 4 && xhr.status == 200) {
            //         var userData = JSON.parse(xhr.responseText);
            //         // Populate the form fields with userData
            //         document.getElementById('applicant_name').value = userData.applicant_name;
            //         document.getElementById('gender').value = userData.gender;
            //         // ... (populate other fields)
            //     }
            // };
            // xhr.open('GET', 'fetch_user_data.php?userId=' + userId, true);
            // xhr.send();
        }
    });

        function filterByDate() {
            // Get the selected date from the input field
            var selectedDate = document.getElementById('selectedAppointmentDate').value;

            // Redirect to the same page with the selected date as a parameter
            window.location.href = 'PersonnelsAppointmentList.php?selected_date=' + selectedDate;
        }
        // Function to update table rows based on the specified range
        function updateTableRows(start, end) {
            var rows = $('#table-container table tbody tr');

            rows.each(function(index, row) {
                if (index + 1 >= start && index + 1 <= end) {
                    $(row).show();
                } else {
                    $(row).hide();
                }
            });
        }

        function editAdmissionData(id) {
            // Get the row element
            var row = document.querySelector(`tr[data-id='${id}']`);

            // Hide the "Check Circle" and "X Circle" buttons within the row
            var checkBtn = row.querySelector('.check-btn');
            var ekisBtn = row.querySelector('.ekis-btn');

            if (checkBtn && ekisBtn) {
                checkBtn.style.display = 'none';
                ekisBtn.style.display = 'none';
            }

            // Toggle between edit and display modes
            var editableCells = row.querySelectorAll('.editable');
            editableCells.forEach(function(cell) {
                var spanMode = cell.querySelector('.edit-mode');
                var selectMode = cell.querySelector('.select-mode');

                if (spanMode && selectMode) {
                    spanMode.style.display = 'none';
                    selectMode.style.display = 'inline-block';
                }
            });

            // Change the "Edit" button to a "Save" button and change its color to green
            var editButton = row.querySelector('.edit-btn');
            editButton.innerHTML = '<i class="bx bx-save"></i>';
            editButton.classList.add('save-btn', 'transition-class'); // Add transition-class for the animation
            editButton.onclick = function() {
                saveStudent(id);

                // Toggle back to display mode after saving
                editableCells.forEach(function(cell) {
                    var spanMode = cell.querySelector('.edit-mode');
                    var selectMode = cell.querySelector('.select-mode');

                    if (spanMode && selectMode) {
                        spanMode.style.display = 'inline-block';
                        selectMode.style.display = 'none';
                    }
                });

                // Show the "Check Circle" and "X Circle" buttons after saving
                if (checkBtn && ekisBtn) {
                    checkBtn.style.display = 'inline-block';
                    ekisBtn.style.display = 'inline-block';
                }
            };
        }

        function updateStatus(admissionId, newStatus) {
            // Confirm the action with a prompt
            var confirmation = confirm(`Are you sure you want to set as ${newStatus.toLowerCase()} the student's requirement?`);

            if (confirmation) {
                const url = `updateStatus.php?id=${admissionId}&status=${newStatus}`;

                // Make a fetch request to the server
                fetch(url, {
                        method: 'GET',
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Assuming the server sends back a JSON response
                        // You can handle the response accordingly
                        if (data.success) {
                            // Update the status in the table cell
                            const statusCell = document.querySelector(`tr[data-id='${admissionId}'] td[data-field='appointment_status']`);
                            statusCell.textContent = newStatus;

                            // Optionally, display a success message
                            console.log('Status updated successfully');

                            // Show a toast message
                            if (newStatus === "Accepted") {
                                showCheckCircleToast("Student's requirement accepted successfully!");
                            } else if (newStatus === "Declined") {
                                showEkisCircleToast("Student's requirement declined successfully!");
                            }
                        } else {
                            // Optionally, display an error message
                            console.error('Failed to update status');
                        }
                    })
                    .catch(error => {
                        // Handle errors during the fetch request
                        console.error('Fetch error:', error);
                    });
            }
        }


        function showCheckCircleToast(message) {
            // Get the toast element
            var toast = document.getElementById('toast');

            // Set the background color to green for success
            toast.style.backgroundColor = '#4CAF50';

            // Set the message in the toast body
            var toastBody = document.getElementById('toast-body');
            toastBody.textContent = message;

            // Display the toast
            toast.classList.add('show');

            // Hide the toast after a certain duration (e.g., 3000 milliseconds)
            setTimeout(function() {
                toast.classList.remove('show');
                // Reset the background color
                toast.style.backgroundColor = '';
                // Reset the toast body content
                toastBody.textContent = '';
            }, 1500);
        }

        function showEkisCircleToast(message) {
            // Get the toast element
            var toast = document.getElementById('toast');

            // Set the background color to red for declined
            toast.style.backgroundColor = '#4CAF50';

            // Set the message in the toast body
            var toastBody = document.getElementById('toast-body');
            toastBody.textContent = message;

            // Display the toast
            toast.classList.add('show');

            // Hide the toast after a certain duration (e.g., 3000 milliseconds)
            setTimeout(function() {
                toast.classList.remove('show');
                // Reset the background color
                toast.style.backgroundColor = '';
                // Reset the toast body content
                toastBody.textContent = '';
            }, 1500);
        }

        function saveStudent(id) {
            // Get the row element
            var row = document.querySelector(`tr[data-id='${id}']`);

            // Get the selected value from the dropdown
            var selectedValue = row.querySelector('#academicClassificationSelect').value;

            // Create an object to store the updated data
            var updatedData = {
                academic_classification: selectedValue
            };

            // Send an AJAX request to update the data in the database
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'save_student.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Display a toast notification for successful save
                    var toast = document.getElementById('toast');
                    toast.classList.add('show');
                    setTimeout(function() {
                        toast.classList.remove('show');
                        // Reload the page after 1 second
                        setTimeout(function() {
                            location.reload();
                        }, 10);
                    }, 1500);

                    // Change the "Save" button back to "Edit"
                    var editButton = row.querySelector('.edit-btn');
                    editButton.innerHTML = '<i class="bx bx-edit-alt"></i>';
                    editButton.classList.remove('save-btn', 'transition-class'); // Remove the class to remove the green styling and animation
                    editButton.onclick = function() {
                        editAdmissionData(id);
                    };

                    // Toggle back to display mode after saving
                    var editableCells = row.querySelectorAll('.editable');
                    editableCells.forEach(function(cell) {
                        var spanMode = cell.querySelector('.edit-mode');
                        var selectMode = cell.querySelector('.select-mode');

                        if (spanMode && selectMode) {
                            spanMode.style.display = 'inline-block';
                            selectMode.style.display = 'none';
                        }
                    });
                }
            };
            xhr.send(JSON.stringify({
                id: id,
                updatedData: updatedData
            }));
        }



        function showSuccessToast() {
            // Get the toast element
            var toast = document.getElementById('toast');

            // Display the toast
            toast.classList.add('show');

            // Hide the toast after a certain duration (e.g., 3000 milliseconds)
            setTimeout(function() {
                toast.classList.remove('show');
            }, 3000);
        }
    </script>



    </div>

    </div>
    </div>
    </div>
    </div>



    </main>
    <!-- MAIN -->


    </section>
</body>

</html>
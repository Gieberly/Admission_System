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
                    <h1>Document Checking</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Document Checking</a></li>
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
          
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

                </div>
              
<div class="todo" style="display: none;">
    <div class="head">
        <h3>Student Data</h3>
        
        <i class="bx bx-x close-form" style="float: right;font-size: 24px;"></i>

       <style>
    .close-form {
        transition: background-color 0.3s, transform 0.3s;
        border-radius: 50%;
    }

    .close-form:hover {
        background-color: rgba(255, 0, 0, 0.2); /* Red with 80% opacity */
        
    }
    /* Apply styles to the form container */
.form-container1,
.form-container2,
.form-container3,
.form-container4,
.form-container5,
.form-container6,
.form-container7 {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin-bottom: 20px;
  transform: translateY(20px);
  transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
}
/* Apply styles to the form groups */
.form-group {
  margin-bottom: 15px;
  display: flex;
  flex-direction: column;
}

/* Apply styles to the labels */
.small-label {
  display: block;
  font-size: 14px;
  margin-bottom: 5px;
}

/* Apply styles to the input fields */
.input {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

/* Apply styles to the submit button */
input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

/* Style for the personal information headings */
.personal_information {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
}

/* Style for the form container */
#updateProfileForm {
  max-width: 800px;
  margin: 0 auto;
}
.input {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

/* Apply styles to the submit button */
input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

/* Responsive styles for smaller screens */
@media screen and (max-width: 768px) {
  .form-group {
    width: 100%;
  }
}

</style>


    </div>
        <form id="updateProfileForm" method="post" action="save_student.php">
        <img id="applicantPicture" alt="Applicant Picture" style="width: 150px; height: 150px; border-radius: 2%; float: right;" >
        <br><br><br><br><br><br>
        <p class="personal_information">Personal Information</p>
        
        <div class="form-container1">
        
          <div class="form-group">
            <label class="small-label" for="applicant_name">Complete Name</label>
            <input name="applicant_name" class="input" id="applicant_name" value="<?php echo $admissionData['applicant_name']; ?>">
          </div>
          <!-- Birthplace -->
          <div class="form-group">
            <label class="small-label" for="birthplace">Birthplace</label>
            <input name="birthplace" class="input" id="birthplace" value="<?php echo $admissionData['birthplace']; ?>">
          </div>
       

          <!-- Sex at Birth -->
          <div class="form-group">
            <label class="small-label" for="gender">Sex at birth</label>
            <input name="gender" class="input" id="gender" value="<?php echo $admissionData['gender']; ?>">
          </div>
          <!-- Birthdate -->
          <div class="form-group">
            <label class="small-label" for="birthdate">Birthdate</label>
            <input name="birthdate" class="input" id="birthdate" value="<?php echo $admissionData['birthdate']; ?>">
          </div>
        <!-- Age -->
        <div class="form-group">
            <label class="small-label" for="age">Age</label>
            <input name="age" class="input" id="age" value="<?php echo $admissionData['age']; ?>">
          </div>
          <!-- civil status -->
          <div class="form-group">
            <label class="small-label" for="civil_status">Civil Status</label>
            <input name="civil_status" class="input" id="civil_status" value="<?php echo $admissionData['civil_status']; ?>">
          </div>
          <!-- Citizenship -->
          <div class="form-group">
            <label class="small-label" for="citizenship">Citizenship</label>
            <input name="citizenship" class="input" id="citizenship" value="<?php echo $admissionData['citizenship']; ?>">
          </div>
          <!-- Nationality-->
          <div class="form-group">
            <label class="small-label" for="nationality">Nationality</label>
            <input name="nationality" class="input" id="nationality" value="<?php echo $admissionData['nationality']; ?>">
          </div>
        </div>

        <p class="personal_information">Permanent Home Address</p>

        <div class="form-container3">
          <div class="form-group">
            <label class="small-label" for="permanent_address">Address</label>
            <input name="permanent_address" class="input" id="permanent_address" value="<?php echo $admissionData['permanent_address']; ?>">
          </div>
          <!-- zip-code -->
          <div class="form-group">
            <label class="small-label" for="zip_code">Zip Code</label>
            <input name="zip_code" class="input" id="zip_code" value="<?php echo $admissionData['zip_code']; ?>">
          </div>
        </div>

        <p class="personal_information">Contact Information</p>
        <div class="form-container4">
          <!-- Telephone/Mobile No -->
          <div class="form-group">
            <label class="small-label" for="phone_number">Telephone/Mobile No.</label>
            <input name="phone_number" class="input" id="phone" value="<?php echo $admissionData['phone_number']; ?>">
          </div>

          <!-- Facebook Account Name -->
          <div class="form-group">
            <label class="small-label" for="facebook">Facebook Account Name</label>
            <input name="facebook" class="input" id="facebook" value="<?php echo $admissionData['facebook']; ?>">
          </div>
          <!--Email Address -->
          <div class="form-group">
            <label class="small-label" for="email">Email Address</label>
            <input name="email" class="input" id="email" value="<?php echo $admissionData['email']; ?>" readonly>
          </div>
        </div>

        <p class="personal_information">Contact Person(s) in Case of Emergency</p>
        <div class="form-container7">
          <!-- Contact Person 1 -->
          <div class="form-group">
            <label class="small-label" for="contact_person_1">Contact Person</label>
            <input name="contact_person_1" class="input" id="contact_person_1" value="<?php echo $admissionData['contact_person_1']; ?>">
          </div>
          <div class="form-group">
            <label class="small-label" for="contact_person_1_mobile">Mobile Number</label>
            <input name="contact_person_1_mobile" class="input" id="contact_person_1_mobile" value="<?php echo $admissionData['contact1_phone']; ?>">
          </div>
          <div class="form-group">
            <label class="small-label" for="relationship_1">Relationship with Contact Person</label>
            <input name="relationship_1" class="input" id="relationship_1" value="<?php echo $admissionData['relationship_1']; ?>">
          </div>
        </div>
        <div class="form-container7">
          <!-- Contact Person 2 -->
          <div class="form-group">
            <label class="small-label" for="contact_person_2">Contact Person</label>
            <input name="contact_person_2" class="input" id="contact_person_2" value="<?php echo $admissionData['contact_person_2']; ?>">
          </div>
          <div class="form-group">
            <label class="small-label" for="contact_person_2_mobile">Mobile Number</label>
            <input name="contact_person_2_mobile" class="input" id="contact_person_2_mobile" value="<?php echo $admissionData['contact_person_2_mobile']; ?>">
          </div>
          <div class="form-group">
            <label class="small-label" for="relationship_2">Relationship with Contact Person</label>
            <input name="relationship_2" class="input" id="relationship_2" value="<?php echo $admissionData['relationship_2']; ?>">
          </div>
        </div>

        <p class="personal_information">Academic Classification</p>
        <div class="form-container6">
          <!-- Academic Classification -->
          <div class="form-group">
    <label class="small-label" for="academic_classification">Academic Classification</label>
    <input name="academic_classification" class="input" id="academic_classification" value="<?php echo $admissionData['academic_classification']; ?>">
</div>

          <div class="form-group">
            <label class="small-label" for="degree_applied">Degree</label>
            <!-- Display the selected program in this input field -->
            <input name="degree_applied" class="input" id="degree_applied" value="<?php echo $admissionData['degree_applied']; ?>">
          </div>
          <div class="form-group">
            <label class="small-label" for="nature_of_degree" style="white-space: nowrap;">Nature of degree</label>
            <input name="nature_of_degree" class="input" id="nature_of_degree" value="<?php echo $admissionData['nature_of_degree']; ?>">
          </div>
        </div>
        <p class="personal_information">Academic Background </p>
        <div class="form-container5">
          <!-- Academic Background -->
          <div class="form-group">
            <label class="small-label" for="high_school_name_address" style="white-space: nowrap;">High School/Senior High School</label>
            <input name="high_school_name_address" class="input" id="high_school_name_address" value="<?php echo $admissionData['high_school_name_address']; ?>">
          </div>
          <div class="form-group">
            <label class="small-label" for="lrn" style="white-space: nowrap;">Learner's Reference Number</label>
            <input name="lrn" class="input" id="lrn" value="<?php echo $admissionData['lrn']; ?>">
          </div>
        </div>
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
 
 $(document).ready(function () {
    // Add a click event listener to all rows with the 'editRow' class
    $('.editRow').click(function () {
        // Get the 'data-userid' attribute from the clicked row
        var userId = $(this).data('userid');

        // Send an AJAX request to fetch the user data based on the user ID
        $.ajax({
            url: 'Personnel_fetchStudentdata.php', // replace with the actual URL for fetching user data
            type: 'POST',
            data: { userId: userId },
            dataType: 'json',
            success: function (response) {
                // Populate the form fields with the fetched data
                $('#applicantPicture').attr('src', response.id_picture);
                $('#updateProfileForm input[name="applicant_name"]').val(response.applicant_name);
                $('#updateProfileForm input[name="birthplace"]').val(response.birthplace);
                $('#updateProfileForm input[name="gender"]').val(response.gender);
                $('#updateProfileForm input[name="birthdate"]').val(response.birthdate);
                $('#updateProfileForm input[name="age"]').val(response.age);
                $('#updateProfileForm input[name="civil_status"]').val(response.civil_status);
                $('#updateProfileForm input[name="citizenship"]').val(response.citizenship);
                $('#updateProfileForm input[name="nationality"]').val(response.nationality);
                $('#updateProfileForm input[name="permanent_address"]').val(response.permanent_address);
                $('#updateProfileForm input[name="zip_code"]').val(response.zip_code);
                $('#updateProfileForm input[name="phone_number"]').val(response.phone_number);
                $('#updateProfileForm input[name="facebook"]').val(response.facebook);
                $('#updateProfileForm input[name="email"]').val(response.email);
                $('#updateProfileForm input[name="contact_person_1"]').val(response.contact_person_1);
                $('#updateProfileForm input[name="contact_person_1_mobile"]').val(response.contact1_phone);
                $('#updateProfileForm input[name="relationship_1"]').val(response.relationship_1);
                $('#updateProfileForm input[name="contact_person_2"]').val(response.contact_person_2);
                $('#updateProfileForm input[name="contact_person_2_mobile"]').val(response.contact_person_2_mobile);
                $('#updateProfileForm input[name="relationship_2"]').val(response.relationship_2);
                $('#updateProfileForm input[name="academic_classification"]').val(response.academic_classification);
                $('#updateProfileForm input[name="Track"]').val(response.Track);
                $('#updateProfileForm input[name="Strand"]').val(response.Strand);
                $('#updateProfileForm input[name="high_school_name_address"]').val(response.high_school_name_address);
                $('#updateProfileForm input[name="lrn"]').val(response.lrn);
                $('#updateProfileForm input[name="degree_applied"]').val(response.degree_applied);
                $('#updateProfileForm input[name="nature_of_degree"]').val(response.nature_of_degree);

                // Add similar lines for other form fields

                // Display the form for editing
                $('.todo').show();
                
            },
            
            error: function (error) {
                console.error('Error fetching user data: ', error);
            }
        });
    });

    // Click event handler for the close button
    $('.close-form').click(function () {
        // Hide the form
        $('.todo').hide();
    });
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
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
            <th>#</th>
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
    $counter = 1; // Initialize the counter before the loop

    while ($row = $result->fetch_assoc()) {
        echo "<tr class='editRow' data-userid='" . $row['id'] . "'>";
        echo "<td>" . $counter . "</td>";
        echo "<td>" . $row['applicant_number'] . "</td>";
        echo "<td>" . $row['nature_of_degree'] . "</td>";
        echo "<td>" . $row['degree_applied'] . "</td>";
        echo "<td>" . $row['applicant_name'] . "</td>";
        echo "<td>" . $row['academic_classification'] . "</td>";
        echo "<td>" . $row['application_date'] . "</td>";
        echo "<td>" . $row['appointment_time'] . "</td>";
        echo "<td  data-field='appointment_status'>{$row['appointment_status']}</td>";
        echo "<td>
            <button type='button' class='button ekis-btn' data-tooltip='Rejected' onclick='updateStatus({$row['id']}, \"Rejected\")'><i class='bx bxs-x-circle'></i></button>
            <button type='button' class='button inc-btn' data-tooltip='Incomplete' onclick='updateStatus({$row['id']}, \"Incomplete\")'><i class='bx bxs-no-entry'></i></i></button>
            <button type='button' class='button check-btn' data-tooltip='Complete' onclick='updateStatus({$row['id']}, \"Complete\")'><i class='bx bxs-check-circle'></i></button>
           
        </td>";
        echo "<td style='display: none;'><input type='checkbox' name='select[]' value='" . $row["id"] . "'></td>";
        echo "</tr>";

        $counter++; // Increment the counter for the next row
    }

    // Close the database connection
    $conn->close();
    ?>
    </tbody>
</table>

                </div>
              
<div class="todo" style="display: none;">
    <div class="head">
        <h3>Student Data</h3>
        
        <i class="bx bx-x close-form" style="float: right;font-size: 24px;"></i>

      


    </div>
        <form id="updateProfileForm" method="post" action="save_student.php">
        <img id="applicantPicture" alt="Applicant Picture" style="width: 150px; height: 150px; border-radius: 2%; float: right;" >
        <br><br><br><br><br><br>
       
        <div class="form-container1">
        
          <div class="form-group">
            <label class="small-label" for="applicant_name">Complete Name</label>
            <input name="applicant_name" class="input" id="applicant_name" value="<?php echo $admissionData['applicant_name']; ?>">
          </div>
          <!-- Sex at Birth -->
          <div class="form-group">
            <label class="small-label" for="gender">Sex at birth</label>
            <input name="gender" class="input" id="gender" value="<?php echo $admissionData['gender']; ?>">
          </div>
       
     
        </div>

       

        <p class="personal_information">Contact Information</p>
        <div class="form-container4">
          <!-- Telephone/Mobile No -->
          <div class="form-group">
            <label class="small-label" for="phone_number">Telephone/Mobile No.</label>
            <input name="phone_number" class="input" id="phone" value="<?php echo $admissionData['phone_number']; ?>">
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
            <label class="small-label" for="high_school_name_address" style="white-space: nowrap;">LAST SCHOOL ATTENDED (School Name and Address)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           </label>
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
body.modal-open {
    overflow: hidden;
}

#confirm-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 999;
}

#confirm-modal {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border: 1px solid #ccc;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    border-radius: 5px;
}

#confirm-message {
    margin: 0 0 20px;
}

#confirm-buttons {
    display: flex;
    justify-content: space-between;
}

#confirm-yes,
#confirm-no {
    padding: 10px 20px;
    cursor: pointer;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 3px;
}

#confirm-no {
    padding: 10px 20px;
    cursor: pointer;
    background-color: red;
    color: #fff;
    border: none;
    border-radius: 3px;
}
/* Add this CSS to your existing styles */

#confirm-yes:hover,
#confirm-no:hover,
.edit-btn:hover,
.save-btn:hover {
    opacity: 0.5;
    /* Adjust the opacity value as needed */
    transition: opacity 0.3s ease-in-out;
}

</style>

<!-- Add this HTML structure at the end of your body -->
<div id="confirm-modal">
    <p id="confirm-message"></p>
    <div id="confirm-buttons">
        <button id="confirm-yes">Yes</button>
        <button id="confirm-no">Cancel</button>
    </div>
</div>
<div id="confirm-overlay"></div>

    <script>
 
 $(document).ready(function () {
    // Add a click event listener to all rows with the 'editRow' class
    $('.editRow').click(function () {
          // Check if the click was on the buttons
          if (!$(event.target).is('button') && !$(event.target).is('i')) {
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
        }
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


        function showConfirmationModal(message, callback) {
            document.body.classList.add('modal-open');
            var confirmModal = document.getElementById('confirm-modal');
    var confirmOverlay = document.getElementById('confirm-overlay');
    var confirmMessage = document.getElementById('confirm-message');

    confirmMessage.textContent = message;

    confirmModal.style.display = 'block';
    confirmOverlay.style.display = 'block';

    document.getElementById('confirm-yes').addEventListener('click', function () {
        confirmModal.style.display = 'none';
        confirmOverlay.style.display = 'none';
        document.body.classList.remove('modal-open');
        callback(true);
    });

    document.getElementById('confirm-no').addEventListener('click', function () {
        confirmModal.style.display = 'none';
        confirmOverlay.style.display = 'none';
        callback(false);
    });
}

function updateStatus(admissionId, newStatus) {
    showConfirmationModal(`Set the student's requirements as "${newStatus.toLowerCase()}"`, function (confirmed) {
        if (confirmed) {
            const url = `Personnel_UpdateStatus.php?id=${admissionId}&status=${newStatus}`;

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
                if (data.success) {
                    const statusCell = document.querySelector(`tr[data-userid='${admissionId}'] td[data-field='appointment_status']`);
                    statusCell.textContent = newStatus;

                    console.log('Status updated successfully');

                    if (newStatus === "Complete") {
                        showCheckCircleToast("Successfully set as Complete!");
                    } else if (newStatus === "Rejected") {
                        showEkisCircleToast("Successfully set as Rejected!");
                    } else if (newStatus === "Incomplete") {
                        showIncompleteToast("Successfully set as Incomplete!");
                    }
                } else {
                    console.error('Failed to update status');
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });
        }
    });
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
            }, 3000);
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
            },3000);
        }
        
function showIncompleteToast(message) {
    // Get the toast element
    var toast = document.getElementById('toast');

    // Set the background color to yellow for incomplete
    toast.style.backgroundColor = '#4CAF50';

    // Set the message in the toast body
    var toastBody = document.getElementById('toast-body');
    toastBody.textContent = message;

    // Display the toast
    toast.classList.add('show');

    // Hide the toast after a certain duration (e.g., 1500 milliseconds)
    setTimeout(function() {
        toast.classList.remove('show');
        // Reset the background color
        toast.style.backgroundColor = '';
        // Reset the toast body content
        toastBody.textContent = '';
    }, 3000);
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
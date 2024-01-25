<?php

include("config.php");
include("personnelcover.php");


// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Staff') {
    header("Location: loginpage.php");
    exit();
}


// Retrieve student data from the database
$search = isset($_GET['search']) ? $_GET['search'] : '';

$query = "SELECT id, applicant_name, applicant_number, academic_classification, email, math_grade, science_grade, english_grade, gwa_grade, result, nature_of_degree, degree_applied 
          FROM admission_data 
          WHERE 
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
            <div id="master-list-content">
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
                </div>

                <!--master list-->
                <div id="master-list">
                    <div class="table-data">
                        <div class="order">
                            <div class="head">
                                <h3>List of Students</h3>
                                <div class="headfornaturetosort">
                                    <div>
                                        <a href="PersonnelsAppointmentDate.php">
                                            <i class='bx bxs-calendar calendar-icon'></i> &nbsp;
                                        </a>
                                    </div>



                                </div>
                            </div>
                            <div id="table-container">
                                <table>

                                    <thead>
                                        <tr>
                                            <th>#</th>

                                            <th>Application No.</th>
                                            <th>Nature of Degree</th>
                                            <th>Program</th>
                                            <th>Name</th>
                                            <th>Academic Clasiffication</th>
                                            <th>Application Date</th>
                                            <th>Application Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <th style="display: none;" id="selectColumn">Select</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                        // Include the configuration file
                                        include('config.php');

                                        // Perform a SELECT query to fetch data
                                        $sql = "SELECT * FROM admission_data 
            WHERE (`appointment_date` IS NOT NULL AND `appointment_date` != '0000-00-00') 
            AND (`appointment_time` IS NOT NULL AND `appointment_time` != '00:00:00')";

                                        $result = $conn->query($sql);

                                        // Check if there are rows in the result set
                                        if ($result->num_rows > 0) {
                                            // Output data of each row
                                            $counter = 1; // Initialize the counter
                                            while ($row = $result->fetch_assoc()) {
                                                // Format date and time
                                                $formattedDate = date("M-d-Y", strtotime($row["appointment_date"]));
                                                $formattedTime = date("g:i A", strtotime($row["appointment_time"]));

                                                // Output each row as a table row with counter
                                                echo "<tr data-id='{$row['id']}'>";
                                                echo "<td>{$counter}</td>";

                                                echo "<td>" . $row["applicant_number"] . "</td>";
                                                echo "<td>" . $row["nature_of_degree"] . "</td>";
                                                echo "<td>" . $row["degree_applied"] . "</td>";
                                                echo "<td>" . $row["applicant_name"] . "</td>";
                                                echo "<td class='editable' data-field='academic_classification'>{$row['academic_classification']}</td>";
                                                echo "<td>" . $formattedDate . "</td>";
                                                echo "<td>" . $formattedTime . "</td>";

                                                // Check if in edit mode
                                                if (isset($_GET['edit']) && $_GET['edit'] == $row['id']) {
                                                    // Display a dropdown for appointment_status
                                                    echo "<td class='editable' data-field='appointment_status'>
                        <select name='appointment_status_edit' id='appointment_status_edit'>
                            <option value='accepted' " . ($row['appointment_status'] == 'accepted' ? 'selected' : '') . ">Accepted</option>
                            <option value='declined' " . ($row['appointment_status'] == 'declined' ? 'selected' : '') . ">Declined</option>
                        </select>
                      </td>";
                                                } else {
                                                    // Display the appointment_status normally
                                                    echo "<td class='editable' data-field='appointment_status'>{$row['appointment_status']}</td>";
                                                }

                                                echo "<td>
                    <button type='button' id='delete-btn' class='button delete-btn' onclick='deleteAdmissionData({$row['id']})'><i class='bx bx-trash'></i></button>
                    <button type='button' id='edit-btn' class='button edit-btn' onclick='editAdmissionData({$row['id']})'><i class='bx bx-edit-alt'></i></button>
                  </td>";
                                                echo "<td style='display: none;'><input type='checkbox' name='select[]' value='" . $row["id"] . "'></td>";
                                                echo "</tr>";

                                                $counter++; // Increment the counter for the next row
                                            }
                                        } else {
                                            // If there are no rows in the result set
                                            echo "<tr><td colspan='13'>No records found</td></tr>";
                                        }

                                        // Close the database connection
                                        $conn->close();
                                        ?>

                                    </tbody>
                                </table>
                                <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header">
                                        <strong class="mr-auto">Success!</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body" id="toast-body"></div>
                                </div>

                                <style>
                                    .calendar-icon {
                                        color: black;
                                        /* Default color */
                                        font-size: 16px;
                                        /* Default size */
                                        transition: color 0.3s, font-size 0.5s;
                                        /* Transition for smooth effect */
                                    }

                                    /* Hover styles */
                                    .calendar-icon:hover {
                                        color: green;
                                        /* Hover color */
                                        font-size: 20px;
                                        /* Hover size */
                                    }

                                    /* Custom styles for the toast */
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
                                    $('#viewButton i').on('click', function() {
                                        var rangeInput = $('#rangeInput').val();
                                        var range = rangeInput.split('-');

                                        // Check if the input is in the correct format
                                        if (range.length === 2 && !isNaN(range[0]) && !isNaN(range[1])) {
                                            var start = parseInt(range[0]);
                                            var end = parseInt(range[1]);

                                            // Update the table rows to display only the specified range
                                            updateTableRows(start, end);
                                        } else {
                                            alert('Invalid range format. Please use the format "start-end".');
                                        }
                                    });

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

                                        // Get all editable cells in the row
                                        var editableCells = row.querySelectorAll('.editable');

                                        // Add corner borders and remove inner borders for each editable cell
                                        editableCells.forEach(function(cell, index) {
                                            cell.contentEditable = true;
                                            cell.classList.add('editing');

                                            // Add corner borders
                                            cell.style.borderBottom = '2px solid blue';

                                            // Remove inner borders
                                            if (index > 0) {
                                                editableCells[index - 1].style.borderRight = 'none';
                                                cell.style.borderLeft = 'none';
                                            }
                                        });

                                        // Change the "Edit" button to a "Save" button and change its color to green
                                        var editButton = row.querySelector('.edit-btn');
                                        editButton.innerHTML = '<i class="bx bx-save"></i>';
                                        editButton.classList.add('save-btn', 'transition-class'); // Add transition-class for the animation
                                        editButton.onclick = function() {
                                            saveStudent(id);

                                            // Hide the blue bottom border after saving
                                            editableCells.forEach(function(cell) {
                                                cell.style.borderBottom = 'none';
                                            });
                                        };
                                    }


                                    function saveStudent(id) {
                                        // Get the row element
                                        var row = document.querySelector(`tr[data-id='${id}']`);

                                        // Get all editable cells in the row
                                        var editableCells = row.querySelectorAll('.editable');

                                        // Create an object to store the updated data
                                        var updatedData = {};

                                        // Loop through each editable cell and store the updated value
                                        editableCells.forEach(function(cell) {
                                            var fieldName = cell.getAttribute('data-field');
                                            var updatedValue = cell.innerText.trim();
                                            updatedData[fieldName] = updatedValue;
                                        });

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
                                                }, 3000);

                                                // Change the "Save" button back to "Edit"
                                                var editButton = row.querySelector('.edit-btn');
                                                editButton.innerHTML = '<i class="bx bx-edit-alt"></i>';
                                                editButton.classList.remove('save-btn', 'transition-class'); // Remove the class to remove the green styling and animation
                                                editButton.onclick = function() {
                                                    editAdmissionData(id);
                                                };



                                                // Hide the blue bottom border after saving and make cells non-editable
                                                editableCells.forEach(function(cell) {
                                                    cell.style.borderBottom = 'none';
                                                    cell.contentEditable = false; // Add this line to make the cell non-editable
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

                                    function addStudent() {

                                        // Get the "Add Student" row
                                        var addStudentRow = document.getElementById('addStudentRow');

                                        // Show the "Add Student" row
                                        addStudentRow.style.display = 'table-row';

                                        // Clear the content of editable cells in the "Add Student" row
                                        var editableCells = addStudentRow.querySelectorAll('.editable');
                                        editableCells.forEach(function(cell) {
                                            cell.innerText = '';
                                        });

                                        // Change the button to "Save" and set its onclick function
                                        var addButton = document.getElementById('addStudent');
                                        addButton.innerHTML = 'Save';
                                        addButton.onclick = function() {
                                            saveNewStudent();
                                        };
                                    }

                                    function saveNewStudent() {
                                        // Get the "Add Student" row
                                        var addStudentRow = document.getElementById('addStudentRow');

                                        // Get all editable cells in the "Add Student" row
                                        var editableCells = addStudentRow.querySelectorAll('.editable');

                                        // Create an object to store the new course data
                                        var newStudentData = {};

                                        // Loop through each editable cell and store the new value
                                        editableCells.forEach(function(cell) {
                                            var fieldName = cell.getAttribute('data-field');
                                            var newValue = cell.innerText.trim();
                                            newStudentData[fieldName] = newValue;
                                        });

                                        // Send an AJAX request to add the new course to the database
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST', 'add_student.php', true);
                                        xhr.setRequestHeader('Content-Type', 'application/json');
                                        xhr.onreadystatechange = function() {
                                            if (xhr.readyState === 4) {
                                                if (xhr.status === 200) {
                                                    // Hide the "Add Student" row after saving
                                                    addStudentRow.style.display = 'none';

                                                    // Change the button back to "Add Student"
                                                    var addButton = document.getElementById('addStudent');
                                                    addButton.innerHTML = '<i class=\'bx bx-add-to-queue\'></i> Add Student';
                                                    addButton.onclick = function() {
                                                        addStudent();
                                                    };

                                                    // Show a success toast
                                                    showSuccessToast();

                                                    // Reload the Student.php page after a delay of 2000 milliseconds (2 seconds)
                                                    setTimeout(function() {
                                                        location.reload();
                                                    }, 2000);
                                                } else {
                                                    // Optionally, handle the case where the server request was not successful
                                                    console.error('Failed to add the new course.');
                                                }
                                            }
                                        };
                                        xhr.send(JSON.stringify({
                                            newStudentData: newStudentData
                                        }));
                                    }

                                    function cancelAddStudent() {
                                        // Get the "Add Student" row
                                        var addStudentRow = document.getElementById('addStudentRow');

                                        // Hide the "Add Student" row
                                        addStudentRow.style.display = 'none';

                                        // Change the button back to "Add Student"
                                        var addButton = document.getElementById('addStudent');
                                        addButton.innerHTML = '<i class=\'bx bx-add-to-queue\'></i> Add Student';
                                        addButton.onclick = function() {
                                            addStudent();
                                        };
                                    }

                                    function deleteAdmissionData(id) {
                                        // Confirm with the user before deleting
                                        if (confirm("Are you sure you want to delete this course?")) {
                                            // Send an AJAX request to delete the course
                                            var xhr = new XMLHttpRequest();
                                            xhr.open("POST", "deleteStudentPersonnel.php", true);
                                            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                            xhr.onreadystatechange = function() {
                                                if (xhr.readyState === 4 && xhr.status === 200) {
                                                    var response = JSON.parse(xhr.responseText);
                                                    if (response.success) {
                                                        // Remove the deleted row from the table
                                                        var row = document.querySelector(`tr[data-id='${id}']`);
                                                        row.remove();

                                                        // Show a toast notification for success
                                                        showSuccessToast();
                                                    } else {
                                                        // Handle errors from the server if needed
                                                        alert('Error deleting the course. Please try again.');
                                                    }
                                                }
                                            };

                                            // Encode the data to be sent in the request
                                            var data = "id=" + encodeURIComponent(id);
                                            xhr.send(data);
                                        }
                                    }
                                    // Add an event listener to the "Delete Selected" button
                                    document.getElementById('deleteSelected').addEventListener('click', function() {
                                        deleteSelectedAdmissionData();
                                    });

                                    // Function to delete selected rows
                                    function deleteSelectedAdmissionData() {
                                        // Get all checkboxes
                                        var checkboxes = document.querySelectorAll('.select-checkbox:checked');

                                        // Check if at least one checkbox is selected
                                        if (checkboxes.length > 0) {
                                            // Confirm with the user before deleting
                                            if (confirm("Are you sure you want to delete the selected rows?")) {
                                                // Create an array to store the selected row IDs
                                                var selectedRowIds = [];

                                                // Iterate over selected checkboxes and store the corresponding row IDs
                                                checkboxes.forEach(function(checkbox) {
                                                    var row = checkbox.closest('tr');
                                                    var rowId = row.getAttribute('data-id');
                                                    selectedRowIds.push(rowId);
                                                });

                                                // Send an AJAX request to delete the selected rows
                                                var xhr = new XMLHttpRequest();
                                                xhr.open("POST", "deleteSelectedStudents.php", true);
                                                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                                xhr.onreadystatechange = function() {
                                                    if (xhr.readyState === 4 && xhr.status === 200) {
                                                        var response = JSON.parse(xhr.responseText);
                                                        if (response.success) {
                                                            // Remove the selected rows from the table
                                                            selectedRowIds.forEach(function(rowId) {
                                                                var row = document.querySelector(`tr[data-id='${rowId}']`);
                                                                row.remove();
                                                            });

                                                            // Show a success toast
                                                            showSuccessToast();
                                                        } else {
                                                            // Handle errors from the server if needed
                                                            alert('Error deleting selected rows. Please try again.');
                                                        }
                                                    }
                                                };

                                                // Encode the data to be sent in the request
                                                var data = "selectedRowIds=" + encodeURIComponent(JSON.stringify(selectedRowIds));
                                                xhr.send(data);
                                            }
                                        } else {
                                            // If no checkboxes are selected, show an alert
                                            alert('Please select at least one row to delete.');
                                        }
                                    }

                                    // Function to toggle the visibility of the Select column and checkboxes
                                    function toggleSelectionVisibility() {
                                        // Toggle the visibility of the Select column in the table header
                                        var selectColumn = document.getElementById('selectColumn');
                                        selectColumn.style.display = (selectColumn.style.display === 'none' || selectColumn.style.display === '') ? 'table-cell' : 'none';

                                        // Toggle the visibility of the checkboxes in each row
                                        var checkboxes = document.querySelectorAll('.select-checkbox');
                                        checkboxes.forEach(function(checkbox) {
                                            checkbox.style.display = (checkbox.style.display === 'none' || checkbox.style.display === '') ? 'table-cell' : 'none';
                                        });

                                        // Toggle the visibility of the "Delete Selected" button
                                        var deleteSelectedButton = document.getElementById('deleteSelected');
                                        deleteSelectedButton.style.display = (deleteSelectedButton.style.display === 'none' || deleteSelectedButton.style.display === '') ? 'block' : 'none';
                                    }

                                    // Add an event listener to the "Toggle Selection" button
                                    document.getElementById('toggleSelection').addEventListener('click', toggleSelectionVisibility);
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
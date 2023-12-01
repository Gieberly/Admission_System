<?php

include("config.php");
include("facultyCover.php");


// Check if the user is logged in as a Faculty
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Faculty') {
    header("Location: loginpage.php");  // Redirect to login page if not logged in as Faculty
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

// Handle search
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch the list of students without a result in the faculty's department with search functionality
$fetchStudentListQuery = "SELECT * FROM admission_data 
                          WHERE degree_applied = ? 
                          AND (Result IS NULL OR Result NOT IN ('NOR', 'NOA')) 
                          AND (gwa_grade IS NOT NULL AND gwa_grade <> '0.00')
                          AND (applicant_name LIKE '%$search%' OR 
                               applicant_number LIKE '%$search%' OR 
                               academic_classification LIKE '%$search%' OR 
                               email LIKE '%$search%' OR 
                               math_grade LIKE '%$search%' OR 
                               science_grade LIKE '%$search%' OR 
                               english_grade LIKE '%$search%' OR 
                               gwa_grade LIKE '%$search%' OR 
                               Result LIKE '%$search%' OR 
                               nature_of_degree LIKE '%$search%' OR 
                               degree_applied LIKE '%$search%')
                          ORDER BY gwa_grade DESC";

$stmtFetchStudentList = $conn->prepare($fetchStudentListQuery);
$stmtFetchStudentList->bind_param("s", $department);
$stmtFetchStudentList->execute();
$result = $stmtFetchStudentList->get_result();
$stmtFetchStudentList->close();
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
                        <h1>Applicants</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Applicants</a></li>
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


                                    <label for="rangeInput"></label>
                                    <input class="ForRange" type="text" id="rangeInput" name="rangeInput" placeholder="1-10" />
                                    <button type="button" id="viewButton">
                                        <i class='bx bx-filter'></i>
                                    </button>

                                    <button type='button' id="addStudent" onclick='addStudent()'>
                                        <i class='bx bx-add-to-queue'></i> Add Student
                                    </button>
                                    <button type="button" id="toggleSelection">
                                        <i class='bx bx-select-multiple'></i> Toggle Selection
                                    </button>
                                    <button style="display: none;" type="button" id="deleteSelected">
                                        <i class='bx bx-trash'></i> Delete Selected
                                    </button>


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
                                            <th>Math</th>

                                            <th>Science</th>
                                            <th>English</th>
                                            <th>GWA</th>

                                            <th>Result</th>
                                            <th>Action</th>
                                            <th style="display: none;" id="selectColumn">All <br> <input type="checkbox" id="selectAllCheckbox" onchange="toggleSelectAll(this)"></th>


                                        </tr>
                                        <tr id="addStudentRow" style="display: none;">
                                            <td>#</td>
                                            <td style="border-bottom: 2px solid blue;" contenteditable="true" class="editable" data-field="applicant_number"></td>
                                            <td style="border-bottom: 2px solid blue;" contenteditable="true" class="editable" data-field="nature_of_degree"></td>
                                            <td style="border-bottom: 2px solid blue;" contenteditable="true" class="editable" data-field="degree_applied"></td>
                                            <td style="border-bottom: 2px solid blue;" contenteditable="true" class="editable" data-field="applicant_name"></td>
                                            <td style="border-bottom: 2px solid blue;" contenteditable="true" class="editable" data-field="academic_classification"></td>
                                            <td style="border-bottom: 2px solid blue;" contenteditable="true" class="editable" data-field="math_grade"></td>
                                            <td style="border-bottom: 2px solid blue;" contenteditable="true" class="editable" data-field="science_grade"></td>
                                            <td style="border-bottom: 2px solid blue;" contenteditable="true" class="editable" data-field="english_grade"></td>
                                            <td style="border-bottom: 2px solid blue;" contenteditable="true" class="editable" data-field="gwa_grade"></td>

                                            <td style="border-bottom: 2px solid blue;" contenteditable="true" class="editable" data-field="Result"></td>
                                            <td>
                                                <button type='button' class='button cancel-btn' onclick='cancelAddStudent()'>Cancel</button>
                                                <button type='button' class='button save-btn' onclick='saveNewStudent()'>Save</button>

                                            </td>

                                        </tr>
                                        <tr id="setResultRow" style="display: none;">
                                            <td>#</td>
                                            <td data-field="applicant_number"></td>
                                            <td data-field="nature_of_degree"></td>
                                            <td data-field="degree_applied"></td>
                                            <td data-field="applicant_name"></td>
                                            <td data-field="academic_classification"></td>
                                            <td data-field="math_grade"></td>
                                            <td data-field="science_grade"></td>
                                            <td data-field="english_grade"></td>
                                            <td data-field="gwa_grade"></td>
                                            <td style="border-bottom: 2px solid blue;" contenteditable="true" class="editable" data-field="set_result_value"></td>
                                            <td>
                                                <button type='button' class='button cancel-btn' onclick='cancelSetResult()'>Cancel</button>
                                                <button type='button' class='button save-btn' onclick='saveSetResult()'>Save</button>
                                            </td>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr data-id='{$row['id']}'>";
                                            echo "<td>{$count}</td>";
                                            echo "<td data-field='applicant_number'>{$row['applicant_number']}</td>";
                                            echo "<td data-field='nature_of_degree'>{$row['nature_of_degree']}</td>";
                                            echo "<td data-field='degree_applied'>{$row['degree_applied']}</td>";
                                            echo "<td data-field='applicant_name'>{$row['applicant_name']}</td>";
                                            echo "<td data-field='academic_classification'>{$row['academic_classification']}</td>";
                                            echo "<td data-field='math_grade'>{$row['math_grade']}</td>";
                                            echo "<td data-field='science_grade'>{$row['science_grade']}</td>";
                                            echo "<td data-field='english_grade'>{$row['english_grade']}</td>";
                                            echo "<td  data-field='gwa_grade'>{$row['gwa_grade']}</td>";
                                            echo "<td class='editable' data-field='Result'>{$row['Result']}</td>";
                                            echo "<td>
                    <button type='button' id='delete-btn' class='button delete-btn' onclick='deleteAdmissionData({$row['id']})'><i class='bx bx-trash'></i></button>
                    <button type='button' id='edit-btn' class='button edit-btn' onclick='editAdmissionData({$row['id']})'><i class='bx bx-edit-alt'></i></button>
                    </td>";
                                            echo "<td id='checkbox-{$row['id']}'><input type='checkbox' style='display: none;' class='select-checkbox'></td>";
                                            echo "</tr>";
                                            $count++;
                                        }

                                        if ($count == 1) {
                                            echo "<tr><td colspan='13'>No admission data found</td></tr>";
                                        }
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

                                    /* Styles for the modal overlay */
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



                                                // Hide the blue bottom border after saving
                                                editableCells.forEach(function(cell) {
                                                    cell.style.borderBottom = 'none';
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

                                    /// Function to toggle the visibility of the Select column, checkboxes, and the row for setting the result
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

                                        // Toggle the visibility of the row for setting the result
                                        var setResultRow = document.getElementById('setResultRow');
                                        setResultRow.style.display = (setResultRow.style.display === 'none' || setResultRow.style.display === '') ? 'table-row' : 'none';
                                    }

                                    // Add an event listener to the "Toggle Selection" button
                                    document.getElementById('toggleSelection').addEventListener('click', toggleSelectionVisibility);


                                    // Add an event listener to the "Toggle Selection" button
                                    document.getElementById('toggleSelection').addEventListener('click', toggleSelectionVisibility);

                                    function toggleSelectAll(checkbox) {
                                        var checkboxes = document.querySelectorAll('.select-checkbox');
                                        checkboxes.forEach(function(cb) {
                                            cb.checked = checkbox.checked;
                                        });
                                    }

                                    // Function to set the "Result" column value for selected rows
                                    function setResultForSelectedRows() {
                                        var checkboxes = document.querySelectorAll('.select-checkbox:checked');

                                        if (checkboxes.length > 0) {
                                            // Show the row for setting the result
                                            var setResultRow = document.getElementById('setResultRow');
                                            setResultRow.style.display = 'table-row';

                                            // Set the input field value to an empty string
                                            var resultInput = setResultRow.querySelector('[data-field="set_result_value"]');
                                            resultInput.innerText = '';

                                            // Set focus to the input field
                                            resultInput.focus();

                                            // Set the "Result" value when the Save button is clicked
                                            var saveButton = setResultRow.querySelector('.save-btn');
                                            saveButton.onclick = function() {
                                                var resultValue = resultInput.innerText.trim().toUpperCase();
                                                if (resultValue === "NOR" || resultValue === "NOA") {
                                                    checkboxes.forEach(function(checkbox) {
                                                        var row = checkbox.closest('tr');
                                                        var resultCell = row.querySelector('[data-field="Result"]');
                                                        resultCell.innerText = resultValue;
                                                    });

                                                    // Hide the row after setting the result
                                                    setResultRow.style.display = 'none';

                                                    // Show a success toast or perform any other notification
                                                    showSuccessToast();
                                                } else {
                                                    alert('Please enter either NOR or NOA.');
                                                }
                                            };

                                            // Set the Cancel button functionality
                                            var cancelButton = setResultRow.querySelector('.cancel-btn');
                                            cancelButton.onclick = function() {
                                                // Hide the row without setting the result
                                                setResultRow.style.display = 'none';
                                            };
                                        } else {
                                            alert('Please select at least one row to set the Result.');
                                        }
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
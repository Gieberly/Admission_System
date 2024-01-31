<?php

include("config.php");
include("personnelcover.php");


// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Staff') {
    header("Location: loginpage.php");
    exit();
}

// Fetch data from the academicclassification table for the Classification column
$sqlClassification = "SELECT DISTINCT Classification FROM academicclassification";
$resultClassification = $conn->query($sqlClassification);

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
                                        include('config.php');

                                        // Get the current date
                                        $currentDate = date('Y-m-d');

                                        // Query to fetch rows where appointment_date is current
                                        $sql = "SELECT * FROM admission_data WHERE appointment_date = '$currentDate' ORDER BY appointment_time ASC";
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

                                                echo "<td class='editable' data-field='academic_classification'>
        <span class='edit-mode'>{$row['academic_classification']}</span>
        <select class='select-mode' style='display:none;' id='academicClassificationSelect'>";
                                                while ($classification = $resultClassification->fetch_assoc()) {
                                                    $selected = ($row['academic_classification'] == $classification['Classification']) ? "selected" : "";
                                                    echo "<option value='{$classification['Classification']}' $selected>{$classification['Classification']}</option>";
                                                }
                                                echo "</select></td>";


                                                echo "<td>" . $formattedDate . "</td>";
                                                echo "<td>" . $formattedTime . "</td>";


                                                echo "<td  data-field='appointment_status'>{$row['appointment_status']}</td>";


                                                echo "<td>
                  
                    <button type='button' id='edit-btn' class='button edit-btn' onclick='editAdmissionData({$row['id']})'><i class='bx bx-edit-alt'></i></button>
                    <button type='button' class='button check-btn'  onclick='updateStatus({$row['id']}, \"Accepted\")'><i class='bx bxs-check-circle'></i></button>
                    <button type='button'  class='button ekis-btn'  onclick='updateStatus({$row['id']}, \"Declined\")'><i class='bx bxs-x-circle'></i></button>
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
                                    $(document).ready(function() {
                                        // Your existing JavaScript code here

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
                                        document.getElementById('toggleSelection').addEventListener('click', toggleSelectionVisibility);
                                    })
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
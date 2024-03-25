<?php

include("config.php");
include("Personnel_Cover.php");


// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Staff') {
    header("Location: loginpage.php");
    exit();
}


// Retrieve student data from the database
$search = isset($_GET['search']) ? $_GET['search'] : '';

$query = "SELECT id, applicant_name, applicant_number, academic_classification, email, result, nature_of_degree, degree_applied 
          FROM admission_data 
          WHERE 
            (`applicant_name` LIKE '%$search%' OR 
            `applicant_number` LIKE '%$search%' OR 
            `academic_classification` LIKE '%$search%' OR 
            `email` LIKE '%$search%' OR 
          
            `result` LIKE '%$search%' OR 
            `nature_of_degree` LIKE '%$search%' OR 
            `degree_applied` LIKE '%$search%')
            AND `appointment_status` = 'Accepted' -- Added condition for accepted status
            AND `sent` = 'unsent'  -- Added condition for unsent status
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
                        <h1>Applicants</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Applicants</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li>
                            <li><a class="active" href="personnel.php">Home</a></li>
                            </li>
                        </ul>
                    </div>
                    <a href="excel_export_applicants.php" class="btn-download">
                        <i class='bx bxs-file-export'></i>
                        <span class="text">Excel Export</span>
                    </a>
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


                                    <button type="button" id="toggleSelection">
                                        <i class='bx bx-select-multiple'></i> Toggle Selection
                                    </button>
                                    <button style="display: none;" type="button" id="deleteSelected">
                                        <i class='bx bx-trash'></i> Delete Selected
                                    </button>
                                    <button type="button" id="sendButton" style="display: none;">
                                        <i class='bx bx-send'></i>
                                    </button>



                                </div>
                            </div>
                            <div id="table-container">
                                <table>

                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Application No.</th>
                                            <th>Nature of Degree</th>
                                            <th>Program</th>

                                            <th>Academic Clasiffication</th>
                                         
                                            <th>GWA</th>
                                            <th>Admission Score</th>

                                            <th>Action</th>
                                            <th style="display: none;" id="selectColumn">
                                                <input type="checkbox" id="selectAllCheckbox">
                                            </th>

                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            $count = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr data-id='{$row['id']}'>";
                                                echo "<td>{$count}</td>";
                                                echo "<td data-field='applicant_name'>{$row['applicant_name']}</td>";
                                                echo "<td data-field='applicant_number'>{$row['applicant_number']}</td>";
                                                echo "<td data-field='nature_of_degree'>{$row['nature_of_degree']}</td>";
                                                echo "<td  data-field='degree_applied'>{$row['degree_applied']}</td>";

                                            echo "<td>
                                                 <button type='button'  id='delete-btn' class='button delete-btn' onclick='deleteAdmissionData({$row['id']})'> <i class='bx bx-trash'></i></button>
                                                 <button type='button' id='edit-btn' class='button edit-btn' onclick='editAdmissionData({$row['id']})'><i class='bx bx-edit-alt'></i></button>
                                                 </td>";
                                                echo "<td  id='checkbox-{$row['id']}'><input type='checkbox'style='display: none;' class='select-checkbox'></td>";
                                                echo "</tr>";
                                                $count++;
                                            }
                                        } else {
                                            echo "<tr><td colspan='13'>No admission data found</td></tr>";
                                        }
                                        ?>



                                    </tbody>
                                </table>
                                <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header">
                                        <strong class="mr-auto">Success!</strong>

                                    </div>
                                    <div class="toast-body" id="toast-body"></div>
                                </div>
                                <div id="confirmationModal" class="modal">
                                    <div class="modal-content">
                                        <span class="close"></span>
                                        <p>Are you sure you want to send these applicants to the faculty?</p>
                                        <button id="confirmSend">Confirm</button>
                                        <button class="cancel">Cancel</button>
                                    </div>
                                </div>

                                <div id="deleteConfirmationModal" class="modal">
                                    <div class="modal-content">
                                        <span class="close"></span>
                                        <p>Are you sure you want to delete this student?</p>
                                        <button id="confirmDelete" class="yes">Confirm</button>
                                        <button class="cancel" onclick="closeDeleteConfirmationModal()">Cancel</button>
                                    </div>
                                </div>
                            </div>

                            <div id="deleteSelectedConfirmationModal" class="modal">
                                <div class="modal-content">
                                    <span class="close"></span>
                                    <p>Are you sure you want to delete the selected rows?</p>
                                    <button id="confirmDeleteSelected" class="yes">Confirm</button>
                                    <button class="cancel" onclick="closeDeleteSelectedConfirmationModal()">Cancel</button>
                                </div>
                            </div>
                            <div id="errorModal" class="modal">
                                <div class="modal-content">
                                    <span class="close"></span>
                                    <p id="errorMessage"></p>
                                    <button class="ok" onclick="closeErrorModal()">OK</button>
                                </div>
                            </div>
                            <div id="sendErrorModal" class="modal">
                                <div class="modal-content">
                                    <span class="close"></span>
                                    <p id="sendErrorMessage"></p>
                                    <button class="ok" onclick="closeSendErrorModal()">OK</button>
                                </div>
                            </div>

                            <style>
                                #sendButton {
                                    background-color: transparent;
                                    border: none;
                                    cursor: pointer;
                                    padding: 0;
                                }

                                #sendButton i {
                                    font-size: 14px;
                                    color: black;
                                }

                                #sendButton:hover i {
                                    color: green;
                                    transform: scale(1.2);
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

                                .modal {
                                    display: none;
                                    position: fixed;
                                    z-index: 1000;
                                    left: 0;
                                    top: 0;
                                    width: 100%;
                                    height: 100%;
                                    overflow: auto;
                                    background-color: rgba(0, 0, 0, 0.4);

                                }

                                /* Modal Content/Box */
                                .modal-content {
                                    background-color: #fefefe;
                                    margin: 15% auto;
                                    /* 15% from the top and centered */
                                    padding: 20px;
                                    border: 1px solid #888;
                                    width: 30%;
                                    /* Could be more or less, depending on screen size */
                                    border-radius: 10px;
                                }

                                /* Close Button */

                                .close:hover,
                                .close:focus {
                                    color: #000;
                                    text-decoration: none;
                                    cursor: pointer;
                                }

                                /* Buttons */
                                /* Buttons */
                                #confirmSend,
                                .yes,
                                .cancel {
                                    padding: 10px 15px;
                                    margin: 5px;
                                    border: none;
                                    border-radius: 5px;
                                    cursor: pointer;
                                    font-size: 14px;
                                    text-align: center;
                                    display: inline-block;
                                }

                                #confirmSend,
                                .yes {
                                    background-color: #4CAF50;
                                    /* Green color for "Confirm" button */
                                    color: white;
                                }

                                .cancel {
                                    background-color: #ff5757;
                                    /* Red color for "Cancel" button */
                                    color: white;
                                    float: right;
                                    /* Float the "Cancel" button to the right */
                                }

                                #confirmSend:hover,
                                .cancel:hover {
                                    opacity: 0.8;
                                }

                                .confirmation-message {
                                    background-color: #f44336;
                                    color: white;
                                    padding: 15px;
                                    border-radius: 5px;
                                    position: fixed;
                                    top: 50%;
                                    left: 50%;
                                    transform: translate(-50%, -50%);
                                    z-index: 1000;
                                }

                                #deleteConfirmationModal,
                                #errorModal,
                                #selectRowModal,
                                #sendSuccessModal {
                                    display: none;
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

                                function toggleSendButtonVisibility() {
                                    var sendButton = document.getElementById('sendButton');
                                    sendButton.style.display = (sendButton.style.display === 'none' || sendButton.style.display === '') ? 'block' : 'none';
                                }

                                // Add an event listener to the "Toggle Selection" button
                                document.getElementById('toggleSelection').addEventListener('click', toggleSendButtonVisibility);

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


                                function deleteAdmissionData(id) {
                                    // Display the delete confirmation modal
                                    var modal = document.getElementById('deleteConfirmationModal');
                                    modal.style.display = 'block';

                                    // Add a click event listener to the "Confirm" button in the modal
                                    document.getElementById('confirmDelete').addEventListener('click', function() {
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

                                                // Close the delete confirmation modal after processing
                                                closeDeleteConfirmationModal();
                                            }
                                        };

                                        // Encode the data to be sent in the request
                                        var data = "id=" + encodeURIComponent(id);
                                        xhr.send(data);
                                    });
                                }

                                // Function to close the delete confirmation modal
                                function closeDeleteConfirmationModal() {
                                    var modal = document.getElementById('deleteConfirmationModal');
                                    modal.style.display = 'none';
                                }
                                // Add an event listener to the "Delete Selected" button
                                document.getElementById('deleteSelected').addEventListener('click', function() {
                                    // Display the delete confirmation modal for selected rows
                                    var modal = document.getElementById('deleteSelectedConfirmationModal');
                                    modal.style.display = 'block';

                                    // Add a click event listener to the "Confirm" button in the modal
                                    document.getElementById('confirmDeleteSelected').addEventListener('click', function() {
                                        // Call the function to delete the selected admission data
                                        deleteSelectedAdmissionData();

                                        // Close the delete confirmation modal after processing
                                        closeDeleteSelectedConfirmationModal();
                                    });
                                });

                                // Function to close the delete confirmation modal for selected rows
                                function closeDeleteSelectedConfirmationModal() {
                                    var modal = document.getElementById('deleteSelectedConfirmationModal');
                                    modal.style.display = 'none';
                                }

                                function showErrorModal(message) {
                                    var errorModal = document.getElementById('errorModal');
                                    var errorMessage = document.getElementById('errorMessage');
                                    errorMessage.textContent = message;
                                    errorModal.style.display = 'block';
                                }

                                // Function to close the error modal
                                function closeErrorModal() {
                                    var errorModal = document.getElementById('errorModal');
                                    errorModal.style.display = 'none';
                                }
                                // Function to delete selected rows
                                function deleteSelectedAdmissionData() {
                                    // Get all checkboxes
                                    var checkboxes = document.querySelectorAll('.select-checkbox:checked');

                                    // Check if at least one checkbox is selected
                                    if (checkboxes.length > 0) {
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
                                                    // Show an error modal with a custom message
                                                    showErrorModal('Error deleting selected rows. Please try again.');
                                                }
                                            }
                                        };

                                        // Encode the data to be sent in the request
                                        var data = "selectedRowIds=" + encodeURIComponent(JSON.stringify(selectedRowIds));
                                        xhr.send(data);
                                    } else {
                                        // If no checkboxes are selected, show an error modal
                                        showErrorModal('Please select at least one student to delete.');
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
                                // Function to check/uncheck all checkboxes
                                function checkAllCheckboxes(checked) {
                                    var checkboxes = document.querySelectorAll('.select-checkbox');
                                    checkboxes.forEach(function(checkbox) {
                                        checkbox.checked = checked;
                                    });
                                }

                                // Add an event listener to the "selectAllCheckbox" checkbox
                                document.getElementById('selectAllCheckbox').addEventListener('change', function() {
                                    checkAllCheckboxes(this.checked);
                                });

                                // Add an event listener to the "Send" button
                                document.getElementById('sendButton').addEventListener('click', function() {
                                    // Show the confirmation modal
                                    var modal = document.getElementById('confirmationModal');
                                    modal.style.display = 'block';
                                });

                                // Get the confirmation modal
                                var modal = document.getElementById('confirmationModal');

                                // Get the <span> element that closes the modal
                                var span = document.getElementsByClassName('close')[0];

                                // When the user clicks on <span> (x), close the modal
                                span.onclick = function() {
                                    modal.style.display = 'none';
                                };

                                // When the user clicks anywhere outside of the modal, close it
                                window.onclick = function(event) {
                                    if (event.target == modal) {
                                        modal.style.display = 'none';
                                    }
                                };

                                // Add an event listener to the "Confirm" button in the confirmation modal
                                document.getElementById('confirmSend').addEventListener('click', function() {
                                    modal.style.display = 'none'; // Close the modal
                                    sendSelectedStudents(); // Proceed with sending the applicants
                                });

                                // Add an event listener to the "Cancel" button in the confirmation modal
                                document.getElementsByClassName('cancel')[0].addEventListener('click', function() {
                                    modal.style.display = 'none'; // Close the modal
                                });
  // Function to show a send success modal
  function showSendSuccessModal() {
    var sendSuccessModal = document.getElementById('sendSuccessModal');
    sendSuccessModal.style.display = 'block';
  }

  // Function to close the send success modal
  function closeSendSuccessModal() {
    var sendSuccessModal = document.getElementById('sendSuccessModal');
    sendSuccessModal.style.display = 'none';
  }

  // Function to show a send error modal with a custom message
  function showSendErrorModal(message) {
    var sendErrorModal = document.getElementById('sendErrorModal');
    var sendErrorMessage = document.getElementById('sendErrorMessage');
    sendErrorMessage.textContent = message;
    sendErrorModal.style.display = 'block';
  }

  // Function to close the send error modal
  function closeSendErrorModal() {
    var sendErrorModal = document.getElementById('sendErrorModal');
    sendErrorModal.style.display = 'none';
  }


  function sendSelectedStudents() {
    // Get all checkboxes
    var checkboxes = document.querySelectorAll('.select-checkbox:checked');

    // Check if at least one checkbox is selected
    if (checkboxes.length > 0) {
      // Create an array to store the selected row IDs
      var selectedRowIds = [];

      // Iterate over selected checkboxes and store the corresponding row IDs
      checkboxes.forEach(function(checkbox) {
        var row = checkbox.closest('tr');
        var rowId = row.getAttribute('data-id');
        selectedRowIds.push(rowId);
      });

      // Send an AJAX request to update the 'sent' field in the database
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "send_selected_applicants.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          if (response.success) {
            // Show a success modal
            showSendSuccessModal();

            // Optionally, you can update the UI or perform other actions here
          } else {
            // Show a send error modal with a custom message
            showSendErrorModal('Error updating sent status. Please try again.');
          }
        }
      };

      // Encode the data to be sent in the request
      var data = "selectedRowIds=" + encodeURIComponent(JSON.stringify(selectedRowIds));
      xhr.send(data);
    } else {
      // If no checkboxes are selected, show a send error modal
      showSendErrorModal('Please select at least one student to send.');
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
<?php
include("config.php");
include("facultyCover.php");

// Check if the user is logged in and has the faculty user type
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Faculty') {
    header("Location: loginpage.php");
    exit();
}

// Fetch user's department
$userId = $_SESSION['user_id'];
$fetchDepartmentQuery = "SELECT Department FROM users WHERE id = ?";
$stmtFetchDepartment = $conn->prepare($fetchDepartmentQuery);
$stmtFetchDepartment->bind_param("i", $userId);
$stmtFetchDepartment->execute();
$stmtFetchDepartment->bind_result($userDepartment);
$stmtFetchDepartment->fetch();
$stmtFetchDepartment->close();

$fetchProgramDetailsQuery = "SELECT * FROM programs WHERE Description = ?";
$stmtFetchProgramDetails = $conn->prepare($fetchProgramDetailsQuery);
$stmtFetchProgramDetails->bind_param("s", $userDepartment); // Using $userDepartment instead of undefined $department
$stmtFetchProgramDetails->execute();
$stmtFetchProgramDetails->bind_result($programID, $courses, $natureOfDegree, $description, $overallSlots);

?>
<section id="content">
    <main>
        <!-- Dashboard -->
        <div id="dashboard-content">
            <div class="head-title">
                <div class="left">
                    <h1>Slots</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Slots</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="adminDashboard.php">Home</a></li>
                    </ul>
                </div>
            </div>

                            <div id="master-list">
                <div class="table-data">
                    <div class="order">
                        <div class="head">
                            <h3><?php echo $userDepartment; ?> Slots</h3>

                            <div class="headfornaturetosort">
                                

                              



                            </div>
                        </div>
                        <div id="table-container">
                            <table id="searchableTable">
                                <thead>
                                    <tr>
                                        
                                        <th>Course</th>
                                    
                                        <th>Slots</th>

                                        <th>Action</th>
                                    </tr>

                                </thead>
                                <tbody> 
                                <?php
                                    // Fetch all rows and display in the table
                                    $counter = 1;
                                    while ($stmtFetchProgramDetails->fetch()) {
                                        echo "<tr data-id='{$programID}' class='list-row'>";
                                        
                                        echo "<td  data-field='Description' contenteditable>{$description}</td>";
                                        echo "<td class='editable' data-field='Overall_Slots' contenteditable>{$overallSlots}</td>";
                                        echo "<td>
                                               
                                                <button type='button' id='edit-btn' class='button edit-btn' onclick='editCourse({$programID})'>
                                                    <i class='bx bx-edit-alt'></i>
                                                </button>
                                              </td>";
                                        echo "</tr>";
                                        $counter++;
                                    }
                                    ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>

</tbody>

<div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <strong class="mr-auto">Changes Saved Succesfully !</strong>

    </div>

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
    function editCourse(programID) {
    // Get the row element
    var row = document.querySelector(`tr[data-id='${programID}']`);

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

    // Change the content of the "Edit" button to a "Save" icon
    var editButton = row.querySelector('.edit-btn');
    editButton.innerHTML = '<i class="bx bx-save"></i>';
    editButton.classList.add('save-btn', 'transition-class'); // Add transition-class for the animation
    editButton.onclick = function() {
        saveCourse(programID);

        // Hide the blue bottom border after saving
        editableCells.forEach(function(cell) {
            cell.style.borderBottom = 'none';
        });
    };
}


function saveCourse(programID) {
    // Get the row element
    var row = document.querySelector(`tr[data-id='${programID}']`);

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
    xhr.open('POST', 'save_course.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Display a toast notification for successful save
            var toast = document.getElementById('toast');
            toast.classList.add('show');
            setTimeout(function() {
                toast.classList.remove('show');
            }, 3000);

            // Change the "Save" button back to "Edit" with the "Edit" icon
            var editButton = row.querySelector('.edit-btn');
            editButton.innerHTML = '<i class="bx bx-edit-alt"></i>';
            editButton.classList.remove('save-btn', 'transition-class'); // Remove the class to remove the green styling and animation
            editButton.onclick = function() {
                editCourse(programID);
            };

            // Loop through each editable cell to make them non-editable
            editableCells.forEach(function(cell) {
                cell.contentEditable = false;
                cell.classList.remove('editing');
                cell.style.borderBottom = 'none';
            });
        }
    };
    xhr.send(JSON.stringify({
        programID: programID,
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
    function addCourse() {
    // Get the "Add Course" row
    var addCourseRow = document.getElementById('addCourseRow');

    // Toggle the visibility of the "Add Course" row
    addCourseRow.style.display = addCourseRow.style.display === 'none' ? 'table-row' : 'none';

    // Toggle the visibility of the list rows
    var listRows = document.querySelectorAll('#table-container table tbody tr.list-row');
    listRows.forEach(function(row) {
        row.style.display = addCourseRow.style.display === 'none' ? 'table-row' : 'none';
    });

    // Change the button text based on visibility
    var addButton = document.getElementById('addCourses');
    addButton.innerHTML = addCourseRow.style.display === 'none' ?
        '<i class=\'bx bx-add-to-queue\'></i> Add Course' :
        '<i class=\'bx bx-arrow-back\'></i> Hide Add Course';

    // If the "Add Course" row is visible, focus on the first editable cell
    if (addCourseRow.style.display !== 'none') {
        var editableCell = addCourseRow.querySelector('.editable');
        editableCell.focus();
    }
}



    function saveNewCourse() {
        // Get the "Add Course" row
        var addCourseRow = document.getElementById('addCourseRow');

        // Get all editable cells in the "Add Course" row
        var editableCells = addCourseRow.querySelectorAll('.editable');

        // Create an object to store the new course data
        var newCourseData = {};

        // Loop through each editable cell and store the new value
        editableCells.forEach(function(cell) {
            var fieldName = cell.getAttribute('data-field');
            var newValue = cell.innerText.trim();
            newCourseData[fieldName] = newValue;
        });

        // Send an AJAX request to add the new course to the database
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_course.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // Hide the "Add Course" row after saving
                    addCourseRow.style.display = 'none';

                    // Change the button back to "Add Course"
                    var addButton = document.getElementById('addCourses');
                    addButton.innerHTML = '<i class=\'bx bx-add-to-queue\'></i> Add Course';
                    addButton.onclick = function() {
                        addCourse();
                    };

                    // Show a success toast
                    showSuccessToast();

                    // Reload the Courses.php page after a delay of 2000 milliseconds (2 seconds)
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
            newCourseData: newCourseData
        }));
    }



    function cancelAddCourse() {
    // Get the "Add Course" row
    var addCourseRow = document.getElementById('addCourseRow');

    // Hide the "Add Course" row
    addCourseRow.style.display = 'none';

    // Show the list rows
    var listRows = document.querySelectorAll('#table-container table tbody tr.list-row');
    listRows.forEach(function(row) {
        row.style.display = 'table-row';
    });

    // Change the button text back to "Add Course"
    var addButton = document.getElementById('addCourses');
    addButton.innerHTML = '<i class=\'bx bx-add-to-queue\'></i> Add Course';
}


    function deleteCourse(programID) {
        // Confirm with the user before deleting
        if (confirm("Are you sure you want to delete this course?")) {
            // Send an AJAX request to delete the course
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_course.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // Remove the deleted row from the table
                        var row = document.querySelector(`tr[data-id='${programID}']`);
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
            var data = "programID=" + encodeURIComponent(programID);
            xhr.send(data);
        }
    }
</script>
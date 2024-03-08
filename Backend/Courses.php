<?php
session_start();
include("config.php");
include("adminCover.php");

// Handle search query
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Modify the SQL query to order by Nature_of_Degree and then by Courses
$sql = "SELECT * FROM `programs` WHERE 
        `Courses` LIKE '%$search%' OR 
        `Nature_of_Degree` LIKE '%$search%' OR 
        `College` LIKE '%$search%'
       
        ORDER BY `Nature_of_Degree` ASC, `Courses` ASC";

$result = $conn->query($sql);
?>
<section id="content">
    <main>
        <!-- Dashboard -->
        <div id="dashboard-content">
            <div class="head-title">
                <div class="left">
                    <h1>Courses</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Courses</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="adminDashboard.php">Home</a></li>
                    </ul>
                </div>
            </div>

            <div id="master-list">
                <div class="table-data">
                    <div class="order">
                        <div class="head">
                            <h3>List of Courses</h3>

                            <div class="headfornaturetosort">


                                <label for="rangeInput"></label>
                                <input class="ForRange" type="text" id="rangeInput" name="rangeInput" placeholder="1-10" />
                                <button type="button" id="viewButton">
                                    <i class='bx bx-filter'></i>
                                </button>


                                <button type='button' id="addCourses" onclick='addCourse()'>
                                    <i class='bx bx-add-to-queue'></i> Add Course
                                </button>



                            </div>
                        </div>
                        <div id="table-container">
                            <table id="searchableTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>College</th>
                                        <th>Course</th>
                                        <th>Nature of Degree</th>
                                        <th>No. of Sections</th>
                                        <th>No. of Students per Sections</th>
                                        <th>Slots</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr id="addCourseRow" style="display: none;">
                                        <td>#</td>
                                        <td style="border-bottom: 2px solid blue;" contenteditable="true" class="editable" data-field="College"></td>
                                        <td style="border-bottom: 2px solid blue;" contenteditable="true" class="editable" data-field="Courses"></td>
                                        <td>
                                            <select name="nature_of_degree">
                                                <option value="Board">Board</option>
                                                <option value="Non-Board">Non-Board</option>
                                            </select>

                                        </td>

                                        <td style="border-bottom: 2px solid blue;" contenteditable="true" class="editable" data-field="No_of_Sections"></td>
                                        <td style="border-bottom: 2px solid blue;" contenteditable="true" class="editable" data-field="No_of_Students_Per_Section"></td>
                                        <td style="border-bottom: 2px solid blue;" contenteditable="true" class="editable" data-field="Number_of_Available_Slots"></td>

                                        <td>
                                            <button type='button' class='button cancel-btn' onclick='cancelAddCourse()'>Cancel</button>
                                            <button type='button' class='button saved-btn' onclick='saveNewCourse()'>Save</button>

                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        $count = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr data-id='{$row['ProgramID']}' class='list-row'>";
                                            echo "<td>{$count}</td>";

                                            echo "<td class='editable' data-field='College'>{$row['College']}</td>";
                                            echo "<td class='editable' data-field='Courses'>{$row['Courses']}</td>";
                                            echo "<td class='editable' data-field='Nature_of_Degree'>{$row['Nature_of_Degree']}</td>";
                                            echo "<td class='editable' data-field='No_of_Sections'>{$row['No_of_Sections']}</td>";
                                            echo "<td class='editable' data-field='No_of_Students_Per_Section'>{$row['No_of_Students_Per_Section']}</td>";
                                            echo "<td class='editable' data-field='Number_of_Available_Slots'>{$row['Number_of_Available_Slots']}</td>";
                                            echo "<td>
                                        <button type='button' id='delete-btn' class='button delete-btn' onclick='deleteCourse({$row['ProgramID']})'>
                                        <i class='bx bx-trash'></i>
                                        <button type='button' id='edit-btn' class='button edit-btn' onclick='editCourse({$row['ProgramID']})'>
                                            <i class='bx bx-edit-alt'></i>
                                            </button>
                                         </button>
                                             
                                    
                                               </td>";
                                            echo "</tr>";
                                            $count++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No courses found</td></tr>";
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
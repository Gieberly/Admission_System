<?php

include("config.php");
include("personnelcover.php");


// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'staff') {
    header("Location: loginpage.php");
    exit();
}

// Retrieve student data from the database
// Modify your SQL query to include a WHERE clause
$query = "SELECT id, applicant_name, applicant_number, academic_classification, email, math_grade, science_grade, english_grade, gwa_grade, rank, result, nature_of_degree, degree_applied FROM admission_data WHERE degree_applied IN 
(  'Bachelor of Science in Agricultural and Biosystems Engineering') ORDER BY applicant_name ASC";

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
                        <h1>Colleges</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Colleges</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><p">BSA</p></li>
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
                                <!--Drop Down for Nature of Degree--> 
                        
                                
 <label for="rangeInput"></label>
<input class="ForRange" type="text" id="rangeInput" name="rangeInput" placeholder="1-10" />
<button type="button" id="viewButton">
<i class='bx bx-filter' ></i>
</button>

<!-- Add this button to your HTML -->
<button type="button" id="sortButton">
<i class='bx bx-sort-down'></i> Rank
</button>
<button type="button" id="sortAZ">
  <i class='bx bx-sort-a-z'></i> <!-- Sort A-Z -->
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
                            <th>Rank</th>
                            <th>Result</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
$counter = 1;
while ($row = $result->fetch_assoc()) {
    ?>
    <tr>
        <td><?php echo $counter++; ?> <?php echo '<span style="display: none;">' . $row['id'] . '</span>'; ?>
        </td>
        
        <td contenteditable="true" class="edit" data-id="<?php echo $row['id']; ?>" data-column="applicant_number"><?php echo $row['applicant_number']; ?></td>
        <td contenteditable="true" class="edit" data-id="<?php echo $row['id']; ?>" data-column="nature_of_degree"><?php echo $row['nature_of_degree']; ?></td>
        <td contenteditable="true" class="edit" data-id="<?php echo $row['id']; ?>" data-column="degree_applied"><?php echo $row['degree_applied']; ?></td>
        <td contenteditable="true" class="edit" data-id="<?php echo $row['id']; ?>" data-column="applicant_name"><?php echo $row['applicant_name']; ?></td>
        <td contenteditable="true" class="edit" data-id="<?php echo $row['id']; ?>" data-column="academic_classification"><?php echo $row['academic_classification']; ?></td>
        <td contenteditable="true" class="edit" data-id="<?php echo $row['id']; ?>" data-column="math_grade"><?php echo $row['math_grade']; ?></td>
        <td contenteditable="true" class="edit" data-id="<?php echo $row['id']; ?>" data-column="science_grade"><?php echo $row['science_grade']; ?></td>
        <td contenteditable="true" class="edit" data-id="<?php echo $row['id']; ?>" data-column="english_grade"><?php echo $row['english_grade']; ?></td>
        <td contenteditable="true" class="edit" data-id="<?php echo $row['id']; ?>" data-column="gwa_grade"><?php echo $row['gwa_grade']; ?></td>
        <td contenteditable="true" class="edit" data-id="<?php echo $row['id']; ?>" data-column="rank"><?php echo $row['rank']; ?></td>
        <td contenteditable="true" class="edit" data-id="<?php echo $row['id']; ?>" data-column="result"><?php echo $row['result']; ?></td>
        <td>
            <button class="button delete" data-id="<?php echo $row['id']; ?>">Delete</button>
        </td>
    </tr>
    <?php
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

<script>
        // Function to update the Rank column based on the order of the rows
        function updateRankColumn() {
        var rows = $('#table-container table tbody tr');
        rows.each(function (index, row) {
            $(row).find('td[data-column="rank"]').text(index + 1);
        });
    }
$(document).ready(function () {
    // Enable editing on click
    $('.edit').on('blur', function () {
        var id = $(this).data('id');
        var column = $(this).data('column');
        var value = $(this).text();

        // Update the column via AJAX
        $.ajax({
            url: 'saveChanges.php',
            type: 'POST',
            data: {
                id: id,
                column: column,
                value: value
            },
            success: function (response) {
                console.log(response);
            }
        });
    });
 


   $('#sortButton').on('click', function () {
    // Reset the counter to 1
    var counter = 1;

    // Get all table rows
    var rows = $('#table-container table tbody tr');

    // Sort the rows based on GWA values in descending order
    rows.sort(function (a, b) {
        var gwaA = parseFloat($(a).find('td[data-column="gwa_grade"]').text());
        var gwaB = parseFloat($(b).find('td[data-column="gwa_grade"]').text());

        if (isNaN(gwaA) || isNaN(gwaB)) {
            return 0; // Handle cases where GWA is not a valid number
        }

        return gwaB - gwaA; // Sort in descending order
    });

    // Update the table with the sorted rows and reset the counter for displayed rows
    $('#table-container table tbody').html(rows).find('td:first-child').text(function () {
        return counter++;
    });

    // Reset the rank column based on the new order
    updateRankColumn();
});

 // Delete button click event
 $('.delete').on('click', function () {
        var id = $(this).data('id');

        // Confirm deletion
        if (confirm("Are you sure you want to delete this entry?")) {
            // Send AJAX request to delete the row
            $.ajax({
                url: 'deleteStudentPersonnel.php', // Replace with the actual server-side script
                type: 'POST',
                data: {
                    id: id
                },
                success: function (response) {
                    console.log(response);
                    // Reload the page or update the table as needed
                    location.reload(); // Example: Reload the page
                }
            });
        }
    });


// JavaScript to show and hide the toast
function showToast(message) {
    var toast = new bootstrap.Toast(document.getElementById('toast-body'));
    document.getElementById('toast-body').innerText = message;
    $('#toast').addClass('show');
    toast.show();

    // Automatically hide the toast after 3 seconds (adjust as needed)
    setTimeout(function () {
        $('#toast').removeClass('show');
    }, 3000);
}


});

 // Sort A-Z button click event
 $('#sortAZ').on('click', function () {
    // Reset the counter to 1
    var counter = 1;

    // Get all table rows
    var rows = $('#table-container table tbody tr');

    // Sort the rows based on Name column in ascending order
    rows.sort(function (a, b) {
        var nameA = $(a).find('td[data-column="applicant_name"]').text().toLowerCase();
        var nameB = $(b).find('td[data-column="applicant_name"]').text().toLowerCase();

        return nameA.localeCompare(nameB);
    });

    // Get the existing rank order before sorting
    var existingRanks = [];
    rows.each(function (index, row) {
        existingRanks.push($(row).find('td[data-column="rank"]').text());
    });

    // Update the table with the sorted rows and reset the counter for displayed rows
    $('#table-container table tbody').html(rows).find('td:first-child').text(function () {
        return counter++;
    });

    // Reset the rank column based on the existing order
    rows.each(function (index, row) {
        $(row).find('td[data-column="rank"]').text(existingRanks[index]);
    });
});

    function filterStudents() {
    // Reset the counter to 1
    var counter = 1;

    var selectedProgram = document.getElementById("ProgramDropdown").value.toLowerCase(); // Assuming you have a dropdown for programs

    // Get all table rows
    var rows = document.querySelectorAll("#table-container table tbody tr");

    // Loop through each row and show/hide based on the selected program
    rows.forEach(function (row) {
        var program = row.querySelector("td[data-column='degree_applied']").innerText.trim().toLowerCase(); // Assuming your column for the program is 'degree_applied'

        if (selectedProgram === "all" || selectedProgram === program) {
            row.style.display = "";
            // Update the counter for displayed rows
            row.querySelector("td:first-child").innerText = counter++;
        } else {
            row.style.display = "none";
        }
    });
}

$('#viewButton i').on('click', function () {
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

            rows.each(function (index, row) {
                if (index + 1 >= start && index + 1 <= end) {
                    $(row).show();
                } else {
                    $(row).hide();
                }
            });
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
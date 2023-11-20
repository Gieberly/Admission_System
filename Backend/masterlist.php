<?php

include("config.php");
include("personnelcover.php");


// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'staff') {
    header("Location: loginpage.php");
    exit();
}

// Retrieve student data from the database
$query = "SELECT id, applicant_name,applicant_number, email, math_grade, science_grade, english_grade, gwa_grade, rank, result, nature_of_degree, degree_applied FROM admission_data";
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
                        <h1>Master List</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Master List</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="staff.html">Home</a></li>
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
<select class="NatureDropdown" id="NatureofDegree" onchange="filterStudents()">
    <option value="all">All</option>
    <option value="Non-Board">Non-Board</option>
    <option value="Board">Board</option>
</select>
                                  
                                   <!-- Dropdown for Non-Board Programs -->
                                   <select class="nonboardProgram" id="nonBoard">
                                       <option value disabled selected>Non-Board Programs</option>
                                       <option value="BSIT">BSED</option>
                                       <option value="BLIS">LET</option>
                                   </select>
               
                                   <!-- Dropdown for Board Programs -->
                                   <select class="boardProgram" id="Board">
                                   <label for="board-programs">Board Programs</label>
                                       <option value="BSIT">BSED</option>
                                       <option value="BLIS">LET</option>
                                   </select>
                                
 <label for="rangeInput"></label>
<input class="ForRange" type="text" id="rangeInput" name="rangeInput" placeholder="1-10" />
<button type="button" id="viewButton">
    <i class='bx bx-show'></i> 
</button>

                                    <button type="button" id="sortButton">
                                    <i class='bx bx-sort'></i> Sort
                                    </button>


                            </div>
                            </div>
            <div id="table-container">
                <table>
                <colgroup>
                                        <col style="width: 3%;">
                                        <col style="width: 5%;">
                                        <col style="width: 8%;">
                                        <col style="width: 17%;">
                                        <col style="width: 15%;">
                                        <col style="width: 13%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 9%;">
                                      
                                       
                                    </colgroup>
                    <thead>
                        <tr>
                            <th>#</th>
                            
                            <th>Application No.</th>
                            <th>Nature of Degree</th>
                            <th>Program</th>
                            <th>Name</th>
                            <th>Email</th>
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
        <td><?php echo $row['applicant_number']; ?></td>
        <td data-column="nature_of_degree"><?php echo $row['nature_of_degree']; ?></td> <!-- Add this line -->
        <td><?php echo $row['degree_applied']; ?></td>
        <td><?php echo $row['applicant_name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td contenteditable="true" class="edit" data-id="<?php echo $row['id']; ?>" data-column="math_grade"><?php echo $row['math_grade']; ?></td>
        <td contenteditable="true" class="edit" data-id="<?php echo $row['id']; ?>" data-column="science_grade"><?php echo $row['science_grade']; ?></td>
        <td contenteditable="true" class="edit" data-id="<?php echo $row['id']; ?>" data-column="english_grade"><?php echo $row['english_grade']; ?></td>
        <td contenteditable="true" class="edit" data-id="<?php echo $row['id']; ?>" data-column="gwa_grade"><?php echo $row['gwa_grade']; ?></td>
        <td contenteditable="true" class="edit" data-id="<?php echo $row['id']; ?>" data-column="rank"><?php echo $row['rank']; ?></td>
        <td contenteditable="true" class="edit" data-id="<?php echo $row['id']; ?>" data-column="result"><?php echo $row['result']; ?></td>
        <td>
            <button class="save" data-id="<?php echo $row['id']; ?>">Save</button>
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

    $('.save').on('click', function () {
    var id = $(this).data('id');

    // Update "Result" via AJAX
    $.ajax({
        url: 'saveChanges.php',
        type: 'POST',
        data: {
            id: id,
            column: 'result',
            value: $('.edit[data-id="' + id + '"][data-column="result"]').text()
        },
        success: function (response) {
            // Display a toast notification
            showToast('');
            console.log(response);
        }
    });
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

function filterStudents() {
    var selectedValue = document.getElementById("NatureofDegree").value.toLowerCase(); // Convert to lowercase

    // Get all table rows
    var rows = document.querySelectorAll("#table-container table tbody tr");

    // Loop through each row and show/hide based on the selected value
    rows.forEach(function (row) {
        var natureOfDegree = row.querySelector("td[data-column='nature_of_degree']").innerText.trim().toLowerCase(); // Convert to lowercase

        if (selectedValue === "all" || selectedValue === natureOfDegree) {
            row.style.display = "";
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
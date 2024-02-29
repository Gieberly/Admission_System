<?php

include("config.php");
include("Personnel_Cover.php");


// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Staff') {
    header("Location: loginpage.php");
    exit();
}

// Retrieve student data from the database
// Modify your SQL query to include a WHERE clause
// Retrieve student data from the database
$search = isset($_GET['search']) ? $_GET['search'] : '';

$query = "SELECT id, applicant_name, applicant_number, academic_classification, email, math_grade, science_grade, english_grade, gwa_grade, rank, result, nature_of_degree, degree_applied 
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
            `rank` LIKE '%$search%' OR 
            `result` LIKE '%$search%' OR 
            `nature_of_degree` LIKE '%$search%' OR 
            `degree_applied` LIKE '%$search%'
          ORDER BY applicant_name ASC";

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

                                
 <label for="rangeInput"></label>
<input class="ForRange" type="text" id="rangeInput" name="rangeInput" placeholder="1-10" />
<button type="button" id="viewButton">
<i class='bx bx-filter' ></i>
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
if ($result->num_rows > 0) {
    $count = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr data-id='{$row['id']}'>";
        echo "<td>{$count}</td>";
        echo "<td class='editable' data-field='applicant_number'>{$row['applicant_number']}</td>";
        echo "<td class='editable' data-field='nature_of_degree'>{$row['nature_of_degree']}</td>";
        echo "<td class='editable' data-field='degree_applied'>{$row['degree_applied']}</td>";
        echo "<td class='editable' data-field='applicant_name'>{$row['applicant_name']}</td>";
        echo "<td class='editable' data-field='academic_classification'>{$row['academic_classification']}</td>";
        echo "<td class='editable' data-field='math_grade'>{$row['math_grade']}</td>";
        echo "<td class='editable' data-field='science_grade'>{$row['science_grade']}</td>";
        echo "<td class='editable' data-field='english_grade'>{$row['english_grade']}</td>";
        echo "<td class='editable' data-field='gwa_grade'>{$row['gwa_grade']}</td>";
        echo "<td class='editable' data-field='rank'>{$row['rank']}</td>";
        echo "<td class='editable' data-field='result'>{$row['result']}</td>";
        echo "<td>
              <button type='button' class='button delete-btn' onclick='deleteAdmissionData({$row['id']})'>Delete</button>
              <button type='button' class='button edit-btn' onclick='editAdmissionData({$row['id']})'>Edit</button>
               </td>";
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
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body" id="toast-body"></div>
</div>

<script>
     

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
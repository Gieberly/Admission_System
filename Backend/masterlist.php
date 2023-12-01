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

$query = "SELECT id, applicant_name, applicant_number, academic_classification, email, math_grade, science_grade, english_grade, gwa_grade, rank, result, nature_of_degree, degree_applied 
          FROM admission_data 
          WHERE 
            (`applicant_name` LIKE '%$search%' OR 
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
            `degree_applied` LIKE '%$search%')
            AND (`result` = 'NOR' OR `result` = 'NOA')
            ORDER BY applicant_name ASC, nature_of_degree ASC, degree_applied ASC";

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
                    <a href="#" class="btn-download" id="downloadLink">Download </a>
                    
                    
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




                    </div>
                            </div>
            <div id="table-container">
            <table id="studentTable">

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
        
        <td data-id="<?php echo $row['id']; ?>" data-column="applicant_number"><?php echo $row['applicant_number']; ?></td>
        <td data-id="<?php echo $row['id']; ?>" data-column="nature_of_degree"><?php echo $row['nature_of_degree']; ?></td>
        <td data-id="<?php echo $row['id']; ?>" data-column="degree_applied"><?php echo $row['degree_applied']; ?></td>
        <td data-id="<?php echo $row['id']; ?>" data-column="applicant_name"><?php echo $row['applicant_name']; ?></td>
        <td data-id="<?php echo $row['id']; ?>" data-column="academic_classification"><?php echo $row['academic_classification']; ?></td>
        <td data-id="<?php echo $row['id']; ?>" data-column="math_grade"><?php echo $row['math_grade']; ?></td>
        <td data-id="<?php echo $row['id']; ?>" data-column="science_grade"><?php echo $row['science_grade']; ?></td>
        <td data-id="<?php echo $row['id']; ?>" data-column="english_grade"><?php echo $row['english_grade']; ?></td>
        <td data-id="<?php echo $row['id']; ?>" data-column="gwa_grade"><?php echo $row['gwa_grade']; ?></td>
        <td data-id="<?php echo $row['id']; ?>" data-column="result"><?php echo $row['result']; ?></td>
       

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
        document.addEventListener('DOMContentLoaded', function () {
    // Add an event listener to the Download button
    document.getElementById('downloadLink').addEventListener('click', function () {
        // Call the function to generate and download the CSV
        downloadTableAsCSV('studentTable');
    });

    // Function to generate and download the CSV
    function downloadTableAsCSV(tableId) {
        // Get the table element by id
        var table = document.getElementById(tableId);

        // Create an empty array to store the rows of the CSV
        var rows = [];

        // Iterate over the rows of the table
        for (var i = 0; i < table.rows.length; i++) {
            var row = [];
            // Iterate over the cells of each row
            for (var j = 0; j < table.rows[i].cells.length; j++) {
                // Check if the current column is the 'Name' column (columns 4 to 8)
                if (j >= 4 && j <= 8) {
                    row.push(table.rows[i].cells[j].innerText);
                }
                // Check if the current column is not the 'Name' column
                else if (j !== 4) {
                    row.push(table.rows[i].cells[j].innerText);
                }
            }
            // Join the row array with commas and add to the rows array
            rows.push(row.join(', '));
        }

        // Join the rows array with newline characters to create the CSV data
        var csvData = rows.join('\n');

        // Create a Blob containing the CSV data
        var blob = new Blob([csvData], { type: 'text/csv' });

        // Create a download link for the Blob
        var downloadLink = document.createElement('a');
        downloadLink.href = URL.createObjectURL(blob);
        downloadLink.download = 'student_data.csv';

        // Append the download link to the document and trigger the download
        document.body.appendChild(downloadLink);
        downloadLink.click();

        // Remove the download link from the document
        document.body.removeChild(downloadLink);
    }
});


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
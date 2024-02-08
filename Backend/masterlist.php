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

$query = "SELECT id, applicant_name, applicant_number, academic_classification, email, math_grade, math_2, math_3, science_grade, science_2, science_3, english_grade, english_2, english_3, gwa_grade, result, nature_of_degree, degree_applied 
          FROM admission_data 
          WHERE 
            (`applicant_name` LIKE '%$search%' OR 
            `applicant_number` LIKE '%$search%' OR 
            `academic_classification` LIKE '%$search%' OR 
            `email` LIKE '%$search%' OR 
            `math_grade` LIKE '%$search%' OR 
            `math_2` LIKE '%$search%' OR 
            `math_3` LIKE '%$search%' OR 
            `science_grade` LIKE '%$search%' OR
            `science_2` LIKE '%$search%' OR  
            `science_3` LIKE '%$search%' OR 
            `english_grade` LIKE '%$search%' OR 
            `english_2` LIKE '%$search%' OR 
            `english_3` LIKE '%$search%' OR 
            `gwa_grade` LIKE '%$search%' OR 
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
                        <h1>Applicants</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Applicants</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li>
                            <li><a class="active" href="personnel.php">Home</a></li>
                            </li>
                        </ul>
                    </div>
                    <a href="excel_export_masterlist.php" class="btn-download">
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
                                            <th>M 1</th>
                                            <th>M 2</th>
                                            <th>M 3</th>
                                            <th>S 1</th>
                                            <th>S 2</th>
                                            <th>S 3</th>
                                            <th>E 1</th>
                                            <th>E 2</th>
                                            <th>E 3</th>
                                            <th>GWA</th>
                                            <th>Result</th>

                                            <th>Action</th>
                                            <th style="display: none;" id="selectColumn">Select</th>
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

                                                echo "<td  <td data-field='academic_classification'>{$row['academic_classification']}</td>";
                                                echo "<td  data-field='math_grade'>{$row['math_grade']}</td>";
                                                echo "<td  data-field='math_2'>{$row['math_2']}</td>";
                                                echo "<td  data-field='math_3'>{$row['math_3']}</td>";
                                                echo "<td  data-field='science_grade'>{$row['science_grade']}</td>";
                                                echo "<td  data-field='science_2'>{$row['science_2']}</td>";
                                                echo "<td  data-field='science_3'>{$row['science_3']}</td>";
                                                echo "<td  data-field='english_grade'>{$row['english_grade']}</td>";
                                                echo "<td  data-field='english_2'>{$row['english_2']}</td>";
                                                echo "<td  data-field='english_3'>{$row['english_3']}</td>";
                                                echo "<td  data-field='gwa_grade'>{$row['gwa_grade']}</td>";
                                                echo "<td class='editable' data-field='result'>{$row['result']}</td>";
                                                
                                                echo "<td>
                                               
                                                <button type='button' id='noa-qa-btn' class='button' onclick='yourFunctionForNoaQa({$row['id']})'>NOA(Q-A)</button> <br>
                                                <button type='button' id='noa-nqa-btn' class='button' onclick='yourFunctionForNoaNqa({$row['id']})'>NOA(NQ-A)</button> <br>
                                                <button type='button' id='nor-qa-btn' class='button' onclick='yourFunctionForNorQa({$row['id']})'>NOR(Q-NA)</button> <br>
                                                <button type='button' id='nor-nqa-btn' class='button' onclick='yourFunctionForNorNqa({$row['id']})'>NOR(NQ-NA)</button> <br>
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
                                </style>

                                <script>
                       
                                </script>



                            </div><!-- Add this script to your HTML file -->
<script>
    function updateStatus(id, newStatus) {
        // Make an AJAX request to update the database
        $.ajax({
            type: 'POST',
            url: 'Personnel_updateResult.php', // Create a separate PHP file for handling the update
            data: {
                id: id,
                newStatus: newStatus
            },
            success: function(response) {
                // Handle the response, for example, show a success message or update the UI
                console.log(response);
            },
            error: function(error) {
                // Handle errors
                console.error(error);
            }
        });
    }

    function yourFunctionForNoaQa(id) {
        // Call the updateStatus function with the appropriate parameters
        updateStatus(id, 'NOA(Q-A)');
    }

    function yourFunctionForNoaNqa(id) {
        updateStatus(id, 'NOA(NQ-A)');
    }

    function yourFunctionForNorQa(id) {
        updateStatus(id, 'NOR(Q-NA)');
    }

    function yourFunctionForNorNqa(id) {
        updateStatus(id, 'NOR(NQ-NA)');
    }
</script>


                        </div>
                    </div>
                </div>
            </div>



        </main>
        <!-- MAIN -->


    </section>
</body>

</html>
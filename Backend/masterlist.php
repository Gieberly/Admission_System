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

$query = "SELECT id, applicant_name, applicant_number, academic_classification, email, math_grade, math_2, math_3, science_grade, science_2, science_3, english_grade, english_2, english_3, gwa_grade, test_score, result, nature_of_degree, degree_applied 
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
            `test_score` LIKE '%$search%' OR 
            `result` LIKE '%$search%' OR 
            `nature_of_degree` LIKE '%$search%' OR 
            `degree_applied` LIKE '%$search%')
            AND `result` IS NOT NULL
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
                                            <th>Math 1</th>
                                            <th>Math 2</th>
                                            <th>Math 3</th>
                                            <th>Math 1</th>
                                            <th>Science 2</th>
                                            <th>Science 3</th>
                                            <th>English 1</th>
                                            <th>English 2</th>
                                            <th>English 3</th>
                                            <th>GWA</th>
                                           c
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
                                                echo "<td  data-field='test_score'>{$row['test_score']}</td>";
                                                echo "<td class='editable' data-field='result'>{$row['result']}</td>";

                                                echo "<td>";
                                                echo "<button type='button' id='edit-btn' class='button edit-btn' onclick='editAdmissionData({$row['id']})'><i class='bx bx-edit-alt'></i></button>";
                                                echo "<select class='button dropdown-button' onchange='selectOption(this.value, {$row['id']})'>";
                                                echo "<option value=''>Choose an option</option>";
                                                echo "<option value='NOA(Q-A)'>NOA(Q-A)</option>";
                                                echo "<option value='NOA(NQ-A)'>NOA(NQ-A)</option>";
                                                echo "<option value='NOR(Q-NA)'>NOR(Q-NA)</option>";
                                                echo "<option value='NOR(NQ-NA)'>NOR(NQ-NA)</option>";
                                                echo "</select>";
                                                echo "</td>";


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
                                <div class="confirmation-overlay" id="confirmation-overlay">
                                    <div class="confirmation-box">
                                        <p id="confirmation-message"></p>
                                        <div class="confirmation-buttons">
                                            <button class="Yes" id="confirm-ok">OK</button>
                                            <button class="cancel" id="confirm-cancel">Cancel</button>
                                        </div>
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

                                    .confirmation-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        /* Styles for the confirmation dialog box */
        .confirmation-box {
            background: #fff;
            border-radius: 5px;
            padding: 20px;
            max-width: 400px;
            text-align: center;
            position: relative;
            margin: auto; /* Center horizontally */
            top: 50%; /* Center vertically */
            transform: translateY(-50%); /* Adjust for top positioning */
        }

        /* Styles for the confirmation buttons */
        .confirmation-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .confirmation-buttons button {
            padding: 10px;
            cursor: pointer;
        }

        .confirmation-buttons button.ok {
            background-color: #4CAF50;
            color: #fff;
        }

        .confirmation-buttons button.cancel {
            background-color: #f44336;
            color: #fff;
        }
                                </style>

                                <script>

                                </script>



                            </div>
                            <script>
                              function selectOption(selectedValue, id) {
            // Show the confirmation dialog
            showConfirmationDialog(selectedValue, id);
        }

        function showConfirmationDialog(selectedValue, id) {
            // Set the confirmation message with the selected value
            $('#confirmation-message').text("Are you sure you want to set the status of the student to '" + selectedValue + "'?");

            // Show the confirmation overlay
            $('#confirmation-overlay').show();

            // Set up event listeners for OK and Cancel buttons
            $('#confirm-ok').on('click', function () {
                // If the user clicks 'OK', proceed with the update
                updateStatus(id, selectedValue);

                // Hide the confirmation overlay
                $('#confirmation-overlay').hide();

                // Remove event listeners
                $('#confirm-ok').off('click');
                $('#confirm-cancel').off('click');
            });

            $('#confirm-cancel').on('click', function () {
                // If the user clicks 'Cancel', hide the confirmation overlay
                $('#confirmation-overlay').hide();

                // Remove event listeners
                $('#confirm-ok').off('click');
                $('#confirm-cancel').off('click');
            });
        }

                                function updateStatus(id, newStatus) {
                                    // Make an AJAX request to update the database
                                    $.ajax({
                                        type: 'POST',
                                        url: 'Personnel_updateResult.php', // Update the URL to your PHP file
                                        data: {
                                            id: id,
                                            newStatus: newStatus
                                        },
                                        success: function(response) {
                                            // Handle the response, for example, show a success message or update the UI
                                            console.log(response);

                                            // Display a toast message (you can customize this part)
                                            $('#toast-body').text('Status updated successfully');
                                            $('#toast').addClass('show');
                                            setTimeout(function() {
                                                $('#toast').removeClass('show');
                                            }, 3000);
                                        },
                                        error: function(error) {
                                            // Handle errors
                                            console.error(error);

                                            // Display a toast message for errors (you can customize this part)
                                            $('#toast-body').text('Failed to update status');
                                            $('#toast').addClass('show');
                                            setTimeout(function() {
                                                $('#toast').removeClass('show');
                                            }, 3000);
                                        }
                                    });
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
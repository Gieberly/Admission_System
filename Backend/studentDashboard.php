<?php

include("config.php");
include("studentcover.php");

// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Student') {
    header("Location: loginpage.php");
    exit();
}


// Fetch data from the database where Nature_of_Degree is 'Board' and Overall_Slots is not empty or zero
$sql = "SELECT * FROM programs WHERE Nature_of_Degree = 'Board' AND Overall_Slots IS NOT NULL AND Overall_Slots <> 0";
$result = $conn->query($sql);

// Fetch data from the database where Nature_of_Degree is 'Non-Board' and Overall_Slots is not empty or zero
$sqlNonBoard = "SELECT * FROM programs WHERE Nature_of_Degree = 'Non-Board' AND Overall_Slots IS NOT NULL AND Overall_Slots <> 0";
$resultNonBoard = $conn->query($sqlNonBoard);

// Combine the results
$combinedResults = array_merge($result->fetch_all(MYSQLI_ASSOC), $resultNonBoard->fetch_all(MYSQLI_ASSOC));
 
?>
<section id="content">
    <main>
        <!-- Dashboard -->
        <div id="dashboard-content">
            <div class="head-title">
                <div class="left">
                    <h1>Dashboards</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="studentDashboard.php">Home</a></li>
                    </ul>
                </div>
            </div>

            <div id="master-list">
                <div class="table-data">
                    <div class="order">
                        <div class="head">
                            <h3>List of Available Programs Offered</h3>
                            <div class="headfornaturetosort">
                            </div>
                        </div>
                        <div id="table-container">
                            <table id="searchableTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Programs</th>
                                        <th>Nature of Degree</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
if (!empty($combinedResults)) {
    $count = 1;
    foreach ($combinedResults as $row) {
        echo "<tr data-id='{$row['ProgramID']}' class='list-row'>";
        echo "<td>{$count}</td>";
        echo "<td class='editable' data-field='Description'>{$row['Description']}</td>";
        echo "<td class='editable' data-field='Nature_of_Degree'>{$row['Nature_of_Degree']}</td>";
        echo "<td><a href='studentforms.php?programID={$row['ProgramID']}&description={$row['Description']}&degree={$row['Nature_of_Degree']}' class='apply-button'>Apply</a></td>";
        echo "</tr>";
        $count++;
    }
} else {
    echo "<tr><td colspan='4'>No courses found</td></tr>";
}
?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>

<div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <strong class="mr-auto">Changes Saved Successfully!</strong>
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

    .apply-button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 15px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .apply-button:hover {
        background-color: #45a049;
    }
</style>
<script>
    // Add a JavaScript function to handle the Apply button click event
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.apply-button').forEach(function (button) {
            button.addEventListener('click', function () {
                var programId = this.getAttribute('data-program-id');
                // Redirect to studentform.php with the Program ID as a parameter
                window.location.href = 'studentforms.php?program_id=' + programId;
            });
        });
    });
</script>

<?php

include("config.php");
include("Student_Cover.php"); 

// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Student') {
    header("Location: loginpage.php");
    exit();
}

// Define search term
$search = isset($_GET['search']) ? $_GET['search'] : '';

// If a college is clicked, get the college ID
$selectedCollege = isset($_GET['college']) ? $_GET['college'] : '';

// Fetch data from the database where Overall_Slots is not empty or zero
$sql = "SELECT * FROM programs WHERE Number_of_Available_Slots IS NOT NULL AND Number_of_Available_Slots <> 0";

// If a college is selected, filter programs by the selected college
if (!empty($selectedCollege)) {
    $sql .= " AND College = '$selectedCollege'";
}

// If search term is provided, append search criteria
if (!empty($search)) {
    $sql .= " AND (College LIKE '%$search%' OR Courses LIKE '%$search%' OR Nature_of_Degree LIKE '%$search%')";
}

$result = $conn->query($sql);

// Fetch data from the database
$combinedResults = $result->fetch_all(MYSQLI_ASSOC);

// Track displayed colleges to avoid repetition
$displayedColleges = array();

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
                        <li><a class="active" href="Student_Dashboard.php">Home</a></li>
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
                                        <th>Program</th>
                                        <th>Nature of Degree</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if (!empty($combinedResults)) {
                                        $count = 1;
                                        foreach ($combinedResults as $row) {
                                            $college = $row['College'];
                                            // Check if the college has already been displayed
                                            if (!in_array($college, $displayedColleges)) {
                                                echo "<tr class='college-row'><td colspan='5'><strong>{$college}</strong></td></tr>";
                                                // Add the college to the displayed array
                                                $displayedColleges[] = $college;
                                            }
                                           
                                            
                                            echo "<tr data-id='{$row['ProgramID']}' class='list-row'>";
                                           
                                            echo "<td class='editable' data-field='Courses'>{$count}. &nbsp; {$row['Courses']}</td>";
                                            echo "<td class='editable' data-field='Nature_of_Degree'>{$row['Nature_of_Degree']}</td>";
                                            echo "<td><a href='Student_Forms.php?programID={$row['ProgramID']}&Courses={$row['Courses']}&degree={$row['Nature_of_Degree']}&college={$row['College']}' class='apply-button'>Apply</a></td>";
                                            echo "</tr>";
                                            $count++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No courses found</td></tr>";
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
        font-size: 1vw;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .apply-button:hover {
        background-color: #45a049;
    }
</style>
<script>


    document.addEventListener('DOMContentLoaded', function () {
// Add event listener to Apply buttons
document.querySelectorAll('.apply-button').forEach(function (button) {
    button.addEventListener('click', function () {
        var programId = this.getAttribute('data-id'); // Fix: Use 'data-id' instead of 'data-program-id'
        var college = this.getAttribute('data-college'); // Get the college attribute
        // Redirect to Student_Forms.php with the necessary parameters
        window.location.href = `Student_Forms.php?programID=${programId}&college=${college}`;
    });
});


    });
</script>

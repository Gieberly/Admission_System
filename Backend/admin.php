<?php
session_start();
include("config.php");

// Check if the user is an admin, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: loginpage.php");
    exit();
}

// Function to get all staff members
function getAllStaff() {
    global $conn;
    $query = "SELECT id, name, email, userType, status FROM users WHERE userType = 'staff'";
    $result = $conn->query($query);
    return $result;
}

// Function to update staff status
function updateStaffStatus($staffId, $newStatus) {
    global $conn;
    $query = "UPDATE users SET status = ? WHERE id = ? AND userType = 'staff'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $newStatus, $staffId);
    return $stmt->execute();
}

// Function to delete staff member
function deleteStaff($staffId) {
    global $conn;
    $query = "DELETE FROM users WHERE id = ? AND userType = 'staff'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $staffId);
    return $stmt->execute();
}

// Check if the form for updating status is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateStatus'])) {
    $staffId = $_POST['staffId'];
    $newStatus = $_POST['newStatus'];
    updateStaffStatus($staffId, $newStatus);
}

// Check if the form for deleting staff member is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteStaff'])) {
    $staffId = $_POST['staffId'];
    deleteStaff($staffId);
}



// Function to get all student form data
function getAllStudentFormData() {
    global $conn;
    $query = "SELECT id,applicant_number,degree_applied,nature_of_degree, applicant_name, email, math_grade, science_grade, english_grade, gwa_grade, rank FROM admission_data";
    $result = $conn->query($query);
    return $result;
}

// Display all student form data in the table
$studentFormData = getAllStudentFormData();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BSU OUR Admission Admin</title>
    <link rel="icon" href="assets/images/BSU Logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="assets\css\admin.css" />
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
</head>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a class="brand">
            <img class="bsulogo" src="assets/images/BSU Logo1.png" alt="BSU LOGO">
            <span class="text">Admin</span>
        </a>

        <ul class="side-menu top">
            <li class="active">
                <a href="#" id="dashboard-link">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>

            <li class="">
                <a href="#" id="master-list-link">
                    <i class='bx bxs-user-pin'></i>
                    <span class="text">Applicants</span>
                </a>
            </li>

            <li class="">
                <a href="#" id="student-result-link">
                    <i class='bx bxs-window-alt'></i>
                    <span class="text">Personnels</span>
                </a>
            </li>

           
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <a>Categories</a>
            <form id="search-form">
                <div class="form-input" style="display: none;">
                    <input type="text" id="searchInput" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <div id="clock">8:10:45</div>
           
            <a href="#" class="profile" id="profile-button">
                <img src="assets/images/human icon.png" alt="User Profile">
            </a>

        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->

        <main>
        <!--Dashboard-->
            <div id="dashboard-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Dashboard</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="staff.html">Home</a></li>
                        </ul>
                    </div>
                </div>

                <ul class="box-info">
                    <li id="available-box">
                        <i class='bx bx-clipboard'></i>
                        <span class="text">
                            <h3>1020</h3>
                            <p>Available Slots</p>
                        </span>
                    </li>

                    <li id="admission-box">
                        <i class='bx bxs-group'></i>
                        <span class="text">
                            <h3>2834</h3>
                            <p>Students For Admission</p>
                        </span>
                    </li>

                    <li id="admitted-box">
                        <i class='bx bx-user-check'></i>
                        <span class="text">
                            <h3>2543</h3>
                            <p>Admitted Students</p>
                        </span>
                    </li>

                    <li id="readmitted-box">
                        <i class='bx bxs-user-x'></i>
                        <span class="text">
                            <h3>1020</h3>
                            <p>Students For Readmission</p>
                        </span>
                    </li>
                </ul>

            </div>

            <!--Master List-->
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
                                <div class="dropdown-nature">
                                <h3>List of Students</h3>
                                
                            </div>
                            </div>
                            <div id="table-container">
                            <table>
                                <colgroup>
                                    <col style="width: 5%;">
                                    <col style="width: 10%;">
                                    <col style="width: 15%;">
                                    <col style="width: 10%;">
                                    <col style="width: 20%;">
                                    <col style="width: 8%;">
                                    <col style="width: 8%;">
                                    <col style="width: 8%;">
                                    <col style="width: 8%;">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Application No.</th>
                                        <th>Name</th>
                                        <th>Nature of Degree</th>
                                        <th>Program</th>
                                        
                                        <th>Email</th>
                                        <th>Math</th>
                                        <th>Science</th>
                                        <th>English</th>
                                        <th>GWA</th>
                                        <th>Rank</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
    // Counter for numbering the students
    $counter = 1;

    // Loop through the results and populate the table rows
    while ($row = $studentFormData->fetch_assoc()) {
    ?>
        <tr>
            <td><?php echo $counter++; ?></td>
            <td><?php echo $row['applicant_number']; ?></td>
            <td><?php echo $row['applicant_name']; ?></td>
            <td><?php echo $row['nature_of_degree']; ?></td>
            <td><?php echo $row['degree_applied']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['math_grade']; ?></td>
            <td><?php echo $row['science_grade']; ?></td>
            <td><?php echo $row['english_grade']; ?></td>
            <td><?php echo $row['gwa_grade']; ?></td>
            <td><?php echo $row['rank']; ?></td>
            <!-- Add more columns as needed -->
        </tr>
        <?php
    }
    ?>                      </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>

          <!-- Personnel List  -->
            <div id="student-result-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Personnels</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Personnels</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="staff.html">Home</a></li>
                        </ul>
                    </div>
                </div>

      <!-- Staff List Table -->
<div id="master-listpersonnel">
    <div class="table-data">
        <div class="order">
            <div class="head">
                <h3>List of Personnels</h3>
               
            </div>
            <div id="table-container">
                <table>
                    <colgroup>
                        <col style="width: 5%;">
                        <col style="width: 20%;">
                        <col style="width: 15%;">
                        <col style="width: 15%;">
                        <col style="width: 30%;">
                        <col style="width: 15%;">
                        <col style="width: 15%;">
                        
                      
                    </colgroup>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                           
                            <th>Status</th>
                            <th>Update Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody id="stafflist">
                    <?php
    // Counter for numbering the students
    $counter = 1;

        // Display all staff members in the table
        $staffMembers = getAllStaff();
        while ($row = $staffMembers->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $counter++; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
               
                <td><?php echo $row['status']; ?></td>
                <td>
                    <form method="post" action="">
                        <input type="hidden" name="staffId" value="<?php echo $row['id']; ?>">

                        <!-- Dropdown for updating status -->
                        <select name="newStatus">
                         
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>

                        <button type="submit" name="updateStatus">Update Status</button>
                    </form>
                </td>
                <td>
                    <!-- Form for deleting staff member -->
                    <form method="post" action="">
                        <input type="hidden" name="staffId" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="deleteStaff">Delete Staff</button>
                    </form>
                </td>
            </tr>
            <?php
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
        <!-- MAIN -->

    </section>

    <!-- Add the profile popup container here -->
    <div class="profile-popup" id="profile-popup">
        <!-- Popup content -->
        <div class="popup-content" id="profile-content">
            <div class="profile-header">
                <img src="assets/images/human icon.png" alt="User Profile Picture" class="profile-picture"
                    id="profile-picture">
                <p class="profile-name">John Doe</p>
            </div>

            <hr>
            <div class="profile-menu">
                <a href="#" id="settings" class="profile-item">  <i class='bx bx-sun'></i>Display</a>
         
       <div class="dropdown" id="settings-dropdown">
                    <a href="#">Dark Mode 
                        <input type="checkbox" id="switch-mode" hidden>
                        <label for="switch-mode" class="switch-mode"></label></a>

                

                </div>
<a href="#" id="settings" class="profile-item"><i class='bx bx-cog'></i> Settings</a>              
<a href="#" id="help" class="profile-item"><i class='bx bx-question-mark'></i> Help and Support</a>

<div class="dropdown" id="help-dropdown">
    <!-- Content for Help and Support dropdown -->
    <!-- Trigger for the FAQ pop-up -->
    <a href="faq_page.html" onclick="openPopup('faq-popup')">FAQ (Frequently Asked Questions)</a>
    
    <!-- Trigger for the Contact Us pop-up -->
    <a href="#" onclick="openPopup('contact-popup')">Contact Us</a>
    
    <!-- Trigger for the Report a Problem pop-up -->
    <!-- <a href="#" onclick="openPopup('report-popup')">Report a Problem</a>-->
</div>

<a href="#" id="logout" class="profile-item" onclick="confirmLogout()"><i class='bx bx-log-out'></i> Logout</a>
    <script>
        //log out prompt
        function confirmLogout() {
        // Display a confirmation dialog
        var confirmLogout = confirm("Are you sure you want to log out?");

        // If the user clicks "OK," redirect to logout.php
        if (confirmLogout) {
            window.location.href = "../backend/logout.php";
        } else {
            alert("Logout canceled");
        }
    }
    </script>            
        </div>
    </div>
</div>

    <!-- CONTENT -->
    <script src="assets\js\admin.js"></script>
</body>

</html>

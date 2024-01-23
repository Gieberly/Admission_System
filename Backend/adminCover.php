<?php

include("config.php");

// Check if the user is an admin, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: loginpage.php");
    exit();
}

// Fetch staff information from the database based on user ID
$userID = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, email, userType, status FROM users WHERE id = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($name, $email, $userType, $status);
$stmt->fetch();
$stmt->close();

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
    $query = "SELECT id,applicant_number,degree_applied,nature_of_degree, applicant_name, email, math_grade, science_grade, english_grade, gwa_grade FROM admission_data";
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
            <li class="">
                <a href="adminDashboard.php" id="dashboard-link">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>

            <li class="">
                <a href="Courses.php" id="courses-link">
                <i class='bx bxs-graduation'></i>
                    <span class="text">Courses</span>
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
           
            <?php
// Check if the current page is Courses.php
$current_page = basename($_SERVER['PHP_SELF']);
if ($current_page === 'Courses.php') {
?>
    <form action="Courses.php" method="GET">
        <div class="form-input">
            <input type="search" name="search" placeholder="Search...">
            <button type="submit" class="search-btn"><i id="searchIcon" class="bx bx-search" onclick="changeIcon()"></i></button>
        </div>
    </form>
<?php
}
?>
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
                <p class="profile-name"><?php echo $name; ?></p>
            </div>

            <hr>
            <div class="profile-menu">
                <a href="#" id="settings" class="profile-item">  <i class='bx bx-sun'></i>Display</a>
         
       <div class="dropdown" id="settings-dropdown">
                    <a href="#">Dark Mode 
                        <input type="checkbox" id="switch-mode" hidden>
                        <label for="switch-mode" class="switch-mode"></label></a>

                

                </div>
<a href="EditInfo.php" id="settings" class="profile-item"><i class='bx bx-cog'></i> Settings</a>              
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

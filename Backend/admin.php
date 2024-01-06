<?php
session_start();
include("config.php");

// Check if the user is an admin, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: loginpage.php");
    exit();
}

// Fetch staff information from the database based on user ID
$userID = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT lname, email, userType,password FROM users WHERE id = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($lname, $email, $userType, $status);
$stmt->fetch();
$stmt->close();

//Function to get all staff members
function getAllStaff() {
    global $conn;
    $query = "SELECT id, lname, email, status FROM users WHERE userType = 'staff'";
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
    $query = "SELECT id,app_number,course,
    fname, lname, email FROM applicant";
    $result = $conn->query($query);
    return $result;
}

// Display all student form data in the table
 $studentFormData = getAllStudentFormData();
?>

<?php include 'header.php'?>

<body>
<?php include 'sidebar-admin.php'?>
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
                            <li><a class="active" href="#top">Home</a></li>
                        </ul>
                    </div>
                </div>

                <ul class="box-info">
                    <li id="available-box">
                        <i class='bx bx-clipboard'></i>
                        <span class="text">
                            <h3><?php $veri_app_query ="SELECT * FROM courses";
                        $veri_app_query_run = mysqli_query($conn, $veri_app_query);
                        if($app_total = mysqli_num_rows($veri_app_query_run)){

                            echo '<h3>'.$app_total.'</h3>';
                        }else{
                            echo '<h3>0</h3>';
                        }
                         ?></h3>
                            <p>Available Slots</p>
                        </span>
                    </li>

                    <li id="admission-box">
                        <i class='bx bxs-group'></i>
                        <span class="text">
                            <h3><?php $veri_app_query ="SELECT * FROM applicant";
                        $veri_app_query_run = mysqli_query($conn, $veri_app_query);
                        if($app_total = mysqli_num_rows($veri_app_query_run)){

                            echo '<h3>'.$app_total.'</h3>';
                        }else{
                            echo '<h3>0</h3>';
                        }
                         ?></h3>
                            <p>Students For Admission</p>
                        </span>
                    </li>

                    <li id="admitted-box">
                        <i class='bx bx-user-check'></i>
                        <span class="text">
                            <h3><?php $veri_app_query ="SELECT * FROM application WHERE result ='NOA'";
                        $veri_app_query_run = mysqli_query($conn, $veri_app_query);
                        if($app_total = mysqli_num_rows($veri_app_query_run)){

                            echo '<h3>'.$app_total.'</h3>';
                        }else{
                            echo '<h3>0</h3>';
                        }
                         ?></h3>
                            <p>Admitted Students</p>
                        </span>
                    </li>

                    <li id="readmitted-box">
                        <i class='bx bxs-user-x'></i>
                        <span class="text">
                            <h3><?php $veri_app_query ="SELECT * FROM application WHERE result ='NOR'";
                        $veri_app_query_run = mysqli_query($conn, $veri_app_query);
                        if($app_total = mysqli_num_rows($veri_app_query_run)){

                            echo '<h3>'.$app_total.'</h3>';
                        }else{
                            echo '<h3> No result</h3>';
                        }
                         ?></h3>
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
                            <li><a class="active" href="#top">Home</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Import & Export link -->
                <div class="col-md-12 head">
                    <div class="float-right">
                        <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Import</a>
                        <a href="exportData.php" class="btn btn-primary"><i class="exp"></i> Export</a>
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
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Course</th>
                                        <th>Email</th>
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
            <td><?php echo $row['app_number']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['course']; ?></td>
            <td><?php echo $row['email']; ?></td>
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
                            <th> First Name</th>
                            <th>Email</th>
                           
                            <th>Last log</th>
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
               
                <td><?php echo $row['last_log']; ?></td>
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
<?php include 'footer.php'?>


<?php
include("config.php");

session_start();

// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Staff') {
    header("Location: loginpage.php");
    exit();
}

$userID = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name,last_name, email, userType, status FROM users WHERE id = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($name, $last_name, $email, $userType, $status);
$stmt->fetch();
$stmt->close();

function getCourses($conn)
{
    $stmt = $conn->prepare("SELECT ProgramID, Courses, Description, Nature_of_Degree FROM programs ORDER BY Nature_of_Degree, Courses");
    $stmt->execute();
    $result = $stmt->get_result();
    $courses = [];

    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }

    $stmt->close();
    return $courses;
}


?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BSU OUR Admission Unit Personnel</title>
    <link rel="icon" href="assets/images/BSU Logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css//personnel.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a class="brand">
            <img class="bsulogo" src="assets/images/BSU Logo1.png" alt="BSU LOGO">
            <span class="text">Personnel</span>
        </a>

        <ul class="side-menu top">
            <li class="">
                <a href="Personnel_dashboard.php" id="dashboard-link">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
       
            <li class="">
                <a href="Personnel_Verification.php" id="master-list-link">
                <i class='bx bx-list-check'></i>
                    <span class="text">Verification</span>
                </a>
            </li>
            <li >
                <a href="Personnel_Applicants.php">
                <i class='bx bxs-user-detail' ></i>
                    <span class="text">Applicants</span>
                  
                </a>

            </li>
          
            <li class="">
                <a href="masterlist.php" id="master-list-link">
                    <i class='bx bxs-user-pin'></i>
                    <span class="text">Master List</span>
                </a>
            </li>

            <li class="">
                <a href="studentresult.php" id="student-result-link">
                    <i class='bx bxs-window-alt'></i>
                    <span class="text">Forms</span>
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
            // Check if the current page is masterlist.php
            $current_page = basename($_SERVER['PHP_SELF']);
            if ($current_page === 'Personnel_Verification.php') {
            ?>
                <form action="Personnel_Verification.php" method="GET">
                    <div class="form-input">
                        <input type="search" name="search" placeholder="Search...">
                        <button type="submit" class="search-btn"><i id="searchIcon" class="bx bx-search" onclick="changeIcon()"></i></button>
                    </div>
                </form>
            <?php
            }
            ?>
            <?php
            // Check if the current page is masterlist.php
            $current_page = basename($_SERVER['PHP_SELF']);
            if ($current_page === 'masterlist.php') {
            ?>
                <form action="masterlist.php" method="GET">
                    <div class="form-input">
                        <input type="search" name="search" placeholder="Search...">
                        <button type="submit" class="search-btn"><i id="searchIcon" class="bx bx-search" onclick="changeIcon()"></i></button>
                    </div>
                </form>
            <?php
            }
            ?>

<?php
            // Check if the current page is masterlist.php
            $current_page = basename($_SERVER['PHP_SELF']);
            if ($current_page === 'PersonnelsReceiving.php') {
            ?>
                <form action="PersonnelsReceiving.php" method="GET">
                    <div class="form-input">
                        <input type="search" name="search" placeholder="Search...">
                        <button type="submit" class="search-btn"><i id="searchIcon" class="bx bx-search" onclick="changeIcon()"></i></button>
                    </div>
                </form>
            <?php
            }
            ?>
            <?php
            // Check if the current page is masterlist.php
            $current_page = basename($_SERVER['PHP_SELF']);
            if ($current_page === 'Personnel_Applicants.php') {
            ?>
                <form action="Personnel_Applicants.php" method="GET">
                    <div class="form-input">
                        <input type="search" name="search" placeholder="Search...">
                        <button type="submit" class="search-btn"><i id="searchIcon" class="fas fa-search" onclick="changeIcon()"></i></button>
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



    </section>

    <!-- Add the profile popup container here -->
    <div class="profile-popup" id="profile-popup">
        <!-- Popup content -->
        <div class="popup-content" id="profile-content">
            <div class="profile-header">
                <img src="assets/images/human icon.png" alt="User Profile Picture" class="profile-picture" id="profile-picture">
                <p class="profile-name" id="applicant-name"><?php echo $name. ' ' . $last_name; ?>
</p>
            </div>


            <hr>
            <div class="profile-menu">
                <a href="#" id="settings" class="profile-item"> <i class='bx bx-sun'></i>Display</a>

                <div class="dropdown" id="settings-dropdown" style="display: none;">
                    <a href="#"> &nbsp; Dark Mode
                     &nbsp;  &nbsp; <input type="checkbox" id="switch-mode" hidden>
                    &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <label for="switch-mode" class="switch-mode"></label></a>

                </div>
          
                <a href="#" id="setting" class="profile-item" > <i class='bx bx-cog'></i> Settings</a>
          
                <div class="dropdown" id="setting-content" style="display: none;">
                <a href="EditInfo.php">&nbsp; &nbsp; Change Password</a>
              
            </div>

                <a href="#" id="help" class="profile-item"><i class='bx bx-question-mark'></i> Help and Support</a>
                <div class="dropdown" id="help-dropdown" style="display: none;">
                    <!-- Content for Help and Support dropdown -->
                    <!-- Trigger for the FAQ pop-up -->
                    <a href="" onclick="openPopup('faq-popup')">&nbsp;&nbsp;&nbsp;Manual </a>
                
                </div>
                <a href="#" id="logout" class="profile-item" onclick="return confirmLogout();"><i class='bx bx-log-out'></i> Logout</a>
                <div class="overlay" id="confirmationOverlayLogout" style="display: none;">
                    <div class="confirmation-modal">
                        <p>Are you sure you want to log out?</p>
                        <button id="confirmYesLogout">Confirm</button>
                        <button id="confirmNoLogout">Cancel</button>
                    </div>
                </div>
            </div>
            <div class="logout-confirmation-message" id="logoutConfirmationMessage">
    Account logging out...
</div>
        </div>
    </div>
    
<script>
  function confirmLogout() {
    // Show the overlay with the confirmation dialog
    $("#confirmationOverlayLogout").fadeIn();

    // Handle 'Yes' button click
    $("#confirmYesLogout").click(function () {
        // Close the overlay
        $("#confirmationOverlayLogout").fadeOut();

        // Display the logout confirmation message
        $("#logoutConfirmationMessage").fadeIn();

        // Hide the message after 2 seconds
        setTimeout(function () {
            $("#logoutConfirmationMessage").fadeOut();
            // Redirect to the logout page after hiding the message
            window.location.href = "../Backend/logout.php";
        }, 2000);

        // Prevent further clicks on 'Yes' button
        $(this).prop('disabled', true);
    });

    // Handle 'No' button click
    $("#confirmNoLogout").click(function () {
        // Close the overlay without logging out
        $("#confirmationOverlayLogout").fadeOut();
        return false; // Cancel link click
    });

    // Prevent the default link click
    return false;
}


</script>
   
<style>
  /* Styles for the logout confirmation message */
.logout-confirmation-message {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: green;
    color: white;
    padding: 15px 20px;
    border-radius: 5px;
    z-index: 1000;
}

#confirmationOverlayLogout {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Add styles for the confirmation dialog modal */
.confirmation-modal {
    background-color: white;
    color: black;
    padding: 20px;
    border-radius: 5px;
    text-align: center;
    max-width: 400px; /* Adjust the maximum width as needed */
}

.confirmation-modal p {
    margin-bottom: 15px;
}

.confirmation-modal button {
    padding: 10px 15px;
    margin: 0 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

/* Style the 'Yes' button in green */
#confirmYesLogout {
    background-color: #28a745; /* Green color */
    color: white;
}

/* Style the 'No' button in red */
#confirmNoLogout {
    background-color: #dc3545; /* Red color */
    color: white;
}

</style>
    <script src="assets/js/personnels.js"></script>
    
</body>
<!-- #region -->

</html>
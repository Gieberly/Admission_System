<?php
include("config.php");

session_start();

// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Student') {
    header("Location: loginpage.php");
    exit();
}

// Retrieve the student's information from the users table
$studentId = $_SESSION['user_id'];
$stmtUser = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmtUser->bind_param("i", $studentId);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$studentData = $resultUser->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/BSU Logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/student.css" />
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="assets\js\jspdf.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a class="brand">
            <img class="bsulogo" src="assets/images/BSU Logo1.png" alt="BSU LOGO">
            <span class="text">Student</span>
        </a>

        <ul class="side-menu top">
            <li class="">
                <a href="studentDashboard.php" id="profile-link">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="">
                <a href="studentcontent_sidebar.php" id="profile-link">
                    <i class='bx bxs-group'></i>
                    <span class="text">Profile</span>
                </a>
            </li>
            <li class="">
                <a href="Student_Transaction_page.php" id="transaction-link">
                    <i class='bx bx-transfer'></i>
                    <span class="text">Transaction</span>
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

            <form id="search-form">
                <div class="form-input" style="display: none;">
                    <input type="text" id="searchInput" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <div id="clock">8:10:45</div>


            <a href="#" class="profile" id="profile-button">
                <img src="assets/images/human icon.png" alt="User Profile" id="profile-image">
            </a>


        </nav>


    </section>





    <!-- Add the profile popup container here -->
    <div class="profile-popup" id="profile-popup">
        <!-- Popup content -->
        <div class="popup-content" id="profile-content">
            <div class="profile-header">
                <img src="assets/images/human icon.png" alt="User Profile Picture" class="profile-picture" id="profile-picture">
                <p class="profile-name" id="applicant-name"><?php echo $studentData['name'] . ' ' . $studentData['last_name']; ?></p>
            </div>


            <hr>
            <div class="profile-menu">
                <a href="#" id="settings" class="profile-item"> <i class='bx bx-sun'></i>Display</a>

                <div class="dropdown" id="settings-dropdown" style="display: none;">
                    <a href="#">Dark Mode
                        <input type="checkbox" id="switch-mode" hidden>
                        <label for="switch-mode" class="switch-mode"></label></a>

                </div>

                <a href="#" id="setting" class="profile-item"> <i class='bx bx-cog'></i> Settings</a>

                <div class="dropdown" id="setting-content" style="display: none;">
                    <a href="Student_ChangePass.php">Change Password</a>
                    <a href="Student_EditProfile.php">Edit Profile</a>

                </div>
                <!-- Add the overlay and modal for the confirmation dialog -->
               

                <a href="#" id="help" class="profile-item"><i class='bx bx-question-mark'></i> Help and Support</a>
                <div class="dropdown" id="help-dropdown" style="display: none;">
                    <!-- Content for Help and Support dropdown -->
                    <!-- Trigger for the FAQ pop-up -->
                    <a href="Student_faqs.php" onclick="openPopup('faq-popup')">FAQ </a>
                    <a href="#" onclick="toggleDevonContent()">Connect With us</a>
                    <div id="devon-content" class style="display: none;">
                        <div class="social-icons-container">
                            <!-- Facebook -->
                            <a href="https://www.facebook.com/BenguetStateUniversity/" target="_blank" title="Facebook"><i class='bx bxl-facebook'></i></a>

                            <!-- Email -->
                            <a href="mailto:web.admin@bsu.edu.ph?subject=General%20Inquiry" target="_blank" title="Email"><i class='bx bx-envelope'></i></a>

                            <!-- Twitter -->
                            <a href="https://twitter.com/benguetstateu" target="_blank" title="Twitter"><i class='bx bxl-twitter'></i></a>

                            <!-- Instagram -->
                            <a href="https://www.instagram.com/benguetstateuniversityofficial/" target="_blank" title="Instagram"><i class='bx bxl-instagram'></i></a>

                            <!-- BSU website -->
                            <a href="http://www.bsu.edu.ph/" target="_blank" title="BSU_website"><i class='bx bx-world'></i></a>
                        </div>

                    </div>
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
        </div>
    </div>

    <script src="assets/js/student.js"></script>
</body>

</html>
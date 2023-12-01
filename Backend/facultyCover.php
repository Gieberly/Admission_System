<?php
include("config.php");

session_start();

// Check if the user is logged in as a Faculty
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Faculty') {
    header("Location: loginpage.php");  // Redirect to login page if not logged in as Faculty
    exit();
}
$userID = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, email, userType, status FROM users WHERE id = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($name, $email, $userType, $status);
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

    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a class="brand">
            <img class="bsulogo" src="assets/images/BSU Logo1.png" alt="BSU LOGO">
            <span class="text">Faculty</span>
        </a>


        <ul class="side-menu top">
            <li class="">
                <a href="facultydashboard.php" id="dashboard-link">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li >
                <a href="facultyApplicants.php" >
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
                <a href="faq.php" id="announcements-link">
                    <i class='bx bxs-book-content'></i>
                    <span class="text">Announcements</span>
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
            if ($current_page === 'facultyApplicants.php') {
            ?>
                <form action="facultyApplicants.php" method="GET">
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



    </section>


    <!-- Add the profile popup container here -->
    <div class="profile-popup" id="profile-popup">
        <!-- Popup content -->
        <div class="popup-content" id="profile-content">
            <div class="profile-header">
                <img src="assets/images/human icon.png" alt="User Profile Picture" class="profile-picture" id="profile-picture">
                <p class="profile-name" id="applicant-name"><?php echo $name; ?></p>
            </div>


            <hr>
            <div class="profile-menu">
                <a href="#" id="settings" class="profile-item"> <i class='bx bx-sun'></i>Display</a>

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
                    <a href="faq_page.html" onclick="openPopup('faq-popup')">FAQ</a>
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

                            <!-- YouTube -->
                            <a href="https://www.youtube.com/channel/UCGPVCY6CmxRi68_3SE6MzCg" target="_blank" title="YouTube"><i class='bx bxl-youtube'></i></a>
                        </div>

                    </div>
                </div>
                <a href="#" id="logout" class="profile-item" onclick="confirmLogout()"><i class='bx bx-log-out'></i> Logout</a>

            </div>

        </div>
    </div>
    <!-- CONTENT -->
    <script src="assets/js/personnels.js"></script>
</body>
<!-- #region -->

</html>
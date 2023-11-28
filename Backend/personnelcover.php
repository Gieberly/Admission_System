<?php
include("config.php");

session_start();

// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Staff') {
    header("Location: loginpage.php");
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
            <span class="text">Personnel</span>
        </a>

        <ul class="side-menu top">
            <li class="">
                <a href="personnel.php" id="dashboard-link">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
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

            <li class="">
                <a href="faq.php" id="announcements-link">
                    <i class='bx bxs-book-content'></i>
                    <span class="text">Announcements</span>
                </a>
            </li>


            <li class="dropdown" id="courses-dropdown">
    <a href="#" class="dropdown-toggle" id="course-link">
        <i class='bx bxs-graduation'></i>
        <span class="text">Colleges</span>
        <i class="bx bx-chevron-down" id="chevron-icon"></i>
    </a>
    <ul class="dropdown-content">
        <?php
        $courses = getCourses($conn);

        foreach ($courses as $course) {
            echo '<li>';
            echo '<a href="Colleges.php?degree_applied=' . $course['ProgramID'] . '" class="course-item" data-description="' . $course['Description'] . '">';
            echo '<i class="bx bx-hive"></i>';
            echo '<span class="text">' . $course['Courses'] . '</span>';
            echo '</a>';
            echo '</li>';
        }
        
        
        ?>
    </ul>
</li>

<!-- ... (your existing code) ... -->
<style>
    .course-item .text {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      
    }

    .course-item:hover .text {
        font-size: 10px; /* Adjust the font size as needed */
        max-height: 3em; /* Adjust the number of lines you want to display */
        white-space: normal;
    }
</style>

<!-- ... (your existing code) ... -->

<script>
    $(document).ready(function () {
        // Handle hover on course item
        $('.course-item').hover(function () {
            // Store the original course name
            var originalName = $(this).find('.text').text();
            $(this).data('original-name', originalName);

            // Display the Description content when hovering
            var description = $(this).data('description');
            $(this).find('.text').text(description);
        }, function () {
            // Restore the original course name when not hovering
            var originalName = $(this).data('original-name');
            $(this).find('.text').text(originalName);
        });
    });
</script>


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
            if ($current_page === 'Applicants.php') {
            ?>
                <form action="Applicants.php" method="GET">
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
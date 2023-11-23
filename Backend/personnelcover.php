<?php
include("config.php");

session_start();

// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'staff') {
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
                    <span class="text">Student Result</span>
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
					<i class="bx bx-chevron-down" id="chevron-icon"></i> <!-- Dropdown indicator -->
                 
                </a>
                <ul class="dropdown-content">
                <li>
                        <a id="course-bsa" href="BSA.php" data-fulltext="Bachelor of Science in Agriculture">
                            <i class='bx bx-hive'></i>
                            <span class="text">BSA</span>
                        </a>
                </li>
                    <li>
                        <a id="course-cah" href="BSAB.php" data-fulltext="Bachelor of Science in Agribusiness major in Enterprise Management">
                            <i class='bx bx-hive'></i>
                            <span class="text">BSAB</span>
                        </a>
                    </li>
                    <li>
                        <a id="course-cah" href="#" data-fulltext="College of Arts and Humanities">
                            <i class='bx bx-hive'></i>
                            <span class="text">CAH</span>
                        </a>
                    </li>
                    <li>
                        <a id="course-ceat" href="#" data-fulltext="College of Engineering and Applied Technology">
                            <i class='bx bx-hive'></i>
                            <span class="text">CEAT</span>
                        </a>
                    </li>
                    <li>
                        <a id="course-cf" href="#" data-fulltext="College of Forestry">
                            <i class='bx bx-hive'></i>
                            <span class="text">CF</span>
                        </a>
                    </li>
                    <li>
                        <a id="course-ca" href="#" data-fulltext="College of Agriculture">
                            <i class='bx bx-hive'></i>
                            <span class="text">CA</span>
                        </a>
                    </li>
                    <li>
                        <a id="course-chet" href="#" data-fulltext="College of Home Economics and Technology">
                            <i class='bx bx-hive'></i>
                            <span class="text">CHET</span>
                        </a>
                    </li>
                    <li>
                        <a id="course-cis" href="#" data-fulltext="College of Information Sciences">
                            <i class='bx bx-hive'></i>
                            <span class="text">CIS</span>
                        </a>
                    </li>
                    <li>
                        <a id="course-cns" href="#" data-fulltext="College of Natural Sciences">
                            <i class='bx bx-hive'></i>
                            <span class="text">CNS</span>
                        </a>
                    </li>
                    <li>
                        <a id="course-cnas" href="#" data-fulltext="College of Numeracy and Applied Sciences">
                            <i class='bx bx-hive'></i>
                            <span class="text">CNAS</span>
                        </a>
                    </li>
                    <li>
                        <a id="course-cn" href="#" data-fulltext="CCollege of Nursing">
                            <i class='bx bx-hive'></i>
                            <span class="text">CN</span>
                        </a>
                    </li>
                    <li>
                        <a id="course-cpag" href="#" data-fulltext="College of Public Administration and Governance">
                            <i class='bx bx-hive'></i>
                            <span class="text">CPAG</span>
                        </a>
                    </li>
                    <li>
                        <a id="course-css" href="#" data-fulltext="COLLEGE OF SOCIAL SCIENCES">
                            <i class='bx bx-hive'></i>
                            <span class="text">CSS</span>
                        </a>
                    </li>
                    <li>
                        <a id="course-cvm" href="#" data-fulltext="College of Veterinary Medicine">
                            <i class='bx bx-hive'></i>
                            <span class="text">CVM</span>
                        </a>
                    </li>


    <!-- Add more course items here -->



                </ul>
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
                <a href="EditInfo.php" id="settings" class="profile-item" ><i class='bx bx-cog'></i> Settings</a>              
    
                <a href="#" id="help" class="profile-item"><i class='bx bx-question-mark'></i> Help and Support</a>
     <div class="dropdown" id="help-dropdown">
                   <!-- Content for Help and Support dropdown -->
                  <!-- Trigger for the FAQ pop-up -->
      <a href="faq_page.html" onclick="openPopup('faq-popup')">FAQ</a>
        <a href="#" onclick="toggleDevonContent()">Connect With us</a>
        <div id="devon-content"class style="display: none;">
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


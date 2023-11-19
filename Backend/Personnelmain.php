<?php
session_start();
include("config.php");

// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'staff') {
    header("Location: loginpage.php");
    exit();
}


// Retrieve student data from the database
$query = "SELECT id, applicant_name,applicant_number, email, math_grade, science_grade, english_grade, gwa_grade, rank, result, nature_of_degree, degree_applied FROM admission_data";
$result = $conn->query($query);
// Fetch user information from the database based on user ID
$userID = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, email, userType, status FROM users WHERE id = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($name, $email, $userType, $status);
$stmt->fetch();

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
            <li class="active">
                <a href="#" id="dashboard-link">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>

            <li class="">
                <a href="#" id="master-list-link">
                    <i class='bx bxs-user-pin'></i>
                    <span class="text">Master List</span>
                </a>
            </li>

            <li class="">
                <a href="#" id="student-result-link">
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
          
            <!-- Student Result -->
            <div id="student-result-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Student Result</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Student Result</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="staff.html">Home</a></li>
                        </ul>
                    </div>
                </div>

                <div class="tabs">
                    <button class="tab-button active" data-tab="tab1">Notice of Admission</button>
                    <button class="tab-button" data-tab="tab2">Notice of Result</button>
                    <button class="button send" type="submit">Send</button> <button class="button save"
                        type="submit">Save</button>
                </div>
  
                <div class="tab-content" id="tab1">
                    <!--result(NOA)-->
                    <div id="student-result-noa">
                        <div class="table-data">
                            <div class="order">
                                <div class="head">
                                    <h3>Student Master List (NOA)</h3>
                                    <i class='bx bx-search' id="searchIcon"></i>
                                    <div class="search-box" id="searchBox-noa">
                                        <input type="text" id="noa-searchBox" placeholder="Search...">
                                    </div>
                                </div>
                                <table>
                                    <colgroup>
                                        <col style="width: 8%;">
                                        <col style="width: 10%;">
                                        <col style="width: 10%;">
                                        <col style="width: 10%;">
                                        <col style="width: 7%;">
                                        <col style="width: 4%;">
                                        <col style="width: 9%;">
                                        <col style="width: 8%;">
                                        <col style="width: 8%;">
                                        <col style="width: 4%;">
                                        <col style="width: 4%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 4%;">
                                        <col style="width: 4%;">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th>Application No.</th>
                                            <th>College<br>
                                                <select class="custom-dropdown">
                                                    <option value="none">College</option>
                                                    <option value="CIS">College of Information Sciences</option>
                                                    <option value="CHET">College of Home Economics and Technology
                                                    </option>
                                                    <option value="CA">College of Agriculture</option>
                                                    <option value="CHK">College of Human Kinetics</option>
                                                    <option value="CAS">College of Ars and Sciences</option>
                                                </select>
                                            </th>
                                            <th>Program<br>
                                                <select class="custom-dropdown">
                                                    <option value="none">Program</option>
                                                    <option value="CIS">Bachelor of Library and Information Science
                                                    </option>
                                                    <option value="CIS">Bachelor of Science in Development Communication
                                                    </option>
                                                    <option value="CIS">Bachelor of Science in Information Technology
                                                    </option>
                                                </select>
                                            </th>
                                            <th>Name</th>
                                            <th>Birth Date</th>
                                            <th>Sex</th>
                                            <th>Email</th>
                                            <th>Municipality</th>
                                            <th>Province</th>
                                            <th>GWA</th>
                                            <th>Math</th>
                                            <th>Science</th>
                                            <th>English</th>
                                            <th>Rank</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>00056</td>
                                            <td>CIS</td>
                                            <td>BSIT</td>
                                            <td>Toge Jugon Inumaki</td>
                                            <td>10-03-2003</td>
                                            <td>Male</td>
                                            <td>inumakitoge@gmail.com</td>
                                            <td>Hino-shi</td>
                                            <td>Tokyo</td>
                                            <td>90%</td>
                                            <td>90%</td>
                                            <td>87%</td>
                                            <td>92%</td>
                                            <td>56</td>
                                            <td>NOA</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="tab-content" id="tab2">
                    <!--result (NOR)-->
                    <div id="student-result-nor">
                        <div class="table-data">
                            <div class="order">
                                <div class="head">
                                    <h3>Student Master List (NOR)</h3>
                                    <i class='bx bx-search' id="searchIcon"></i>
                                    <div class="search-box" id="searchBox-nor">
                                        <input type="text" id="nor-searchBox" placeholder="Search...">
                                    </div>
                                </div>
                                <table>
                                    <colgroup>
                                        <col style="width: 8%;">
                                        <col style="width: 10%;">
                                        <col style="width: 10%;">
                                        <col style="width: 10%;">
                                        <col style="width: 7%;">
                                        <col style="width: 4%;">
                                        <col style="width: 9%;">
                                        <col style="width: 8%;">
                                        <col style="width: 8%;">
                                        <col style="width: 4%;">
                                        <col style="width: 4%;">
                                        <col style="width: 5%;">
                                        <col style="width: 5%;">
                                        <col style="width: 4%;">
                                        <col style="width: 4%;">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th>Application No.</th>
                                            <th>College<br>
                                                <select class="custom-dropdown">
                                                    <option value="none">College</option>
                                                    <option value="CIS">College of Information Sciences</option>
                                                    <option value="CHET">College of Home Economics and Technology
                                                    </option>
                                                    <option value="CA">College of Agriculture</option>
                                                    <option value="CHK">College of Human Kinetics</option>
                                                    <option value="CAS">College of Ars and Sciences</option>
                                                </select>
                                            </th>
                                            <th>Program<br>
                                                <select class="custom-dropdown">
                                                    <option value="none">Program</option>
                                                    <option value="CIS">Bachelor of Library and Information Science
                                                    </option>
                                                    <option value="CIS">Bachelor of Science in Development Communication
                                                    </option>
                                                    <option value="CIS">Bachelor of Science in Information Technology
                                                    </option>
                                                </select>
                                            </th>
                                            <th>Name</th>
                                            <th>Birth Date</th>
                                            <th>Sex</th>
                                            <th>Email</th>
                                            <th>Municipality</th>
                                            <th>Province</th>
                                            <th>GWA</th>
                                            <th>Math</th>
                                            <th>Science</th>
                                            <th>English</th>
                                            <th>Rank</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>000220</td>
                                            <td>CIS</td>
                                            <td>BSIT</td>
                                            <td>Nobara Kugisaki</td>
                                            <td>08-07-2004</td>
                                            <td>Female</td>
                                            <td>kugisakinobara@gmail.com</td>
                                            <td>Hino-shi</td>
                                            <td>Tokyo</td>
                                            <td>83%</td>
                                            <td>84%</td>
                                            <td>80%</td>
                                            <td>81%</td>
                                            <td>220</td>
                                            <td>NOR</td>
                                        </tr>
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
                <a href="StudentProfileEdit.php" id="settings" class="profile-item" ><i class='bx bx-cog'></i> Settings</a>              
    
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
    <script src="assets/js/personnel.js"></script>
</body>
 <!-- #region -->
</html>


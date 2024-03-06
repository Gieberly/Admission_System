<?php
include("..\config.php");
?>
<!-- Add the profile popup container here -->
<div class="profile-popup" id="profile-popup">
        <!-- Popup content -->
        <div class="popup-content" id="profile-content">
            <div class="profile-header">
                <img src="..\assets\images\human icon.png" alt="User Profile Picture" class="profile-picture"
                    id="profile-picture">
                <p class="profile-name"><?php echo $last_name; ?></p>
            </div>

            <hr>
            <div class="profile-menu">
                <a href="#" id="settings" class="profile-item">  <i class='bx bx-sun'></i>Display</a>
         
                <div class="dropdown" id="settings-dropdown">
                    <a href="#">Dark Mode 
                        <input type="checkbox" id="switch-mode" hidden>
                        <label for="switch-mode" class="switch-mode"></label></a>
                </div>
                    <a href="..\backend\EditInfo.php" id="settings" class="profile-item"><i class='bx bx-cog'></i> Settings</a>              
                    <a href="#" id="help" class="profile-item"><i class='bx bx-question-mark'></i> Help and Support</a>

                <div class="dropdown" id="help-dropdown">
                    <!-- Content for Help and Support dropdown -->
                    <!-- Trigger for the FAQ pop-up -->
                    <a href="..\Backend\faq.php" onclick="openPopup('faq-popup')">FAQ (Frequently Asked Questions)</a>
                    
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
                        window.location.href = "../logout.php";
                    } else {
                        alert("Logout canceled");
                    }
                }
                </script>            
            </div>
        </div>
    </div>

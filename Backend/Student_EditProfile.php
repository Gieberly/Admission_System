<?php
include("studentcover.php");

// Retrieve the admission data based on the user's email
$email = $studentData['email'];
$stmtAdmission = $conn->prepare("SELECT * FROM admission_data WHERE email = ?");
$stmtAdmission->bind_param("s", $email);
$stmtAdmission->execute();
$resultAdmission = $stmtAdmission->get_result();
$admissionData = $resultAdmission->fetch_assoc();

if (isset($_SESSION['success_message'])) {
  echo "<p class='success-message'>{$_SESSION['success_message']}</p>";
  unset($_SESSION['success_message']); // remove the message after displaying it
}

if (isset($_SESSION['error_message'])) {
  echo "<p style='color: red;'>{$_SESSION['error_message']}</p>";
  unset($_SESSION['error_message']); // remove the message after displaying it
}
?>


<section id="content">
    <main>
        <!-- Dashboard -->
        <div id="dashboard-content">
            <div class="head-title">
                <div class="left">
                    <h1>Profile</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Profiled</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="studentDashboard.php">Home</a></li>
                    </ul>
                </div>
            </div>

            <div id="master-list">
                <div class="table-data">
                    <div class="order">
                   
                        <div id="table-container">
                        <h1 style="text-align: center;">My Profile</h1>
                        <form method="post" action="Student_update.php">
        <p class="personal_information">Personal Information</p>

        <div class="form-container1">
          <!-- Full name -->
          <div class="form-group">
            <label class="small-label" for="applicant_name">Complete Name</label>
            <input name="applicant_name" class="input" id="applicant_name" value="<?php echo $admissionData['applicant_name']; ?>">
          </div>
          <!-- Birthplace -->
          <div class="form-group">
            <label class="small-label" for="birthplace">Birthplace</label>
            <input name="birthplace" class="input" id="birthplace" value="<?php echo $admissionData['birthplace']; ?>">
          </div>
        </div>

        <div class="form-container2">
          <!-- Sex at Birth -->
          <div class="form-group">
            <label class="small-label" for="gender">Sex at birth</label>
            <input name="gender" class="input" id="gender" value="<?php echo $admissionData['gender']; ?>">
          </div>
          <!-- Birthdate -->
          <div class="form-group">
            <label class="small-label" for="birthdate">Birthdate</label>
            <input name="birthdate" class="input" id="birthdate" value="<?php echo $admissionData['birthdate']; ?>">
          </div>
        <!-- Age -->
        <div class="form-group">
            <label class="small-label" for="age">Age</label>
            <input name="age" class="input" id="age" value="<?php echo $admissionData['age']; ?>">
          </div>
          <!-- civil status -->
          <div class="form-group">
            <label class="small-label" for="civil_status">Civil Status</label>
            <input name="civil_status" class="input" id="civil_status" value="<?php echo $admissionData['civil_status']; ?>">
          </div>
          <!-- Citizenship -->
          <div class="form-group">
            <label class="small-label" for="citizenship">Citizenship</label>
            <input name="citizenship" class="input" id="citizenship" value="<?php echo $admissionData['citizenship']; ?>">
          </div>
          <!-- Nationality-->
          <div class="form-group">
            <label class="small-label" for="nationality">Nationality</label>
            <input name="nationality" class="input" id="nationality" value="<?php echo $admissionData['nationality']; ?>">
          </div>
        </div>

        <p class="personal_information">Permanent Home Address</p>

        <div class="form-container3">
          <div class="form-group">
            <label class="small-label" for="permanent_address">Address</label>
            <input name="permanent_address" class="input" id="permanent_address" value="<?php echo $admissionData['permanent_address']; ?>">
          </div>
          <!-- zip-code -->
          <div class="form-group">
            <label class="small-label" for="zip_code">Zip Code</label>
            <input name="zip_code" class="input" id="zip_code" value="<?php echo $admissionData['zip_code']; ?>">
          </div>
        </div>

        <p class="personal_information">Contact Information</p>
        <div class="form-container4">
          <!-- Telephone/Mobile No -->
          <div class="form-group">
            <label class="small-label" for="phone_number">Telephone/Mobile No.</label>
            <input name="phone_number" class="input" id="phone" value="<?php echo $admissionData['phone_number']; ?>">
          </div>

          <!-- Facebook Account Name -->
          <div class="form-group">
            <label class="small-label" for="facebook">Facebook Account Name</label>
            <input name="facebook" class="input" id="facebook" value="<?php echo $admissionData['facebook']; ?>">
          </div>
          <!--Email Address -->
          <div class="form-group">
            <label class="small-label" for="email">Email Address</label>
            <input name="email" class="input" id="email" value="<?php echo $admissionData['email']; ?>" readonly>
          </div>
        </div>

        <p class="personal_information">Contact Person(s) in Case of Emergency</p>
        <div class="form-container7">
          <!-- Contact Person 1 -->
          <div class="form-group">
            <label class="small-label" for="contact_person_1">Contact Person</label>
            <input name="contact_person_1" class="input" id="contact_person_1" value="<?php echo $admissionData['contact_person_1']; ?>">
          </div>
          <div class="form-group">
            <label class="small-label" for="contact_person_1_mobile">Mobile Number</label>
            <input name="contact_person_1_mobile" class="input" id="contact_person_1_mobile" value="<?php echo $admissionData['contact1_phone']; ?>">
          </div>
          <div class="form-group">
            <label class="small-label" for="relationship_1">Relationship with Contact Person</label>
            <input name="relationship_1" class="input" id="relationship_1" value="<?php echo $admissionData['relationship_1']; ?>">
          </div>
        </div>
        <div class="form-container7">
          <!-- Contact Person 2 -->
          <div class="form-group">
            <label class="small-label" for="contact_person_2">Contact Person</label>
            <input name="contact_person_2" class="input" id="contact_person_2" value="<?php echo $admissionData['contact_person_2']; ?>">
          </div>
          <div class="form-group">
            <label class="small-label" for="contact_person_2_mobile">Mobile Number</label>
            <input name="contact_person_2_mobile" class="input" id="contact_person_2_mobile" value="<?php echo $admissionData['contact_person_2_mobile']; ?>">
          </div>
          <div class="form-group">
            <label class="small-label" for="relationship_2">Relationship with Contact Person</label>
            <input name="relationship_2" class="input" id="relationship_2" value="<?php echo $admissionData['relationship_2']; ?>">
          </div>
        </div>

        <p class="personal_information">Academic Classification</p>
        <div class="form-container6">
          <!-- Academic Classification -->
          <div class="form-group">
    <label class="small-label" for="academic_classification">Academic Classification</label>
    <input name="academic_classification" class="input" id="academic_classification" value="<?php echo $admissionData['academic_classification']; ?>">
</div>

          <div class="form-group">
            <label class="small-label" for="degree_applied">Degree</label>
            <!-- Display the selected program in this input field -->
            <input name="degree_applied" class="input" id="degree_applied" value="<?php echo $admissionData['degree_applied']; ?>">
          </div>
          <div class="form-group">
            <label class="small-label" for="nature_of_degree" style="white-space: nowrap;">Nature of degree</label>
            <input name="nature_of_degree" class="input" id="nature_of_degree" value="<?php echo $admissionData['nature_of_degree']; ?>">
          </div>
        </div>
        <p class="personal_information">Academic Background </p>
        <div class="form-container5">
          <!-- Academic Background -->
          <div class="form-group">
            <label class="small-label" for="high_school_name_address" style="white-space: nowrap;">High School/Senior High School</label>
            <input name="high_school_name_address" class="input" id="high_school_name_address" value="<?php echo $admissionData['high_school_name_address']; ?>">
          </div>
          <div class="form-group">
            <label class="small-label" for="lrn" style="white-space: nowrap;">Learner's Reference Number</label>
            <input name="lrn" class="input" id="lrn" value="<?php echo $admissionData['lrn']; ?>">
          </div>
        </div>

        <!-- Add other fields for additional information editing -->

        <input type="submit" value="Update Profile">
    </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var successMessage = document.querySelector('.success-message');
        if (successMessage) {
            successMessage.style.display = 'block';
            setTimeout(function () {
                successMessage.style.display = 'none';
            }, 4000);
        }
    });
</script>

<style>

.success-message {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #4CAF50;
        color: white;
        padding: 15px 20px;
        border-radius: 5px;
        z-index: 1000;
        display: none;
    }
.head-title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}


#student-profile {
    /* background-color: #fff; */
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    font-weight: bold;
    margin-bottom: 5px;
}

input {
    width: 100%;
    padding: 5px;
    margin-bottom: 5px;
    box-sizing: border-box;
    font-size: 12px;
}

input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    cursor: pointer;
    margin-top: 10px;
    padding: 5px;
}

a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

p.personal_information {
    margin-top: 5px;
    margin-bottom: 5px;
    font-size: 12px;
    font-weight: bold;
    font-style: italic;
}
.form-container {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 10px;
  }
  .form-container1 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
  }
  .form-container2 {
    display: grid;
    grid-template-columns: 15% 17% 7% 17% 19% 19%;
    gap: 10px;
  }
  .form-container3 {
    display: grid;
    grid-template-columns: 3fr 1fr;
    gap: 10px;
  }
  .form-container4 {
    display: grid;
    grid-template-columns: repeat(3, 25% 37.5% 37.5%); 
    gap: 10px; 
  }
  .form-container5 {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 10px;
  }
  .form-container6 {
    display: grid;
    grid-template-columns: 20% 65% 15%;  
    gap: 10px;
  }
  .form-container7 {
    display: grid;
    grid-template-columns: repeat(3, 55% 20% 25%); 
    gap: 10px; 
  }
  .form-group {
  display: inline-block;
  margin-right: 15px;
  }
  
  /* Optional: Adjust the width of the label and input if needed */
  .small-label {
  /* width: 150px; Adjust the width as needed */
  font-size: 12px; /* Adjust this value as needed */
  margin-bottom: 5px;
  color: gray;
  }
</style>

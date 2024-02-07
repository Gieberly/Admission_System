<?php
include("config.php");
include("studentcover.php");


// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Student') {
    header("Location: loginpage.php");
    exit();
}

$studentId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $studentId);
$stmt->execute();
$result = $stmt->get_result();
$studentData = $result->fetch_assoc();

$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission for updating user password
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];

    // Check if the entered old password matches the stored hashed password
    if (password_verify($oldPassword, $studentData['password'])) {
        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Perform the update query
        $updateStmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $updateStmt->bind_param("si", $hashedPassword, $studentId);

        if ($updateStmt->execute()) {
            // Update successful
            header("Location: student.php");
            exit();
        } else {
            // Update failed
            echo "Error updating password: " . $conn->error;
        }

        $updateStmt->close();
    } else {
        // Old password does not match
        echo "Old password is incorrect. Please try again.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="icon" href="assets/images/BSU Logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/student.css" />
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="assets\js\jspdf.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <section id="content">
        <main>
            <!--Student Profile-->
            <div id="student-profile-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Profile</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Profile</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="studentDashboard.php">Home</a></li>
                        </ul>
                    </div>

                </div>
                <!--profile-->
                <div id="student-profile">
                    <div class="table-data">
                        <div class="order">
                        <h1 style="text-align: center;">My Profile</h1>

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
            <input name="phone_number" class="input" id="phone" value="+63<?php echo $admissionData['phone_number']; ?>">
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
            <input name="contact_person_1_mobile" class="input" id="contact_person_1_mobile" value="+63<?php echo $admissionData['contact1_phone']; ?>">
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
            <input name="contact_person_2_mobile" class="input" id="contact_person_2_mobile" value="+63<?php echo $admissionData['contact_person_2_mobile']; ?>">
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
<style>


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
</body>

</html>
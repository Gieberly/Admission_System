<?php
include("config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Update admission data
  $applicant_name = $_POST['applicant_name'];
  $birthplace = $_POST['birthplace'];
  $gender = $_POST['gender'];
  $birthdate = $_POST['birthdate'];
  $age = $_POST['age'];
  $civil_status = $_POST['civil_status'];
  $citizenship = $_POST['citizenship'];
  $nationality = $_POST['nationality'];
  $permanent_address = $_POST['permanent_address'];
  $zip_code = $_POST['zip_code'];
  $phone_number = $_POST['phone_number'];
  $facebook = $_POST['facebook'];
  $email = $_POST['email'];
  $contact_person_1 = $_POST['contact_person_1'];
  $contact1_phone = $_POST['contact_person_1_mobile'];
  $relationship_1 = $_POST['relationship_1'];
  $contact_person_2 = $_POST['contact_person_2'];
  $contact_person_2_mobile = $_POST['contact_person_2_mobile'];
  $relationship_2 = $_POST['relationship_2'];
  $academic_classification = $_POST['academic_classification'];
  $high_school_name_address = $_POST['high_school_name_address'];
  $lrn = $_POST['lrn'];
  $degree_applied = $_POST['degree_applied'];
  $nature_of_degree = $_POST['nature_of_degree'];

  // Prepare update statement
  $stmt = $conn->prepare("UPDATE admission_data SET applicant_name=?, birthplace=?, gender=?, birthdate=?, age=?, civil_status=?, citizenship=?, nationality=?, permanent_address=?, zip_code=?, phone_number=?, facebook=?, contact_person_1=?, contact1_phone=?, relationship_1=?, contact_person_2=?, contact_person_2_mobile=?, relationship_2=?, academic_classification=?, high_school_name_address=?, lrn=?, degree_applied=?, nature_of_degree=? WHERE email=?");
  $stmt->bind_param("ssssisssssssssssssssssss", $applicant_name, $birthplace, $gender, $birthdate, $age, $civil_status, $citizenship, $nationality, $permanent_address, $zip_code, $phone_number, $facebook, $contact_person_1, $contact1_phone, $relationship_1, $contact_person_2, $contact_person_2_mobile, $relationship_2, $academic_classification, $high_school_name_address, $lrn, $degree_applied, $nature_of_degree, $email);

  // Execute the update statement
  if ($stmt->execute()) {
    // Set success message
    session_start();
    $_SESSION['success_message'] = "Profile updated successfully.";
  } else {
    // Set error message if update fails
    $_SESSION['error_message'] = "Failed to update profile. Please try again later.";
  }

  // Redirect to avoid form resubmission
  header("Location: Student_EditProfile.php");
  exit();
}
?>

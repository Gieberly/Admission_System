<?php

//Function to get all staff members
function getAllStaff() {
    global $conn;
    $query = "SELECT id, name, email, status,state, created_date FROM users WHERE userType = 'Staff'";
    $result = $conn->query($query);
    return $result;
}

// Function to update staff status
function updateStaffStatus($staffId, $newState) {
    global $conn;
    $query = "UPDATE users SET state = ? WHERE id = ? AND userType = 'Staff'";
    $stmt = $conn->prepare($query); 
    $stmt->bind_param("si", $newState, $staffId);
    return $stmt->execute();
}

function editAppointmentSlots($appointment_id, $newSlot) {
    global $conn;
    $query = "SELECT appointment_id From appointmentdate";
    $stmt = $conn->prepare($query); 
    $stmt->bind_param("si",$newSlot, $appointment_id);
    return $stmt->execute();
}
function getAppointments()
{
    global $conn;
    $query = "SELECT*FROM appointmentdate";
    $result = $conn->query($query);
    return $result;
}
// Function to delete staff member
function deleteStaff($staffId) {
    global $conn;
    $query = "DELETE FROM users WHERE id = ? AND userType = 'Staff'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $staffId);
    return $stmt->execute();
}

// Check if the form for updating status is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateStatus'])) {
    $staffId = $_POST['staffId'];
    $newStatus = $_POST['newStatus'];
    updateStaffStatus($staffId, $newStatus);
}

// Check if the form for deleting staff member is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteStaff'])) {
    $staffId = $_POST['staffId'];
    deleteStaff($staffId);
}

// Check if the form for editing appointment slots is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateSlots'])) {
    $appointment_id = $_POST['appointment_id'];
    editAppointmentSlots($appointment_id);
}
//Function to get all Departments
function getAllDept() {
    global $conn;
    $query = "SELECT dept_id, college_name, dept_name, course, slots,used_slots,dept_chair FROM department ";
    $result = $conn->query($query);
    return $result;
}


// Function to get all student form data
function getAllStudentFormData() {
    global $conn;
    $query = "SELECT *FROM applicant";
    $result = $conn->query($query);
    return $result;
}

// Function to get all student form data
// function getColleges(){
//     global $conn;
//     $sql = "SELECT * FROM `bsu_admission_db.tables`";
//     $all_colleges = $conn->query($sql);
//     return $all_colleges;
// }


// Display all student form data in the table
 $studentFormData = getAllStudentFormData();
// $allColleges = getColleges();

 
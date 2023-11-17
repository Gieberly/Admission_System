<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $studentId = $_GET['id'];

    // Fetch student data based on the ID
    $query = "SELECT * FROM admission_data WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();
    $studentData = $result->fetch_assoc();
}
?>

<!-- Add this form in the <body> section of edit_student.php -->
<form id="editForm" method="post">
    <!-- Include fields for editing student information -->
    <!-- Ensure to include hidden input for the student ID -->
    <input type="hidden" name="studentId" value="<?php echo $studentData['id']; ?>">
    <!-- Add fields for other information (e.g., name, email, etc.) -->

    <!-- Add a submit button for saving changes -->
    <input type="submit" name="saveChanges" value="Save Changes">
</form>

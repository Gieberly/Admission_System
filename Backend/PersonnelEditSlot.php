<?php
include("config.php");
include_once("personnelcover.php");


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

function getCourses($conn) {
    $courses = array();

    $sql = "SELECT * FROM Courses";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $courses[] = $row;
        }
    }

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

    <section id="content">
      
        
      

        <main>

        <div id="announcements-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Annoucement</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Announcement</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><p>FAQ</p></li>
                        </ul>
                    </div>
                </div>
                <!--form-->
                <div class="tabs">
                    <button class="tab-button " data-tab="tab3"  onclick="window.location.href='faq.php'">FAQ</button>
                    <button class="tab-button active" data-tab="tab4" onclick="window.location.href='PersonnelEditSlot.php'">Slot</button>
                    <button class="tab-button" data-tab="tab5"  onclick="window.location.href='Reapplication.php'">Readmission Date</button>

                </div>
                <div class="table-data">
                        <div class="order">
                        
                            <div class="head">
						<h3>Steps for Reapplication</h3>
                        <button class="button save" id="addcoursepop" >Add Steps</button>
						
					</div>
                
                    <div class="tab-content" id="tab4" style="display: block;">
              
              <div>
              <table id=courses-table>
              <colgroup>
                           
                                        <col style="width: 5%;">
                                        <col style="width: 40%;">
                                        <col style="width: 15%;">
                                        <col style="width: 15%;"> 
                                        <col style="width: 25%;">
                                       
                                       
                                    </colgroup>
                    <thead>
               <tr>
                <th>#</th>
                <th>Courses</th>
                <th>Total Slots</th>
                <th>Slots Left</th>
                <th>Action</th>
            </tr>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
        $courses = getCourses($conn);

        foreach ($courses as $index => $course) {
            echo "<tr>";
            echo "<td>" . ($index + 1) . "</td>";
            echo "<td>" . $course['CourseName'] . "</td>";
            echo "<td>" . $course['TotalSlots'] . "</td>";
            
            echo "<td>" . $course['AvailableSlots'] . "</td>";
            echo "<td>";
           echo "<button class='button delete' onclick='deleteCourse(" . $course['CourseID'] . ")'>Delete</button>";
           echo "<button class='button edit' onclick='editCourse(" . $course['CourseID'] . ", \"" . $course['CourseName'] . "\", " . $course['TotalSlots'] . ", " . $course['AvailableSlots'] . ")'>Edit</button>";
 
           echo "</td>";
            echo "</tr>";
        }
    ?>
        </tbody>
    </table>
    <div>
    <div id="edit-course-section" style="display: none;">
        <h2>Edit Course</h2>
        <form id="edit-course-form" action="PersonnelUpdate_course.php" method="post">
            <input type="hidden" id="edit-courseID" name="courseID">
            <label for="edit-courseName">Course Name:</label>
            <input type="text" id="edit-courseName" name="courseName" required>
            <label for="edit-totalSlots">Total Slots:</label>
            <input type="number" id="edit-totalSlots" name="totalSlots" required>
            <label for="edit-availableSlots">Available Slots:</label>
            <input type="number" id="edit-availableSlots" name="availableSlots" required>
            <button type="button" class="button save" onclick="saveEditedCourse()">Save Course</button>
        </form>
    </div>

    <div id="add-course-section">
       
        <form id="add-course-form" action="PersonneladdCourse.php" method="post" style="display: none;">
        <h2>Add New Course</h2>
            <label for="new-courseName">Course Name:</label>
            <input type="text" id="new-courseName" name="courseName" required>

            <label for="new-totalSlots">Total Slots:</label>
            <input type="number" id="new-totalSlots" name="totalSlots" required>

            <label for="new-availableSlots">Available Slots:</label>
            <input type="number" id="new-availableSlots" name="availableSlots" required>

            <button type="button" class="button save" onclick="addNewCourse()">Add</button>
        </form>
    </div>
    </div></div></div>
    <script>
        function editCourse(courseID, courseName, totalSlots, availableSlots) {
            // Set values in the edit form
            document.getElementById('edit-courseID').value = courseID;
            document.getElementById('edit-courseName').value = courseName;
            document.getElementById('edit-totalSlots').value = totalSlots;
            document.getElementById('edit-availableSlots').value = availableSlots;
          

            // Show the edit form and hide the table
            document.getElementById('edit-course-section').style.display = 'block';
            document.getElementById('courses-table').style.display = 'none';
             document.getElementById('add-course-form').style.display = 'none';
        }

        function saveEditedCourse() {
            // Submit the form for saving the edited course
            document.getElementById('edit-course-form').submit();
        }
        function addNewCourse() {
            // Submit the form for adding a new course
            document.getElementById('add-course-form').submit();
        }
        function deleteCourse(courseID) {
        if (confirm("Are you sure you want to delete this course?")) {
            window.location.href = 'deleteCourse.php?courseID=' + courseID;
        }
    }
    document.getElementById('addcoursepop').addEventListener('click', function() {
        var addCourseSection = document.getElementById('add-course-form');
        addCourseSection.style.display = 'block';
        document.getElementById('edit-course-section').style.display = 'none';
            document.getElementById('courses-table').style.display = 'none';
              document.getElementById('addcoursepop').style.display = 'none';
        
    });
    document.getElementById('announcements-link').parentElement.classList.add('active');
    </script>
    </div>

</body>


    
  

</body>
</html>
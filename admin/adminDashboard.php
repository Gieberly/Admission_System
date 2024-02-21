<?php
session_start();
include("config.php");
include("../admin/adminCover.php");

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Admin') {
    header("Location: loginpage.php");
    exit();
}
// Fetch the sum of Overall_Slots from the programs table
$sql = "SELECT SUM(Overall_Slots) AS total_slots FROM programs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    $row = $result->fetch_assoc();
    $totalSlots = $row['total_slots'];
} else {
    $totalSlots = 0;
}

// Fetch the count of records from the admission_data table
$sql = "SELECT COUNT(*) AS total_students FROM admission_data";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of the first row
    $row = $result->fetch_assoc();
    $totalStudents = $row['total_students'];
} else {
    $totalStudents = 0;
}

$conn->close();
?>
    <section id="content">
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
                        <h3><?php echo $totalSlots; ?></h3>
                            <p>Available Slots</p>
                        </span>
                    </li>

                    <li id="admission-box">
                        <i class='bx bxs-group'></i>
                        <span class="text">
                        <h3><?php echo $totalStudents; ?></h3>
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
            
</main>
    </section>
<?php

include("config.php");
include("personnelcover.php");


// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Staff') {
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

// Fetch the count of records from the admission_data table without NOR or NOA in the Result column
$sql = "SELECT COUNT(*) AS total_students FROM admission_data WHERE Result IS NULL OR Result NOT LIKE '%NOR%' AND Result NOT LIKE '%NOA%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of the first row
    $row = $result->fetch_assoc();
    $totalStudents = $row['total_students'];
} else {
    $totalStudents = 0;
}
// Fetch the count of records from the admission_data table with "NOA" in the Result column
$sql = "SELECT COUNT(*) AS admitted_students FROM admission_data WHERE Result LIKE '%NOA%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of the first row
    $row = $result->fetch_assoc();
    $admittedStudents = $row['admitted_students'];
} else {
    $admittedStudents = 0;
}
// Fetch the count of records from the admission_data table with "NOR" in the Result column
$sql = "SELECT COUNT(*) AS readmitted_students FROM admission_data WHERE Result LIKE '%NOR%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of the first row
    $row = $result->fetch_assoc();
    $readmittedStudents = $row['readmitted_students'];
} else {
    $readmittedStudents = 0;
}

$conn->close();



?>

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
            <!--Dashboard-->
            <div id="dashboard-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Dashboard</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="personnel.php">Home</a></li>
                        </ul>
                    </div>
                </div>

                <ul class="box-info">
                    <li id="available-box">
                        <a href="PersonnelEditSlot.php">
                            <i class='bx bx-clipboard'></i></a>
                        <span class="text">
                            <h3><?php echo $totalSlots; ?></h3>
                            <p>Available Slots</p>
                        </span>
                    </li>

                    <li id="admission-box">
                        <a href="masterlist.php">
                            <i class='bx bxs-group'></i>
                        </a>
                        <span class="text">
                            <h3><?php echo $totalStudents; ?></h3>
                            <p>Students For Admission</p>
                        </span>
                    </li>


                    <li id="admitted-box">
                        <a href="your_destination_url_here">
                            <i class='bx bx-user-check'></i></a>
                        <span class="text">
                        <h3><?php echo $admittedStudents; ?></h3>
                            <p>Admitted Students</p>
                        </span>
                    </li>

                    <li id="readmitted-box">
                        <a href="your_destination_url_here">
                            <i class='bx bxs-user-x'></i></a>
                        <span class="text">
                        <h3><?php echo $readmittedStudents; ?></h3>
                            <p>Students For Readmission</p>
                        </span>
                    </li>
                </ul>

            </div>






        </main>
        <!-- MAIN -->

    </section>
</body>

</html>
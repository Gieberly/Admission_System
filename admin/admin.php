<?php
session_start();
include("..\config.php");
include("../includes/functions.php");

// Check if the user is an admin, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Admin') {
    header("Location: loginpage.php");
    exit();
}

// Fetch staff information from the database based on user ID
$userID = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT last_name, email, userType,password FROM users WHERE id = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($lname,$email, $userType, $status);
$stmt->fetch();
$stmt->close();

?>

<?php include ('../template/header_admin.php')?>

<body>
<?php include ('sidebar-admin.php')?>
    <!-- CONTENT -->
    <section id="content">
        <?php include("../template/navBar_admin.php")?>
        <!-- MAIN -->

        <main>
            <?php include ('masterlist_admin.php')?>
            <?php include ('dashboard_admin.php')?>
            <?php include ('personnel_admin.php')?>
            <?php include('colleges.php');?>
            <?php include('appointment.php');?>
            <?php include('data_admin.php');?>
        </main>
        <!-- MAIN -->

    </section>
    <?php include ('profile.php')?>
    <?php include ('script.php')?>
    <!-- CONTENT -->
<?php include("../template/footer.php")?>

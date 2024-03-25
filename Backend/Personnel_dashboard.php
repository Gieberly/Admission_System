<?php

include("config.php");
include("Personnel_Cover.php");


// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Staff') {
    header("Location: loginpage.php");
    exit();
}


?>

<head>
    <meta charset="UTF-8">
    <title>BSU OUR Admission Unit Personnel</title>
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
                            <li><a class="active" href="Personnel_dashboard.php">Home</a></li>
                        </ul>
                    </div>
                </div>

                <ul class="box-info">
                    <li id="available-box">
                        <a href="PersonnelEditSlot.php">
                            <i class='bx bx-clipboard'></i></a>
                        <span class="text">
                            <h3>11</h3>
                            <p>Available Slots</p>
                        </span>
                    </li>

                    <li id="admission-box">
                        <a href="masterlist.php">
                            <i class='bx bxs-group'></i>
                        </a>
                        <span class="text">
                            <h3>11</h3>
                            <p>Students For Admission</p>
                        </span>
                    </li>


                    <li id="admitted-box">
                        <a href="your_destination_url_here">
                            <i class='bx bx-user-check'></i></a>
                        <span class="text">
                        <h3>11</h3>
                            <p>Admitted Students</p>
                        </span>
                    </li>

                    <li id="readmitted-box">
                        <a href="your_destination_url_here">
                            <i class='bx bxs-user-x'></i></a>
                        <span class="text">
                        <h3>11</h3>
                            <p>Students For Reapplication</p>
                        </span>
                    </li>
                </ul>

            </div>






        </main>
        <!-- MAIN -->

    </section>
</body>

</html>
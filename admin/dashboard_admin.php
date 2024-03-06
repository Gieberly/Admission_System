<?php
include("..\config.php");
include("../includes/functions.php");

?>

<?php include ('../template/header_admin.php')?>

<body>
<?php include ('sidebar-admin.php')?>
    <!-- CONTENT -->
    <section id="content">
        <?php include("../template/navBar_admin.php")?>
        <!-- MAIN -->
        <main>
<!--Dashboard-->
            <div id="dashboard-content">
                    <div class="head-title">
                        <div class="left">
                            <h1>Dashboard</h1>
                            <ul class="breadcrumb">
                                <li><a href="#">Dashboard</a></li>
                                <li><i class='bx bx-chevron-right'></i></li>
                                <li><a class="active" href="#top">Home</a></li>
                            </ul>
                        </div>
                    </div>

                    <ul class="box-info">
                        <li id="available-box">
                            <i class='bx bx-clipboard'></i>
                            <span class="text">
                                <h3><?php $veri_app_query ="SELECT * FROM courses";
                            $veri_app_query_run = mysqli_query($conn, $veri_app_query);
                            if($app_total = mysqli_num_rows($veri_app_query_run)){

                                echo '<h3>'.$app_total.'</h3>';
                            }else{
                                echo '<h3>0</h3>';
                            }
                            ?></h3>
                                <p>Colleges with Slots</p>
                            </span>
                        </li>

                        <li id="admission-box">
                            <i class='bx bxs-user-account'></i>
                            <span class="text">
                                <h3><?php $veri_app_query ="SELECT * FROM applicant";
                            $veri_app_query_run = mysqli_query($conn, $veri_app_query);
                            if($app_total = mysqli_num_rows($veri_app_query_run)){

                                echo '<h3>'.$app_total.'</h3>';
                            }else{
                                echo '<h3>0</h3>';
                            }
                            ?></h3>
                                <p>Student Applicants</p>
                            </span>
                        </li>

                        <li id="admitted-box">
                            <i class='bx bx-user-check'></i>
                            <span class="text">
                                <h3><?php $veri_app_query ="SELECT * FROM application WHERE result ='NOA'";
                            $veri_app_query_run = mysqli_query($conn, $veri_app_query);
                            if($app_total = mysqli_num_rows($veri_app_query_run)){

                                echo '<h3>'.$app_total.'</h3>';
                            }else{
                                echo '<h3>0</h3>';
                            }
                            ?></h3>
                                <p>Admitted Students</p>
                            </span>
                        </li>

                        <li id="readmitted-box">
                            <i class='bx bxs-group'></i>
                            <span class="text">
                                <h3><?php $veri_app_query ="SELECT * FROM users WHERE userType = 'staff'";
                            $veri_app_query_run = mysqli_query($conn, $veri_app_query);
                            if($app_total = mysqli_num_rows($veri_app_query_run)){

                                echo '<h3>'.$app_total.'</h3>';
                            }else{
                                echo '<h3> No result</h3>';
                            }
                            ?></h3>
                                <p>Personnels</p>
                            </span>
                        </li>
                    </ul>

                </div>
                </main>
        <!-- MAIN -->
</section>
<?php include ('profile.php')?>
<?php include ('script.php')?>
<!-- CONTENT -->
<?php include("../template/footer.php")?>
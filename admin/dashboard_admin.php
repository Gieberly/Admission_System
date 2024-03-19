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
                            <ul class="breadcrumb" style="background-color:inherit">
                                <li><a href="#" style="text-decoration:none;">Dashboard</a></li>
                                <li><i class='bx bx-chevron-right'></i></li>
                                <li><a class="active" href="#top" style="text-decoration:none">Home</a></li>
                            </ul>                            
                        </div>
                        <!--dropdown-->
                        <div class="dropdown">
                            <a class="btn btn-success dropdown-toggle" style="border-radius: 20px;" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                Admission Period
                            </a>
                            <div class="dropdown-menu" style="border-radius: 10px;">
                                <a class="dropdown-item active" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                            <div class="btn-group mr-2" role="group">
                                <button type="button" class="btn btn-primary" style="border-radius: 20px;"><i class='bx bx-user-plus'></i> New admission</button>
                            </div>
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
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
                            <i class='bx bx-calendar'></i> Admission Period
                            </a>
                            <div class="dropdown-menu" style="border-radius: 10px;">
                                <a class="dropdown-item active" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                            <div class="btn-group mr-2" role="group">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#appointmentform" style="border-radius: 20px;"><i class='bx bx-user-plus'></i> New admission</button>
                            </div>
                        </div>                        
                    </div>
                    <!--Modal-->
                    <div class="modal fade" id="new_admission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header border-bottom-0">
                                <h5 class="modal-title" id="exampleModalLabel">Create New Admission Period</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                <p class="error" id="err"></p>
                            </div>
                            <form method="POST" id="saveAdmission">
                                <div class="modal-body">
                                    <div class="alert alert-warning d-none"></div>
                                <div class="form-group">
                                    <label for="start">Start of Admission</label>
                                    <input type="date" class="form-control" id="start" aria-describedby="dateHelp" name="start" placeholder="Enter date">
                                </div>
                                <div class="form-group">
                                    <label for="end">End of Admission</label>
                                    <input type="date" class="form-control" id="end" name="end" placeholder="Enter Admission End">
                                </div>
                                <div class="form-group">
                                    <label for="sem">Semester</label>
                                    <input type="text" class="form-control" id="sem" name="sem" placeholder="Enter Semester">
                                </div>
                                <div class="form-group">
                                    <label for="acad">Academic Year</label>
                                    <input type="text" class="form-control" id="acad" name="acad" placeholder="Enter Academic Year">
                                </div>
                                </div>
                                <div class="modal-footer border-top-0 d-flex justify-content-center">
                                <button type="submit" id="submit_admission" name="submit_admission" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <!--MOdal End-->
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
<script>
    $(document).on('submit', '#saveAdmission', function(e)
    {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("save_admission", true);

        $.ajax({
            type:"POST",
            url:"backend/create_admission.php",
            data:formData,
            processData:false,
            contentType: false,
            success: function (response)
            {
                var res = jQuery.parseJSON(response);
                if(res.status == 422)
                {
                    $('#errorMessage').removeClass('d-none');
                    $('#errorMessage').text(res.message);
                }
                else if(res.status == 200)
                {
                    $('#errorMessage').addClass('d-none');
                    $('#new_admission').modal('hide');
                    $('#saveAdmission')[0].reset();
                }
            },
            error: function(xhr, status, error) {
                console.error("Error occurred:", error);
            }
        });
    });
</script>


<?php include ('profile.php')?>
<?php include ('script.php')?>
<!-- CONTENT -->
<?php include("../template/footer.php")?>
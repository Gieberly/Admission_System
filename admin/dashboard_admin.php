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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#admissionAddModal" style="border-radius: 20px;"><i class='bx bx-folder-plus'></i> New admission</button>
                            </div>
                        </div>                        
                    </div>
                    <!--Modal-->
                    <div class="modal fade" id="admissionAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header border-bottom-0">
                                <h5 class="modal-title" id="exampleModalLabel">Create New Admission Period</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                <p class="error" id="err"></p>
                            </div>
                            <form id="saveAdmission">
                                <div class="modal-body">
                                    <div class="alert alert-warning d-none"></div>

                                <div class="form-group">
                                    <label for="start">Start of Admission</label>
                                    <input type="date" class="form-control" id="start" name="start" placeholder="Enter date">
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
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button type="submit"  class="btn btn-success">Save Admission</button>
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
                                <h3>1000</h3>
                                <p>Colleges with Slots</p>
                            </span>
                        </li>

                        <li id="admission-box">
                            <i class='bx bxs-user-account'></i>
                            <span class="text">
                                <h3>1000</h3>
                                <p>Student Applicants</p>
                            </span>
                        </li>

                        <li id="admitted-box">
                            <i class='bx bx-user-check'></i>
                            <span class="text">
                                <h3>1000</h3>
                                <p>Admitted Students</p>
                            </span>
                        </li>

                        <li id="readmitted-box">
                            <i class='bx bxs-group'></i>
                            <span class="text">
                                <h3>1000</h3>
                                <p>Personnels</p>
                            </span>
                        </li>
                    </ul>

                </div>
                <div class="container pt-4">
                    <!-- Section: Main chart -->
                    <section class="mb-4">
                        <div class="card">
                        <div class="card-header py-3">
                            <h5 class="mb-0 text-center"><strong>Visitor</strong></h5>
                        </div>
                        <div class="card-body">
                            <canvas class="my-4 w-100" id="myChart" height="380"></canvas>
                        </div>
                        </div>
                    </section>
                    <!-- Section: Main chart -->
                </div>
                </main>
        <!-- MAIN -->
</section>

<?php include ('profile.php')?>
<?php include ('script.php')?>
<script>
    $(document).on('submit', '#saveAdmission', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("save_admission", true);

        $.ajax({
            type: "POST",
            url: "../backend/create_admission.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                
                var res = jQuery.parseJSON(response);
                if(res.status == 422) {
                    jQuery('#errorMessage').removeClass('d-none');
                    jQuery('#errorMessage').text(res.message);
                } else if(res.status == 200){
                    jQuery('#errorMessage').addClass('d-none');
                    jQuery('#admissionAddModal').modal('hide');
                    jQuery('#saveAdmission')[0].reset();
                } else if(res.status == 500) {
                    alert(res.message);
                }
            }
        });

    });
</script>
<script>
    var ctx = document.getElementById("myChart");

var myChart = new Chart(ctx, {
  type: "line",
  data: {
    labels: [
      "Sunday",
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
    ],
    datasets: [
      {
        data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
        lineTension: 0,
        backgroundColor: "transparent",
        borderColor: "#007bff",
        borderWidth: 4,
        pointBackgroundColor: "#007bff",
      },
    ],
  },
  options: {
    scales: {
      yAxes: [
        {
          ticks: {
            beginAtZero: false,
          },
        },
      ],
    },
    legend: {
      display: false,
    },
  },
});
</script>
<!-- CONTENT -->
<?php include("../template/footer.php")?>
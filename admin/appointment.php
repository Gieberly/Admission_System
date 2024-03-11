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
            <div id="schedule-result-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Schedule</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Admin</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="#">Appointment Schedule</a></li>
                        </ul>
                    </div>
                </div>
                <!--COntents Here-->
                <div id="scheduled-appointment">
                    <?php
                    if(isset($_GET['msg']))
                    {
                        $msg = $_GET['msg'];
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        '.$msg.'
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    }
                    ?>

                    <div class="table-data">
                        <div class="order">
                            <div id="table-container">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h3 class="panel-title"></h3>
                                        </div>
                                        <div class="col-md-2" align="right">
					                        <button type="button" name="add" id="addRecord" class="btn btn-success"><i class='bx bx-calendar-plus'></i>Add New Record</button>
				                        </div>
                                    </div>
                                </div>
                                <!-- Table for displaying student data -->
                                <table class="table table-bordered table-striped table-hover " id="appointmentId">
                                    <!-- table header -->
                                    <thead>
                                        <tr>

                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Slots</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="contents">
                                        <?php
                                        // Counter for numbering the students
                                        $counter = 1;
                                        $getAppointments = getAppointments();
                                        // Loop through the results and populate the table rows
                                        while ($row = $getAppointments->fetch_assoc()) {
                                        ?>
                                          <tr>
                                            <td><?php echo $counter++; ?></td>
                                            <td><?php echo $row['appointment_date']; ?></td>
                                            <td><?php echo $row['appointment_time']; ?></td>
                                            <td><?php echo $row['available_slots']; ?></td>
                                            <td> 
                                                <a href="update_data_form.php?id=<?php echo $row['appointment_id']; ?>" class="btn btn-primary">Edit<i class='bx bx-edit'></i></a>
                                                <a href="delete_data.php?id=<?php echo $row['appointment_id']; ?>" class="btn btn-danger">Delete<i class='bx bxs-trash'></i></a>
                                            </td>
                                        </tr>
  
                                        <?php
                                        }
                                        ?>                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--OffCanvas-->
                        <!--End of Canvass-->
                    </div>
                </div>
            </div>
         </main>
        <!-- MAIN -->
</section>
<?php include ('profile.php')?>
<?php include ('script.php')?>
<!--Data Tables-->
<script src="https://cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>

<script>
    $(document).ready(function(){
        $('#appointmentId').DataTable({
            "pagingType":"full_numbers",
            "lengthMenu":[
                [10,25,50,-1],
                [10,25,50,"All"]
            ],
            language:{
                search: "_INPUT_",
                searchPlaceholder:'Search records',
            }
        });
    });
</script>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Modal body content -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<?php include("../template/footer.php")?>
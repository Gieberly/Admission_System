


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
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-secondary">Add</button>
            <button type="button" class="btn btn-secondary">Edit</button>
            <button type="button" class="btn btn-secondary">Delete</button>
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
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                </ul>
            </div>
            </nav>
                <!-- Table for displaying student data -->
                <table cellpadding="0" cellspacing="0" border="0" class="table table-border" id="table-appointment">
                    <!-- table header -->
                    <thead>
                        <tr>

                            <th>#</th>
                            <th>Appointment number</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Slots</th>
                            <th>Action</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <!-- table body -->
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
                                <td><?php echo $row['appointment_id']; ?></td>
                                <td ><?php echo $row['appointment_date']; ?></td>
                                <td ><?php echo $row['appointment_time']; ?></td>
                                <td><?php echo $row['available_slots']; ?></td>
                                <td> 
                                    <a href="edit_form.php?appointment_id=<?php echo $row['appointment_id']; ?>" class="link-dark"><i class='bx bx-edit' style="font-size:20px"></i></a>
                                    <a href="" class="link-dark"><i class='bx bxs-trash' style="font-size:20px"></i></a>
                                </td>

                                <!-- Add more columns as needed -->
                            </tr>
                        <?php
                        }
                        ?>                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</div>

<!-- Script -->
<script> 
        $(document).ready(function () {
    $('#table-appointment').DataTable({
        "paging": true, // Enable pagination
        "ordering": true, // Enable sorting
        "order": [], // Initial order (disable sorting by default)
        "lengthMenu": [10, 25, 50, 70, 100], // Set custom page length options
        "pageLength": 25 // Default page length
    });
});
</script> 
<script type="text/javascript">
$(document).ready(function(){

  // Check/Uncheck ALl
  $('#checkAll').change(function(){
    if($(this).is(':checked')){
      $('input[name="update[]"]').prop('checked',true);
    }else{
      $('input[name="update[]"]').each(function(){
         $(this).prop('checked',false);
      });
    }
  });

  // Checkbox click
  $('input[name="update[]"]').click(function(){
    var total_checkboxes = $('input[name="update[]"]').length;
    var total_checkboxes_checked = $('input[name="update[]"]:checked').length;

    if(total_checkboxes_checked == total_checkboxes){
       $('#checkAll').prop('checked',true);
    }else{
       $('#checkAll').prop('checked',false);
    }
  });
});
</script>

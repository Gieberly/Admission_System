
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
                        <button type="button" name="add" id="addRecord" class="btn btn-success">Add New Record</button>
                    </div>
                </div>
            </div>
                <!-- Table for displaying student data -->
                <table class="table table-bordered " id="appointmentId">
                    <!-- table header -->
                    <thead>
                        <tr>

                            <th>#</th>
                            <th>Appointment number</th>
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
            
            <!--Modal-->
            <div id="recordModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="recordForm">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Edit Record</h4>
    				</div>
    				<div class="modal-body">
						<div class="form-group"
							<label for="name" class="control-label">Name</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Name" required>			
						</div>
						<div class="form-group">
							<label for="age" class="control-label">Age</label>							
							<input type="number" class="form-control" id="age" name="age" placeholder="Age">							
						</div>	   	
						<div class="form-group">
							<label for="lastname" class="control-label">Skills</label>							
							<input type="text" class="form-control"  id="skills" name="skills" placeholder="Skills" required>							
						</div>	 
						<div class="form-group">
							<label for="address" class="control-label">Address</label>							
							<textarea class="form-control" rows="5" id="address" name="address"></textarea>							
						</div>
						<div class="form-group">
							<label for="lastname" class="control-label">Designation</label>							
							<input type="text" class="form-control" id="designation" name="designation" placeholder="Designation">			
						</div>						
    				</div>
    				<div class="modal-footer">
    					<input type="hidden" name="id" id="id" />
    					<input type="hidden" name="action" id="action" value="" />
    					<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>

        </div>
    </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.min.js"></script>
<script>
	$(document).ready(function(){
		var table = $('#appointmentId').DataTable({

		});
	});

</script>
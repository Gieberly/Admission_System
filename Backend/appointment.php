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
    <div class="table-data">
        <div class="order">
            <div id="table-container">
                <!-- Table for displaying student data -->
                <table class="table table-border" id="table-appointment">
                    <!-- table header -->
                    <colgroup>
                        <col style="width: 5%;">
                        <col style="width: 10%;">
                        <col style="width: 10%;">
                        <col style="width: 15%;">
                        <col style="width: 15%;">
                        <col style="width: 15%;">  
                    </colgroup>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Appointment number</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Slots</th>
                            <th>Actions</th>
                            
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
                                <td><?php echo $row['appointment_date']; ?></td>
                                <td><?php echo $row['appointment_time']; ?></td>
                                <td><?php echo $row['available_slots']; ?></td>
                                <td>
                                <form method="post" action="">
                                <input type="hidden" name="appointment_id" value="<?php echo $row['appointment_id']; ?>">
                                    <!-- Dropdown for updating status -->                                    
                                    <select name="newSlots">
                                    
                                        <option value="Edit"><i class='bx bx-edit'>Edit</i></option>
                                        <option value="Delete">Delete</option>
                                    </select>
                                    <button type="submit" name="updateSlots">Update Slots</button>
                                </form>
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
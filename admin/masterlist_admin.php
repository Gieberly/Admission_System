<?php include("..\config.php");?>

<!--Master List-->
<div id="master-list-content">
    <div class="head-title">
        <div class="left">
            <h1>Master List</h1>
            <ul class="breadcrumb">
                <li><a href="#">Admin</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#master-list-content">Masterlist</a></li>
            </ul>
        </div>
    </div>

    <!--master list-->
    <div id="master-list">
    <div class="table-data">
        <div class="order">
            <div id="table-container">
                <!-- Table for displaying student data -->
                <table class="table table-border" id="table">
                <colgroup>
                        <col style="width: 5%;">
                        <col style="width: 10%;">
                        <col style="width: 10%;">
                        <col style="width: 15%;">
                        <col style="width: 15%;">
                        <col style="width: 10%;">
                        <col style="width: 10%;">  
                        <col style="width: 10%;">  
                        <col style="width: 15%;">    
                    </colgroup>
                    <!-- table header -->
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date Account Created</th>
                            <th>Application No.</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>College</th>
                            <th>Course</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <!-- table body -->
                    <tbody id="contents">
                        <?php
                        // Counter for numbering the students
                        $counter = 1;

                        // Loop through the results and populate the table rows
                        while ($row = $studentFormData->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $counter++; ?></td>
                                <td><?php echo $row['application_date']; ?></td>
                                <td><?php echo $row['app_number']; ?></td>
                                <td><?php echo $row['fname']; ?></td>
                                <td><?php echo $row['lname']; ?></td>
                                <td><?php echo $row['college']; ?></td>
                                <td><?php echo $row['course']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><form method="post" action="">
                        <input type="hidden" name="staffId" value="<?php echo $row['id']; ?>">

                        <!-- Dropdown for updating status -->
                        <select name="newStatus">
                         
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>

                        <button type="submit" name="updateStatus">Update Status</button>
                    </form></td>
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
    $('#table').DataTable({
        "paging": true, // Enable pagination
        "ordering": true, // Enable sorting
        "order": [], // Initial order (disable sorting by default)
        "lengthMenu": [10, 25, 50, 70, 100], // Set custom page length options
        "pageLength": 25 // Default page length
    });
});

</script> 
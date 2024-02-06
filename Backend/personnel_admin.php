          <!-- Personnel List  -->
          <div id="student-result-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Personnels</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Admin</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="staff.html">Personnel List</a></li>
                        </ul>
                    </div>
                </div>

      <!-- Staff List Table -->
<div id="master-listpersonnel">
    <div class="table-data">
        <div class="order">
            <div id="table-container">
                <table id="table-personnel">
                    <colgroup>
                        <col style="width: 5%;">
                        <col style="width: 20%;">
                        <col style="width: 15%;">
                        <col style="width: 15%;">
                        <col style="width: 30%;">
                        <col style="width: 15%;">
                        <col style="width: 15%;">
                        
                      
                    </colgroup>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> First Name</th>
                            <th>Email</th>
                           
                            <th>Created Date</th>
                            <th>Update Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody id="stafflist">
                    <?php
    // Counter for numbering the students
    $counter = 1;

        // Display all staff members in the table
        $staffMembers = getAllStaff();
        while ($row = $staffMembers->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $counter++; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
               
                <td><?php echo $row['created_date']; ?></td>
                <td>
                    <form method="post" action="">
                        <input type="hidden" name="staffId" value="<?php echo $row['id']; ?>">

                        <!-- Dropdown for updating status -->
                        <select name="newStatus">
                         
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>

                        <button type="submit" name="updateStatus">Update Status</button>
                    </form>
                </td>
                <td>
                    <!-- Form for deleting staff member -->
                    <form method="post" action="">
                        <input type="hidden" name="staffId" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="deleteStaff">Delete Staff</button>
                    </form>
                </td>
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
    $('#table-personnel').DataTable({
        "paging": true, // Enable pagination
        "ordering": true, // Enable sorting
        "order": [], // Initial order (disable sorting by default)
        "lengthMenu": [10, 25, 50, 70, 100], // Set custom page length options
        "pageLength": 25 // Default page length
    });
});

</script> 
          <!-- Personnel List  -->
          <div id="student-result-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Personnels</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Personnels</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="staff.html">Home</a></li>
                        </ul>
                    </div>
                </div>

      <!-- Staff List Table -->
<div id="master-listpersonnel">
    <div class="table-data">
        <div class="order">
            <div class="head">
                <h3>List of Personnels</h3>
                <div class="headfornaturetosort">
                        <label for="rangeInput"></label>
                        <input class="ForRange" type="text" id="rangeInput" name="rangeInput" placeholder="1-10" />
                        <button type="button" id="viewButton">
                            <i class='bx bx-filter'></i>
                        </button>
                    </div>
            </div>
            <div id="table-container">
                <table>
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
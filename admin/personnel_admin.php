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
          <!-- Personnel List  -->
          <div id="student-result-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Personnels</h1>
                        <ul class="breadcrumb" style="background-color:inherit">
                            <li><a href="#" style="text-decoration:none">Admin</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="staff.html" style="text-decoration:none">Personnel List</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Staff List Table -->
                <div id="master-listpersonnel">
                    <div class="table-data">
                        <div class="order">
                            <div id="table-container">
                                <table id="personnel">
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
                                        
                                            <option value="Pending">Pending</option>
                                            <option value="Activated">Activate</option>
                                            <option value="Rejected">Rejected</option>
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
            <script src="https://cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>
        <script>
    $(document).ready(function(){
        $('#personnel').DataTable({
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
    </main>
        <!-- MAIN -->

</section>
<?php include ('profile.php')?>
<?php include ('script.php')?>
<!-- CONTENT -->
<?php include("../template/footer.php")?>
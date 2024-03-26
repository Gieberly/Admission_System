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
        <div id="master-list-content">
            <div class="head-title">
                <div class="left">
                    <h1>Master List</h1>
                    <ul class="breadcrumb" style="background-color:inherit">
                        <li><a href="#" style="text-decoration:none">Admin</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="#master-list-content" style="text-decoration:none">Masterlist</a></li>
                    </ul>
                </div>
            </div>

            <!--master list-->
            <div id="master-list">
            <div class="table-data">
                <div class="order">
                    <div id="table-container">
                        <!-- Table for displaying student data -->
                        <table class="table table-border" id="masterlist">
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
                                        <td><?php echo $row['applicant_name']; ?></td>
                                        <td><?php echo $row['birthdate']; ?></td>
                                        <td><?php echo $row['age']; ?></td>
                                        <td><?php echo $row['academic_classification']; ?></td>
                                        <td><?php echo $row['degree_applied']; ?></td>
                                        <td><?php echo $row['nature_of_degree']; ?></td>
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
</main>
        <!-- MAIN -->

    </section>
<!--Scripts-->
<?php include ('profile.php')?>
<?php include ('script.php')?>
<script>
    $(document).ready(function(){
        $('#masterlist').DataTable({
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

<?php include("../template/footer.php")?>
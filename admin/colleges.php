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
            <div id="data-result-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Colleges</h1>
                        <ul class="breadcrumb" style="background-color:inherit">
                            <li><a href="#" style="text-decoration:none">Home</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="#" style="text-decoration:none">Colleges</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Staff List Table -->
                <div id="data-list">
                    <div class="table-data">
                        <div class="order">
                        <div class="head">
                        <div class="headfornaturetosort">
                                <label for="rangeInput"></label>
                                <input class="ForRange" type="text" id="rangeInput" name="rangeInput" placeholder="1-10" />
                            </div>
                        </div>

                        <!--ADDEDD TABS AND CONTENTS-->
                                <div class="tab-pane fade show active" id="dataListView">
                                    <div id="table-container">
                                    <table id="colleges">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>College</th>
                                                <th>Department</th>
                                                <th>Course</th>
                                                <th>Available slots</th>
                                                <th>Total Slots</th>
                                                <th>Dept Head</th>
                                            </tr>
                                        </thead>
                                        <tbody id="datalist">
                                            <?php
                                            // Counter for numbering the students
                                            $counter = 1;

                                            // Display all staff members in the table
                                            $dept = getAllDept();
                                            while ($row = $dept->fetch_assoc()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $counter++; ?></td>
                                                    <td><?php echo $row['college_name']; ?></td>
                                                    <td><?php echo $row['dept_name']; ?></td>
                                                    <td><?php echo $row['course']; ?></td>
                                                    <td><?php echo $row['slots']; ?></td>
                                                    <td><?php echo $row['used_slots']; ?></td>
                                                    <td><?php echo $row['dept_chair']; ?></td>
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
                </div>
            </div>
            </main>
        <!-- MAIN -->
</section>
<?php include ('profile.php')?>
<?php include ('script.php')?>
<!-- CONTENT -->
<?php include("../template/footer.php")?>

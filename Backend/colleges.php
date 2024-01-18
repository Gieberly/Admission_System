<?php

include 'config.php'
?>

    <div id="data-result-content">
        <div class="head-title">
            <div class="left">
                <h1>Colleges</h1>
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a class="active" href="#">Colleges</a></li>
                </ul>
            </div>
        </div>

        <!-- Staff List Table -->
        <div id="data-list">
            <div class="table-data">
                <div class="order">
                <div class="head">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="dataListViewTab" data-toggle="tab" href="#dataListView">Data List View</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="addTab" data-toggle="tab" href="#add">Add</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="editTab" data-toggle="tab" href="#edit">Edit</a>
                        </li>
                    </ul>
                </div>

                <!--ADDED TABS AND CONTENTS-->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="dataListView">
                        <div id="table-container">
                        <table>
                            <colgroup>
                                <col style="width: 5%;">
                                <col style="width: 25%;">
                                <col style="width: 25%;">
                                <col style="width: 15%;">
                                <col style="width: 5%;">
                                <col style="width: 5%;">
                                <col style="width: 25%;">
                            </colgroup>
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
                        <div class="tab-pane fade" id="add">
                            <!-- Content for Add tab -->
                            <!-- Add form or other content for the Add tab -->
                        </div>
                        <div class="tab-pane fade" id="edit">
                            <!-- Content for Edit tab -->
                            <!-- Edit form or other content for the Edit tab -->
                        </div>
                    </div>                  
                </div>
            </div>
        </div>
    </div>

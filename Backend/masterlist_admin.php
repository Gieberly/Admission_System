  <?php
  include("config.php");?>
  
  <!--Master List-->
            <div id="master-list-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Master List</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Master List</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="#top">Home</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Import & Export link -->
                <div class="col-md-12 head">
                    <div class="float-right">
                        <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Import</a>
                        <a href="exportData.php" class="btn btn-primary"><i class="exp"></i> Export</a>
                    </div>
                </div>
                <!--master list-->
                <div id="master-list">
                    <div class="table-data">
                        <div class="order">
                            <div class="head">
                                <div class="dropdown-nature">
                                <h3>List of Students</h3>
                                
                            </div>
                            </div>
                            <div id="table-container">
                            <table>
                                <colgroup>
                                    <col style="width: 5%;">
                                    <col style="width: 10%;">
                                    <col style="width: 15%;">
                                    <col style="width: 10%;">
                                    <col style="width: 20%;">
                                    <col style="width: 8%;">
                                    <col style="width: 8%;">
                                    <col style="width: 8%;">
                                    <col style="width: 8%;">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Application No.</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Course</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
    // Counter for numbering the students
    $counter = 1;

    // Loop through the results and populate the table rows
    while ($row = $studentFormData->fetch_assoc()) {
    ?>
        <tr>
            <td><?php echo $counter++; ?></td>
            <td><?php echo $row['app_number']; ?></td>
            <td><?php echo $row['fname']; ?></td>
            <td><?php echo $row['lname']; ?></td>
            <td><?php echo $row['course']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <!-- Add more columns as needed -->
        </tr>
        <?php
    }
    ?>                      </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>
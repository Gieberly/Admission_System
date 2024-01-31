<?php include("config.php");?>

<!--Master List-->
<div id="master-list-content">
    <div class="head-title">
        <div class="left">
            <h1>Master List</h1>
            <ul class="breadcrumb">
                <li><a href="#">Master List</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#top">List View</a></li>
            </ul>
            <ul class="breadcrumb">
                <li><a href="">Import</a></li>
                <li><a href="">Grid View</a></li>
                <li><a href=""><i class='bx bx-add-to-queue'></i>Add Course</a></li>
            </ul>
        </div>
    </div>

    <!--master list-->
    <div id="master-list">
        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>List of Students</h3>
                    <div class="headfornaturetosort">
                        <label for="rangeInput"></label>
                        <input class="ForRange" type="text" id="rangeInput" name="rangeInput" placeholder="1-10" />
                        <button type="button" id="viewButton">
                            <i class='bx bx-filter'></i>
                        </button>
                        <button type='button' id="addCourses" onclick='addCourse()'>
                            <i class='bx bx-add-to-queue'></i> Add Course
                        </button>
                    </div>
                </div>
                <div id="table-container">
                    <table>
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
                        <tbody>
                            <?php
                            // Counter for numbering the students
                            $counter = 1;

                            // Loop through the results and populate the table rows
                            while ($row = $studentFormData->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $counter++; ?></td>
                                    <td><?php echo $row['created_date']; ?></td>
                                    <td><?php echo $row['app_number']; ?></td>
                                    <td><?php echo $row['fname']; ?></td>
                                    <td><?php echo $row['lname']; ?></td>
                                    <td><?php echo $row['college']; ?></td>
                                    <td><?php echo $row['course']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
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

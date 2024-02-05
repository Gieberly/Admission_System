<?php include("config.php");?>

<!--Master List-->
<div id="master-list-content">
    <div class="head-title">
        <div class="left">
            <h1>Master List</h1>
            <ul class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#master-list-content">Masterlist</a></li>
            </ul>
        </div>
    </div>

    <!--master list-->
    <div id="master-list">
        <div class="table-data">
            <div class="order">
                <div class="head">
                    <div class="headfornaturetosort">
                        <input class="form-control mr-2" type="search" placeholder="1-10" aria-label="Search" />
                        <button type="button" id="viewButton">
                            <i class='bx bx-filter'></i>
                        </button>
                    </div>
                    <br>
                    <!-- Form with search input and college dropdown -->
                    <form class="d-flex">
                        <input class="form-control mr-2" type="search" placeholder="Enter student name" aria-label="Search">
                        <select name="college" class="form-control mr-4">
                            <option value="">Select College</option>
                            <?php
                            // Fetch colleges from the database
                            $query = "SELECT college_name FROM college";
                            $result = mysqli_query($conn, $query);

                            // Check if query was successful
                            if ($result) {
                                // Loop through results and create options for the dropdown
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['college_name'] . "'>" . $row['college_name'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <br>
                        <select name="course" class="form-control mr-4">
                            <option value="">Select Program</option>
                            <?php
                            // Fetch colleges from the database
                            $query = "SELECT course FROM courses";
                            $result = mysqli_query($conn, $query);

                            // Check if query was successful
                            if ($result) {
                                // Loop through results and create options for the dropdown
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['course'] . "'>" . $row['course'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <br>
                        <button class="btn btn-outline-success" type="submit">Submit</button>
                    </form>
                </div>
                <div id="table-container">
                    <!-- Table for displaying student data -->
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

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
                        <div class="headfornaturetosort">
                                <label for="rangeInput"></label>
                                <input class="ForRange" type="text" id="rangeInput" name="rangeInput" placeholder="1-10" />
                                <button type="button" id="viewButton">
                                    <i class='bx bx-filter'></i>
                                </button>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="dataListViewTab" data-toggle="tab" href="#dataListView">Data List View</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="addTab" data-toggle="tab" href="#add"><i class='bx bx-add-to-queue'></i>Add Course</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="editTab" data-toggle="tab" href="#edit">Edit</a>
                                </li>
                            </ul>
                        </div>

                        <!--ADDEDD TABS AND CONTENTS-->
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
                                        <div id="table-container">
                                        <div class= "form-row">
                                            <form>    
                                                <div class= "row">
                                                    <div class="form-group col-md-12">
                                                        <label for="course_name">Course Name</label>
                                                        <input type="email" class="form-control" id="course_name" placeholder="Bachelor of Science...">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                    <label for="inputState">College Name</label>
                                                    <select id="inputState" class="form-control">
                                                        <option selected>Choose...</option>
                                                        <option>...</option>
                                                    </select>
                                                    </div>
                                                </div>                                    
                                                

                                                <div class="form-group">
                                                    <label for="dept_name">Department Name</label>
                                                    <input type="email" class="form-control" id="dept_name" placeholder="Department of ...">
                                                </div>
                                                <div class="form-group">
                                                    <label for="dept_head">Department Head</label>
                                                    <input type="email" class="form-control" id="dept_head" placeholder="Dept Name">
                                                </div>
                                                </div>                                        
                                            </form>
                                            </div>
                                    </div>
                                    <div class="tab-pane fade" id="edit">
                                        <!-- Content for Edit tab -->
                                        <!-- Edit form or other content for the Edit tab -->
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-2">Add</button>
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

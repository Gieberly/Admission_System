<?php

include("config.php");
include("personnelcover.php");


// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'staff') {
    header("Location: loginpage.php");
    exit();
}

// Retrieve student data from the database
$query = "SELECT id, applicant_name,applicant_number, email, math_grade, science_grade, english_grade, gwa_grade, rank, result, nature_of_degree, degree_applied FROM admission_data";
$result = $conn->query($query);
// Fetch user information from the database based on user ID
$userID = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, email, userType, status FROM users WHERE id = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($name, $email, $userType, $status);
$stmt->fetch();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BSU OUR Admission Unit Personnel</title>
    <link rel="icon" href="assets/images/BSU Logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css//personnel.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
<section id="content">    
<main>

<div id="student-result-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Student Result</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Student Result</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="Personnel.html">Home</a></li>
                        </ul>
                    </div>
                </div>

                <div class="tabs">
                    <button class="tab-button" data-tab="tab1">NOA</button>
                    <button class="tab-button" data-tab="tab2">NOR</button>
                    <button class="button send" type="submit">Send</button> <button class="button save" type="submit">Save</button>
                </div>
  
                <div class="tab-content" id="tab1">
                    <!--result(NOA)-->
                    <div id="student-result-noa">
                            <div class="table-data">
                                <div class="order">
                                    <div class="head">
                                        <h3>Notice of Admission</h3>
                                    <div class="headfornaturetosort">
                                        <!--Drop Down for Nature of Degree--> 
                                           <select class="NatureDropdown" id="NatureofDegree" onchange="updateSelectionNOA(this)">
                                               <option value disabled selected>Select Nature of Degree</option>
                                               <option value="1">Non-Board</option>
                                               <option value="0">Board</option>
                                           </select>
                                          
                                           <!-- Dropdown for Non-Board Programs -->
                                           <select class="nonboardProgram" id="nonBoardNOA">
                                               <option value disabled selected>Non-Board Programs</option>
                                               <option value="BSIT">BSED</option>
                                               <option value="BLIS">LET</option>
                                           </select>
                       
                                           <!-- Dropdown for Board Programs -->
                                           <select class="boardProgram" id="BoardNOA">
                                               <option value disabled selected>Board Programs</option>
                                               <option value="BSIT">BSED</option>
                                               <option value="BLIS">LET</option>
                                           </select>
                                        
                                            <label for="rangeInput"></label>
                                                   <input class="ForRange" type="number" id="rangeInput" name="rangeInput" placeholder="1-10" min="1" onchange="validateRange()">
                                                   <i class='bx bx-sort'></i>
                                    </div>
                                    </div>
        
                                    <div id="table-container">
                                    <table>
                                        <colgroup>
                                            <col style="width: 9%;">
                                            <col style="width: 10%;">
                                            <col style="width: 21%;">
                                            <col style="width: 16%;">
                                            <col style="width: 6%;">
                                            <col style="width: 6%;">
                                            <col style="width: 6%;">
                                            <col style="width: 6%;">
                                            <col style="width: 6%;">
                                            <col style="width: 7%;">
                                            <col style="width: 7%;">
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th>Application No.</th>
                                                <th>Nature of Degree</th>
                                                <th>Program</th>
                                                <th>Name</th>
                                                <th>Math</th>
                                                <th>Science</th>
                                                <th>English</th>
                                                <th>GWA</th>
                                                <th>Rank</th>
                                                <th>Result</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>000001</td>
                                                <td>Non-Board</td>
                                                <td>Bachelor of Information Technology</td>
                                                <td>Toge Inumaki</td>
                                                <td>80%</td>
                                                <td>83%</td>
                                                <td>83%</td>
                                                <td>83%</td>
                                                <td>1</td>
                                                <td>NOA</td>
                                                <td>Accepted/Declined</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>     
          
        </main>
        <!-- MAIN -->
        <script>


 
 </script>

    </section>
    <script src="assets/js/personnels.js"></script>

            </body>
</html>
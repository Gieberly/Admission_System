<?php
// Include necessary files and start the session
include("config.php");
include("Personnel_Cover.php");

// Check if the user is a staff member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Staff') {
    header("Location: loginpage.php");
    exit();
}

// Fetch user information from the database based on user ID
$userID = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, email, userType, status FROM users WHERE id = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($name, $email, $userType, $status);
$stmt->fetch();

// Retrieve deleted student data from the backup table
$query = "SELECT id, applicant_name, applicant_number, academic_classification, email, math_grade, science_grade, english_grade, gwa_grade, rank, result, nature_of_degree, degree_applied 
          FROM deleted_admission_data";
$result = $conn->query($query);
?>

<html lang="en">
<head>
    <!-- Include necessary meta tags, CSS, and JavaScript libraries -->
    <!-- ... (previous code) -->
</head>
<body>
    <section id="content">
        <main>
            <div id="master-list-content">
                <div class="head-title">
                    <!-- ... (previous code) -->
                </div>

                <!-- Deleted records table -->
                <div id="master-list">
                    <div class="table-data">
                        <div class="order">
                            <div class="head">
                                <h3>Deleted Students</h3>
                            </div>
                            <div id="table-container">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Application No.</th>
                                            <th>Nature of Degree</th>
                                            <!-- ... (add other table headers as needed) -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            $count = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr data-id='{$row['id']}'>";
                                                echo "<td>{$count}</td>";
                                                echo "<td>{$row['applicant_number']}</td>";
                                                echo "<td>{$row['nature_of_degree']}</td>";
                                                // (add other table cells as needed)
                                                echo "<td>
                                                      <button type='button' class='button restore-btn' onclick='restoreRecord({$row['id']})'>Restore</button>
                                                      <button type='button' class='button permanently-delete-btn' onclick='permanentlyDeleteRecord({$row['id']})'>Permanently Delete</button>
                                                      </td>";
                                                echo "</tr>";
                                                $count++;
                                            }
                                        } else {
                                            echo "<tr><td colspan='5'>No deleted records found</td></tr>";
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
    </section>

    <script>
        // JavaScript functions for permanently deleting and restoring records
        function permanentlyDeleteRecord(id) {
            // Implement AJAX request to permanently delete the record from the deleted_admission_data table
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "permanently.deleteStudentPersonnel.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // Remove the deleted row from the table
                        var row = document.querySelector(`tr[data-id='${id}']`);
                        row.remove();

                        // Show a success toast or notification if needed
                        // ...

                        // Optional: Refresh the page or update the table dynamically
                        // location.reload();
                    } else {
                        // Handle errors from the server if needed
                        alert('Error permanently deleting the record. Please try again.');
                    }
                }
            };

            // Encode the data to be sent in the request
            var data = "id=" + encodeURIComponent(id);
            xhr.send(data);
        }

        function restoreRecord(id) {
            // Implement AJAX request to restore the record to the admission_data table
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "restoreStudentPersonnel.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // Remove the restored row from the table
                        var row = document.querySelector(`tr[data-id='${id}']`);
                        row.remove();

                        // Show a success toast or notification if needed
                        // ...

                        // Optional: Refresh the page or update the table dynamically
                        // location.reload();
                    } else {
                        // Handle errors from the server if needed
                        alert('Error restoring the record. Please try again.');
                    }
                }
            };

            // Encode the data to be sent in the request
            var data = "id=" + encodeURIComponent(id);
            xhr.send(data);
        }
    </script>
</body>
</html>

<!-- restore_staff.php -->

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restore Deleted Staff Members</title>
    <link rel="stylesheet" href="a.css" />
    <!-- Add any other stylesheets or scripts you need -->
</head>

<body>
    <h1>Restore Deleted Staff Members</h1>

    <?php
    include("config.php");

    // Fetch deleted staff members
    $query = "SELECT * FROM deleted_staff"; // Assuming you have a table to store deleted staff members
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>ID NO.</th>";
        echo "<th>Name</th>";
        echo "<th>Email</th>";
        echo "<th>Status</th>";
        echo "<th>Action</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td><a href='edit_deleted_staff.php?id=" . $row['id'] . "'>Edit Status</a></td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No deleted staff members found.";
    }

    $conn->close();
    ?>

    <!-- Add any other HTML content or scripts you need -->
</body>

</html>

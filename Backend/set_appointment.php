<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = $_POST['user_name'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    $sql = "INSERT INTO appointments (user_name, appointment_date, appointment_time) VALUES ('$user_name', '$appointment_date', '$appointment_time')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Appointment set successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Set Appointment</title>
</head>
<body>
    <h1>Set Appointment</h1>
    <form method="post" action="">
        <label for="user_name">User Name:</label>
        <input type="text" name="user_name" required><br>

        <label for="appointment_date">Appointment Date:</label>
        <input type="date" name="appointment_date" required><br>

        <label for="appointment_time">Appointment Time:</label>
        <select name="appointment_time" required>
            <option value="morning">Morning</option>
            <option value="afternoon">Afternoon</option>
        </select><br>

        <input type="submit" value="Set Appointment">
    </form>
</body>
</html>

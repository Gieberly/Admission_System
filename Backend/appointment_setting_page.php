<?php
include('config.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $selectedDate = $_POST['date'];
    $selectedAMSlot = $_POST['amSlot'];
    $selectedPMSlot = $_POST['pmSlot'];

    // Validate the selected date and slots against the available slots in the database
    $availabilityCheck = $conn->prepare("SELECT * FROM Appointments WHERE Date = ? AND AMSlot = ? AND PMSlot = ?");
    $availabilityCheck->bind_param("sss", $selectedDate, $selectedAMSlot, $selectedPMSlot);
    $availabilityCheck->execute();
    $result = $availabilityCheck->get_result();

    if ($result->num_rows > 0) {
        // Valid appointment, update the student's data in the admission_data table
        $updateAppointment = $conn->prepare("UPDATE admission_data SET appointmentDate = ? WHERE email = ?");
        $updateAppointment->bind_param("ss", $selectedDate, $email);

        if ($updateAppointment->execute()) {
            echo "Appointment date set successfully!";
        } else {
            echo "Error updating appointment date: " . $conn->error;
        }
    } else {
        echo "Invalid appointment. Please choose an available slot.";
    }

    $availabilityCheck->close();
    $updateAppointment->close();
}

// Retrieve existing slots from the database
$sql = "SELECT DISTINCT Date FROM Appointments";
$result = $conn->query($sql);

$availableDates = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $availableDates[] = $row['Date'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Your Appointment Date</title>

    <!-- Include FullCalendar and jQuery -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }

        h2 {
            text-align: center;
        }

        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }

        #appointmentForm {
            margin-top: 20px;
            background-color: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2>Set Your Appointment Date</h2>

<!-- FullCalendar container -->
<div id='calendar'></div>

<!-- Form to set slots -->
<form id="appointmentForm" method="post" action="">
    <label for="selectedDate">Select Date:</label>
    <select id="selectedDate" name="date" required>
        <option value="">Select Date</option>
        <?php
        foreach ($availableDates as $date) {
            echo "<option value=\"$date\">$date</option>";
        }
        ?>
    </select>

    <!-- Include AM and PM slots dropdowns or input fields as needed -->
    <!-- For simplicity, using input fields here -->
    <label for="amSlot">Morning Slot:</label>
    <input type="text" name="amSlot" required>

    <label for="pmSlot">Afternoon Slot:</label>
    <input type="text" name="pmSlot" required>

    <input type="submit" value="Set Appointment">
</form>

<script>
$(document).ready(function() {
    // Initialize FullCalendar
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        selectable: true,
        select: function(start) {
            // Show the form on date selection
            $('#selectedDate').val(moment(start).format('YYYY-MM-DD'));
            $('#appointmentForm').show();
        }
        // You can add more FullCalendar options or customize it as needed
    });
});
</script>

</body>
</html>

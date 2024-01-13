<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Appointment Date</title>

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

        #selectedDateDisplay {
            text-align: center;
            margin-top: 20px;
        }

        #timeSelection {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<?php
// Include the configuration file
include('config.php');

// Retrieve available slots from the database
$sql = "SELECT * FROM Appointments";
$result = $conn->query($sql);

$events = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = array(
            'title' => 'AM: ' . $row['AMSlot'] . ' | PM: ' . $row['PMSlot'],
            'start' => $row['Date'],
            'allDay' => true,
        );
    }
}
?>

<h2>Set Appointment Date</h2>

<!-- FullCalendar container -->
<div id='calendar'></div>

<!-- Selected Date Display -->
<div id="selectedDateDisplay"></div>

<!-- Time Selection -->
<div id="timeSelection"></div>

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
            // Display selected date
            $('#selectedDateDisplay').html('Selected Date: ' + moment(start).format('YYYY-MM-DD'));

            // Display time selection options
            $('#timeSelection').html(
                '<label for="timeSlot">Select Time Slot:</label>' +
                '<select id="timeSlot" name="timeSlot">' +
                '<option value="AM">Morning</option>' +
                '<option value="PM">Afternoon</option>' +
                '</select>' +
                '<button onclick="submitAppointment()">Submit</button>'
            );
        },
        events: <?php echo json_encode($events); ?>
    });
});

function submitAppointment() {
    var selectedDate = $('#selectedDateDisplay').text().split(':')[1].trim();
    var selectedTime = $('#timeSlot').val();

    // Redirect to a page where you can handle the appointment submission
    window.location.href = 'SubmitAppointment.php?date=' + selectedDate + '&time=' + selectedTime;
}
</script>

</body>
</html>

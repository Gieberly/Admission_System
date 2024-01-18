
<?php
// Include the configuration file
include('config.php');
include("personnelcover.php");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $date = $_POST['date'];
    $amSlot = $_POST['amSlot'];
    $pmSlot = $_POST['pmSlot'];

    // Insert data into the database
    $sql = "INSERT INTO Appointments (Date, AMSlot, PMSlot) VALUES ('$date', '$amSlot', '$pmSlot')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Appointment date set successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Retrieve existing slots from the database
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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Appointment Date</title>

    <!-- Include FullCalendar and jQuery -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    </head>
    <style>
    h2 {
        text-align: center;
    }

    #calendar {
        max-width: 600px; /* Adjust the maximum width as needed */
        margin: 0 auto;
    }

    #slotForm {
        display: none;
        margin-top: 20px;
        background-color: #f5f5f5;
        padding: 15px;
        border-radius: 5px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input {
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
    <section id="content">
        <main>


<h2>Set Appointment Date</h2>

<!-- Form to set slots -->
<form id="slotForm" method="post" action="">
    <label for="selectedDate">Selected Date:</label>
    <input type="text" id="selectedDate" name="date" readonly required>

    <label for="amSlot">Morning Slot:</label>
    <input type="number" name="amSlot" required>

    <label for="pmSlot">Afternoon Slot:</label>
    <input type="number" name="pmSlot" required>

    <input type="submit" value="Set Appointment">
</form>

<!-- FullCalendar container -->
<div id='calendar'></div>

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
            $('#slotForm').show();
        },
        events: <?php echo json_encode($events); ?>
    });
});
</script>
</main>
        <!-- MAIN -->


    </section>
</body>
</html>

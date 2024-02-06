<?php
// Include the configuration file
include('config.php');
include('personnelCover.php');


// Cleanup: Remove data for past dates in appointmentdate table
$currentDate = date('Y-m-d');
$cleanupSql = "DELETE FROM appointmentdate WHERE appointment_date < ?";
$stmtCleanup = $conn->prepare($cleanupSql);
$stmtCleanup->bind_param("s", $currentDate);
$stmtCleanup->execute();
$stmtCleanup->close();

// Retrieve existing slots from the database for future dates only
$sql = "SELECT * FROM appointmentdate WHERE appointment_date >= CURDATE()";
$result = $conn->query($sql);

$events = array();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $date = $_POST['appointment_date'];
    $times = $_POST['appointment_times']; // It's an array now
    $availableSlots = $_POST['available_slots'];

    // Insert data into the database for each selected time
    foreach ($times as $time) {
        $startDateTime = $date . ' ' . $time;
        $sql = "INSERT INTO appointmentdate (appointment_date, appointment_time, available_slots) VALUES ('$date', '$time', '$availableSlots')";
        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
            exit;
        }
    }

    echo "Appointment date set successfully!";
}

// Retrieve existing slots from the database
$sql = "SELECT * FROM appointmentdate";
$result = $conn->query($sql);

$events = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $startDateTime = $row['appointment_date'] . ' ' . $row['appointment_time'];
        $events[] = array(
            'title' => 'Slots:' . $row['available_slots'],
            'start' => $startDateTime,
            'end' => $startDateTime, // Assuming the event duration is one hour, adjust as needed
            'color' => '#4fbadd', // Set your desired light blue color here

        );
    }
}
?>


<!-- ... Rest of the HTML and JavaScript code remains unchanged ... -->
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
</head>

<style>
    h2 {
        text-align: center;
    }

    #calendar {
        max-width: 600px;
        margin: 0 auto;
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

    #slotForm {
        display: none;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 15px;
        border-radius: 5px;
        border: 2px solid #000;
        width: 40%;
        background-color: #F9F9F9;
        z-index: 2;
    }

    .calendar-background {
        position: relative;
        border: 2px solid #000;
        width: 100%;
        border-radius: 5px;
        background-color: #F9F9F9;
        z-index: 1;
    }

    #hideFormButton {
        position: fixed;
        top: 10px;
        right: 10px;
    }

    #hideFormButton i {
        color: red;
        transition: color 0.3s ease;
    }

    #hideFormButton:hover i {
        color: blue;
    }

    .bx-x {
        font-size: 12px;
        /* Adjust the font size as needed */
        color: red;
        cursor: pointer;
        right: 3px;
        position: fixed;
    }
    .has-events {
    background-color: #4CAF50; /* Set your desired background color here */
    color: white; /* Set the text color if needed */
}

</style>

<body>
    <section id="content">
        <main>
            <div id="setslot-backgroud">


                <!-- Form to set slots -->
                <form id="slotForm" method="post" action="" style="display: none;">
                    <button type="button" id="hideFormButton" onclick="toggleFormVisibility()" style="background: none; border: none; color: blue; text-decoration: underline; cursor: pointer;">
                        <i class='bx bx-x'></i>
                    </button>
                    <label for="selectedDate">Selected Date:</label>
                    <input type="date" id="selectedDate" name="appointment_date" required>

                    <div id="timeSlotsContainer">
                        <label for="selectedTimes">Selected Times:</label>
                        <div class="timeSlot">
                            <input type="time" class="selectedTime" name="appointment_times[]" required>
                        </div>
                    </div>

                    <button type="button" onclick="addTimeSlot()">Add Time</button>

                    <label for="availableSlots">Available Slots:</label>
                    <input type="number" id="availableSlots" name="available_slots" required>

                    <input type="submit" value="Set Appointment">
                </form>
            </div>
            <div class="calendar-background">
                <br>
                <h2>Set Appointment Date</h2>

                <!-- FullCalendar container -->
                <div id='calendar'></div>
            </div>
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
        events: <?php echo json_encode($events); ?>,
        eventRender: function(event, element) {
            // Format the time using moment.js
            element.find('.fc-time').html(moment(event.start).format('h:mm a'));
        },
        eventAfterAllRender: function(view) {
            // Customize the rendering of day cells with events
            $('.fc-day').each(function() {
                var date = $(this).data('date');
                if (hasEventsForDate(date)) {
                    $(this).addClass('has-events');
                }
            });
        },
    });
});

function hasEventsForDate(date) {
    // Check if there are events for the specified date
    var events = <?php echo json_encode($events); ?>;
    for (var i = 0; i < events.length; i++) {
        if (moment(events[i].start).format('YYYY-MM-DD') === date) {
            return true;
        }
    }
    return false;
}


                function toggleFormVisibility() {
                    var form = document.getElementById('slotForm');
                    form.style.display = form.style.display === 'none' ? 'block' : 'none';
                }

                function addTimeSlot() {
                    var timeSlotContainer = document.getElementById('timeSlotsContainer');
                    var newTimeSlot = document.createElement('div');
                    newTimeSlot.innerHTML = '<i class=\'bx bx-x\' onclick="removeTimeSlot(this)"></i>' + '<input type="time" class="selectedTime" name="appointment_times[]" required>';
                    timeSlotContainer.appendChild(newTimeSlot);
                }

                function removeTimeSlot(element) {
                    var timeSlotContainer = document.getElementById('timeSlotsContainer');
                    timeSlotContainer.removeChild(element.parentNode);
                }
            </script>
        </main>
    </section>
</body>

</html>
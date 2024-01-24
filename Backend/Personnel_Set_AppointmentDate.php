<?php
// Include the configuration file
include('config.php');
include('personnelCover.php');

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
        /* Set position to absolute */
        top: 50%;
        /* Center vertically */
        left: 50%;
        /* Center horizontally */
        transform: translate(-50%, -50%);
        /* Center the form precisely */
        padding: 15px;
        border-radius: 5px;
        border: 2px solid #000;
        width: 40%;
        background-color: #F9F9F9;
        z-index: 2;
        /* Set a higher z-index value */
    }

    .calendar-background {
        position: relative;
        /* Set position to relative */
        border: 2px solid #000;
        /* You can customize the border properties as needed */
        /* Additional styling if desired */
        width: 100%;
        /* Set the width as per your design */
        border-radius: 5px;
        background-color: #F9F9F9;
        z-index: 1;
        /* Set a lower z-index value */
    }
     #hideFormButton {
        position: fixed;
        top: 10px; /* Adjust the top position as needed */
        right: 10px; /* Adjust the right position as needed */

    }
    #hideFormButton i {
        color: red;
        transition: color 0.3s ease; /* Add a smooth transition effect */
    }

    #hideFormButton:hover i {
        color: blue; /* Change the color on hover */
    }
</style>

</head>

<body>
    <section id="content">
        <main>
            <div id="setslot-backgroud">
                <!-- Button to toggle form visibility -->


                <!-- Form to set slots -->
              
<form id="slotForm" method="post" action="">
    <button id="hideFormButton" onclick="toggleFormVisibility()" style="background: none; border: none; color: blue; text-decoration: underline; cursor: pointer;">
        <i class='bx bx-x' style=" "></i>
    </button>
    <label for="selectedDate">Selected Date:</label>
    <input type="text" id="selectedDate" name="date" readonly required>

    <label for="time">Time:</label>
    <input type="text" name="time" required>

    <label for="slots">Slots:</label>
    <input type="text" name="slots" required>

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
                        events: <?php echo json_encode($events); ?>
                    });
                });

                function toggleFormVisibility() {
                    var form = document.getElementById('slotForm');
                    form.style.display = form.style.display === 'none' ? 'block' : 'none';
                }
            </script>
        </main>
        <!-- MAIN -->


    </section>
</body>

</html>
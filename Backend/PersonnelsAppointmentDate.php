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

    // Check if the time slots already exist in the database
    $conflictingSlots = array();
    foreach ($times as $time) {
        $sql = "SELECT COUNT(*) as count FROM appointmentdate WHERE appointment_date = '$date' AND appointment_time = '$time'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if ($row['count'] > 0) {
            // This time slot is already taken
            $conflictingSlots[] = $time;
        } else {
            // Insert data into the database
            $sql = "INSERT INTO appointmentdate (appointment_date, appointment_time, available_slots) VALUES ('$date', '$time', '$availableSlots')";
            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
                exit;
            }
        }
    }

    if (!empty($conflictingSlots)) {
        // Display a popup message for conflicting slots
        $conflictingTimes = implode(", ", $conflictingSlots);
        echo "<script>
                // Create a message element
                var messageElement = document.createElement('div');
                messageElement.textContent = 'The following time slots are already taken: $conflictingTimes. Please choose another time.';
                messageElement.classList.add('popup-message');

                // Append the message element to the document body
                document.body.appendChild(messageElement);

                // Remove the message element after 2 seconds
                setTimeout(function() {
                    messageElement.remove();
                }, 2000);
             </script>";
    } else {
        echo "<script>
                // Display a success message
                var successMessage = document.createElement('div');
                successMessage.textContent = 'Appointment date set successfully!';
                successMessage.classList.add('popup-message', 'success');

                // Append the success message to the document body
                document.body.appendChild(successMessage);

                // Remove the success message after 2 seconds
                setTimeout(function() {
                    successMessage.remove();
                }, 2000);
             </script>";
    }
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
.popup-message {
        position: fixed;
        top: 900%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #4CAF50; /* Green color */
        color: white;
        padding: 15px;
        border-radius: 5px;
        z-index: 9999;
    }

    .success {
        background-color: #4CAF50; /* Green color */
    }
    .edit-delete {
        position: absolute;
        top: 0;
        right: 0;
        background-color: #f9f9f9;
        padding: 5px 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        z-index: 1100;
    }

    .edit-delete a {
        color: #333;
        text-decoration: none;
        margin-right: 10px;
    }

    .edit-delete a:hover {
        color: #007bff;
        text-decoration: underline;
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
            // Add a span for edit/delete options initially hidden
            element.append('<span class="edit-delete" style="display: none;"><a href="#" class="edit-link">Edit</a> | <a href="#" class="delete-link">Delete</a></span>');
            // Add click event to toggle edit/delete options
            element.click(function() {
                var editDelete = $(this).find('.edit-delete');
                if (editDelete.is(':visible')) {
                    editDelete.hide(); // Hide if currently visible
                } else {
                    $('.edit-delete').hide(); // Hide all edit/delete spans
                    editDelete.show(); // Show for clicked event
                }
            });
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

  
// Handle edit action
$(document).on('click', '.edit-link', function(e) {
    e.stopPropagation(); // Prevent click event from bubbling up
    var eventId = $(this).closest('.fc-event').data('id');
    editAppointment(eventId);
});

// Handle delete action
$(document).on('click', '.delete-link', function(e) {
    e.stopPropagation(); // Prevent click event from bubbling up
    var eventId = $(this).closest('.fc-event').data('id');
    deleteAppointment(eventId);
});

function editAppointment(eventId) {
    // Handle edit action
    // You can implement your logic here, e.g., open a modal with editable fields
    alert('Edit appointment with ID: ' + eventId);
}

function deleteAppointment(eventId) {
    // Handle delete action
    // You can implement your logic here, e.g., confirm deletion and send AJAX request
    if (confirm('Are you sure you want to delete this appointment?')) {
        // Send AJAX request to delete appointment with eventId
        $.ajax({
            url: 'delete_appointment.php',
            type: 'POST',
            data: { eventId: eventId },
            success: function(response) {
                // Handle success response
                alert('Appointment deleted successfully!');
                // Reload the calendar or remove the deleted event from the calendar
            },
            error: function(xhr, status, error) {
                // Handle error
                alert('Error deleting appointment: ' + error);
            }
        });
    }
}
            </script>
        </main>
    </section>
</body>

</html>
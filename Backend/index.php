<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        .calendar {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .month {
            flex-basis: 30%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .available {
            background-color: #aaffaa; /* Light green for available dates */
            cursor: pointer;
        }

        .slot {
            display: none;
            margin-top: 10px;
        }

        .time-selection {
            margin-top: 10px;
        }

        .set-button {
            margin-top: 10px;
        }

        .form-group {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Available Dates</h1>
    <div class="calendar">
        <?php
        include 'config.php';

        // Function to update database slots
        function updateDatabaseSlots($conn, $month, $day, $time) {
            // Assuming your table structure has columns 'Date', 'AMSlot', and 'PMSlot'
            $formattedDate = date("Y-m-d", strtotime("$month $day"));
            $columnName = ($time == 'AM') ? 'AMSlot' : 'PMSlot';

            // Update the database record
            $sql = "UPDATE appointments SET $columnName = $columnName - 1 WHERE Date = '$formattedDate'";
            $conn->query($sql);
        }

        // Perform query
        $sql = "SELECT * FROM appointments";
        $result = $conn->query($sql);

        // Check for errors
        if (!$result) {
            die("Error: " . $conn->error);
        }

        // Organize appointments by month and day
        $calendarData = array();
        while ($row = $result->fetch_assoc()) {
            $date = new DateTime($row['Date']);
            $month = $date->format('F'); // Full month name
            $dayOfMonth = $date->format('j');

            $calendarData[$month][$dayOfMonth] = array('AM' => $row['AMSlot'], 'PM' => $row['PMSlot']);
        }

        // Display the calendar
        foreach ($calendarData as $month => $days) {
            echo "<div class='month'>";
            echo "<h2>$month</h2>";
            echo "<table>";
            echo "<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>";

            $firstDayOfMonth = date('w', strtotime("1 $month")); // Get the day of the week for the first day of the month

            echo "<tr>";

            // Output empty cells for days before the first day of the month
            for ($i = 0; $i < $firstDayOfMonth; $i++) {
                echo "<td></td>";
            }

            // Output days with slots
            for ($day = 1; $day <= 31; $day++) {
                echo "<td";

                // Check if the date is available
                if (isset($days[$day])) {
                    echo " class='available' onclick='toggleSlots(this)' data-am='" . $days[$day]['AM'] . "' data-pm='" . $days[$day]['PM'] . "'";
                    echo ">";
                    echo "<strong>$day</strong>";
                } else {
                    echo ">";
                    echo $day;
                }

                echo "</td>";

                if (($firstDayOfMonth + $day) % 7 == 0) {
                    echo "</tr><tr>";
                }
            }

            echo "</tr>";
            echo "</table>";

            // Output slots for each day
            foreach ($days as $dayOfMonth => $slots) {
                echo "<div class='slot' id='slots_$month$dayOfMonth'>";
                echo "<p><strong>Slots Available</strong></p>";
                echo "<p><strong>$month $dayOfMonth</strong></p>";
                echo "<p>AM: " . $slots['AM'] . "</p>";
                echo "<p>PM: " . $slots['PM'] . "</p>";
                echo "<div class='time-selection'>";
                echo "<label for='am_radio_$month$dayOfMonth'>AM</label>";
                echo "<input type='radio' name='time_$month$dayOfMonth' id='am_radio_$month$dayOfMonth' value='AM'>";
                echo "<label for='pm_radio_$month$dayOfMonth'>PM</label>";
                echo "<input type='radio' name='time_$month$dayOfMonth' id='pm_radio_$month$dayOfMonth' value='PM'>";
                echo "</div>";
                echo "<button class='set-button' onclick='setAppointment(\"$month\", $dayOfMonth)'>Set</button>";
                echo "</div>";
            }

            echo "</div>";
        }

        // Close connection
        $conn->close();
        ?>

        <div class="form-group">
            <label class="small-label" for="appointment-date">Appointment Date</label>
            <input type="date" name="appointment-date" class="input" id="appointment-date" required>
        </div>

        <div class="form-group">
            <label class="small-label" for="appointment-time">Appointment Time</label>
            <input type="text" name="appointment-time" class="input" id="appointment-time" placeholder="" required>
        </div>

        <script>
            function toggleSlots(element) {
                // Hide all slots
                var slots = document.querySelectorAll('.slot');
                slots.forEach(function (slot) {
                    slot.style.display = 'none';
                });

                // Show slots for the clicked date
                var date = element.textContent;
                var month = element.closest('.month').querySelector('h2').textContent;
                var slotsId = 'slots_' + month + date;
                var slotsToShow = document.getElementById(slotsId);
                if (slotsToShow) {
                    slotsToShow.style.display = 'block';
                }
            }
            function setAppointment(month, day) {
    var radios = document.querySelectorAll('input[name="time_' + month + day + '"]');
    var selectedTime = '';
    radios.forEach(function (radio) {
        if (radio.checked) {
            selectedTime = radio.value;
        }
    });

    if (selectedTime) {
        // Update the database slots
        updateDatabaseSlots(month, day, selectedTime);

        // Set the appointment date and time in the form
        var formattedDate = new Date().getFullYear() + "-" + ('0' + (new Date(month + " " + day).getMonth() + 1)).slice(-2) + "-" + ('0' + day).slice(-2);
        document.getElementById("appointment-date").value = formattedDate;
        document.getElementById("appointment-time").value = selectedTime;

        // Hide the slot information
        var slotsId = 'slots_' + month + day;
        var slotsElement = document.getElementById(slotsId);
        if (slotsElement) {
            slotsElement.style.display = 'none';
        }

        alert("Appointment set for " + month + " " + day + " at " + selectedTime);
        // You can perform additional actions here if needed.
    } else {
        alert("Please select a time before setting the appointment.");
    }
}



            function updateDatabaseSlots(month, day, time) {
                // Assuming your backend endpoint to handle database updates
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "update_Appointmentslots.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Handle the response if needed
                        console.log(xhr.responseText);
                    }
                };
                xhr.send("month=" + encodeURIComponent(month) + "&day=" + encodeURIComponent(day) + "&time=" + encodeURIComponent(time));
            }
        </script>
    </div>
</body>
</html>

<?php
include("config.php");

if(isset($_GET['appointment_id'])) {
    $id = $_GET['appointment_id'];

    // Fetch data only if ID is set
    $query1 = mysqli_query($conn, "SELECT * FROM appointmentdate WHERE appointment_id = '$id'");
    if(mysqli_num_rows($query1) > 0) {
        $query2 = mysqli_fetch_array($query1);

        // Check if 'available_slots' exists in $query2
        if(isset($query2['available_slots'])) {
            $date = $query2['appointment_date'];
            $time = $query2['appointment_time'];
            $slots = $query2['available_slots']; // Use correct column name here
        } else {
            // Handle case where 'available_slots' key is not present
            echo "No 'available_slots' found for ID: $id";
            exit; // Stop further execution
        }
    } else {
        // Handle case where no data is found for the given ID
        echo "No appointment found for ID: $id";
        exit; // Stop further execution
    }

    if(isset($_POST['update'])) {
        $date = $_POST['appointment_date'];
        $time = $_POST['appointment_time'];
        $slots = $_POST['appointment_slots'];
        $section= $_POST['update'];
        $query3 = mysqli_query($conn, "UPDATE appointmentdate SET appointment_date='$date', appointment_time='$time', available_slots='$slots' where appointment_id='$id'"); // Use correct column name here
        if($query3) {
            header("location: ../Backend/admin.php". '#'. $section);
            exit();
        }
    }
?>


<form action="" method="post">
  <div class="form-group">
    <label for="date">Date </label>
    <input type="date" class="form-control" id="date" name="appointment_date" aria-describedby="emailHelp" placeholder="Enter Date" value="<?php echo $date; ?>">
  </div>
  <div class="form-group">
    <label for="time">Time </label>
    <input type="time" class="form-control" id="time" name="appointment_time" aria-describedby="emailHelp" placeholder="Enter Time" value="<?php echo $time; ?>">
  </div>
  <div class="form-group">
    <label for="slots">Slots </label>
    <input type="text" class="form-control" id="slots" name="appointment_slots" aria-describedby="emailHelp" placeholder="Enter Slots" value="<?php echo $slots; ?>">
  </div>
  <small id="emailHelp" class="form-text text-muted">Please change the Application Settings with caution to avoid problems.</small>
  <button type="submit" class="btn btn-primary" name="update" value="schedule-result-content">Update</button>
</form>
<?php
}
?>

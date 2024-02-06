<?php
include('config.php');

if (isset($_GET['selectedDate'])) {
  $selectedDate = $_GET['selectedDate'];
  
  // Query to fetch appointments for the selected date
  $sql = "SELECT * FROM admission_data WHERE appointment_date = '$selectedDate' ORDER BY appointment_time ASC";
  $result = $conn->query($sql);

  // Output table rows based on the result
  if ($result->num_rows > 0) {
    $counter = 1;
    while ($row = $result->fetch_assoc()) {
      // Format date and time
      $formattedDate = date("M-d-Y", strtotime($row["appointment_date"]));
      $formattedTime = date("g:i A", strtotime($row["appointment_time"]));

      echo "<tr data-id='{$row['id']}'>";
      echo "<td>{$counter}</td>";
      echo "<td>" . $row["applicant_number"] . "</td>";
      echo "<td>" . $row["nature_of_degree"] . "</td>";
      echo "<td>" . $row["degree_applied"] . "</td>";
      echo "<td>" . $row["applicant_name"] . "</td>";

      echo "<td class='editable' data-field='academic_classification'>
          <span class='edit-mode'>{$row['academic_classification']}</span>
          <select class='select-mode' style='display:none;' id='academicClassificationSelect'>";
      while ($classification = $resultClassification->fetch_assoc()) {
          $selected = ($row['academic_classification'] == $classification['Classification']) ? "selected" : "";
          echo "<option value='{$classification['Classification']}' $selected>{$classification['Classification']}</option>";
      }
      echo "</select></td>";

      echo "<td>" . $formattedDate . "</td>";
      echo "<td>" . $formattedTime . "</td>";
      echo "<td data-field='appointment_status'>{$row['appointment_status']}</td>";

      echo "<td>
          <button type='button' class='button ekis-btn' onclick='updateStatus({$row['id']}, \"Declined\")'><i class='bx bxs-x-circle'></i></button>
          <button type='button' class='button check-btn' onclick='updateStatus({$row['id']}, \"Accepted\")'><i class='bx bxs-check-circle'></i></button>
          <button type='button' class='button edit-btn' onclick='editAdmissionData({$row['id']})'><i class='bx bx-edit-alt'></i></button>
      </td>";

      echo "<td style='display: none;'><input type='checkbox' name='select[]' value='" . $row["id"] . "'></td>";
      echo "</tr>";

      $counter++;
    }
  } else {
    echo "<tr><td colspan='13'>No records found for the selected date</td></tr>";
  }

  // Close the database connection
  $conn->close();
}
?>

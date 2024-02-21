<?php


include("config.php");

$sql = "SELECT * FROM appointmentdate";
$query = mysqli_query($conn,$sql);
$count_all_rows = mysqli_num_rows($query);

if(isset($_POST['search']['value']))
{
    $search_value = $_POST['search']['value'];
    $sql .= "WHERE appointment_id like '%" .$search_value."%' ";
    $sql .= "WHERE appointment_date like '%" .$search_value."%' ";
    $sql .= "WHERE appointment_time like '%" .$search_value."%' ";
    $sql .= "WHERE available_slots like '%" .$search_value."%' ";
}

if(isset($_POST['order']))
{
    $column = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $sql .= "ORDER BY '".$column."' ".$order;
}
else
{
    $sql .="ORDER BY appointment_id ASC";
}

if($_POST['length'] != -1)
{
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= "LIMIT ".$start.", ".$length;
}

$data = array();

$run_query = mysqli_query($conn, $sql);
$filtered_rows = mysqli_num_rows($run_query);
while($row = mysqli_fetch_assoc($run_query))
{
    $subarray = array();
    $subarray[] = $row['appointment_id'];
    $subarray[] = $row['appointment_date'];
    $subarray[] = $row['appointment_time'];
    $subarray[] = $row['available_slots'];
    $subarray[] = '<a href ="javascript:void();" class="btn btn-sm btn-info>Edit</a>
    <a href ="javascript:void();" class="btn btn-sm btn-danger>Delete</a>';
    $data[] = $subarray;

}

$output = array(
    'data'=> $data,
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $count_all_rows,
    'recordsFiltered'=>$filtered_rows,
);

echo json_encode($output);
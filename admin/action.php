<?php
include('function.php');
$emp = new Employee();
$action = isset($_POST['action']) &amp;&amp; $_POST['action'] != '' ? $_POST['action'] : '';
switch ($action) {
  case "listEmployee":
    $emp-&gt;employeeList();
    break;
  case "addEmployee":
    $emp-&gt;addEmployee();
    break;
  case "getEmployee":
    $emp-&gt;getEmployee();
    break;
  case "updateEmployee":
    $emp-&gt;updateEmployee();
    break;
  case "empDelete":
    $emp-&gt;deleteEmployee();
    break;
  default:
    echo "Action found!";
  }
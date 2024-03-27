<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sample Table</title>
<style>
    /* CSS for styling the table */
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
</style>
</head>
<body>

<table>
  <thead>
    <tr>
      <th colspan="3">Full Name</th>
      <th></th>
      <th></th>
    </tr>
    <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Middle Name</th>
      <th>Age</th>
      <th>Country</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>John</td>
      <td>Doe</td>
      <td></td>
      <td>30</td>
      <td>USA</td>
    </tr>
    <tr>
      <td>Jane</td>
      <td>Smith</td>
      <td></td>
      <td>25</td>
      <td>UK</td>
    </tr>
    <tr>
      <td>Alice</td>
      <td>Johnson</td>
      <td></td>
      <td>35</td>
      <td>Canada</td>
    </tr>
  </tbody>
</table>

</body>
</html>

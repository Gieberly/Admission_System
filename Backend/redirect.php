<?php

// Function to insert data into a specified table
function insertDataIntoTable($tableName, $data) {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "bsu_admission_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Initialize arrays to store escaped keys and values
    $escapedKeys = [];
    $escapedValues = [];

    // Escape keys and values
    foreach ($data as $key => $value) {
        $escapedKeys[] = $conn->real_escape_string($key);
        $escapedValues[] = "'" . $conn->real_escape_string($value) . "'";
    }

    // Implode escaped keys and values
    $keys = implode(", ", $escapedKeys);
    $values = implode(", ", $escapedValues);

    // SQL query to insert data into the table
    $sql = "INSERT INTO $tableName ($keys) VALUES ($values)";

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully into table '$tableName'";
    } else {
        echo "Error inserting data into table: " . $conn->error;
    }

    // Close connection
    $conn->close();
}


?>

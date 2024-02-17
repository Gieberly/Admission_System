<?php

// Function to add a table to the database with pre-determined columns
function addTableToDatabase($tableName, $columns) {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "inline_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to create the table
    $sql = "CREATE TABLE $tableName (";
    foreach ($columns as $column) {
        $sql .= "$column, ";
    }
    $sql = rtrim($sql, ", "); // Remove trailing comma and space
    $sql .= ")";

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        echo "Table '$tableName' created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // Close connection
    $conn->close();
}

?>

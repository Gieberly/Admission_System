<?php
// fetchUserData.php

include("config.php");

if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];

    // Replace the following code with your actual query to fetch user data
    $query = "SELECT * FROM admission_data WHERE id = $userId";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();

        // Return the user data as JSON
        echo json_encode($userData);
    } else {
        echo json_encode(['error' => 'User not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}



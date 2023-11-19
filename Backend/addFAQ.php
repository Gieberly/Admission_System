<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question = $_POST["question"];
    $answer = $_POST["answer"];

    // You may add additional validation here

    // Insert the new FAQ into the database
    $sql = "INSERT INTO faq (question, answer) VALUES ('$question', '$answer')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: faq.php"); // Redirect back to the FAQ.php page after adding the FAQ
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

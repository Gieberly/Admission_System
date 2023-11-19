<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $faqID = $_POST["faqID"];
    $question = $_POST["question"];
    $answer = $_POST["answer"];

    // You may add additional validation here

    // Update the FAQ information in the database
    $sql = "UPDATE faq SET question = '$question', answer = '$answer' WHERE faq_id = $faqID";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: faq.php"); // Redirect back to the FAQ.php page after updating the FAQ
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

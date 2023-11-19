<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["faqID"])) {
    $faqID = $_GET["faqID"];
    
    // Delete the FAQ entry from the database
    $sql = "DELETE FROM faq WHERE faq_id = $faqID";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: faq.php"); // Redirect back to the FAQ.php page after deleting the FAQ
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request!";
    exit();
}
?>

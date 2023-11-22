<?php
include("config.php");
include("personnelcover.php");
function getFAQs($conn) {
    $faqs = array();
 
    $sql = "SELECT * FROM faq";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $faqs[] = $row;
        }
    }

    return $faqs;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FAQ Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .faq-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .faq-question {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .faq-answer {
            color: #555;
        }
    </style>
</head>
<body>
    <h1>Frequently Asked Questions</h1>

    <div class="faq-container">
        <?php
        // Get FAQs from the database
        $faqList = getFAQs($conn);

        // Display FAQs
        foreach ($faqList as $index => $faq) {
            echo '<div class="faq-item">';
            echo '<div class="faq-question">' . ($index + 1) . '. ' . $faq['question'] . '</div>';
            echo '<div class="faq-answer">' . nl2br($faq['answer']) . '</div>';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>
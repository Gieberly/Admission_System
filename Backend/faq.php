<?php
include("config.php");
include("Personnel_Cover.php");


// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Staff') {
    header("Location: loginpage.php");
    exit();
}
$userID = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, email, userType, status FROM users WHERE id = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($name, $email, $userType, $status);
$stmt->fetch();
$stmt->close();
 
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
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BSU OUR Admission Unit Personnel</title>
    <link rel="icon" href="assets/images/BSU Logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css//personnel.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
 
<section id="content">


        <main>

    <div id="announcements-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Annoucement</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Announcement</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><p>FAQ</p></li>
                        </ul>
                    </div>
                </div>
                

           
            
                  
                        <div class="tabs">
                    <button class="tab-button active" data-tab="tab3"  onclick="window.location.href='faq.php'">FAQ</button>
                    <button class="tab-button" data-tab="tab4" onclick="window.location.href='PersonnelEditSlot.php'">Slot</button>
                    <button class="tab-button" data-tab="tab5"  onclick="window.location.href='Reapplication.php'">Readmission Date</button>
            
                </div>
                <div class="table-data">
                <div class="order">
                        
                        <div class="head">
                    <h3>Frequently Asked</h3>
                    <button class="button save" id="addcoursepop" >Add Question</button>
                    
                </div>

<div class="tab-content" id="tab3" style="display: block;">             
<div>
<table id=courses-table>
    <colgroup>
        <col style="width: 5%;">
        <col style="width: 40%;">
        <col style="width: 40%;">
        <col style="width: 15%;">
    </colgroup>
   
                    <thead>
                    <tr>
            <th>#</th>
            <th>Question</th>
            <th>Answer</th>
            <th>Action</th>
        </tr>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
    // Get FAQs from the database
    $faqList = getFAQs($conn);

    // Display FAQs in a table
    foreach ($faqList as $index => $faq) {
        echo "<tr>";
        echo "<td>" . ($index + 1) . "</td>";
        echo "<td>" . $faq['question'] . "</td>";
        echo "<td>" . nl2br($faq['answer']) . "</td>";
        echo "<td>";
        echo "<button class='button delete' onclick='deleteFAQ(" . $faq['faq_id'] . ")'>Delete</button>";
        echo "<button class='button edit' onclick='editFAQ(" . $faq['faq_id'] . ", \"" . $faq['question'] . "\", \"" . $faq['answer'] . "\")'>Edit</button>";
        echo "</td>";
        echo "</tr>";
    }
    ?>
        </tbody>
    </table>
    <div>
    <div>
    <div id="edit-faq-section" style="display: none;">
        <h2>Edit FAQ</h2>
        <form id="edit-faq-form" action="update_faq.php" method="post">
            <input type="hidden" id="edit-faqID" name="faqID">
            <label for="edit-question">Question:</label>
            <input type="text" id="edit-question" name="question" required>
            <label for="edit-answer">Answer:</label>
            <textarea id="edit-answer" name="answer" rows="4" required></textarea>
            <button type="button" class="button save" onclick="saveEditedFAQ()">Save FAQ</button>
        </form>
    </div>

    <div id="add-faq-section">
        <form id="add-faq-form" action="addFAQ.php" method="post" style="display: none;">
            <h2>Add New FAQ</h2>
            <label for="new-question">Question:</label>
            <input type="text" id="new-question" name="question" required>

            <label for="new-answer">Answer:</label>
            <textarea id="new-answer" name="answer" rows="4" required></textarea>

            <button type="button" class="button save" onclick="addNewFAQ()">Save</button>
        </form>
    </div>
</div>   
</div>
</div>
</div>
<script>
    function editFAQ(faqID, question, answer) {
        // Set values in the edit form
        document.getElementById('edit-faqID').value = faqID;
        document.getElementById('edit-question').value = question;
        document.getElementById('edit-answer').value = answer;

        // Show the edit form and hide the table
        document.getElementById('edit-faq-section').style.display = 'block';
        document.getElementById('courses-table').style.display = 'none';
        document.getElementById('add-faq-form').style.display = 'none';
    }

    function saveEditedFAQ() {
        // Submit the form for saving the edited FAQ
        document.getElementById('edit-faq-form').submit();
    }

    function addNewFAQ() {
        // Submit the form for adding a new FAQ
        document.getElementById('add-faq-form').submit();
    }

    function deleteFAQ(faqID) {
        if (confirm("Are you sure you want to delete this FAQ?")) {
            window.location.href = 'deleteFAQ.php?faqID=' + faqID;
        }
    }

    document.getElementById('addcoursepop').addEventListener('click', function() {
        var addFAQSection = document.getElementById('add-faq-form');
        addFAQSection.style.display = 'block';
        document.getElementById('edit-faq-section').style.display = 'none';
        document.getElementById('courses-table').style.display = 'none';
        document.getElementById('addcoursepop').style.display = 'none';
        
    });

  


</script>
    </div>

</body>
</div>

               
            </div>
        </main>

    </section>



  

</body>
</html>
<?php
include("config.php");
include("studentcover.php");


?>

<section id="content">
    <main>
        <!-- Dashboard -->
        <div id="dashboard-content">
            <div class="head-title">
                <div class="left">
                    <h1>Frequently Asked Questions</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">FAQ</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="studentDashboard.php">Home</a></li>
                    </ul>
                </div>
            </div>

            <div id="master-list">
                <div class="table-data">
                    <div class="order">
                    <div class="faq-question" onclick="toggleAnswer('answer1')">
      <h2>When is the application for Admission Period?</h2>
    </div>
    <div id="answer1" class="faq-answer">
      <p><b>The application for admission will start on February 01, 2023 until March 31, 2023</b></p>
      <p>The opening of 2nd batch of application for admissionwill depend on the availability of slots after the screening period. Read all announcements to be posted in the University Website and in the Office of the University Registrar (OUR) FB Page.</p>
    </div>

    <div class="faq-question" onclick="toggleAnswer('answer2')">
      <h2>My first semester grades for grade 12 are not yet available by February 01, 2923. I only have my first quarter grades.</h2>
    </div>
    <div id="answer2" class="faq-answer">
      <p>The application for admission will only start on February 01, 2023. The application will be until March 31, 2023.
        File your application for admission once your documents are already complete. Note that the requirements indicated are the basis for the evaluation or screening of applicants. There will be NO ADMISSION TEST/EXAMINATION to be conducted..</p>
    </div>
    <div class="faq-question" onclick="toggleAnswer('answer3')">
        <h2>I am a transferee and was issued an honorable dismissal from the school I last attended. The school cannot issue a Certificate of Enrollment to me anymore. What document should I submit?</h2>
      </div>
    <div id="answer3" class="faq-answer">
        <p><b>Certificate of Attendance or any similar document that your last school attended may issue is acceptable. Provided that the document will show the duration of your residency/stay in that school.</b></p>
        <p>The required document is for OUR to check if your academic record was indeed issued by your LAST School attended. This is to avoid problems later in requesting permanent records to be issued to Benguet State University.</p>
    </div>
    <div class="faq-question" onclick="toggleAnswer('answer4')">
        <h2>I am a Senior High School Graduate and my school does not like to issue a Certificate of Enrollment for the previous term because I am already a graduate of the school/university.</h2>
      </div>
    <div id="answer4" class="faq-answer">
        <p>Certificate of Graduation may be submitted in lieu or as a replacement for the Certificate of Enrollment.</p>
    </div>
    <div class="faq-question" onclick="toggleAnswer('answer5')">
        <h2>Are you accepting transferees? Are you accepting transferees for 2nd/3rd year? (Transferees are COLLEGE students who are currently enrolled or previously enrolled in other schools.)</h2>
      </div>
    <div id="answer5" class="faq-answer">
        <p>Yes, we are accepting applications for admission from transferees. Please refer to the documents required for transferees.</p>
        <p>NOTE: The year level of admitted transferees will depend on the number of units that will be carried/credited based on the curriculum. For example: A second year student transferring to BSU may be evaluated as a first year student because he/she only finished 15% of the courses prescribed in the curriculum.</p>
    </div>
    <div class="faq-question" onclick="toggleAnswer('answer6')">
        <h2>I am currently enrolled as a college student. What GWA am I going to submit?</h2>
      </div>
    <div id="answer6" class="faq-answer">
        <p>For currently enrolled students, your GWA for the first semester is the requirement to be submitted.<br>
            GWA certification is required since colleges/universities have different grading system.<br>
            Kindly request though for your Certificate of Enrollment for the current term.</p>
    </div>
    <div class="faq-question" onclick="toggleAnswer('answer7')">
        <h2>I already have an NSO birth certificate. Do I have to submit a PSA birth certificate.</h2>
      </div>
    <div id="answer7" class="faq-answer">
        <p>No. The photocopy of your NSO birth certificate will suffice provided that the copy is clear and all entries are readable.</p>
    </div>
    <div class="faq-question" onclick="toggleAnswer('answer8')">
        <h2>We have classes from Mondays to Fridays. Do you have an online application?</h2>
      </div>
    <div id="answer8" class="faq-answer">
        <p>BSU never had an online application for admission. Currently, the office is trying to arrange for Saturday schedules for applications for admission. We shall make an announcement through our FB page if the proposed arrangement will be approved. You may also authorize a representative to file your application for admission.</p>
    </div>
    <div class="faq-question" onclick="toggleAnswer('answer9')">
        <h2>Are representatives allowed to file the application for admission instead of the student?</h2>
      </div>
    <div id="answer9" class="faq-answer">
        <p>Authorized representatives may process the application for admission for and in behalf of the applicant. Together with the application documents, your representative must submit the original hard copy of the duly signed Authorization Letter, 1 photocopy of 1 valid ID of the applicant and 1 photocopy of 1 valid ID of the representative. If a representative from schools will process for their students or for any group filing/processing of application for admission, the same requirements are needed.</p>
    </div>
<script>
    function toggleAnswer(answerId) {
      var answer = document.getElementById(answerId);
      if (answer.style.display === "none") {
        answer.style.display = "block";
      } else {
        answer.style.display = "none";
      }
    }
  </script>
                 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>


<style>
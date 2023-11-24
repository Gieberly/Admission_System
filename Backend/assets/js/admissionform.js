// Default tab
$(".tab").css("display", "none");
$("#tab-1").css("display", "block");

// Initialize an array to keep track of completed steps
var completedSteps = [];

function run(hideTab, showTab) {
  if (hideTab < showTab) { // If not pressing the previous button
    // Validation if pressing the next button
    var currentTab = 0;
    x = $('#tab-' + hideTab);
    y = $(x).find("input, select");

    if (hideTab === 1) {

// Validate the selected program
var natureOfDegree = document.getElementById("categoryDropdown").value;
if (natureOfDegree === "") {
    alert("Please select the nature of the degree before proceeding.");
    return false;
}

// Validate Academic Classification
var academicClassification = document.getElementById("academic_classification").value; // Corrected variable name
if (academicClassification === "") {
    alert("Please select academic classification before proceeding.");
    return false;
}

// Additional validation based on the natureOfDegree can be added here if needed

// Prompt for grades or values based on the nature of the degree and academic classification
var gradeRequirement = false;

if (natureOfDegree === "Board" && (AcademicClassification === "grade_12" || AcademicClassification === "shs_graduate" || AcademicClassification === "hs_graduate" || AcademicClassification === "second_degree")) {
    gradeRequirement = true;
} else if (natureOfDegree === "Board" && (AcademicClassification === "transferee" || AcademicClassification === "vocational_completers")) {
    gradeRequirement = true;
} else if (natureOfDegree === "Board" && AcademicClassification === "als_pept_passer") {
    gradeRequirement = true;
} else if (natureOfDegree === "Non-board" && (AcademicClassification === "grade_12" || AcademicClassification === "shs_graduate" || AcademicClassification === "hs_graduate" || AcademicClassification === "second_degree" || AcademicClassification === "transferee" || AcademicClassification === "vocational_completers")) {
    gradeRequirement = true;
} else if (natureOfDegree === "Non-board" && AcademicClassification === "als_pept_passer") {
    gradeRequirement = true;
}

if (gradeRequirement) {
    var inputValue = parseFloat(document.getElementById("inputValue").value);

    if (isNaN(inputValue) || inputValue < 0 || inputValue > 100) {
        alert("Please enter a valid value before proceeding.");
        return false;
    }
}

      // Prompt the user to select a program
      var selectedProgram;
      if (natureOfDegree === "Board") {
        selectedProgram = document.getElementById("board-programs").value;
        if (selectedProgram === "") {
          alert("Please select academic classification before proceeding.");
          return false;
        }
      } else if (natureOfDegree === "Non-board") {
        selectedProgram = document.getElementById("NonBoardProgram").value;
        if (selectedProgram === "") {
          alert("Please select academic classification before proceeding.");
          return false;
        }
      }

      // Validate the checkbox in Tab 1
      if (!document.getElementById("read-guidelines").checked) {
        alert("Please check the box to confirm that you have read the guidelines.");
        return false;
      }

    } else if (hideTab === 2) {
      // Handle the file input label click
      $('label[for="id_picture"]').click(function () {
        $('input[name="id_picture"]').click();
      });

      // Display the selected file name
      $('input[name="id_picture"]').change(function () {
        var fileName = $(this).val().split("\\").pop();
        $('label[for="id_picture"]').text(fileName);
      });
      var pictureInput = $('input[name="id_picture"]');
    if (pictureInput[0].files.length === 0) {
      alert("Please upload an ID picture.");
      return false;
    }

    // Display a confirmation dialog for the user to check information before proceeding
    if (!confirm("Are you sure you want to proceed to the next step? Please double-check your information on this page.")) {
      return false;
    }
  }

    for (i = 0; i < y.length; i++) {
      if ((hideTab === 2 || hideTab === 3) && y[i].value === "") {
        // Handle empty fields with visual cues
        $(y[i]).css("background", "#ffdddd");
        y[i].placeholder = "Please fill up all the field";
        y[i].focus();
        return false;
      }
    }
    // Mark the step as completed
    completedSteps[hideTab - 1] = true;
  }

  // Progress bar
  for (i = 1; i < showTab; i++) {
    $("#step-" + i).css("opacity", "1");
    if (completedSteps[i - 1]) {
      $("#step-" + i).html('<i class="fas fa-check"></i>'); // Add a checkmark
    }
  }

  // Switch tab
  $("#tab-" + hideTab).css("display", "none");
  $("#tab-" + showTab).css("display", "block");
  $("input, select").css("background", "#fff");

  window.scrollTo(0, 0);
}

function updateSelection() {
  const selectedProgram = document.getElementById('categoryDropdown').value;
  const boardClassificationFields = document.getElementById('boardclassificationFields');
  const nonBoardClassificationFields = document.getElementById('nonclassificationFields');

  // Hide both classification fields initially
  boardClassificationFields.style.display = 'none';
  nonBoardClassificationFields.style.display = 'none';

  if (selectedProgram === 'Board') {
    boardClassificationFields.style.display = 'block';
  } else if (selectedProgram === 'Non-board') {
    nonBoardClassificationFields.style.display = 'block';
  }
}

function updateBoardSelection() {
  const selectedBoardClassification = document.getElementById('academic_classification_board').value;
  const hsBoardFields = document.getElementById('hsboardFields');
  const tvnFields = document.getElementById('tvnFields');
  const alsFields = document.getElementById('alsFields');

  // Hide all programFields initially
  hsBoardFields.style.display = 'none';
  tvnFields.style.display = 'none';
  alsFields.style.display = 'none';

  if (selectedBoardClassification === 'grade_12b' || selectedBoardClassification === 'shs_graduateb' || selectedBoardClassification === 'hs_graduateb' || selectedBoardClassification === 'second_degreeb') {
    hsBoardFields.style.display = 'block';
    tvnFields.style.display = 'none';
    alsFields.style.display = 'none';
  } else if (selectedBoardClassification === 'transfereeb' || selectedBoardClassification === 'vocational_completersb') {
    tvnFields.style.display = 'block';
    hsBoardFields.style.display = 'none';
    alsFields.style.display = 'none';
  } else {
    alsFields.style.display = 'block';
    hsBoardFields.style.display = 'none';
    tvnFields.style.display = 'none';
  }
}

function updateNonBoardSelection() {
  const selectedNonBoardClassification = document.getElementById('academic_classification_nonboard').value;
  const tvnFields = document.getElementById('tvnFields');
  const alsFields = document.getElementById('alsFields');

  // Hide all programFields initially
  tvnFields.style.display = 'none';
  alsFields.style.display = 'none';

  if (selectedNonBoardClassification === 'als_pept_passern') {
    alsFields.style.display = 'block';
    tvnFields.style.display = 'none';
  } else {
    tvnFields.style.display = 'block';
    alsFields.style.display = 'none';
  }
}

  // Copy the selected nature of degree to Tab-2 input field
  //document.getElementById("nature_of_degree").value = natureOfDegree;

function updateDegreeFields() {
  // Get the selected value from the board program dropdown
  var selectedValueBoard = document.getElementById("board-programs").value;

  // Get the selected value from the non-board program dropdown
  var selectedValueNonBoard = document.getElementById("NonBoardProgram").value;

  // Determine which dropdown is selected and update the input fields accordingly
  var selectedValue = selectedValueBoard || selectedValueNonBoard;

  // Set the selected value in the first input field
  document.getElementById("degree_applied").value = selectedValue;

  // Set the selected value in the second input field
  document.getElementById("slip_degree").value = selectedValue;
}

function hsBoardSelection() {
  const englishGrade = parseInt(document.getElementById('englishGrade').value);
  const mathGrade = parseInt(document.getElementById('mathGrade').value);
  const scienceGrade = parseInt(document.getElementById('scienceGrade').value);
  const gwaGrade = parseFloat(document.getElementById('bgwaGrade').value);

  // Check if any grade is lower than 86 or greater than 100
  if (englishGrade < 86 || mathGrade < 86 || scienceGrade < 86 || gwaGrade < 86 || englishGrade > 100 || mathGrade > 100 || scienceGrade > 100 || gwaGrade > 100) {
    alert("Sorry! Your Grades didn't pass the required Average for Board Program. We advise you not to continue filling the Admission Form, Thank you.");
  } else if (englishGrade >= 86 && mathGrade >= 86 && scienceGrade >= 86 && gwaGrade >= 86 && englishGrade <= 99 && mathGrade <= 99 && scienceGrade <= 99 && gwaGrade <= 99) {
    // Grades are valid and within the required range
    alert('Congratulations! Your Grades are eligible for the Board Program. Please proceed with completing the Admission Form.');
    // Show Board Programs Dropdown
    document.getElementById('boardProgramsDropdown').style.display = 'block';
  } else {
    alert("Please enter valid grades between 86 and 99.");
  }
}

function tvnSelection() {
  const gwaGrade = parseFloat(document.getElementById('tvgwaGrade').value);

  // Check if GWA is lower than 80 or greater than 100
  if (gwaGrade < 80 || gwaGrade > 100) {
    alert('Sorry! Your GWA didn\'t pass the required Average for the Program. We advise you not to continue filling the Admission Form. Thank you.');
  } else if (gwaGrade >= 80 && gwaGrade <= 99) {
    // GWA is valid and within the required range
    alert('Congratulations! Your GWA is eligible for the Program. Please proceed with completing the Admission Form.');
    // Show Board Programs Dropdown
    document.getElementById('boardProgramsDropdown').style.display = 'block';
  } else {
    alert('Please enter a valid GWA between 80 and 99.');
  }
}

function alsSelection() {
  const prcGrade = parseFloat(document.getElementById('prcGrade').value);

  // Check if GWA is lower than 80 or greater than 100
  if (prcGrade < 80 || prcGrade > 100) {
    alert('Sorry! Your PRC didn\'t pass the required Average for the Program. We advise you not to continue filling the Admission Form. Thank you.');
  } else if (prcGrade >= 80 && prcGrade <= 99) {
    // GWA is valid and within the required range
    alert('Congratulations! Your GWA is eligible for the Program. Please proceed with completing the Admission Form.');
    // Show Board Programs Dropdown
    document.getElementById('boardProgramsDropdown').style.display = 'block';
  } else {
    alert('Please enter a valid PRC between 80 and 99.');
  }
}

function submitNonBoardForm() {
  var natureOfDegree = document.getElementById("categoryDropdown").value;

  if (natureOfDegree === "Non-board") {
    // Assuming you have an input field with ID: gwaGrade
    var gwaGrade = parseFloat(document.getElementById("gwaGrade").value);

    // Check if GWA is within the accepted range (80-99)
    if (gwaGrade >= 80 && gwaGrade <= 99) {
      document.getElementById("nonBoardGwaResult").innerText = "GWA: " + gwaGrade.toFixed(2) + "%";

      // Check if GWA is above the required threshold (80%)
      if (gwaGrade >= 80) {
        // Show non-board programs dropdown
        document.getElementById("nonBoardProgramsDropdown").style.display = "block";
      } else {
        alert("You didn't pass the required GWA (80% or above) for non-board programs.");
      }
    } else {
      alert("Sorry! your GWA didn't pass the required General Weighted Average for Non-board Program. We advise you not to continue filling the Admission Form, Thank you.");
    }
  }
}
function updateApplicantName() {
  // Get values from the input fields
  var lastName = document.getElementById("last_name").value;
  var firstName = document.getElementById("first_name").value;
  var middleName = document.getElementById("middle_name").value;

  // Concatenate the values to form the full name
  var fullName = lastName + ', ' + firstName + ' ' + middleName;

  // Set the full name in the applicant name input field
  document.getElementById("applicant_name").value = fullName;
}

function calculateAge() {
  // Get the birthdate value from the input field
  var birthdate = document.getElementById("birthdate").value;

  // Calculate the age based on the birthdate
  var today = new Date();
  var birthDate = new Date(birthdate);
  var age = today.getFullYear() - birthDate.getFullYear();

  // Check if the birthday has occurred this year
  var isBirthdayPassed = today.getMonth() < birthDate.getMonth() ||
    (today.getMonth() === birthDate.getMonth() && today.getDate() < birthDate.getDate());

  // Adjust age if birthday hasn't occurred yet
  if (!isBirthdayPassed) {
    age--;
  }
  // Set the calculated age in the age input field
  document.getElementById("age").value = age;
}

function validateEmail() {
  var emailInput = document.getElementById("email");
  var emailError = document.getElementById("email-error");
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  // Check if the entered email matches the regular expression
  if (emailRegex.test(emailInput.value)) {
    emailError.textContent = ""; // Clear error message
  } else {
    emailError.textContent = "Please enter valid and same email address you enter when you register.";
  }
}
function validatePhoneNumber(inputId) {
  var phoneNumberInput = document.getElementById(inputId);
  var phoneNumberError = document.getElementById(inputId + "-error");
  var phoneNumberRegex = /^(09\d{9}|0\d{10})$/;

  // Check if the entered phone number matches the regular expression
  if (phoneNumberRegex.test(phoneNumberInput.value)) {
    phoneNumberError.textContent = ""; // Clear error message
  } else {
    phoneNumberError.textContent = "Please enter a valid Philippine phone number.";
  }
}
document.addEventListener("DOMContentLoaded", function () {
  // Get the current date
  var currentDate = new Date();

  // Format the date as "YYYY-MM-DD" (required format for input type="date")
  var formattedDate = currentDate.toISOString().split('T')[0];

  // Set the formatted date as the value of the input field
  document.getElementById("application_date").value = formattedDate;
});

// Handle clicking the image preview to change the image
document.getElementById('id_picture_preview_container').addEventListener('click', function () {
  document.getElementById('id_picture').click();
});

// Handle the file input change event
document.getElementById('id_picture').addEventListener('change', function (e) {
  const fileInput = e.target;
  const imagePreview = document.getElementById('id_picture_preview_img');
  const uploadInstructions = document.getElementById('upload-instructions');

  if (fileInput.files.length > 0) {
    const file = fileInput.files[0];

    // Check if the file size exceeds 5MB
    const maxSizeInBytes = 5 * 1024 * 1024; // 5MB in bytes
    if (file.size > maxSizeInBytes) {
      alert("Please upload a picture with a size less than 5MB.");
      // Optionally, you may want to clear the file input or take other actions
      fileInput.value = ''; // Clear the file input
      return false;
    }
    // Display the selected file as the image preview
    const reader = new FileReader();
    reader.onload = function (e) {
      imagePreview.src = e.target.result;

      // Hide the upload instructions
      uploadInstructions.style.display = 'none';
    };
    reader.readAsDataURL(file);
  }
});


function generateApplicantNumber() {
  // Get the current date
  const currentDate = new Date();
  const day = currentDate.getDate();
  const month = currentDate.getMonth() + 1; // Adding 1 because months are zero-indexed

  // Get the order of the user (you can replace this with your logic to determine the order)
  const userOrder = 1; // Replace this with your logic to get the user order

  // Format the date and user order to create the applicant number
  const formattedDate = `${day < 10 ? '0' : ''}${day}-${month < 10 ? '0' : ''}${month}`;
  const formattedOrder = userOrder.toString().padStart(4, '0');
  const applicantNumber = `${formattedDate}-${formattedOrder}`;

  // Set the generated applicant number to the input field
  document.getElementById('applicant_number').value = applicantNumber;
}

// Call the function when the page loads
window.onload = generateApplicantNumber;

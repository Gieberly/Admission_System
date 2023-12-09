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
// Prompt for grades or values based on the nature of the degree and academic classification
var gradeRequirement = false;
var boardAcademicClassification = ""; // Make sure to assign a proper value
var nonBoardAcademicClassification = ""; // Make sure to assign a proper value

if (boardAcademicClassification === "grade_12b" || boardAcademicClassification === "shs_graduateb" || boardAcademicClassification === "hs_graduateb") {
    gradeRequirement = true;
} else if (boardAcademicClassification === "transfereeb" || boardAcademicClassification === "vocational_completersb" || boardAcademicClassification === "second_degreeb") {
    gradeRequirement = true;
} else if (boardAcademicClassification === "als_pept_passerb") {
    gradeRequirement = true;
} else if (nonBoardAcademicClassification === "grade_12n" || nonBoardAcademicClassification === "shs_graduaten" || nonBoardAcademicClassification === "hs_graduaten" || nonBoardAcademicClassification === "second_degreen" || nonBoardAcademicClassification === "transfereen" || nonBoardAcademicClassification === "vocational_completersn") {
    gradeRequirement = true;
} else if (nonBoardAcademicClassification === "als_pept_passern") {
    gradeRequirement = true;
}

if (gradeRequirement) {
    var inputValue = parseFloat(document.getElementById("inputValue").value);

    if (isNaN(inputValue) || inputValue < 0 || inputValue > 100) {
      showCustomAlert("Please enter a valid value before proceeding.");
        return false;
    }
}
// Validate the checkbox in Tab 1
if (!document.getElementById("read-guidelines").checked) {
  showCustomAlert("Please check the box to confirm that you have read the guidelines.");
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
  const selectedNatureDegree = document.getElementById('categoryDropdown').value;
  const boardClassificationFields = document.getElementById('boardclassificationFields');
  const nonBoardClassificationFields = document.getElementById('nonclassificationFields');

  // Hide both classification fields initially
  boardClassificationFields.style.display = 'none';
  nonBoardClassificationFields.style.display = 'none';

  if (selectedNatureDegree === 'Board') {
    boardClassificationFields.style.display = 'block';
  } else if (selectedNatureDegree === 'Non-board') {
    nonBoardClassificationFields.style.display = 'block';
  }
  // Get the selected value from the categoryDropdown in Tab-1
  var selectedNature = document.getElementById('categoryDropdown').value;

  // Set the selected value in the nature_of_degree input field in Tab-2
  document.getElementById('nature_of_degree').value = selectedNature;
}

// Attach the updateNatureOfDegree function to the onchange event of the categoryDropdown
document.getElementById('categoryDropdown').onchange = updateNatureOfDegree;

function updateBoardSelection() {
  const selectedBoardClassification = document.getElementById('academic_classification_board').value;
  const boardProgramsDropdown = document.getElementById('boardProgramsDropdown');
  const nonBoardProgramsDropdown = document.getElementById('nonBoardProgramsDropdown');

  // Hide all programFields initially
  boardProgramsDropdown.style.display = 'none';
  nonBoardProgramsDropdown.style.display = 'none';

  if (
    selectedBoardClassification === 'grade_12b' ||
    selectedBoardClassification === 'shs_graduateb' ||
    selectedBoardClassification === 'hs_graduateb' ||
    selectedBoardClassification === 'second_degreeb' ||
    selectedBoardClassification === 'transfereeb' ||
    selectedBoardClassification === 'vocational_completersb' ||
    selectedBoardClassification === 'als_pept_passerb'
  ) {
    boardProgramsDropdown.style.display = 'block';
  } else if (selectedBoardClassification === '') {
    boardProgramsDropdown.style.display = 'none';
    nonBoardProgramsDropdown.style.display = 'none';
  } 
   // Get the selected value from the board program dropdown
   var selectedValueACBoard = document.getElementById("academic_classification_board").value;

   // Get the selected value from the non-board program dropdown
   var selectedValueACNonBoard = document.getElementById("academic_classification_nonboard").value;
 
   // Determine which dropdown is selected and update the input fields accordingly
   var selectedValue = selectedValueACBoard || selectedValueACNonBoard;
 
   // Set the selected value in the first input field
   document.getElementById("academic_classification").value = selectedValue;
}

function updateNonBoardSelection() {
  const selectedNonBoardClassification = document.getElementById('academic_classification_nonboard').value;
  const boardProgramsDropdown = document.getElementById('boardProgramsDropdown');
  const nonBoardProgramsDropdown = document.getElementById('nonBoardProgramsDropdown');

  // Hide all programFields initially
  boardProgramsDropdown.style.display = 'none';
  nonBoardProgramsDropdown.style.display = 'none';

  if (
    selectedNonBoardClassification === 'grade_12n' ||
    selectedNonBoardClassification === 'shs_graduaten' ||
    selectedNonBoardClassification === 'hs_graduaten' ||
    selectedNonBoardClassification === 'second_degreen' ||
    selectedNonBoardClassification === 'transfereen' ||
    selectedNonBoardClassification === 'vocational_completersn' ||
    selectedNonBoardClassification === 'als_pept_passern'
  ) {
    nonBoardProgramsDropdown.style.display = 'block';
  } else if (selectedNonBoardClassification === '') {
    boardProgramsDropdown.style.display = 'none';
    nonBoardProgramsDropdown.style.display = 'none';
  } 
  // Get the selected value from the board program dropdown
  var selectedValueACBoard = document.getElementById("academic_classification_board").value;

  // Get the selected value from the non-board program dropdown
  var selectedValueACNonBoard = document.getElementById("academic_classification_nonboard").value;

  // Determine which dropdown is selected and update the input fields accordingly
  var selectedValue = selectedValueACBoard || selectedValueACNonBoard;

  // Set the selected value in the first input field
  document.getElementById("academic_classification").value = selectedValue;
}

function updateDegreeFields() {
  const selectedBoardClassification = document.getElementById('academic_classification_board').value;
  const selectedBoardProgram = document.getElementById('board-programs').value;
  const selectednonBoardClassification = document.getElementById('academic_classification_nonboard').value;
  const selectednonBoardProgram = document.getElementById('NonBoardProgram').value;

  // Hide all programFields initially
  document.getElementById('hsboardFields').style.display = 'none';
  document.getElementById('tvnFields').style.display = 'none';
  document.getElementById('alsFields').style.display = 'none';

  if ((selectedBoardClassification === 'grade_12b' || selectedBoardClassification === 'shs_graduateb' || selectedBoardClassification === 'hs_graduateb') && selectedBoardProgram !== '') {
    document.getElementById('hsboardFields').style.display = 'block';
  } else if ((selectedBoardClassification === 'transfereeb' || selectedBoardClassification === 'vocational_completersb' || selectedBoardClassification === 'second_degreeb') && selectedBoardProgram !== '') {
    document.getElementById('tvnFields').style.display = 'block';
  } else if (selectedBoardClassification === 'als_pept_passerb' && selectedBoardProgram !== '') {
    document.getElementById('alsFields').style.display = 'block';
  } else  if ((selectednonBoardClassification === 'grade_12n' || selectednonBoardClassification === 'shs_graduaten' || selectednonBoardClassification === 'hs_graduaten' || selectednonBoardClassification === 'transfereen' || selectednonBoardClassification === 'vocational_completersn' || selectednonBoardClassification === 'second_degreen') && selectednonBoardProgram !== '') {
    document.getElementById('tvnFields').style.display = 'block';
  } else if (selectednonBoardClassification === 'als_pept_passern' && selectednonBoardProgram !== '') {
    document.getElementById('alsFields').style.display = 'block';
  }

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
    showCustomAlert("Sorry! Your Grades didn't pass the required Average for Board Program. We advise you not to continue filling the Admission Form, Thank you.");
  } else if (englishGrade >= 86 && mathGrade >= 86 && scienceGrade >= 86 && gwaGrade >= 86 && englishGrade <= 99 && mathGrade <= 99 && scienceGrade <= 99 && gwaGrade <= 99) {
    // Grades are valid and within the required range
    showCustomAlert('Congratulations! Your Grades are eligible for the Board Program. Please proceed with completing the Admission Form.');
    // Show Board Programs Dropdown
    document.getElementById('index-btn-wrapper').style.display = 'block';
  } else {
    showCustomAlert("Please enter valid grades between 86 and 99.");
  }
}

function tvnSelection() {
  const gwaGrade = parseFloat(document.getElementById('tvgwaGrade').value);

  // Check if GWA is lower than 80 or greater than 100
  if (gwaGrade < 80 || gwaGrade > 100) {
    showCustomAlert('Sorry! Your GWA didn\'t pass the required Average for the Program. We advise you not to continue filling the Admission Form. Thank you.');
  } else if (gwaGrade >= 80 && gwaGrade <= 99) {
    // GWA is valid and within the required range
    showCustomAlert('Congratulations! Your GWA is eligible for the Program. Please proceed with completing the Admission Form.');
    // Show Board Programs Dropdown
    document.getElementById('index-btn-wrapper').style.display = 'block';
  } else {
    showCustomAlert('Please enter a valid GWA between 80 and 99.');
  }
}

function alsSelection() {
  const prcGrade = parseFloat(document.getElementById('prcGrade').value);

  // Check if GWA is lower than 80 or greater than 100
  if (prcGrade < 80 || prcGrade > 100) {
    showCustomAlert('Sorry! Your PRC didn\'t pass the required Average for the Program. We advise you not to continue filling the Admission Form. Thank you.');
  } else if (prcGrade >= 80 && prcGrade <= 99) {
    // GWA is valid and within the required range
    showCustomAlert('Congratulations! Your GWA is eligible for the Program. Please proceed with completing the Admission Form.');
    // Show Board Programs Dropdown
    document.getElementById('index-btn-wrapper').style.display = 'block';
  } else {
    showCustomAlert('Please enter a valid PRC between 80 and 99.');
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

//Alert Message
function showCustomAlert(message) {
  var customAlert = document.getElementById("customAlert");
  var customAlertMessage = document.getElementById("customAlertMessage");

  customAlertMessage.textContent = message;
  customAlert.style.display = "block";
}

function closeCustomAlert() {
  var customAlert = document.getElementById("customAlert");
  customAlert.style.display = "none";
}
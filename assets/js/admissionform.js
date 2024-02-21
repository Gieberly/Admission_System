
// Function to check if all required fields in the Course Guide are complete
function isCourseGuideComplete() {
  var categoryDropdown = document.getElementById("categoryDropdown");
  var boardProgramsDropdown = document.getElementById("board-programs");
  var nonBoardProgramsDropdown = document.getElementById("NonBoardProgram");
  var classificationDropdown;

  if (categoryDropdown.value === "Board") {
    classificationDropdown = document.getElementById("academic_classification_board");
  } else if (categoryDropdown.value === "Non-board") {
    classificationDropdown = document.getElementById("academic_classification_nonboard");
  }

  // Add additional checks based on your form requirements
  if (categoryDropdown.value === "" || (categoryDropdown.value === "Board" && boardProgramsDropdown.value === "") || (categoryDropdown.value === "Non-board" && nonBoardProgramsDropdown.value === "") || classificationDropdown.value === "") {
    return false;
  }

  return true;
}

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
      showCustomAlert("Please upload an ID picture.");
      return false;
    }

    // Display a confirmation dialog for the user to check information before proceeding
    if (!confirm("Are you sure you want to proceed to the next step? Please double-check your information on this page.")) {
      return false;
    }
  }

    for (i = 0; i < y.length; i++) {
      if ((hideTab === 2) && y[i].value === "") {
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
  var categoryDropdown = document.getElementById("categoryDropdown");
  var natureOfDegreeInput = document.getElementById("nature_of_degree");
  var boardProgramsDropdown = document.getElementById("boardProgramsDropdown");
  var nonBoardProgramsDropdown = document.getElementById("nonBoardProgramsDropdown");

  // Reset and hide other selections and fields
  boardProgramsDropdown.style.display = "none";
  nonBoardProgramsDropdown.style.display = "none";
  document.getElementById("boardclassificationFields").style.display = "none";
  document.getElementById("nonclassificationFields").style.display = "none";
  $("#classificationInfo").html(""); // Clear grade input fields
  $("#non_board_results").html(""); // Clear non-board results container

  if (categoryDropdown.value === "Board") {
    boardProgramsDropdown.style.display = "block";
  } else if (categoryDropdown.value === "Non-board") {
    nonBoardProgramsDropdown.style.display = "block";
    // Remove the line below to prevent the updateNonBoardGradeSelection function from being called
    // updateNonBoardGradeSelection(); // Call the function to update non-board results
  }

  // Set the value of the selected option in the "Nature of Degree" dropdown to the input field
  natureOfDegreeInput.value = categoryDropdown.value;
}




function updateBoardSelection() {
  // Get the selected value from the "Board Programs" dropdown
  var selectedProgram = document.getElementById("board-programs").value;

  // Check if a program is selected
  if (selectedProgram !== "") {
    // Show the related content for the selected program
    document.getElementById("boardclassificationFields").style.display = "block";

    // Set the selected program's description as the value of the "degree_applied" input field
    document.getElementById("degree_applied").value = $("#board-programs option:selected").text();
  } else {
    // If no program is selected, hide the related content and clear the "degree_applied" input field
    document.getElementById("boardclassificationFields").style.display = "none";
    document.getElementById("degree_applied").value = "";
  }

  // You can add more logic here based on the selected program if needed
}


function updateNonBoardSelection() {
  // Get the selected value from the "Non-Board Programs" dropdown
  var selectedNonBoardProgram = document.getElementById("NonBoardProgram").value;

  // Check if a program is selected
  if (selectedNonBoardProgram !== "") {
    // Show the related content for the selected Non-Board program
    document.getElementById("nonclassificationFields").style.display = "block";

    // Set the selected Non-Board program's description as the value of the "degree_applied" input field
    document.getElementById("degree_applied").value = $("#NonBoardProgram option:selected").text();
  } else {
    // If no Non-Board program is selected, hide the related content and clear the "degree_applied" input field
    document.getElementById("nonclassificationFields").style.display = "none";
    document.getElementById("degree_applied").value = "";
  }

  // You can add more logic here based on the selected Non-Board program if needed
}

function BoardRequirements() {
  var classificationDropdown = document.getElementById("academic_classification_board");
  var classificationInfoContainer = document.getElementById("classificationInfo");
  var academicClassificationInput = document.getElementById("academic_classification"); // Add this line

  // Check if a classification is selected
  if (classificationDropdown.value !== "") {
    // Display the corresponding information based on the selected classification
    switch (classificationDropdown.value) {
      case "Senior High School Graduates":
        classificationInfoContainer.innerHTML = `
          <ol type="I"  class="custom-list">
          <h3>Requirements to Submit</h3>
            <strong>
              <li>Senior High School Graduates who did not enroll in any college degree
                program/technical/vocational/degree
                program in any other school after graduation and will only enroll for the immediately following School
                Year:</li>
            </strong>
            <ol class="rac-list" type="a">
              <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
              <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
                family
                name/surname of the husband</li>
              <li>Hard copy two (2) 2x2 recent formal studio "type" photo with
                nametag and signature</li>
              <li>Certified true copy of Grade 12 Report Card. Photocopy /scanned copy will suffice if the applicant can
                present the original copy for comparison purposes.</li>
              <li>Certification of Enrollment from the last school attended (most recent).</li>
            </ol>
          </ol>`;
        break;
        case "High School (Old Curriculum) Graduates":
          classificationInfoContainer.innerHTML = `
          <ol type="I"  class="custom-list">
          <h3>Requirements to Submit</h3>
            <strong>
                <li>High School Graduate of the Old High School curriculum who did not enroll in any college degree
                  program
                  in any other school after graduation from high school and will only enroll this S.Y. 2021-2022:</li>
              </strong>
              <ol class="rac-list" type="a">
                <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
                <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
                  family
                  name/surname of the husband</li>
                <li>Hard copy two (2) 2x2 recent formal studio "type" photo with
                  nametag and signature
                </li>
                <li>Certified true copy of High School Card/Form 138. Photocopy /scanned copy will suffice if the
                  applicant
                  can present the original copy for comparison purposes.</li>
                <li>Certification of Enrollment from the last school attended (most recent).</li>
              </ol>
            </ol>`;
          break;
          case "Grade 12":
            classificationInfoContainer.innerHTML = `
            <ol type="I"  class="custom-list">
            <h3>Requirements to Submit</h3>
              <strong>
              <li>ALS/PEPT Completer:</li>
          </strong>
          <ol class="rac-list" type="a">
            <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
            <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
              family
              name/surname of the husband</li>
            <li>Hard copy two (2) 2x2 recent formal studio "type" photo with
              nametag and signature
            </li>
            <li>Certified true copy ALS Certificate of Rating – For completers of Alternative Learning System (ALS) OR
              PEPT. Photocopy /scanned copy will suffice if the applicant can present the original copy for comparison
              purposes.</li>
            <li>Certification of Enrollment from the last school attended (most recent).</li>
          </ol>
              </ol>`;
            break;
          case "ALS/PEPT Completers":
            classificationInfoContainer.innerHTML = `
            <ol type="I"  class="custom-list">
            <h3>Requirements to Submit</h3>
              <strong>
              <li>ALS/PEPT Completer:</li>
          </strong>
          <ol class="rac-list" type="a">
            <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
            <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
              family
              name/surname of the husband</li>
            <li>Hard copy two (2) 2x2 recent formal studio "type" photo with
              nametag and signature
            </li>
            <li>Certified true copy ALS Certificate of Rating – For completers of Alternative Learning System (ALS) OR
              PEPT. Photocopy /scanned copy will suffice if the applicant can present the original copy for comparison
              purposes.</li>
            <li>Certification of Enrollment from the last school attended (most recent).</li>
          </ol>
              </ol>`;
            break;
            case "Transferees":
            classificationInfoContainer.innerHTML = `
            <ol type="I"  class="custom-list">
            <h3>Requirements to Submit</h3>
              <strong>
              <li>Transferee:</li>
          </strong>
          <ol class="rac-list" type="a">
            <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
            <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
              family
              name/surname of the husband</li>
            <li>Hard copy two (2) 2x
            <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
            <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
              family
              name/surname of the husband</li>
            <li>Hard copy two (2) 2x2 recent formal studio "type" photo with
              nametag and signature
            </li>
            <li>Certified true copy of Copy of Grades or Transcript of Records (Applicable only for Second Degree
              Transferees). Photocopy /scanned copy will suffice if the applicant can present the original copy for
              comparison purposes.</li>
            <li>Certification of Enrollment from the last school attended (most recent) or presently enrolled in.</li>
            <li>Certification of General Weighted Average (GWA) issued by the Registrar's Office/equivalent Office of
              your previous School.</li>
          </ol>
              </ol>`;
            break;
            case "Second Degree":
              classificationInfoContainer.innerHTML = `
              <ol type="I"  class="custom-list">
              <h3>Requirements to Submit</h3>
                <strong>
                <li>Second Degree:</li>
                </strong>
                <ol class="rac-list" type="a">
                  <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
                  <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
                    family
                    name/surname of the husband</li>
                  <li>Hard copy two (2) 2x2 recent formal studio "type" photo with
                    nametag and signature
                  </li>
                  <li>Certified true copy of Copy of Grades or Transcript of Records (Applicable only for Second Degree
                    Transferees). Photocopy /scanned copy will suffice if the applicant can present the original copy for
                    comparison purposes.</li>
                  <li>Photocopy/scanned copy of Grades or Transcript of Records for graduates Where BSU is the last school
                    attended</li>
                  <li>Certification of Enrollment from the last school attended (most recent) or presently enrolled in.</li>
                  <li>Certification of General Weighted Average (GWA) issued by the Registrar's Office/equivalent Office of
                    your previous School.</li>
                </ol>
                </ol>`;
              break;
              default:
                classificationInfoContainer.innerHTML = ""; // Clear the info container if no match
            }
        
            // Update the value of the academic_classification input field
            academicClassificationInput.value = classificationDropdown.value; // Add this line
          } else {
            // Clear the info container if no classification is selected
            classificationInfoContainer.innerHTML = "";
            academicClassificationInput.value = ""; // Clear the input field value if no classification is selected
          }
        }


function NonBoardRequirements() {
  var classificationDropdown = document.getElementById("academic_classification_nonboard");
  var classificationInfoContainer = document.getElementById("classificationInfo");
  var academicClassificationInput = document.getElementById("academic_classification"); // Added this line

  // Define the information based on the selected classification
  var classification = classificationDropdown.value;
  var information = "";

  switch (classification) {
    case "Senior High School Graduates":
      information = `
        <ol type="I" class="custom-list">
        <h3>Requirements to Submit</h3>
          <strong>
              
            <li>Senior High School Graduate who did not enroll in any college degree
              program/technical/vocational/degree
              program in any other school after graduation and will only enroll for the immediately following School
              Year:</li>
          </strong>
          <ol class="rac-list" type="a">
            <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
            <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
              family
              name/surname of the husband</li>
            <li>Hard copy two (2) 2x2 recent formal studio "type" photo with
              nametag and signature</li>
            <li>Certified true copy of Grade 12 Report Card. Photocopy /scanned copy will suffice if the applicant can
              present the original copy for comparison purposes.</li>
            <li>Certification of Enrollment from the last school attended (most recent).</li>
          </ol>
        </ol>
      `;
      break;
      case "High School (Old Curriculum) Graduates":
        information = `
          <ol type="I"  class="custom-list">
          <h3>Requirements to Submit</h3>
            <strong>
                <li>High School Graduate of the Old High School curriculum who did not enroll in any college degree
                  program
                  in any other school after graduation from high school and will only enroll this S.Y. 2021-2022:</li>
              </strong>
              <ol class="rac-list" type="a">
                <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
                <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
                  family
                  name/surname of the husband</li>
                <li>Hard copy two (2) 2x2 recent formal studio "type" photo with
                  nametag and signature
                </li>
                <li>Certified true copy of High School Card/Form 138. Photocopy /scanned copy will suffice if the
                  applicant
                  can present the original copy for comparison purposes.</li>
                <li>Certification of Enrollment from the last school attended (most recent).</li>
              </ol>
            </ol>`;
          break;
          case "Grade 12":
            information = `
            <ol type="I"  class="custom-list">
            <h3>Requirements to Submit</h3>
              <strong>
              <li>ALS/PEPT Completer:</li>
          </strong>
          <ol class="rac-list" type="a">
            <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
            <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
              family
              name/surname of the husband</li>
            <li>Hard copy two (2) 2x2 recent formal studio "type" photo with
              nametag and signature
            </li>
            <li>Certified true copy ALS Certificate of Rating – For completers of Alternative Learning System (ALS) OR
              PEPT. Photocopy /scanned copy will suffice if the applicant can present the original copy for comparison
              purposes.</li>
            <li>Certification of Enrollment from the last school attended (most recent).</li>
          </ol>
              </ol>`;
            break;
          case "ALS/PEPT Completers":
            information = `
            <ol type="I"  class="custom-list">
            <h3>Requirements to Submit</h3>
              <strong>
              <li>ALS/PEPT Completer:</li>
          </strong>
          <ol class="rac-list" type="a">
            <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
            <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
              family
              name/surname of the husband</li>
            <li>Hard copy two (2) 2x2 recent formal studio "type" photo with
              nametag and signature
            </li>
            <li>Certified true copy ALS Certificate of Rating – For completers of Alternative Learning System (ALS) OR
              PEPT. Photocopy /scanned copy will suffice if the applicant can present the original copy for comparison
              purposes.</li>
            <li>Certification of Enrollment from the last school attended (most recent).</li>
          </ol>
              </ol>`;
            break;
            case "Transferees":
              information = `
            <ol type="I"  class="custom-list">
            <h3>Requirements to Submit</h3>
              <strong>
              <li>Transferee:</li>
          </strong>
          <ol class="rac-list" type="a">
            <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
            <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
              family
              name/surname of the husband</li>
            <li>Hard copy two (2) 2x
            <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
            <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
              family
              name/surname of the husband</li>
            <li>Hard copy two (2) 2x2 recent formal studio "type" photo with
              nametag and signature
            </li>
            <li>Certified true copy of Copy of Grades or Transcript of Records (Applicable only for Second Degree
              Transferees). Photocopy /scanned copy will suffice if the applicant can present the original copy for
              comparison purposes.</li>
            <li>Certification of Enrollment from the last school attended (most recent) or presently enrolled in.</li>
            <li>Certification of General Weighted Average (GWA) issued by the Registrar's Office/equivalent Office of
              your previous School.</li>
          </ol>
              </ol>`;
            break;
            case "Second Degree":
              information = `
              <ol type="I"  class="custom-list">
              <h3>Requirements to Submit</h3>
                <strong>
                <li>Second Degree:</li>
                </strong>
                <ol class="rac-list" type="a">
                  <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
                  <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
                    family
                    name/surname of the husband</li>
                  <li>Hard copy two (2) 2x2 recent formal studio "type" photo with
                    nametag and signature
                  </li>
                  <li>Certified true copy of Copy of Grades or Transcript of Records (Applicable only for Second Degree
                    Transferees). Photocopy /scanned copy will suffice if the applicant can present the original copy for
                    comparison purposes.</li>
                  <li>Photocopy/scanned copy of Grades or Transcript of Records for graduates Where BSU is the last school
                    attended</li>
                  <li>Certification of Enrollment from the last school attended (most recent) or presently enrolled in.</li>
                  <li>Certification of General Weighted Average (GWA) issued by the Registrar's Office/equivalent Office of
                    your previous School.</li>
                </ol>
                </ol>`;
              break;

    default:
      information = "No specific requirements for the selected classification.";
      break;
  }

  // Update the content of the classificationInfoContainer
  classificationInfoContainer.innerHTML = information;
  academicClassificationInput.value = classification; // Added this line
}


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


//Alert Message
function showCustomAlert(message) {
  var customAlert = document.getElementById("customAlert");
  var customAlertMessage = document.getElementById("customAlertMessage");

  customAlertMessage.textContent = message;
  customAlert.style.display = "block";

   // Hide the alert after 5 seconds
   setTimeout(function() {
    closeCustomAlert();
  }, 10000);
}

function closeCustomAlert() {
  var customAlert = document.getElementById("customAlert");
  customAlert.style.display = "none";
}

// Add a class to the fields that need this behavior
var fieldsToHighlight = document.querySelectorAll('.small-label');

// Add event listeners to those fields
fieldsToHighlight.forEach(function (field) {
  field.addEventListener('click', function () {
    // Check if the field is empty
    if (field.value.trim() === '') {
      // Change background color to red
      field.style.backgroundColor = '#ffdddd';

      // Optionally, reset the background color if the user fills the field later
      field.addEventListener('input', function () {
        if (field.value.trim() !== '') {
          field.style.backgroundColor = '#fff';
        }
      });
    }
  });
});


function calculateAge() {
  var birthdateInput = document.getElementById("birthdate");
  var ageInput = document.getElementById("age");

  if (birthdateInput.value) {
    var birthdate = new Date(birthdateInput.value);
    var today = new Date();
    var age = today.getFullYear() - birthdate.getFullYear();

    // Check if birthday has occurred this year
    if (today.getMonth() < birthdate.getMonth() || (today.getMonth() === birthdate.getMonth() && today.getDate() < birthdate.getDate())) {
      age--;
    }

    ageInput.value = age;
  
  }
}


function validatePhoneNumber(inputId) {
  var phoneInput = document.getElementById(inputId);
  var phoneError = document.getElementById(inputId + "-error");

  // Regular expression for a valid Philippine mobile number
  var regex = /^(09|\+639)\d{9}$/;

  if (!regex.test(phoneInput.value)) {
    phoneError.innerHTML = "Please enter a valid Philippine mobile number.";
  } else {
    phoneError.innerHTML = "";
  }
}
function validateLRN(input) {
  // Remove non-numeric characters
  let inputValue = input.value.replace(/\D/g, '');

  // Limit the input to 12 digits
  if (inputValue.length > 12) {
      inputValue = inputValue.slice(0, 12);
  }

  // Update the input value
  input.value = inputValue;
}

function updateApplicantName() {
  // Get values from the input fields
  var lastName = document.getElementById('last_name').value;
  var firstName = document.getElementById('first_name').value;
  var middleName = document.getElementById('middle_name').value;

  // Concatenate the values and set them to the "Name of Applicant" field
  var fullName = lastName + ', ' + firstName + ' ' + middleName;
  document.getElementById('applicant_name').value = fullName;
}
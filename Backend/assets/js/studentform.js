
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

function run(hideTab, showTab) {
  // Check if all required fields are filled in tab 1
  if (hideTab === 1 && !isCourseGuideComplete()) {
    alert("Please complete the Course Guide before proceeding.");
    return;
  }

  // Check if the checkbox is checked in tab 1
  if (hideTab === 1 && !$("#read-guidelines").prop("checked")) {
    alert("Please check the checkbox to confirm that you have read the Instructions and Requirements.");
    return;
  }

  // Check if the user is in tab 2 and the ID picture file input is empty
  if (hideTab === 2 && !isIdPictureUploaded()) {
    alert("Please upload your ID picture before proceeding.");
    return;
  }

  // Progress bar
  for (i = 1; i < showTab; i++) {
    $("#step-" + i).css("opacity", "1");
  }

  // Switch tab
  $("#tab-" + hideTab).css("display", "none");
  $("#tab-" + showTab).css("display", "block");
  $("input").css("background", "#fff");
}

// Function to check if the ID picture is uploaded in tab 2
function isIdPictureUploaded() {
  var idPictureInput = document.getElementById("id_picture");

  // Check if the file input has files
  if (idPictureInput.files && idPictureInput.files.length > 0) {
    return true;
  }

  return false;
}


// Add event listener to the picture preview container to trigger file input click
document.getElementById("id_picture_preview_container").addEventListener("click", function() {
  document.getElementById("id_picture").click();
});

// Add event listener to the file input to handle file selection and update preview
document.getElementById("id_picture").addEventListener("change", function() {
  var input = this;

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      // Update the image source in the preview container
      document.getElementById("id_picture_preview_img").src = e.target.result;
    };

    // Read the selected file as a data URL
    reader.readAsDataURL(input.files[0]);
  } else {
    // Handle the case where no file is selected
    alert("Please select a valid picture file.");
    // Clear the current preview, if any
    document.getElementById("id_picture_preview_img").src = "";
  }
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
    removeHighlight('age');
  }
}

function removeHighlight(inputId) {
  var inputElement = document.getElementById(inputId);
  inputElement.style.background = "#fff"; // Set background to white to remove highlighting
}

document.getElementById("myForm").addEventListener("blur", function (event) {
  var target = event.target;
  if (target.tagName === "INPUT" && target.type !== "submit") {
    // If the blurred element is an input (excluding submit buttons), highlight if empty
    if (target.value.trim() === "") {
      highlightEmptyField(target);
    } else {
      removeHighlight(target.id);
    }
  }
}, true);

function highlightEmptyField(inputElement) {
  inputElement.style.background = "#ffdddd"; // Highlight empty field in red
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


function updateApplicantName() {
  // Get values from the input fields
  var lastName = document.getElementById('last_name').value;
  var firstName = document.getElementById('first_name').value;
  var middleName = document.getElementById('middle_name').value;

  // Concatenate the values and set them to the "Name of Applicant" field
  var fullName = lastName + ', ' + firstName + ' ' + middleName;
  document.getElementById('applicant_name').value = fullName;
}

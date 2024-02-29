


// Default tab
$(".tab").css("display", "none");
$("#tab-1").css("display", "block");

// Initialize an array to keep track of completed steps
var completedSteps = [];


// Add an event listener to input fields and select elements
$("input, select").on("focus", function() {
  $(this).css("background", "#fff"); // Reset background color when focused
}).on("blur", function() {
  if ($(this).val() === "") {
    // If the field is empty, turn background color to red
    $(this).css("background", "#ffdddd");
    $(this).attr("placeholder", "Please fill up this field");
  }
});

function run(hideTab, showTab) {
  if (hideTab < showTab) { // If not pressing the previous button
    // Validation if pressing the next button
    var currentTab = 0;
    x = $('#tab-' + hideTab);
    y = $(x).find("input, select");

    if (hideTab === 1) {

 // Check if Academic Classification is selected
 var academicClassification = $('#academic_classification_board').val();
 if (!academicClassification) {
   alert("Please select Academic Classification before proceeding.");
   return false;
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


  }

    for (i = 0; i < y.length; i++) {
      if ((hideTab === 2 ) && y[i].value === "") {
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
          
        <div id="trackStrandFields">
        <label class="small-label" for="track">Track</label>
        <select name="track" class="inputs" id="track">
            <option value="">Select Track</option>
            <!-- Add additional tracks as needed -->
            <option value="Academic Track">Academic Track</option>
            <option value="Technical Vocational and Livelihood Track">Technical Vocational and Livelihood Track</option>
            <option value="Sports Track">Sports Track</option>
            <option value="Arts and Design Track">Arts and Design Track</option>
        </select>
    
        <label class="small-label" for="strand">Strand</label>
        <input type="text" name="strand" class="input" id="strand">
    </div>
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
          </ol>
          `
          
          ;
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
           
          <div id="trackStrandFields">
          <label class="small-label" for="track">Track</label>
          <select name="track" class="inputs" id="track">
              <option value="">Select Track</option>
              <!-- Add additional tracks as needed -->
              <option value="Academic Track">Academic Track</option>
              <option value="Technical Vocational and Livelihood Track">Technical Vocational and Livelihood Track</option>
              <option value="Sports Track">Sports Track</option>
              <option value="Arts and Design Track">Arts and Design Track</option>
          </select>
      
          <label class="small-label" for="strand">Strand</label>
          <input type="text" name="strand" class="input" id="strand">
      </div>
           
            <ol type="I"  class="custom-list">
            <h3>Requirements to Submit</h3>
              <strong>
              <li>Grade 12 as of application period (Currently enrolled as Grade 12):</li>
          </strong>
          <ol class="rac-list" type="a">
            <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
            <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
              family
              name/surname of the husband</li>
            <li>Hard copy One (1) 2x2 recent formal studio "type" photo with
              nametag and signature
            </li>
            <li>Certified photocopy of Grade 11 Card</li>
            <li>Certification of Enrollment from the last school attended.</li>
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


function updateApplicantName() {
  // Get values from the input fields
  var lastName = document.getElementById('last_name').value;
  var firstName = document.getElementById('first_name').value;
  var middleName = document.getElementById('middle_name').value;

  // Concatenate the values and set them to the "Name of Applicant" field
  var fullName = lastName + ', ' + firstName + ' ' + middleName;
  document.getElementById('applicant_name').value = fullName;
}
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

document.addEventListener("DOMContentLoaded", function() {
  var lastNameInput = document.getElementById("last_name");
  var firstNameInput = document.getElementById("first_name");
  var middleNameInput = document.getElementById("middle_name");
  var birthPlaceInput = document.getElementById("birthplace");
  var CitizenshipInput = document.getElementById("citizenship");
  var NationalityInput = document.getElementById("nationality");
  var AddressInput = document.getElementById("permanent_address");
  var zipCodeInput = document.getElementById("zip_code");
  var TeleInput = document.getElementById("phone_number");
  var FacebookInput = document.getElementById("facebook");
  var conName1Input = document.getElementById("contact_person_1");
  var conNum1Input = document.getElementById("contact1_phone");
  var conName2Input = document.getElementById("contact_person_2");
  var conNum2Input = document.getElementById("contact_person_2_mobile");
  var lastSchoolInput = document.getElementById("high_school_name_address");
  var lrnInput = document.getElementById("lrn");

  var lastNameNote = document.getElementById("last_name_note");
  var firstNameNote = document.getElementById("first_name_note");
  var middleNameNote = document.getElementById("middle_name_note");
  var birthPlaceNote = document.getElementById("birthPlace_note");
  var CitizenshipNote = document.getElementById("citizenship_note");
  var NationalityNote = document.getElementById("nationality_note");
  var AddressNote = document.getElementById("permanent_address_note");
  var zipCodeNote = document.getElementById("zip_code_note");
  var TeleNote = document.getElementById("phone_number_note");
  var FacebookNote = document.getElementById("facebook_note");
  var conName1Note = document.getElementById("contact_person_1_note");
  var conNum1Note = document.getElementById("contact1_phone_note");
  var conName2Note = document.getElementById("contact_person_2_note");
  var conNum2Note = document.getElementById("contact_person_2_mobile_note");
  var lastSchoolNote = document.getElementById("high_school_name_address_note");
  var lrnNote = document.getElementById("lrn_note");

  lastNameInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(lastNameNote);
  });
  
  firstNameInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(firstNameNote);
  });
  
  middleNameInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(middleNameNote);
  });

  birthPlaceInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(birthPlaceNote);
  });

  CitizenshipInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(CitizenshipNote);
  });

  NationalityInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(NationalityNote);
  });

  AddressInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(AddressNote);
  });

  zipCodeInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(zipCodeNote);
  });

  TeleInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(TeleNote);
  });

  FacebookInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(FacebookNote);
  });

  conName1Input.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(conName1Note);
  });

  conNum1Input.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(conNum1Note);
  });

  conName2Input.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(conName2Note);
  });

  conNum2Input.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(conNum2Note);
  });

  lastSchoolInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(lastSchoolNote);
  });

  lrnInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(lrnNote);
  });

  function displayPlaceholderExample(placeholder) {
    placeholder.style.display = "block";
  }

  function hidePlaceholderExample(placeholder) {
    placeholder.style.display = "none";
  }

  function hideAllPlaceholderExamples() {
    var allPlaceholderExamples = document.querySelectorAll(".note");
    allPlaceholderExamples.forEach(function(placeholder) {
      hidePlaceholderExample(placeholder);
    });
  }
});


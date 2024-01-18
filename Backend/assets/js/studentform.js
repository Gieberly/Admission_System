
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
    alert("Please check the checkbox to confirm that you have read the guidelines.");
    return;
  }

  // Check if the user is in tab 2 and the ID picture is not uploaded
  if (hideTab === 2 && $("#id_picture_preview_img").attr("src") === "") {
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
  $("#gradeFieldsContainer").html(""); // Clear grade input fields
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


function updateBoardGradeSelection() {
  var classificationDropdown = document.getElementById("academic_classification_board");
  var academicClassificationInput = document.getElementById("academic_classificationd");

  var classification = classificationDropdown.value;

  // Set the value of the selected option to the input field
  academicClassificationInput.value = classification;

  // AJAX call to check_columns.php
  $.ajax({
    type: "GET",
    url: "check_columns.php",
    data: { classification: classification },
    success: function (response) {
      // Update the grade fields based on the response
      $("#gradeFieldsContainer").html(response);
    },
    error: function (xhr, status, error) {
      console.error("Error: " + error);
    }
  });
}


function updateNonBoardGradeSelection() {
  var selectedNonBoardClassification = $("#academic_classification_nonboard").val();
  var academicClassificationInput = $("#academic_classificationd");

  // Perform AJAX request to fetch GWA input field based on user's selection
  $.ajax({
      url: 'nonboard_check_columns.php',
      type: 'GET',
      data: { non_board_classification: selectedNonBoardClassification },
      success: function(response) {
          // Replace the content of a container div with the response
          $("#non_board_results").html(response);

          // Hide the gradeFieldsContainer when non_board_results appears
          $("#gradeFieldsContainer").hide();

          // Update the value of the academic_classificationd input field
          academicClassificationInput.val(selectedNonBoardClassification);
      },
      error: function() {
          console.error('Error in AJAX request.');
      }
  });
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

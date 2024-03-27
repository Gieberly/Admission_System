var $j = jQuery.noConflict();

function displayEmailUsedModal() {
    $j('#emailUsedModal').modal('show');
}

 // JavaScript to show/hide "Select Department" dropdown based on "Select User Type"
 function toggleDepartmentDropdown() {
    var userTypeDropdown = document.getElementById("userType");
    var departmentDropdown = document.getElementById("description");

    if (userTypeDropdown.value === "Faculty") {
        // If "Faculty" is selected, show the "Select Department" dropdown
        departmentDropdown.style.display = "block";
    } else {
        // Otherwise, hide the "Select Department" dropdown
        departmentDropdown.style.display = "none";
    }
}
document.addEventListener("DOMContentLoaded", function () {
// Hide the password error message initially
var errorContainer = document.getElementById("passwordError");
errorContainer.style.display = "none";
});

function validatePassword() {
    const passwordInput = document.getElementById("registerEmail");
    const passwordError = document.getElementById("passwordError");
  
    // Reset error message and style
    passwordError.textContent = "";
    passwordInput.classList.remove("invalid");
  
    // Check password length
    if (passwordInput.value.length > passwordInput.maxLength) {
      passwordError.textContent = "Password cannot exceed 8 characters.";
      passwordInput.classList.add("invalid");
      return;
    }
  
    // Regular expression for letters, numbers, and special characters
    const regex = /^(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&*])[0-9a-zA-Z!@#$%^&*]{8}$/;
  
    // Check password pattern
    if (!regex.test(passwordInput.value)) {
      passwordError.textContent = "Password must contain letters, numbers, and special characters.";
      passwordInput.classList.add("invalid");
    }
  }



function validateConfirmPassword() {
var password = document.getElementById("registerEmail").value;
var confirmPassword = document.getElementsByName("confirm_password")[0].value;
var confirmPwdInput = document.getElementsByName("confirm_password")[0];
var errorContainer = document.getElementById("passwordError");

if (password !== confirmPassword) {
    // Passwords don't match, show error message and highlight the field
    confirmPwdInput.classList.add("password-error");
    errorContainer.innerHTML = "Passwords don't match";
    errorContainer.style.display = "block"; // Show the error message
    return false;
} else {
    // Passwords match, reset the border color and clear error message
    confirmPwdInput.classList.remove("password-error");
    errorContainer.innerHTML = "";
    errorContainer.style.display = "none"; // Hide the error message
    return true;
}
}

function validateForm() {
var password = document.getElementById("registerEmail").value;
var confirmPassword = document.getElementsByName("confirm_password")[0].value;

// Check if passwords match
if (password !== confirmPassword) {
    alert("Password and Confirm Password do not match");
    return false;
}

// Call validatePassword only if the user attempts to register
if (password !== "" || confirmPassword !== "") {
    return validatePassword();
}

return true;
}

// JavaScript to show/hide the popup
document.addEventListener("DOMContentLoaded", function () {
    // Get the popup container
    var popupContainer = document.getElementById('popupContainer');

    // Show the popup
    popupContainer.style.display = 'block';

    // Hide the popup when the Agree button is clicked only if the checkbox is checked
    document.getElementById('agreeButton').addEventListener('click', function (event) {
        // Prevent form submission
        event.preventDefault();

        // Get the value of the checkbox
        var checkboxChecked = document.getElementById('agreeCheckbox').checked;

        // Hide the popup only if the checkbox is checked
        if (checkboxChecked) {
            popupContainer.style.display = 'none';
        } else {
            // alert('Please agree to the terms and conditions.');
        }
    });
});
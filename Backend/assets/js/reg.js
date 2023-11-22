document.getElementById('joinUsButton').addEventListener('click', function () {
    var form = document.getElementById('registrationForm');
    form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
});
document.addEventListener('DOMContentLoaded', function () {
    var registerEmailInput = document.getElementById('registerEmail');

    registerEmailInput.addEventListener('input', function () {
        // Store the entered email in a variable
        var enteredEmail = registerEmailInput.value;

        // Set the entered email in a cookie or local storage
        localStorage.setItem('enteredEmail', enteredEmail);
    });
});
function validatePassword() {
    var password = document.getElementById("registerPassword").value;
    var confirmPassword = document.getElementById("confirmPassword").value;
    if (password !== confirmPassword) {
        alert("Passwords do not match. Please enter matching passwords.");
        return false;
    }
    // If passwords match, continue with form submission
    return true;
}
function validatePassword() {
    var password = document.getElementById("registerPassword").value;
    var confirmPassword = document.getElementById("confirmPassword").value;
    if (password !== confirmPassword) {
        alert("Passwords do not match. Please enter matching passwords.");
        return false;
    }
    // If passwords match, continue with form submission
    return true;
}
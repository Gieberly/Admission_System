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
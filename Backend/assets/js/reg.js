document.getElementById('joinUsButton').addEventListener('click', function () {
    var form = document.getElementById('registrationForm');
    form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
});




    function validateForm() {
        var password = document.getElementById("registerEmail").value;
        var confirmPassword = document.getElementsByName("confirm_password")[0].value;

        if (password !== confirmPassword) {
            alert("Password and Confirm Password do not match");
            return false;
        }

        return true;
    }
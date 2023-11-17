document.getElementById('joinUsButton').addEventListener('click', function () {
    var form = document.getElementById('loginForm');
    form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
});
document.addEventListener('DOMContentLoaded', function () {
    const PasswordIn = document.getElementById('password');
    const RpasswordIn = document.getElementById('Rpassword');
    const error = document.getElementById('password_err');
    const submitB = document.getElementById('submitB');

    PasswordIn.addEventListener('input', validatePassword);
    RpasswordIn.addEventListener('input', validatePassword);

    function validatePassword() {
        const password = PasswordIn.value;
        const confirmPassword = RpasswordIn.value;

        if (password === confirmPassword) {
            error.style.display = 'none';
            submitB.disabled = false;
            submitB.classList.remove('btn-auth-disabled');
        } else {
            error.style.display = 'inline';
            submitB.disabled = true;
            submitB.classList.add('btn-auth-disabled');
        }
    }
});

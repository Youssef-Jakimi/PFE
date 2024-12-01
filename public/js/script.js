document.addEventListener('DOMContentLoaded', function() {
    const PasswordIn = document.getElementById('password');
    const RpasswordIn = document.getElementById('Rpassword');
    const error = document.getElementById('password_err');
    const submitB = document.getElementById('submitB');

    RpasswordIn.addEventListener('input', function() {
        const password = PasswordIn.value;
        const confirmPassword = RpasswordIn.value;

        if (password === confirmPassword) {
            error.style.display = 'none';
            submitB.disabled = false;
        } else {
            error.style.display = 'inline';
            submitB.disabled = true;
        }
    });
});

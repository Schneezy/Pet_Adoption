function validateForm() {
    const fname = document.getElementById('fname').value;
    const lname = document.getElementById('lname').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const dateOfBirth = document.getElementById('dateOfBirth').value;
    const password = document.getElementById('passwd').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    // Regex patterns
    const fnameRegex = /^[a-zA-Z]+$/;
    const lnameRegex = /^[a-zA-Z]+$/;
    const phoneRegex = /^[0-9]{10}$/;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

    if (!fname || !lname || !email || !phone || !password || !confirmPassword) {
        alert('All fields are required');
        return;
    }

    if (!emailRegex.test(email)) {
        alert('Invalid email format');
        return;
    }

    if (!phoneRegex.test(phone)) {
        alert('Invalid phone number format (10 digits)');
        return;
    }

    if (!passwordRegex.test(password)) {
        alert('Password must contain at least one digit, one lowercase letter, one uppercase letter, and be at least 8 characters long');
        return;
    }

    if (password !== confirmPassword) {
        alert('Passwords do not match');
        return;
    }

    // If all validations pass, you can proceed with form submission or other actions
    alert('Form validated successfully! You can proceed with submission.');
}

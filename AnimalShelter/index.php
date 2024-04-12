<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="css/allcss.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/Register.js"></script>
</head>
<body>
    <div class="container">
        <h1>Welcome!!</h1>
        <h2>Join us in giving animals a second chance at happiness!!</h2>
    

    <form method="POST" action="action/register_user_action.php" onsubmit="return validateForm()">
        <div class="Login">
            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname" />

            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname" />

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="example@email.com"/>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" placeholder="1234567890"/>

            <label for="dateOfBirth">Date of Birth:</label>
            <input type="date" id="dateOfBirth" name="dateOfBirth"/>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" minlength="8" placeholder="8 characters min"/>

            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" minlength="8" placeholder="Retype your password"/>

            <button type="submit" name="Register">Register</button>

            <div class="login-link">Already have an account? <a href="login/login.php">Login here</a></div>
        </div>
</div>
    </form>
  

    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                alert("Error: Passwords do not match");
                return false;
                if (password !== confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error: Passwords do not match!',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Okay'
                });
                return false;
            }

            return true;
        }
    }
    </script>
</body>
</html>

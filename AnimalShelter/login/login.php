<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../css/allcss.css">
</head>
<body>
    <div class="container">
        <h1>Login Page</h1>
        <h3>Welcome to your number 1 Pet Adoption Agency</h3>

        <form onsubmit="Login(event)" method="POST" action='../action/login_user_action.php'>
            <div class="Login">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" >

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" >

                <button type="submit" name="subtn">Log In</button>

                <div class="login-link">Don't have an account? <a href="../Login/register_view.php">Join here</a></div>
            </div>
        </form>

    <script>
        function Login() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            // regex
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

            if (!email || !password) {
                alert('All fields are required');
                return false;
            }
            if (!emailRegex.test(email)) {
                alert('Invalid email format');
                return false;
            }
            if (!passwordRegex.test(password)) {
                alert('Invalid password format');
                return false;
            }
            return true; // Proceed with form submission
        }
    </script>
</body>
</html>

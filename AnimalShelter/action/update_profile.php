<?php
// Include database connection file
include '../settings/connection.php';
include '../settings/core.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Start the session (no need to start again if already started)
    // session_start();

    // Check if UserID is set in the session
    if (!isset($_SESSION['userId'])) {
        echo 'UserID not set in session.';
        exit;
    }

    // Get form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $confirmEmail = $_POST['confirmEmail'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate form data (add more validation as needed)
    if ($email !== $confirmEmail) {
        echo 'Emails do not match.';
        exit;
    }

    if ($password !== $confirmPassword) {
        echo 'Passwords do not match.';
        exit;
    }

    // Update user profile in the database (replace 'User' with your actual table name)
    $userID = $_SESSION['userId'];
    $sql = "UPDATE User SET FirstName='$firstName', LastName='$lastName', Email='$email', Phone='$phone', Password='$password' WHERE UserID=$userID";

    if ($con->query($sql) === TRUE) {
        // Success message with SweetAlert
        echo '<script>
        setTimeout(() => {
            Swal.fire({
                icon: "success",
                title: "Profile Updated",
                text: "Your profile has been updated successfully!",
                showConfirmButton: false,
                timer: 3000
            }).then(() => {
                window.location.href = "homepage.php"; // Redirect to homepage after 3 seconds
            });
        }, 500); // Delay to ensure SweetAlert displays properly
        </script>';
    } else {
        // Error message with SweetAlert
        echo '<script>
        setTimeout(() => {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Error updating profile: ' . $con->error . '",
                showConfirmButton: false,
                timer: 3000
            }).then(() => {
                window.location.href = "profile.php"; // Redirect to profile page after 3 seconds
            });
        }, 500); // Delay to ensure SweetAlert displays properly
        </script>';
    }
}
?>

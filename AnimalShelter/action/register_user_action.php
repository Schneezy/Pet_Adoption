<?php
// Include the database connection file
include '../settings/connection.php';

// Check if the form is submitted
if(isset($_POST['Register'])){
    // Retrieve form data
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $dateOfBirth = $_POST["dateOfBirth"];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        die("Error: Passwords do not match");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query to insert user data into the User table
    $sql = "INSERT INTO User (RoleID, FirstName, LastName, GenderID, DateOfBirth, Phone, Email, Password)
            VALUES (2, '$fname', '$lname', 1, '$dateOfBirth', '$phone', '$email', '$hashed_password')";
    
    $query = $con->query($sql);

    // Check if the query was successful
    if(!$query){
        die("Error: " . $con->error);
    } else {
        // Redirect to the login page after successful registration
        header("Location: ../login/login.php");
        exit(); // Ensure script execution stops after redirection
    }
} else {
    // Redirect to the registration page if form data is not submitted
    header("Location: ../login/register_view.php");
    exit(); // Ensure script execution stops after redirection
}
?>

<?php
session_start();
include '../settings/connection.php';

if (isset($_POST["subtn"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare the SQL query to retrieve user data
    $query = "SELECT * FROM User WHERE Email = '$email'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $user = mysqli_fetch_assoc($result);

        // Verify password using password_verify
        if ($user && password_verify($password, $user["Password"])) {
            $_SESSION["userId"] = $user["UserID"];
            $_SESSION["userRole"] = $user["RoleID"];

            // Redirect to homepage if login is successful
            header('location: ../view/Homepage.php');
            exit();
        } else {
            die("Invalid credentials");
        }
    } else {
        die("Error: " . mysqli_error($con));
    }
}
?>

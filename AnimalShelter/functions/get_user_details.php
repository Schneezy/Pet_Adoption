<?php
// Check if the session is not already active before starting it
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database connection file
include_once "../settings/connection.php";


// Check if the user is logged in and session variable is set
if (!isset($_SESSION['userId'])) {
    // Redirect the user to the login page or display a message using SweetAlert
    echo "<script>swal('Error', 'You are not logged in. Please log in first.', 'error').then(() => { window.location.href = '../login/login.php'; });</script>";
    exit(); // Stop further execution of the script
}

// Now, $_SESSION['userId'] should contain the logged-in user's ID
$userID = $_SESSION['userId'];

// Initialize variables
$name = $email = $telephone = "";

// Fetch user details from the database based on the user's ID
$sqlUser = "SELECT FirstName, Email, Phone FROM user WHERE userId = ?";
if ($stmtUser = $con->prepare($sqlUser)) {
    $stmtUser->bind_param("i", $userID);
    $stmtUser->execute();
    $resultUser = $stmtUser->get_result();
    if ($rowUser = $resultUser->fetch_assoc()) {
        // Assign user details to variables
        $name = $rowUser['FirstName'];
        $email = $rowUser['Email'];
        $telephone = $rowUser['Phone'];
    } else {
        // Handle case where user details are not found (unlikely in a logged-in scenario)
        echo "<script>swal('Error', 'User details not found.', 'error');</script>";
    }
    $stmtUser->close();
} else {
    echo "<script>swal('Error', 'Error preparing user details statement.', 'error');</script>";
}
?>

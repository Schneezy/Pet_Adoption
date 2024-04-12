<?php
// Include database connection file
include '../settings/connection.php';

// Check if the form is submitted with the action parameter
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    // Start the session
    session_start();

    // Check if UserID is set in the session
    if (!isset($_SESSION['userId'])) {
        echo 'UserID not set in session.';
        exit;
    }

    // Check the action parameter value
    if ($_POST['action'] === 'delete') {
        // Delete user profile from the database (replace 'User' with your actual table name)
        $sql = "DELETE FROM user WHERE UserID={$_SESSION['userId']}";

        if ($con->query($sql) === TRUE) {
            echo 'Profile deleted successfully.';
        } else {
            echo 'Error deleting profile: ' . $con->error;
        }

        // Close database connection
        $con->close();
    }}
    ?>
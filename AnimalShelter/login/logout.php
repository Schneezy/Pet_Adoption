<?php
session_start();

// Unset the session variables
unset($_SESSION['userId']);
unset($_SESSION['userRole']);

// Include the login view page
header("Location: ../login/login.php");
exit();
?>

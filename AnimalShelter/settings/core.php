<?php
// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Function to check if the user is logged in
function checker() {
    if (!isset($_SESSION['userId'])) {
        header("Location: ../Login/Login.php");
        exit();
    }
}
checker();

// Function to check the user's role ID
function checkUserRole() {
    if (isset($_SESSION['RoleID'])) {
        return $_SESSION['RoleID'];  // Return the user's role ID if it exists
    } else {
        return false;  // Return false if the role ID session doesn't exist
    }
}

// Check if the user is logged in and has a role ID of 2
$roleId = checkUserRole();
if ($roleId == 2) {
    $restrictedPages = ["manage_requests.php", "Homepage.php", "addPet.php"];
    $currentPage = basename($_SERVER['PHP_SELF']); // Get the current page file name

    // Redirect if the user tries to access restricted pages
    if (in_array($currentPage, $restrictedPages)) {
        header("Location: ../view/AllPets.php");
        exit();
    }
}
?>

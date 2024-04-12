<?php
// Start the session to access session variables
session_start();

// Include database connection file
include_once "../settings/connection.php";
include_once "../settings/core.php";

// Check if the user is logged in and session variable is set
if (!isset($_SESSION['userId'])) {
    // Redirect the user to the login page or display a message using SweetAlert
    echo "<script>swal('Error', 'You are not logged in. Please log in first.', 'error').then(() => { window.location.href = '../login/login.php'; });</script>";
    exit(); // Stop further execution of the script
}

// Now, $_SESSION['userId'] should contain the logged-in user's ID
$userID = $_SESSION['userId'];

// Fetch user details from the database based on the user's ID
$sqlUser = "SELECT FirstName, Email FROM user WHERE UserID = ?";
if ($stmtUser = $con->prepare($sqlUser)) {
    $stmtUser->bind_param("i", $userID);
    $stmtUser->execute();
    $resultUser = $stmtUser->get_result();
    if ($rowUser = $resultUser->fetch_assoc()) {
        // Assign user details to variables
        $name = $rowUser['FirstName'];
        $email = $rowUser['Email'];
    } else {
        // Handle case where user details are not found (unlikely in a logged-in scenario)
        echo "<script>swal('Error', 'User details not found.', 'error');</script>";
        exit();
    }
    $stmtUser->close();
} else {
    echo "<script>swal('Error', 'Error preparing user details statement.', 'error');</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $phone = $_POST['phone'];
    $petName = $_POST['pet'];
    $reason = $_POST['reason'];
    $statusID = 2; // Assuming StatusID 2 corresponds to 'Pending'

    // Fetch PetID based on the provided pet's name
    $sqlPetID = "SELECT PetID FROM pets WHERE Name = ?";
    if ($stmtPetID = $con->prepare($sqlPetID)) {
        $stmtPetID->bind_param("s", $petName);
        $stmtPetID->execute();
        $resultPetID = $stmtPetID->get_result();
        if ($rowPetID = $resultPetID->fetch_assoc()) {
            $petID = $rowPetID['PetID'];
        } else {
            // Handle case where pet name doesn't exist using SweetAlert
            echo "<script>swal('Error', 'The specified pet does not exist.', 'error');</script>";
            exit();
        }
        $stmtPetID->close();
    } else {
        echo "<script>swal('Error', 'Error preparing pet ID statement.', 'error');</script>";
        exit();
    }

    // Prepare SQL statement to insert data into AdoptionRequests table
    $sql = "INSERT INTO AdoptionRequests (UserID, PetID, LivingSituation, PetExperience, SuitabilityReasons, StatusID)
            VALUES (?, ?, ?, ?, ?, ?)";
    if ($stmt = $con->prepare($sql)) {
        // Set other variables like $livingSituation and $petExperience as needed
        $livingSituation = $_POST['living_situation']; // Assuming 'living_situation' is the name attribute of your dropdown
        $petExperience = $_POST['pet_experience']; // Assuming 'pet_experience' is the name attribute of your radio button group

        // Bind parameters to the prepared statement
        $stmt->bind_param("iisssi", $userID, $petID, $livingSituation, $petExperience, $reason, $statusID);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Redirect to a thank you page or homepage after successful form submission using SweetAlert
            echo "<script>swal('Success', 'Adoption request submitted successfully.', 'success').then(() => { window.location.href = '../view/Homepage.php'; });</script>";
            exit();
        } else {
            echo "<script>swal('Error', 'Error submitting adoption request.', 'error');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>swal('Error', 'Error preparing statement.', 'error');</script>";
    }
}

// Close connection
$con->close();
?>

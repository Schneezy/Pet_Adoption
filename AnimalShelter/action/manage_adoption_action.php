<?php
// Include database connection file
include_once "../settings/connection.php";
include_once "../settings/core.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['request_id'], $_POST['action'])) {
    $requestId = $_POST['request_id'];
    $action = strtolower($_POST['action']); // Convert action to lowercase

    // Validate action
    if (!in_array($action, ['approve', 'reject', 'pending'])) {
        echo "Invalid action.";
        exit; // Stop further execution
    }

    $statusId = getStatusIdFromAction($action); // Get the corresponding status ID

    if ($action === 'approve') {
        // Delete the pet from the database if the request is approved
        $petId = getPetIdFromRequestId($requestId);
        if ($petId !== false) {
            if (deletePet($petId)) {
                echo "Pet deleted successfully.";
            } else {
                echo "Error deleting pet.";
            }
        } else {
            echo "Error: Pet ID not found for the given request.";
        }
    }

    // Update the status of the adoption request
    $sql = "UPDATE AdoptionRequests SET StatusID = ? WHERE RequestID = ?";
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("ii", $statusId, $requestId);

        // Execute the update statement
        if ($stmt->execute()) {
            // Redirect back to the manage adoption requests page
            header("Location: ../admin/manage_pets.php");
            exit();
        } else {
            echo "Error updating request status: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error preparing update statement: " . $con->error;
    }
} else {
    echo "Invalid form data.";
}

// Function to get the status ID based on the selected action
function getStatusIdFromAction($action) {
    switch ($action) {
        case 'approve':
            return 1; 
        case 'reject':
            return 3; // Assuming StatusID 4 corresponds to 'Rejected'
        case 'pending':
        default:
            return 2; // Assuming StatusID 2 corresponds to 'Pending'
    }
}

// Function to get the PetID from the AdoptionRequests table
function getPetIdFromRequestId($requestId) {
    global $con;
    $sql = "SELECT PetID FROM AdoptionRequests WHERE RequestID = ?";
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("i", $requestId);
        $stmt->execute();
        $stmt->bind_result($petId);
        if ($stmt->fetch()) {
            return $petId;
        }
        $stmt->close();
    }
    return false; // Return false if PetID is not found
}

// Function to delete a pet from the Pets table
// Function to delete a pet from the Pets table
function deletePet($petId) {
    global $con;
    
    // Delete adoption requests for the given pet
    $sqlDeleteRequests = "DELETE FROM AdoptionRequests WHERE PetID = ?";
    $stmtDeleteRequests = $con->prepare($sqlDeleteRequests);
    $stmtDeleteRequests->bind_param("i", $petId);
    $stmtDeleteRequests->execute();
    $stmtDeleteRequests->close();

    // Delete the pet from the Pets table
    $sqlDeletePet = "DELETE FROM pets WHERE PetID = ?";
    $stmtDeletePet = $con->prepare($sqlDeletePet);
    $stmtDeletePet->bind_param("i", $petId);
    $result = $stmtDeletePet->execute();
    $stmtDeletePet->close();

    return $result; // Return true if deletion is successful
}
?>

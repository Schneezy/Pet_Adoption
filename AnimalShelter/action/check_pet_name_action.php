<?php
// Include database connection file
include_once "../settings/connection.php";

// Check if the pet name parameter is set in the GET request
if(isset($_GET['pet'])) {
    // Sanitize the input to prevent SQL injection
    $petName = mysqli_real_escape_string($con, $_GET['pet']);

    // Prepare SQL statement to check if the pet name exists in the database
    $sql = "SELECT PetID FROM Pets WHERE Name = ?";
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("s", $petName);
        $stmt->execute();
        $stmt->store_result();

        // Check if any rows were returned (i.e., pet name exists)
        if ($stmt->num_rows > 0) {
            echo "Pet name exists";
        } else {
            echo "Pet name does not exist";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement";
    }
} else {
    echo "Pet name parameter not provided";
}
?>

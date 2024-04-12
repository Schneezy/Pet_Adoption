<?php
include '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pet_id"])) {
    // Get the pet ID from the POST data
    $petId = $_POST["pet_id"];

    // Prepare and execute the SQL query to delete the pet
    $sql = "DELETE FROM Pets WHERE PetID = '$petId'";

    if ($con->query($sql) === TRUE) {
        echo "Pet deleted successfully.";
    } else {
        echo "Error deleting pet: " . $con->error;
    }
} else {
    echo "Invalid request or pet ID missing.";
}
?>

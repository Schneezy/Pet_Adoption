<?php
include '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pet_id"])) {
    // Get the pet ID from the POST data
    $petId = $_POST["pet_id"];

    // Get updated form data
    $name = $_POST["name"];
    $species = $_POST["species"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $size = $_POST["size"];
    $location = $_POST["location"];
    $description = $_POST["description"];
    $healthStatus = $_POST["healthStatus"];
    $vaccinations = $_POST["vaccinations"];
    $behavior = $_POST["behavior"];
    $specialNeeds = $_POST["specialNeeds"];

    // Check if a new image is uploaded
    if ($_FILES["image"]["size"] > 0) {
        // Handle image upload
        $targetDir = "../images/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is valid
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // Try to upload file
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";

                // Update pet details including the image URL
                $imageURL = "images/" . basename($_FILES["image"]["name"]);
                $sql = "UPDATE Pets 
                        SET Name = '$name', Species = '$species', Age = '$age', Gender = '$gender', SizeID = '$size', 
                        Location = '$location', Description = '$description', HealthStatus = '$healthStatus', 
                        Vaccinations = '$vaccinations', Behavior = '$behavior', SpecialNeeds = '$specialNeeds', 
                        ImageURL1 = '$imageURL'
                        WHERE PetID = '$petId'";

                if ($con->query($sql) === TRUE) {
                    echo "Pet updated successfully.";
                } else {
                    echo "Error updating pet: " . $con->error;
                }

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        // No new image uploaded, update other details without changing the image
        $sql = "UPDATE Pets 
                SET Name = '$name', Species = '$species', Age = '$age', Gender = '$gender', SizeID = '$size', 
                Location = '$location', Description = '$description', HealthStatus = '$healthStatus', 
                Vaccinations = '$vaccinations', Behavior = '$behavior', SpecialNeeds = '$specialNeeds'
                WHERE PetID = '$petId'";

        if ($con->query($sql) === TRUE) {
            echo "Pet updated successfully.";
        } else {
            echo "Error updating pet: " . $con->error;
        }
    }
} else {
    echo "Invalid request or pet ID missing.";
}
?>

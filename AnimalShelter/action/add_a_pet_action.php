<?php
session_start();
include '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $type = $_POST["type"]; // Assuming the form field name for type is "type"
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
    

    // // Validate form data
    // if (empty($name) || empty($type) || empty($species) || empty($age) || empty($gender) || empty($size) || empty($location) || empty($description)) {
    //     die("Please fill out all required fields.");
    // }

    // Handle image upload
    $targetDir = "../images/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is valid
    // $check = getimagesize($_FILES["image"]["name"]);
    // if ($check === false) {
    //     echo "File is not an image.";
    //     $uploadOk = 0;
    // }

    // // Check file size
    // if ($_FILES["image"]["size"] > 5000000) {
    //     echo "Sorry, your file is too large.";
    //     $uploadOk = 0;
    // }

    // // Allow certain file formats
    // if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    //     $uploadOk = 0;
    // }
        // echo "progresssss";
     if ($uploadOk == 0) {
         echo "Sorry, your file was not uploaded.";
     } 
         // Try to upload file
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        // echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
           // Insert pet details into the database
        // $imageURL = "images/" . basename($_FILES["image"]["name"]);

        $sql = "INSERT INTO Pets (Name, TypeID, Species, Age, GenderID, SizeID, Location, Description, HealthStatus, Vaccinations, Behavior, SpecialNeeds, ImageURL1) 
             VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";

            $qrr = $con->prepare($sql);
            $qrr->bind_param("sisiiisssssss", $name, $type, $species, $age, $gender, $size, $location, $description, $healthStatus, $vaccinations, $behavior, $specialNeeds, $targetFile);
            
             if ($qrr->execute()) {
                 echo "Pet details inserted successfully.";
             } else {
                 echo "Error inserting pet details: " . $qrr->error;
             }

             $qrr->close();
             $con->close();
         } else {
             echo "Sorry, there was an error uploading your file.";
         }
    
 }
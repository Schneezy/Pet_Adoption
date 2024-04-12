<?php
include '../settings/connection.php';
include '../settings/core.php';
include '../functions/get_animaltype_fxn.php';
include '../functions/get_gender_fxn.php';
include '../functions/get_size_fxn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Pet</title>
    <link rel="stylesheet" href="../css/add.css"><!-- Include your CSS file for styling -->
    <link rel="stylesheet" href="../css/navbar.css">
    <script src="../js/navbar.js"></script>
    <!-- SweetAlert CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>
<body>
<nav class="navbar">
    <div class="container">
        <h1 class="logo">Animal Shelter</h1>
        <div class="nav-buttons">
            <button class="nav-button" id="homeBtn">Home</button>
            <button class="nav-button" id="petsBtn">Pets</button>
            <button class="nav-button" id="requestsBtn">Make A Request</button>
            <button class="nav-button" id="addPetBtn">Add Pet</button>
            <button class="nav-button" id="manageRequestsBtn">Manage Requests</button>
            <button class="nav-button" id="searchBtn">Search</button>
            <button class="nav-button" id="profileBtn">Profile</button>
            <button class="nav-button" id="logoutBtn">Logout</button>
        </div>
    </div>
</nav>

<h1>Add a New Pet</h1>
<form id="addPetForm" action="../action/add_a_pet_action.php" method="POST" enctype="multipart/form-data">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="type">Type:</label>
    <select type="int" id="type" name="type" required>
        <option value="1">Dog</option>
        <option value="2">Cat</option>
        <option value="3">Other</option>
    </select><br><br>

    <label for="species">Species:</label>
    <input type="text" id="species" name="species" required><br><br>

    <label for="age">Age:</label>
    <input type="number" id="age" name="age" required><br><br>

    <label for="gender">Gender:</label>
    <select id="gender" name="gender" required>
        <option value="1">Male</option>
        <option value="2">Female</option> <!-- Assuming getGenderOptions() returns the gender options -->
    </select><br><br>

    <label for="size">Size:</label>
    <select id="size" name="size" required>
        <option value="1">Small</option>
        <option value="2">Medium</option>
        <option value="3">Large</option> <!-- Assuming getSizeOptions() returns the size options -->
    </select><br><br>

    <label for="location">Location:</label>
    <input type="text" id="location" name="location" required><br><br>

    <label for="description">Description:</label><br>
    <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>

    <label for="healthStatus">Health Status:</label>
    <input type="text" id="healthStatus" name="healthStatus"><br><br>

    <label for="vaccinations">Vaccinations:</label>
    <input type="text" id="vaccinations" name="vaccinations"><br><br>

    <label for="behavior">Behavior:</label><br>
    <textarea id="behavior" name="behavior" rows="6" cols="50"></textarea><br><br>

    <label for="specialNeeds">Special Needs:</label><br>
    <textarea id="specialNeeds" name="specialNeeds" rows="6" cols="50"></textarea><br><br>

    <label for="image">Upload Image:</label>
    <input type="file" id="image" name="image" accept="image/*"><br><br>

    <input type="submit" value="Add Pet">
</form>

<script>
document.getElementById('addPetForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent the default form submission

    // Perform your form submission using AJAX or fetch
    // Example using fetch:
    fetch(this.action, {
        method: this.method,
        body: new FormData(this)
    })
    .then(response => {
        if (response.ok) {
            // Show success sweet alert
            Swal.fire({
                icon: 'success',
                title: 'Pet Added!',
                text: 'The pet has been added successfully.',
                confirmButtonText: 'OK'
            }).then(() => {
                // Redirect or perform any other action after the alert is dismissed
                window.location.href = '../view/AllPets.php';
            });
        } else {
            // Show error sweet alert if request fails
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong. Please try again later.',
                confirmButtonText: 'OK'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
</script>
</body>
</html>

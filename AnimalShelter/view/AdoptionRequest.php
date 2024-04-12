<?php
include "../functions/get_user_details.php";
include '../settings/connection.php';
include '../settings/core.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Submit Adoption Request</title>
<link rel="stylesheet" href="../css/adopt.css">
<link rel="stylesheet" href="../css/navbar.css">
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

<div class="container">
    <form id="adoptionForm" action="../action/get_a_pet_action.php" method="POST">
        <h2>Submit Adoption Request</h2>
        <label for="name">Your Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" ><br>

        <label for="email">Your Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" ><br>

        <label for="phone">Your Phone Number:</label><br>
        <input type="tel" id="phone" name="phone" value="<?php echo $telephone; ?>" ><br>

        <label for="pet">Pet Name:</label><br>
        <input type="text" id="pet" name="pet" required><br>

        <label for="living_situation">Living Situation:</label><br>
        <select id="living_situation" name="living_situation" required>
            <option value="">Select</option>
            <?php
            for ($i = 1; $i <= 10; $i++) {
                echo "<option value='$i in a house'>$i in a house</option>";
            }
            ?>
        </select><br>

        <label for="pet_experience">Pet Experience:</label><br>
        <input type="radio" id="pet_experience_yes" name="pet_experience" value="Yes">
        <label for="pet_experience_yes">Yes</label>
        <input type="radio" id="pet_experience_no" name="pet_experience" value="No" >
        <label for="pet_experience_no">No</label><br>

        <label for="reason">Reason for Adoption:</label><br>
        <textarea id="reason" name="reason" rows="4" ></textarea><br>

        <input type="submit" value="Submit Request" name="submit">
    </form>
</div>


<script src="../js/navbar.js"></script>
<script>
document.getElementById('adoptionForm').addEventListener('submit', function(e) {
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
                title: 'Request Submitted!',
                text: 'Your adoption request has been submitted successfully.',
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

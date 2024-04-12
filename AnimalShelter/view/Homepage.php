<?php


// Include your PHP script to fetch data from the database
include_once '../functions/get_num_fxn.php';
include '../settings/connection.php';
include '../settings/core.php';




$totalRequests = getTotalRequests();
$totalPets = getTotalPets();
$pendingPets = getPendingPets();
$approvedPets = getApprovedPets();
$rejectedPets = getRejectedPets();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Shelter</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <style>
        /* Color scheme */
        /* Color scheme */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f0f8ff; /* Light blue background */
    color: #333; /* Dark text color */
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}



.box {
    width: 300px;
    height: 150px;
    background-color: #e0f0ff; /* Light blue */
    border-radius: 10px;
    margin-bottom: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.box:hover {
    transform: scale(1.05); /* Grow on hover */
}

.box h3 {
    font-size: 24px;
    margin-bottom: 10px;
    color: #333; /* Dark text color */
}

.box p {
    font-size: 18px;
    color: #333; /* Dark text color */
}


    </style>
    <script src="../js/navbar.js"></script>
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
        <div class="box">
            <h3>Adoption Requests</h3>
            <p>Total: <span id="totalRequests"><?php echo $totalRequests; ?></span></p>
        </div>
        <div class="box">
            <h3>Total Pets</h3>
            <p>Total: <span id="totalPets"><?php echo $totalPets; ?></span></p>
        </div>
        <div class="box">
            <h3>Pending Pets</h3>
            <p>Total: <span id="pendingPets"><?php echo $pendingPets; ?></span></p>
        </div>
        <div class="box">
            <h3>Approved Pets</h3>
            <p>Total: <span id="approvedPets"><?php echo $approvedPets; ?></span></p>
        </div>
        <div class="box">
            <h3>Rejected Pets</h3>
            <p>Total: <span id="rejectedPets"><?php echo $rejectedPets; ?></span></p>
        </div>
    </div>



    <!-- Include jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            // Fetch data from backend PHP script
            $.getJSON('../functions/get_num_fxn.php', function (data) {
                $('#totalRequests').text(data.totalRequests);
                $('#totalPets').text(data.totalPets);
                $('#pendingPets').text(data.pendingPets);
                $('#approvedPets').text(data.approvedPets);
                $('#rejectedPets').text(data.rejectedPets);
            });
        });
    </script>
</body>

</html>

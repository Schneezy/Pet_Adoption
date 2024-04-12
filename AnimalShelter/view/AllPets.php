<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List of Pets</title>
    <style>
        /* Reset default margin and padding for all elements */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff; /* Light blue background */
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Navbar styles */
        .navbar {
            background-color: #4682b4; /* Steel blue navbar background */
            color: #fff;
            padding: 10px 0;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .nav-buttons {
            display: flex;
            justify-content: flex-end;
        }

        .nav-button {
            background-color: transparent;
            border: none;
            color: #fff;
            cursor: pointer;
            padding: 8px 16px;
            margin-left: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .nav-button:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Pet card styles */
        .pet-card {
            width: 300px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
            margin: 20px; /* Adjust spacing between pet cards */
        }

        .pet-card:hover {
            transform: translateY(-5px);
        }

        .pet-details {
            padding: 20px;
        }

        .pet-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .pet-info {
            margin-bottom: 10px;
        }

        .pet-info span {
            font-weight: bold;
        }

        .pet-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
    </style>
    <script src="../js/navbar.js"></script>
    <link rel="stylesheet" href="../css/navbar.css">
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
    <h1 style="text-align: center; margin-top: 20px;">List of Pets</h1>
    </div>
    <div class="container">
    <?php
    // Include database connection file and functions
    include_once "../settings/connection.php";
    include_once "../settings/core.php";
    include_once "../functions/get_num_fxn.php";

    // Get all pets from the database
    $allPets = getAllPets($con);

    // Loop through each pet and display its information in a card format
    foreach ($allPets as $pet) {
        echo '<div class="pet-card">';
        echo '<div class="pet-details">';
        echo '<div class="pet-name">' . htmlspecialchars($pet['Name'] ?? 'Unknown Name') . '</div>';
        echo '<div class="pet-info"><span>Type:</span> ' . htmlspecialchars($pet['Species'] ?? 'Unknown') . '</div>';
        echo '<div class="pet-info"><span>Age:</span> ' . htmlspecialchars($pet['Age'] ?? 'Unknown') . '</div>';
        echo '<div class="pet-info"><span>Gender:</span> ' . htmlspecialchars($pet['GenderID'] ?? 'Unknown') . '</div>';
        echo '<div class="pet-info"><span>Size:</span> ' . htmlspecialchars($pet['SizeID'] ?? 'Unknown') . '</div>';
        echo '<div class="pet-info"><span>Location:</span> ' . htmlspecialchars($pet['Location'] ?? 'Unknown') . '</div>';
        echo '<div class="pet-info"><span>Description:</span> ' . htmlspecialchars($pet['Description'] ?? 'Unknown') . '</div>';
        echo '<div class="pet-info"><span>Health Status:</span> ' . htmlspecialchars($pet['HealthStatus'] ?? 'Unknown') . '</div>';
        echo '<div class="pet-info"><span>Vaccinations:</span> ' . htmlspecialchars($pet['Vaccinations'] ?? 'Unknown') . '</div>';
        echo '<div class="pet-info"><span>Behavior:</span> ' . htmlspecialchars($pet['Behavior'] ?? 'Unknown') . '</div>';
        echo '<div class="pet-info"><span>Special Needs:</span> ' . htmlspecialchars($pet['SpecialNeeds'] ?? 'Unknown') . '</div>';
        // Display the image if the URL is provided
        if (!empty($pet['ImageURL1'])) {
            echo '<img src="' . htmlspecialchars($pet['ImageURL1']) . '" alt="Pet Image" class="pet-image">';
        }
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>
</body>
</html>

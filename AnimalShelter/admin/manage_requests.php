<?php
include '../settings/connection.php';
include '../settings/core.php';
include '../functions/get_user_details.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Adoption Requests</title>
<link rel="stylesheet" href="../css/manage_adoption.css">
<link rel="stylesheet" href="../css/navbar.css">
<script src="../js/navbar.js"></script>

</head>
<style>
    /* Table styles */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
        color: #333;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
    /* Form styles */
    form {
        display: inline-block;
        margin: 0;
    }
    select, button {
        padding: 6px;
    }
</style>
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
            </div>
        </div>
    </nav>

<div class="container">
    <h2>Manage Adoption Requests</h2>
</div>
<div>   
    <?php
    // Modify the SQL query to join the AdoptionRequests table with the Pets and Users tables
    // Fetch adoption requests from the database
    // Include database connection file
    include_once "../settings/connection.php";
    include_once "../settings/core.php";

    // Fetch adoption requests from the database
    $sql = "SELECT
                ar.RequestID,
                u.FirstName AS UserName,
                p.Name AS PetName,
                ar.LivingSituation,
                ar.PetExperience,
                ar.SuitabilityReasons,
                ar.StatusID
            FROM
                AdoptionRequests ar
            JOIN
                user u ON ar.UserID = u.UserID
            JOIN
                pets p ON ar.PetID = p.PetID
            ORDER BY
                ar.RequestID";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>User</th>
                    <th>Pet</th>
                    <th>Living_Situation</th>
                    <th>Pet_Experience</th>
                    <th>Suitability_Reasons</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . (isset($row['UserName']) ? $row['UserName'] : '') . "</td>";
            echo "<td>" . (isset($row['PetName']) ? $row['PetName'] : '') . "</td>";
            echo "<td>" . (isset($row['LivingSituation']) ? $row['LivingSituation'] : '') . "</td>";
            echo "<td>" . (isset($row['PetExperience']) ? $row['PetExperience'] : '') . "</td>";
            echo "<td>" . (isset($row['SuitabilityReasons']) ? $row['SuitabilityReasons'] : '') . "</td>";
            echo "<td>" . (isset($row['StatusID']) ? $row['StatusID'] : '') . "</td>";
            echo "<td>";
            echo "<form action='../action/manage_adoption_action.php' method='POST'>";
            echo "<input type='hidden' name='request_id' value='" . (isset($row['RequestID']) ? $row['RequestID'] : '') . "'>";
            echo "<select name='action'>";
            echo "<option value='approve'>Approve</option>";
            echo "<option value='reject'>Reject</option>";
            echo "<option value='pending'>Pending</option>";
            echo "</select>";
            echo "<button type='submit' name='submit'>Submit</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No adoption requests found.</p>";
    }
    ?>
</div>

</body>
</html>
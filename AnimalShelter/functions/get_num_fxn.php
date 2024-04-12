<?php
// Include your PHP script to fetch data from the database
include '../settings/connection.php';


function columnExists($con, $table, $column) {
    $query = "SHOW COLUMNS FROM $table LIKE '$column'";
    $result = mysqli_query($con, $query);
    return mysqli_num_rows($result) > 0;
}

function getTotalRequests() {
    global $con;
    $query = "SELECT COUNT(*) AS totalRequests FROM adoptionrequests";
    $result = mysqli_query($con, $query);
    if (!$result) {
        throw new Exception(mysqli_error($con));
    }
    $row = mysqli_fetch_assoc($result);
    $totalRequests = $row['totalRequests'];
    return $totalRequests;
}

function getTotalPets() {
    global $con;
    $query = "SELECT COUNT(*) AS totalPets FROM pets";
    $result = mysqli_query($con, $query);
    if (!$result) {
        throw new Exception(mysqli_error($con));
    }
    $row = mysqli_fetch_assoc($result);
    $totalPets = $row['totalPets'];
    return $totalPets;
}

function getPendingPets() {
    global $con;
    $query = "SELECT COUNT(*) AS pendingPets FROM pets";
    if (columnExists($con, 'pets', 'status')) {
        $query .= " WHERE status = 'pending'";
    } else {
        // Handle the absence of 'status' column (e.g., default behavior)
    }
    $result = mysqli_query($con, $query);
    if (!$result) {
        throw new Exception(mysqli_error($con));
    }
    $row = mysqli_fetch_assoc($result);
    $pendingPets = $row['pendingPets'];
    return $pendingPets;
}

function getApprovedPets() {
    global $con;
    $query = "SELECT COUNT(*) AS approvedPets FROM pets";
    if (columnExists($con, 'pets', 'status')) {
        $query .= " WHERE status = 'approved'";
    } else {
        // Handle the absence of 'status' column (e.g., default behavior)
    }
    $result = mysqli_query($con, $query);
    if (!$result) {
        throw new Exception(mysqli_error($con));
    }
    $row = mysqli_fetch_assoc($result);
    $approvedPets = $row['approvedPets'];
    return $approvedPets;
}

function getRejectedPets() {
    global $con;
    $query = "SELECT COUNT(*) AS rejectedPets FROM pets";
    if (columnExists($con, 'pets', 'status')) {
        $query .= " WHERE status = 'rejected'";
    } else {
        // Handle the absence of 'status' column (e.g., default behavior)
    }
    $result = mysqli_query($con, $query);
    if (!$result) {
        throw new Exception(mysqli_error($con));
    }
    $row = mysqli_fetch_assoc($result);
    $rejectedPets = $row['rejectedPets'];
    return $rejectedPets;
}

function getAllPets($con) {
    $sqlAllPets = "SELECT * FROM pets";
    $result = $con->query($sqlAllPets);
    if (!$result) {
        throw new Exception($con->error);
    }
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $result->close();
    
    return $data;
}

// Call functions to get data
$totalRequests = getTotalRequests();
$totalPets = getTotalPets();
$pendingPets = getPendingPets();
$approvedPets = getApprovedPets();
$rejectedPets = getRejectedPets();
$petsData = getAllPets($con);
?>

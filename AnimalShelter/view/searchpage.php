<?php
include '../settings/connection.php';
include '../settings/core.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Pets</title>
    <link rel="stylesheet" href="../css/searchcss.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/navbar.js"></script>
</head>
<body>
    <h1>Search Pets</h1>


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
    <form action="../action/search_action.php" method="GET" id="petForm">
        <label for="searchTerm">Search Term:</label>
        <input type="text" id="searchTerm" name="searchTerm" required>
        <button type="button" id="searchBtn">Search</button>
    </form>

    <script>
        document.getElementById('searchBtn').addEventListener('click', function() {
            Swal.fire({
                title: 'Searching for Pets',
                html: 'Please wait while we search for pets with your search term.',
                icon: 'info',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                stopKeydownPropagation: true,
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    // Simulate an error (change to false to simulate a successful search)
                    const isError = Math.random() < 0.5;

                    if (isError) {
                        Swal.fire({
                            title: 'Error',
                            text: 'An error occurred during the search process.',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            allowOutsideClick: true,
                        });
                    } else {
                        // Simulate a successful search
                        Swal.fire({
                            title: 'Pets Found',
                            text: 'Here are the search results...',
                            icon: 'success',
                            confirmButtonText: 'OK',
                            allowOutsideClick: true,
                        });
                    }
                }
            });
        });
    </script>
</body>
</html>

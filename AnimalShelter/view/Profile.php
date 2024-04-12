<?php
include '../settings/connection.php';
include '../settings/core.php';
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Profile</title>
<link rel="stylesheet" href="../css/prof.css">
<link rel="stylesheet" href="../css/navbar.css">
<script src="../js/navbar.js"></script>
<style>
 
    h1 {
        text-align: center;
        margin-bottom: 10px;
    }

    label[for="firstName"] {
        margin-top: 20px;
    }
</style>

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
    
    <form id="profileForm" method="POST">
    <h1>User Profile</h1>
      <?php
      
      // Initialize $userID variable
      $userID = 0;

      // Fetch user data from the database
      $sql = "SELECT * FROM User WHERE UserID = {$_SESSION['userId']}";
      $result = $con->query($sql);

      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          // Assign user ID to $userID variable
          $userID = $row['UserID'];

          // Echo fetched data into the input fields
          echo '<label for="firstName">First Name:</label>';
          echo '<input type="text" id="firstName" name="firstName" value="' . $row['FirstName'] . '" required><br>';

          echo '<label for="lastName">Last Name:</label>';
          echo '<input type="text" id="lastName" name="lastName" value="' . $row['LastName'] . '" required><br>';

          echo '<label for="email">Email:</label>';
          echo '<input type="email" id="email" name="email" value="' . $row['Email'] . '" required><br>';

          echo '<label for="phone">Phone Number:</label>';
          echo '<input type="tel" id="phone" name="phone" value="' . $row['Phone'] . '" required><br>';
      } else {
          echo "No user data found.";
      }

      // Close database connection
      $con->close();
      ?>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required><br>

      <!-- Update and Delete buttons -->
      <button type="button" id="updateBtn" onclick="setAction('update')">Update</button>
      <button type="button" id="deleteBtn" onclick="setAction('delete')">Delete</button>
    </form>
  </div>
  </div>

  <script>
    function setAction(action) {
      // Get the form element
      var form = document.getElementById("profileForm");

      // Set the action URL based on the selected action
      if (action === 'update') {
          form.action = '../action/update_profile.php';
          // Optionally, you can add a hidden input to indicate the action
          var hiddenInput = document.createElement('input');
          hiddenInput.type = 'hidden';
          hiddenInput.name = 'action';
          hiddenInput.value = 'update';
          form.appendChild(hiddenInput);
      } else if (action === 'delete') {
          if (confirm('Are you sure you want to delete your profile? This action cannot be undone.')) {
              form.action = '../action/delete_profile_action.php';
              // Optionally, you can add a hidden input to indicate the action
              var hiddenInput = document.createElement('input');
              hiddenInput.type = 'hidden';
              hiddenInput.name = 'action';
              hiddenInput.value = 'delete';
              form.appendChild(hiddenInput);
              form.submit();
          }
      }

      // Submit the form
      form.submit();
    }
  </script>
  
</body>
</html>

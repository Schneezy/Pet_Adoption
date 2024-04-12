document.addEventListener('DOMContentLoaded', function() {
    // Get the user's role ID from the hidden element
    var roleIdElement = document.getElementById('roleId');
    if (roleIdElement) {
      var roleId = JSON.parse(roleIdElement.value); // Parse JSON string
    } else {
      console.error("Error: roleId element not found");
      // Handle the case where the element is missing (optional)
    }
  
    // Function to redirect to AllPets.php
    function redirectToAllPets() {
      location.href = '../view/AllPets.php'; // Replace 'AllPets.php' with your actual pets page URL
    }
  
    // Add event listeners to navigation buttons
    var homeBtn = document.getElementById('homeBtn');
    var addPetBtn = document.getElementById('addPetBtn');
    var manageRequestsBtn = document.getElementById('manageRequestsBtn');
  
    if (homeBtn && addPetBtn && manageRequestsBtn) {
      homeBtn.addEventListener('click', function(event) {
        if (roleId === 2) {
          event.preventDefault();
          alert("Access Denied! You do not have permission to access this page.");
        }
      });
  
      addPetBtn.addEventListener('click', function(event) {
        if (roleId === 2) {
          event.preventDefault();
          alert("Access Denied! You do not have permission to access this page.");
        }
      });
  
      manageRequestsBtn.addEventListener('click', function(event) {
        if (roleId === 2) {
          event.preventDefault();
          alert("Access Denied! You do not have permission to access this page.");
        }
      });
    }
  
    // Add event listeners to other navigation buttons
    var petsBtn = document.getElementById('petsBtn');
    var requestsBtn = document.getElementById('requestsBtn');
    var profileBtn = document.getElementById('profileBtn');
    var searchBtn = document.getElementById('searchBtn');
    var logoutBtn = document.getElementById('logoutBtn');
  
    if (petsBtn && requestsBtn && profileBtn && searchBtn && logoutBtn) {
      petsBtn.addEventListener('click', redirectToAllPets);
  
      requestsBtn.addEventListener('click', function() {
        location.href = '../view/AdoptionRequest.php'; // Replace with actual requests page URL
      });
  
      profileBtn.addEventListener('click', function() {
        location.href = '../view/Profile.php'; // Replace with actual profile page URL
      });
  
      searchBtn.addEventListener('click', function() {
        location.href = '../view/searchpage.php'; // Replace with actual search page URL
      });
  
      logoutBtn.addEventListener('click', function() {
        location.href = '../login/logout.php'; // Replace with actual logout page URL
      });
    }
  });
  
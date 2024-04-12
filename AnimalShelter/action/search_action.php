<?php
include '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["searchTerm"])) {
    // Get the search term from the URL query string
    $searchTerm = $_GET["searchTerm"];

    // Prepare and execute the SQL query to search for pets based on the search term
    $sql ="SELECT * FROM Pets WHERE Name LIKE '%$searchTerm%' OR 
    Species LIKE '%$searchTerm%' OR 
    Location LIKE '%$searchTerm%' OR 
    Age LIKE '%$searchTerm%' OR 
    HealthStatus LIKE '%$searchTerm%'";
;

    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // Display search results
        echo "<h2>Search Results:</h2>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>{$row['Name']} - {$row['Species']}</li>";
            // Display other information as needed
        }
        echo "</ul>";
    } else {
        echo "No results found.";
    }
} else {
    echo "Invalid request or search term missing.";
}
?>

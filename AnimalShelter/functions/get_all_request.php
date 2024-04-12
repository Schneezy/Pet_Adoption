<?php
function executeQuery($query) {
    global $con;

    $result = mysqli_query($con, $query);

    if (!$result) {
        // Handle error more gracefully (e.g., log error and return empty array)
        error_log("Query failed: " . mysqli_error($con));
        return [];
    }

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getAllAdoptionRequests() {
    global $con;
    $query = "SELECT AdoptionRequests.*, Pet.Name AS PetName, User.FirstName AS UserFirstName, User.LastName AS UserLastName, Status.StatusName
              FROM AdoptionRequests
              JOIN Pet ON AdoptionRequests.PetID = Pet.PetID
              JOIN User ON AdoptionRequests.UserID = User.UserID
              JOIN Status ON AdoptionRequests.StatusID = Status.StatusID";

    return executeQuery($query);
}

$adoptionRequests = getAllAdoptionRequests();
$adoptionRequestsCount = count($adoptionRequests);

?>
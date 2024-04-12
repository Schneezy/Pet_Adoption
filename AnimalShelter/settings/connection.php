<?php
//local DB Config
$SERVER="localhost";
$USERNAME="root";
$PASSWRD="";
$DATABASE="pet_adoption";


$con =mysqli_connect($SERVER,$USERNAME,$PASSWRD, $DATABASE) or die ("could not connect database");

//check connection:
if ($con-> connect_error) {
    die ("Connection failed: ".$con-> connect_error);
}
else{
//echo "Connected successfully";
}

?>
<?php

// Function to get gender options
function getAnimalOptions() {
    $animal = array(
        'Cat',
        'Dog',
        'Other' // You can customize the gender options as needed
    );

    // Generate HTML options for each gender
    $animal_type = '';
    foreach ($animal as $abowa) {
        $animal_type .= "<option value='$abowa'>$abowa</option>";
    }

    return $animal_type;
}

?>

<?php

// Function to get gender options
function getGenderOptions() {
    $genders = array(
        'Male',
        'Female',
        'Other' // You can customize the gender options as needed
    );

    // Generate HTML options for each gender
    $new_gender = '';
    foreach ($genders as $gender) {
        $new_gender .= "<option value='$gender'>$gender</option>";
    }

    return $new_gender;
}

?>

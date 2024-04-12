<?php

// Function to get size options
function getSizeOptions() {
    $sizes = array(
        'Small',
        'Medium',
        'Large'
    );

    // Generate HTML options for each size
    $new_size = '';
    foreach ($sizes as $size) {
        $new_size .= "<option value='$size'>$size</option>";
    }

    return $new_size;
}

?>

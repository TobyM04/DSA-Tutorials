<?php
// Constants for data indices
define('WINDSPEED', 1);
define('WINDDIRECTION', 3);
define('TEMPERATURE', 4);
define('TIMEHH', 29);
define('TIMEMM', 30);
define('STATION', 32);
define('SUMMARY', 49);

// Function to convert degrees to compass direction
function degree_to_compass_point($d) {
    $dp = ($d + 11.25) % 360;
    $index = intval($dp / 22.5); // Convert to integer index
    $points = ["N", "NNE", "NE", "ENE", "E", "ESE", "SE", "SSE", "S", "SSW", "SW", "WSW", "W", "WNW", "NW", "NNW", "N"];
    $dir = $points[$index];
    return $dir;
}

// Check if a station has been selected
if (isset($_GET['station'])) {
    $url = $_GET['station'];
    $data = file_get_contents($url);
    $parts = explode(' ', $data); // Assuming space-delimited CSV data

    // Display basic weather information
    echo "<h1>Weather Information</h1>";
    echo "<p>Wind Speed: " . $parts[WINDSPEED] . " mph</p>";
    echo "<p>Wind Direction: " . degree_to_compass_point($parts[WINDDIRECTION]) . "</p>";
    echo "<p>Temperature: " . $parts[TEMPERATURE] . " °C</p>";
    // You can add more fields as required, using the defined constants
    // Example for time and summary (adjust according to actual data format and indices)
    echo "<p>Time: " . $parts[TIMEHH] . ":" . $parts[TIMEMM] . "</p>";
    echo "<p>Station: " . $parts[STATION] . "</p>"; // This might require adjustment based on actual data
    echo "<p>Summary: " . $parts[SUMMARY] . "</p>"; // Adjust based on actual data
} else {
    echo "<p>No station selected. Please go back and select a weather station.</p>";
}
?>

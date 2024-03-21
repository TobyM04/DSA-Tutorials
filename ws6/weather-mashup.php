<?php
// Define API Key
$apiKey = "50e6ff3f01073976f4dd6631106efb68"; // Showcases the API Key

// Define cities
$cities = [
    'Canterbury,GB',
    'Reims,FR'
];

// Function to fetch weather data with error handling
function fetchWeather($city, $apiKey) {
    $currentWeatherUrl = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey&mode=xml";
    $forecastUrl = "https://api.openweathermap.org/data/2.5/forecast?q=$city&appid=$apiKey&mode=xml";

    // Suppress errors with @ and check if the call was successful
    $currentWeatherXml = @simplexml_load_file($currentWeatherUrl);
    if ($currentWeatherXml === false) {
        return ['error' => 'Failed to load current weather data.'];
    }

    $forecastXml = @simplexml_load_file($forecastUrl);
    if ($forecastXml === false) {
        return ['error' => 'Failed to load forecast data.'];
    }

    return ['currentWeather' => $currentWeatherXml, 'forecast' => $forecastXml];
}

// Function to convert Kelvin to Celsius
function kelvinToCelsius($kelvin) {
    return $kelvin - 273.15;
}
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather Mashup - Canterbury & Reims</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>Canterbury and Reims Twin Cities</h1>

    <?php foreach ($cities as $city): ?>
        <?php $weatherData = fetchWeather($city, $apiKey); ?>
        <?php if (isset($weatherData['error'])): ?>
            <h2>Error fetching data for <?php echo $city; ?></h2>
            <p><?php echo $weatherData['error']; ?></p>
        <?php else: ?>
            <h2>Current Weather in <?php echo $city; ?></h2>
            <table>
                <tr>
                    <th>Temperature (°C)</th>
                    <th>Weather</th>
                </tr>
                <tr>
                    <td><?php echo round(kelvinToCelsius($weatherData['currentWeather']->temperature['value']), 2); ?></td>
                    <td><?php echo $weatherData['currentWeather']->weather['value']; ?></td>
                </tr>
            </table>

            <h3>5-Day Forecast</h3>
            <table>
                <tr>
                    <th>Date</th>
                    <th>Temperature (°C)</th>
                    <th>Weather</th>
                </tr>
                <?php foreach ($weatherData['forecast']->forecast->time as $time): ?>
                    <?php if (strpos($time['from'], '12:00:00')): ?>
                        <tr>
                            <td><?php echo $time['from']; ?></td>
                            <td><?php echo round(kelvinToCelsius($time->temperature['value']), 2); ?></td>
                            <td><?php echo $time->symbol['name']; ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    <?php endforeach; ?>
</body>
</html>



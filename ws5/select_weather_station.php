<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Weather Station</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            max-width: 400px;
            margin: auto;
        }
        label {
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
        }
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form action="display_weather.php" method="get">
        <label for="station">Select a weather station:</label>
        <select name="station" id="station">
            <option value="http://www.martynhicks.uk/weather/clientraw.txt">Horfield (Bristol)</option>
            <option value="http://www.thornburyweather.co.uk/weatherstation/clientraw.txt">Thornbury (Bristol)</option>
            <option value="https://www.glosweather.com/clientraw.txt">Gloucestershire</option>
            <option value="http://www.newquayweather.com/clientraw.txt">Newquay (Cornwall)</option>
            <option value="https://www.cotswoldgliding.co.uk/weather/clientraw.txt">Cotswold Gliding Club (Stroud)</option>
        </select>
        <button type="submit">Get Weather</button>
    </form>
</body>
</html>

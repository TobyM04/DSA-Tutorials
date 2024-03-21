<?php
// Open the CSV file and read data
$csvFile = fopen("quotes.csv", "r");
if ($csvFile === FALSE) {
    die("Error opening file!");
}

// Start the table
echo "<table border='1'>";
echo "<tr><th>Quote</th><th>Source</th><th>DOB-DOD</th><th>Wikipedia Link</th><th>Image</th><th>Category</th></tr>";

// Read each line of the CSV and generate HTML table rows
while (($row = fgetcsv($csvFile, 0, "|")) !== FALSE) {
    echo "<tr>";
    foreach ($row as $index => $cell) {
        // Display the image directly in the table if it's the image column
        if ($index == 4) { // Assuming the image URL is in the 5th column
            echo "<td><img src='" . htmlspecialchars($cell) . "' alt='Image' height='100'></td>";
        } else if ($index == 3) { // If it's the wikipedia link column
            echo "<td><a href='" . htmlspecialchars($cell) . "'>View Article</a></td>";
        } else {
            echo "<td>" . htmlspecialchars($cell) . "</td>";
        }
    }
    echo "</tr>";
}

// Close the table and the file
echo "</table>";
fclose($csvFile);
?>

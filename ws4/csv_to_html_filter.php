<?php
// Check if a category is passed as a URL parameter
$categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';

// Open the CSV file and read data
$csvFile = fopen("quotes.csv", "r");
if ($csvFile === FALSE) {
    die("Error opening file!");
}

// Start the table
echo "<table border='1'>";
echo "<tr><th>Quote</th><th>Source</th><th>DOB-DOD</th><th>Wikipedia Link</th><th>Image Link</th><th>Category</th></tr>";

// Read each line of the CSV, filter by category if needed, and generate HTML table rows
while (($row = fgetcsv($csvFile, 0, "|")) !== FALSE) {
    // If a category filter is set, skip rows that don't match
    if ($categoryFilter && strtolower($row[5]) != strtolower($categoryFilter)) {
        continue;
    }

    echo "<tr>";
    foreach ($row as $cell) {
        echo "<td>" . htmlspecialchars($cell) . "</td>";
    }
    echo "</tr>";
}

// Close the table and the file
echo "</table>";
fclose($csvFile);
?>
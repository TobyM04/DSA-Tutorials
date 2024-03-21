<?php
$csvFile = 'ws4/quotes.csv';
$category = isset($_GET['category']) ? $_GET['category'] : '';

if (($handle = fopen($csvFile, 'r')) !== FALSE) {
    echo "<table border='1'>";
    echo "<tr><th>Quote</th><th>Source</th><th>DOB-DOD</th><th>Wiki Link</th><th>Image</th><th>Category</th></tr>";

    while (($data = fgetcsv($handle, 1000, "|")) !== FALSE) {
        // Filter by category if specified
        if (empty($category) || (strcasecmp($data[5], $category) == 0)) {
            echo "<tr>";
            foreach ($data as $cell) {
                echo "<td>$cell</td>";
            }
            echo "</tr>";
        }
    }
    echo "</table>";
    fclose($handle);
}
?>

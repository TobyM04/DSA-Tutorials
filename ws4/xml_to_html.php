<?php
// Load the XML file
$xmlFile = 'quotes.xml';
if (!file_exists($xmlFile)) {
    die("Error: File not found.");
}

// Load the XML data
$xml = simplexml_load_file($xmlFile);
if (!$xml) {
    die("Error: Cannot create object.");
}

// Start the table
echo "<table border='1'>";
echo "<tr><th>Quote</th><th>Source</th><th>DOB-DOD</th><th>Wikipedia Link</th><th>Image</th><th>Category</th></tr>";

// Iterate over each 'quote' element within the XML and output its contents
foreach ($xml->quote as $quote) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($quote->text) . "</td>";
    echo "<td>" . htmlspecialchars($quote->source) . "</td>";
    echo "<td>" . htmlspecialchars($quote->{'dob-dod'}) . "</td>";
    echo "<td><a href='" . htmlspecialchars($quote->wplink) . "'>View Article</a></td>";
    echo "<td><img src='" . htmlspecialchars($quote->wpimg) . "' alt='Image' height='100'></td>";
    echo "<td>" . htmlspecialchars($quote->category) . "</td>";
    echo "</tr>";
}

// Close the table
echo "</table>";
?>
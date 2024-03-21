<?php
$xmlFile = 'ws4/quotes.xml';

// Load the XML file
$xml = simplexml_load_file($xmlFile);

echo "<table border='1'>";
echo "<tr><th>Quote</th><th>Source</th><th>DOB-DOD</th><th>Wiki Link</th><th>Image</th><th>Category</th></tr>";

// Iterate through each quote element
foreach ($xml->quote as $quote) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($quote->text) . "</td>";
    echo "<td>" . htmlspecialchars($quote->source) . "</td>";
    echo "<td>" . htmlspecialchars($quote->dob_dod) . "</td>";
    echo "<td><a href='" . $quote->wplink . "'>Link</a></td>";
    echo "<td><img src='" . $quote->wpimg . "' alt='Image' width='100'></td>";
    echo "<td>" . htmlspecialchars($quote->category) . "</td>";
    echo "</tr>";
}
echo "</table>";
?>

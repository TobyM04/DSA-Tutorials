<?php
// Define the CSV file path and the XML file path
$csvFile = 'ws4/quotes.csv';
$xmlFile = 'ws4/quotes.xml';

// Open the CSV file for reading
if (($handle = fopen($csvFile, 'r')) !== FALSE) {
    // Create a new DOMDocument instance
    $doc = new DOMDocument();
    $doc->formatOutput = true;

    // Add a root element to the XML
    $root = $doc->createElement('quotes');
    $doc->appendChild($root);

    // Skip the header line
    fgetcsv($handle, 1000, "|");

    // Loop through each row of the CSV file
    while (($row = fgetcsv($handle, 1000, "|")) !== FALSE) {
        $quoteElement = $doc->createElement('quote');

        // Add each cell as a child element of the quote element
        $quoteElement->appendChild($doc->createElement('text', htmlspecialchars($row[0])));
        $quoteElement->appendChild($doc->createElement('source', htmlspecialchars($row[1])));
        $quoteElement->appendChild($doc->createElement('dob_dod', htmlspecialchars($row[2])));
        $quoteElement->appendChild($doc->createElement('wplink', htmlspecialchars($row[3])));
        $quoteElement->appendChild($doc->createElement('wpimg', htmlspecialchars($row[4])));
        $quoteElement->appendChild($doc->createElement('category', htmlspecialchars($row[5])));

        // Append the quote element to the root element
        $root->appendChild($quoteElement);
    }

    // Save the XML in a file
    $doc->save($xmlFile);

    fclose($handle); // Close the CSV file
    echo "XML file has been generated successfully.";
}
?>

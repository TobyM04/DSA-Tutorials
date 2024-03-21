<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


function csvToXml($inputCsvFilePath, $outputXmlFilePath, $delimiter = '|') {
    // Check if the file exists and is readable
    if (!file_exists($inputCsvFilePath) || !is_readable($inputCsvFilePath)) {
        return false;
    }

    // Create a new XML element called "quotes"
    $xml = new SimpleXMLElement('<quotes/>');

    // Open the CSV file for reading
    if (($handle = fopen($inputCsvFilePath, 'r')) !== false) {
        // Get the headers from the first line of the CSV
        $headers = fgetcsv($handle, 0, $delimiter);

        // Process each line of the CSV
        while (($row = fgetcsv($handle, 0, $delimiter)) !== false) {
            // Create a new "quote" element for each row
            $quoteElement = $xml->addChild('quote');
            foreach ($row as $i => $value) {
                // Use the headers as tag names for each value
                if ($headers[$i] == 'category') {
                    // Categories are comma separated, so split them
                    $categories = explode(',', $value);
                    $categoriesElement = $quoteElement->addChild('categories');
                    foreach ($categories as $category) {
                        $categoriesElement->addChild('category', htmlspecialchars(trim($category)));
                    }
                } else {
                    // Add each value as a child element to "quote"
                    $quoteElement->addChild(str_replace(' ', '_', $headers[$i]), htmlspecialchars(trim($value)));
                }
            }
        }
        // Close the file handle
        fclose($handle);
    }

    // Save the XML to the specified path
    $xml->asXML($outputXmlFilePath);
}

// Usage example:
$inputCsvFilePath = 'C:/laragon/www/ws15/quotes.csv';
$outputXmlFilePath = 'C:/laragon/www/ws15/quotes.xml';
csvToXml($inputCsvFilePath, $outputXmlFilePath);

// After calling the csvToXml function in your index.php:
if (csvToXml($inputCsvFilePath, $outputXmlFilePath)) {
    echo 'The XML file has been successfully created.';
} else {
    echo 'There was an error creating the XML file.';
}

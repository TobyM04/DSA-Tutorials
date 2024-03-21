<?php
// Read the CSV file
$csv = array_map('str_getcsv', file('quotes.csv'));

// Create SimpleXMLElement object
$xml = new SimpleXMLElement('<quotes></quotes>');

// Loop through CSV data and append to XML
foreach ($csv as $row) {
    $quote = $xml->addChild('quote');
    $quote->addChild('quote_text', $row[0]);
    $quote->addChild('source', $row[1]);
    $quote->addChild('dob_dod', $row[2]);
    $quote->addChild('wplink', $row[3]);
    $quote->addChild('wpimg', $row[4]);
    $quote->addChild('category', $row[5]);
}

// Save XML to file
$xml->asXML('quotes.xml');

echo "CSV has been converted to XML successfully.";
?>

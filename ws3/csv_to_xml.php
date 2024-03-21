<?php
// Open the CSV file
if (($handle = fopen("quotes.csv", "r")) !== FALSE) {
    $doc = new DOMDocument();
    $doc->formatOutput = true;

    $root = $doc->createElement("quotes");
    $doc->appendChild($root);

    // Skip the header row
    fgetcsv($handle);

    while (($data = fgetcsv($handle, 1000, "|")) !== FALSE) {
        $quoteElement = $doc->createElement("quote");

        $textElement = $doc->createElement("text", htmlspecialchars($data[0]));
        $quoteElement->appendChild($textElement);

        $sourceElement = $doc->createElement("source", htmlspecialchars($data[1]));
        $quoteElement->appendChild($sourceElement);

        $dobDodElement = $doc->createElement("dob-dod", htmlspecialchars($data[2]));
        $quoteElement->appendChild($dobDodElement);

        $wplinkElement = $doc->createElement("wplink", htmlspecialchars($data[3]));
        $quoteElement->appendChild($wplinkElement);

        $wpimgElement = $doc->createElement("wpimg", htmlspecialchars($data[4]));
        $quoteElement->appendChild($wpimgElement);

        $categoryElement = $doc->createElement("category", htmlspecialchars($data[5]));
        $quoteElement->appendChild($categoryElement);

        $root->appendChild($quoteElement);
    }
    fclose($handle);

    // Save the XML to a file
    $doc->save("quotes.xml");
    echo "XML file has been generated successfully.";
}
?>
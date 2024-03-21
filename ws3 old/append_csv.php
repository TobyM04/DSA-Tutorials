<?php
// Check if all required fields are filled
if (empty($_POST['quote']) || empty($_POST['source']) || empty($_POST['dob']) || empty($_POST['wplink']) || empty($_POST['wpimg']) || empty($_POST['category'])) {
    echo "All fields are required.";
    exit;
}

// Open the CSV file for appending
$file = fopen("quotes.csv", "a");

// Prepare the data to append to CSV
$data = [
    $_POST['quote'],
    $_POST['source'],
    $_POST['dob'] . "-" . ($_POST['dod'] ?? ''), // concatenate dob and dod
    $_POST['wplink'],
    $_POST['wpimg'],
    $_POST['category']
];

// Write the data to CSV
fputcsv($file, $data, "|");

// Close the CSV file
fclose($file);

echo "Quote has been added successfully.";
?>
